@extends('layouts.app')

@section('content')



    <div class="container listing-page my-5">

        @include('partials.user-account-breadcrumbs')
        <h2 class="main-head">My Wishlist</h2>

        <div class="row g-4">


            @include('partials.user-account-sidebar')
            <!-- Main Content -->
            <div class="col-lg-9 wishlist-sec">

                <!-- Wishlist Header Bar -->
                <div class="wishlist-header d-flex justify-content-between align-items-center px-3 px-md-4 py-3">

                    <h5 class=" search-head">My Wishlist</h5>

                    <div class="d-flex align-items-center gap-2 header-actions">

                        <!-- Search -->
                        <div class="position-relative searchbar">
                            <form action="{{ request()->url() }}" method="GET" id="searchForm">
                                <input type="text" 
                                    name="search" 
                                    class="form-control rounded-pill ps-5 pe-3 w-100" 
                                    placeholder="Search"
                                    value="{{ $searchTerm ?? '' }}">

                                <span class="position-absolute top-50 start-0 translate-middle-y ps-3">
                                    <img src="/assets/images/Vector (13).png" alt="search" width="16" height="16">
                                </span>
                                
                                {{-- Preserve u parameter --}}
                                @if(request()->has('u'))
                                <input type="hidden" name="u" value="{{ request()->get('u') }}">
                                @endif
                                
                                {{-- Preserve sort parameter when searching --}}
                                @if(request()->has('sort'))
                                <input type="hidden" name="sort" value="{{ request()->get('sort') }}">
                                @endif
                            </form>
                        </div>

                        <!-- Sort -->
                        <!-- Sort Dropdown -->
                        <div class="dropdown">
                            <button class="filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="/assets/images/filter.png" class="me-2 filter-icon" alt="">
                                Sort
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item {{ $currentSort == 'price_asc' ? 'active' : '' }}" 
                                    href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}">
                                        Price: Low to High
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ $currentSort == 'price_desc' ? 'active' : '' }}" 
                                    href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}">
                                        Price: High to Low
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ $currentSort == 'newest' ? 'active' : '' }}" 
                                    href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">
                                        Newest First
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>
                
                <div class="wishlist-body">
                    <!-- Wishlist Items -->
                    <div class="wishlist-items">
                        @foreach($favorites as $favorite)
                            @php
                                $inventory = $favorite->inventory ?? null;
                                
                                // ✅ Check if this is Motokloz inventory
                                $isMotoklozInventory = isset($inventory->source) && $inventory->source === 'Motokloz';
                                
                                // ✅ Get required data for modals
                                $vehicleId = $inventory->id ?? '';
                                $dealerId = $inventory->user_id ?? '';
                                $dealerEmail = $inventory->dealer_email ?? '';
                            @endphp
                            
                            <!-- Dynamic Item -->
                            <div class="wishlist-card mb-4" data-aos="fade-up" data-aos-duration="600">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        @php $detailUrl = route('inventory_product_details', $inventory->id); @endphp
                                        <a href="{{ $detailUrl }}">
                                            <img style="width:100%" src="{{ $inventory->primary_image 
                                                ? (Str::startsWith($inventory->primary_image,'http') 
                                                    ? $inventory->primary_image 
                                                    : $disklozBaseUrl.'/admin_assets/images/inventory_images/'.$inventory->primary_image)
                                                : asset('assets/images/defaultimage.jpg') }}"
                                                alt="Vehicle Image"
                                                class="img-fluid rounded-start wishlist-img"
                                                onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultimage.jpg') }}';">
                                        </a>
                                    </div>
                                    <div class="col-md-7 cards-wish-all">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-start mb-2 badge-main">
                                                @if(isset($inventory->discount) && $inventory->discount > 0)
                                                <span class="discount-badge">-{{ $inventory->discount }}%</span>
                                                @else
                                                <span class="discount-badge">-{{ $inventory->discount ?? '0' }}%</span>
                                                @endif
                                            </div>
                                            
                                            <div class="rating-all d-flex align-items-center gap-2 mb-2">
                                                <img src="/assets/images/Vector (12).png" alt="rating" width="16">
                                                <p class="rating-all-p mb-0">
                                                    <strong>{{ $inventory->rating ?? '4.96' }}</strong> 
                                                    ({{ $inventory->reviews ?? '672' }} reviews)
                                                </p>
                                            </div>

                                            <h5 class="card-title fw-bold mb-2">
                                                {{ $inventory->year }} {{ $inventory->mfg_auto }} {{ $inventory->model }} {{ $inventory->trim }}
                                            </h5>

                                            @php
                                                $dealerPostalCode = $inventory->dealer_postal_code ?? $favorite->dealer_postal_code ?? $inventory->postal_code ?? '';
                                                $dealerCity = $inventory->dealer_city ?? $favorite->dealer_city ?? $inventory->city ?? '';
                                                $dealerProvince = $inventory->dealer_province ?? $favorite->dealer_province ?? $inventory->province ?? '';
                                                $dealerCountry = $inventory->dealer_country ?? $favorite->dealer_country ?? $inventory->country ?? '';
                                            @endphp

                                            <p class="car-distance-away"
                                                data-dealer-postal="{{ $dealerPostalCode }}"
                                                data-dealer-city="{{ $dealerCity }}"
                                                data-dealer-province="{{ $dealerProvince }}"
                                                data-dealer-country="{{ $dealerCountry }}">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span class="distance-value">Loading...</span>
                                            </p>

                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="price-wrap">
                                                    <span class="text-span">From</span>
                                                    <span class="price-span">${{ number_format((float)($inventory->price_retail_date ?? 0), 2) }}</span>
                                                    <span class="text-span">/ USD</span>
                                                </div>
                                                
                                                @if($isMotoklozInventory)
                                                    <!-- ✅ Motokloz Inventory Button -->
                                                    <button class="book-btn motokloz-book-btn" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#motoklozTestDriveModal"
                                                            data-vehicle-id="{{ $vehicleId }}"
                                                            data-dealer-email="{{ $dealerEmail }}">
                                                        Book Now
                                                    </button>
                                                @else
                                                    <!-- ✅ Regular Dealer Inventory Button -->
                                                    <button class="book-btn dealer-book-btn" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#testDriveModal"
                                                            data-dealer-id="{{ $dealerId }}"
                                                            data-product-id="{{ $vehicleId }}">
                                                        Book Now
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination-section mt-56">
                        @include('partials.pagination')
                    </div>
                </div>




            </div>

        </div>
    </div>
    <!-- Regular Test Drive Modal (API Call) -->
    <div class="modal fade" id="testDriveModal" tabindex="-1" aria-labelledby="testDriveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testDriveModalLabel">Book Now</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <form data-ajax="true" id="regularTestDriveForm">
                        @if(request()->has('u'))
                        <input type="hidden" name="u" value="{{ request()->get('u') }}" id="regularUParam">
                        @endif
                        
                        <div class="mb-3">
                            <label for="regular_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="regular_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="regular_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="regular_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="regular_phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="regular_phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="regular_date" class="form-label">Preferred Date</label>
                            <input type="date" class="form-control" id="regular_date" name="book_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="regular_message" class="form-label">Message</label>
                            <textarea class="form-control" id="regular_message" name="message" rows="3" placeholder="Any additional notes..."></textarea>
                        </div>
                        <button type="submit" class="mto-btn-orange w-100 mb-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Motokloz Test Drive Modal (Email to Dealer) -->
    <div class="modal fade" id="motoklozTestDriveModal" tabindex="-1" aria-labelledby="motoklozTestDriveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="motoklozTestDriveModalLabel">Book Now</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <form data-ajax="true" id="motoklozTestDriveForm">
                        @csrf
                        
                        {{-- Hidden fields for Motokloz --}}
                        <input type="hidden" name="source" value="motokloz">
                        <input type="hidden" name="vehicle_id" id="motokloz_vehicle_id" value="">
                        <input type="hidden" name="dealer_email" id="motokloz_dealer_email" value="">
                        
                        @if(request()->has('u'))
                        <input type="hidden" name="u" value="{{ request()->get('u') }}" id="motoklozUParam">
                        @endif
                        
                        <div class="mb-3">
                            <label for="motokloz_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="motokloz_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="motokloz_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="motokloz_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="motokloz_phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="motokloz_phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="motokloz_date" class="form-label">Preferred Date</label>
                            <input type="date" class="form-control" id="motokloz_date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="motokloz_message" class="form-label">Message</label>
                            <textarea class="form-control" id="motokloz_message" name="message" rows="3" placeholder="Any additional notes..."></textarea>
                        </div>
                        <button type="submit" class="mto-btn-orange w-100 mb-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .price-wrap {
            display: flex;
            align-items: baseline;
            gap: 6px;
        }

        .price-span {
            font-size: 24px;
            line-height: 32px;
            color: var(--select-color) !important;
            font-weight: 700;
        }

        .text-span {
            color: #737372 !important;
            font-size: 16px;
            line-height: 26px;
            font-weight: 500;
        }

        .rating-all-p {
            text-align: center;
            padding: 5px;
            color: var(--select-color);
            font-size: 14px;
            line-height: 22px;
            font-weight: 500;
        }


        .rating-all {
            border: 1px solid #DDE1DE;
            border-radius: 33px;
            margin-bottom: 16px;
            font-size: 14px;
            padding: 8px;
            width: 175px;
            height: 38px;
            background: var(--bg-color);
            box-shadow: 0 2px 7px #00000012;
        }

        .cards-wish-all {
            height: auto;
            flex: 1 !important;
            background: var(--banner-bg-color);
            border-radius: 12px;
            z-index: 2;
        }

        .dark-invert {
            filter: none;
        }

        body.dark-mode .dark-invert {
            filter: brightness(0) invert(1);
        }


        .badge-main {
            position: absolute;
            top: 0;
            right: 30px;
            -webkit-mask-image: url(/assets/images/badge-bg.png);
            align-items: center !important;
            justify-content: center !important;
            mask-size: 100%;
            mask-repeat: no-repeat;
            background-color: #000;
            height: 47px;
            width: 44px;
        }

        .badge-main {
            position: absolute;
            top: 0;
            right: 30px;
        }

        .filter-btn {
            background: #f3f4f6;
            border: none;
            padding: 9px 20px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #333;
        }

        .features-content {

            display: flex;
            gap: 27px;
            align-items: center;
        }

        .icon {
            width: 16px;
            height: 16px;
            object-fit: contain;
            margin-right: 6px;
        }

        .feature {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #999999;
        }

        .discount-badge {
            background: #000;
            color: #fff;
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .location {
            color: #999999;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 26px !important;
        }

        .searchbar {
            position: relative !important;
            background: #ffff;
            width: 320px;
            height: 36px;
            border-radius: 36px;
            border: 1px solid #ECECEC;
        }

        .wishlist-sec {
            border: 1px solid var(--border-color);
            background: var(--bg-color);
            padding: 0;
            border-radius: 6px;
        }

        .search-head {
            font-weight: 700;
            font-size: 20px;
            line-height: 26px;
            color: var(--select-color);
        }

        .wishlist-header {
            background: #10101008;
            border-bottom: 1px solid var(--border-color);
        }

        .wishlist-header .form-control {
            height: 38px;
            border-color: #e5e5e5;
            box-shadow: none;
        }

        .Breadcrumb-home {
            font-size: 16px;
            line-height: 26px;
            color: #4D4D4D;
        }

        /* Base */
        .account-setting {
            font-family: "Vend Sans", sans-serif;
            color: #222;
        }

        /* Breadcrumb */
        .account-setting .seat-head {
            font-weight: 700;
            color: var(--select-color);
            font-size: 16px;
            line-height: 26px;
        }

        .Breadcrumb {
            border: 1px solid #DDE1DE;
            width: 228px;
            height: 44px;
            border-radius: 12px;
            border-color: #DDE1DE;
            padding: 10px;
        }

        /* Sidebar */
        .account-sidebar {
            border: 1px solid #eaeaea;
            border-radius: 14px;
            background: var(--bg-color);
            color: var(--select-color);
        }

        .user-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-check-input:checked {
            background-color: #3ad65c !important;
            border-color: #0d6efd;
        }

        .side-top {
            padding: 16px 13px;
            background: #21252908;
            margin: 0px;
            border-radius: 11px 11px 0 0;
            border-bottom: 1px solid #E4E6E8;
        }

        .user-box .user-info-head {
            font-size: 20px;
            font-weight: 700;
            line-height: 24px;
            color: var(--select-color);
        }

        .user-box .user-info-para {
            font-size: 14px;
            font-weight: 400;
            line-height: 24px;
            color: var(--select-color);
        }

        .user-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #DADEE2;
        }

        .edit-btn {
            margin-left: auto;
            font-size: 13px;
            color: #999;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .edit-btn:hover {
            color: #555;
        }

        /* Sidebar menu */
        .account-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .main-head {
            font-weight: 700;
            font-size: 45px;
            list-style: none;
            line-height: 58px;
            color: var(--select-color);
            padding: 10px 0;
        }

        .account-menu li {
            display: flex;
            align-items: center;
            justify-content: start;
            padding: 10px 12px;
            border-radius: 8px;
            gap: 12px;
            font-size: 15px;
            color: var(--select-color);
            cursor: pointer;
            font-weight: 600;
            line-height: 24px;
        }

        img.menu-icon {
            width: 13px;
            height: 14px;
            object-fit: scale-down;
        }

        .account-menu li:hover {
            background: #f6f6f6;
        }

        .account-menu li.active {
            color: #ff7a00;
            font-weight: 500;
        }

        .account-menu .badge {
            background: #F58D02;
            font-size: 15px;
            font-weight: 500;
            width: 24px;
            height: 24px;
            border-radius: 50px;
        }

        img.edit-img {
            height: 28px;
            width: 28px;
            object-fit: cover;
        }

        /* Content */
        .account-content {
            border: 1px solid #eaeaea;
            border-radius: 14px;
            padding: 22px 24px;
            background: var(--bg-color);
            color: var(--select-color);
        }

        .account-content h5 {
            font-size: 16px;
        }

        .wishlist-card {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            /* background: #fff; */
            /* margin: 25px 20px; */
            position: relative;
        }


        .wishlist-img {
            height: 296px !important;
            width: 93% !important;
            object-fit: contain;
            scale: 1.1;
            transform-origin: left center;
        }

        .card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center !important;
            height: 100%;
        }


        .discount-badge {
            background: #000;
            color: #fff;
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: bold;
        }

        .card-title {
            font-size: 24px;
            margin-bottom: 14px;
            line-height: 32px;
            font-weight: 700;
            color: var(--select-color);
        }

        .location {
            font-size: 16px;
            color: #666;
        }

        .features .feature {
            width: calc(33% - 9px);
            font-size: 16px;
            font-weight: 500;
            /* flex: 1; */
        }

        .features .feature .icon {
            width: 24px;
            height: 24px;
            object-fit: scale-down;
        }


        .price {
            font-size: 18px;
            color: #000;
        }

        .book-btn {
            background: #F58D02;
            border: none;
            color: #fff;
            font-size: 14px;
            line-height: 26px;
            font-weight: 700;
            padding: 12px 22px;
            border-radius: 62px;
        }



        /* Responsive */
        @media (max-width: 991px) {
            .account-sidebar {
                margin-bottom: 20px;
            }

            .searchbar {
                width: 200px;
            }
        }

        @media (max-width: 767px) {
            .wishlist-img {
                border-radius: 14px 14px 0 0;
            }
        }
    </style>


    <style>
        @media (max-width: 991px) {
            .listing-page {
                padding: 0 12px;
            }
        }

        @media (max-width: 991px) {
            .account-sidebar {
                margin-bottom: 20px;
            }

            .main-head {
                font-size: 28px;
                line-height: 36px;
            }
        }

        @media (max-width: 767px) {

            .wishlist-card {
                margin: 15px 10px;
            }

            .wishlist-img {
                height: 220px !important;
                scale: 1;
                border-radius: 12px 12px 0 0;
            }

            .card-body {
                padding: 16px;
            }

            .card-title {
                font-size: 18px;
                line-height: 26px;
            }

            .features .feature {
                width: 100%;
                font-size: 14px;
            }

            .price-span {
                font-size: 20px;
            }

            .book-btn {
                padding: 10px 16px;
                font-size: 13px;
            }

            .rating-all {
                width: auto;
                height: auto;
                padding: 6px 10px;
            }
        }

        @media (min-width: 768px) and (max-width: 1199px) {

            .wishlist-img {
                height: 300px !important;
                scale: 1;
            }

            .card-title {
                font-size: 20px;
            }

            .features .feature {
                width: calc(50% - 10px);
            }
        }

        @media (max-width: 575px) {

            .wishlist-header {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 12px;
            }

            .header-actions {
                flex-direction: column;
                align-items: stretch !important;
                width: 100%;
            }

            .searchbar {
                width: 100%;
            }

            .filter-btn {
                width: 100%;
                justify-content: center;
            }


        }

        @media (max-width: 575px) {
            .pagination {
                justify-content: center !important;
                padding: 10px;
            }

            .page-square {
                width: 38px;
                height: 38px;
            }
        }
    </style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function(){

    // CSRF Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function handleErrors(xhr){
        if (xhr.status === 422 && xhr.responseJSON?.errors) {
            let msgs = [];
            $.each(xhr.responseJSON.errors, function(field, messages) {
                msgs.push(messages.join(', '));
            });
            showSnackbar(msgs.join(' | '), 'error');
        } else if (xhr.status === 419) {
            showSnackbar('Session expired. Refreshing...', 'warning');
            setTimeout(() => location.reload(), 1500);
        } else if (xhr.status === 500) {
            showSnackbar('Server error. Please try again later.', 'error');
        } else {
            showSnackbar(xhr.responseJSON?.message || 'Something went wrong.', 'error');
        }
    }

    // ✅ Populate Motokloz Modal with vehicle and dealer info
    $('#motoklozTestDriveModal').on('show.bs.modal', function(e) {
        var $button = $(e.relatedTarget);
        var vehicleId = $button.data('vehicle-id');
        var dealerEmail = $button.data('dealer-email');
        
        console.log('Motokloz Modal - Vehicle ID:', vehicleId, 'Dealer Email:', dealerEmail);
        
        $(this).find('#motokloz_vehicle_id').val(vehicleId);
        $(this).find('#motokloz_dealer_email').val(dealerEmail);
    });

    // ================= REGULAR TEST DRIVE (API Call) =================
    $('#regularTestDriveForm').on('submit', function(e){
        e.preventDefault();
        
        console.log('Regular Form submitted');

        @php
            $dealerId = $firstFavorite->inventory->user_id 
                ?? $firstFavorite->inventory->dealer_id 
                ?? $firstFavorite->user_id 
                ?? $firstFavorite->dealer_id 
                ?? null;
            $productId = $firstFavorite->inventory->id 
                ?? $firstFavorite->inventory_id 
                ?? null;
        @endphp
        
        var dealerId = {{ $dealerId ?? 'null' }};
        var productId = {{ $productId ?? 'null' }};
        
        console.log('Dealer ID:', dealerId, 'Product ID:', productId);

        if (!dealerId || dealerId === 'null' || !productId || productId === 'null') {
            showSnackbar('Dealer or vehicle info missing. Refresh page.', 'error');
            return;
        }

        var formData = {
            name: $('#regular_name').val().trim(),
            email: $('#regular_email').val().trim(),
            phone: $('#regular_phone').val().trim(),
            book_date: $('#regular_date').val(),
            message: $('#regular_message').val(),
            reason: 'Book Now',
            type: 'WEBLEAD',
            source: 'Motokloz',
            lead_status: 'NEW',
            dealer_id: dealerId,
            product_id: productId,
            lead_source: 'Website',
            lead_type: 'Test Drive'
        };

        var uParam = $('#regularUParam').val();
        if (uParam) {
            formData.u = uParam;
        }

        if (!formData.name || !formData.email || !formData.phone || !formData.book_date) {
            showSnackbar('Fill all required fields', 'warning');
            return;
        }

        var emailRegex = /^[^\s@]+@([^\s@]+\.)+[^\s@]+$/;
        if (!emailRegex.test(formData.email)) {
            showSnackbar('Invalid email address', 'warning');
            return;
        }

        var $btn = $(this).find('button[type="submit"]');
        var originalText = $btn.html();
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin ms-2"></i> Sending...');

        var apiUrl = "{{ env('diskloz_base_url') }}/api/leads";
        if (uParam) {
            apiUrl += '?client_id=' + encodeURIComponent(uParam);
        }

        $.ajax({
            url: apiUrl,
            method: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            dataType: 'json',
            crossDomain: true,
            success: function(res){
                console.log('Success:', res);
                showSnackbar('Booking submitted!', 'success');
                $('#testDriveModal').modal('hide');
                $('#regularTestDriveForm')[0].reset();
            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr, status, error);
                handleErrors(xhr);
            },
            complete: function(){
                $btn.prop('disabled', false).html('Submit');
            }
        });
    });

    // ================= MOTOKLOZ TEST DRIVE (Email to Dealer) =================
    $('#motoklozTestDriveForm').on('submit', function(e){
        e.preventDefault();
        
        console.log('Motokloz Form submitted - Sending email to dealer');

        var formData = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name: $('#motokloz_name').val().trim(),
            email: $('#motokloz_email').val().trim(),
            phone: $('#motokloz_phone').val().trim(),
            date: $('#motokloz_date').val(),
            message: $('#motokloz_message').val(),
            source: 'motokloz',
            vehicle_id: $('#motokloz_vehicle_id').val(),
            dealer_email: $('#motokloz_dealer_email').val()
        };

        var uParam = $('#motoklozUParam').val();
        if (uParam) {
            formData.u = uParam;
        }

        console.log('Motokloz Form Data:', formData);

        // Validation
        if (!formData.name || !formData.email || !formData.phone || !formData.date) {
            showSnackbar('All fields are required', 'warning');
            return;
        }

        var emailRegex = /^[^\s@]+@([^\s@]+\.)+[^\s@]+$/;
        if (!emailRegex.test(formData.email)) {
            showSnackbar('Invalid email address', 'warning');
            return;
        }

        if (!formData.dealer_email) {
            showSnackbar('Dealer email is missing', 'error');
            return;
        }

        var $btn = $(this).find('button[type="submit"]');
        var originalText = $btn.html();
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin ms-2"></i> Sending...');

        // Send email via local route
        $.ajax({
            url: "/motokloz-test-drive-mail",
            method: "POST",
            data: formData,
            success: function(response) {
                console.log('Email sent successfully:', response);
                showSnackbar('Test drive request sent to dealer!', 'success');
                $('#motoklozTestDriveModal').modal('hide');
                $('#motoklozTestDriveForm')[0].reset();
            },
            error: function(xhr) {
                console.error('Email error:', xhr);
                handleErrors(xhr);
            },
            complete: function() {
                $btn.prop('disabled', false).html('Submit');
            }
        });
    });

});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // ✅ Snackbar function
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

    // ✅ Attach click to all dropdown sort links
    const sortDropdownLinks = document.querySelectorAll('.dropdown-item');
    sortDropdownLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const text = this.textContent.trim();
            // store snackbar message
            localStorage.setItem('snackbar', `Sorted by: ${text}`);
        });
    });
    
    // ✅ Show snackbar if stored in localStorage
    const message = localStorage.getItem('snackbar');
    if (message) {
        showSnackbar(message, 'info', 2000);
        localStorage.removeItem('snackbar');
    }

});
</script>

@endsection