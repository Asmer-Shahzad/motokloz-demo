<!-- CAR DETAILS -->
<div class="row g-3">
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Stock Number" name="stock_number">
    </div>
    <div class="col-12" hidden>
        <input type="hidden" value="Motokloz" class="form-control" placeholder="Source *" name="source" required>
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

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Ext Color" name="ext_color">
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Int Color" name="int_color">
    </div>
    <div class="col-md-4">

        <select class="form-select" placeholder="Hull Type" name="hull_type" id="hull_type">
            <option value="DISPLACEMENT">DISPLACEMENT</option>
            <option value="MULTIHULL">MULTIHULL</option>
            <option value="FLAT-BOTTOM">FLAT-BOTTOM</option>
            <option value="DEEP V">DEEP V</option>
            <option value="PONTOON">PONTOON</option>
            <option value="TRI / TUNNEL">TRI / TUNNEL</option>
            <option value="MOD-V">MOD-V</option>
            <option value="V-BOTTOM">V-BOTTOM</option>
            <option value="ROUND BOTTOM">ROUND BOTTOM</option>
            <option value="CATAMARAN / TWIN HULLS">CATAMARAN / TWIN HULLS</option>
            <option value="HYDROFOIL">HYDROFOIL</option>
            <option value="OTHER">OTHER</option>
        </select>
    </div>

    <div class="col-md-12">
        <input type="text" class="form-control" placeholder="In Floor Storage Size" name="in_floor_storage_size"
            value="{{ old('in_floor_storage_size') }}">
    </div>

    <div class="col-12">
        <textarea class="form-control" rows="4" placeholder="Description" name="notes_dicussion"></textarea>
    </div>
</div>

<!-- FEATURES - MARINE -->
<h4 class="mt-4 mb-3 fw-bold">Features</h4>
<div class="row">
    <div class="col-md-6">
        <!-- Interior Features -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Cloth">
            <label class="form-check-label">Cloth</label>
        </div>
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
            <input class="form-check-input" type="checkbox" name="features[]" value="Carpet">
            <label class="form-check-label">Carpet</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Rubber Floor">
            <label class="form-check-label">Rubber Floor</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Faux Wood Trim">
            <label class="form-check-label">Faux Wood Trim</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Air Conditioning">
            <label class="form-check-label">Air Conditioning</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Cruise Control">
            <label class="form-check-label">Cruise Control</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Heated Seat">
            <label class="form-check-label">Heated Seat</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Heated Wheel">
            <label class="form-check-label">Heated Wheel</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Navigation/GPS">
            <label class="form-check-label">Navigation/GPS</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Fridge">
            <label class="form-check-label">Fridge</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Dishwasher">
            <label class="form-check-label">Dishwasher</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Wine Fridge">
            <label class="form-check-label">Wine Fridge</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="2Burner">
            <label class="form-check-label">2 Burner</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="3Burner">
            <label class="form-check-label">3 Burner</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="4Burner">
            <label class="form-check-label">4 Burner</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Oven">
            <label class="form-check-label">Oven</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Microwave">
            <label class="form-check-label">Microwave</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Toilet">
            <label class="form-check-label">Toilet</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Tub">
            <label class="form-check-label">Tub</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Shower">
            <label class="form-check-label">Shower</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Washer/Dryer">
            <label class="form-check-label">Washer/Dryer</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Canopy">
            <label class="form-check-label">Canopy</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Mooring Cover">
            <label class="form-check-label">Mooring Cover</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Bow">
            <label class="form-check-label">Bow</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Bimini With Boot">
            <label class="form-check-label">Bimini With Boot</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Fibreglass Helm">
            <label class="form-check-label">Fibreglass Helm</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Aluminium">
            <label class="form-check-label">Aluminium</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="1 TV">
            <label class="form-check-label">1 TV</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="2+ TV'S">
            <label class="form-check-label">2+ TV'S</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="1 BEDROOM">
            <label class="form-check-label">1 Bedroom</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="2 BEDROOM">
            <label class="form-check-label">2 Bedroom</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="3+ BEDROOM">
            <label class="form-check-label">3+ Bedroom</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Non LED Docking & Underdeck Lightning">
            <label class="form-check-label">Non LED Docking & Underdeck Lightning</label>
        </div>
    </div>
    
    <div class="col-md-6">
        <!-- Extra Features -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Single Axle Trailer Included">
            <label class="form-check-label">Single Axle Trailer Included</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Tandem Axle Trailer Included">
            <label class="form-check-label">Tandem Axle Trailer Included</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Triple Axle Trailer Included">
            <label class="form-check-label">Triple Axle Trailer Included</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Boat Cover">
            <label class="form-check-label">Boat Cover</label>
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