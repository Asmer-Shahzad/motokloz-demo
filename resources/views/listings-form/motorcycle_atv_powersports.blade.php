<!-- CAR DETAILS -->
<div class="row g-3">
    <div class="col-12" hidden>
        <input type="hidden" value="Motokloz" class="form-control" placeholder="Source *" name="source" required>
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Stock Number" name="stock_number">
    </div>

    <div class="col-md-4">
        <select class="form-select" id="make" name="make">
            <option value="">Select Make</option>
        </select>
    </div>

    <div class="col-md-4">
        <select class="form-select" id="body_style" name="body_style">
            <option value="">Select Body Style</option>
        </select>
    </div>

    <div class="col-md-4">
        <select class="form-select" id="condition" name="condition">
            <option value="">Select Condition</option>
            @foreach($condition as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <select class="form-select" id="engine" name="engine">
            <option value="">Select Engine</option>
            @foreach($engine as $e)
                <option value="{{ $e->id }}">{{ $e->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Engine Displacement" name="cc" required>
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
        <input type="text" class="form-control" placeholder="Vin/Serial *" name="serial" required>
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Model *" name="model" required>
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Trim *" name="trim" required>
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
            <option value="PREMIUM REQUIRED ">PREMIUM REQUIRED</option>
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
    
    <div class="col-md-12">
        <input type="text" class="form-control" placeholder="Color" name="ext_color">
    </div>
    
    <div class="col-12">
        <textarea class="form-control" rows="4" placeholder="Description" name="notes_dicussion"></textarea>
    </div>
</div>

<!-- FEATURES - MOTORCYCLE -->
<h4 class="mt-4 mb-3 fw-bold">Features</h4>
<div class="row">
    <div class="col-md-6">
        <!-- Interior Features -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Leather">
            <label class="form-check-label">Leather</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Faux Leather">
            <label class="form-check-label">Faux Leather</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Vinyl">
            <label class="form-check-label">Vinyl</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Cloth">
            <label class="form-check-label">Cloth</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="1 Wheel">
            <label class="form-check-label">1 Wheel</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="2 Wheel">
            <label class="form-check-label">2 Wheel</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="3 Wheel">
            <label class="form-check-label">3 Wheel</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="4 Wheel">
            <label class="form-check-label">4 Wheel</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="5 Wheel">
            <label class="form-check-label">5 Wheel</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="6 Wheel">
            <label class="form-check-label">6 Wheel</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="8 Wheel">
            <label class="form-check-label">8 Wheel</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Seats 1">
            <label class="form-check-label">Seats 1</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Seats 2">
            <label class="form-check-label">Seats 2</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Seats 3">
            <label class="form-check-label">Seats 3</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Seats 4">
            <label class="form-check-label">Seats 4</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Seats 5">
            <label class="form-check-label">Seats 5</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Seats 6+">
            <label class="form-check-label">Seats 6+</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Heated Seats">
            <label class="form-check-label">Heated Seats</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Heated Bars">
            <label class="form-check-label">Heated Bars</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Heated Steering">
            <label class="form-check-label">Heated Steering</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="GPS">
            <label class="form-check-label">GPS</label>
        </div>
    </div>
    
    <div class="col-md-6">
        <!-- Extra Features -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Sidecar">
            <label class="form-check-label">Sidecar</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Bike Trailer">
            <label class="form-check-label">Bike Trailer</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Storage">
            <label class="form-check-label">Storage</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Factory Audio Package">
            <label class="form-check-label">Factory Audio Package</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="After Market Audio Package">
            <label class="form-check-label">After Market Audio Package</label>
        </div>
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