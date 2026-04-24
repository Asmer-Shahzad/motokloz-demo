@php
$perPage = 10;
$start = ($current_page - 1) * $perPage + 1;
$end = $start + count($search_inventory_result) - 1;
@endphp

@php
function formatPrice($price)
{
$cleaned = str_replace(['$', ','], '', $price);
$number = is_numeric($cleaned) ? (float) $cleaned : 0;
return number_format($number, 0, '.', ','); // 👈 yahan 2 → 0
}
@endphp

@extends('layouts.app')


@section('content')

<section class="banner-car-listing" data-aos="fade-down" data-aos-duration="700">
    <div class="container-fluid">
        <div class="car-listing-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="car-listing-cont">
                            <h4>'CANADA'S PREMIERE AUTOMOTIVE, LEISURE, AND HEAVY EQUIPMENT MARKETPLACE'</h4>
                            {{-- <h2>Find Your Perfect {{ $assetWord }}</h2>
                            <p>Search and find your best to buy with easy way</p> --}}
                        </div>
                        <div class="search-wrapper">
                            <form action="{{ route('search_inventory') }}" method="GET" class="search-wrapper">

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
                                        <span><a href="tel:+8773475569">Need help?</a></span>
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
                                                @foreach($makeTypes as $type => $makes)
                                                @foreach($makes as $make)
                                                <option value="{{ $make['name'] }}" data-type="{{ $type }}">
                                                    {{ $make['name'] }}
                                                </option>
                                                @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <!-- Model -->
                                    <div class="filter">
                                        <label>Model</label>
                                        <div class="select">
                                            <input type="text" name="selected_model" class="form-control"
                                                placeholder="Enter Model" value="{{ request('selected_model') }}">
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <!-- Price Range -->
                                    <div class="price-box filter">
                                        <label>Price Range</label>

                                        <div class="pr-track-wrap" id="prTrack">
                                            <div class="pr-track"></div>
                                            <div class="pr-fill" id="prFill"></div>
                                            <div class="pr-handle" id="prHandleMin" tabindex="0" role="slider"
                                                aria-label="Minimum price">
                                                <div class="pr-handle-inner"></div>
                                            </div>
                                            <div class="pr-handle" id="prHandleMax" tabindex="0" role="slider"
                                                aria-label="Maximum price">
                                                <div class="pr-handle-inner"></div>
                                            </div>
                                        </div>

                                        <div class="pr-values values">
                                            <div class="pr-input-wrap"><input class="pr-input filter-all"
                                                    id="prMinInput" type="text" inputmode="numeric"></div>
                                            <span class="pr-sep">—</span>
                                            <div class="pr-input-wrap"><input class="pr-input filter-all"
                                                    id="prMaxInput" type="text" inputmode="numeric"></div>
                                        </div>

                                        {{-- Hidden inputs for form submission --}}
                                        <input type="hidden" id="hiddenMin" name="selected_lowest_price"
                                            value="{{ request('selected_lowest_price', 0) }}">
                                        <input type="hidden" id="hiddenMax" name="selected_highest_price"
                                            value="{{ request('selected_highest_price', 1000000) }}">
                                    </div>

                                    <div class="divider"></div>

                                    <!-- Distance to Seller (Top Bar) -->
                                    <div class="filter distance-filter-wrap" id="topbar-distance-wrap">
                                        <label>Distance</label>
                                        <div class="select distance-dropdown-container" id="topbar-distance-container">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <!-- Rendered by JS based on localStorage state -->
                                            <select name="selected_distance" id="topbar-distance-select"
                                                class="filter-options" style="display:none;">
                                                <option value="">Any Distance</option>
                                                <option value="50" {{ ($selected_distance ?? '' )=='50' ? 'selected'
                                                    : '' }}>Under 50 km</option>
                                                <option value="100" {{ ($selected_distance ?? '' )=='100' ? 'selected'
                                                    : '' }}>Under 100 km</option>
                                                <option value="250" {{ ($selected_distance ?? '' )=='250' ? 'selected'
                                                    : '' }}>Under 250 km</option>
                                                <option value="500" {{ ($selected_distance ?? '' )=='500' ? 'selected'
                                                    : '' }}>Under 500 km</option>
                                                <option value="1000" {{ ($selected_distance ?? '' )=='1000' ? 'selected'
                                                    : '' }}>Under 1000 km</option>
                                                <option value="provincial" {{ ($selected_distance ?? '' )=='provincial'
                                                    ? 'selected' : '' }}>Provincial</option>
                                                <option value="national" {{ ($selected_distance ?? '' )=='national'
                                                    ? 'selected' : '' }}>National</option>
                                            </select>
                                            <!-- Allow location button shown when GPS not granted -->
                                            <button type="button" class="btn-allow-location" id="topbar-allow-location"
                                                style="display:none;">
                                                <i class="fa-solid fa-location-crosshairs me-1"></i> Allow Location
                                            </button>
                                            <span class="location-not-supported" id="topbar-location-unsupported"
                                                style="display:none; font-size:12px; color:#aaa;">
                                                Location not supported
                                            </span>
                                        </div>
                                        <!-- Hidden GPS coordinate inputs for top bar form -->
                                        <input type="hidden" name="user_lat" id="topbar-user-lat"
                                            value="{{ $user_lat ?? '' }}">
                                        <input type="hidden" name="user_lng" id="topbar-user-lng"
                                            value="{{ $user_lng ?? '' }}">
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
    </div>
</section>


<section class="fleet-section">
    <div class="container">
        <div class="row fleet-top">
            <div class="col-12">
                <h2 class="main-title">Filter Your Search</h2>
                {{-- <p class="main-subtitle">Turning dreams into reality with versatile vehicles.</p> --}}
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-4" data-aos="fade-right" data-aos-duration="700">
                <form id="sidebarFilterForm" method="GET" action="{{ route('search_inventory') }}">
                    <aside class="complete-sidebar">
                        <h5 class="sidebar-main-heading">Filter Search</h5>

                        <!-- Condition -->
                        <div class="filter-group">
                            <label class="sidebar-label">Condition</label>
                            <select name="selected_condition" class="form-select sidebar-input">
                                <option value="">Select Condition</option>
                                <option value="" {{ request('selected_condition')=='' ? 'selected' : '' }}>All</option>
                                <option value="NEW" {{ request('selected_condition')=='NEW' ? 'selected' : '' }}>New
                                </option>
                                <option value="USED" {{ request('selected_condition')=='USED' ? 'selected' : '' }}>Used
                                </option>
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
                                <option value="GAS" {{ request('selected_power_type')=='GAS' ? 'selected' : '' }}>GAS
                                </option>
                                <option value="DIESEL" {{ request('selected_power_type')=='DIESEL' ? 'selected' : '' }}>
                                    DIESEL</option>
                                <option value="PROPANE" {{ request('selected_power_type')=='PROPANE' ? 'selected' : ''
                                    }}>PROPANE</option>
                                <option value="ELECTRIC" {{ request('selected_power_type')=='ELECTRIC' ? 'selected' : ''
                                    }}>ELECTRIC</option>
                                <option value="OTHER" {{ request('selected_power_type')=='OTHER' ? 'selected' : '' }}>
                                    OTHER</option>
                                <option value="HYBRID" {{ request('selected_power_type')=='HYBRID' ? 'selected' : '' }}>
                                    HYBRID</option>
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
                                <option value="{{ $year }}" {{ $selectedYear==$year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                                @endfor
                            </select>
                        </div>

                        <!-- Make -->
                        <div class="filter-group">
                            <label class="sidebar-label">Make</label>
                            <select name="selected_make" id="filter-make" class="form-select sidebar-input w-100">
                                <option value="">Select Make</option>
                                @if(request('selected_asset') && isset($makeTypes[request('selected_asset')]))
                                @foreach($makeTypes[request('selected_asset')] as $make)
                                <option value="{{ $make['name'] }}" {{ request('selected_make')==$make['name']
                                    ? 'selected' : '' }}>
                                    {{ $make['name'] }}
                                </option>
                                @endforeach
                                @endif
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
                            </select>
                        </div>

                        <!-- Fuel -->
                        <div class="filter-group">
                            <label class="sidebar-label">Fuel Type</label>
                            <select name="selected_fuel_type" class="form-select sidebar-input">
                                <option value="">Select Fuel Type</option>
                                <option value="PREMIUM REQUIRED" {{ request('selected_fuel_type')=='PREMIUM REQUIRED'
                                    ? 'selected' : '' }}>
                                    PREMIUM REQUIRED
                                </option>
                                <option value="PREMIUM RECOMMENDED" {{
                                    request('selected_fuel_type')=='PREMIUM RECOMMENDED' ? 'selected' : '' }}>
                                    PREMIUM RECOMMENDED
                                </option>
                                <option value="REGULAR" {{ request('selected_fuel_type')=='REGULAR' ? 'selected' : ''
                                    }}>
                                    REGULAR
                                </option>
                                <option value="ELECTRIC" {{ request('selected_fuel_type')=='ELECTRIC' ? 'selected' : ''
                                    }}>
                                    ELECTRIC
                                </option>
                            </select>
                        </div>

                        <!-- Seller -->
                        <div class="filter-group">
                            <label class="sidebar-label">Add for sale by</label>
                            <select name="selected_seller" id="seller-select" class="form-select sidebar-input">
                                <option value="All" {{ request('selected_seller')=='ALL' ? 'selected' : '' }}>All
                                </option>
                                <option value="DEALER" {{ request('selected_seller')=='DEALER' ? 'selected' : '' }}>
                                    Dealer</option>
                                <option value="PRIVATE" {{ request('selected_seller')=='PRIVATE' ? 'selected' : '' }}>
                                    Private</option>
                            </select>
                        </div>

                        <!-- Distance to Seller (Sidebar) -->
                        <div class="filter-group" id="sidebar-distance-group">
                            <label class="sidebar-label">
                                <i class="fa-solid fa-location-dot me-1"></i> Distance to Seller
                            </label>
                            <!-- Select shown when GPS is granted -->
                            <select name="selected_distance" id="sidebar-distance-select"
                                class="form-select sidebar-input" style="display:none;">
                                <option value="">Any Distance</option>
                                <option value="50" {{ ($selected_distance ?? '' )=='50' ? 'selected' : '' }}>Under 50 km
                                </option>
                                <option value="100" {{ ($selected_distance ?? '' )=='100' ? 'selected' : '' }}>Under 100
                                    km</option>
                                <option value="250" {{ ($selected_distance ?? '' )=='250' ? 'selected' : '' }}>Under 250
                                    km</option>
                                <option value="500" {{ ($selected_distance ?? '' )=='500' ? 'selected' : '' }}>Under 500
                                    km</option>
                                <option value="1000" {{ ($selected_distance ?? '' )=='1000' ? 'selected' : '' }}>Under
                                    1000 km</option>
                                <option value="provincial" {{ ($selected_distance ?? '' )=='provincial' ? 'selected'
                                    : '' }}>Provincial</option>
                                <option value="national" {{ ($selected_distance ?? '' )=='national' ? 'selected' : ''
                                    }}>National</option>
                            </select>
                            <!-- Allow location button shown when GPS not granted -->
                            <button type="button" class="btn-allow-location w-100" id="sidebar-allow-location"
                                style="display:none;">
                                <i class="fa-solid fa-location-crosshairs me-1"></i> Allow Location
                            </button>
                            <span class="location-not-supported" id="sidebar-location-unsupported"
                                style="display:none; font-size:12px; color:#aaa;">
                                Location not supported by your browser
                            </span>
                            <!-- Hidden GPS coordinate inputs for sidebar form -->
                            <input type="hidden" name="user_lat" id="sidebar-user-lat" value="{{ $user_lat ?? '' }}">
                            <input type="hidden" name="user_lng" id="sidebar-user-lng" value="{{ $user_lng ?? '' }}">
                        </div>
                    </aside>
                </form>
                <!-- <div class="sidebar-map-box mt-4 complete-sidebar">
                                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                                    <span class="map-label">Show on map</span>
                                                                    <i class="fa-solid fa-chevron-down map-toggle-icon"></i>
                                                                </div>
                                                                <img src="/assets/images/map.png" class="img-fluid rounded-3" alt="Map">
                                                            </div> -->
            </div>
            <div class="col-lg-9 col-md-8">
                <div style="border-bottom: 1px solid #DDE1DE;     padding-bottom: 10px;"
                    class="fleet-toolbar d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <div class="toolbar-left d-flex align-items-center">
                        <div class="view-icons me-3">
                            <!-- Grid View -->
                            <svg id="gridViewBtn" width="22" height="24" viewBox="0 0 22 24" fill="none"
                                class="me-2 gridbtn" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 9.5V4.25C20 3.8375 19.6625 3.5 19.25 3.5H14C13.5875 3.5 13.25 3.8375 13.25 4.25V9.5C13.25 9.9125 13.5875 10.25 14 10.25H19.25C19.6625 10.25 20 9.9125 20 9.5ZM19.25 2C20.495 2 21.5 3.005 21.5 4.25V9.5C21.5 10.745 20.495 11.75 19.25 11.75H14C12.755 11.75 11.75 10.745 11.75 9.5V4.25C11.75 3.005 12.755 2 14 2H19.25Z" />
                                <path
                                    d="M20 20.75V15.5C20 15.0875 19.6625 14.75 19.25 14.75H14C13.5875 14.75 13.25 15.0875 13.25 15.5V20.75C13.25 21.1625 13.5875 21.5 14 21.5H19.25C19.6625 21.5 20 21.1625 20 20.75ZM19.25 13.25C20.495 13.25 21.5 14.255 21.5 15.5V20.75C21.5 21.995 20.495 23 19.25 23H14C12.755 23 11.75 21.995 11.75 20.75V15.5C11.75 14.255 12.755 13.25 14 13.25H19.25Z" />
                                <path
                                    d="M8 10.25C8.4125 10.25 8.75 9.9125 8.75 9.5V4.25C8.75 3.8375 8.4125 3.5 8 3.5H2.75C2.3375 3.5 2 3.8375 2 4.25V9.5C2 9.9125 2.3375 10.25 2.75 10.25H8ZM8 2C9.245 2 10.25 3.005 10.25 4.25V9.5C10.25 10.745 9.245 11.75 8 11.75H2.75C1.505 11.75 0.5 10.745 0.5 9.5V4.25C0.5 3.005 1.505 2 2.75 2H8Z" />
                                <path
                                    d="M8 21.5C8.4125 21.5 8.75 21.1625 8.75 20.75V15.5C8.75 15.0875 8.4125 14.75 8 14.75H2.75C2.3375 14.75 2 15.0875 2 15.5V20.75C2 21.1625 2.3375 21.5 2.75 21.5H8ZM8 13.25C9.245 13.25 10.25 14.255 10.25 15.5V20.75C10.25 21.995 9.245 23 8 23H2.75C1.505 23 0.5 21.995 0.5 20.75V15.5C0.5 14.255 1.505 13.25 2.75 13.25H8Z" />
                            </svg>
                            <!-- List View -->
                            <svg id="listViewBtn" width="21" height="21" viewBox="0 0 21 21" fill="none" class="gridbtn"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.788 0H1.09497C0.491194 0 0 0.486501 0 1.08456V4.74269C0 5.34075 0.491194 5.82729 1.09497 5.82729H4.788C5.39177 5.82729 5.88297 5.34075 5.88297 4.74269V1.08456C5.88297 0.486501 5.39177 0 4.788 0ZM4.80951 4.74273C4.80951 4.75328 4.79865 4.76404 4.788 4.76404H1.09497C1.08432 4.76404 1.07345 4.75328 1.07345 4.74273V1.08456C1.07345 1.07401 1.08432 1.06329 1.09497 1.06329H4.788C4.79865 1.06329 4.80951 1.07401 4.80951 1.08456V4.74273ZM7.53412 1.32686C7.53412 1.03321 7.77444 0.795211 8.07084 0.795211H20.4632C20.7596 0.795211 21 1.03321 21 1.32686C21 1.62046 20.7596 1.8585 20.4632 1.8585H8.07084C7.77444 1.8585 7.53412 1.62046 7.53412 1.32686ZM21 4.50043C21 4.79408 20.7597 5.03208 20.4633 5.03208H8.07084C7.77444 5.03208 7.53412 4.79408 7.53412 4.50043C7.53412 4.20683 7.77444 3.96879 8.07084 3.96879H20.4632C20.7597 3.96879 21 4.20683 21 4.50043ZM4.788 7.58633H1.09497C0.491194 7.58633 0 8.07283 0 8.67089V12.329C0 12.9271 0.491194 13.4136 1.09497 13.4136H4.788C5.39177 13.4136 5.88297 12.9271 5.88297 12.329V8.67089C5.88297 8.07288 5.39177 7.58633 4.788 7.58633ZM4.80951 12.3291C4.80951 12.3396 4.79865 12.3504 4.788 12.3504H1.09497C1.08432 12.3504 1.07345 12.3396 1.07345 12.3291V8.67094C1.07345 8.66039 1.08432 8.64967 1.09497 8.64967H4.788C4.79865 8.64967 4.80951 8.66039 4.80951 8.67094V12.3291ZM4.788 15.1727H1.09497C0.491194 15.1727 0 15.6592 0 16.2573V19.9154C0 20.5135 0.491194 21 1.09497 21H4.788C5.39177 21 5.88297 20.5135 5.88297 19.9154V16.2573C5.88297 15.6592 5.39177 15.1727 4.788 15.1727ZM4.80951 19.9154C4.80951 19.926 4.79865 19.9368 4.788 19.9368H1.09497C1.08432 19.9368 1.07345 19.926 1.07345 19.9154V16.2573C1.07345 16.2468 1.08432 16.236 1.09497 16.236H4.788C4.79865 16.236 4.80951 16.2468 4.80951 16.2573V19.9154ZM21 12.0868C21 12.3805 20.7597 12.6185 20.4633 12.6185H8.07084C7.77444 12.6185 7.53412 12.3805 7.53412 12.0868C7.53412 11.7932 7.77444 11.5552 8.07084 11.5552H20.4632C20.7597 11.5552 21 11.7932 21 12.0868ZM21 8.91328C21 9.20688 20.7597 9.44492 20.4633 9.44492H8.07084C7.77444 9.44492 7.53412 9.20688 7.53412 8.91328C7.53412 8.61963 7.77444 8.38163 8.07084 8.38163H20.4632C20.7597 8.38163 21 8.61963 21 8.91328ZM21 16.4996C21 16.7932 20.7597 17.0313 20.4633 17.0313H8.07084C7.77444 17.0313 7.53412 16.7932 7.53412 16.4996C7.53412 16.206 7.77444 15.968 8.07084 15.968H20.4632C20.7597 15.968 21 16.206 21 16.4996ZM21 19.6732C21 19.9668 20.7597 20.2048 20.4633 20.2048H8.07084C7.77444 20.2048 7.53412 19.9668 7.53412 19.6732C7.53412 19.3796 7.77444 19.1415 8.07084 19.1415H20.4632C20.7597 19.1415 21 19.3796 21 19.6732Z" />
                            </svg>
                        </div>
                        <span class="results-info">
                            {{ $start }} - {{ $end }} of {{ $total_inventory }} {{ $assetWord }} found
                        </span>
                    </div>
                    <div class="toolbar-right d-flex gap-2 mb-4">
                        <button type="button" class="btn-clear-filters">Clear Filters</button>
                        <select class="form-select form-select-sm tool-select" id="sortSelect">
                            <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Price: Low to
                                High</option>
                            <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Price: High
                                to Low</option>
                            <option value="year_desc" {{ request('sort')=='year_desc' ? 'selected' : '' }}>Year: Newest
                                First</option>
                            <option value="year_asc" {{ request('sort')=='year_asc' ? 'selected' : '' }}>Year: Oldest
                                First</option>
                        </select>
                    </div>
                </div>
                <div class="row g-4" id="vehicleContainer">
                    @if ($search_inventory_result != null && count($search_inventory_result) > 0)
                    @foreach ($search_inventory_result as $recent_vehicle)
                    <div class="col-lg-4 col-sm-6 vehicle-card" data-id="{{ $recent_vehicle->id }}"
                        data-name="{{ strtolower($recent_vehicle->mfg_auto ?? '') }} {{ strtolower($recent_vehicle->model ?? '') }}"
                        data-price="{{ $recent_vehicle->disclosed_price ?? 0 }}"
                        data-year="{{ $recent_vehicle->year ?? 0 }}">
                        <div class="modern-car-card shadow-sm">
                            <div class="car-card-top">
                                @php
                                // Create a URL-friendly slug from the vehicle title
                                $vehicleName = $recent_vehicle->year . ' ' .
                                ($recent_vehicle->mfg_auto ?? '') . ' ' .
                                ($recent_vehicle->model ?? '');
                                $slug = Str::slug($vehicleName, '-');
                                $detailUrl = route('inventory_product_details', ['name' => $slug, 'id' =>
                                $recent_vehicle->id]);
                                @endphp
                                <a href="{{ $detailUrl }}">
                                    <img style="width:100%" src="{{ $recent_vehicle->primary_image
                                    ? (Str::startsWith($recent_vehicle->primary_image, 'http')
                                        ? $recent_vehicle->primary_image
                                        : env('diskloz_base_url') . '/admin_assets/images/inventory_images/' . $recent_vehicle->primary_image)
                                    : asset('assets/images/defaultimage.jpg') }}" alt="Vehicle Image"
                                        class="img-box img-fluid"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultimage.jpg') }}';">
                                </a>
                                {{-- ★ Wishlist Star Button --}}
                                <button class="card-wishlist-btn" id="wishlist-btn-{{ $recent_vehicle->id }}"
                                    onclick="event.stopPropagation(); toggleLike({{ $recent_vehicle->id }}, this, {{ auth()->id() ?? 'null' }})"
                                    title="Add to Wishlist">
                                    
                                    <i class="fa-spin fa-spinner fa d-none"
                                        id="wishlist-spinner-{{ $recent_vehicle->id }}"></i>
                                    
                                    <i class="far fa-star" id="wishlist-icon-{{ $recent_vehicle->id }}"></i>
                                </button>
                                <div class="badge-mileage d-flex align-items-center">
                                    <img src="/assets/images/mile1.png" alt="Mileage" class="me-2"
                                        style="width:20px; height:12px;">
                                    {{ $recent_vehicle->mileage 
                                        ? number_format((float) trim(str_ireplace('km', '', $recent_vehicle->mileage))) . ' km'
                                        : '0 km'
                                    }}
                                </div>
                            </div>
                            <div class="car-card-bottom">
                                <h5 class="car-main-title">{{ $recent_vehicle->year }} {{ $recent_vehicle->mfg_auto }}
                                    {{ $recent_vehicle->model }} {{ $recent_vehicle->trim }}
                                </h5>

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
                                <p class="car-distance-away" data-dealer-postal="{{ $dealerPostalCode }}"
                                    data-dealer-city="{{ $dealerCity }}" data-dealer-province="{{ $dealerProvince }}"
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
                                    if (!empty($recent_vehicle->dealer) && !empty($recent_vehicle->dealer->phone_no)) {
                                    $cardPhone = $recent_vehicle->dealer->phone_no;
                                    } elseif (!empty($recent_vehicle->dealer_phone_no)) {
                                    $cardPhone = $recent_vehicle->dealer_phone_no;
                                    } elseif (!empty($recent_vehicle->phone_no)) {
                                    $cardPhone = $recent_vehicle->phone_no;
                                    }
                                    @endphp
                                    @if($cardPhone)
                                    <a href="tel:{{ $cardPhone }}"
                                        class="price-value call-seller d-block text-decoration-none"
                                        onclick="event.stopPropagation();">
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
                    @endforeach
                </div>
                @else
                <div class="col-12 text-center my-5">
                    <i class="fas fa-car fa-3x text-muted mb-3"></i>
                    <p class="text-center">No vehicles found matching your criteria.</p>
                </div>
                @endif

                @if ($search_inventory_result != null && count($search_inventory_result) > 0)
                <div class="my-4">
                    @include('partials.pagination')
                </div>
                @endif
            </div>
        </div>
    </div>

    </div>
    </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const sortSelect = document.getElementById('sortSelect');
        const clearFiltersBtn = document.querySelector('.btn-clear-filters');

        // ✅ SET SELECT VALUE FROM URL (IMPORTANT UX FIX)
        const params = new URLSearchParams(window.location.search);
        const currentSort = params.get('sort');

        if (sortSelect && currentSort) {
            sortSelect.value = currentSort;
        }

        // ✅ SORT (Backend)
        if (sortSelect) {
            sortSelect.addEventListener('change', function () {

                const value = this.value;
                const text = this.options[this.selectedIndex].text;

                const url = new URL(window.location.href);
                url.searchParams.set('sort', value);

                // Preserve distance params
                const storedLat = localStorage.getItem('motokloz_user_lat');
                const storedLng = localStorage.getItem('motokloz_user_lng');
                if (storedLat && storedLng) {
                    if (!url.searchParams.get('user_lat')) url.searchParams.set('user_lat', storedLat);
                    if (!url.searchParams.get('user_lng')) url.searchParams.set('user_lng', storedLng);
                }

                localStorage.setItem('snackbar', `Sorted by: ${text}`);

                window.location.href = url;
            });
        }

        // ✅ CLEAR FILTERS
        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', function () {

                const url = new URL(window.location.href);

                url.searchParams.delete('sort');
                url.searchParams.delete('page'); // 👈 important

                localStorage.setItem('snackbar', 'Filters cleared!');
                window.location.href = url;
            });
        }

        // ✅ SNACKBAR AFTER RELOAD
        const message = localStorage.getItem('snackbar');

        if (message) {
            showSnackbar(message, 'info', 2000);
            localStorage.removeItem('snackbar');
        }

        function showSnackbar(message, type = 'success', duration = 3000) {
            let snackbar = document.getElementById('snackbar');

            if (!snackbar) {
                snackbar = document.createElement('div');
                snackbar.id = 'snackbar';
                document.body.appendChild(snackbar);
            }

            snackbar.textContent = message;
            snackbar.className = 'show ' + type;

            setTimeout(() => {
                snackbar.classList.remove('show');
            }, duration);
        }

    });
</script>
<script>
    const bodyStyleTypes = @json($bodyStyleTypes);
    const selectedAsset = "{{ request('selected_asset') }}";
    const selectedBodyStyle = "{{ request('selected_body_style') }}";
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Clear Filters Button
        const clearFiltersBtn = document.querySelector('.btn-clear-filters');

        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', function (e) {
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
    const bodyStyleTypes = @json($bodyStyleTypes);
    const selectedBodyStyle = "{{ request('selected_body_style') }}";
</script>
<script>
    $(document).ready(function () {
        let isSubmitting = false;
        let submitTimer = null;

        // Function to submit form
        function submitForm() {
            if (isSubmitting) {
                return;
            }
            isSubmitting = true;
            const form = $('#sidebarFilterForm');
            removeEmptyFields(form);
            form.submit();
            setTimeout(function () {
                isSubmitting = false;
            }, 1000);
        }

        // Remove empty fields before submitting
        function removeEmptyFields(form) {
            form.find('input, select, textarea').each(function () {
                const $field = $(this);
                const fieldValue = $field.val();
                if (!fieldValue || fieldValue === '' ||
                    fieldValue === 'Select Make' ||
                    fieldValue === 'Select Body Style' ||
                    fieldValue === 'Loading...' ||
                    fieldValue === 'No Body Styles Available' ||
                    fieldValue === 'Error Loading Body Styles') {
                    $field.prop('disabled', true);
                } else {
                    $field.prop('disabled', false);
                }
            });
        }

        // Debounced function to prevent multiple rapid triggers
        function debouncedSubmit() {
            clearTimeout(submitTimer);
            submitTimer = setTimeout(function () {
                submitForm();
            }, 300);
        }

        // Re‑enable fields before form submit
        $('#sidebarFilterForm').on('submit', function () {
            $(this).find('input, select, textarea').each(function () {
                $(this).prop('disabled', false);
            });
            removeEmptyFields($(this));
        });

        // 1. Auto‑submit on select change
        $('#sidebarFilterForm select').on('change', function () {
            debouncedSubmit();
        });

        // 2. Auto‑submit on non‑text input changes (checkboxes, radios, etc.)
        $('#sidebarFilterForm input:not([type="text"])').on('change', function () {
            debouncedSubmit();
        });

        // 3. Submit text inputs when Enter is pressed
        $('#sidebarFilterForm input[type="text"]').on('keypress', function (e) {
            if (e.which === 13) { // Enter key
                e.preventDefault();
                submitForm();
            }
        });

        // 4. Submit text inputs when they lose focus (blur) - user clicks outside or tabs away
        $('#sidebarFilterForm input[type="text"]').on('blur', function () {
            // Only submit if the value actually changed
            const $field = $(this);
            const currentValue = $field.val();
            const previousValue = $field.data('previous-value');

            if (currentValue !== previousValue) {
                debouncedSubmit();
            }
            // Store current value for next comparison
            $field.data('previous-value', currentValue);
        });

        // Store initial values for text inputs
        $('#sidebarFilterForm input[type="text"]').each(function () {
            $(this).data('previous-value', $(this).val());
        });

        function loadBodyStyles(assetType) {
            const bodyStyleSelect = $('#body-style-select');

            let options = '<option value="">Select Body Style</option>';
            let bodyStyles = [];

            // ✅ Case 1: No asset selected → merge ALL
            if (!assetType) {
                Object.values(bodyStyleTypes).forEach(arr => {
                    bodyStyles = bodyStyles.concat(arr);
                });

                // 🔥 remove duplicates
                bodyStyles = bodyStyles.filter(
                    (v, i, a) => a.findIndex(t => t.name === v.name) === i
                );
            }
            // ✅ Case 2: Specific asset
            else {
                bodyStyles = bodyStyleTypes[assetType] || [];
            }

            if (bodyStyles.length > 0) {
                bodyStyles.forEach(style => {
                    const selected = (selectedBodyStyle == style.name) ? 'selected' : '';
                    options += `<option value="${style.name}" ${selected}>${style.name}</option>`;
                });
            } else {
                options = '<option value="">No Body Styles Available</option>';
            }

            bodyStyleSelect.html(options);
        }

        $(document).ready(function () {

            // 🔹 page load
            loadBodyStyles($('#sidebar-type').val());

            // 🔹 asset change
            $('#sidebar-type').on('change', function () {
                loadBodyStyles($(this).val());
            });

        });

        // Load makes based on asset type
        function loadMakes(assetType) {
            const makeDropdown = $('#filter-make');
            makeDropdown.html('<option value="">Loading...</option>');
            if (!assetType) {
                makeDropdown.html('<option value="">Select Make</option>');
                debouncedSubmit();
                return;
            }
            $.ajax({
                url: "{{ env('diskloz_base_url') }}/api/search_inventory",
                type: "GET",
                data: { selected_asset: assetType, per_page: 1 },
                success: function (data) {
                    let makes = [];
                    switch (assetType) {
                        case 'AUTO':
                            makes = data.filters?.MfgAuto || [];
                            break;
                        case 'MARINE':
                            makes = data.filters?.MfgMarine || [];
                            break;
                        case 'RV / TRAILER':
                            makes = data.filters?.MfgRvTrailer || [];
                            break;
                        case 'MOTORCYCLE / ATV / POWERSPORTS':
                            makes = data.filters?.MfgMotorcycleAtv || [];
                            break;
                        case 'HEAVY TRUCK/EQUIPMENT':
                            makes = data.filters?.MfgHeavyTruckEquipment || [];
                            break;
                        case 'HEAVY DUTY TRAILERS':
                            makes = data.filters?.MfgHeavyDutyTrailer || [];
                            break;
                        case 'FARM EQUIPMENT':
                            makes = data.filters?.MfgFarmEquipment || [];
                            break;
                        default:
                            makes = [];
                    }
                    let options = '<option value="">Select Make</option>';
                    const currentSelectedMake = "{{ request('selected_make') }}";
                    $.each(makes, function (i, make) {
                        const selected = (currentSelectedMake === make.name) ? 'selected' : '';
                        options += `<option value="${make.name}" ${selected}>${make.name}</option>`;
                    });
                    makeDropdown.html(options);
                    debouncedSubmit();
                },
                error: function (err) {
                    console.error('Error fetching makes:', err);
                    makeDropdown.html('<option value="">Select Make</option>');
                    debouncedSubmit();
                }
            });
        }

        // Dynamic dropdowns based on Asset Type
        $('#sidebar-type').on('change', function () {
            const type = $(this).val();
            loadMakes(type);
            loadBodyStyles(type);
            debouncedSubmit();
        });

        // Clear Filters functionality
        $('#clearFilters').on('click', function (e) {
            e.preventDefault();
            $('#sidebarFilterForm')[0].reset();
            $('#filter-make').html('<option value="">Select Make</option>');
            $('#body-style-select').html('<option value="">Select Body Style</option>');
            $('#year-select').val('');
            $('#seller-select').val('');

            // Reset stored values for text inputs
            $('#sidebarFilterForm input[type="text"]').each(function () {
                $(this).data('previous-value', '');
            });

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

        // -------- POPULATE MAKES --------
        function populateMakes(makes) {
            if (!makeSelect) return;

            makeSelect.innerHTML = '<option value="">Select Make</option>';

            makes.forEach(make => {
                const option = document.createElement('option');
                option.value = make.name;
                option.textContent = make.name;

                if (make.name === selectedMake) {
                    option.selected = true;
                }

                makeSelect.appendChild(option);
            });
        }

        // -------- FETCH MAKES --------
        function fetchMakesByType(type) {
            return fetch(`{{ env('diskloz_base_url') }}/api/search_inventory?selected_asset=${encodeURIComponent(type)}&per_page=1`)
                .then(res => res.json())
                .then(data => {

                    if (!data || !data.filters) return [];

                    switch (type) {
                        case 'AUTO': return data.filters.MfgAuto || [];
                        case 'MARINE': return data.filters.MfgMarine || [];
                        case 'SNOWSPORTS': return data.filters.MfgSnowsport || [];
                        case 'WATERSPORT': return data.filters.MfgWatersport || [];
                        case 'RV / TRAILER': return data.filters.MfgRvTrailer || [];
                        case 'MOTORCYCLE / ATV / POWERSPORTS': return data.filters.MfgMotorcycleAtv || [];
                        case 'HEAVY TRUCK/EQUIPMENT': return data.filters.MfgHeavyTruckEquipment || [];
                        case 'HEAVY DUTY TRAILERS': return data.filters.MfgHeavyDutyTrailer || [];
                        case 'FARM EQUIPMENT': return data.filters.MfgFarmEquipment || [];
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
                    if (makeSelect) {
                        makeSelect.innerHTML = '<option value="">Select Make</option>';
                    }
                    return;
                }

                fetchMakesByType(type).then(populateMakes);
            });

            if (typeSelect.value) {
                fetchMakesByType(typeSelect.value).then(populateMakes);
            }
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

                if (form && typeof form.submit === 'function') {
                    form.submit(); // ✅ FIXED
                }
            });
        });

    });
</script>

<script>
    // ===================== WISHLIST (CAR LISTING CARDS) =====================
    var DISKLOZ_BASE = "{{ env('diskloz_base_url') }}";

    $(document).ready(function () {
        @auth
        var authId = {{ auth() -> id()
    }};
    fetch(DISKLOZ_BASE + '/api/favorites?client_id=' + authId)
        .then(function (res) { return res.json(); })
        .then(function (data) {
            var likedIds = new Set((data || []).map(function (item) { return item.inventory_id; }));
            $('button[id^="wishlist-btn-"]').each(function () {
                var id = parseInt(this.id.replace('wishlist-btn-', ''));
                if (likedIds.has(id)) {
                    $(this).addClass('active');
                    var $icon = $('#wishlist-icon-' + id);
                    $icon.removeClass('far').addClass('fas');
                    $icon.css('color', '#f0a500');
                }
            });
        })
        .catch(function () { });
    @endauth
    });

    function toggleLike(vehicleId, element, authId) {
        if (!authId || authId === 'null') { window.location.href = '/login'; return; }

        var $btn = $(element);
        var $icon = $('#wishlist-icon-' + vehicleId);
        var isLiked = $btn.hasClass('active');

        $btn.prop('disabled', true);
        $('#wishlist-spinner-' + vehicleId).removeClass('d-none');
        $icon.addClass('d-none');

        var formData = new FormData();
        formData.append('client_id', authId);
        formData.append('vehicle_id', vehicleId);

        $.ajax({
            url: isLiked ? '/remove_like' : '/add_like',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (res) {
                if (res.success) {
                    if (isLiked) {
                        $btn.removeClass('active');
                        $icon.removeClass('fas').addClass('far');
                        $icon.css('color', '#aaa');
                    } else {
                        $btn.addClass('active');
                        $icon.removeClass('far').addClass('fas');
                        $icon.css('color', '#f0a500');
                    }
                }
            },
            complete: function () {
                $('#wishlist-spinner-' + vehicleId).addClass('d-none');
                $icon.removeClass('d-none');
                $btn.prop('disabled', false);
            }
        });
    }
</script>

{{-- ============================================================
DISTANCE FILTER — Geolocation + localStorage
============================================================ --}}
<script>
    (function () {
        var LAT_KEY = 'motokloz_user_lat';
        var LNG_KEY = 'motokloz_user_lng';

        function storedLat() { return localStorage.getItem(LAT_KEY); }
        function storedLng() { return localStorage.getItem(LNG_KEY); }
        function hasStoredCoords() { return storedLat() !== null && storedLng() !== null; }

        function saveCoords(lat, lng) {
            localStorage.setItem(LAT_KEY, lat);
            localStorage.setItem(LNG_KEY, lng);
        }

        function populateHiddenInputs(lat, lng) {
            ['topbar-user-lat', 'sidebar-user-lat'].forEach(function (id) {
                var el = document.getElementById(id);
                if (el) el.value = lat;
            });
            ['topbar-user-lng', 'sidebar-user-lng'].forEach(function (id) {
                var el = document.getElementById(id);
                if (el) el.value = lng;
            });
        }

        function showGrantedState() {
            var topSelect = document.getElementById('topbar-distance-select');
            var topAllow = document.getElementById('topbar-allow-location');
            var topUnsup = document.getElementById('topbar-location-unsupported');
            if (topSelect) topSelect.style.display = '';
            if (topAllow) topAllow.style.display = 'none';
            if (topUnsup) topUnsup.style.display = 'none';

            var sideSelect = document.getElementById('sidebar-distance-select');
            var sideAllow = document.getElementById('sidebar-allow-location');
            var sideUnsup = document.getElementById('sidebar-location-unsupported');
            if (sideSelect) sideSelect.style.display = '';
            if (sideAllow) sideAllow.style.display = 'none';
            if (sideUnsup) sideUnsup.style.display = 'none';
        }

        function showAllowState() {
            var topSelect = document.getElementById('topbar-distance-select');
            var topAllow = document.getElementById('topbar-allow-location');
            if (topSelect) topSelect.style.display = 'none';
            if (topAllow) topAllow.style.display = '';

            var sideSelect = document.getElementById('sidebar-distance-select');
            var sideAllow = document.getElementById('sidebar-allow-location');
            if (sideSelect) sideSelect.style.display = 'none';
            if (sideAllow) sideAllow.style.display = '';
        }

        function showUnsupportedState() {
            ['topbar-distance-select', 'sidebar-distance-select'].forEach(function (id) {
                var el = document.getElementById(id);
                if (el) el.style.display = 'none';
            });
            ['topbar-allow-location', 'sidebar-allow-location'].forEach(function (id) {
                var el = document.getElementById(id);
                if (el) el.style.display = 'none';
            });
            ['topbar-location-unsupported', 'sidebar-location-unsupported'].forEach(function (id) {
                var el = document.getElementById(id);
                if (el) el.style.display = '';
            });
        }

        function requestLocation() {
            if (!navigator.geolocation) {
                showUnsupportedState();
                return;
            }
            navigator.geolocation.getCurrentPosition(
                function (pos) {
                    var lat = pos.coords.latitude;
                    var lng = pos.coords.longitude;
                    saveCoords(lat, lng);
                    populateHiddenInputs(lat, lng);
                    showGrantedState();
                },
                function () {
                    // Denied — keep showing allow button, do not save coords
                    showAllowState();
                },
                { timeout: 10000, maximumAge: 300000 }
            );
        }

        document.addEventListener('DOMContentLoaded', function () {

            if (!navigator.geolocation) {
                showUnsupportedState();
                return;
            }

            if (hasStoredCoords()) {
                populateHiddenInputs(storedLat(), storedLng());
                showGrantedState();
            } else {
                showAllowState();
            }

            // Bind both allow-location buttons
            ['topbar-allow-location', 'sidebar-allow-location'].forEach(function (btnId) {
                var btn = document.getElementById(btnId);
                if (!btn) return;
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    requestLocation();
                });
            });

            // Sidebar distance select — ensure coords in hidden inputs before submit
            var sideSelect = document.getElementById('sidebar-distance-select');
            if (sideSelect) {
                sideSelect.addEventListener('change', function () {
                    if (hasStoredCoords()) {
                        populateHiddenInputs(storedLat(), storedLng());
                    }
                });
            }

            // Top bar distance select — ensure coords in hidden inputs before submit
            var topSelect = document.getElementById('topbar-distance-select');
            if (topSelect) {
                topSelect.addEventListener('change', function () {
                    if (hasStoredCoords()) {
                        populateHiddenInputs(storedLat(), storedLng());
                    }
                });
            }

            // Top bar form submit — ensure coords are populated
            var topbarForm = document.querySelector('form.search-wrapper');
            if (topbarForm) {
                topbarForm.addEventListener('submit', function () {
                    if (hasStoredCoords()) {
                        populateHiddenInputs(storedLat(), storedLng());
                    }
                });
            }

            // Sidebar form submit — ensure coords are populated
            var sidebarForm = document.getElementById('sidebarFilterForm');
            if (sidebarForm) {
                sidebarForm.addEventListener('submit', function () {
                    if (hasStoredCoords()) {
                        populateHiddenInputs(storedLat(), storedLng());
                    }
                });
            }
        });

    })();
</script>

@endsection