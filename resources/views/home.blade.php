@extends('layouts.app')

@section('content')


    <section class="banner-section">
        <div class="container-fluid">
            <div class="banner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="search-wrapper">
                                <!-- Tabs -->
                                <div class="tabs">
                                    <a class="tab active">All</a>
                                    <a class="tab">New</a>
                                    <a class="tab">Used</a>

                                    <div class="help">
                                        <i class="fa-solid fa-user"></i>
                                        <span>Need help?</span>
                                    </div>
                                </div>

                                <!-- Filter Bar -->
                                <div class="filter-bar">

                                    <div class="filter">
                                        <label>Type</label>
                                        <div class="select">
                                            <i class="fa-solid fa-car"></i>
                                            <select>
                                                <option>Auto</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <div class="filter">
                                        <label>Make</label>
                                        <div class="select">
                                            <i class="fa-solid fa-car-side"></i>
                                            <select>
                                                <option>Modern compact</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <div class="filter">
                                        <label>Model</label>
                                        <div class="select">
                                            <i class="fa-solid fa-calendar"></i>
                                            <select>
                                                <option>2022</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <div class="filter price">
                                        <label>Price Range</label>
                                        <input type="range" min="10000" max="12000" value="11000" id="priceRange">
                                        <div class="price-value">$ <span id="priceVal">10,000 - 12,000</span></div>
                                    </div>

                                    <button class="search-btn">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        Find a Vehicle
                                    </button>

                                </div>

                            </div>


                            <div class="browse-slider">
                                <h2>Browse By Type</h2>
                                <p>Find The Perfect Ride For Any Occasion</p>
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">

                                        <div class="swiper-slide">
                                            <a href="/car-listing/" class="card">
                                                <img src="/assets/images/Auto.png" class="img-fluid">
                                                <span>24 vehicles</span>
                                                <h4>Auto</h4>
                                            </a>
                                        </div>

                                        <div class="swiper-slide">
                                            <a href="#" class="card">
                                                <img src="/assets/images/RV.png" class="img-fluid">
                                                <span>24 vehicles</span>
                                                <h4>RV</h4>
                                            </a>
                                        </div>

                                        <div class="swiper-slide">
                                            <a href="#" class="card">
                                                <img src="/assets/images/Motorcycle.png" class="img-fluid">
                                                <span>24 vehicles</span>
                                                <h4>Motorcycle</h4>
                                            </a>
                                        </div>

                                        <div class="swiper-slide">
                                            <a href="#" class="card">
                                                <img src="/assets/images/Powersports.png" class="img-fluid">
                                                <span>24 vehicles</span>
                                                <h4>Powersports</h4>
                                            </a>
                                        </div>

                                        <div class="swiper-slide">
                                            <a href="#" class="card">
                                                <img src="/assets/images/Heavy Truck.png" class="img-fluid">
                                                <span>24 vehicles</span>
                                                <h4>Heavy Truck</h4>
                                            </a>
                                        </div>

                                        <div class="swiper-slide">
                                            <a href="#" class="card">
                                                <img src="/assets/images/Trailers.png" class="img-fluid">
                                                <span>24 vehicles</span>
                                                <h4>Trailers</h4>
                                            </a>
                                        </div>

                                        <div class="swiper-slide">
                                            <a href="#" class="card">
                                                <img src="/assets/images/Farm Equipment.png" class="img-fluid">
                                                <span>24 vehicles</span>
                                                <h4>Farm Equipment</h4>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <section class="section-two">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="vehicle-box secure-box">
                        <div class="secure-content">
                            <h4>Secure My Vehicle Valuation</h4>
                            <p>Get a discreet trade-in estimate from trusted local dealers to help you decide where to
                                shop — no pressure, no obligation.</p>
                        </div>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pre-approval-box secure-box">
                        <div class="secure-content">
                            <h4>Secure My Pre-Approval</h4>
                            <p>Know exactly how much you qualify for before you go. Shop confidently with a clear budget
                                in mind.</p>
                        </div>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="popular-vehicles">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2>Popular Vehicles</h2>
                    <p>Favorite vehicles based on customer reviews</p>
                </div>
                <div class="col-lg-6 popular-button">
                    <ul>
                        <li><a href="#">Categories <i class="fa-solid fa-angle-down"></i></a></li>
                        <li><a href="#">Fuel Type <i class="fa-solid fa-angle-down"></i></a></li>
                        <li><a href="#">Review / Rating <i class="fa-solid fa-angle-down"></i></a></li>
                        <li><a href="#">Price range <i class="fa-solid fa-angle-down"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row g-4">
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
    </section>


    <section class="about-motokloz">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="about-bg">
                        <h2>About <span>Motokloz</span></h2>
                        <p>Lorem ipsum dolor sit amet consectetur. Aenean nisl elit blandit egestas consectetur feugiat
                            gravida bibendum dictum. Nisl sed sit feugiat phasellus odio. A id nunc non pellentesque
                            nunc sed. Diam nullam duis eget ante a nunc vitae eget. Volutpat mattis curabitur mauris
                            amet gravida est turpis purus porttitor. Praesent sollicitudin morbi fermentum urna eu nec
                            purus fermentum sit.</p>
                        <p>Dictum eget aliquam a ac leo eu maecenas. Accumsan pulvinar justo nec odio quam. Amet augue
                            massa consectetur purus luctus odio. Mi at cras adipiscing donec tortor. Commodo fermentum
                            cursus aliquam egestas lobortis felis risus elementum pharetra. Vel ut lobortis donec non
                            risus.</p>
                        <p>Commodo fermentum cursus aliquam egestas lobortis felis risus elementum pharetra. Vel ut
                            lobortis donec non risus.</p>
                        <a href="#" class="btn-custom">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="car-wrap">
            <img src="/assets/images/suv.png" class="car img-fluid" alt="car">
        </div>
    </section>



    <section class="testimonials-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 testimonials-content">
                    <h4><img src="/assets/images/persons.png" class="img-fluid">Testimonials</h4>
                    <h2>What they say about us?</h2>
                    <p>Egestas massa lobortis tellus libero sit suspendisse id elementum. <br>Est sit massa libero neque
                        fermentum non.</p>

                </div>
            </div>
            <div class="swiper review-swiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="review-card">
                            <img src="/assets/images/star.png" class="img-fluid">

                            <div class="review-user">
                                <h4>Sarah M.</h4>
                                <span class="review-verified">✔</span>
                            </div>

                            <p>
                                “Lorem ipsum dolor sit amet consectetur. At morbi pellentesque in ultricies. Accumsan
                                neque convallis scelerisque mauris. Nam et lorem aliquam cum sagittis.”
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="review-card">
                            <img src="/assets/images/star.png" class="img-fluid">

                            <div class="review-user">
                                <h4>Sarah M.</h4>
                                <span class="review-verified">✔</span>
                            </div>

                            <p>
                                “Lorem ipsum dolor sit amet consectetur. At morbi pellentesque in ultricies. Accumsan
                                neque convallis scelerisque mauris. Nam et lorem aliquam cum sagittis.”
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="review-card">
                            <img src="/assets/images/star.png" class="img-fluid">

                            <div class="review-user">
                                <h4>Alex K.</h4>
                                <span class="review-verified">✔</span>
                            </div>

                            <p>
                                “Lorem ipsum dolor sit amet consectetur. At morbi pellentesque in ultricies. Accumsan
                                neque convallis scelerisque mauris. Nam et lorem aliquam cum sagittis.”
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="review-card">
                            <img src="/assets/images/star.png" class="img-fluid">

                            <div class="review-user">
                                <h4>James L.</h4>
                                <span class="review-verified">✔</span>
                            </div>

                            <p>
                                “Lorem ipsum dolor sit amet consectetur. At morbi pellentesque in ultricies. Accumsan
                                neque convallis scelerisque mauris. Nam et lorem aliquam cum sagittis.”
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="review-card">
                            <img src="/assets/images/star.png" class="img-fluid">

                            <div class="review-user">
                                <h4>James L.</h4>
                                <span class="review-verified">✔</span>
                            </div>

                            <p>
                                “Lorem ipsum dolor sit amet consectetur. At morbi pellentesque in ultricies. Accumsan
                                neque convallis scelerisque mauris. Nam et lorem aliquam cum sagittis.”
                            </p>
                        </div>
                    </div>


                    <div class="swiper-slide">
                        <div class="review-card">
                            <img src="/assets/images/star.png" class="img-fluid">

                            <div class="review-user">
                                <h4>James L.</h4>
                                <span class="review-verified">✔</span>
                            </div>

                            <p>
                                “Lorem ipsum dolor sit amet consectetur. At morbi pellentesque in ultricies. Accumsan
                                neque convallis scelerisque mauris. Nam et lorem aliquam cum sagittis.”
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="review-card">
                            <img src="/assets/images/star.png" class="img-fluid">

                            <div class="review-user">
                                <h4>James L.</h4>
                                <span class="review-verified">✔</span>
                            </div>

                            <p>
                                “Lorem ipsum dolor sit amet consectetur. At morbi pellentesque in ultricies. Accumsan
                                neque convallis scelerisque mauris. Nam et lorem aliquam cum sagittis.”
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>





    <section class="car-review">
        <div class="container">
            <div class="col-lg-12">
                <h4></h4>
                <h2>Hyundai Tucson Plug-In <br>Hybrid 2025 review</h2>
                <p>The Tucson Plug-in Hybrid is easy to drive and<br> provides a sufficient all-electric range.</p>
                <a href="#" class="btn-custom-home">
                    View Details
                    <img src="/assets/images/bttnarrow.png" alt="arrow" class="btn-arrow-home">
                </a>
            </div>
        </div>
    </section>






    <style>
        .btn-custom-home {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: #f7931a;
            color: #fff;
            padding: 14px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-arrow-home {
            width: 20px;
            /* size adjust kar sakte ho */
            height: auto;
        }
    </style>



@endsection