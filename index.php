<!DOCTYPE html>
<html>

<head>
    <title>Motokloz</title>
    <?php include 'include/header-script.php'; ?>
</head>

<body>


    <?php include 'include/header.php'; ?>


    <section class="banner-section">
        <div class="container-fluid">
            <div class="banner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="search-wrapper">
                                <!-- Tabs -->
                                <div class="tabs">
                                    <button class="tab active">All</button>
                                    <button class="tab">New</button>
                                    <button class="tab">Used</button>

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
                                            <div class="card">
                                                <img src="<?php echo $prefix; ?>/assets/images/Auto.png"
                                                    class="img-fluid">
                                                <span>24 vehicles</span>
                                                <h4>Auto</h4>
                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <div class="card">
                                                <img src="<?php echo $prefix; ?>/assets/images/RV.png"
                                                    class="img-fluid">
                                                <span>24 vehicles</span>
                                                <h4>RV</h4>
                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <div class="card">
                                                <img src="<?php echo $prefix; ?>/assets/images/Motorcycle.png"
                                                    class="img-fluid">
                                                <span>24 vehicles</span>
                                                <h4>Motorcycle</h4>
                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <div class="card">
                                                <img src="<?php echo $prefix; ?>/assets/images/Powersports.png"
                                                    class="img-fluid">
                                                <span>24 vehicles</span>
                                                <h4>Powersports</h4>
                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <div class="card">
                                                <img src="<?php echo $prefix; ?>/assets/images/Heavy Truck.png"
                                                    class="img-fluid">
                                                <span>24 vehicles</span>
                                                <h4>Heavy Truck</h4>
                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <div class="card">
                                                <img src="<?php echo $prefix; ?>/assets/images/Trailers.png"
                                                    class="img-fluid">
                                                <span>24 vehicles</span>
                                                <h4>Trailers</h4>
                                            </div>
                                        </div>

                                        <div class="swiper-slide">
                                            <div class="card">
                                                <img src="<?php echo $prefix; ?>/assets/images/Farm Equipment.png"
                                                    class="img-fluid">
                                                <span>24 vehicles</span>
                                                <h4>Farm Equipment</h4>
                                            </div>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="car-slider">
                        <div class="swiper carSwiper">
                            <div class="swiper-wrapper">
                                <!-- Card -->
                                <div class="swiper-slide">
                                    <div class="car-img">
                                        <img src="<?php echo $prefix; ?>/assets/images/car1.png" class="img-fluid">
                                        <span class="rating">⭐ 4.96 (672 reviews)</span>
                                    </div>
                                    <div class="car-content">
                                        <h3>Audi Q5 2.0T Premium Plus</h3>
                                        <p class="location"><i class="fa-solid fa-location-dot"></i> New South Wales,
                                            Australia</p>
                                        <div class="specs">
                                            <span><i class="fa-solid fa-gauge"></i> 25,100 miles</span>
                                            <span><i class="fa-solid fa-gear"></i> Automatic</span>
                                            <span><i class="fa-solid fa-gas-pump"></i> Diesel</span>
                                            <span><i class="fa-solid fa-user-group"></i> 7 seats</span>
                                        </div>
                                        <div class="card-footer">
                                            <strong>$83,900.32</strong>
                                            <button>Book Now</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card -->
                                <div class="swiper-slide">
                                    <div class="car-img">
                                        <img src="<?php echo $prefix; ?>/assets/images/car2.png" class="img-fluid">
                                        <span class="rating">⭐ 4.96 (672 reviews)</span>
                                    </div>
                                    <div class="car-content">
                                        <h3>Audi Q5 2.0T Premium Plus</h3>
                                        <p class="location"><i class="fa-solid fa-location-dot"></i> New South Wales,
                                            Australia</p>
                                        <div class="specs">
                                            <span><i class="fa-solid fa-gauge"></i> 25,100 miles</span>
                                            <span><i class="fa-solid fa-gear"></i> Automatic</span>
                                            <span><i class="fa-solid fa-gas-pump"></i> Diesel</span>
                                            <span><i class="fa-solid fa-user-group"></i> 7 seats</span>
                                        </div>
                                        <div class="card-footer">
                                            <strong>$83,900.32</strong>
                                            <button>Book Now</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card -->
                                <div class="swiper-slide">
                                    <div class="car-img">
                                        <img src="<?php echo $prefix; ?>/assets/images/car3.png" class="img-fluid">
                                        <span class="rating">⭐ 4.96 (672 reviews)</span>
                                    </div>
                                    <div class="car-content">
                                        <h3>Audi Q5 2.0T Premium Plus</h3>
                                        <p class="location"><i class="fa-solid fa-location-dot"></i> New South Wales,
                                            Australia</p>
                                        <div class="specs">
                                            <span><i class="fa-solid fa-gauge"></i> 25,100 miles</span>
                                            <span><i class="fa-solid fa-gear"></i> Automatic</span>
                                            <span><i class="fa-solid fa-gas-pump"></i> Diesel</span>
                                            <span><i class="fa-solid fa-user-group"></i> 7 seats</span>
                                        </div>
                                        <div class="card-footer">
                                            <strong>$83,900.32</strong>
                                            <button>Book Now</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card -->
                                <div class="swiper-slide">
                                    <div class="car-img">
                                        <img src="<?php echo $prefix; ?>/assets/images/car3.png" class="img-fluid">
                                        <span class="rating">⭐ 4.96 (672 reviews)</span>
                                    </div>
                                    <div class="car-content">
                                        <h3>Audi Q5 2.0T Premium Plus</h3>
                                        <p class="location"><i class="fa-solid fa-location-dot"></i> New South Wales,
                                            Australia</p>
                                        <div class="specs">
                                            <span><i class="fa-solid fa-gauge"></i> 25,100 miles</span>
                                            <span><i class="fa-solid fa-gear"></i> Automatic</span>
                                            <span><i class="fa-solid fa-gas-pump"></i> Diesel</span>
                                            <span><i class="fa-solid fa-user-group"></i> 7 seats</span>
                                        </div>
                                        <div class="card-footer">
                                            <strong>$83,900.32</strong>
                                            <button>Book Now</button>
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
            <img src="<?php echo $prefix; ?>/assets/images/suv.png" class="car img-fluid" alt="car">
        </div>
    </section>



    <section class="testimonials-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 testimonials-content">
                    <h4><img src="<?php echo $prefix; ?>/assets/images/persons.png" class="img-fluid">Testimonials</h4>
                    <h2>What they say about us?</h2>
                    <p>Egestas massa lobortis tellus libero sit suspendisse id elementum. <br>Est sit massa libero neque
                        fermentum non.</p>

                </div>
            </div>
            <div class="swiper review-swiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="review-card">
                            <img src="<?php echo $prefix; ?>/assets/images/star.png" class="img-fluid">

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
                            <img src="<?php echo $prefix; ?>/assets/images/star.png" class="img-fluid">

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
                            <img src="<?php echo $prefix; ?>/assets/images/star.png" class="img-fluid">

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
                            <img src="<?php echo $prefix; ?>/assets/images/star.png" class="img-fluid">

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
                            <img src="<?php echo $prefix; ?>/assets/images/star.png" class="img-fluid">

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
                            <img src="<?php echo $prefix; ?>/assets/images/star.png" class="img-fluid">

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
                <h4>CAR REVIEW</h4>
                <h2>Hyundai Tucson Plug-In <br>Hybrid 2025 review</h2>
                <p>The Tucson Plug-in Hybrid is easy to drive and<br> provides a sufficient all-electric range.</p>
                <a href="#" class="btn-custom">Learn More</a>
            </div>
        </div>
    </section>












    <?php include 'include/footer.php'; ?>


    <?php include 'include/footer-script.php'; ?>
</body>

</html>