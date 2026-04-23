<!-- CAR DETAILS -->
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
        <select class="form-select" id="transmission" name="transmission">
            <option value="">Select Transmission</option>
            @foreach($transmission as $t)
                <option value="{{ $t->id }}">{{ $t->name }}</option>
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
        <select class="form-select" id="drivetrain" name="drivetrain">
            <option value="">Select Drive Train</option>
            @foreach($driveTrain as $d)
                <option value="{{ $d->id }}">{{ $d->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Trim *" name="trim" required>
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Horse Power" name="horse_power" required>
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Mileage" name="mileage">
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

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Max Towing Capacity" name="max_tow_capacity">
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="City Fuel Economy" name="city_mileage">
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Highway Fuel Economy" name="highway_mileage">
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Ext Color" name="ext_color">
    </div>

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Int Color" name="int_color">
    </div>

    <div class="col-md-4">
        <select class="form-select" id="num_of_keys" name="num_of_keys">
            <option value=""># of Keys</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
    </div>

    <div class="col-md-6">
        <select class="form-select" id="num_of_tyres" name="num_of_tyres">
            <option value=""># Of Sets Of Tires</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3+</option>
        </select>
    </div>

    <div class="col-md-6">
        <input type="text" class="form-control" placeholder="Search Keyword" name="search_keyword">
    </div>

    <div class="col-12">
        <textarea class="form-control" rows="4" placeholder="Description" name="notes_dicussion"></textarea>
    </div>
</div>

<!-- FEATURES -->
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
            <input class="form-check-input" type="checkbox" name="features[]" value="Wood Trim">
            <label class="form-check-label">Wood Trim</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Faux Wood Trim">
            <label class="form-check-label">Faux Wood Trim</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Standard mats">
            <label class="form-check-label">Standard mats</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="All weather mats">
            <label class="form-check-label">All weather mats</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Carpet">
            <label class="form-check-label">Carpet</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Air Conditioning">
            <label class="form-check-label">Air Conditioning</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Dual Climate Control">
            <label class="form-check-label">Dual Climate Control</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Rear A/C">
            <label class="form-check-label">Rear A/C</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Cruise Control">
            <label class="form-check-label">Cruise Control</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Adaptive Cruise Control">
            <label class="form-check-label">Adaptive Cruise Control</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Power Windows">
            <label class="form-check-label">Power Windows</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Power Door Locks">
            <label class="form-check-label">Power Door Locks</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Power Driver Seat">
            <label class="form-check-label">Power Driver Seat</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Power Passenger Seat">
            <label class="form-check-label">Power Passenger Seat</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Heated Driver Seat">
            <label class="form-check-label">Heated Driver Seat</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Heated Passenger Seat">
            <label class="form-check-label">Heated Passenger Seat</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Heated 2nd Row Seat">
            <label class="form-check-label">Heated 2nd Row Seat</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Heated 3rd Row Seat">
            <label class="form-check-label">Heated 3rd Row Seat</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Cooled Driver Seat">
            <label class="form-check-label">Cooled Driver Seat</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Cooled Passenger Seat">
            <label class="form-check-label">Cooled Passenger Seat</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Cooled 2nd Row Seat">
            <label class="form-check-label">Cooled 2nd Row Seat</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Cooled 3rd Row Seat">
            <label class="form-check-label">Cooled 3rd Row Seat</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Heated Steering Wheel">
            <label class="form-check-label">Heated Steering Wheel</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Telescopic Steering">
            <label class="form-check-label">Telescopic Steering</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Sunroof">
            <label class="form-check-label">Sunroof</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Moonroof">
            <label class="form-check-label">Moonroof</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Panaroof">
            <label class="form-check-label">Panaroof</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Navigation / GPS">
            <label class="form-check-label">Navigation / GPS</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Bluetooth / Handsfree">
            <label class="form-check-label">Bluetooth / Handsfree</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="DVD">
            <label class="form-check-label">DVD</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Premium Sound">
            <label class="form-check-label">Premium Sound</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Backup Camera">
            <label class="form-check-label">Backup Camera</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Park Assist">
            <label class="form-check-label">Park Assist</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Lane Assist">
            <label class="form-check-label">Lane Assist</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Steering Assist">
            <label class="form-check-label">Steering Assist</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Blind Spot Assist">
            <label class="form-check-label">Blind Spot Assist</label>
        </div>
    </div>
    
    <div class="col-md-6">
        <!-- Exterior & Extra Features -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Heated Mirror">
            <label class="form-check-label">Heated Mirror</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="HID Lights">
            <label class="form-check-label">HID Lights</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Fog Lights">
            <label class="form-check-label">Fog Lights</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Specialty Lights">
            <label class="form-check-label">Specialty Lights</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Specialty Windshield">
            <label class="form-check-label">Specialty Windshield</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Allow Wheels">
            <label class="form-check-label">Allow Wheels</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Specialty / Aftermarket Rims">
            <label class="form-check-label">Specialty / Aftermarket Rims</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Specialty/Aftermarket Tires">
            <label class="form-check-label">Specialty/Aftermarket Tires</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Oversized Tires">
            <label class="form-check-label">Oversized Tires</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Power Tailgate">
            <label class="form-check-label">Power Tailgate</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Power Hatch">
            <label class="form-check-label">Power Hatch</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Hitch">
            <label class="form-check-label">Hitch</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Regular Box">
            <label class="form-check-label">Regular Box</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Short Box">
            <label class="form-check-label">Short Box</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Long Box">
            <label class="form-check-label">Long Box</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Alarm">
            <label class="form-check-label">Alarm</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Immobilizer">
            <label class="form-check-label">Immobilizer</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Remote/Command Start">
            <label class="form-check-label">Remote/Command Start</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Running Boards">
            <label class="form-check-label">Running Boards</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Power Running Boards">
            <label class="form-check-label">Power Running Boards</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Tonneau Cover">
            <label class="form-check-label">Tonneau Cover</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Bed / Box Liner">
            <label class="form-check-label">Bed / Box Liner</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Hood Deflector">
            <label class="form-check-label">Hood Deflector</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Mud Flaps">
            <label class="form-check-label">Mud Flaps</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Window Visors">
            <label class="form-check-label">Window Visors</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Roof Rack">
            <label class="form-check-label">Roof Rack</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="3M">
            <label class="form-check-label">3M</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Paint Protection">
            <label class="form-check-label">Paint Protection</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Interior Protection">
            <label class="form-check-label">Interior Protection</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Rust Module">
            <label class="form-check-label">Rust Module</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Rust Inhibitor">
            <label class="form-check-label">Rust Inhibitor</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Undercarriage Protection">
            <label class="form-check-label">Undercarriage Protection</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Lifted">
            <label class="form-check-label">Lifted</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Spare Tire">
            <label class="form-check-label">Spare Tire</label>
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