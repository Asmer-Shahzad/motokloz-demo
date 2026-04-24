@extends('layouts.app')

@section('content')
@php
function formatPrice($price) {
    $cleaned = str_replace(['$', ','], '', $price);
    $number = is_numeric($cleaned) ? (float)$cleaned : 0;
    return number_format(round($number), 0, '.', ',');
}
@endphp

    <section class="dealer-fleet-section container">
        <div class=" my-4">
            @php
                // Create slug from dealer name
                $dealerName = $dealer->legal_name ?? $dealer->first_name ?? 'dealer';
                $dealerSlug = preg_replace('/[^a-z0-9]+/', '-', strtolower($dealerName));
                $dealerSlug = trim($dealerSlug, '-');
                $dealerId = $dealer->id ?? 0;
                
                // ✅ Pass both name and id
                $detailUrl = route('dealer_inventory_details', ['name' => $dealerSlug, 'id' => $dealerId]);
                
                $dealerLogo = $dealer->logo
                    ? (Str::startsWith($dealer->logo, 'http')
                        ? $dealer->logo
                        : env('diskloz_base_url') . '/admin_assets/images/dealer_images/' . $dealer->logo)
                    : asset('assets/images/defaultdealerlogo.png');
            @endphp

            <div class="top-back">
                <a href="{{ $detailUrl }}" class="dashboard-back link-text-decoration">
                    <span class="back-icon">
                        <img src="/assets/images/Carento (5).png" alt="Back">
                    </span>
                    <span class="back-text">Go back to Dealer Profile</span>
                </a>
            </div>
            
            
            <!-- Collapsible Content -->
            
                <div class="collapse show" id="overviewContent">
                    <a class="link-text-decoration" href="{{ $detailUrl }}">
                    <div class="d-flex align-items-start mb-4 border p-4 rounded-3" data-aos="fade-down" data-aos-duration="700">
                        <img src="{{ $dealerLogo }}"
                            class="img-fluid dealerlogo rounded-circle me-3"
                            alt="Dealer"
                            onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultdealerlogo.png') }}';">
                        <div>
                            <h3 class="mb-0 fw-bold">{{ $dealer->legal_name }}</h3>
                            <p class="mb-3">
                                <i class="fas fa-map-marker-alt text-warning me-1"></i>

                            {{ collect([
                                $dealer?->physical_address,
                                $dealer?->city,
                                $dealer?->province,
                                $dealer?->postal_code
                            ])->filter()->implode(', ') ?: 'Address not available' }}

                            </p>
                            <span class="badge bg-light text-dark border mt-2 p-2 rounded-5">
                                {{ $inventory->total() }} Vehicles
                            </span>
                        </div>
                    </div>
                    </a>
                </div>
            

        </div>
        <div class="car-dealer">
            <div>
                <div class="row">
                    <div class="col-lg-12">


                        <div class="search-wrapper search-dealer-container">
                            <form action="{{ route('dealer_inventory', ['id' => $dealer->id ?? request()->route('id')]) }}" method="GET" class="search-wrapper">

                                <!-- Tabs -->
                                <div class="tabs">
                                    <a class="tab {{ request('selected_condition') == '' ? 'active' : '' }}"
                                        data-condition="">All</a>
                                    <a class="tab {{ request('selected_condition') == 'NEW' ? 'active' : '' }}"
                                        data-condition="NEW">New</a>
                                    <a class="tab {{ request('selected_condition') == 'USED' ? 'active' : '' }}"
                                        data-condition="USED">Used</a>

                                    <div class="help">
                                        <i class="fa-solid fa-user"></i>
                                        <span>Need help?</span>
                                    </div>
                                </div>

                                <!-- Hidden input for condition -->
                                <input type="hidden" name="selected_condition" id="selected_condition_input_2"
                                    value="{{ request('selected_condition') }}">

                                <!-- Filter Bar -->
                                <div class="filter-bar">

                                    <!-- Type -->
                                    <div class="filter">
                                        <label>Type</label>
                                        <div class="select">
                                            <i class="fa-solid fa-car"></i>
                                            <select name="selected_asset" id="filter-type" class="filter-options">
                                                <option value="">Select Type</option>
                                                @foreach($assets as $asset)
                                                <option value="{{ $asset }}" {{ request('selected_asset')==$asset
                                                    ? 'selected' : '' }}>
                                                    {{ $asset }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <!-- Make -->
                                    <div class="filter">
                                        <label>Make</label>
                                        <div class="select">
                                            <i class="fa-solid fa-car-side me-2"></i>

                                            <select id="filter-make" name="selected_make" class="filter-options">
                                                <option value="">Select Make</option>

                                                @php
                                                    $allMakes = [];

                                                    if(request('selected_asset') && isset($makeTypes[request('selected_asset')])) {
                                                        // Specific asset ke makes
                                                        $allMakes = $makeTypes[request('selected_asset')];
                                                    } else {
                                                        // Sab assets ke makes merge
                                                        foreach($makeTypes as $assetMakes) {
                                                            $allMakes = array_merge($allMakes, $assetMakes);
                                                        }

                                                        // Duplicate remove + optional sort
                                                        $allMakes = collect($allMakes)
                                                                    ->unique('name')
                                                                    ->sortBy('name')
                                                                    ->values()
                                                                    ->toArray();
                                                    }
                                                @endphp

                                                @foreach($allMakes as $make)
                                                    <option value="{{ $make['name'] }}" {{ request('selected_make') == $make['name'] ? 'selected' : '' }}>
                                                        {{ $make['name'] }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <!-- Model -->
                                    <div class="filter">
                                        <label>Model</label>
                                        <div class="select">
                                            <input type="text" name="selected_model" class="form-control model-input"
                                                placeholder="Enter Model" value="{{ request('selected_model') }}">
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <!-- Price Range -->
                                    <div class="price-box filter">
                                        <label>Price Range</label>
                                        <div class="range-container">
                                            <div class="slider-track" id="track"></div>
                                            <input class="filter-all" type="range" min="0" max="1000000" step="10000"
                                                value="{{ request('selected_lowest_price', 0) }}" id="slider-1" name="selected_lowest_price">
                                            <input class="filter-all" type="range" min="0" max="1000000" step="10000"
                                                value="{{ request('selected_highest_price', 1000000) }}" id="slider-2" name="selected_highest_price">
                                        </div>

                                        <div class="values">
                                            $ <span id="min-value"></span> - $ <span id="max-value"></span>
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <!-- Distance to Seller (Top Bar) -->
                                    <div class="filter distance-filter-wrap">
                                        <label>Distance</label>
                                        <div class="select distance-dropdown-container">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <select name="selected_distance" id="dealer-topbar-distance-select" class="filter-options" style="display:none;">
                                                <option value="">Any Distance</option>
                                                <option value="50"         {{ request('selected_distance')=='50'         ? 'selected':'' }}>Under 50 km</option>
                                                <option value="100"        {{ request('selected_distance')=='100'        ? 'selected':'' }}>Under 100 km</option>
                                                <option value="250"        {{ request('selected_distance')=='250'        ? 'selected':'' }}>Under 250 km</option>
                                                <option value="500"        {{ request('selected_distance')=='500'        ? 'selected':'' }}>Under 500 km</option>
                                                <option value="1000"       {{ request('selected_distance')=='1000'       ? 'selected':'' }}>Under 1000 km</option>
                                                <option value="provincial" {{ request('selected_distance')=='provincial' ? 'selected':'' }}>Provincial</option>
                                                <option value="national"   {{ request('selected_distance')=='national'   ? 'selected':'' }}>National</option>
                                            </select>
                                            <button type="button" class="btn-allow-location" id="dealer-topbar-allow-location" style="display:none;">
                                                <i class="fa-solid fa-location-crosshairs me-1"></i> Allow Location
                                            </button>
                                            <span id="dealer-topbar-location-unsupported" style="display:none; font-size:12px; color:#aaa;">Location not supported</span>
                                        </div>
                                        <input type="hidden" name="user_lat" id="dealer-topbar-user-lat" value="{{ request('user_lat') }}">
                                        <input type="hidden" name="user_lng" id="dealer-topbar-user-lng" value="{{ request('user_lng') }}">
                                    </div>

                                    <button type="submit" class="search-btn">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        Find a Vehicle
                                    </button>

                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div>


            <div class="row g-4 ">
                <div class="col-lg-3 col-md-4">
                    <form id="sidebarFilterForm" method="GET" action="{{ route('dealer_inventory', ['id' => $dealer->id ?? request()->route('id')]) }}">
                        <aside class="complete-sidebar" data-aos="fade-right" data-aos-duration="700">
                            <h5 class="sidebar-main-heading">Filter Search</h5>

                            <!-- Condition -->
                            <div class="filter-group">
                                <label class="sidebar-label">Condition</label>
                                <select name="selected_condition" class="form-select sidebar-input">
                                    <option value="">Select Condition</option>
                                    <option value="" {{ request('selected_condition')=='' ? 'selected' : '' }}>All</option>
                                    <option value="NEW" {{ request('selected_condition')=='NEW' ? 'selected' : '' }}>New</option>
                                    <option value="USED" {{ request('selected_condition')=='USED' ? 'selected' : '' }}>Used</option>
                                </select>
                            </div>

                            <!-- Asset -->
                            <div class="filter-group">
                                <label class="sidebar-label">Asset Type</label>
                                <select name="selected_asset" id="sidebar-type" class="form-select sidebar-input">
                                    <option value="">Select Asset Type</option>
                                    @foreach($assets as $asset)
                                    <option value="{{ $asset }}" {{ request('selected_asset')==$asset ? 'selected' : '' }}>
                                        {{ $asset }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Power Type -->
                            <div class="filter-group">
                                <label class="sidebar-label">Power Type</label>
                                <select name="selected_power_type" class="form-select sidebar-input">
                                    <option value="">Select Power Type</option>
                                    <option value="GAS" {{ request('selected_power_type')=='GAS' ? 'selected' : '' }}>GAS</option>
                                    <option value="DIESEL" {{ request('selected_power_type')=='DIESEL' ? 'selected' : '' }}>DIESEL</option>
                                    <option value="PROPANE" {{ request('selected_power_type')=='PROPANE' ? 'selected' : '' }}>PROPANE</option>
                                    <option value="ELECTRIC" {{ request('selected_power_type')=='ELECTRIC' ? 'selected' : '' }}>ELECTRIC</option>
                                    <option value="OTHER" {{ request('selected_power_type')=='OTHER' ? 'selected' : '' }}>OTHER</option>
                                    <option value="HYBRID" {{ request('selected_power_type')=='HYBRID' ? 'selected' : '' }}>HYBRID</option>
                                </select>
                            </div>

                            <!-- Price -->
                            <div class="filter-group">
                                <label class="sidebar-label">Lowest Price</label>
                                <input type="text" name="selected_lowest_price" class="form-control sidebar-input"
                                    placeholder="Enter Price" value="{{ request('selected_lowest_price') }}">
                            </div>

                            <div class="filter-group">
                                <label class="sidebar-label">Max Price</label>
                                <input type="text" name="selected_highest_price" class="form-control sidebar-input"
                                    placeholder="Enter Price" value="{{ request('selected_highest_price') }}">
                            </div>

                            <!-- Year -->
                            <div class="filter-group">
                                <label class="sidebar-label">Year</label>
                                <select name="selected_year" id="year-select" class="form-select sidebar-input">
                                    <option value="">Select Year</option>
                                    @php
                                        $currentYear = date('Y');
                                        $selectedYear = request('selected_year');
                                    @endphp
                                    @for($year = $currentYear; $year >= 1950; $year--)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                           <div class="filter-group">
                                <label class="sidebar-label">Make</label>

                                <select name="selected_make" id="filter-make" class="form-select sidebar-input w-100">
                                    <option value="">Select Make</option>

                                    @php
                                        $allMakes = [];

                                        if(request('selected_asset') && isset($makeTypes[request('selected_asset')])) {
                                            $allMakes = $makeTypes[request('selected_asset')];
                                        } else {
                                            foreach($makeTypes as $assetMakes) {
                                                $allMakes = array_merge($allMakes, $assetMakes);
                                            }

                                            // Optional: duplicate remove karne ke liye
                                            $allMakes = collect($allMakes)->unique('name')->values()->toArray();
                                        }
                                    @endphp

                                    @foreach($allMakes as $make)
                                        <option value="{{ $make['name'] }}" {{ request('selected_make')==$make['name'] ? 'selected' : '' }}>
                                            {{ $make['name'] }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <!-- Model -->
                            <div class="filter-group">
                                <label class="sidebar-label">Model</label>
                                <input type="text" name="selected_model" class="form-control sidebar-input"
                                    placeholder="Enter Model" value="{{ request('selected_model') }}">
                            </div>

                            <!-- Mileage -->
                            <div class="filter-group">
                                <label class="sidebar-label">Max Mileage</label>
                                <input type="text" name="selected_mileage" class="form-control sidebar-input"
                                    placeholder="Enter Max Mileage" value="{{ request('selected_mileage') }}">
                            </div>

                            <!-- Body Style -->
                            <div class="filter-group">
                                <label class="sidebar-label">Body Style</label>
                                <select name="selected_body_style" id="body-style-select" class="form-select sidebar-input">
                                    <option value="">Select Body Style</option>
                                    @if(!empty($body_styles) && count($body_styles) > 0)
                                        @foreach($body_styles as $style)
                                            <option value="{{ $style['name'] ?? $style->name ?? '' }}" 
                                                {{ (isset($selected_body_style) && $selected_body_style == ($style['name'] ?? $style->name ?? '')) ? 'selected' : '' }}>
                                                {{ $style['name'] ?? $style->name ?? '' }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <!-- Fuel -->
                            <div class="filter-group">
                                <label class="sidebar-label">Fuel Type</label>
                                <select name="selected_fuel_type" class="form-select sidebar-input">
                                    <option value="">Select Fuel Type</option>
                                    <option value="PREMIUM REQUIRED" {{ request('selected_fuel_type')=='PREMIUM REQUIRED' ? 'selected' : '' }}>
                                        PREMIUM REQUIRED
                                    </option>
                                    <option value="PREMIUM RECOMMENDED" {{ request('selected_fuel_type')=='PREMIUM RECOMMENDED' ? 'selected' : '' }}>
                                        PREMIUM RECOMMENDED
                                    </option>
                                    <option value="REGULAR" {{ request('selected_fuel_type')=='REGULAR' ? 'selected' : '' }}>
                                        REGULAR
                                    </option>
                                    <option value="ELECTRIC" {{ request('selected_fuel_type')=='ELECTRIC' ? 'selected' : '' }}>
                                        ELECTRIC
                                    </option>
                                </select>
                            </div>

                            <!-- Seller -->
                            <div class="filter-group">
                                <label class="sidebar-label">Add for sale by</label>
                                <select name="selected_seller" id="seller-select" class="form-select sidebar-input">
                                    <option value="">Select Any</option>
                                    <!-- Add seller options as needed -->
                                </select>
                            </div>

                            <!-- Distance to Seller (Sidebar) -->
                            <div class="filter-group">
                                <label class="sidebar-label">
                                    <i class="fa-solid fa-location-dot me-1"></i> Distance to Seller
                                </label>
                                <select name="selected_distance" id="dealer-sidebar-distance-select" class="form-select sidebar-input" style="display:none;">
                                    <option value="">Any Distance</option>
                                    <option value="50"         {{ request('selected_distance')=='50'         ? 'selected':'' }}>Under 50 km</option>
                                    <option value="100"        {{ request('selected_distance')=='100'        ? 'selected':'' }}>Under 100 km</option>
                                    <option value="250"        {{ request('selected_distance')=='250'        ? 'selected':'' }}>Under 250 km</option>
                                    <option value="500"        {{ request('selected_distance')=='500'        ? 'selected':'' }}>Under 500 km</option>
                                    <option value="1000"       {{ request('selected_distance')=='1000'       ? 'selected':'' }}>Under 1000 km</option>
                                    <option value="provincial" {{ request('selected_distance')=='provincial' ? 'selected':'' }}>Provincial</option>
                                    <option value="national"   {{ request('selected_distance')=='national'   ? 'selected':'' }}>National</option>
                                </select>
                                <button type="button" class="btn-allow-location w-100" id="dealer-sidebar-allow-location" style="display:none;">
                                    <i class="fa-solid fa-location-crosshairs me-1"></i> Allow Location
                                </button>
                                <span id="dealer-sidebar-location-unsupported" style="display:none; font-size:12px; color:#aaa;">Location not supported</span>
                                <input type="hidden" name="user_lat" id="dealer-sidebar-user-lat" value="{{ request('user_lat') }}">
                                <input type="hidden" name="user_lng" id="dealer-sidebar-user-lng" value="{{ request('user_lng') }}">
                            </div>
                        </aside>
                    </form>
                <div class="sidebar-map-box mt-4 complete-sidebar" data-aos="fade-right" data-aos-delay="100" data-aos-duration="700">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="map-label">Show on map</span>
                            <i class="fa-solid fa-chevron-down map-toggle-icon"></i>
                        </div>
                        @php
                            $dealerMapAddress = urlencode(
                                trim(($dealer->physical_address ?? '') . ', ' .
                                ($dealer->city ?? '') . ', ' .
                                ($dealer->province ?? '') . ' ' .
                                ($dealer->postal_code ?? '') . ', ' .
                                ($dealer->country ?? 'Canada'))
                            );
                        @endphp
                        <iframe
                            width="100%"
                            height="220"
                            style="border:0; border-radius:12px; display:block;"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://maps.google.com/maps?q={{ $dealerMapAddress }}&output=embed&z=15">
                        </iframe>
                        <p style="margin-top:10px; margin-bottom:0; font-size:14px; font-weight:600; color:var(--select-color, #222); display:flex; align-items:center; gap:6px;">
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 0C4.686 0 2 2.686 2 6c0 4.5 6 14 6 14s6-9.5 6-14c0-3.314-2.686-6-6-6z" fill="#ff9d00"/>
                                <circle cx="8" cy="6" r="2.5" fill="#fff"/>
                            </svg>
                            {{ $dealer->physical_address ?? 'Location Not Available'}}
                        </p>
                    </div> 
                </div>


                <div class="col-lg-9 col-md-8">

                    <div style="    border-bottom: 1px solid #DDE1DE;     padding-bottom: 10px;"
                        class="fleet-toolbar d-flex flex-wrap justify-content-between align-items-center mb-4">
                        <div class="toolbar-left d-flex align-items-center">
                            <div class="view-icons me-3">
                                {{-- <i class="fa-solid fa-table-cells-large active light-dark"></i> --}}
                                {{-- <i class="fa-solid fa-list ms-2"></i> --}}
                                <!-- Grid View -->
                                <svg id="gridViewBtn" width="22" height="24" viewBox="0 0 22 24" fill="none" class="me-2 gridbtn"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 9.5V4.25C20 3.8375 19.6625 3.5 19.25 3.5H14C13.5875 3.5 13.25 3.8375 13.25 4.25V9.5C13.25 9.9125 13.5875 10.25 14 10.25H19.25C19.6625 10.25 20 9.9125 20 9.5ZM19.25 2C20.495 2 21.5 3.005 21.5 4.25V9.5C21.5 10.745 20.495 11.75 19.25 11.75H14C12.755 11.75 11.75 10.745 11.75 9.5V4.25C11.75 3.005 12.755 2 14 2H19.25Z"
                                         />
                                    <path
                                        d="M20 20.75V15.5C20 15.0875 19.6625 14.75 19.25 14.75H14C13.5875 14.75 13.25 15.0875 13.25 15.5V20.75C13.25 21.1625 13.5875 21.5 14 21.5H19.25C19.6625 21.5 20 21.1625 20 20.75ZM19.25 13.25C20.495 13.25 21.5 14.255 21.5 15.5V20.75C21.5 21.995 20.495 23 19.25 23H14C12.755 23 11.75 21.995 11.75 20.75V15.5C11.75 14.255 12.755 13.25 14 13.25H19.25Z"
                                         />
                                    <path
                                        d="M8 10.25C8.4125 10.25 8.75 9.9125 8.75 9.5V4.25C8.75 3.8375 8.4125 3.5 8 3.5H2.75C2.3375 3.5 2 3.8375 2 4.25V9.5C2 9.9125 2.3375 10.25 2.75 10.25H8ZM8 2C9.245 2 10.25 3.005 10.25 4.25V9.5C10.25 10.745 9.245 11.75 8 11.75H2.75C1.505 11.75 0.5 10.745 0.5 9.5V4.25C0.5 3.005 1.505 2 2.75 2H8Z"
                                         />
                                    <path
                                        d="M8 21.5C8.4125 21.5 8.75 21.1625 8.75 20.75V15.5C8.75 15.0875 8.4125 14.75 8 14.75H2.75C2.3375 14.75 2 15.0875 2 15.5V20.75C2 21.1625 2.3375 21.5 2.75 21.5H8ZM8 13.25C9.245 13.25 10.25 14.255 10.25 15.5V20.75C10.25 21.995 9.245 23 8 23H2.75C1.505 23 0.5 21.995 0.5 20.75V15.5C0.5 14.255 1.505 13.25 2.75 13.25H8Z"
                                         />
                                </svg>
                                <!-- List View -->
                                <svg id="listViewBtn" width="21" height="21" viewBox="0 0 21 21" fill="none" class="gridbtn"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.788 0H1.09497C0.491194 0 0 0.486501 0 1.08456V4.74269C0 5.34075 0.491194 5.82729 1.09497 5.82729H4.788C5.39177 5.82729 5.88297 5.34075 5.88297 4.74269V1.08456C5.88297 0.486501 5.39177 0 4.788 0ZM4.80951 4.74273C4.80951 4.75328 4.79865 4.76404 4.788 4.76404H1.09497C1.08432 4.76404 1.07345 4.75328 1.07345 4.74273V1.08456C1.07345 1.07401 1.08432 1.06329 1.09497 1.06329H4.788C4.79865 1.06329 4.80951 1.07401 4.80951 1.08456V4.74273ZM7.53412 1.32686C7.53412 1.03321 7.77444 0.795211 8.07084 0.795211H20.4632C20.7596 0.795211 21 1.03321 21 1.32686C21 1.62046 20.7596 1.8585 20.4632 1.8585H8.07084C7.77444 1.8585 7.53412 1.62046 7.53412 1.32686ZM21 4.50043C21 4.79408 20.7597 5.03208 20.4633 5.03208H8.07084C7.77444 5.03208 7.53412 4.79408 7.53412 4.50043C7.53412 4.20683 7.77444 3.96879 8.07084 3.96879H20.4632C20.7597 3.96879 21 4.20683 21 4.50043ZM4.788 7.58633H1.09497C0.491194 7.58633 0 8.07283 0 8.67089V12.329C0 12.9271 0.491194 13.4136 1.09497 13.4136H4.788C5.39177 13.4136 5.88297 12.9271 5.88297 12.329V8.67089C5.88297 8.07288 5.39177 7.58633 4.788 7.58633ZM4.80951 12.3291C4.80951 12.3396 4.79865 12.3504 4.788 12.3504H1.09497C1.08432 12.3504 1.07345 12.3396 1.07345 12.3291V8.67094C1.07345 8.66039 1.08432 8.64967 1.09497 8.64967H4.788C4.79865 8.64967 4.80951 8.66039 4.80951 8.67094V12.3291ZM4.788 15.1727H1.09497C0.491194 15.1727 0 15.6592 0 16.2573V19.9154C0 20.5135 0.491194 21 1.09497 21H4.788C5.39177 21 5.88297 20.5135 5.88297 19.9154V16.2573C5.88297 15.6592 5.39177 15.1727 4.788 15.1727ZM4.80951 19.9154C4.80951 19.926 4.79865 19.9368 4.788 19.9368H1.09497C1.08432 19.9368 1.07345 19.926 1.07345 19.9154V16.2573C1.07345 16.2468 1.08432 16.236 1.09497 16.236H4.788C4.79865 16.236 4.80951 16.2468 4.80951 16.2573V19.9154ZM21 12.0868C21 12.3805 20.7597 12.6185 20.4633 12.6185H8.07084C7.77444 12.6185 7.53412 12.3805 7.53412 12.0868C7.53412 11.7932 7.77444 11.5552 8.07084 11.5552H20.4632C20.7597 11.5552 21 11.7932 21 12.0868ZM21 8.91328C21 9.20688 20.7597 9.44492 20.4633 9.44492H8.07084C7.77444 9.44492 7.53412 9.20688 7.53412 8.91328C7.53412 8.61963 7.77444 8.38163 8.07084 8.38163H20.4632C20.7597 8.38163 21 8.61963 21 8.91328ZM21 16.4996C21 16.7932 20.7597 17.0313 20.4633 17.0313H8.07084C7.77444 17.0313 7.53412 16.7932 7.53412 16.4996C7.53412 16.206 7.77444 15.968 8.07084 15.968H20.4632C20.7597 15.968 21 16.206 21 16.4996ZM21 19.6732C21 19.9668 20.7597 20.2048 20.4633 20.2048H8.07084C7.77444 20.2048 7.53412 19.9668 7.53412 19.6732C7.53412 19.3796 7.77444 19.1415 8.07084 19.1415H20.4632C20.7597 19.1415 21 19.3796 21 19.6732Z"
                                        />
                                </svg>


                            </div>
                            <span class="results-info">
                                {{ $start }} - {{ $end }} of {{ $total_inventory }} {{ $assetWord }} found
                            </span>
                        </div>
                        <div class="toolbar-right d-flex gap-2 mb-4">
                            <button type="button" class="btn-clear-filters">Clear Filters</button>
                            <select class="form-select form-select-sm tool-select" id="sortSelect">
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="year_desc" {{ request('sort') == 'year_desc' ? 'selected' : '' }}>Year: Newest First</option>
                                <option value="year_asc" {{ request('sort') == 'year_asc' ? 'selected' : '' }}>Year: Oldest First</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-4" id="vehicleContainer">
                        {{-- vehicle div start Car listing page --}}
                        @forelse ($inventory as $recent_vehicle)
                            <div class="col-lg-4 col-sm-6 vehicle-card" 
                                data-id="{{ $recent_vehicle->id }}"
                                data-name="{{ strtolower($recent_vehicle->mfg_auto ?? '') }} {{ strtolower($recent_vehicle->model ?? '') }}"
                                data-price="{{ $recent_vehicle->disclosed_price ?? 0 }}"
                                data-year="{{ $recent_vehicle->year ?? 0 }}">
                                <div class="modern-car-card shadow-sm">
                                    <div class="car-card-top">
                                        @php
                                            $detailUrl = route('inventory_product_details', $recent_vehicle->id);
                                        @endphp
                                        <a href="{{ $detailUrl }}">
                                            <img style="width:100%"
                                                src="{{ $recent_vehicle->primary_image 
                                                    ? (Str::startsWith($recent_vehicle->primary_image,'http') 
                                                        ? $recent_vehicle->primary_image 
                                                        : env('diskloz_base_url').'/admin_assets/images/inventory_images/'.$recent_vehicle->primary_image)
                                                    : asset('assets/images/defaultimage.jpg') }}"
                                                alt="Vehicle Image"
                                                class="img-box img-fluid"
                                                onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultimage.jpg') }}';">
                                        </a>
                                        <button class="card-wishlist-btn"
                                            id="wishlist-btn-{{ $recent_vehicle->id }}"
                                            onclick="event.stopPropagation(); toggleLike({{ $recent_vehicle->id }}, this, {{ auth()->id() ?? 'null' }})"
                                            title="Add to Wishlist">
                                            <i class="fa fa-spinner fa-spin d-none" id="wishlist-spinner-{{ $recent_vehicle->id }}"></i>
                                            <i class="far fa-star" id="wishlist-icon-{{ $recent_vehicle->id }}"></i>
                                        </button>
                                        <div class="badge-mileage d-flex align-items-center">
                                            <img src="/assets/images/mile1.png" alt="Mileage" class="me-2"
                                                style="width:20px; height:12px;">
                                            {{ $recent_vehicle->mileage 
                                                ? trim(str_ireplace('km', '', $recent_vehicle->mileage)) . ' km' 
                                                : '0 km' 
                                            }}
                                        </div>
                                    </div>
                                    <div class="car-card-bottom">
                                        <h5 class="car-main-title">{{ $recent_vehicle->year }} {{ $recent_vehicle->mfg_auto }}
                                            {{ $recent_vehicle->model }} {{ $recent_vehicle->trim }}</h5>

                                        @php
                                            $dealerPostalCode = data_get($recent_vehicle, 'dealer.postal_code')
                                                ?? $recent_vehicle->dealer_postal_code
                                                ?? $recent_vehicle->postal_code
                                                ?? '';
                                            $dealerCity = data_get($recent_vehicle, 'dealer.city')
                                                ?? $recent_vehicle->dealer_city
                                                ?? '';
                                            $dealerProvince = data_get($recent_vehicle, 'dealer.province')
                                                ?? $recent_vehicle->dealer_province
                                                ?? '';
                                            $dealerCountry = data_get($recent_vehicle, 'dealer.country')
                                                ?? $recent_vehicle->dealer_country
                                                ?? '';
                                        @endphp
                                        <p class="car-distance-away"
                                            data-dealer-postal="{{ $dealerPostalCode }}"
                                            data-dealer-city="{{ $dealerCity }}"
                                            data-dealer-province="{{ $dealerProvince }}"
                                            data-dealer-country="{{ $dealerCountry }}">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <span class="distance-value">Loading...</span>
                                        </p>

                                        <!-- <div class="car-circle-icons-group">
                                            <img src="/assets/images/no-accidents.png" alt="">
                                            <img src="/assets/images/low-mileage.png" alt="">
                                            <img src="/assets/images/service-plan.png" alt="">
                                            <img src="/assets/images/powertrain-warranty.png" alt="">
                                            <span class="extra-icons-count">12+</span>
                                        </div> -->

                                        <div class="car-price-block text-end">
                                            @php $displayPrice = round($recent_vehicle->disclosed_price ?? 0); @endphp
                                            @if($displayPrice > 0)
                                                <h4 class="price-value">${{ formatPrice($displayPrice) }}</h4>
                                            @else
                                                @php
                                                    $cardPhone = null;
                                                    if (!empty($dealer) && !empty($dealer->phone_no)) {
                                                        $cardPhone = $dealer->phone_no;
                                                    } elseif (!empty($recent_vehicle->dealer_phone_no)) {
                                                        $cardPhone = $recent_vehicle->dealer_phone_no;
                                                    } elseif (!empty($recent_vehicle->dealer->phone_no)) {
                                                        $cardPhone = $recent_vehicle->dealer->phone_no;
                                                    }
                                                @endphp
                                                @if($cardPhone)
                                                    <a href="tel:{{ $cardPhone }}" class="price-value call-seller d-block text-decoration-none" onclick="event.stopPropagation();">
                                                        <i class="fa-solid fa-phone-volume me-1"></i> Call Seller for Details
                                                    </a>
                                                @else
                                                    <h4 class="price-value call-seller">
                                                        <i class="fa-solid fa-phone-volume me-1"></i> Call Seller for Details
                                                    </h4>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <i class="fas fa-car fa-3x text-muted mb-3"></i>
                                    <h5>No vehicles found</h5>
                                    <p class="text-muted">Try adjusting your filters or check back later.</p>
                                </div>
                            </div>
                        @endforelse
                        {{-- vehicle div end for welcome page --}}
                    </div>

                    @if($inventory->count() > 0)
                        <div class="my-4 pt-5">
                            @include('partials.pagination', [
                                'current_page' => $inventory->currentPage(),
                                'last_page' => $inventory->lastPage()
                            ])
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
<script>
document.addEventListener('DOMContentLoaded', function() {

    const sortSelect = document.getElementById('sortSelect');
    const clearFiltersBtn = document.querySelector('.btn-clear-filters');

    // ✅ SORT (Backend call)
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {

            const value = this.value;
            const text = this.options[this.selectedIndex].text;

            const url = new URL(window.location.href);
            url.searchParams.set('sort', value);

            // snackbar store (after reload show hoga)
            localStorage.setItem('snackbar', `Sorted by: ${text}`);

            window.location.href = url;
        });
    }

    // ✅ CLEAR FILTERS
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', function() {

            const url = new URL(window.location.href);

            // sort remove karo
            url.searchParams.delete('sort');

            localStorage.setItem('snackbar', 'Filters cleared!');
            window.location.href = url;
        });
    }

    // ✅ SHOW SNACKBAR AFTER RELOAD
    const message = localStorage.getItem('snackbar');

    if (message) {
        showSnackbar(message, 'info', 2000);
        localStorage.removeItem('snackbar');
    }

    // ✅ SNACKBAR FUNCTION
    function showSnackbar(message, type = 'success', duration = 3000) {
        let snackbar = document.getElementById('snackbar');

        if (!snackbar) {
            snackbar = document.createElement('div');
            snackbar.id = 'snackbar';
            document.body.appendChild(snackbar);
        }

        snackbar.textContent = message;
        snackbar.className = '';
        snackbar.classList.add('show', type);

        setTimeout(() => {
            snackbar.classList.remove('show');
        }, duration);
    }

});
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Clear Filters Button
        const clearFiltersBtn = document.querySelector('.btn-clear-filters');
        
        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Get current URL
                const currentUrl = new URL(window.location.href);
                
                // Get all current search parameters
                const allParams = new URLSearchParams(currentUrl.search);
                
                // Store the selected_asset value if it exists
                let selectedAsset = null;
                if (allParams.has('selected_asset')) {
                    selectedAsset = allParams.get('selected_asset');
                }
                
                // Remove ALL parameters
                allParams.forEach((value, key) => {
                    currentUrl.searchParams.delete(key);
                });
                
                // Re-add selected_asset if it existed
                if (selectedAsset) {
                    currentUrl.searchParams.set('selected_asset', selectedAsset);
                }
                
                // Alternative: Clear all parameters at once and then add selected_asset
                // currentUrl.search = '';
                // if (selectedAsset) {
                //     currentUrl.searchParams.set('selected_asset', selectedAsset);
                // }
                
                // Redirect to the URL with only selected_asset (if any)
                window.location.href = currentUrl.toString();
            });
        }
    });
</script>
<script>
$(document).ready(function() {
    let isSubmitting = false;
    let submitTimer = null;

    function submitForm() {
        if (isSubmitting) return;
        isSubmitting = true;

        const form = $('#sidebarFilterForm');
        removeEmptyFields(form);
        form.submit();

        setTimeout(() => { isSubmitting = false; }, 1000);
    }

    function removeEmptyFields(form) {
        form.find('input, select, textarea').each(function() {
            const $field = $(this);
            const value = $field.val();
            if (!value || value === '' || 
                value.startsWith('Select') || 
                value.startsWith('Loading') || 
                value.startsWith('No') || 
                value.startsWith('Error')) {
                $field.prop('disabled', true);
            } else {
                $field.prop('disabled', false);
            }
        });
    }

    function debouncedSubmit() {
        clearTimeout(submitTimer);
        submitTimer = setTimeout(submitForm, 300);
    }

    $('#sidebarFilterForm').on('submit', function() {
        $(this).find('input, select, textarea').prop('disabled', false);
        removeEmptyFields($(this));
    });

    $('#sidebarFilterForm select, #sidebarFilterForm input:not([type="text"])').on('change', debouncedSubmit);

    $('#sidebarFilterForm input[type="text"]').on('keypress', function(e) {
        if (e.which === 13) { e.preventDefault(); submitForm(); }
    }).on('blur', function() {
        const $f = $(this);
        const prev = $f.data('previous-value');
        if ($f.val() !== prev) debouncedSubmit();
        $f.data('previous-value', $f.val());
    }).each(function() {
        $(this).data('previous-value', $(this).val());
    });

    // Load makes from dealer_inventory API
    function loadMakes(assetType) {
        const makeDropdown = $('#filter-make');
        makeDropdown.html('<option value="">Loading...</option>');
        if (!assetType) { makeDropdown.html('<option value="">Select Make</option>'); return; }

        $.ajax({
            url: `{{ route('dealer_inventory', ['id' => request()->route('id')]) }}`,
            type: "GET",
            data: { selected_asset: assetType, per_page: 1 },
            success: function(data) {
                let makes = data.makeTypes?.[assetType] || [];
                let options = '<option value="">Select Make</option>';
                const selectedMake = "{{ request('selected_make') }}";

                $.each(makes, function(i, make) {
                    const sel = (selectedMake === make.name) ? 'selected' : '';
                    options += `<option value="${make.name}" ${sel}>${make.name}</option>`;
                });

                makeDropdown.html(options);
                debouncedSubmit();
            },
            error: function() {
                makeDropdown.html('<option value="">Select Make</option>');
                debouncedSubmit();
            }
        });
    }


    function loadBodyStyles(assetType) {
        const bodyDropdown = $('#body-style-select');

        bodyDropdown.html('<option value="">Loading Body Styles...</option>');

        $.ajax({
            url: `{{ route('dealer_inventory', ['id' => request()->route('id')]) }}`,
            type: "GET",
            data: { selected_asset: assetType || '' }, // 🔥 empty bhejo agar null ho
            success: function(data) {
                let bodyStyles = data.body_styles || [];
                let options = '<option value="">Select Body Style</option>';

                const selectedStyle = "{{ request('selected_body_style') }}";

                $.each(bodyStyles, function(i, style) {
                    const sel = (selectedStyle == style.name) ? 'selected' : '';
                    options += `<option value="${style.name}" ${sel}>${style.name}</option>`;
                });

                if (bodyStyles.length === 0) {
                    options = '<option value="">No Body Styles Available</option>';
                }

                bodyDropdown.html(options);
            },
            error: function() {
                bodyDropdown.html('<option value="">Error Loading Body Styles</option>');
            }
        });
    }

    
    $('#sidebar-type').on('change', function () {
        loadBodyStyles($(this).val());
    });

    // Trigger when asset type changes
    $('#sidebar-type').on('change', function() {
        const asset = $(this).val();
        loadMakes(asset);
        loadBodyStyles(asset);
        debouncedSubmit();
    });

    // Clear filters
    $('#clearFilters').on('click', function(e) {
        e.preventDefault();
        const form = $('#sidebarFilterForm')[0];
        form.reset();
        $('#filter-make').html('<option value="">Select Make</option>');
        $('#body-style-select').html('<option value="">Select Body Style</option>');
        $('#year-select, #seller-select').val('');
        $('#sidebarFilterForm input[type="text"]').data('previous-value', '');
        submitForm();
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('form.search-wrapper');
    const typeSelect = document.getElementById('filter-type');
    const makeSelect = document.getElementById('filter-make');
    const conditionInput = document.getElementById('selected_condition_input_2');

    const selectedMake = "{{ request('selected_make') }}";
    const selectedAsset = "{{ request('selected_asset') }}";
    const dealerId = "{{ request()->route('id') }}";

    // -------- CLEAN EMPTY FIELDS (URL FIX) --------
    function cleanEmptyFields() {
        const inputs = form.querySelectorAll('input, select');

        inputs.forEach(input => {
            if (!input.value || input.value.trim() === '') {
                input.disabled = true; // ❌ remove from URL
            } else {
                input.disabled = false;
            }
        });
    }

    // -------- POPULATE MAKES --------
    function populateMakes(makes) {
        if (!makeSelect) return;

        makeSelect.innerHTML = '<option value="">Select Make</option>';

        let found = false;

        makes.forEach(make => {
            const option = document.createElement('option');
            option.value = make.name;
            option.textContent = make.name;

            if (make.name === selectedMake) {
                option.selected = true;
                found = true;
            }

            makeSelect.appendChild(option);
        });

        // fallback (important)
        if (selectedMake && !found) {
            const option = document.createElement('option');
            option.value = selectedMake;
            option.textContent = selectedMake;
            option.selected = true;
            makeSelect.appendChild(option);
        }
    }

    // -------- FETCH MAKES --------
    function fetchMakesByType(type) {
        return fetch(`{{ env('diskloz_base_url') }}/api/dealer_by_id/${dealerId}?selected_asset=${encodeURIComponent(type)}&per_page=1`)
            .then(res => res.json())
            .then(data => {

                if (!data || !data.filters) return [];

                const f = data.filters;

                switch(type) {
                    case 'AUTO': return data.filters.MfgAuto || [];
                    case 'MARINE': return data.filters.MfgMarine || [];
                    case 'RV / TRAILER': return data.filters.MfgRvTrailer || [];
                    case 'SNOWSPORTS': return data.filters.MfgSnowsport || [];
                    case 'MOTORCYCLE / ATV / POWERSPORTS': return data.filters.MfgMotorcycleAtv || [];
                    case 'WATERSPORT': return data.filters.MfgWatersport || [];
                    case 'FARM EQUIPMENT': return data.filters.MfgFarmEquipment || [];
                    case 'HEAVY TRUCK/EQUIPMENT': return data.filters.MfgHeavyTruckEquipment || [];
                    case 'HEAVY DUTY TRAILERS': return data.filters.MfgHeavyDutyTrailer || [];
                    default: return [];
                }
            })
            .catch(() => []);
    }

    // -------- TYPE CHANGE --------
    if (typeSelect) {
        typeSelect.addEventListener('change', function () {
            const type = this.value;

            if (!type) {
                makeSelect.innerHTML = '<option value="">Select Make</option>';
                return;
            }

            fetchMakesByType(type).then(populateMakes);
        });

        // ✅ PAGE LOAD → only selected asset
        if (selectedAsset) {
            fetchMakesByType(selectedAsset).then(populateMakes);
        }
    }

    // -------- FORM SUBMIT CLEAN --------
    if (form) {
        form.addEventListener('submit', function () {
            cleanEmptyFields();
        });
    }

    // -------- TABS --------
    const tabs = document.querySelectorAll('.tabs .tab');

    tabs.forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();

            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            if (conditionInput) {
                conditionInput.value = this.dataset.condition || '';
            }

            cleanEmptyFields(); // ✅ important
            form.submit();
        });
    });

    // -------- RE-ENABLE FIELDS AFTER LOAD --------
    window.addEventListener('pageshow', () => {
        document.querySelectorAll('form.search-wrapper input, form.search-wrapper select')
            .forEach(el => el.disabled = false);
    });

});
</script>

<script>
var DISKLOZ_BASE_DEALER = "{{ env('diskloz_base_url') }}";
$(document).ready(function () {
    @auth
    var authId = {{ auth()->id() }};
    fetch(DISKLOZ_BASE_DEALER + '/api/favorites?client_id=' + authId)
        .then(function(res) { return res.json(); })
        .then(function(data) {
            var likedIds = new Set((data || []).map(function(item) { return item.inventory_id; }));
            $('button[id^="wishlist-btn-"]').each(function () {
                var id = parseInt(this.id.replace('wishlist-btn-', ''));
                if (likedIds.has(id)) {
                    $(this).addClass('active');
                    $('#wishlist-icon-' + id).removeClass('far').addClass('fas').css('color', '#f0a500');
                }
            });
        }).catch(function() {});
    @endauth
});

function toggleLike(vehicleId, element, authId) {
    if (!authId || authId === 'null') { window.location.href = '/login'; return; }
    var $btn = $(element), $icon = $('#wishlist-icon-' + vehicleId);
    var isLiked = $btn.hasClass('active');
    $btn.prop('disabled', true);
    $('#wishlist-spinner-' + vehicleId).removeClass('d-none');
    $icon.addClass('d-none');
    var fd = new FormData();
    fd.append('client_id', authId);
    fd.append('vehicle_id', vehicleId);
    $.ajax({
        url: isLiked ? '/remove_like' : '/add_like', type: 'POST',
        data: fd, processData: false, contentType: false, dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(res) {
            if (res.success) {
                if (isLiked) { $btn.removeClass('active'); $icon.removeClass('fas').addClass('far').css('color', '#aaa'); }
                else { $btn.addClass('active'); $icon.removeClass('far').addClass('fas').css('color', '#f0a500'); }
            }
        },
        complete: function() { $('#wishlist-spinner-' + vehicleId).addClass('d-none'); $icon.removeClass('d-none'); $btn.prop('disabled', false); }
    });
}
</script>

{{-- Distance Filter GPS JS --}}
<script>
(function () {
    var LAT_KEY = 'motokloz_user_lat';
    var LNG_KEY = 'motokloz_user_lng';
    function storedLat() { return localStorage.getItem(LAT_KEY); }
    function storedLng() { return localStorage.getItem(LNG_KEY); }
    function hasStoredCoords() { return storedLat() !== null && storedLng() !== null; }
    function saveCoords(lat, lng) { localStorage.setItem(LAT_KEY, lat); localStorage.setItem(LNG_KEY, lng); }

    function populateInputs(lat, lng) {
        ['dealer-topbar-user-lat', 'dealer-sidebar-user-lat'].forEach(function(id) {
            var el = document.getElementById(id); if (el) el.value = lat;
        });
        ['dealer-topbar-user-lng', 'dealer-sidebar-user-lng'].forEach(function(id) {
            var el = document.getElementById(id); if (el) el.value = lng;
        });
    }

    function showGranted() {
        ['dealer-topbar-distance-select', 'dealer-sidebar-distance-select'].forEach(function(id) {
            var el = document.getElementById(id); if (el) el.style.display = '';
        });
        ['dealer-topbar-allow-location', 'dealer-sidebar-allow-location'].forEach(function(id) {
            var el = document.getElementById(id); if (el) el.style.display = 'none';
        });
    }

    function showAllow() {
        ['dealer-topbar-distance-select', 'dealer-sidebar-distance-select'].forEach(function(id) {
            var el = document.getElementById(id); if (el) el.style.display = 'none';
        });
        ['dealer-topbar-allow-location', 'dealer-sidebar-allow-location'].forEach(function(id) {
            var el = document.getElementById(id); if (el) el.style.display = '';
        });
    }

    function requestLocation() {
        if (!navigator.geolocation) { return; }
        navigator.geolocation.getCurrentPosition(
            function(pos) {
                saveCoords(pos.coords.latitude, pos.coords.longitude);
                populateInputs(pos.coords.latitude, pos.coords.longitude);
                showGranted();
            },
            function() { showAllow(); },
            { timeout: 10000, maximumAge: 300000 }
        );
    }

    document.addEventListener('DOMContentLoaded', function () {
        if (!navigator.geolocation) { return; }

        if (hasStoredCoords()) {
            populateInputs(storedLat(), storedLng());
            showGranted();
        } else {
            showAllow();
        }

        // Bind allow buttons
        ['dealer-topbar-allow-location', 'dealer-sidebar-allow-location'].forEach(function(btnId) {
            var btn = document.getElementById(btnId);
            if (btn) btn.addEventListener('click', function(e) { e.preventDefault(); requestLocation(); });
        });

        // Populate coords on form submit
        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function() {
                if (hasStoredCoords()) populateInputs(storedLat(), storedLng());
            });
        });
    });
})();
</script>

@endsection