@extends('layouts.app')

@section('body-attrs') data-no-loader="1" @endsection

@section('content')

    <div class="top-back">
        <a href="{{ route('chat.index') }}" class="dashboard-back">
            <span class="back-icon">
                <img src="/assets/images/Carento (5).png" alt="Back">
            </span>
            <span class="back-text">Go back to dashboard</span>
        </a>
    </div>

    <section class="main-chat">
        <div class="chat-wrapper">

            <!-- ========== LEFT SIDEBAR ========== -->
            <div class="chat-sidebar">
                <div class="sidebar-header">
                    <h3 class="sidebar-head">Conversations</h3>
                    <div class="sidebar-icons"></div>
                </div>

                <!-- Search Bar (hidden by default) -->
                <div class="search-bar-container" style="display: none; padding: 10px 20px;">
                    <div style="position: relative;">
                        <input type="text" class="search-input" placeholder="Search conversations..."
                            style="width: 100%; padding: 10px 40px 10px 16px; border-radius: 30px; border: 1px solid #E6EBF5; background: #F5F7FA; font-size: 15px;">
                        <span class="search-close"
                            style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 18px; color: #7D8592;">&times;</span>
                    </div>
                </div>

                <!-- Chat list with scroll -->
                <div class="chat-list scrol-bar">
                    @if($conversations->isEmpty())
                        <div style="padding: 40px 20px; text-align: center; color: #91929E;">
                            <p style="font-size: 16px; font-weight: 600;">No conversations yet.</p>
                            <p style="font-size: 14px; margin-top: 8px;">Start a chat from a car listing.</p>
                        </div>
                    @else
                        @foreach($conversations as $conv)
                            @php
                                $isActive = $activeConversation &&
                                    $activeConversation['client_id'] == $conv['client_id'] &&
                                    $activeConversation['user_id'] == $conv['user_id'] &&
                                    $activeConversation['inventory_id'] == $conv['inventory_id'];
                                $convInv = $conv['inventory'];
                                $convTitle = 'Vehicle';
                                if ($convInv) {
                                    $convTitle = trim(collect([
                                        $convInv->title ?? null,
                                        $convInv->year ?? null,
                                        $convInv->mfg_auto ?? null,
                                        $convInv->model ?? null,
                                    ])->filter()->implode(' ')) ?: ($convInv->model ?? 'Vehicle');
                                }
                                $preview = $conv['latest_message'] ? \Illuminate\Support\Str::limit($conv['latest_message']->message_body, 40) : 'No messages yet';
                                $timeLabel = $conv['latest_at'] ? \Carbon\Carbon::parse($conv['latest_at'])->format('Y-m-d H:i:s') : '';
                                $op = $conv['other_party'];
                                $dealerInfo = $conv['dealer_info'] ?? null;
                                $opName = $dealerInfo?->legal_name
                                    ?: $op?->information?->full_name
                                    ?: $op?->name
                                    ?: 'Unknown';
                                $rawLogo = $dealerInfo?->logo ?? null;
                                $disklozBase = rtrim(config('services.diskloz.base_url', ''), '/');
                                if ($rawLogo) {
                                    $opAvatar = str_starts_with($rawLogo, 'http')
                                        ? $rawLogo
                                        : ($disklozBase . '/admin_assets/images/dealer_images/' . $rawLogo);
                                } elseif ($op?->information?->avatar) {
                                    $av = $op->information->avatar;
                                    $opAvatar = str_starts_with($av, 'http')
                                        ? $av
                                        : (str_starts_with($av, 'uploads/') || str_starts_with($av, 'avatars/')
                                            ? asset('storage/' . $av)
                                            : $av);
                                } else {
                                    $opAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($opName) . '&background=F58D02&color=fff&size=48';
                                }
                                
                                // ✅ FIXED: Dealer profile URL with slug
                                $otherPartyId = $conv['user_id']; // dealer is always user_id
                                $isMotoklozDealer = !$dealerInfo && $op;
                                
                                // Create slug from dealer name
                                $dealerSlug = preg_replace('/[^a-z0-9]+/', '-', strtolower($opName));
                                $dealerSlug = trim($dealerSlug, '-');
                                
                                $dealerProfileUrl = $isMotoklozDealer
                                    ? route('dealer_inventory_details', ['name' => $dealerSlug, 'id' => $otherPartyId, 'source' => 'motokloz'])
                                    : route('dealer_inventory_details', ['name' => $dealerSlug, 'id' => $otherPartyId]);
                                
                                // Inventory detail URL
                                $invDetailUrl = route('inventory_product_details', $conv['inventory_id']);
                            @endphp
                            <a href="{{ route('chat.show', [$conv['client_id'], $conv['user_id'], $conv['inventory_id']]) }}"
                               class="chat-item {{ $isActive ? 'active' : '' }}"
                               data-conv="{{ $conv['client_id'] }}-{{ $conv['user_id'] }}-{{ $conv['inventory_id'] }}"
                               style="text-decoration: none; color: inherit; display: flex; align-items: center; padding: 14px 18px; gap: 12px; cursor: pointer; transition: all 0.2s ease; margin-bottom: 4px; border-radius: 16px;">
                                <img src="{{ $opAvatar }}" alt="{{ $opName }}"
                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($opName) }}&background=F58D02&color=fff&size=48'"
                                     onclick="event.preventDefault(); event.stopPropagation(); window.location='{{ $dealerProfileUrl }}';"
                                     style="width:48px; height:48px; border-radius:50%; object-fit:cover; cursor:pointer; flex-shrink:0;">
                                <div style="flex: 1; min-width: 0;">
                                    <h6 class="chat-heading" style="display:flex; align-items:baseline; gap:4px; white-space:nowrap; overflow:hidden; margin:0;">
                                        <span onclick="event.preventDefault(); event.stopPropagation(); window.location='{{ $dealerProfileUrl }}';"
                                              style="flex-shrink:0; max-width:55%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; cursor:pointer; font-weight:700;">{{ $opName }}</span>
                                        <span onclick="event.preventDefault(); event.stopPropagation(); window.location='{{ $invDetailUrl }}';"
                                              style="font-weight:400; font-size:12px; color:#91929E; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; cursor:pointer;">({{ $convTitle }})</span>
                                    </h6>
                                    <p class="chat-paragraph">{{ $preview }}</p>
                                </div>
                                <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 4px; flex-shrink: 0;">
                                    <span class="chat-time" data-utc="{{ $timeLabel }}"></span>
                                    @if($conv['unread_count'] > 0)
                                        <span class="conv-unread-badge" data-conv="{{ $conv['client_id'] }}-{{ $conv['user_id'] }}-{{ $conv['inventory_id'] }}" style="background: #F58D02; color: #fff; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700;">{{ $conv['unread_count'] }}</span>
                                    @else
                                        <span class="conv-unread-badge" data-conv="{{ $conv['client_id'] }}-{{ $conv['user_id'] }}-{{ $conv['inventory_id'] }}" style="display:none; background: #F58D02; color: #fff; border-radius: 50%; width: 20px; height: 20px; align-items: center; justify-content: center; font-size: 11px; font-weight: 700;"></span>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- ========== RIGHT CHAT AREA ========== -->
            <div class="chat-content">
                @if(!$activeConversation)
                    <!-- No active conversation placeholder -->
                    <div style="flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #91929E;">
                        <!-- <img src="/assets/images/Carento (5).png" alt="" style="width: 80px; opacity: 0.3; margin-bottom: 20px;"> -->
                         <i style="font-size: 128px; color: #91929E;" class="fa-solid fa-message"></i>
                         <br>
                        <h5 style="font-size: 20px; font-weight: 700; color: #7D8592;">Select a conversation</h5>
                        <p style="font-size: 15px; margin-top: 8px;">Choose a chat from the left panel to start messaging.</p>
                    </div>
                @else
                    {{-- Active conversation --}}
                    @php
                        function tickSvg(string $type): string {
                            if ($type === 'seen') {
                                // Double black tick (seen/read)
                                return '<div class="msg-ticks-inner seen">
                                    <svg width="18" height="11" viewBox="0 0 18 11" fill="none">
                                        <path d="M1 5.5L5.5 10L12 1" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6 5.5L10.5 10L17 1" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>';
                            } elseif ($type === 'delivered') {
                                // Double grey tick (delivered)
                                return '<div class="msg-ticks-inner delivered">
                                    <svg width="18" height="11" viewBox="0 0 18 11" fill="none">
                                        <path d="M1 5.5L5.5 10L12 1" stroke="rgba(255,255,255,0.6)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6 5.5L10.5 10L17 1" stroke="rgba(255,255,255,0.6)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>';
                            } else {
                                // Single grey tick (sent)
                                return '<div class="msg-ticks-inner sent">
                                    <svg width="12" height="10" viewBox="0 0 12 10" fill="none">
                                        <path d="M1 5L4.5 8.5L11 1" stroke="rgba(255,255,255,0.6)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>';
                            }
                        }
                        $inv = $activeConversation['inventory'];
                        $invTitle = 'Vehicle';
                        if ($inv) {
                            $invTitle = trim(collect([
                                $inv->title ?? null,
                                $inv->year ?? null,
                                $inv->mfg_auto ?? null,
                                $inv->model ?? null,
                            ])->filter()->implode(' ')) ?: ($inv->model ?? 'Vehicle');
                        }
                        $invPrice = $inv ? ($inv->price ?? null) : null;
                        $rawImg   = $inv ? ($inv->primary_image ?? null) : null;

                        if ($rawImg && str_starts_with($rawImg, 'http')) {
                            $invImg = $rawImg;
                        } elseif ($rawImg && str_starts_with($rawImg, '/')) {
                            $invImg = rtrim(config('services.diskloz.base_url', ''), '/') . $rawImg;
                        } elseif ($rawImg) {
                            $invImg = rtrim(config('services.diskloz.base_url', ''), '/') . '/admin_assets/images/inventory_images/' . $rawImg;
                        } else {
                            $invImg = asset('assets/images/defaultimage.jpg');
                        }
                        $op = $activeConversation['other_party'];
                        $dealerInfo = $activeConversation['dealer_info'] ?? null;
                        $opName = $dealerInfo?->legal_name
                            ?: $op?->information?->full_name
                            ?: $op?->name
                            ?: 'Unknown';
                        $rawLogo = $dealerInfo?->logo ?? null;
                        $disklozBase = rtrim(config('services.diskloz.base_url', ''), '/');
                        if ($rawLogo) {
                            $opAvatar = str_starts_with($rawLogo, 'http')
                                ? $rawLogo
                                : ($disklozBase . '/admin_assets/images/dealer_images/' . $rawLogo);
                        } elseif ($op?->information?->avatar) {
                            $av = $op->information->avatar;
                            $opAvatar = str_starts_with($av, 'http')
                                ? $av
                                : (str_starts_with($av, 'uploads/') || str_starts_with($av, 'avatars/')
                                    ? asset('storage/' . $av)
                                    : $av);
                        } else {
                            $opAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($opName) . '&background=F58D02&color=fff&size=52';
                        }

                        // Dealer profile & inventory URLs for header
                        $headerDealerId = $activeConversation['user_id'];
                        $headerIsMotokloz = !$dealerInfo && $op;
                        $headerDealerSlug = trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($opName)), '-');
    $headerDealerUrl = $headerIsMotokloz
        ? route('dealer_inventory_details', ['name' => $headerDealerSlug, 'id' => $headerDealerId, 'source' => 'motokloz'])
        : route('dealer_inventory_details', ['name' => $headerDealerSlug, 'id' => $headerDealerId]);
                        $headerInvUrl = route('inventory_product_details', $inventoryId);
                    @endphp

                    <!-- TOP BAR -->
                    <div class="chat-topbar">
                        <div style="display: flex; align-items: center;">
                            <button class="vip-back-btn" onclick="mobileBack()">
                                <span class="back-arrow">&#8592;</span>
                                Back
                            </button>
                            <div class="chat-user">
                                <a href="{{ $headerDealerUrl }}" style="flex-shrink:0;">
                                    <img class="chat-user-img"
                                         src="{{ $opAvatar }}"
                                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($opName) }}&background=F58D02&color=fff&size=52'"
                                         alt="{{ $opName }}">
                                </a>
                                <div>
                                    <h6 class="chat-user-heading" style="display:flex; align-items:baseline; gap:4px; white-space:nowrap; overflow:hidden; max-width:400px;">
                                        <a href="{{ $headerDealerUrl }}" style="flex-shrink:0; max-width:55%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:inherit; text-decoration:none; font-weight:700;">{{ $opName }}</a>
                                        <a href="{{ $headerInvUrl }}" style="font-weight:400; font-size:13px; opacity:0.7; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; text-decoration:none; color:inherit;">({{ $invTitle }})</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="chat-actions">
                            <a href="#"><img src="/assets/images/icon (7).png" alt=""></a>
                            <a href="#"><img src="/assets/images/icon (8).png" alt=""></a>
                        </div>
                    </div>

                    <!-- INVENTORY CONTEXT BAR -->
                    <div class="inv-context-bar">
                        <a href="{{ route('inventory_product_details', $inventoryId) }}" class="inv-context-link">
                            <div class="inv-context-img-wrap">
                                <img src="{{ $invImg }}" alt="{{ $invTitle }}"
                                     onerror="this.src='{{ asset('assets/images/defaultimage.jpg') }}'">
                            </div>
                            <div class="inv-context-info">
                                <div class="inv-context-title">{{ $invTitle }}</div>
                                @if($inv && ($inv->model ?? null))
                                    <div class="inv-context-model">{{ $inv->model }}</div>
                                @endif
                                @if($invPrice)
                                    <div class="inv-context-price">PKR {{ number_format($invPrice) }}</div>
                                @endif
                            </div>
                        </a>
                        <a href="{{ route('inventory_product_details', $inventoryId) }}" class="inv-context-view-btn">
                            View Listing →
                        </a>
                    </div>

                    <!-- MESSAGES AREA -->
                    <div class="chat-messages scrol-bar" id="chatMessagesContainer">
                        <div class="messages-body" id="messagesBody">
                            @forelse($messages as $msg)
                                @php
                                    $isMine = $msg->sender_type === $activeConversation['sender_type'];
                                    $timeStr = \Carbon\Carbon::parse($msg->created_at)->format('Y-m-d H:i:s');
                                @endphp
                                <div class="message {{ $isMine ? 'sent' : 'received' }}" data-id="{{ $msg->id }}">
                                    @if(!$isMine)
                                        <img src="{{ $opAvatar }}"
                                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($opName) }}&background=F58D02&color=fff&size=36'"
                                             class="msg-avatar" alt="{{ $opName }}">
                                    @endif
                                    <div class="msg-content">
                                        <div class="msg-header">
                                            @if(!$isMine)
                                                <span class="msg-name">{{ $activeConversation['other_party']?->information?->full_name ?: ($activeConversation['other_party']?->name ?? 'Unknown') }}</span>
                                            @endif
                                            <span class="msg-time" data-utc="{{ $timeStr }}"></span>
                                        </div>
                                        <div class="msg-text">{{ $msg->message_body }}</div>
                                        @if($isMine)
                                            <div class="msg-ticks" data-msg-id="{{ $msg->id }}" data-status="{{ $msg->is_read ? 'seen' : ($msg->is_delivered ? 'delivered' : 'sent') }}">
                                                @if($msg->is_read)
                                                    {!! tickSvg('seen') !!}
                                                @elseif($msg->is_delivered)
                                                    {!! tickSvg('delivered') !!}
                                                @else
                                                    {!! tickSvg('sent') !!}
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div data-empty style="text-align: center; color: #91929E; padding: 40px 20px;">
                                    <p style="font-size: 15px;">No messages yet. Say hello!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- MESSAGE SEND FORM -->
                    <div class="chat-input-wrapper">
                        <!-- Mention suggestions dropdown -->
                        <div id="mentionDropdown" class="mention-dropdown d-none">
                            <div class="mention-item" data-name="{{ addslashes($opName) }}">
                                <img src="{{ $opAvatar }}" onerror="this.src='{{ asset('assets/images/defaultdealerlogo.png') }}'">
                                <span>{{ $opName }}</span>
                            </div>
                        </div>

                        <!-- Emoji Picker -->
                        <div id="emojiPicker" class="emoji-picker d-none">
                            <div class="emoji-grid">
                                @foreach(['😀','😂','😃','😄','😅','😆','😍','🥰','😎','🤔','😊','😇','🤩','😏','😒','😢','😭','😡','🤬','😱','😴','🤗','😬','🙄','😮','🥳','🎉','😤','🥺','😳',
                                '🚗','🚕','🚙','🚌','🏎','🚓','🚑','🚒','🚐','🛻','🚚','🚛','🚜','🏍','🛵','🚲','🛺','🚁','✈️','🚀','🛸','⛵','🚢','🛥','🚤','🛳','🚂','🚄','🚅','🚆',
                                '👍','👎','👋','🤝','🙏','💪','✌️','🤞','👌','🤙','☝️','👆','👇','👈','👉','✋','🖖','🤜','🤛','👊','✊','🫶','👏','🤲','💅','🤳','🫵','🖐','🤚','🤌',
                                '❤️','🧡','💛','💚','💙','💜','🖤','🤍','💔','🔥','⭐','🌟','✨','💫','🎯','🏆','🥇','💯','✅','❌','⚡','🔔','💰','📞','📧','📱','💬','🔑','🎁','🌈'] as $emoji)
                                    <span class="emoji-item" onclick="insertEmoji('{{ $emoji }}')">{{ $emoji }}</span>
                                @endforeach
                            </div>
                        </div>

                        <form id="chatForm" data-ajax="true" class="chat-input" style="margin: 0;">
                            @csrf
                            <button type="button" id="emojiBtn" class="chat-action-btn" title="Emoji">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/><path d="M8 13s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/>
                                </svg>
                            </button>
                            <div class="input-wrapper" style="flex:1; position:relative;">
                                <input id="messageInput" class="text-input" type="text"
                                       placeholder="Type a message... Use @ to mention"
                                       autocomplete="off">
                            </div>
                            <button type="submit" id="sendBtn" class="send-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" viewBox="0 0 16 16">
                                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11z"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <script>
                    (function () {
                        var CSRF      = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        var sendUrl   = "{{ isset($clientId) ? route('chat.send', [$clientId, $dealerId, $inventoryId]) : '#' }}";
                        var pollUrl   = "{{ isset($clientId) ? route('chat.poll', [$clientId, $dealerId, $inventoryId]) : '#' }}";
                        var tickUrl   = "{{ isset($clientId) ? route('chat.tick', [$clientId, $dealerId, $inventoryId]) : '#' }}";
                        var myType    = "{{ $activeConversation['sender_type'] ?? '' }}";
                        var otherName = "{{ addslashes($opName) }}";
                        var otherAvatar = "{{ addslashes($opAvatar) }}";

                        @php
                            $convSrc = 'motokloz';
                            if (isset($clientId, $dealerId, $inventoryId)) {
                                $convSrc = session("chat_source_{$clientId}_{$dealerId}_{$inventoryId}");
                                if (!$convSrc) {
                                    $convSrc = \App\Models\Chat::where('client_id', $clientId)
                                        ->where('user_id', $dealerId)
                                        ->where('inventory_id', $inventoryId)
                                        ->orderByDesc('id')->value('source') ?? 'motokloz';
                                }
                            }
                        @endphp

                        // Diskloz: jab buyer chat khole — Diskloz ko mark-read call karo (dealer messages seen)
                        @if($convSrc === 'diskloz' && ($activeConversation['sender_type'] ?? '') === 'client')
                        @php $disklozMarkReadUrl = rtrim(config('services.diskloz.base_url', env('DISKLOZ_BASE_URL', env('diskloz_base_url', ''))), '/') . '/api/chat/mark-read'; @endphp
                        (function() {
                            fetch('{{ $disklozMarkReadUrl }}', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({
                                    inventory_id: {{ $inventoryId }},
                                    buyer_email: '{{ addslashes(Auth::user()->email) }}'
                                })
                            }).catch(function() {});
                        })();
                        @endif

                        // Last message id — start from last rendered message
                        var lastId = {{ $messages->isNotEmpty() ? $messages->last()->id : 0 }};

                        var container = document.getElementById('chatMessagesContainer');
                        var body      = document.getElementById('messagesBody');
                        var form      = document.getElementById('chatForm');
                        var input     = document.getElementById('messageInput');
                        var sendBtn   = document.getElementById('sendBtn');

                        function scrollBottom() {
                            if (container) container.scrollTop = container.scrollHeight;
                        }
                        scrollBottom();

                        // Convert all data-utc times to local browser time
                        function convertUtcTimes() {
                            document.querySelectorAll('[data-utc]').forEach(function(el) {
                                var utc = el.getAttribute('data-utc');
                                if (utc) el.textContent = formatTime(utc);
                            });
                        }

                        function formatTime(dateStr) {
                            // Ensure UTC parsing — append Z if not present
                            var str = dateStr.replace(' ', 'T');
                            if (!str.endsWith('Z') && !str.includes('+')) str += 'Z';
                            var d = new Date(str);
                            var h = d.getHours(), m = d.getMinutes();
                            var ampm = h >= 12 ? 'PM' : 'AM';
                            h = h % 12 || 12;
                            return h + ':' + (m < 10 ? '0' + m : m) + ' ' + ampm;
                        }

                        convertUtcTimes();

                        function buildBubble(msg) {
                            var isMine = msg.is_mine;
                            var div = document.createElement('div');
                            div.className = 'message ' + (isMine ? 'sent' : 'received');
                            div.setAttribute('data-id', msg.id);

                            var avatarHtml = isMine ? '' :
                                '<img src="' + otherAvatar + '" class="msg-avatar" alt="" onerror="this.src=\'https://ui-avatars.com/api/?name=' + encodeURIComponent(otherName) + '&background=F58D02&color=fff&size=36\'">';

                            var readTick = isMine ? buildTickHtml('sent') : '';

                            var nameHtml = isMine ? '' :
                                '<span class="msg-name">' + otherName + '</span>';

                            div.innerHTML = avatarHtml +
                                '<div class="msg-content">' +
                                    '<div class="msg-header">' + nameHtml +
                                        '<span class="msg-time" data-utc="' + msg.created_at + '"></span>' +
                                    '</div>' +
                                    '<div class="msg-text">' + formatMessage(msg.message_body) + '</div>' +
                                    (isMine ? '<div class="msg-ticks" data-msg-id="' + msg.id + '" data-status="sent">' + buildTickHtml('sent') + '</div>' : '') +
                                '</div>';
                            return div;
                        }

                        function escapeHtml(str) {
                            return String(str)
                                .replace(/&/g,'&amp;').replace(/</g,'&lt;')
                                .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
                        }

                        function buildTickHtml(status) {
                            if (status === 'seen') {
                                return '<svg width="18" height="11" viewBox="0 0 18 11" fill="none">' +
                                    '<path d="M1 5.5L5.5 10L12 1" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                                    '<path d="M6 5.5L10.5 10L17 1" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                                    '</svg>';
                            } else if (status === 'delivered') {
                                return '<svg width="18" height="11" viewBox="0 0 18 11" fill="none">' +
                                    '<path d="M1 5.5L5.5 10L12 1" stroke="rgba(255,255,255,0.6)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                                    '<path d="M6 5.5L10.5 10L17 1" stroke="rgba(255,255,255,0.6)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                                    '</svg>';
                            } else {
                                return '<svg width="12" height="10" viewBox="0 0 12 10" fill="none">' +
                                    '<path d="M1 5L4.5 8.5L11 1" stroke="rgba(255,255,255,0.6)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                                    '</svg>';
                            }
                        }

                        function formatMessage(str) {
                            return escapeHtml(str).replace(/@(\w[\w\s]*)/g, '<span class="mention-tag">@$1</span>');
                        }

                        // ── EMOJI PICKER ─────────────────────────────────────
                        var emojiBtn    = document.getElementById('emojiBtn');
                        var emojiPicker = document.getElementById('emojiPicker');

                        window.showEmojiTab = function(tab, btn) {
                            document.querySelectorAll('.emoji-grid').forEach(function(g) { g.classList.add('d-none'); });
                            document.querySelectorAll('.emoji-tab').forEach(function(b) { b.classList.remove('active'); });
                            document.getElementById('emoji-' + tab).classList.remove('d-none');
                            btn.classList.add('active');
                        };

                        window.insertEmoji = function(emoji) {
                            var pos = input.selectionStart;
                            var val = input.value;
                            input.value = val.slice(0, pos) + emoji + val.slice(pos);
                            input.focus();
                            input.setSelectionRange(pos + emoji.length, pos + emoji.length);
                            emojiPicker.classList.add('d-none');
                        };

                        if (emojiBtn) {
                            emojiBtn.addEventListener('click', function(e) {
                                e.stopPropagation();
                                emojiPicker.classList.toggle('d-none');
                                mentionDropdown.classList.add('d-none');
                            });
                        }

                        document.addEventListener('click', function() {
                            emojiPicker.classList.add('d-none');
                        });

                        // ── MENTION (@) ──────────────────────────────────────
                        var mentionDropdown = document.getElementById('mentionDropdown');

                        input.addEventListener('input', function() {
                            var val = input.value;
                            var pos = input.selectionStart;
                            var lastAt = val.lastIndexOf('@', pos - 1);
                            if (lastAt !== -1 && pos - lastAt <= 20) {
                                var query = val.slice(lastAt + 1, pos).toLowerCase();
                                var items = mentionDropdown.querySelectorAll('.mention-item');
                                var anyVisible = false;
                                items.forEach(function(item) {
                                    var name = item.getAttribute('data-name').toLowerCase();
                                    if (name.includes(query)) {
                                        item.style.display = 'flex';
                                        anyVisible = true;
                                    } else {
                                        item.style.display = 'none';
                                    }
                                });
                                if (anyVisible) {
                                    mentionDropdown.classList.remove('d-none');
                                } else {
                                    mentionDropdown.classList.add('d-none');
                                }
                            } else {
                                mentionDropdown.classList.add('d-none');
                            }
                        });

                        mentionDropdown.querySelectorAll('.mention-item').forEach(function(item) {
                            item.addEventListener('click', function() {
                                var name = item.getAttribute('data-name');
                                var val = input.value;
                                var pos = input.selectionStart;
                                var lastAt = val.lastIndexOf('@', pos - 1);
                                input.value = val.slice(0, lastAt) + '@' + name + ' ' + val.slice(pos);
                                input.focus();
                                mentionDropdown.classList.add('d-none');
                            });
                        });


                        if (form) {
                            form.addEventListener('submit', function (e) {
                                e.preventDefault();
                                var text = input.value.trim();
                                if (!text) return;

                                sendBtn.disabled = true;
                                input.disabled   = true;

                                // Optimistic UI — message foran dikhao, API call background mein
                                var optimisticText = text;
                                var optimisticBubble = buildBubble({
                                    id: 'temp_' + Date.now(),
                                    message_body: optimisticText,
                                    sender_type: myType,
                                    created_at: new Date().toISOString(),
                                    is_mine: true
                                });
                                optimisticBubble.style.opacity = '0.6';
                                var empty = body.querySelector('[data-empty]');
                                if (empty) empty.remove();
                                body.appendChild(optimisticBubble);
                                input.value = '';
                                sendBtn.disabled = false;
                                input.disabled   = false;
                                scrollBottom();

                                var timeoutId = setTimeout(function() {
                                    sendBtn.disabled = false;
                                    input.disabled   = false;
                                }, 8000);

                                fetch(sendUrl, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': CSRF,
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({ message_body: optimisticText })
                                })
                                .then(function (r) { return r.json(); })
                                .then(function (data) {
                                    clearTimeout(timeoutId);
                                    if (data.success) {
                                        // Replace temp id with real id from server
                                        optimisticBubble.setAttribute('data-id', data.message.id);
                                        optimisticBubble.style.opacity = '1';
                                        // Update tick element data-msg-id to real id
                                        var tickEl = optimisticBubble.querySelector('.msg-ticks');
                                        if (tickEl) tickEl.setAttribute('data-msg-id', data.message.id);
                                        lastId = data.message.id;
                                    } else {
                                        optimisticBubble.remove();
                                    }
                                })
                                .catch(function () {
                                    clearTimeout(timeoutId);
                                    optimisticBubble.remove();
                                });
                            });

                            // Enter key sends
                            input.addEventListener('keydown', function (e) {
                                if (e.key === 'Enter' && !e.shiftKey) {
                                    e.preventDefault();
                                    form.dispatchEvent(new Event('submit'));
                                }
                            });
                        }

                        // ── AJAX POLLING (every 3 seconds) ───────────────────────
                        // ── SIDEBAR UNREAD BADGE UPDATE ──────────────────────
                        @php
                            $activeConvKey = isset($clientId) ? "{$clientId}-{$dealerId}-{$inventoryId}" : '';
                        @endphp
                        var activeConvKey = '{{ $activeConvKey }}';

                        // Clear active conversation badge immediately
                        if (activeConvKey) {
                            var activeBadge = document.querySelector('.conv-unread-badge[data-conv="' + activeConvKey + '"]');
                            if (activeBadge) activeBadge.style.display = 'none';
                        }

                        // Poll all conversation unread counts every 5 seconds
                        function updateSidebarBadges() {
                            fetch('/chat/conversations-unread', {
                                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                            })
                            .then(function(r) { return r.json(); })
                            .then(function(data) {
                                // Update per-conversation sidebar badges
                                document.querySelectorAll('.conv-unread-badge').forEach(function(badge) {
                                    var key = badge.getAttribute('data-conv');
                                    var count = data[key] || 0;
                                    // Don't show badge for active conversation
                                    if (key === activeConvKey) count = 0;
                                    if (count > 0) {
                                        badge.textContent = count;
                                        badge.style.display = 'flex';
                                    } else {
                                        badge.style.display = 'none';
                                    }
                                });

                                // Update header + dropdown total badge
                                var total = Object.values(data).reduce(function(a, b) { return a + b; }, 0);
                                var hBadge = document.getElementById('chatUnreadBadge');
                                var dBadge = document.getElementById('dropdownUnreadBadge');
                                [hBadge, dBadge].forEach(function(b) {
                                    if (!b) return;
                                    if (total > 0) { b.textContent = total > 99 ? '99+' : total; b.style.display = 'inline-flex'; }
                                    else { b.style.display = 'none'; }
                                });
                            })
                            .catch(function() {});
                        }
                        updateSidebarBadges();
                        setInterval(updateSidebarBadges, 5000);

                        if (pollUrl !== '#') {
                            setInterval(function () {
                                fetch(pollUrl + '?after=' + lastId, {
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'application/json'
                                    }
                                })
                                .then(function (r) { return r.json(); })
                                .then(function (data) {
                                    if (data.messages && data.messages.length > 0) {
                                        var empty = body.querySelector('[data-empty]');
                                        if (empty) empty.remove();

                                        data.messages.forEach(function (msg) {
                                            // Don't duplicate messages we already rendered
                                            if (!body.querySelector('[data-id="' + msg.id + '"]')) {
                                                body.appendChild(buildBubble(msg));
                                            }
                                        });
                                        lastId = data.messages[data.messages.length - 1].id;
                                        scrollBottom();
                                        convertUtcTimes();
                                    }
                                })
                                .catch(function () { /* silent fail */ });
                            }, 3000);

                            // ── TICK STATUS POLLING (every 3 seconds) ────────────
                            function runTickPoll() {
                                fetch(tickUrl + '?after=0', {
                                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                                })
                                .then(function(r) { return r.json(); })
                                .then(function(data) {
                                    var seenSet = {};

                                    if (data.read_ids && data.read_ids.length > 0) {
                                        data.read_ids.forEach(function(id) {
                                            seenSet[id] = true;
                                            document.querySelectorAll('.msg-ticks[data-msg-id]').forEach(function(tickEl) {
                                                if (String(tickEl.getAttribute('data-msg-id')) === String(id)) {
                                                    if (tickEl.getAttribute('data-status') !== 'seen') {
                                                        tickEl.innerHTML = buildTickHtml('seen');
                                                        tickEl.setAttribute('data-status', 'seen');
                                                    }
                                                }
                                            });
                                        });
                                    }

                                    if (data.delivered_ids && data.delivered_ids.length > 0) {
                                        data.delivered_ids.forEach(function(id) {
                                            if (seenSet[id]) return;
                                            document.querySelectorAll('.msg-ticks[data-msg-id]').forEach(function(tickEl) {
                                                if (String(tickEl.getAttribute('data-msg-id')) === String(id)) {
                                                    if (tickEl.getAttribute('data-status') !== 'seen' && tickEl.getAttribute('data-status') !== 'delivered') {
                                                        tickEl.innerHTML = buildTickHtml('delivered');
                                                        tickEl.setAttribute('data-status', 'delivered');
                                                    }
                                                }
                                            });
                                        });
                                    }

                                    // Diskloz: read_count/total_client_messages se buyer messages seen mark karo
                                    if (typeof data.read_count !== 'undefined' && typeof data.total_client_messages !== 'undefined') {
                                        var readCount  = parseInt(data.read_count, 10);
                                        var totalCount = parseInt(data.total_client_messages, 10);

                                        if (totalCount > 0 && readCount > 0) {
                                            // Get all my (buyer/client) sent message ticks, ordered by DOM position
                                            var myTicks = Array.from(document.querySelectorAll('.msg-ticks[data-msg-id]'));
                                            var toMark  = (readCount >= totalCount) ? myTicks : myTicks.slice(0, readCount);
                                            toMark.forEach(function(tickEl) {
                                                if (tickEl.getAttribute('data-status') !== 'seen') {
                                                    tickEl.innerHTML = buildTickHtml('seen');
                                                    tickEl.setAttribute('data-status', 'seen');
                                                }
                                            });
                                        }
                                    }
                                })
                                .catch(function() {});
                            }
                            runTickPoll();
                            setInterval(runTickPoll, 3000);
                        }
                    })();
                    </script>

                @endif {{-- end activeConversation --}}
            </div>
        </div>
    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap');


        /* width */
        .scrol-bar::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        .scrol-bar::-webkit-scrollbar-track {
            background: transparent;
        }

        /* Handle */
        .scrol-bar::-webkit-scrollbar-thumb {
            background: #F58D02;
        }

        /* Handle on hover */
        .scrol-bar::-webkit-scrollbar-thumb:hover {
            background: #8c6838;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Nunito Sans", sans-serif !important;
            background: #EFF6FC;
        }

        input:focus {
            box-shadow: none !important;
            outline: none;
        }

        h6.chat-heading:hover {
            color: black !important;
        }



        /* ---------- VIP BACK BUTTON (Mobile only, inside chat) ---------- */
        .vip-back-btn {
            display: none;
            /* Hidden on desktop */
            align-items: center;
            gap: 8px;
            background: linear-gradient(145deg, #ffffff, #f2f5fc);
            border: 1px solid rgba(63, 140, 255, 0.2);
            border-radius: 40px;
            padding: 10px 20px 10px 16px;
            margin-right: 12px;
            font-size: 16px;
            font-weight: 700;
            color: #0A1629;
            box-shadow: 0 6px 14px rgba(0, 20, 50, 0.08);
            cursor: pointer;
            transition: all 0.25s ease;
            letter-spacing: 0.3px;
            backdrop-filter: blur(2px);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .vip-back-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0));
            pointer-events: none;
        }

        .vip-back-btn:hover {
            background: linear-gradient(145deg, #ffffff, #e9eff9);
            box-shadow: 0 10px 18px rgba(63, 140, 255, 0.15);
            transform: scale(1.02);
        }

        .vip-back-btn:active {
            transform: scale(0.98);
        }

        .back-arrow {
            font-size: 22px;
            line-height: 1;
            color: #3F8CFF;
            font-weight: 600;
        }

        /* ---------- MAIN CHAT LAYOUT ---------- */
        .main-chat {
            background: var(--bg-color);
            height: 100vh;
            padding: 20px;
            position: relative;

        }

        .chat-wrapper {
            background: #fff;
            height: 100%;
            border-radius: 14px;
            display: flex;
            overflow: hidden;
            border: 1px solid #DADEE2;
        }

        /* ---------- SIDEBAR ---------- */
        .chat-sidebar {
            width: 30%;
            border-right: 1px solid #E6EBF5;
            display: flex;
            flex-direction: column;
            background: var(--bg-color);
        }

        .sidebar-header {
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #E6EBF5;
        }

        h3.sidebar-head {
            font-size: 40px;
            font-weight: 800;
            color: var(--select-color);
            margin: 0;
        }

        .sidebar-icons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .sidebar-icons img {
            object-fit: contain;
            cursor: pointer;
        }

        /* ----- Search Bar ----- */
        .search-bar-container {
            border-bottom: 1px solid #E6EBF5;
            background: #fff;
        }

        .search-input {
            width: 100%;
            padding: 10px 40px 10px 16px;
            border-radius: 30px;
            border: 1px solid #E6EBF5;
            background: #F5F7FA;
            font-size: 15px;
            transition: 0.2s;
        }

        .search-input:focus {
            border-color: #3F8CFF;
            background: #fff;
        }

        .search-close {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px;
            color: #7D8592;
            line-height: 1;
        }

        .search-close:hover {
            color: #0A1629;
        }

        /* ----- Chat List (Scrollable) ----- */
        .chat-list {
            flex: 1;
            overflow-y: auto;
            padding: 20px 15px;
            /* scrollbar-width: thin;
                scrollbar-color: #C1C7D0 #F5F7FA; */
        }



        .scrol-bar::-webkit-scrollbar-thumb {

            border-radius: 10px;
        }

        /* ----- Section Headers (Collapsible) ----- */
        .section-header {
            padding: 12px 16px 8px;
            cursor: pointer;
            user-select: none;
        }

        .section-heading {
            font-size: 15px;
            font-weight: 700;
            color: #F58D02;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .section-content {
            transition: all 0.2s ease;
        }

        .section-content.collapsed {
            display: none;
        }

        /* ----- Chat Items ----- */
        .chat-item {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            gap: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-bottom: 4px;
            border-radius: 16px;
        }

        .chat-item img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .chat-item .chat-heading {
            margin: 0 0 4px 0;
            font-size: 15px;
            font-weight: 700;
            color: var(--select-color);
            line-height: 1.3;
            transition: .3s ease;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-item .chat-paragraph {
            margin: 0;
            font-size: 16px;
            color: #91929E;
            font-weight: 400;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .chat-item .chat-time {
            margin-left: auto;
            font-size: 15px;
            color: #7D8592;
            font-weight: 600;
            /* white-space: nowrap; */
        }

        .chat-item:hover {
            background: #FFE1B9;
        }

        .chat-item.active {
            background: #FFE1B9;
        }

        .chat-item.active .chat-heading {
            color: black;
        }

        .chat-item:hover .chat-heading {
            color: black;
        }

        /* ---------- RIGHT CONTENT ---------- */
        .chat-content {
            width: 70%;
            display: flex;
            flex-direction: column;
            background: var(--bg-color);
        }

        .chat-topbar {
            padding: 18px 25px;
            border-bottom: 1px solid #E6EBF5;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-user {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .chat-user .chat-user-img {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .chat-user-heading {
            font-size: 16px;
            font-weight: 700;
            color: var(--select-color);
            margin: 0;
            line-height: 1.3;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 400px;
        }

        .chat-user-category {
            font-size: 16px;
            font-weight: 400;
            color: #91929E;
        }

        .chat-actions {
            display: flex;
            gap: 18px;
        }

        .chat-actions img {
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .chat-actions img:hover {
            opacity: 1;
        }

        /* ----- Messages Area ----- */
        .chat-messages {
            flex: 1;
            padding: 25px;
            overflow-y: auto;
            background: var(--bg-color);
            display: flex;
            flex-direction: column;
        }





        .messages-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        /* ---------- REQUEST BOX ---------- */
        .chat-request {
            max-width: 440px;
            margin: 0 auto 30px;
            padding: 24px;
            text-align: center;
            background: #fff;
            border-radius: 24px;
            border: 1px solid #E6EBF5;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        .chat-request small {
            color: #7D8592;
            font-size: 16px;
            font-weight: 700;
            display: block;
            margin-bottom: 8px;
        }

        .chat-request h6 {
            margin: 0 0 20px 0;
            font-size: 20px;
            font-weight: 800;
            color: #0A1629;
            line-height: 1.4;
        }

        .request-buttons {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn-decline,
        .btn-accept {
            display: inline-block;
            padding: 10px 42px;
            border-radius: 60px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
            text-align: center;
        }

        .btn-decline {
            background: #fff;
            border: 1.5px solid #E6EBF5;
            color: #030303;
        }

        .btn-decline:hover {
            background: #F5F5F5;
        }

        .btn-accept {
            background: #F58D02;
            border: none;
            color: #fff;
        }

        .btn-accept:hover {
            background: #1a1a1a;
        }

        /* ===== INSTAGRAM-STYLE MESSAGES ===== */
        .message {
            display: flex;
            margin-bottom: 24px;
            max-width: 70%;
            clear: both;
        }

        /* Received (other person) - LEFT */
        .message.received {
            align-self: flex-start;
            flex-direction: row;
            gap: 12px;
        }

        .message.received .msg-content {


            color: var(--select-color);
        }

        /* Sent (You) - RIGHT */
        .message.sent {
            align-self: flex-end;
            flex-direction: row-reverse;
            gap: 8px;
        }

        .message.sent .msg-content {
            background: #f58d02;
            padding: 12px 16px;
            border-radius: 20px 20px 4px 20px;
            color: white;
        }

        .message.sent .msg-name,
        .message.sent .msg-time,
        .message.sent .msg-text {
            color: white;
        }

        .message.sent .msg-time {
            color: rgba(255, 255, 255, 0.8);
        }

        /* ===== TOP BACK TO DASHBOARD ===== */
        .top-back {
            padding: 20px 0 10px 20px;
            background: var(--bg-color);
            color: var(--select-color);
        }

        h6.chat-heading:hover .dashboard-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-weight: 500;
        }

        .back-icon img {
            width: 15px;
            height: 15px;
            object-fit: contain;
        }

        .dashboard-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 17px;
            font-weight: 700;
            line-height: 24px;
            color: var(--select-color);
            transition: 0.2s ease;
        }

        .dashboard-back .back-icon {
            font-size: 18px;
            line-height: 1;
        }

        .dashboard-back:hover {
            color: #F58D02;
        }

        .msg-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            align-self: flex-start;
        }

        .message.sent .msg-avatar {
            display: none;
            /* No avatar for sent messages (Instagram style) */
        }

        .msg-content {
            display: flex;
            flex-direction: column;
            max-width: 100%;
            word-wrap: break-word;
        }

        .msg-header {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-bottom: 4px;
            flex-wrap: wrap;
        }

        .msg-name {
            font-weight: 700;
            font-size: 18px;
        }

        .msg-time {
            font-size: 12px;
            color: #65676B;
        }

        .msg-text {
            font-size: 18px;
            line-height: 1.5;
            width: 330px;
        }

        /* ----- Chat Input ----- */
        .chat-input-wrapper {
            position: relative;
            margin: 12px 20px 16px;
        }
        .chat-input {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 30px;
            border: 1.5px solid #E6EBF5;
            background: var(--bg-color) !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            margin: 0;
        }
        .chat-action-btn {
            background: none;
            border: none;
            color: #91929E;
            cursor: pointer;
            padding: 4px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            transition: color 0.2s, background 0.2s;
            flex-shrink: 0;
        }
        .chat-action-btn:hover { color: #F58D02; background: rgba(245,141,2,0.08); }
        .send-btn {
            background: #F58D02;
            border: none;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            flex-shrink: 0;
            transition: background 0.2s, transform 0.1s;
        }
        .send-btn:hover { background: #e68c00; }
        .send-btn:active { transform: scale(0.95); }
        .send-btn:disabled { opacity: 0.5; cursor: not-allowed; }

        /* Emoji Picker */
        .emoji-picker {
            position: absolute;
            bottom: calc(100% + 8px);
            left: 0;
            background: #fff;
            border: 1px solid #E6EBF5;
            border-radius: 14px;
            padding: 10px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            z-index: 100;
            width: 280px;
            max-width: calc(100vw - 40px);
        }
        .emoji-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 2px;
            max-height: 220px;
            overflow-y: auto;
        }
        .emoji-item {
            font-size: 20px;
            cursor: pointer;
            text-align: center;
            padding: 4px 2px;
            border-radius: 6px;
            transition: background 0.15s;
            line-height: 1.4;
        }
        .emoji-item:hover { background: #FFF3E0; }

        /* Mention Dropdown */
        .mention-dropdown {
            position: absolute;
            bottom: calc(100% + 8px);
            left: 50px;
            background: #fff;
            border: 1px solid #E6EBF5;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            z-index: 100;
            min-width: 200px;
            overflow: hidden;
        }
        .mention-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            cursor: pointer;
            transition: background 0.15s;
            font-size: 14px;
            font-weight: 600;
            color: #0A1629;
        }
        .mention-item:hover { background: #FFF3E0; }
        .mention-item img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }
        /* Highlight @mention in messages */
        .mention-tag {
            color: #fff;
            font-weight: 700;
        }

        /* Inventory Context Bar */
        .inv-context-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            border-bottom: 1px solid #E6EBF5;
            background: var(--bg-color);
            gap: 12px;
        }
        .inv-context-link {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            flex: 1;
            min-width: 0;
        }
        .inv-context-link:hover .inv-context-title { color: #F58D02; }
        .inv-context-img-wrap {
            flex-shrink: 0;
            width: 72px;
            height: 52px;
            border-radius: 10px;
            overflow: hidden;
            border: 1.5px solid #E6EBF5;
            background: #f5f5f5;
        }
        .inv-context-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .inv-context-info { min-width: 0; }
        .inv-context-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--select-color);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: color 0.2s;
        }
        .inv-context-model {
            font-size: 12px;
            color: #91929E;
            margin-top: 2px;
        }
        .inv-context-price {
            font-size: 13px;
            font-weight: 700;
            color: #F58D02;
            margin-top: 2px;
        }
        .inv-context-view-btn {
            flex-shrink: 0;
            font-size: 12px;
            font-weight: 700;
            color: #F58D02;
            text-decoration: none;
            border: 1.5px solid #F58D02;
            border-radius: 20px;
            padding: 5px 14px;
            white-space: nowrap;
            transition: background 0.2s, color 0.2s;
        }
        .inv-context-view-btn:hover {
            background: #F58D02;
            color: #fff;
        }

        /* WhatsApp-style ticks */
        .msg-ticks {
            text-align: right;
            margin-top: 3px;
            line-height: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .msg-ticks svg { display: block; }

        /* Message menu (3 dots) */
        .msg-menu-wrap {
            position: relative;
            display: flex;
            align-items: center;
            margin-left: 6px;
            flex-shrink: 0;
            align-self: flex-start;
            padding-top: 8px;
        }
        .msg-dots-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: rgba(255,255,255,0.7);
            padding: 2px 6px;
            border-radius: 50%;
            line-height: 1;
            display: block;
        }
        .msg-dots-btn:hover { color: #fff; background: rgba(255,255,255,0.1); }
        .msg-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 28px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.18);
            min-width: 160px;
            overflow: hidden;
            z-index: 999;
        }
        .msg-dropdown.open { display: block; }
        .msg-dropdown button {
            display: block;
            width: 100%;
            padding: 14px 20px;
            background: none;
            border: none;
            border-bottom: 1px solid #f0f0f0;
            text-align: left;
            font-size: 15px;
            font-weight: 500;
            color: #1a1a1a;
            cursor: pointer;
        }
        .msg-dropdown button:last-child { border-bottom: none; color: #e53e3e; }
        .msg-dropdown button:hover { background: #f8f8f8; }
        .msg-edit-input {
            width: 100%;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.4);
            border-radius: 6px;
            color: #fff;
            padding: 4px 8px;
            font-size: 16px;
            outline: none;
        }
        .msg-actions { display: none; }

        /* width */
        .chat-list::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        .chat-list::-webkit-scrollbar-track {
            background: transparent;
        }

        /* Handle */
        .chat-list::-webkit-scrollbar-thumb {
            background-color: #F58D02;
            border-radius: 6px;
        }

        /* Handle on hover */
        .chat-list::-webkit-scrollbar-thumb:hover {
            background-color: #8c6838;
        }


        .text-input {
            flex: 1;
            border: none;
            outline: none;
            padding: 8px 0;
            font-size: 16px;
            box-shadow: none;
            background: transparent !important;
            color: var(--select-color);
                width: 100%;
        }

        .text-input::placeholder {
            color: var(--select-color);
        }

        /* ========== RESPONSIVE BREAKPOINTS ========== */

        /* 1024px and below – Fix layout */
        @media (max-width: 1024px) {
            .main-chat {
                padding: 15px;
            }

            .chat-sidebar {
                width: 35%;
            }

            .chat-content {
                width: 65%;
            }

            .chat-item {
                padding: 12px 16px;
                gap: 10px;
            }

            .chat-item img {
                width: 42px;
                height: 42px;
            }

            .chat-item .chat-heading {
                font-size: 17px;
            }

            .chat-item .chat-paragraph {
                font-size: 15px;
            }

            .chat-item .chat-time {
                font-size: 14px;
            }

            .sidebar-header {
                padding: 14px 20px;
            }

            h3.sidebar-head {
                font-size: 20px;
            }

            .chat-topbar {
                padding: 16px 20px;
            }

            .chat-user .chat-user-img {
                width: 46px;
                height: 46px;
            }

            .chat-user-heading {
                font-size: 18px;
            }

            .chat-request {
                max-width: 380px;
                padding: 20px;
            }

            .chat-request h6 {
                font-size: 19px;
            }
        }

        /* Tablet (992px and below) */
        @media (max-width: 992px) {
            .chat-sidebar {
                width: 40%;
            }

            .chat-content {
                width: 60%;
            }

            .chat-item .chat-heading {
                font-size: 16px;
            }

            .chat-item .chat-paragraph {
                font-size: 14px;
            }

            .chat-item .chat-time {
                font-size: 13px;
            }

            .section-heading {
                font-size: 14px;
                padding: 10px 16px 6px;
            }

            .chat-request {
                max-width: 340px;
                padding: 18px;
            }

            .chat-request h6 {
                font-size: 18px;
            }

            .btn-decline,
            .btn-accept {
                padding: 8px 32px;
                font-size: 15px;
            }

            .message {
                max-width: 80%;
            }
        }

        /* Mobile (768px and below) – Instagram toggle + VIP back button visible */
        @media (max-width: 768px) {
            .main-chat {
                padding: 10px;
                height: calc(100vh - 20px);
            }

            .chat-wrapper {
                height: 100%;
            }

            .chat-sidebar,
            .chat-content {
                width: 100% !important;
            }

            body.mobile-mode .chat-content {
                display: none;
            }

            body.mobile-mode .chat-sidebar {
                display: block;
            }

            body.mobile-mode.chat-active .chat-sidebar {
                display: none;
            }

            body.mobile-mode.chat-active .chat-content {
                display: flex;
            }

            /* VIP Back button visible on mobile */
            .vip-back-btn {
                display: inline-flex !important;
            }

            /* Hide feed back button on mobile (replaced by VIP back) */
            .feed-back-btn {
                display: none;
            }

            .chat-topbar {
                padding: 12px;
            }

            .chat-user .chat-user-img {
                width: 40px;
                height: 40px;
            }

            .chat-user-heading {
                font-size: 17px;
            }

            .chat-user-category {
                font-size: 15px;
            }

            .chat-request {
                max-width: 100%;
                padding: 20px 16px;
                margin: 0 0 20px 0;
            }

            .chat-request h6 {
                font-size: 18px;
                margin-bottom: 16px;
            }

            .btn-decline,
            .btn-accept {
                padding: 10px 24px;
                font-size: 15px;
                flex: 1;
                max-width: 160px;
            }

            .chat-item {
                padding: 12px 15px;
            }

            .chat-item img {
                width: 40px;
                height: 40px;
            }

            .chat-item .chat-heading {
                font-size: 17px;
            }

            .chat-item .chat-paragraph {
                font-size: 15px;
            }

            .chat-messages {
                padding: 15px;
            }

            .message {
                max-width: 85%;
            }

            .msg-avatar {
                width: 32px;
                height: 32px;
            }

            .msg-name {
                font-size: 14px;
            }

            .msg-time {
                font-size: 11px;
            }

            .msg-text {
                font-size: 14px;
            }

            .chat-input {
                margin: 8px;
                padding: 10px 16px;
            }
        }

        /* Small phones (480px and below) */
        @media (max-width: 480px) {
            .sidebar-header {
                padding: 12px 16px;
            }

            h3.sidebar-head {
                font-size: 19px;
            }

            .sidebar-icons img {
                width: 22px;
                object-fit: contain;
            }

            .chat-item {
                padding: 10px 14px;
            }

            .chat-item .chat-heading {
                font-size: 16px;
            }

            .chat-item .chat-paragraph {
                font-size: 14px;
            }

            .chat-item .chat-time {
                font-size: 12px;
            }

            .chat-user .chat-user-img {
                width: 36px;
                height: 36px;
            }

            .chat-user-heading {
                font-size: 16px;
            }

            .chat-user-category {
                font-size: 14px;
            }

            .chat-request {
                padding: 16px;
            }

            .chat-request small {
                font-size: 14px;
            }

            .chat-request h6 {
                font-size: 16px;
            }

            .btn-decline,
            .btn-accept {
                padding: 8px 16px;
                font-size: 14px;
                max-width: 130px;
            }

            .message {
                max-width: 90%;
            }

            .vip-back-btn {
                padding: 8px 16px 8px 12px;
                font-size: 14px;
            }

            .back-arrow {
                font-size: 18px;
            }
        }
    </style>



    <style>
        /* ===============================
           GLOBAL FIXES
        =================================*/
        html,
        body {
            height: 100%;
        }

        .main-chat {
            height: 100dvh;
            /* mobile safe height */
            padding: 16px;
        }

        .chat-wrapper {
            height: 100%;
        }

        /* Prevent horizontal scroll everywhere */
        * {
            max-width: 100%;
        }

        /* ===============================
           SIDEBAR FIX
        =================================*/
        .chat-sidebar {
            min-width: 280px;
        }

        /* ===============================
           MESSAGE AREA IMPROVEMENTS
        =================================*/
        .chat-messages {
            padding: 20px;
        }

        .messages-body {
            gap: 6px;
        }

        /* Bubble width fix */
        .message {
            width: fit-content;
            max-width: 75%;
        }

        /* Text wrapping */
        .msg-text {
            word-break: break-word;
        }

        /* Avatar scaling */
        .msg-avatar {
            width: 34px;
            height: 34px;
        }

        /* ===============================
           INPUT BAR FIX
        =================================*/
        .chat-input {
            position: sticky;
            bottom: 0;
            background: #fff;
            z-index: 5;
        }

        /* ===============================
           TABLET (<=1024px)
        =================================*/
        @media (max-width: 1024px) {

            .chat-sidebar {
                width: 38%;
            }

            .chat-content {
                width: 62%;
            }

            .message {
                max-width: 80%;
            }
        }

        /* ===============================
           MOBILE MAIN MODE (<=768px)
        =================================*/
        @media (max-width: 768px) {

            .main-chat {
                padding: 0;
            }

            .chat-wrapper {
                border-radius: 0;
            }

            .chat-messages {
                padding: 14px;
            }

            .message {
                max-width: 88%;
                margin-bottom: 16px;
            }

            .msg-content {
                padding: 10px 14px;
            }

            .msg-text {
                font-size: 14px;
                line-height: 1.4;
            }

            .msg-name {
                font-size: 13px;
            }

            .msg-time {
                font-size: 10px;
            }

            .msg-avatar {
                width: 30px;
                height: 30px;
            }

            .chat-input {
                margin: 8px;
                padding: 10px 14px;
            }

            .text-input {
                font-size: 14px;
            }
        }

        /* ===============================
           SMALL PHONES (<=480px)
        =================================*/
        @media (max-width: 480px) {

            .message {
                max-width: 92%;
            }

            .chat-user-heading {
                font-size: 15px;
            }

            .chat-user-category {
                font-size: 13px;
            }

            .chat-item {
                padding: 10px 12px;
            }

            .chat-item img {
                width: 36px;
                height: 36px;
            }

            .chat-item .chat-heading {
                font-size: 15px;
            }

            .chat-item .chat-paragraph {
                font-size: 13px;
            }

            .chat-input {
                border-radius: 20px;
            }
        }

        /* ===============================
           EXTRA SMALL (<=360px)
        =================================*/
        @media (max-width: 360px) {

            .msg-text {
                font-size: 13px;
            }

            .chat-input {
                gap: 6px;
            }

            .chat-input img {
                width: 18px;
            }

            .text-input {
                font-size: 13px;
            }
        }
    </style>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ---------- RESPONSIVE MODE (Mobile Toggle) ----------
            function handleResponsive() {
                const body = document.body;
                const isMobile = window.innerWidth <= 768;
                if (isMobile) {
                    body.classList.add('mobile-mode');
                    @if(!isset($clientId))
                    body.classList.remove('chat-active');
                    @else
                    body.classList.add('chat-active');
                    @endif
                } else {
                    body.classList.remove('mobile-mode', 'chat-active');
                }
            }
            handleResponsive();
            window.addEventListener('resize', handleResponsive);

            // Global mobileBack function
            window.mobileBack = function() {
                document.body.classList.remove('chat-active');
            };

            // Open chat on mobile when clicking a chat item
            document.querySelectorAll('.chat-item').forEach(item => {
                item.addEventListener('click', function (e) {
                    if (document.body.classList.contains('mobile-mode')) {
                        document.body.classList.add('chat-active');
                    }
                });
            });

            // ---------- COLLAPSIBLE SECTIONS ----------
            window.toggleSection = function (sectionId) {
                const section = document.getElementById(sectionId);
                const header = section.previousElementSibling.querySelector('.section-heading');
                if (section.classList.contains('collapsed')) {
                    section.classList.remove('collapsed');
                    header.innerHTML = '˅ ' + (sectionId === 'requestedSection' ? 'Requested Messages' :
                        'Messages');
                } else {
                    section.classList.add('collapsed');
                    header.innerHTML = '› ' + (sectionId === 'requestedSection' ? 'Requested Messages' :
                        'Messages');
                }
            };

            // Initialize all sections as expanded
            document.querySelectorAll('.section-content').forEach(el => el.classList.remove('collapsed'));

            // ---------- SEARCH TOGGLE (Both Icons) ----------
            const searchTriggers = document.querySelectorAll('.search-icon-trigger');
            const searchBarContainer = document.querySelector('.search-bar-container');
            const searchClose = document.querySelector('.search-close');
            const searchInput = document.querySelector('.search-input');

            function toggleSearch(e) {
                e.preventDefault();
                if (searchBarContainer.style.display === 'none' || !searchBarContainer.style.display) {
                    searchBarContainer.style.display = 'block';
                    if (searchInput) searchInput.focus();
                } else {
                    searchBarContainer.style.display = 'none';
                }
            }

            searchTriggers.forEach(trigger => {
                trigger.addEventListener('click', toggleSearch);
            });

            if (searchClose) {
                searchClose.addEventListener('click', function () {
                    searchBarContainer.style.display = 'none';
                });
            }

            if (searchInput) {
                searchInput.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') {
                        searchBarContainer.style.display = 'none';
                    }
                });
            }
        });
    </script>







@endsection
