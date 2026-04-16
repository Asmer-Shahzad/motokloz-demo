<div class="row g-3">
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Stock Number" name="stock_number">
    </div>

    <div class="col-md-4">
        <select class="form-select" id="make" name="make">
            <option value="">Select Make</option>
        </select>
    </div>

    <div class="col-md-4">
        <select class="form-select" id="year" name="year">
            <option value="">Select Year</option>
            @foreach($year as $y)
                <option value="{{ $y->id }}">{{ $y->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Vin/Serial" name="serial">
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Model" name="model">
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Trim" name="trim">
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Mileage/Hours" name="mileage">
    </div>

    <div class="col-md-4">
        <select class="form-select" id="power_type" name="power_type">
            <option value="">Select Power Type</option>
            <option value="GAS">GAS</option>
            <option value="DIESEL">DIESEL</option>
            <option value="PROPANE">PROPANE</option>
            <option value="ELECTRIC">ELECTRIC</option>
            <option value="OTHER">OTHER</option>
        </select>
    </div>

    <div class="col-md-4">
        <select class="form-select" id="fuel_type" name="fuel_type">
            <option value="">Select Fuel Type</option>
            <option value="PREMIUM REQUIRED">PREMIUM REQUIRED</option>
            <option value="PREMIUM RECOMMENDED">PREMIUM RECOMMENDED</option>
            <option value="REGULAR">REGULAR</option>
        </select>
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Vehicle Length" name="v_length">
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Vehicle Width" name="v_width">
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Vehicle Height" name="v_height">
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="GVW" name="gvw">
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Curb Weight" name="curb_weight">
    </div>

    <!-- rakhna tha -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Fuel Economy" name="city_mileage">
    </div>

    <!-- rakhna tha -->
    <div class="col-md-12">
        <input type="text" class="form-control" placeholder="Color" name="ext_color">
    </div>

    <div class="col-12">
        <textarea class="form-control" rows="4" placeholder="Description" name="notes_dicussion"></textarea>
    </div>

</div>

<!-- Custom Features Section -->
<div class="row mt-3">
    <div class="col-12">
        <label class="form-label fw-bold">Custom Features</label>
        <div id="custom-features-container">
            <!-- Dynamic custom features will appear here -->
        </div>
        <button type="button" class="btn btn-orange btn-sm mt-2" id="add-custom-feature-btn">
            <i class="fas fa-plus"></i> Add Custom Feature
        </button>
    </div>
</div>

<!-- Custom Feature Modal -->
<div class="modal fade" id="customFeatureModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Custom Feature</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form data-ajax="true" id="customFeatureForm">
                    <div class="mb-3">
                        <label class="form-label">Feature Name</label>
                        <input type="text" class="form-control" id="custom-feature-name" placeholder="Enter feature name" required>
                    </div>
                    <button type="submit" class="btn btn-orange w-100">Add Feature</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

            // Open modal on button click
            $('#add-custom-feature-btn').on('click', function () {
                $('#customFeatureModal').modal('show');
            });

        // Add custom feature
        $('#customFeatureForm').on('submit', function(e) {
            e.preventDefault();

        var featureName = $('#custom-feature-name').val().trim();

        if (!featureName) {
            alert('Please enter a feature name');
        return;
            }

        // Create new custom feature checkbox
        var newFeature = `
        <div class="form-check feature-checkbox custom-feature-item">
            <input class="form-check-input" type="checkbox" name="features[]" value="${featureName}" checked>
                <label class="form-check-label">${featureName}</label>
                <button type="button" class="btn btn-sm text-danger remove-feature ms-2" style="border: none; background: none;">
                    <i class="fas fa-times"></i>
                </button>
        </div>
        `;

        // Add to container
        $('#custom-features-container').append(newFeature);

        // Close modal and reset form
        $('#customFeatureModal').modal('hide');
        $('#custom-feature-name').val('');
        });

        // Remove custom feature
        $(document).on('click', '.remove-feature', function() {
            $(this).closest('.custom-feature-item').remove();
        });

        // Clear modal on close
        $('#customFeatureModal').on('hidden.bs.modal', function() {
            $('#custom-feature-name').val('');
        });
        
    });
</script>