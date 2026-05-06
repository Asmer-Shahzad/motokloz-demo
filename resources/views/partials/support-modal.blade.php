<!-- Support / Dealer Modal — included once via footer -->
<div class="modal fade" id="testDriveModal" tabindex="-1" aria-labelledby="testDriveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="testDriveModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="dealerApplicationForm" action="{{ route('support.application.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="source" id="formSource" value="">

                    <div class="mb-3">
                        <label for="dealership_name" class="form-label">Dealership Name</label>
                        <input type="text" class="form-control" id="dealership_name" name="dealership_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_name" class="form-label">Contact Name</label>
                        <input type="text" class="form-control" id="contact_name" name="contact_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_email" class="form-label">Contact Email</label>
                        <input type="email" class="form-control" id="contact_email" name="contact_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_phone" class="form-label">Contact Phone</label>
                        <input type="tel" class="form-control" id="contact_phone" name="contact_phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"
                                  placeholder="Any additional notes..."></textarea>
                    </div>
                    <button type="submit" class="mto-btn-orange w-100 mb-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    // ✅ IIFE + window flag — runs ONCE no matter how many times partial is included
    if (window._supportModalBound) return;
    window._supportModalBound = true;

    document.addEventListener('DOMContentLoaded', function () {

        // Set modal title + source from whichever trigger button was clicked
        document.body.addEventListener('click', function (e) {
            var trigger = e.target.closest('[data-bs-toggle="modal"][data-bs-target="#testDriveModal"]');
            if (!trigger) return;
            var source = trigger.getAttribute('data-title') || '';
            var el = document.getElementById('testDriveModalLabel');
            var fs = document.getElementById('formSource');
            if (el) el.textContent = source;
            if (fs) fs.value = source;
        });

        var form = document.getElementById('dealerApplicationForm');
        if (!form) return;

        // ✅ Request-level lock — one AJAX at a time, no matter what
        var isSubmitting = false;

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            if (isSubmitting) return;

            var $btn = $(form).find('button[type="submit"]');
            var originalText = $btn.html();

            isSubmitting = true;
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin ms-2"></i> Submitting...');

            $.ajax({
                url:         form.action,
                method:      'POST',
                data:        new FormData(form),
                processData: false,
                contentType: false,

                success: function (res) {
                    showSnackbar(res.message || 'Submitted successfully!', 'success');
                    form.reset();
                    document.getElementById('formSource').value = '';

                    setTimeout(function () {
                        var modalEl = document.getElementById('testDriveModal');
                        if (modalEl) {
                            var modal = bootstrap.Modal.getInstance(modalEl);
                            if (modal) modal.hide();
                        }
                    }, 2000);
                },

                error: function (xhr) {
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        var msgs = [];
                        $.each(xhr.responseJSON.errors, function (field, messages) {
                            msgs.push(messages.join(', '));
                        });
                        showSnackbar(msgs.join(' | '), 'error');
                    } else {
                        showSnackbar(
                            (xhr.responseJSON && xhr.responseJSON.message) || 'Something went wrong.',
                            'error'
                        );
                    }
                },

                complete: function () {
                    isSubmitting = false;
                    $btn.prop('disabled', false).html(originalText);
                }
            });
        });

        // Reset everything when modal closes
        var modalEl = document.getElementById('testDriveModal');
        if (modalEl) {
            modalEl.addEventListener('hidden.bs.modal', function () {
                form.reset();
                document.getElementById('formSource').value = '';
                isSubmitting = false;
                document.querySelectorAll('.is-invalid').forEach(function (el) { el.classList.remove('is-invalid'); });
                document.querySelectorAll('.error-message').forEach(function (el) { el.remove(); });
            });
        }
    });
})();
</script>
