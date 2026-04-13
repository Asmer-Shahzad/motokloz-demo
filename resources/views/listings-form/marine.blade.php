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

    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="In Floor Storage Size" name="in_floor_storage_size"
            value="{{ old('in_floor_storage_size') }}">
    </div>
</div>