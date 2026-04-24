@extends('layouts.app')

@section('content')

    <!-- DEALER BANNER -->
    <section class="dealer-network-section p-3">

        <div class="dealer-banner">
            <div class="banner-overlay"></div>
            <div class="container">
                <div class="banner-content text-white">
                    <h2 class="fw-bold mb-0" data-aos="fade-down" data-aos-duration="800">Dealer Network</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- DEALER SEARCH & CARDS -->
    <section class="dealer-search py-4">
        <div class="container">
            <!-- SEARCH BAR -->
            <div class="dealer-search-wrap">
                <form method="GET" action="{{ route('fetch_dealers') }}">
                    <div class="dealer-search-inner">
                        <div class="deal-sec">
                            <div class="search-field">
                                <input type="text" 
                                    name="dealer_name" 
                                    placeholder="Enter Dealer Name" 
                                    aria-label="Dealer Name"
                                    value="{{ request('dealer_name') }}">
                            </div>
                            <div class="divider"></div>
                            <div class="search-field">
                                <input type="text" 
                                    name="postal_code" 
                                    placeholder="Enter Postal Code" 
                                    aria-label="Postal Code"
                                    value="{{ request('postal_code') }}">
                            </div>

                            <button class="btn-search" type="submit">
                                <img src="/assets/images/Vector (4).png" alt="Search icon">
                                Find a Dealer
                            </button>
                        </div>

                        <button class="btn-dealer btn-dealer-22" type="button" data-bs-toggle="modal" data-bs-target="#testDriveModal">
                            Become a Dealer
                            <img src="/assets/images/Vector (3).png" alt="Dealer icon">
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Show search results info -->
            @if(request('dealer_name') || request('postal_code'))
                <div class="search-results-info mb-3">
                    <p class="text-muted">
                        Showing results for: 
                        @if(request('dealer_name'))
                            <strong>Dealer: "{{ request('dealer_name') }}"</strong>
                        @endif
                        @if(request('postal_code'))
                            @if(request('dealer_name')) and @endif
                            <strong>Postal Code: "{{ request('postal_code') }}"</strong>
                        @endif
                        <a href="{{ route('fetch_dealers') }}" class="btn btn-link btn-sm">Clear Filters</a>
                    </p>
                </div>
            @endif
            
            <!-- Show error if any -->
            @if(isset($error))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <!-- DEALER CARDS -->
            @if(count($dealers) > 0)
                <div class="row g-3">
                    @foreach($dealers as $dealer)
                       @php
                            // ✅ All array access
                            $legalName = $dealer['dba'] ?? 'Dealer';
                            $dealerId = $dealer['id'] ?? 0;
                            
                            // ✅ Small letters ke liye (strtolower, strtoupper nahi)
                            $nameForUrl = strtolower(preg_replace('/[^a-z0-9]+/', '-', strtolower($legalName)));
                            $nameForUrl = trim($nameForUrl, '-');
                            
                            $dealerLogo = isset($dealer['logo']) && $dealer['logo']
                                ? (Str::startsWith($dealer['logo'], 'http')
                                    ? $dealer['logo']
                                    : env('diskloz_base_url') . '/admin_assets/images/dealer_images/' . $dealer['logo'])
                                : asset('assets/images/defaultdealerlogo.png');
                        @endphp
                        
                        @if($dealerId)
                            <div class="col-12 col-sm-6 col-md-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}" data-aos-duration="600">
                                <a style="text-decoration:none;" href="{{ route('dealer_inventory_details', ['name' => $nameForUrl, 'id' => $dealerId]) }}">
                                    <div class="dealer-card">
                                        <div class="d-flex align-items-start gap-3">
                                            <img src="{{ $dealerLogo }}"
                                                class="me-4 dealerprofilelogo"
                                                alt="Logo"
                                                width="80"
                                                onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultdealerlogo.png') }}';">

                                            <div>
                                                <h6 class="dealer-card-head">{{ ucwords(strtolower($dealer['dba'] ?? 'Name not available')) }}</h6>
                                                <p class="dealer-address mb-2">
                                                    {{ collect([
                                                        $dealer['physical_address'] ?? null,
                                                        $dealer['city'] ?? null,
                                                        $dealer['province'] ?? null,
                                                        $dealer['postal_code'] ?? null
                                                    ])->filter()->implode(', ') ?: 'Address not available' }}
                                                </p>
                                                <span class="vehicle-badge">{{ $dealer['inventory_count'] ?? 0 }} Vehicles</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="my-4">
                    @include('partials.pagination')
                </div>
            @else
                <div class="alert alert-info text-center">
                    <h5>No dealers found</h5>
                    <p>Try adjusting your search criteria or clear the filters to see all dealers.</p>
                </div>
            @endif
        </div> <!-- end container -->
    </section>

                            
    <!-- Become a Dealer Modal -->
    <div class="modal fade" id="testDriveModal" tabindex="-1" aria-labelledby="testDriveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testDriveModalLabel">Become a Dealer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form data-ajax="true" id="dealerApplicationForm" action="{{ route('dealer.application.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="dealership_name" class="form-label">Dealership Name</label>
                            <input type="text" class="form-control" id="dealership_name" name="dealership_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_name" class="form-label">Contact Name</label>
                            <input type="text" class="form-control" id="contact_name" name="contact_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Contact Email</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_phone" class="form-label">Contact Phone</label>
                            <input type="tel" class="form-control" id="contact_phone" name="contact_phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Any additional notes..."></textarea>
                        </div>
                        <button type="submit" class="mto-btn-orange w-100 mb-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- MISSION SECTION -->
    <!-- <section class="mission-section py-5">
        <div class="container">
            <div class="row align-items-center g-4">
                LEFT CONTENT
                <div class="col-lg-6">
                    <button class="btn-dealer">Our Mission</button>
                    <h2 class="mission-title mt-3">
                        Sell your car at a fair price.<br>
                        Get started with us today.
                    </h2>
                    <p class="mission-text">
                        Our mission is to make car rental easy, accessible, and affordable
                        for everyone. We believe that renting a car should be a hassle-free
                        experience, and we’re dedicated to ensuring that every customer finds
                        the perfect vehicle for their journey.
                    </p>
                    <ul class="mission-list">
                        <li>Explore a wide range of flexible rental options to suit your needs</li>
                        <li>Comprehensive insurance coverage for complete peace of mind</li>
                        <li>24/7 customer support for assistance anytime, anywhere</li>
                    </ul>
                    <button class="btn btn-dealer mt-2">
                        Get Started Now
                        <img src="/assets/images/Vector (3).png" alt="">
                    </button>
                </div>

                RIGHT IMAGES (responsive grid)
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6">
                            <img src="/assets/images/Carento (1).png" class="mission-img" alt="">
                        </div>
                        <div class="col-6">
                            <img src="/assets/images/Carento (2).png" class="mission-img" alt="">
                        </div>
                        <div class="col-5">
                            <img src="/assets/images/Carento (3).png" class="mission-img" alt="">
                        </div>
                        <div class="col-7">
                            <img src="/assets/images/Carento (4).png" class="mission-img" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
     
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){

            $('#dealerApplicationForm').on('submit', function(e){
                e.preventDefault();

                // ===== UI STATE (same as test drive) =====
                var $btn = $(this).find('button[type="submit"]');
                var originalText = $btn.html();

                $btn.prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin ms-2"></i>');

                $('#loadingSpinner').show();

                var form = this;
                var formData = new FormData(form);

                $.ajax({
                    url: form.action,
                    method: 'POST',
                    data: formData,
                    processData: false,   // IMPORTANT for FormData
                    contentType: false,   // IMPORTANT for FormData

                    success: function(res){
                        showSnackbar(res.message || 'Submitted successfully!', 'success');

                        form.reset();

                        // modal close (agar hai)
                        const modalEl = document.getElementById('testDriveModal');
                        if (modalEl) {
                            const modal = bootstrap.Modal.getInstance(modalEl);
                            if (modal) modal.hide();
                        }
                    },

                    error: function(xhr){
                        if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            let msgs = [];
                            $.each(xhr.responseJSON.errors, function(field, messages) {
                                msgs.push(messages.join(', '));
                            });
                            showSnackbar(msgs.join(' | '), 'error');

                        } else if (xhr.status === 500) {
                            showSnackbar('Server error. Please try again later.', 'error');

                        } else {
                            showSnackbar(xhr.responseJSON?.message || 'Something went wrong.', 'error');
                        }
                    },

                    complete: function(){
                        $btn.prop('disabled', false).html(originalText);
                        $('#loadingSpinner').hide();
                    }
                });
            });

        });
    </script>

    <style>
        .dealer-search-wrap {
            padding: 0 0 20px;
            max-width: 100%;
            overflow-x: hidden;
            /* prevent any accidental horizontal scroll */
        }

        .dealer-search-inner {
            background: var(--banner-bg-color);
            border: 1px solid #DDE1DE;
            border-radius: 18px;
            padding: 12px 14px;
            display: flex;
            flex-wrap: wrap;
            /* ← very important */
            gap: 12px;
            align-items: center;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        }

        .deal-sec {
            display: flex;
            align-items: center;
            flex: 1 1 100%;
            /* take full width on small screens */
            min-width: 0;
            /* allows shrinking below content size */
            gap: 12px;
        }

        .search-field {
            flex: 1;
            min-width: 120px;
            /* reasonable minimum */
        }

        .search-field input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
            color: var(--select-color);
            background: transparent;
            padding: 8px;
        }

        .divider {
            width: 1px;
            height: 28px;
            background: #e5e7eb;
            flex-shrink: 0;
        }

        .btn-dealer-22 {
            padding: 18px 24px !important;
        }

        .btn-search,
        .btn-dealer {
            background: #F58D02;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 999px;
            font-weight: 500;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            cursor: pointer;
            transition: background 0.2s;
            flex-shrink: 0;
        }

        .btn-search:hover,
        .btn-dealer:hover {
            background: #e67f00;
        }

        .btn-search img,
        .btn-dealer img {
            width: 16px;
            height: 16px;
            object-fit: contain;
        }

        /* ────────────────────────────────────────
                                   Mobile-first responsive adjustments
                                ───────────────────────────────────────── */

        @media (max-width: 640px) {
            .dealer-search-inner {
                padding: 12px;
                gap: 10px;
            }

            .deal-sec {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .divider {
                display: none;
                /* hide on very small screens */
            }

            .search-field {
                min-width: unset;
            }

            .btn-search,
            .btn-dealer {
                width: 100%;
                /* full width buttons on mobile */
                justify-content: center;
                padding: 12px 16px;
            }
        }

        @media (min-width: 641px) {
            .dealer-search-inner {
                /* flex-wrap: nowrap; */
            }

            .deal-sec {
                flex: 1 1 auto;
                min-width: 0;
            }

            .btn-search,
            .btn-dealer {
                flex: 0 0 auto;
            }
        }

        .deal-sec {
            display: flex;
            align-items: center;
            flex: auto;
            border: 1px solid #DDE1DE;
            border-radius: 50px;
            padding: 10px;
        }

        .page-square {
            width: 44px;
            height: 44px;
            border-radius: 5px;
            display: flex;
            background: #F2F4F6;
            align-items: center;
            justify-content: center;
            color: #000000;
            line-height: 35px;
            font-size: 16px;
            transition: all 0.2s ease;
        }

        /* Active page */
        .page-item.active .page-link {
            background: #ff9800;
            color: #fff;
            border-color: unset !important;
        }

        /* Hover effect */
        .page-link:hover {
            background: #e9ecef;
            color: #000;
        }

        /* Dots */
        .dots {
            pointer-events: none;
            background: #f1f3f5;
        }

        /* Prev/Next icons */
        .page-link img {
            width: 20px;
            height: 20px;
            object-fit: contain;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .page-square {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }


        }

        @media (max-width: 480px) {
            .page-square {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }

            .page-link img {
                width: 16px;
                height: 16px;
            }
        }

        /* ===== GLOBAL / VARIABLES ===== */
        :root {
            --primary: #F58D02;
            --primary-hover: #e67f00;
            --text-dark: #000000;
            --text-muted: #737373;
            --border-light: #e5e7eb;
            --card-border: #DDE1DE;
        }

        /* ===== BANNER SECTION ===== */
        .dealer-banner {
            position: relative;
            min-height: 465px;
            border-radius: 20px;
            overflow: hidden;
            background: url('/assets/images/dealernetworkheader.png') center/cover no-repeat;
        }

        .banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg,
                    rgba(0, 0, 0, 0.82) 0%,
                    rgba(0, 0, 0, 0.35) 40%,
                    rgba(0, 0, 0, 0) 70%);
        }

        .banner-content {
            position: relative;
            height: 405px;
            display: flex;
            align-items: end;
            padding-bottom: 2rem;
            /* added spacing */
        }

        .banner-content h2 {
            font-size: 40px;
            font-weight: 700;
        }

        /* ===== SEARCH BAR ===== */
        /*===== search bar styles (100% original) =====*/

        /* ===== DEALER CARDS ===== */
        .dealer-card {
            border: 1px solid var(--card-border);
            background: var(--banner-bg-color);
            border-radius: 8px !important;
            padding: 20px !important;
            /* reduced from 23px 26px for smaller devices */
            height: 100%;
            transition: box-shadow 0.25s ease;
        }

        .dealer-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .dealer-avatar {
            width: 78px;
            height: 78px;
            border-radius: 50%;
            object-fit: cover;
        }

        .dealer-card-head {
            font-size: 24px;
            line-height: 32px;
            font-weight: 700;
            color: var(--select-color);
        }

        .dealer-address {
            font-size: 16px;
            color: var(--text-muted);
            line-height: 26px;
        }

        .vehicle-badge {
            padding: 4px 10px;
            background: #F2F4F6;
            border-radius: 18px;
            display: inline-block;
            color: var(--text-dark);
            border: 1px solid var(--card-border);
            font-weight: 700;
            font-size: 12px;
            line-height: 18px;
        }

        /* ===== MISSION SECTION ===== */
        .mission-section {
            padding: 70px 0;
        }

        .mission-title {
            font-weight: 700;
            font-size: 36px;
            line-height: 42px;
            color: var(--select-color);
        }

        .mission-text {
            color: var(--text-muted);
            margin: 16px 0;
            max-width: 510px;
            font-size: 18px;
            line-height: 28px;
            font-weight: 500;
        }

        .mission-list {
            list-style: none;
            padding: 0;
            margin-bottom: 10px;
        }

        .mission-list li {
            position: relative;
            padding-left: 28px;
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: 700;
            left: 0;
            /* removed left offset */
            color: var(--select-color);
            padding-bottom: 12px;
        }

        .mission-list li::before {
            content: "";
            position: absolute;
            width: 18px;
            height: 18px;
            background: url('/assets/images/tick.png') no-repeat center;
            background-size: contain;
            left: 0;
            top: 4px;
        }

        .mission-img {
            width: 100%;
            height: 269px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* make images stack nicely on mobile */
        @media (max-width: 768px) {
            .mission-img {
                height: auto;
                aspect-ratio: 4/3;
            }
        }

        /* ===== MEDIA QUERIES FOR BANNER & CARDS ===== */
        @media (max-width: 768px) {
            .dealer-banner {
                min-height: 300px;
            }

            .banner-content {
                height: 300px;
            }

            .banner-content h2 {
                font-size: 28px;
            }

            .dealer-card-head {
                font-size: 20px;
                line-height: 28px;
            }

            .dealer-address {
                font-size: 14px;
                line-height: 22px;
            }
        }

        @media (max-width: 576px) {
            .mission-title {
                font-size: 28px;
                line-height: 36px;
            }

            .mission-text {
                font-size: 16px;
                line-height: 24px;
            }
        }

        /* ensure images in mission don't overflow */
        .row.g-3 {
            --bs-gutter-y: 1rem;
        }

        body {

            font-family: Vend Sans !important;



        }

        /* ===== FIX: tablet landscape layout ===== */
        @media (min-width: 768px) and (max-width: 1000px) {

            /* ensure grid behaves like 2 columns */
            .dealer-card {
                padding: 18px !important;
                border-radius: 10px !important;
            }

            /* fix card content alignment */
            .dealer-card .d-flex {
                flex-direction: row;
                align-items: center;
                gap: 12px;
            }

            .dealer-avatar {
                width: 64px;
                height: 64px;
            }

            .dealer-card-head {
                font-size: 17px;
                line-height: 24px;
            }

            .dealer-address {
                font-size: 12px;
                line-height: 19px;
            }

            /* fix badge wrapping */
            .vehicle-badge {
                font-size: 10px;
                padding: 3px 8px;
            }
        }
    </style>









@endsection