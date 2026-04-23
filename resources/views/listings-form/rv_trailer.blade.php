<div class="row g-3">

    <div class="col-md-4">
        <select class="form-select" id="body_style" name="body_style">
            <option value="">Select Body Style</option>
        </select>
    </div>
    <!-- Vin -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Vin/Serial" name="serial">
    </div>

    <!-- Condition -->
    <div class="col-md-4">
        <select class="form-select" name="condition">
            <option value="">Condition</option>
            @foreach($condition ?? [] as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Height -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Height" name="v_height">
    </div>



    <!-- Length -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Length" name="v_length">
    </div>

    <!-- Year -->
    <div class="col-md-4">
        <select class="form-select" name="year">
            <option value="">Year</option>
            @foreach($year ?? [] as $y)
                <option value="{{ $y->id }}">{{ $y->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Width -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Width" name="v_width">
    </div>

    <!-- Make -->
    <div class="col-md-4">
        <select class="form-select" id="make" name="make">
            <option value="">Make</option>
        </select>
    </div>

    <!-- Hitch Length -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Length Of Hitch" name="hitch_length">
    </div>

    <!-- Model -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Model" name="model">
    </div>

    <!-- Generator 1 Make -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Generator 1 Make" name="generator_make_1st">
    </div>

    <!-- Mileage -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Mileage" name="mileage">
    </div>

    <!-- Generator 1 Hours -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Generator 1 Hours" name="generator_hours_1st">
    </div>

    <!-- Power Type -->
    <div class="col-md-4">
        <select class="form-select" name="power_type">
            <option value="">Power Type</option>
            <option value="GAS">GAS</option>
            <option value="DIESEL">DIESEL</option>
            <option value="ELECTRIC">ELECTRIC</option>
        </select>
    </div>

    <!-- Generator 1 Serial -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Generator 1 Vin/Serial" name="generator_vin_1st">
    </div>

    <!-- Trim -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Trim" name="trim">
    </div>

    <!-- Generator 2 Make -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Generator 2 Make" name="generator_make_2nd">
    </div>

    <!-- Ext Color -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Ext Color" name="ext_color">
    </div>

    <!-- Generator 2 Hours -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Generator 2 Hours" name="generator_hours_2nd">
    </div>

    <!-- Int Color -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Int Color" name="int_color">
    </div>

    <!-- Generator 2 Serial -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Generator 2 Vin/Serial" name="generator_vin_2nd">
    </div>

    <!-- GVW -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="GVW" name="gvw">
    </div>

    <!-- Curb Weight -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Curb Weight" name="curb_weight">
    </div>

    <!-- Max Tow -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Max Tow capacity" name="max_tow_capacity">
    </div>

    <!-- Search -->
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Search Keyword" name="search_keyword">
    </div>


    <!-- Floor Plans -->
    <div class="col-md-8">
        <div class="fp-multiselect" id="fpMultiselect">
            <div class="fp-trigger" onclick="toggleFpDropdown()">
                <div class="fp-tags" id="fpTags">
                    <span class="fp-placeholder" id="fpPlaceholder">Select Floor Plans</span>
                </div>
                <span class="fp-arrow">▾</span>
            </div>
            <div class="fp-dropdown" id="fpDropdown">
                <input type="text" class="fp-search" placeholder="Search..." oninput="filterFpOptions(this.value)"
                    onclick="event.stopPropagation()">
                <div class="fp-options" id="fpOptions">
                    @foreach(['SINGLES UNIT', 'COUPLES UNIT', 'FAMILY UNIT', 'BUNK OVER CAB', 'BUNKHOUSE', 'FRONT BUNK', 'MID BUNK', 'REAR BUNK', 'DOUBLE BED', 'QUEEN BED', 'KING BED', 'MURPHY BED', 'FRONT BATH', 'FRONT BEDROOM', 'FRONT ENTERTAINMENT', 'FRONT LIVING AREA', 'FRONT DINETTE', 'FRONT KITCHEN', 'MID BATH', 'MID KITCHEN', 'KITCHEN ISLAND', 'REAR BATH', 'REAR BEDROOM', 'REAR ENTERTAINMENT', 'REAR LIVING AREA', 'REAR DINETTE', 'REAR KITCHEN', 'REAR SLIDE', 'PASS THROUGH STORAGE'] as $opt)
                        <div class="fp-option" data-value="{{ $opt }}" onclick="toggleFpOption(this)">{{ $opt }}</div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- Hidden inputs for form submission --}}
        <div id="fpHiddenInputs"></div>
    </div>
    
    <div class="col-12">
        <textarea class="form-control" rows="4" placeholder="Description" name="notes_dicussion"></textarea>
    </div>

    <style>
        .fp-multiselect {
            position: relative;
            width: 100%;
        }

        .fp-trigger {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 42px;
            padding: 6px 12px;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            background: #f1f3f5;
            cursor: pointer;
            flex-wrap: wrap;
            gap: 4px;
            color: #000;
        }

        .fp-trigger:hover {
            border-color: #ff9800;
        }

        .fp-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            flex: 1;
        }

        .fp-placeholder {
            color: #888;
            font-size: 14px;
        }

        .fp-arrow {
            color: #888;
            font-size: 12px;
            flex-shrink: 0;
        }

        .fp-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #ff9800;
            color: #fff;
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 12px;
            font-weight: 500;
        }

        .fp-tag-remove {
            cursor: pointer;
            font-size: 14px;
            font-weight: 700;
            line-height: 1;
            opacity: 0.8;
        }

        .fp-tag-remove:hover {
            opacity: 1;
        }

        .fp-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            width: 100%;
            color: #1a1a1a;
            background: #fff;
            border: 1px solid #333;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            z-index: 9999;
            max-height: 280px;
            overflow: hidden;
        }

        .fp-dropdown.open {
            display: flex;
            flex-direction: column;
        }

        .fp-search {
            border: none;
            border-bottom: 1px solid #333;
            padding: 10px 14px;
            font-size: 13px;
            outline: none;
            width: 100%;
            background: #fff;
            color: #111;
        }

        .fp-options {
            overflow-y: auto;
            max-height: 230px;
        }

        .fp-option {
            padding: 10px 14px;
            font-size: 13px;
            cursor: pointer;
            color: #000;

            transition: background 0.15s, color 0.15s;
        }

        .fp-option:hover {
            background: #ff9d00;
            color: #fff;
        }

        .fp-option.selected {
            background: #ff9800;
            color: #fff;
            font-weight: 600;
        }

        .fp-option.selected:hover {
            background: #ff9800;
        }

        .fp-option.hidden {
            display: none;
        }
    </style>
    <script>
        var fpSelected = [];

        function toggleFpDropdown() {
            var dd = document.getElementById('fpDropdown');
            dd.classList.toggle('open');
            if (dd.classList.contains('open')) {
                dd.querySelector('.fp-search').focus();
            }
        }

        document.addEventListener('click', function (e) {
            var ms = document.getElementById('fpMultiselect');
            if (ms && !ms.contains(e.target)) {
                document.getElementById('fpDropdown').classList.remove('open');
            }
        });

        function toggleFpOption(el) {
            var val = el.getAttribute('data-value');
            var idx = fpSelected.indexOf(val);
            if (idx === -1) {
                fpSelected.push(val);
                el.classList.add('selected');
            } else {
                fpSelected.splice(idx, 1);
                el.classList.remove('selected');
            }
            renderFpTags();
            renderFpHidden();
        }

        function removeFpTag(val) {
            fpSelected = fpSelected.filter(function (v) { return v !== val; });
            var opts = document.querySelectorAll('#fpOptions .fp-option');
            opts.forEach(function (o) {
                if (o.getAttribute('data-value') === val) o.classList.remove('selected');
            });
            renderFpTags();
            renderFpHidden();
        }

        function renderFpTags() {
            var container = document.getElementById('fpTags');
            var ph = document.getElementById('fpPlaceholder');
            if (fpSelected.length === 0) {
                container.innerHTML = '<span class="fp-placeholder" id="fpPlaceholder">Select Floor Plans</span>';
                return;
            }
            container.innerHTML = fpSelected.map(function (v) {
                return '<span class="fp-tag">' + v +
                    '<span class="fp-tag-remove" onclick="event.stopPropagation();removeFpTag(\'' + v.replace(/'/g, "\\'") + '\')">×</span>' +
                    '</span>';
            }).join('');
        }

        function renderFpHidden() {
            var container = document.getElementById('fpHiddenInputs');
            container.innerHTML = fpSelected.map(function (v) {
                return '<input type="hidden" name="floor_plans[]" value="' + v.replace(/"/g, '&quot;') + '">';
            }).join('');
        }

        function filterFpOptions(query) {
            var opts = document.querySelectorAll('#fpOptions .fp-option');
            opts.forEach(function (o) {
                var match = o.textContent.toLowerCase().includes(query.toLowerCase());
                o.classList.toggle('hidden', !match);
            });
        }
    </script>
</div>

<!-- FEATURES - RV TRAILER -->
<h4 class="mt-4 mb-3 fw-bold">Features</h4>
<div class="row">
    <div class="col-md-6">
        <!-- Slides -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="No Slide">
            <label class="form-check-label">No Slide</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="1 Slide">
            <label class="form-check-label">1 Slide</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="2 Slides">
            <label class="form-check-label">2 Slides</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="3 Slides">
            <label class="form-check-label">3 Slides</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="4 Slides">
            <label class="form-check-label">4 Slides</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="5 Slides">
            <label class="form-check-label">5 Slides</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="6 Slides">
            <label class="form-check-label">6 Slides</label>
        </div>
        
        <!-- Kitchen -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Kitchen">
            <label class="form-check-label">Kitchen</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Outdoor Kitchen">
            <label class="form-check-label">Outdoor Kitchen</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Fridge">
            <label class="form-check-label">Fridge</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Stove">
            <label class="form-check-label">Stove</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Microwave">
            <label class="form-check-label">Microwave</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Dishwasher">
            <label class="form-check-label">Dishwasher</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Drawer Dishwasher">
            <label class="form-check-label">Drawer Dishwasher</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Wine fridge">
            <label class="form-check-label">Wine fridge</label>
        </div>
        
        <!-- Bathroom -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="1 Bathroom">
            <label class="form-check-label">1 Bathroom</label>
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
            <input class="form-check-input" type="checkbox" name="features[]" value="Double Sinks">
            <label class="form-check-label">Double Sinks</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Outdoor Shower">
            <label class="form-check-label">Outdoor Shower</label>
        </div>
        
        <!-- Bedrooms -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="1 Bedroom">
            <label class="form-check-label">1 Bedroom</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="2 Bedrooms">
            <label class="form-check-label">2 Bedrooms</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Walk In Closet">
            <label class="form-check-label">Walk In Closet</label>
        </div>
        
        <!-- Living Area -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Living Area">
            <label class="form-check-label">Living Area</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Sofa">
            <label class="form-check-label">Sofa</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="U Shaped Dinette">
            <label class="form-check-label">U Shaped Dinette</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Table W/Chairs">
            <label class="form-check-label">Table W/Chairs</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Fireplace">
            <label class="form-check-label">Fireplace</label>
        </div>
        
        <!-- Awnings -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="1 Awning">
            <label class="form-check-label">1 Awning</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="2 Awnings">
            <label class="form-check-label">2 Awnings</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="3 Awnings">
            <label class="form-check-label">3 Awnings</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="4 Awnings">
            <label class="form-check-label">4 Awnings</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Manual Awnings">
            <label class="form-check-label">Manual Awnings</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Power Awnings">
            <label class="form-check-label">Power Awnings</label>
        </div>
    </div>
    
    <div class="col-md-6">
        <!-- Appliances -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Washer">
            <label class="form-check-label">Washer</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Dryer">
            <label class="form-check-label">Dryer</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Washer Dryer Prep">
            <label class="form-check-label">Washer Dryer Prep</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Central Vaccum">
            <label class="form-check-label">Central Vaccum</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Air Conditioning">
            <label class="form-check-label">Air Conditioning</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Roof Vents">
            <label class="form-check-label">Roof Vents</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Massage Seating">
            <label class="form-check-label">Massage Seating</label>
        </div>
        
        <!-- Entertainment -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="1 TV">
            <label class="form-check-label">1 TV</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="2 TV">
            <label class="form-check-label">2 TV</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="3 TV">
            <label class="form-check-label">3 TV</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="4 TV">
            <label class="form-check-label">4 TV</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="CD Player">
            <label class="form-check-label">CD Player</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="GPS/Navigation">
            <label class="form-check-label">GPS/Navigation</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Satellite Dish">
            <label class="form-check-label">Satellite Dish</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="WiFi">
            <label class="form-check-label">WiFi</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Outdoor Speakers">
            <label class="form-check-label">Outdoor Speakers</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Outdoor TV">
            <label class="form-check-label">Outdoor TV</label>
        </div>
        
        <!-- Power & Electrical -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Gen Prep">
            <label class="form-check-label">Gen Prep</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="1 Generator">
            <label class="form-check-label">1 Generator</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="2 Generators">
            <label class="form-check-label">2 Generators</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="1 Battery">
            <label class="form-check-label">1 Battery</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="2 Batteries">
            <label class="form-check-label">2 Batteries</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Solar Inverter Prep">
            <label class="form-check-label">Solar Inverter Prep</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Solar Inverter">
            <label class="form-check-label">Solar Inverter</label>
        </div>
        
        <!-- Exterior -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Rear View Camera">
            <label class="form-check-label">Rear View Camera</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Roof Ladder">
            <label class="form-check-label">Roof Ladder</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Outdoor Grill">
            <label class="form-check-label">Outdoor Grill</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Outdoor Fridge">
            <label class="form-check-label">Outdoor Fridge</label>
        </div>
        
        <!-- Axle -->
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Single Axle">
            <label class="form-check-label">Single Axle</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Tandem Axle">
            <label class="form-check-label">Tandem Axle</label>
        </div>
        <div class="form-check feature-checkbox">
            <input class="form-check-input" type="checkbox" name="features[]" value="Triple Axle">
            <label class="form-check-label">Triple Axle</label>
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