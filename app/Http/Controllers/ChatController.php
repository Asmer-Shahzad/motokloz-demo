<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Inventory;
use App\Models\User;
use App\Services\DisklozChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    private function disklozBaseUrl(): string
    {
        return config('services.diskloz.base_url', env('DISKLOZ_BASE_URL', env('diskloz_base_url', '')));
    }

    private function getInventoryFromApi(int $inventoryId): ?object
    {
        try {
            $response = Http::timeout(5)->get($this->disklozBaseUrl() . '/api/search_by_id', ['id' => $inventoryId]);
            if ($response->ok()) {
                return json_decode($response->body());
            }
        } catch (\Exception $e) {}
        return null;
    }

    private function getDealerInfo(int $inventoryId): ?object
    {
        $data = $this->getInventoryFromApi($inventoryId);
        return $data?->dealer ?? null;
    }

    private function buildConversations(int $authId): \Illuminate\Support\Collection
    {
        $groups = Chat::selectRaw('client_id, user_id, inventory_id, MAX(created_at) as latest_at')
            ->where(function ($q) use ($authId) {
                $q->where('client_id', $authId)
                  ->orWhere('user_id', $authId);
            })
            ->groupBy('client_id', 'user_id', 'inventory_id')
            ->orderByDesc('latest_at')
            ->get();

        return $groups->map(function ($group) use ($authId) {
            $latestMessage = Chat::where('client_id', $group->client_id)
                ->where('user_id', $group->user_id)
                ->where('inventory_id', $group->inventory_id)
                ->orderByDesc('created_at')
                ->first();

            // Determine conversation source from the latest message's source column
            $source = $latestMessage?->source ?? 'motokloz';

            $unreadCount = Chat::where('client_id', $group->client_id)
                ->where('user_id', $group->user_id)
                ->where('inventory_id', $group->inventory_id)
                ->where('is_read', 0)
                ->where(function ($q) use ($authId, $group) {
                    if ($authId == $group->client_id) {
                        $q->where('sender_type', 'dealer');
                    } else {
                        $q->where('sender_type', 'client');
                    }
                })
                ->count();

            $otherPartyId = ($authId == $group->client_id) ? $group->user_id : $group->client_id;
            $otherParty   = User::with('information')->find($otherPartyId);
            $inventory    = Inventory::find($group->inventory_id);

            // Only call Diskloz API for diskloz conversations OR when otherParty not found locally
            $dealerInfo = null;
            $apiData    = null;
            if ($source === 'diskloz' || (!$otherParty && $authId == $group->client_id)) {
                $apiData = $this->getInventoryFromApi($group->inventory_id);

                if ($authId == $group->client_id) {
                    $dealerInfo = $apiData?->dealer ?? null;
                }

                // Use API inventory if local not found
                if (!$inventory && $apiData) {
                    $inventory = $apiData;
                }
            }

            return [
                'client_id'      => $group->client_id,
                'user_id'        => $group->user_id,
                'inventory_id'   => $group->inventory_id,
                'latest_message' => $latestMessage,
                'unread_count'   => $unreadCount,
                'other_party'    => $otherParty,
                'dealer_info'    => $dealerInfo,
                'inventory'      => $inventory,
                'latest_at'      => $group->latest_at,
                'source'         => $source,
            ];
        })->sortByDesc('latest_at')->values();
    }

    /**
     * GET /chat
     */
    public function index()
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();
    
        $authId = Auth::id();
        $conversations = $this->buildConversations($authId);
        

        return view('chat', [
            'conversations'      => $conversations,
            'activeConversation' => null,
            'user'               => $user,
            'userInfo'           => $userInfo,
        ]);
    }

    /**
     * POST /chat/start
     * Auth user (buyer) se conversation shuru karo ya existing pe redirect karo
     */
    public function startOrGet(Request $request)
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();

        $request->validate([
            'inventory_id' => 'required|integer',
            'dealer_id'    => 'required|integer',
            'source'       => 'nullable|in:motokloz,diskloz',
        ]);

        $authId      = Auth::id();
        $dealerId    = (int) $request->dealer_id;
        $inventoryId = (int) $request->inventory_id;
        $source      = $request->input('source', 'motokloz');

        // Validate source — agar 'motokloz' hai lekin dealer Motokloz user nahi toh 'diskloz' karo
        if ($source === 'motokloz') {
            $motoklozUser = \App\Models\User::find($dealerId);
            if (!$motoklozUser) {
                $source = 'diskloz';
            }
        }

        // Store source in session for sendMessage to use
        session(["chat_source_{$authId}_{$dealerId}_{$inventoryId}" => $source]);

        // Exist kare ya na kare — sirf redirect karo (pehla message user bhejega)
        return redirect()->route('chat.show', [$authId, $dealerId, $inventoryId,$user,$userInfo]);
    }     

    /**
     * GET /chat/{clientId}/{dealerId}/{inventoryId}
     * Conversation ke saare messages + inventory context
     */
    public function show(int $clientId, int $dealerId, int $inventoryId)
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();
        $authId = Auth::id();

        // Authorization check
        if ($authId !== $clientId && $authId !== $dealerId) {
            abort(403);
        }

        // Saare messages fetch karo
        $messages = Chat::where('client_id', $clientId)
            ->where('user_id', $dealerId)
            ->where('inventory_id', $inventoryId)
            ->orderBy('created_at')
            ->get();

        // Inventory context — Diskloz API se fetch karo
        $apiData   = $this->getInventoryFromApi($inventoryId);
        $inventory = $apiData ?? Inventory::find($inventoryId); // fallback to DB

        // Dealer info from API (already fetched above)
        $dealerInfo = ($authId === $clientId) ? ($apiData?->dealer ?? null) : null;

        // Other party info
        $otherPartyId = ($authId === $clientId) ? $dealerId : $clientId;
        $otherParty   = User::with('information')->find($otherPartyId);

        // Auth user ka sender_type
        $senderType = ($authId === $clientId) ? 'client' : 'dealer';

        // Mark messages as read: opposite sender ke messages
        Chat::where('client_id', $clientId)
            ->where('user_id', $dealerId)
            ->where('inventory_id', $inventoryId)
            ->where('is_read', 0)
            ->where('sender_type', '!=', $senderType)
            ->update(['is_read' => 1]);

        // Diskloz conversation: buyer ne kholwa — Diskloz ko mark-read call karo
        // Taake dealer ke side per Motokloz buyer ka message seen show ho
        $convSource = session("chat_source_{$clientId}_{$dealerId}_{$inventoryId}");
        if (!$convSource) {
            $convSource = Chat::where('client_id', $clientId)
                ->where('user_id', $dealerId)
                ->where('inventory_id', $inventoryId)
                ->orderByDesc('id')->value('source') ?? 'motokloz';
        }
        if ($convSource === 'diskloz' && $authId === $clientId) {
            try {
                app(\App\Services\DisklozChatService::class)->markRead(Auth::user()->email, $inventoryId);
            } catch (\Exception $e) {}
        }

        // Left panel ke liye conversations
        $conversations = $this->buildConversations($authId);

        $activeConversation = [
            'client_id'    => $clientId,
            'user_id'      => $dealerId,
            'inventory_id' => $inventoryId,
            'other_party'  => $otherParty,
            'dealer_info'  => $dealerInfo,
            'inventory'    => $inventory,
            'sender_type'  => $senderType,
        ];

        return view('chat', [
            'conversations'      => $conversations,
            'activeConversation' => $activeConversation,
            'messages'           => $messages,
            'inventory'          => $inventory,
            'clientId'           => $clientId,
            'dealerId'           => $dealerId,
            'inventoryId'        => $inventoryId,
            'user'               => $user,
            'userInfo'           => $userInfo,
        ]);
    }

    /**
     * POST /chat/{clientId}/{dealerId}/{inventoryId}/send
     * Naya message insert karo aur JSON return karo
     */
    public function sendMessage(Request $request, int $clientId, int $dealerId, int $inventoryId)
    {
        $authId = Auth::id();

        if ($authId !== $clientId && $authId !== $dealerId) {
            abort(403);
        }

        $request->validate([
            'message_body' => 'required|string|max:2000',
        ]);

        $body = trim($request->message_body);
        if ($body === '') {
            return response()->json([
                'errors' => ['message_body' => ['Message body cannot be empty or whitespace only.']]
            ], 422);
        }

        $senderType = ($authId === $clientId) ? 'client' : 'dealer';

        // Read conversation source from session
        // Fallback: check local chats table, then Diskloz API
        $conversationSource = session("chat_source_{$clientId}_{$dealerId}_{$inventoryId}");
        \Illuminate\Support\Facades\Log::info('Chat source debug', [
            'session_key'   => "chat_source_{$clientId}_{$dealerId}_{$inventoryId}",
            'session_value' => $conversationSource,
            'clientId'      => $clientId,
            'dealerId'      => $dealerId,
            'inventoryId'   => $inventoryId,
        ]);
        if (!$conversationSource) {
            // Check existing chats for this conversation
            $existingChat = Chat::where('client_id', $clientId)
                ->where('user_id', $dealerId)
                ->where('inventory_id', $inventoryId)
                ->orderByDesc('id')->first();

            if ($existingChat && $existingChat->source) {
                $conversationSource = $existingChat->source;
            } else {
                // Fallback: check Diskloz API inventory source
                $apiData = $this->getInventoryFromApi($inventoryId);
                $apiSource = strtolower($apiData?->source ?? '');

                if (in_array($apiSource, ['motokloz', 'diskloz'])) {
                    $conversationSource = $apiSource;
                } else {
                    // Final fallback: check if dealer is a Motokloz user
                    $motoklozUser = \App\Models\User::find($dealerId);
                    $conversationSource = $motoklozUser ? 'motokloz' : 'diskloz';
                }
            }

            // Store in session for subsequent messages
            session(["chat_source_{$clientId}_{$dealerId}_{$inventoryId}" => $conversationSource]);
        }

        if ($conversationSource === 'diskloz') {
            // Build buyer profile image URL
            $user = Auth::user();
            $buyerAvatar = null;
            if ($user->information && $user->information->avatar) {
                $av = $user->information->avatar;
                if (str_starts_with($av, 'http')) {
                    $buyerAvatar = $av;
                } elseif (str_starts_with($av, 'uploads/') || str_starts_with($av, 'avatars/')) {
                    $buyerAvatar = url('storage/' . $av);
                }
            }

            // Store local copy FIRST — instant response ke liye
            $chat = Chat::create([
                'client_id'    => $clientId,
                'user_id'      => $dealerId,
                'inventory_id' => $inventoryId,
                'message_body' => $body,
                'sender_type'  => $senderType,
                'source'       => 'diskloz',
                'is_read'      => 0,
                'time'         => now(),
            ]);

            // Diskloz API ko directly forward karo
            $buyerName  = Auth::user()->name;
            $buyerEmail = Auth::user()->email;
            \Illuminate\Support\Facades\Log::info('Diskloz forward attempt', [
                'inventory_id' => $inventoryId,
                'buyer_email'  => $buyerEmail,
                'buyer_name'   => $buyerName,
                'source'       => $conversationSource,
            ]);
            try {
                $result = app(\App\Services\DisklozChatService::class)->forwardMessage(
                    $buyerName, $buyerEmail, $inventoryId, $body, $buyerAvatar
                );
                \Illuminate\Support\Facades\Log::info('Diskloz forward result', $result);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Diskloz forward failed', ['chat_id' => $chat->id, 'error' => $e->getMessage()]);
            }
        } else {
            // Motokloz flow: existing logic with source='motokloz'
            $chat = Chat::create([
                'client_id'    => $clientId,
                'user_id'      => $dealerId,
                'inventory_id' => $inventoryId,
                'message_body' => $body,
                'sender_type'  => $senderType,
                'source'       => 'motokloz',
                'is_read'      => 0,
                'time'         => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => [
                'id'           => $chat->id,
                'message_body' => $chat->message_body,
                'sender_type'  => $chat->sender_type,
                'created_at'   => $chat->created_at,
                'is_mine'      => true,
            ],
        ]);
    }

    /**
     * GET /chat/{clientId}/{dealerId}/{inventoryId}/poll
     * Last message id ke baad ke naye messages return karo
     * Diskloz conversations ke liye dealer replies bhi Diskloz API se fetch karo
     */
    public function pollMessages(Request $request, int $clientId, int $dealerId, int $inventoryId)
    {
        $authId = Auth::id();

        if ($authId !== $clientId && $authId !== $dealerId) {
            abort(403);
        }

        $after      = (int) $request->query('after', 0);
        $senderType = ($authId === $clientId) ? 'client' : 'dealer';

        // Check if this is a Diskloz conversation
        $conversationSource = session("chat_source_{$clientId}_{$dealerId}_{$inventoryId}");
        if (!$conversationSource) {
            $latestMsg = Chat::where('client_id', $clientId)
                ->where('user_id', $dealerId)
                ->where('inventory_id', $inventoryId)
                ->orderByDesc('id')->first();
            $conversationSource = $latestMsg?->source ?? 'motokloz';
        }

        // For Diskloz conversations: fetch dealer replies from Diskloz API and store locally
        if ($conversationSource === 'diskloz' && $authId === $clientId) {
            $buyerEmail = Auth::user()->email;
            // Track last synced Diskloz reply ID in session
            $sessionKey   = "diskloz_last_reply_{$clientId}_{$inventoryId}";
            $afterDiskloz = (int) session($sessionKey, 0);

            try {
                $resp = Http::timeout(5)->get(
                    $this->disklozBaseUrl() . '/api/chat/replies',
                    ['inventory_id' => $inventoryId, 'buyer_email' => $buyerEmail, 'after_id' => $afterDiskloz]
                );

                if ($resp->ok()) {
                    $data = $resp->json();
                    $hasNewReplies = false;
                    foreach ($data['messages'] ?? [] as $reply) {
                        // Only process dealer messages — skip client messages
                        if (($reply['message_by'] ?? 'dealer') !== 'dealer') {
                            continue;
                        }

                        // Store dealer reply locally if not already stored
                        $exists = Chat::where('client_id', $clientId)
                            ->where('user_id', $dealerId)
                            ->where('inventory_id', $inventoryId)
                            ->where('sender_type', 'dealer')
                            ->where('diskloz_reply_id', $reply['id'])
                            ->exists();

                        if (!$exists) {
                            Chat::create([
                                'client_id'        => $clientId,
                                'user_id'          => $dealerId,
                                'inventory_id'     => $inventoryId,
                                'message_body'     => $reply['message_body'],
                                'sender_type'      => 'dealer',
                                'source'           => 'diskloz',
                                'is_read'          => 0,
                                'diskloz_reply_id' => $reply['id'],
                                'time'             => $reply['time'] ?? now(),
                            ]);
                            $hasNewReplies = true;
                        }

                        // Update last synced ID
                        if ($reply['id'] > $afterDiskloz) {
                            $afterDiskloz = $reply['id'];
                        }
                    }

                    // Dealer ne reply kiya → buyer ke sent messages seen mark karo
                    if ($hasNewReplies) {
                        Chat::where('client_id', $clientId)
                            ->where('user_id', $dealerId)
                            ->where('inventory_id', $inventoryId)
                            ->where('sender_type', 'client')
                            ->where('is_read', 0)
                            ->update(['is_read' => 1]);
                    }

                    session([$sessionKey => $afterDiskloz]);
                }
            } catch (\Exception $e) {
                // Silently fail — local messages still returned
            }
        }

        // Fetch all new local messages (includes newly stored Diskloz replies)
        $messages = Chat::where('client_id', $clientId)
            ->where('user_id', $dealerId)
            ->where('inventory_id', $inventoryId)
            ->where('id', '>', $after)
            ->orderBy('created_at')
            ->get();

        // Mark opposite sender messages as read
        Chat::where('client_id', $clientId)
            ->where('user_id', $dealerId)
            ->where('inventory_id', $inventoryId)
            ->where('sender_type', '!=', $senderType)
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

        $formatted = $messages->map(function ($msg) use ($senderType) {
            return [
                'id'           => $msg->id,
                'message_body' => $msg->message_body,
                'sender_type'  => $msg->sender_type,
                'created_at'   => $msg->created_at,
                'is_mine'      => $msg->sender_type === $senderType,
            ];
        });

        return response()->json(['messages' => $formatted, 'unread_count' => 0]);
    }

    /**
     * GET /chat/{clientId}/{dealerId}/{inventoryId}/tick-status
     * Sender ke messages ka latest is_read status return karo (for tick updates)
     */
    public function tickStatus(Request $request, int $clientId, int $dealerId, int $inventoryId)
    {
        $authId = Auth::id();
        if ($authId !== $clientId && $authId !== $dealerId) {
            abort(403);
        }

        $senderType = ($authId === $clientId) ? 'client' : 'dealer';
        $after = (int) $request->query('after', 0);

        // Check if this is a Diskloz conversation
        $conversationSource = session("chat_source_{$clientId}_{$dealerId}_{$inventoryId}");
        if (!$conversationSource) {
            $latestMsg = Chat::where('client_id', $clientId)
                ->where('user_id', $dealerId)
                ->where('inventory_id', $inventoryId)
                ->orderByDesc('id')->first();
            $conversationSource = $latestMsg?->source ?? 'motokloz';
        }

        // Diskloz conversation: fetch read status from Diskloz API and update local records
        if ($conversationSource === 'diskloz' && $authId === $clientId) {
            try {
                $resp = Http::timeout(5)->get(
                    $this->disklozBaseUrl() . '/api/chat/read-status',
                    ['inventory_id' => $inventoryId, 'buyer_email' => Auth::user()->email]
                );
                if ($resp->ok()) {
                    $data = $resp->json();
                    // Only mark as read if read_count equals or exceeds total_client_messages
                    // This means ALL client messages have been read by dealer
                    $readCount  = (int) ($data['read_count'] ?? 0);
                    $totalCount = (int) ($data['total_client_messages'] ?? 0);
                    if ($totalCount > 0 && $readCount >= $totalCount) {
                        // Mark only unread buyer messages as read
                        Chat::where('client_id', $clientId)
                            ->where('user_id', $dealerId)
                            ->where('inventory_id', $inventoryId)
                            ->where('sender_type', 'client')
                            ->where('is_read', 0)
                            ->update(['is_read' => 1]);
                    }
                }
            } catch (\Exception $e) {}
        }

        // Return read message IDs (same logic for both Motokloz and Diskloz)
        $readIds = Chat::where('client_id', $clientId)
            ->where('user_id', $dealerId)
            ->where('inventory_id', $inventoryId)
            ->where('sender_type', $senderType)
            ->where('is_read', 1)
            ->where('id', '>', $after)
            ->pluck('id');

        // For Diskloz conversations: return read_count/total from LOCAL DB (already synced)
        $disklozReadCount    = null;
        $totalClientMessages = null;
        if ($conversationSource === 'diskloz') {
            $totalClientMessages = Chat::where('client_id', $clientId)
                ->where('user_id', $dealerId)
                ->where('inventory_id', $inventoryId)
                ->where('sender_type', 'client')
                ->count();
            $disklozReadCount = Chat::where('client_id', $clientId)
                ->where('user_id', $dealerId)
                ->where('inventory_id', $inventoryId)
                ->where('sender_type', 'client')
                ->where('is_read', 1)
                ->count();
        }

        return response()->json([
            'read_ids'              => $readIds,
            'delivered_ids'         => $readIds,
            'read_count'            => $disklozReadCount,
            'total_client_messages' => $totalClientMessages,
        ]);
    }
    public function deleteMessage(int $id)
    {
        $authId = Auth::id();
        $msg = Chat::find($id);

        if (!$msg) return response()->json(['success' => false], 404);

        $isSender = ($msg->sender_type === 'client' && (int)$msg->client_id === (int)$authId)
                 || ($msg->sender_type === 'dealer' && (int)$msg->user_id === (int)$authId)
                 || ((int)$msg->client_id === (int)$authId)  // fallback: client always owns their messages
                 || ((int)$msg->user_id === (int)$authId);   // fallback: dealer always owns their messages

        if (!$isSender) return response()->json(['success' => false, 'message' => 'Forbidden'], 403);

        $msg->delete();
        return response()->json(['success' => true]);
    }

    public function editMessage(Request $request, int $id)
    {
        $authId = Auth::id();
        $msg = Chat::find($id);

        if (!$msg) return response()->json(['success' => false], 404);

        $isSender = ($msg->sender_type === 'client' && (int)$msg->client_id === (int)$authId)
                 || ($msg->sender_type === 'dealer' && (int)$msg->user_id === (int)$authId)
                 || ((int)$msg->client_id === (int)$authId)
                 || ((int)$msg->user_id === (int)$authId);

        if (!$isSender) return response()->json(['success' => false, 'message' => 'Forbidden'], 403);

        $request->validate(['message_body' => 'required|string|max:2000']);
        $msg->update(['message_body' => trim($request->message_body)]);

        return response()->json(['success' => true, 'message_body' => $msg->message_body]);
    }

    public function conversationsUnread()
    {
        $authId = Auth::id();
        if (!$authId) return response()->json([]);

        // Sirf local DB se count karo — Diskloz replies unreadCount endpoint store karta hai
        $groups = Chat::selectRaw('client_id, user_id, inventory_id, COUNT(*) as unread')
            ->where('is_read', 0)
            ->where(function ($q) use ($authId) {
                $q->where(function ($q2) use ($authId) {
                    $q2->where('client_id', $authId)->where('sender_type', 'dealer');
                })->orWhere(function ($q2) use ($authId) {
                    $q2->where('user_id', $authId)->where('sender_type', 'client');
                });
            })
            ->groupBy('client_id', 'user_id', 'inventory_id')
            ->get();

        $result = [];
        foreach ($groups as $g) {
            $key = $g->client_id . '-' . $g->user_id . '-' . $g->inventory_id;
            $result[$key] = $g->unread;
        }

        return response()->json($result);
    }

    public function unreadCount()
    {
        $authId = Auth::id();
        if (!$authId) {
            return response()->json(['count' => 0]);
        }

        // Diskloz conversations ke liye: background mein replies fetch karo aur store karo
        $disklozConvs = Chat::where('client_id', $authId)
            ->where('source', 'diskloz')
            ->selectRaw('client_id, user_id, inventory_id')
            ->groupBy('client_id', 'user_id', 'inventory_id')
            ->get();

        foreach ($disklozConvs as $conv) {
            $buyerEmail   = \App\Models\User::find($authId)?->email;
            if (!$buyerEmail) continue;

            $sessionKey   = "diskloz_last_reply_{$authId}_{$conv->inventory_id}";
            $afterDiskloz = (int) session($sessionKey, 0);

            try {
                $resp = Http::timeout(3)->get(
                    $this->disklozBaseUrl() . '/api/chat/replies',
                    ['inventory_id' => $conv->inventory_id, 'buyer_email' => $buyerEmail, 'after_id' => $afterDiskloz]
                );
                if ($resp->ok()) {
                    $data = $resp->json();
                    foreach ($data['messages'] ?? [] as $reply) {
                        if (($reply['message_by'] ?? '') !== 'dealer') continue;
                        $exists = Chat::where('client_id', $authId)
                            ->where('user_id', $conv->user_id)
                            ->where('inventory_id', $conv->inventory_id)
                            ->where('diskloz_reply_id', $reply['id'])
                            ->exists();
                        if (!$exists) {
                            Chat::create([
                                'client_id'        => $authId,
                                'user_id'          => $conv->user_id,
                                'inventory_id'     => $conv->inventory_id,
                                'message_body'     => $reply['message_body'],
                                'sender_type'      => 'dealer',
                                'source'           => 'diskloz',
                                'is_read'          => 0,
                                'diskloz_reply_id' => $reply['id'],
                                'time'             => $reply['time'] ?? now(),
                            ]);
                        }
                        if ($reply['id'] > $afterDiskloz) $afterDiskloz = $reply['id'];
                    }
                    session([$sessionKey => $afterDiskloz]);
                }
            } catch (\Exception $e) {}
        }

        // Messages sent TO this user that are unread
        $asClient = Chat::where('client_id', $authId)
            ->where('sender_type', 'dealer')
            ->where('is_read', 0)
            ->count();

        $asDealer = Chat::where('user_id', $authId)
            ->where('sender_type', 'client')
            ->where('is_read', 0)
            ->count();

        // Per-conversation breakdown for sidebar badges
        $convGroups = Chat::selectRaw('client_id, user_id, inventory_id, COUNT(*) as unread')
            ->where('is_read', 0)
            ->where(function ($q) use ($authId) {
                $q->where(function ($q2) use ($authId) {
                    $q2->where('client_id', $authId)->where('sender_type', 'dealer');
                })->orWhere(function ($q2) use ($authId) {
                    $q2->where('user_id', $authId)->where('sender_type', 'client');
                });
            })
            ->groupBy('client_id', 'user_id', 'inventory_id')
            ->get();

        $conversations = [];
        foreach ($convGroups as $g) {
            $key = $g->client_id . '-' . $g->user_id . '-' . $g->inventory_id;
            $conversations[$key] = $g->unread;
        }

        return response()->json([
            'count'         => $asClient + $asDealer,
            'conversations' => $conversations,
        ]);
    }

    public function markRead(int $clientId, int $dealerId, int $inventoryId)
    {
        $authId = Auth::id();

        if ($authId !== $clientId && $authId !== $dealerId) {
            abort(403);
        }

        $senderType = ($authId === $clientId) ? 'client' : 'dealer';

        Chat::where('client_id', $clientId)
            ->where('user_id', $dealerId)
            ->where('inventory_id', $inventoryId)
            ->where('sender_type', '!=', $senderType)
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

        return response()->json(['success' => true]);
    }
}
