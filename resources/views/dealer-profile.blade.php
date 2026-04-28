    @extends('layouts.app')

@php
function formatPrice($price) {
    $cleaned = str_replace(['$', ','], '', $price);
    $number = is_numeric($cleaned) ? (float)$cleaned : 0;
    return number_format(round($number), 0, '.', ','); // 👈 yahan fix
}
@endphp
@php
    $source     = request()->query('source', 'diskloz');
    $isMotokloz = $source === 'motokloz';
@endphp
@section('title', 'Motokloz | ' . $dealer->dba)
@section('content')

    <!-- DEALER PROFILE BANNER — Google Maps Embed -->
    <section class="dealer-network-section p-3">
        <div class="dealer-profile-banner">
            <iframe
                width="100%"
                height="465"
                style="border:0; border-radius:20px; display:block;"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                src="https://maps.google.com/maps?q={{ $mapAddress }}&output=embed&z=15">
            </iframe>
        </div>
    </section>

    <div class="container my-5">
        <div class="row">

            <div class="col-lg-8">

                <div class="content-box shadow-sm" data-aos="fade-up" data-aos-duration="600">

                    <!-- Dropdown Header -->
                    <h4 class="fw-bold d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                        data-bs-target="#overviewContent" style="cursor:pointer;">
                        Overview
                        <i class="fas fa-chevron-down"></i>
                    </h4>

                    <!-- Collapsible Content -->
                    <div class="collapse show" id="overviewContent">
                        @php
                            $dealerLogo = $dealer->logo
                                ? (Str::startsWith($dealer->logo, 'http')
                                    ? $dealer->logo
                                    : env('diskloz_base_url') . '/admin_assets/images/dealer_images/' . $dealer->logo)
                                : asset('assets/images/defaultdealerlogo.png');
                        @endphp

                        <div class="d-flex align-items-start mb-4 border-bottom p-4">

                            <img src="{{ $dealerLogo }}"
                                class="me-4 dealerprofilelogo"
                                alt="Logo"
                                width="80"
                                onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultdealerlogo.png') }}';">

                            <div>
                                <h3 class="mb-3 fw-bold">
                                    {{$dealer->dba}}
                                    <!--{{ $dealer->first_name }} {{ $dealer->last_name }}-->
                                </h3>
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
                                    {{ $total_inventory }} Vehicles
                                </span>
                            </div>

                        </div>
                        

                        <div class="mb-4">
                            @if(!empty($dealer->internal_notes))
                                <p>{{ $dealer->internal_notes }}</p>
                            @else
                                <p class="text-muted">No description available for this dealer.</p>
                            @endif
                        </div>

                        <div class="row g-3">
                            <div class="col-6">
                                <img src="/assets/images/Carento (10).png" class="gallery-img" alt="Car">
                            </div>
                            <div class="col-6">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <img src="/assets/images/Carento (20).png" class="gallery-img" alt="Car">
                                    </div>
                                    <div class="col-12">
                                        <img src="/assets/images/Carento (30).png" class="gallery-img" alt="Car">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="content-box shadow-sm" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">

                    <!-- Dropdown Header -->
                    <h5 class="fw-bold mb-4 d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                        data-bs-target="#servicesContent" style="cursor:pointer;">
                        Services
                        <i class="fas fa-chevron-down"></i>
                    </h5>

                    <!-- Collapsible Content -->
                    <div class="collapse show" id="servicesContent">

                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled service-list">
                                    <li class="services-list">
                                        <img src="/assets/images/tick-green.2bab987d.svg (1).png" alt="">
                                        Exclusive car vehicle sales with customization options
                                    </li>
                                    <li class="services-list">
                                        <img src="/assets/images/tick-green.2bab987d.svg (1).png" alt="">
                                        Certified pre-owned vehicles with comprehensive inspections
                                    </li>
                                    <li class="services-list">
                                        <img src="/assets/images/tick-green.2bab987d.svg (1).png" alt="">
                                        Flexible financing and leasing solutions tailored to your needs
                                    </li>
                                    <li class="services-list">
                                        <img src="/assets/images/tick-green.2bab987d.svg (1).png" alt="">
                                        Full-service vehicle maintenance and repair center
                                    </li>
                                    <li class="services-list">
                                        <img src="/assets/images/tick-green.2bab987d.svg (1).png" alt="">
                                        Authentic parts and accessories for optimal vehicle performance
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <ul class="list-unstyled service-list">
                                    <li class="services-list">
                                        <img src="/assets/images/tick-green.2bab987d.svg (1).png" alt="">
                                         Comprehensive Vehicle Maintenance
                                    </li>
                                    <li class="services-list">
                                        <img src="/assets/images/tick-green.2bab987d.svg (1).png" alt="">
                                         Genuine Parts & Accessories
                                    </li>
                                    <li class="services-list">
                                        <img src="/assets/images/tick-green.2bab987d.svg (1).png" alt="">
                                         Trade-in evaluation
                                    </li>
                                    <li class="services-list">
                                        <img src="/assets/images/tick-green.2bab987d.svg (1).png" alt="">
                                         Extended Warranty Plans
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Rate Reviews Section -->
                <!-- <div class="content-box shadow-sm">

                    Header
                    <h5 class="fw-bold mb-4 d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                        data-bs-target="#rateReviewContent" style="cursor:pointer;">
                        Rate Reviews
                        <i class="fas fa-chevron-down"></i>
                    </h5>

                    Collapsible Body
                    <div class="collapse show" id="rateReviewContent">

                        <div class="row align-items-center mb-5 p-3">
                            <div class="col-md-4 text-center rate-review-starting">
                                <div class="rating-num">4.95 / 5</div>
                                <p class="mb-1">6472 reviews</p>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>

                            <div class="col-md-8 ps-md-5">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="small" style="width: 100px;">Price</span>
                                    <div class="progress flex-grow-1 mx-3">
                                        <div class="progress-bar" style="width: 90%;"></div>
                                    </div>
                                    <span class="small">4.6/5</span>
                                </div>

                                <div class="d-flex align-items-center mb-2">
                                    <span class="small" style="width: 100px;">Service</span>
                                    <div class="progress flex-grow-1 mx-3">
                                        <div class="progress-bar" style="width: 85%;"></div>
                                    </div>
                                    <span class="small">4.2/5</span>
                                </div>

                                <div class="d-flex align-items-center mb-2">
                                    <span class="small" style="width: 100px;">Safety</span>
                                    <div class="progress flex-grow-1 mx-3">
                                        <div class="progress-bar" style="width: 95%;"></div>
                                    </div>
                                    <span class="small">4.9/5</span>
                                </div>


                                <div class="d-flex align-items-center mb-2">
                                    <span class="small" style="width: 100px;">Entertainment</span>
                                    <div class="progress flex-grow-1 mx-3">
                                        <div class="progress-bar" style="width: 90%;"></div>
                                    </div>
                                    <span class="small">4.7/5</span>
                                </div>


                                <div class="d-flex align-items-center mb-2">
                                    <span class="small" style="width: 100px;">Accessibility</span>
                                    <div class="progress flex-grow-1 mx-3">
                                        <div class="progress-bar" style="width: 100%;"></div>
                                    </div>
                                    <span class="small">5/5</span>
                                </div>


                                <div class="d-flex align-items-center mb-2">
                                    <span class="small" style="width: 100px;">Support</span>
                                    <div class="progress flex-grow-1 mx-3">
                                        <div class="progress-bar" style="width: 100%;"></div>
                                    </div>
                                    <span class="small">5/5</span>
                                </div>
                            </div>
                        </div>

                        Single Review
                        <div class="review mb-4">
                            <div class="d-flex justify-content-between align-items-center  review-header-custom">
                                <div class="d-flex align-items-center">
                                    <img src="/assets/images/Travila01.png" class="rounded-circle me-3" alt="User">
                                    <div>
                                        <h6 class="mb-0 fw-bold">Sarah Johnson</h6>
                                        <small>December 4, 2024 at 3:12 pm</small>
                                    </div>
                                </div>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="m-3">
                                The views from The High Roller were absolutely stunning! It's a fantastic way to see the
                                Strip and the
                                surrounding area. The cabins are spacious and comfortable, and the audio commentary adds
                                an extra layer of
                                enjoyment. Highly recommend!
                            </p>
                        </div>

                        <div class="review mb-4">
                            <div class="d-flex justify-content-between align-items-center  review-header-custom">
                                <div class="d-flex align-items-center">
                                    <img src="/assets/images/Travila01.png" class="rounded-circle me-3" alt="User">
                                    <div>
                                        <h6 class="mb-0 fw-bold">Sarah Johnson</h6>
                                        <small>December 4, 2024 at 3:12 pm</small>
                                    </div>
                                </div>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="m-3">
                                The views from The High Roller were absolutely stunning! It's a fantastic way to see the
                                Strip and the
                                surrounding area. The cabins are spacious and comfortable, and the audio commentary adds
                                an extra layer of
                                enjoyment. Highly recommend!
                            </p>
                        </div>

                        <div class="review mb-4">
                            <div class="d-flex justify-content-between align-items-center  review-header-custom">
                                <div class="d-flex align-items-center">
                                    <img src="/assets/images/Travila01.png" class="rounded-circle me-3" alt="User">
                                    <div>
                                        <h6 class="mb-0 fw-bold">Sarah Johnson</h6>
                                        <small>December 4, 2024 at 3:12 pm</small>
                                    </div>
                                </div>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="m-3">
                                The views from The High Roller were absolutely stunning! It's a fantastic way to see the
                                Strip and the
                                surrounding area. The cabins are spacious and comfortable, and the audio commentary adds
                                an extra layer of
                                enjoyment. Highly recommend!
                            </p>
                        </div>
                        @include('partials.pagination')
                    </div>
                </div> -->
                <!-- Rate Reviews Section -->


                <div class="content-box shadow-sm">

                    <h5 class="fw-bold mb-4 d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                        data-bs-target="#addReviewContent" style="cursor:pointer;">
                        Add a Review
                        <i class="fas fa-chevron-down"></i>
                    </h5>

                    <div class="collapse" id="addReviewContent">
                        <div class="container py-3 border-bottom mb-4   ">
                            <div class="row g-3">

                                <!-- Item -->
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Price</span>
                                        <span class="text-warning">
                                            ★★★★★
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Safety</span>
                                        <span class="text-warning">
                                            ★★★★★
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Accessibility</span>
                                        <span class="text-warning">
                                            ★★★★★
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Service</span>
                                        <span class="text-warning">
                                            ★★★★★
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Entertainment</span>
                                        <span class="text-warning">
                                            ★★★★★
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Support</span>
                                        <span class="text-warning">
                                            ★★★★★
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <h5 class="fw-bold mb-4 d-flex justify-content-between align-items-center">
                            Leave feedback

                        </h5>
                        <form action="#" method="POST">

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <input type="text" 
                                        name="name"
                                        class="form-control" 
                                        placeholder="Your name"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <input type="email" 
                                        name="email"
                                        class="form-control" 
                                        placeholder="Email address"
                                        required>
                                </div>

                                <div class="col-12">
                                    <textarea class="form-control" 
                                            name="comment"
                                            rows="5" 
                                            placeholder="Your comment"
                                            required></textarea>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-orange mt-4 px-5" disabled>
                                Submit review
                            </button>

                        </form>

                    </div>
                </div>

            </div>
            <style>
                .review-header-custom {
                    border-bottom: 1px solid #DDE1DE;
                    margin: 17px;
                    padding-bottom: 10px;
                }

                .review {
                    border: 1px solid #DDE1DE;
                    border-radius: 8px;
                }

                .rate-review-starting {
                    border: 1px solid #DDE1DE;
                    height: 185px;
                    width: auto;
                    border-radius: 8px;
                    padding: 50px 40px;
                }

                [data-bs-toggle="collapse"] i {
                    transition: 0.3s ease;
                }

                [data-bs-toggle="collapse"][aria-expanded="true"] i {
                    transform: rotate(180deg);
                }
            </style>
            <div class="col-lg-4">
                <div class="content-box shadow-sm p-4" data-aos="fade-left" data-aos-duration="700">
                <h5 class="fw-bold mb-4">Get in touch</h5>

                @if(!$isMotokloz)
                    <form data-ajax="true" id="leadForm" action="#" method="POST">
                        <!-- CSRF Token -->
                        @csrf
                        
                        <!-- Hidden fields -->
                        <input type="hidden" name="dealer_id" id="dealer_id" value="{{ $dealer->id ?? '' }}">
                        <input type="hidden" name="product_id" id="product_id" value="{{ $searched_vehicle->id ?? '' }}">
                        <input type="hidden" name="reason" id="reason" value="Contact Form">
                        <input type="hidden" name="type" value="WEBLEAD">
                        <input type="hidden" name="source" value="Motokloz">
                        <input type="hidden" name="lead_status" value="NEW">
                        <input type="hidden" name="lead_source" value="Website Contact Form">
                        <input type="hidden" name="lead_type" value="General Inquiry">

                        <!-- Show error messages if IDs are missing -->
                        @if(!($dealer->id ?? false))
                            <div class="alert alert-danger mb-3">
                                <strong>Error:</strong> Vehicle or dealer information is missing. 
                                Please contact support.
                            </div>
                        @endif

                        <!-- Name Field -->
                        <div class="mb-3 position-relative">
                            <img src="/assets/images/userlogin.png" class="input-icon" alt="" width="20">
                            <input type="text" 
                                id="name"
                                name="name"
                                class="form-control ps-5" 
                                placeholder="Your name"
                                required>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3 position-relative">
                            <img src="/assets/images/email.png" class="input-icon" alt="" width="20">
                            <input type="email" 
                                id="email"
                                name="email"
                                class="form-control ps-5" 
                                placeholder="Your email"
                                required>
                        </div>

                        <!-- Phone Field -->
                        <div class="mb-3 position-relative">
                            <img src="/assets/images/telephone.png" class="input-icon" alt="" width="20">
                            <input type="tel" 
                                id="phone"
                                name="phone"
                                class="form-control ps-5" 
                                placeholder="Your phone"
                                required>
                        </div>

                        <!-- Message Field -->
                        <div class="mb-3">
                            <textarea id="message"
                                    name="message" 
                                    class="form-control" 
                                    rows="5" 
                                    placeholder="Message"
                                    required></textarea>
                        </div>

                        <button type="submit" id="submitBtn" class="btn btn-orange w-100 mb-4 text-white"
                                @if(!($dealer->id ?? false)) @endif>
                            Send message <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </form>
                @else
                    <form data-ajax="true" id="leadForm" action="#" method="POST">
                        <!-- CSRF Token -->
                        @csrf
                        
                        <!-- Hidden fields -->
                        <input type="hidden" name="dealer_id" id="dealer_id" value="{{ $dealer->id ?? '' }}">
                        <input type="hidden" name="product_id" id="product_id" value="{{ $searched_vehicle->id ?? '' }}">
                        <input type="hidden" name="dealer_email" id="dealer_email" value="{{ $dealer->email ?? 'N/A' }}">
                        <input type="hidden" name="reason" id="reason" value="Contact Form">
                        <input type="hidden" name="type" value="WEBLEAD">
                        <input type="hidden" name="source" value="Motokloz">
                        <input type="hidden" name="lead_status" value="NEW">
                        <input type="hidden" name="lead_source" value="Website Contact Form">
                        <input type="hidden" name="lead_type" value="General Inquiry">

                        <!-- Show error messages if IDs are missing -->
                        @if(!($dealer->id ?? false))
                            <div class="alert alert-danger mb-3">
                                <strong>Error:</strong> Vehicle or dealer information is missing. 
                                Please contact support.
                            </div>
                        @endif

                        <!-- Name Field -->
                        <div class="mb-3 position-relative">
                            <img src="/assets/images/userlogin.png" class="input-icon" alt="" width="20">
                            <input type="text" 
                                id="name"
                                name="name"
                                class="form-control ps-5" 
                                placeholder="Your name"
                                required>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3 position-relative">
                            <img src="/assets/images/email.png" class="input-icon" alt="" width="20">
                            <input type="email" 
                                id="email"
                                name="email"
                                class="form-control ps-5" 
                                placeholder="Your email"
                                required>
                        </div>

                        <!-- Phone Field -->
                        <div class="mb-3 position-relative">
                            <img src="/assets/images/telephone.png" class="input-icon" alt="" width="20">
                            <input type="tel" 
                                id="phone"
                                name="phone"
                                class="form-control ps-5" 
                                placeholder="Your phone"
                                required>
                        </div>

                        <!-- Message Field -->
                        <div class="mb-3">
                            <textarea id="message"
                                    name="message" 
                                    class="form-control" 
                                    rows="5" 
                                    placeholder="Message"
                                    required></textarea>
                        </div>

                        <button type="submit" id="submitBtn" class="btn btn-orange w-100 mb-4 text-white">
                            Send message <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </form>
                @endif

                <!-- Contact Info -->
                <div class="small">
                    <p class="mb-2">
                        <img src="/assets/images/Background (8).png" width="20" alt="phone" class="contact-icon light-dark me-2"> 
                        <strong>Mobile:</strong> {{ $dealer->phone_no ?? 'N/A' }}
                    </p>
                    <p class="mb-2">
                        <img src="/assets/images/Background (10).png" width="20" alt="email" class="contact-icon light-dark me-2"> 
                        <strong>Email:</strong> {{ $dealer->email ?? 'N/A' }}
                    </p>
                    <p class="mb-2">
                        <i class="fa-brands fa-whatsapp me-2 fs-5"></i>
                        <strong>WhatsApp:</strong> {{ $dealer->phone_no ?? 'N/A' }}
                    </p>
                    @if(!empty($dealer?->subaccount['twilio_phone_number']))
                        <p class="mb-2">
                            <img src="/assets/images/Background (11).png" width="20" alt="whatsapp" class="contact-icon light-dark me-2"> 
                            <strong>SMS:</strong> {{ $dealer->subaccount['twilio_phone_number'] }}
                        </p>
                    @endif
                    {{-- <p class="mb-2">
                        <img src="/assets/images/Background (12).png" width="20" alt="fax" class="contact-icon light-dark me-2">
                        <strong>Fax:</strong> {{ $dealer->phone_no ?? 'N/A' }}
                    </p> --}}
                </div>

                <div class="content-box shadow-sm">
                    <h5 class="fw-bold mb-3">Dealer Location</h5>

                    <iframe
                        width="100%"
                        height="260"
                        style="border:0; border-radius:12px; display:block;"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://maps.google.com/maps?q={{ $mapAddress }}&output=embed&z=15">
                    </iframe>

                    <p style="margin-top:10px; margin-bottom:0; font-size:14px; font-weight:600; color:var(--select-color, #222); display:flex; align-items:center; gap:6px;">
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 0C4.686 0 2 2.686 2 6c0 4.5 6 14 6 14s6-9.5 6-14c0-3.314-2.686-6-6-6z" fill="#ff9d00"/>
                            <circle cx="8" cy="6" r="2.5" fill="#fff"/>
                        </svg>
                        {{ $dealer->physical_address ?? 'Location Not Available'}}
                    </p>
                </div>
                @if(!$isMotokloz)
                    <a href="{{ route('dealer_inventory', $dealer->id) }}">
                        <button class="mto-btn-orange w-100 mb-3">
                            View This Dealer's Inventory
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </button>
                    </a>
                @endif
                <a href="/car-listing">
                    <button class="mto-btn-black w-100 mb-3">View all inventory  <i class="fa-solid fa-arrow-right ms-2"></i></button>
                </a>
                <a href="/dealer-network">
                    <button class="btn btn-orange w-100 shadow-sm">View all dealers <i
                            class="fas fa-arrow-right ms-2"></i></button>
                </a>
            </div>

        </div>

        <div class="row g-4">
            <div class="container mt-5">
                    <div class="dealer-top-section" data-aos="fade-up" data-aos-duration="600">
                        <h4 class="dealer-top-title">Listed by this dealer</h4>
                        <p class="dealer-top-subtitle">Top Cars are listed</p>
                    </div>
                </div>
                <div class="row g-4" id="inventoryContainer">
                    @foreach ($inventory as $recent_vehicle)
                        <div class="col-lg-3 col-sm-6 dealer-vehicle-card">
                            <div class="modern-car-card shadow-sm">
                                <div class="car-card-top">
                                    {{-- @php
                                    if ($recent_vehicle->inventory_logo != null) {
                                        $logo = explode('|', $recent_vehicle->inventory_logo);
                                    } else {
                                        $logo[0] = 'car_thumb.png';
                                    }
                                    @endphp --}}
                                    @php
                                        // Create a URL-friendly slug from the vehicle title
                                        $vehicleName = $recent_vehicle->year . ' ' . 
                                                    ($recent_vehicle->mfg_auto ?? '') . ' ' . 
                                                    ($recent_vehicle->model ?? '');
                                        $slug = Str::slug($vehicleName, '-');
                                        $detailUrl = route('inventory_product_details', ['name' => $slug, 'id' => $recent_vehicle->id]);
                                        $defaultImage = asset('assets/images/defaultimage.jpg');

                                        $img = $recent_vehicle->primary_image
                                            ? (Str::startsWith($recent_vehicle->primary_image, 'http')
                                                ? $recent_vehicle->primary_image
                                                : env('diskloz_base_url').'/admin_assets/images/inventory_images/'.$recent_vehicle->primary_image)
                                            : $defaultImage;
                                    @endphp

                                    <a href="{{ $detailUrl }}">
                                        <img
                                            style="width:100%"
                                            src="{{ $img }}"
                                            alt="Vehicle Image"
                                            class="img-box img-fluid"
                                            onerror="this.onerror=null;this.src='{{ $defaultImage }}';"
                                        >
                                    </a>
                                    @php
                                        $isOwnCard = auth()->check()
                                            && strtolower($recent_vehicle->source ?? '') === 'motokloz'
                                            && !empty($recent_vehicle->client_id)
                                            && (int) $recent_vehicle->client_id === auth()->id();
                                    @endphp
                                    @if(!$isOwnCard)
                                        <button class="card-wishlist-btn" id="wishlist-btn-{{ $recent_vehicle->id }}"
                                            onclick="event.stopPropagation(); toggleLike({{ $recent_vehicle->id }}, this, {{ auth()->id() ?? 'null' }})"
                                            title="Add to Wishlist">
                                            <i class="fa-spin fa-spinner fa d-none"
                                                id="wishlist-spinner-{{ $recent_vehicle->id }}"></i>
                                            <i class="far fa-star" id="wishlist-icon-{{ $recent_vehicle->id }}"></i>
                                        </button>
                                    @endif
                                    <div class="badge-mileage"><img src="/assets/images/mile1.png" alt="Mileage" class="me-2" style="width:20px; height:12px;"> 
                                        {{ $recent_vehicle->mileage 
                                        ? number_format((float) trim(str_ireplace('km', '', $recent_vehicle->mileage))) . ' km'
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
                                        @elseif($isOwnCard)
                                            <h4 class="price-value">$0</h4>
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
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            // CSRF Setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            function handleErrors(xhr){
                console.log('Error Response:', xhr.responseJSON);
                console.log('Status Code:', xhr.status);

                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    let msgs = [];
                    $.each(xhr.responseJSON.errors, function(field, messages) {
                        msgs.push(messages.join(', '));
                    });
                    showSnackbar(msgs.join(' | '), 'error');

                } else if (xhr.status === 404) {
                    showSnackbar('API endpoint not found.', 'error');

                } else if (xhr.status === 500) {
                    showSnackbar('Server error. Please try again later.', 'error');

                } else {
                    showSnackbar(xhr.responseJSON?.message || 'Something went wrong.', 'error');
                }
            }


            // ===================== CONTACT FORM (Email Only) =====================
            $('#leadForm').on('submit', function (e) {
                e.preventDefault();
                
                var $form = $(this);
                var $btn = $form.find('button[type="submit"]');
                
                // Check if dealer email exists
                var dealerEmail = $form.find('input[name="dealer_email"]').val();
                if (!dealerEmail) {
                    alert('Error: Dealer email is missing. Please contact support.');
                    return;
                }
                
                // Get form data
                var formData = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: $('#name').val().trim(),
                    email: $('#email').val().trim(),
                    phone: $('#phone').val().trim(),
                    message: $('#message').val().trim(),
                    dealer_email: dealerEmail,
                    vehicle_id: $form.find('input[name="product_id"]').val(),
                    source: 'Motokloz'
                };
                
                // Validation
                if (!formData.name || !formData.email || !formData.phone || !formData.message) {
                    alert('Please fill all required fields!');
                    return;
                }
                
                // Email validation
                if (!/^[^\s@]+@([^\s@]+\.)+[^\s@]+$/.test(formData.email)) {
                    alert('Please enter a valid email address.');
                    return;
                }
                
                // Disable button
                $btn.prop('disabled', true);
                var originalText = $btn.html();
                $btn.html('<i class="fas fa-spinner fa-spin"></i> Sending...');
                
                console.log('Sending contact email to:', dealerEmail);
                
                // Send AJAX to send email
                $.ajax({
                    url: "/contact-mail",
                    method: "POST",
                    data: formData,
                    success: function (response) {
                        alert(response.message || 'Message sent successfully!');
                        $form[0].reset();
                    },
                    error: function (xhr) {
                        if (xhr.status === 419) {
                            alert('Session expired. Refreshing page...');
                            location.reload();
                        } else {
                            alert('Error: ' + (xhr.responseJSON?.message || 'Something went wrong'));
                        }
                    },
                    complete: function () {
                        $btn.prop('disabled', false).html(originalText);
                    }
                });
            });

            $('#leadForm').on('submit', function(e){
                e.preventDefault();

                var dealerId = $('#dealer_id').val();
                var productId = $('#product_id').val();

                // ===== VALIDATIONS =====
                if (!dealerId || dealerId === '' || dealerId.toLowerCase() === 'null') {
                    showSnackbar('Dealer info missing. Refresh page.', 'warning');
                    return;
                }

                dealerId = parseInt(dealerId);
                productId = parseInt(productId);

                if (isNaN(dealerId) || dealerId <= 0) {
                    showSnackbar('Invalid dealer info.', 'error');
                    return;
                }


                var formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    message: $('#message').val(),
                    reason: $('#reason').val(),
                    type: $('input[name="type"]').val(),
                    source: $('input[name="source"]').val(),
                    lead_status: $('input[name="lead_status"]').val(),
                    dealer_id: dealerId,
                    product_id: productId,
                    lead_source: $('input[name="lead_source"]').val(),
                    lead_type: $('input[name="lead_type"]').val()
                };

                if (!formData.name || !formData.email || !formData.phone || !formData.message) {
                    showSnackbar('Fill all required fields', 'warning');
                    return;
                }

                var emailRegex = /^[^\s@]+@([^\s@]+\.)+[^\s@]+$/;
                if (!emailRegex.test(formData.email)) {
                    showSnackbar('Invalid email address', 'warning');
                    return;
                }

                if (formData.phone.length < 10) {
                    showSnackbar('Enter valid phone number', 'warning');
                    return;
                }

                // ===== UI STATE (SAME STYLE) =====
                var $btn = $(this).find('button[type="submit"]');
                var originalText = $btn.html();

                $btn.prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin me-2"></i>');

                $('#loadingSpinner').show();

                // ===== AJAX =====
                $.ajax({
                    url: "{{ env('diskloz_base_url') }}/api/leads",
                    method: 'POST',
                    data: JSON.stringify(formData),
                    contentType: 'application/json',
                    dataType: 'json',

                    success: function(res){
                        showSnackbar('Form Submitted successfully!', 'success');

                        $('#leadForm')[0].reset();
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
        .dealer-top-title {
            font-weight: 600;
            font-size: 40px;
            color: var(--select-color);
        }

        .dealer-top-section {
            /* padding: 10px 0; */
            border-top: 1px solid #DDE1 DE;
        }


        .dealer-top-subtitle {
            font-weight: 400;
            font-size: 16px;
            color: #9E9E9E;
            /* margin-top: 8px; */
        }

        .dealer-profile-banner {
            position: relative;
            min-height: 465px;
            border-radius: 20px;
            overflow: hidden;
        }

        .input-img {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #999;
        }

        .form-control {
            height: 50px;
            border-radius: 8px;
        }

        textarea.form-control{
            height:170px;
        }

        /* Style for disabled button */
        .btn-orange:disabled,
        .btn-orange.disabled {
            opacity: 0.65;
            cursor: not-allowed;
            pointer-events: none;
            background-color: #f98e00;
            border-color: #f98e00;
        }

        /* If you want to maintain full opacity but just disable click */
        .btn-orange:disabled {
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Or if you want a different look for disabled state */
        .btn-orange:disabled {
            background-color: #f98e00;
            border-color: #f98e00;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>

<script>
var DISKLOZ_BASE_DP = "{{ env('diskloz_base_url') }}";
$(document).ready(function () {
    @auth
    var authId = {{ auth()->id() }};
    fetch(DISKLOZ_BASE_DP + '/api/favorites?client_id=' + authId)
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

@endsection