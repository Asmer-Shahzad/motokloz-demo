{{-- ============================================================
     SHARED CHAT FORM + handleChatClick JS
     Include this in any page that has vehicle cards with chat button
============================================================ --}}

<form id="chatStartForm" method="POST" action="{{ route('chat.start') }}" style="display:none;">
    @csrf
    <input type="hidden" name="inventory_id" id="chatFormInventoryId">
    <input type="hidden" name="dealer_id"    id="chatFormDealerId">
    <input type="hidden" name="source"       id="chatFormSource">
</form>

<script>
    var isLoggedIn    = {{ auth()->check() ? 'true' : 'false' }};
    var loginUrl      = "{{ route('login') }}";
    var chatIntentUrl = "{{ route('chat.set.intent') }}";
    var csrfToken     = "{{ csrf_token() }}";

    function handleChatClick(e, dealerId, inventoryId, source) {
        e.stopPropagation();
        e.preventDefault();

        if (!isLoggedIn) {
            fetch(chatIntentUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    url: '/chat/start-redirect?dealer_id=' + dealerId + '&inventory_id=' + inventoryId + '&source=' + source,
                    dealer_id:    dealerId,
                    inventory_id: inventoryId,
                    source:       source
                })
            }).finally(function () {
                window.location.href = loginUrl;
            });
            return;
        }

        // Logged in — submit hidden form
        document.getElementById('chatFormInventoryId').value = inventoryId;
        document.getElementById('chatFormDealerId').value    = dealerId;
        document.getElementById('chatFormSource').value      = source;
        document.getElementById('chatStartForm').submit();
    }
</script>
