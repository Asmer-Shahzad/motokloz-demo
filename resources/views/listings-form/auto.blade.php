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