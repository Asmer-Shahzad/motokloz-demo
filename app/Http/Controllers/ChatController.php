<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Inventory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

            // Dealer info from Diskloz API (only when other party is dealer)
            $dealerInfo = null;
            $apiData = $this->getInventoryFromApi($group->inventory_id);

            if ($authId == $group->client_id) {
                $dealerInfo = $apiData?->dealer ?? null;
            }

            // Use API inventory if local not found (covers both buyer and dealer views)
            if (!$inventory && $apiData) {
                $inventory = $apiData;
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
            ];
        })->sortByDesc('latest_at')->values();
    }

    /**
     * GET /chat
     */
    public function index()
    {
        $authId = Auth::id();
        $conversations = $this->buildConversations($authId);

        return view('chat', [
            'conversations'      => $conversations,
            'activeConversation' => null,
        ]);
    }

    /**
     * POST /chat/start
     * Auth user (buyer) se conversation shuru karo ya existing pe redirect karo
     */
    public function startOrGet(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|integer',
            'dealer_id'    => 'required|integer',
        ]);

        $authId      = Auth::id();
        $dealerId    = (int) $request->dealer_id;
        $inventoryId = (int) $request->inventory_id;

        // Check karo: koi bhi chat row exist karta hai is combination ke liye
        $exists = Chat::where('client_id', $authId)
            ->where('user_id', $dealerId)
            ->where('inventory_id', $inventoryId)
            ->exists();

        // Exist kare ya na kare — sirf redirect karo (pehla message user bhejega)
        return redirect()->route('chat.show', [$authId, $dealerId, $inventoryId]);
    }     

    /**
     * GET /chat/{clientId}/{dealerId}/{inventoryId}
     * Conversation ke saare messages + inventory context
     */
    public function show(int $clientId, int $dealerId, int $inventoryId)
    {
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

        $chat = Chat::create([
            'client_id'    => $clientId,
            'user_id'      => $dealerId,
            'inventory_id' => $inventoryId,
            'message_body' => $body,
            'sender_type'  => $senderType,
            'is_read'      => 0,
            'time'         => now(),
        ]);

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
     */
    public function pollMessages(Request $request, int $clientId, int $dealerId, int $inventoryId)
    {
        $authId = Auth::id();

        if ($authId !== $clientId && $authId !== $dealerId) {
            abort(403);
        }

        $after = (int) $request->query('after', 0);

        $senderType = ($authId === $clientId) ? 'client' : 'dealer';

        $messages = Chat::where('client_id', $clientId)
            ->where('user_id', $dealerId)
            ->where('inventory_id', $inventoryId)
            ->where('id', '>', $after)
            ->orderBy('created_at')
            ->get();

        // Mark fetched messages from opposite sender as read
        if ($messages->isNotEmpty()) {
            Chat::where('client_id', $clientId)
                ->where('user_id', $dealerId)
                ->where('inventory_id', $inventoryId)
                ->where('id', '>', $after)
                ->where('sender_type', '!=', $senderType)
                ->where('is_read', 0)
                ->update(['is_read' => 1]);
        }

        $formatted = $messages->map(function ($msg) use ($senderType) {
            return [
                'id'           => $msg->id,
                'message_body' => $msg->message_body,
                'sender_type'  => $msg->sender_type,
                'created_at'   => $msg->created_at,
                'is_mine'      => $msg->sender_type === $senderType,
            ];
        });

        return response()->json(['messages' => $formatted]);
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

        // Auth user ke bheje messages jo ab read ho gaye hain
        $readIds = Chat::where('client_id', $clientId)
            ->where('user_id', $dealerId)
            ->where('inventory_id', $inventoryId)
            ->where('sender_type', $senderType)
            ->where('is_read', 1)
            ->where('id', '>', $after)
            ->pluck('id');

        return response()->json(['read_ids' => $readIds]);
    }
    public function unreadCount()
    {
        $authId = Auth::id();
        if (!$authId) {
            return response()->json(['count' => 0]);
        }

        // Count unread messages received by this user
        // As client: messages where sender_type = 'dealer' and client_id = authId
        // As dealer: messages where sender_type = 'client' and user_id = authId
        $count = Chat::where('is_read', 0)
            ->where(function ($q) use ($authId) {
                $q->where(function ($q2) use ($authId) {
                    $q2->where('client_id', $authId)->where('sender_type', 'dealer');
                })->orWhere(function ($q2) use ($authId) {
                    $q2->where('user_id', $authId)->where('sender_type', 'client');
                });
            })
            ->count();

        return response()->json(['count' => $count]);
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
