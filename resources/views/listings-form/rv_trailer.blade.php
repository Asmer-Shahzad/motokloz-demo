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
    <div class="col-md-4">
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