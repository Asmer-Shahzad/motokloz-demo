@extends('layouts.app')

@section('content')

    <div class="map-banner">
        <img src="/assets/images/map2.png" alt="Map" class="w-100 object-fit-cover" style="height: 350px;">
    </div>

    <div class="container my-5">
        <div class="row">

            <div class="col-lg-8">

                <div class="content-box shadow-sm">

                    <!-- Dropdown Header -->
                    <h4 class="fw-bold d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                        data-bs-target="#overviewContent" style="cursor:pointer;">
                        Overview
                        <i class="fas fa-chevron-down"></i>
                    </h4>

                    <!-- Collapsible Content -->
                    <div class="collapse show" id="overviewContent">

                        <div class="d-flex align-items-center mb-4 border-bottom pb-4">
                            <img src="/assets/images/Carento2.png" class="me-3 rounded" alt="Logo">
                            <div>
                                <h3 class="mb-0 fw-bold">Peugeot Sheffield</h3>
                                <p class="mb-0">
                                    <i class="fas fa-map-marker-alt"></i>
                                    123 Kingway Greenland, Manchester, M20 2XE
                                </p>
                                <span class="badge bg-light text-dark border mt-2">
                                    112 reviews
                                </span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p>Elevate your Las Vegas experience to new heights with a journey aboard The High Roller at
                                The LINQ. As the tallest
                                observation wheel in the world, standing at an impressive 550 feet tall, The High Roller
                                offers a bird's-eye perspective of
                                the iconic Las Vegas Strip and its surrounding desert landscape. From the moment you
                                step into one of the spacious
                                cabins, you'll be transported on a mesmerizing adventure, where every turn offers a new
                                and breathtaking vista of the
                                vibrant city below.</p>
                            <p>Whether you're a first-time visitor or a seasoned Las Vegas aficionado, The High Roller
                                promises an unparalleled
                                experience that will leave you in awe. With its climate-controlled cabins and immersive
                                audio commentary, this
                                attraction provides a unique opportunity to see Las Vegas from a whole new perspective,
                                while learning about its rich
                                history and famous landmarks along the way.</p>
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

                <div class="content-box shadow-sm">

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
                                    <li><i class="fas fa-circle"></i> Exclusive car vehicle sales with customization
                                        options</li>
                                    <li><i class="fas fa-circle"></i> Certified pre-owned vehicles with comprehensive
                                        inspections</li>
                                    <li><i class="fas fa-circle"></i> Flexible financing and leasing solutions tailored
                                        to your needs</li>
                                    <li><i class="fas fa-circle"></i> Full-service vehicle maintenance and repair center
                                    </li>
                                    <li><i class="fas fa-circle"></i> Authentic parts and accessories for optimal
                                        vehicle performance</li>
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <ul class="list-unstyled service-list">
                                    <li><i class="fas fa-circle"></i> Comprehensive Vehicle Maintenance</li>
                                    <li><i class="fas fa-circle"></i> Genuine Parts & Accessories</li>
                                    <li><i class="fas fa-circle"></i> Trade-in evaluation</li>
                                    <li><i class="fas fa-circle"></i> Extended Warranty Plans</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="content-box shadow-sm">

                    <!-- Header -->
                    <h5 class="fw-bold mb-4 d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                        data-bs-target="#rateReviewContent" style="cursor:pointer;">
                        Rate Reviews
                        <i class="fas fa-chevron-down"></i>
                    </h5>

                    <!-- Collapsible Body -->
                    <div class="collapse show" id="rateReviewContent">

                        <div class="row align-items-center mb-5 ">
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

                        <!-- Single Review -->
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
                </div>

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
                        <div class="row g-4">

                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Your name">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Email address">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" rows="5" placeholder="Your comment"></textarea>
                            </div>
                        </div>

                        <button class="btn btn-orange mt-4 px-5">
                            Submit review
                        </button>

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
                }

                [data-bs-toggle="collapse"] i {
                    transition: 0.3s ease;
                }

                [data-bs-toggle="collapse"][aria-expanded="true"] i {
                    transform: rotate(180deg);
                }
            </style>
            <div class="col-lg-4">
                <div class="content-box shadow-sm">
                    <h5 class="fw-bold mb-4">Get in touch</h5>
                    <div class="mb-3"><input type="text" class="form-control" placeholder="Your name"></div>
                    <div class="mb-3"><input type="email" class="form-control" placeholder="Your email"></div>
                    <div class="mb-3"><textarea class="form-control" rows="4" placeholder="Message"></textarea></div>
                    <button class="btn btn-orange w-100 mb-4">Send message <i class="fas fa-arrow-right ms-2"></i></button>

                    <div class="small">
                        <p class="mb-2"><i class="fas fa-phone-alt me-2"></i> <strong>Mobile:</strong> 1-222-333-4444
                        </p>
                        <p class="mb-2"><i class="fas fa-envelope me-2"></i> <strong>Email:</strong>
                            emily.rose@gmail.com</p>
                        <p class="mb-2"><i class="fab fa-whatsapp me-2"></i> <strong>WhatsApp:</strong> 1-222-333-4444
                        </p>
                        <p class="mb-2"><i class="fas fa-fax me-2"></i></i> <strong>Fax:</strong> 1-222-333-4444

                        </p>
                    </div>
                </div>

                <div class="content-box shadow-sm">
                    <h5 class="fw-bold mb-3">Dealer Location</h5>
                    <img src="/assets/images/map.png" class="img-fluid rounded mb-3" alt="Location Map">
                    <p class="small  mb-0"><i class="fas fa-map-marker-alt"></i> 123 Kingway Greenland, Manchester, M20
                        2XE</p>
                </div>

                <button class="btn btn-dark-custom w-100 mb-3">View all inventory <i
                        class="fas fa-arrow-right ms-2"></i></button>
                <button class="btn btn-orange w-100 shadow-sm">View all dealers <i
                        class="fas fa-arrow-right ms-2"></i></button>
            </div>

        </div>




        <div class="row g-4">
            <div class="dealer-top-section">
                <h4 class="dealer-top-title">Listed by this dealer</h4>
                <p class="dealer-top-subtitle">Top Cars are listed</p>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="modern-car-card shadow-sm">
                    <div class="car-card-top">
                        <img src="https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=500" alt="Car">
                        <div class="badge-mileage">
                            <i class="fa-solid fa-gauge-high"></i> 25,100 Km
                        </div>
                    </div>
                    <div class="car-card-bottom">
                        <h5 class="car-main-title">2022 Cadillac XT6 Premium Luxury</h5>
                        <p class="car-distance-away"><i class="fa-solid fa-location-dot"></i> 12 Km away</p>

                        <div class="car-circle-icons-group">
                            <img src="/assets/images/no-accidents.png" alt="">
                            <img src="/assets/images/low-mileage.png" alt="">
                            <img src="/assets/images/service-plan.png" alt="">
                            <img src="/assets/images/powertrain-warranty.png" alt="">
                            <span class="extra-icons-count">12+</span>
                        </div>

                        <div class="car-price-block text-end">
                            <h4 class="price-value">$60089.32</h4>
                            <p class="price-sub-text">In sapien eu diam eu</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="modern-car-card shadow-sm">
                    <div class="car-card-top">
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500" alt="Car">
                        <div class="badge-mileage"><i class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
                    </div>
                    <div class="car-card-bottom">
                        <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                        <p class="car-distance-away"><i class="fa-solid fa-location-dot"></i> 5 Km away</p>
                        <div class="car-circle-icons-group">
                            <img src="/assets/images/no-accidents.png" alt="">
                            <img src="/assets/images/low-mileage.png" alt="">
                            <img src="/assets/images/service-plan.png" alt="">
                            <img src="/assets/images/powertrain-warranty.png" alt="">
                            <span class="extra-icons-count">12+</span>
                        </div>
                        <div class="car-price-block text-end">
                            <h4 class="price-value">$95400.00</h4>
                            <p class="price-sub-text">In sapien eu diam eu</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="modern-car-card shadow-sm">
                    <div class="car-card-top">
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500" alt="Car">
                        <div class="badge-mileage"><i class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
                    </div>
                    <div class="car-card-bottom">
                        <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                        <p class="car-distance-away"><i class="fa-solid fa-location-dot"></i> 5 Km away</p>
                        <div class="car-circle-icons-group">
                            <img src="/assets/images/no-accidents.png" alt="">
                            <img src="/assets/images/low-mileage.png" alt="">
                            <img src="/assets/images/service-plan.png" alt="">
                            <img src="/assets/images/powertrain-warranty.png" alt="">
                            <span class="extra-icons-count">12+</span>
                        </div>
                        <div class="car-price-block text-end">
                            <h4 class="price-value">$95400.00</h4>
                            <p class="price-sub-text">In sapien eu diam eu</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="modern-car-card shadow-sm">
                    <div class="car-card-top">
                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500" alt="Car">
                        <div class="badge-mileage"><i class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
                    </div>
                    <div class="car-card-bottom">
                        <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                        <p class="car-distance-away"><i class="fa-solid fa-location-dot"></i> 5 Km away</p>
                        <div class="car-circle-icons-group">
                            <img src="/assets/images/no-accidents.png" alt="">
                            <img src="/assets/images/low-mileage.png" alt="">
                            <img src="/assets/images/service-plan.png" alt="">
                            <img src="/assets/images/powertrain-warranty.png" alt="">
                            <span class="extra-icons-count">12+</span>
                        </div>
                        <div class="car-price-block text-end">
                            <h4 class="price-value">$95400.00</h4>
                            <p class="price-sub-text">In sapien eu diam eu</p>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <style>
        .dealer-top-title {
            font-weight: 600;
            font-size: 36px;
            color: var(--select-color);
        }

        .dealer-top-section {
            padding: 20px 0;
            border-top: 1px solid #DDE1 DE;
        }


        .dealer-top-subtitle {
            font-weight: 400;
            font-size: 16px;
            color: #9E9E9E;
            margin-top: 8px;
        }
    </style>
@endsection