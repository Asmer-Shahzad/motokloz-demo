<!-- Become a Dealer Modal -->
<div class="modal fade" id="testDriveModal" tabindex="-1" aria-labelledby="testDriveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="testDriveModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form data-ajax="true" id="dealerApplicationForm" action="{{ route('support.application.submit') }}" method="POST">
                    @csrf
                    <!-- ✅ Hidden field to store source -->
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
                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Any additional notes..."></textarea>
                    </div>
                    <button type="submit" class="mto-btn-orange w-100 mb-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Set source when modal is opened
    document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#testDriveModal"]').forEach(trigger => {
        trigger.addEventListener('click', function() {
            var source = this.getAttribute('data-title');
            var modalTitle = document.getElementById('testDriveModalLabel');
            var formSource = document.getElementById('formSource');
            
            // Set modal title
            if (modalTitle && source) {
                modalTitle.textContent = source;
            }
            
            // Set hidden field value
            if (formSource && source) {
                formSource.value = source;
            }
        });
    });

    $(document).ready(function(){

        $('#dealerApplicationForm').on('submit', function(e){
            e.preventDefault();

            // ===== UI STATE =====
            var $btn = $(this).find('button[type="submit"]');
            var originalText = $btn.html();

            $btn.prop('disabled', true)
                .html('<i class="fas fa-spinner fa-spin ms-2"></i> Submitting...');

            $('#loadingSpinner').show();

            var form = this;
            var formData = new FormData(form);

            $.ajax({
                url: form.action,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,

                success: function(res){
                    // Show success message
                    showSnackbar(res.message || 'Submitted successfully!', 'success');
                    
                    // ✅ CLEAR ALL FIELDS (Method 1 - Using reset)
                    form.reset();
                    
                    // ✅ CLEAR ALL FIELDS (Method 2 - Manual clear - more reliable)
                    // Clear all input fields
                    $('#dealerApplicationForm input[type="text"], #dealerApplicationForm input[type="email"], #dealerApplicationForm input[type="tel"], #dealerApplicationForm textarea').val('');
                    
                    // Clear hidden field
                    $('#formSource').val('');
                    
                    // Remove any validation error classes
                    $('.is-invalid').removeClass('is-invalid');
                    $('.error-message').remove();
                    
                    // Optional: Clear any select dropdowns if present
                    // $('#dealerApplicationForm select').val('');

                    // Close modal after 2 seconds (optional)
                    setTimeout(function() {
                        const modalEl = document.getElementById('testDriveModal');
                        if (modalEl) {
                            const modal = bootstrap.Modal.getInstance(modalEl);
                            if (modal) modal.hide();
                        }
                    }, 2000);
                },

                error: function(xhr){
                    if (xhr.status === 422 && xhr.responseJSON?.errors) {
                        let msgs = [];
                        $.each(xhr.responseJSON.errors, function(field, messages) {
                            msgs.push(messages.join(', '));
                        });
                        showSnackbar(msgs.join(' | '), 'error');
                    } else if (xhr.status === 500) {
                        showSnackbar('Server error. Please try again later.', 'error');
                    } else {
                        showSnackbar(xhr.responseJSON?.message || 'Something went wrong.', 'error');
                    }
                },

                complete: function(){
                    $btn.prop('disabled', false).html(originalText);
                    $('#loadingSpinner').hide();
                }
            });
        });
        
        // Clear form when modal is closed
        $('#testDriveModal').on('hidden.bs.modal', function () {
            // Reset form when modal closes
            $('#dealerApplicationForm')[0].reset();
            $('#formSource').val('');
            
            // Remove validation errors
            $('.is-invalid').removeClass('is-invalid');
            $('.error-message').remove();
        });
        
        // Set source when modal opens
        $('[data-bs-toggle="modal"][data-bs-target="#testDriveModal"]').on('click', function() {
            var source = $(this).data('title');
            $('#testDriveModalLabel').text(source);
            $('#formSource').val(source);
        });
    });
</script>