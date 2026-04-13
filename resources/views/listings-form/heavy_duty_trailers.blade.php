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
    
    <div class="col-md-12">
        <input type="text" class="form-control" placeholder="Color" name="ext_color">
    </div>
    
    <div class="col-12">
        <textarea class="form-control" rows="4" placeholder="Description" name="notes_dicussion"></textarea>
    </div>
</div>
