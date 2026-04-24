@extends('layouts.app')

@section('content')
<div class="listing-page mt-5">
    <div class="container">
        <div class="page-content">
            <!-- Page Top -->
            <div class="page-top">
                @include('partials.user-account-breadcrumbs')

                <div class="row">
                    <div class="col-lg-2 page-title">
                        <h1>Listings</h1>
                    </div>
                </div>
            </div>
            <!-- Page Bottom -->
            <div class="page-bottom">
                <div class="row">
                    @include('partials.user-account-sidebar')
                    <div class="col-lg-9 listing mb-4">
                        <div class="listing-top">
                            <div class="warning-div">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                    fill="none">
                                    <path
                                        d="M7 0C5.72444 0 4.55 0.311111 3.47667 0.933333C2.40333 1.55556 1.55556 2.40333 0.933333 3.47667C0.311111 4.55 0 5.72444 0 7C0 8.27556 0.311111 9.45 0.933333 10.5233C1.55556 11.5967 2.40333 12.4444 3.47667 13.0667C4.55 13.6889 5.72444 14 7 14C8.27556 14 9.45 13.6889 10.5233 13.0667C11.5967 12.4444 12.4444 11.5967 13.0667 10.5233C13.6889 9.45 14 8.27556 14 7C14 5.72444 13.6889 4.55 13.0667 3.47667C12.4444 2.40333 11.5967 1.55556 10.5233 0.933333C9.45 0.311111 8.27556 0 7 0ZM7 12.8333C5.94222 12.8333 4.97 12.5689 4.08333 12.04C3.19667 11.5111 2.48889 10.8033 1.96 9.91667C1.43111 9.03 1.16667 8.05778 1.16667 7C1.16667 5.94222 1.43111 4.97 1.96 4.08333C2.48889 3.19667 3.19667 2.48889 4.08333 1.96C4.97 1.43111 5.94222 1.16667 7 1.16667C8.05778 1.16667 9.03 1.43111 9.91667 1.96C10.8033 2.48889 11.5111 3.19667 12.04 4.08333C12.5689 4.97 12.8333 5.94222 12.8333 7C12.8333 8.05778 12.5689 9.03 12.04 9.91667C11.5111 10.8033 10.8033 11.5111 9.91667 12.04C9.03 12.5689 8.05778 12.8333 7 12.8333ZM7 5.83333H6.44C6.25333 5.83333 6.10556 5.88778 5.99667 5.99667C5.88778 6.10556 5.83333 6.24556 5.83333 6.41667C5.83333 6.58778 5.88778 6.72778 5.99667 6.83667C6.10556 6.94556 6.25333 7 6.44 7H7V10.5C7 10.6556 7.05444 10.7878 7.16333 10.8967C7.27222 11.0056 7.41222 11.06 7.58333 11.06C7.75444 11.06 7.89444 11.0056 8.00333 10.8967C8.11222 10.7878 8.16667 10.6556 8.16667 10.5V7C8.16667 6.68889 8.05 6.41667 7.81667 6.18333C7.58333 5.95 7.31111 5.83333 7 5.83333ZM6.11333 3.78C6.11333 4.02889 6.19889 4.23889 6.37 4.41C6.54111 4.58111 6.75111 4.66667 7 4.66667C7.24889 4.66667 7.45889 4.58111 7.63 4.41C7.80111 4.23889 7.88667 4.02889 7.88667 3.78C7.88667 3.53111 7.80111 3.32111 7.63 3.15C7.45889 2.97889 7.24889 2.90111 7 2.91667C6.75111 2.93222 6.54111 3.01778 6.37 3.17333C6.19889 3.32889 6.11333 3.53111 6.11333 3.78Z"
                                        fill="#F58D02" />
                                </svg>
                                <span class="warning-text">Join the year-end sale to boost your sales now</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                    fill="none">
                                    <g clip-path="url(#clip0_286_3029)">
                                        <path
                                            d="M0.256188 0.256375C0.420275 0.0923373 0.642794 0.000186359 0.874813 0.000186359C1.10683 0.000186359 1.32935 0.0923373 1.49344 0.256375L6.99981 5.76275L12.5062 0.256375C12.5869 0.172803 12.6835 0.106144 12.7902 0.0602858C12.897 0.0144279 13.0118 -0.00971005 13.128 -0.0107196C13.2441 -0.0117292 13.3594 0.0104098 13.4669 0.0544055C13.5744 0.0984013 13.6721 0.163373 13.7543 0.245529C13.8364 0.327685 13.9014 0.42538 13.9454 0.532915C13.9894 0.640449 14.0115 0.755669 14.0105 0.871851C14.0095 0.988032 13.9854 1.10285 13.9395 1.2096C13.8937 1.31636 13.827 1.41291 13.7434 1.49362L8.23706 7L13.7434 12.5064C13.9028 12.6714 13.991 12.8924 13.989 13.1219C13.987 13.3513 13.895 13.5707 13.7328 13.733C13.5705 13.8952 13.3511 13.9872 13.1217 13.9892C12.8922 13.9912 12.6712 13.903 12.5062 13.7436L6.99981 8.23725L1.49344 13.7436C1.32841 13.903 1.10738 13.9912 0.877962 13.9892C0.64854 13.9872 0.429079 13.8952 0.266847 13.733C0.104615 13.5707 0.012592 13.3513 0.0105984 13.1219C0.00860474 12.8924 0.0967999 12.6714 0.256188 12.5064L5.76256 7L0.256188 1.49362C0.092151 1.32954 0 1.10702 0 0.875C0 0.642981 0.092151 0.420461 0.256188 0.256375Z"
                                            fill="black" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_286_3029">
                                            <rect width="14" height="14" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <div class="listing-bottom">
                            <div class="listing-main">
                                <div class="listing-head">
                                    <div class="listing-left">
                                        <h2>Listings</h2>
                                    </div>
                                    <div class="listing-center search-form mt-3">
                                        <form action="{{ request()->url() }}" method="GET" id="searchForm">
                                            <input type="text" name="search" id="carsearch" placeholder="Search"
                                                value="{{ $searchTerm ?? '' }}">
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path
                                                        d="M13.8675 13.0275L10.3675 9.52753C11.0209 8.74975 11.4331 7.86309 11.6042 6.86753C11.7753 5.87197 11.6975 4.89975 11.3709 3.95086C11.0442 3.00197 10.5075 2.18531 9.76086 1.50086C9.01419 0.816419 8.15086 0.365308 7.17086 0.147531C6.19086 -0.0702477 5.21864 -0.0469141 4.25419 0.21753C3.28975 0.481975 2.44197 0.979753 1.71086 1.71086C0.979749 2.44197 0.481971 3.28975 0.217527 4.2542C-0.0469176 5.21864 -0.0702509 6.19086 0.147527 7.17086C0.365305 8.15086 0.816416 9.0142 1.50086 9.76086C2.1853 10.5075 3.00197 11.0442 3.95086 11.3709C4.89975 11.6975 5.87197 11.7753 6.86753 11.6042C7.86308 11.4331 8.74975 11.0209 9.52753 10.3675L13.0275 13.8675C13.152 13.9609 13.292 14.0075 13.4475 14.0075C13.6031 14.0075 13.7353 13.9531 13.8442 13.8442C13.9531 13.7353 14.0075 13.6031 14.0075 13.4475C14.0075 13.292 13.9609 13.152 13.8675 13.0275ZM5.84086 10.5075C5.00086 10.5075 4.22308 10.2975 3.50753 9.87753C2.79197 9.45753 2.22419 8.88975 1.80419 8.1742C1.38419 7.45864 1.17419 6.68086 1.17419 5.84086C1.17419 5.00086 1.38419 4.22309 1.80419 3.50753C2.22419 2.79198 2.79197 2.2242 3.50753 1.8042C4.22308 1.3842 5.00086 1.1742 5.84086 1.1742C6.68086 1.1742 7.45864 1.3842 8.17419 1.8042C8.88975 2.2242 9.45753 2.79198 9.87753 3.50753C10.2975 4.22309 10.5075 5.00086 10.5075 5.84086C10.5075 6.68086 10.2975 7.45864 9.87753 8.1742C9.45753 8.88975 8.88975 9.45753 8.17419 9.87753C7.45864 10.2975 6.68086 10.5075 5.84086 10.5075Z"
                                                        fill="#393F4D" />
                                                </svg>
                                            </button>

                                            {{-- Preserve sort parameter --}}
                                            @if(request()->has('sort'))
                                            <input type="hidden" name="sort" value="{{ request()->get('sort') }}">
                                            @endif
                                        </form>
                                    </div>
                                    <div class="listing-right">
                                        <!-- Sort Dropdown -->
                                        <div class="dropdown">
                                            <button class="filter-btn dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
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
                                <div class="listing-body">
                                    <div class="row g-4" id="vehicleContainer">

                                        @forelse($listings as $listing)
                                        <div class="col-lg-4 col-sm-6 vehicle-card" data-id="{{ $listing->id }}"
                                            data-name="{{ strtolower($listing->mfg_auto ?? '') }} {{ strtolower($listing->model ?? '') }}"
                                            data-price="{{ $listing->disclosed_price ?? 0 }}"
                                            data-year="{{ $listing->year ?? 0 }}">
                                            <div class="modern-car-card shadow-sm">
                                                <div class="car-card-top" style="position: relative;">
                                                    @php
                                                    // Create a URL-friendly slug from the vehicle title
                                                    $vehicleName = trim(
                                                    ($listing->year ?? '') . ' ' .
                                                    ($listing->mfg_auto ?? '') . ' ' .
                                                    ($listing->model ?? '')
                                                    );
                                                    $slug = $vehicleName ? Str::slug($vehicleName, '-') : 'vehicle';
                                                    $detailUrl = route('inventory_product_details', ['name' => $slug,
                                                    'id' => $listing->id]);
                                                    @endphp
                                                    <a href="{{ $detailUrl }}">
                                                        <img style="width:100%" src="{{ $listing->primary_image
                                                                ? (Str::startsWith($listing->primary_image, 'http')
                                                                    ? $listing->primary_image
                                                                    : $disklozBaseUrl . '/admin_assets/images/inventory_images/' . $listing->primary_image)
                                                                : asset('assets/images/defaultimage.jpg') }}"
                                                            alt="Vehicle Image" class="img-box img-fluid"
                                                            onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultimage.jpg') }}';">
                                                    </a>

                                                    {{-- Wishlist button removed --}}

                                                    <!-- ✅ Eye Icon Button with Text - Top Left -->
                                                    <button class="eye-toggle-btn" data-id="{{ $listing->id }}"
                                                        data-active="{{ $listing->share_indicators ? 'true' : 'false' }}"
                                                        onclick="toggleMotoklozStatus({{ $listing->id }})"
                                                        style="background: {{ $listing->share_indicators }}">
                                                        <i
                                                            class="fa-solid {{ $listing->share_indicators ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                                        <span class="btn-text">{{ $listing->share_indicators ? 'Active'
                                                            : 'Inactive' }}</span>
                                                    </button>

                                                    <div class="badge-mileage d-flex align-items-center">
                                                        <img src="/assets/images/mile1.png" alt="Mileage" class="me-2"
                                                            style="width:20px; height:12px;">
                                                        {{ $listing->mileage 
                                                            ? number_format((float) trim(str_ireplace('km', '', $listing->mileage))) . ' km'
                                                            : '0 km'
                                                        }}
                                                    </div>
                                                </div>
                                                <div class="car-card-bottom">
                                                    <h5 class="car-main-title">
                                                        {{ $listing->year }} {{ $listing->mfg_auto }} {{ $listing->model
                                                        }} {{ $listing->trim }}
                                                    </h5>

                                                    @php
                                                    $dealerPostalCode = $listing->dealer_postal_code ?? '';
                                                    $dealerCity = $listing->dealer_city ?? '';
                                                    $dealerProvince = $listing->dealer_province ?? '';
                                                    $dealerCountry = $listing->dealer_country ?? '';
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
                                                        <h4 class="price-value">
                                                            ${{ number_format((float) ($listing->disclosed_price ?? 0))
                                                            }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @empty
                                        <div class="col-12">
                                            <p class="text-center">No listings found</p>
                                        </div>
                                        @endforelse
                                    </div>

                                    <!-- PAGINATION -->
                                    <div class="pagination-section mt-56">
                                        @include('partials.pagination')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        var DISKLOZ_BASE_LISTINGS = "{{ env('diskloz_base_url') }}";
        $(document).ready(function () {
            @auth
            var authId = {{ auth() -> id()
        }};
        fetch(DISKLOZ_BASE_LISTINGS + '/api/favorites?client_id=' + authId)
            .then(function (res) { return res.json(); })
            .then(function (data) {
                var likedIds = new Set((data || []).map(function (item) { return item.inventory_id; }));
                $('button[id^="wishlist-btn-"]').each(function () {
                    var id = parseInt(this.id.replace('wishlist-btn-', ''));
                    if (likedIds.has(id)) {
                        $(this).addClass('active');
                        $('#wishlist-icon-' + id).removeClass('far').addClass('fas').css('color', '#f0a500');
                    }
                });
            }).catch(function () { });
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
                success: function (res) {
                    if (res.success) {
                        if (isLiked) { $btn.removeClass('active'); $icon.removeClass('fas').addClass('far').css('color', '#aaa'); }
                        else { $btn.addClass('active'); $icon.removeClass('far').addClass('fas').css('color', '#f0a500'); }
                    }
                },
                complete: function () { $('#wishlist-spinner-' + vehicleId).addClass('d-none'); $icon.removeClass('d-none'); $btn.prop('disabled', false); }
            });
        }
    </script>

    @endsection

    <style>
        .car-card-top {
            position: relative;
            overflow: hidden;
            border-radius: 12px 12px 0 0;
        }

        /* Eye Toggle Button - Top Left Position */
        .eye-toggle-btn {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 10;

            background: {
                    {
                    $listing->share_indicators ? '#28a745': '#dc3545'
                }
            }

            ;
            border: none;
            border-radius: 20px;
            padding: 6px 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
            font-size: 12px;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .eye-toggle-btn i {
            font-size: 14px;
        }

        .eye-toggle-btn .btn-text {
            font-size: 11px;
        }

        .eye-toggle-btn:hover {
            transform: scale(1.05);
            background: #f58d02 !important;
        }

        .eye-toggle-btn[data-active="true"] {
            background: var(--banner-bg-color);
            color: var(--select-color) border: 1px solid var(--border-color);
        }

        .eye-toggle-btn[data-active="true"]:hover {
            background: #f58d02;
            color: white;
            border-color: #f58d02;
        }

        /* Inactive State (Eye slash - Share indicators inactive) */
        .eye-toggle-btn[data-active="false"] {
            background: #f58d02;
            color: white;
        }

        .eye-toggle-btn[data-active="false"]:hover {
            background: #f58d02;
            color: white;
            transform: scale(1.1);
        }

        .eye-toggle-btn i {
            font-size: 18px;
        }

        .eye-toggle-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
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
    </style>
    <script>
        function toggleMotoklozStatus(inventoryId) {
            var $btn = $('.eye-toggle-btn[data-id="' + inventoryId + '"]');

            // Current state from button's data attribute
            var isActive = $btn.attr('data-active') === 'true';

            // Show loading
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> <span class="btn-text">Loading...</span>');

            // Determine action
            var action = isActive ? 'deactivate' : 'activate';
            var apiUrl = '{{ env('diskloz_base_url') }}/api/inventory-' + action + '-share-indicators/' + inventoryId;

            $.ajax({
                url: apiUrl,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status) {
                        showSnackbar(response.message, 'success');

                        // Update button based on action
                        if (action === 'deactivate') {
                            // Change to inactive
                            $btn.attr('data-active', 'false');
                            $btn.html('<i class="fa-solid fa-eye-slash"></i> <span class="btn-text">Inactive</span>');
                        } else {
                            // Change to active
                            $btn.attr('data-active', 'true');
                            $btn.html('<i class="fa-solid fa-eye"></i> <span class="btn-text">Active</span>');
                        }
                        $btn.prop('disabled', false);
                    } else {
                        showSnackbar(response.message, 'error');
                        // Revert to original state
                        if (isActive) {
                            $btn.html('<i class="fa-solid fa-eye"></i> <span class="btn-text">Active</span>');
                        } else {
                            $btn.html('<i class="fa-solid fa-eye-slash"></i> <span class="btn-text">Inactive</span>');
                        }
                        $btn.prop('disabled', false);
                    }
                },
                error: function () {
                    showSnackbar('Error!', 'error');
                    if (isActive) {
                        $btn.html('<i class="fa-solid fa-eye"></i> <span class="btn-text">Active</span>');
                    } else {
                        $btn.html('<i class="fa-solid fa-eye-slash"></i> <span class="btn-text">Inactive</span>');
                    }
                    $btn.prop('disabled', false);
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

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
                link.addEventListener('click', function (e) {
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const closeIcon = document.querySelector('.warning-div svg:last-child');
            if (closeIcon) {
                closeIcon.addEventListener('click', function () {
                    const listingTop = this.closest('.listing-top');
                    if (listingTop) {
                        listingTop.style.transition = 'opacity 0.3s ease';
                        listingTop.style.opacity = '0';
                        setTimeout(() => listingTop.remove(), 300);
                    }
                });
            }
        });
    </script>