<!DOCTYPE html>
<html>

<head>
    <title>Dealer Profile</title>
    <?php require_once(__DIR__ . '/../include/header-script.php'); ?>


</head>

<body>

    <?php require_once(__DIR__ . '/../include/header.php'); ?>

   
<div class="map-banner">
        <img src="<?php echo $prefix; ?>/assets/images/map2.png" alt="Map" class="w-100 object-fit-cover" style="height: 350px;">
    </div>

    <div class="container my-5">
        <div class="row">
            
            <div class="col-lg-8">
                
                <div class="content-box shadow-sm">
                    <div class="d-flex align-items-center mb-4 border-bottom pb-4">
                        <img src="<?php echo $prefix; ?>/assets/images/Carento2.png" class="me-3 rounded" alt="Logo">
                        <div>
                            <h3 class="mb-0 fw-bold">Peugeot Sheffield</h3>
                            <p class="mb-0"><i class="fas fa-map-marker-alt"></i> 123 Kingway Greenland, Manchester, M20 2XE</p>
                            <span class="badge bg-light text-dark border mt-2">112 reviews</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="">Elevate your Las Vegas experience to new heights with a journey aboard The High Roller at LINQ. As the tallest observation wheel in the world, standing at an impressive 550 feet tall, The High Roller offers a unique perspective of the iconic Las Vegas Strip and its surrounding desert landscape.</p>
                        <p class="">Whether you're a first-time visitor or a seasoned Las Vegas enthusiast, The High Roller promises an unparalleled experience that will leave you in awe. With its climate-controlled cabins and immersive audio commentary, this attraction provides a unique opportunity to see Las Vegas from a whole new perspective.</p>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <img src="<?php echo $prefix; ?>/assets/images/Carento (10).png" class="gallery-img" alt="Car">
                        </div>
                        <div class="col-6">
                            <div class="row g-3">
                                <div class="col-12"><img src="<?php echo $prefix; ?>/assets/images/Carento (20).png" class="gallery-img" alt="Car"></div>
                                <div class="col-12"><img src="<?php echo $prefix; ?>/assets/images/Carento (30).png" class="gallery-img" alt="Car"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-box shadow-sm">
                    <h5 class="fw-bold mb-4">Services</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled service-list">
                                <li><i class="fas fa-circle"></i> Exclusive car vehicle sales with customization options</li>
                                <li><i class="fas fa-circle"></i> Certified pre-owned vehicles with comprehensive inspections</li>
                                <li><i class="fas fa-circle"></i> Flexible financing and leasing solutions tailored to your needs</li>
                                <li><i class="fas fa-circle"></i> Full-service vehicle maintenance and repair center</li>
                                <li><i class="fas fa-circle"></i> Authentic parts and accessories for optimal vehicle performance</li>
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

                <div class="content-box shadow-sm">
                    <h5 class="fw-bold mb-4">Rate Reviews</h5>
                    <div class="row align-items-center mb-5 border-bottom pb-4">
                        <div class="col-md-4 text-center border-end">
                            <div class="rating-num">4.95 / 5</div>
                            <p class="mb-1">6472 reviews</p>
                            <div class="text-warning">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="col-md-8 ps-md-5">
                            <div class="d-flex align-items-center mb-2">
                                <span class="small" style="width: 100px;">Price</span>
                                <div class="progress flex-grow-1 mx-3"><div class="progress-bar" style="width: 90%;"></div></div>
                                <span class="small">4.6/5</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="small" style="width: 100px;">Service</span>
                                <div class="progress flex-grow-1 mx-3"><div class="progress-bar" style="width: 85%;"></div></div>
                                <span class="small">4.2/5</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="small" style="width: 100px;">Safety</span>
                                <div class="progress flex-grow-1 mx-3"><div class="progress-bar" style="width: 95%;"></div></div>
                                <span class="small">4.9/5</span>
                            </div>
                        </div>
                    </div>

                    <div class="review mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="<?php echo $prefix; ?>/assets/images/Travila01.png" class="rounded-circle me-3" alt="User">
                                <div>
                                    <h6 class="mb-0 fw-bold">Sarah Johnson</h6>
                                    <small class="">December 4, 2024 at 3:12 pm</small>
                                </div>
                            </div>
                            <div class="text-warning"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        </div>
                        <p class="mt-3">The views from the High Roller were absolutely stunning! It's a fantastic way to see the Strip and the surrounding area. The cabins are spacious and comfortable.</p>
                    </div>
                </div>

                <div class="content-box shadow-sm">
                    <h5 class="fw-bold mb-4">Add a review</h5>
                    <div class="row g-4">
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="Your name"></div>
                        <div class="col-md-6"><input type="email" class="form-control" placeholder="Email address"></div>
                        <div class="col-12"><textarea class="form-control" rows="5" placeholder="Your comment"></textarea></div>
                    </div>
                    <button class="btn btn-orange mt-4 px-5">Submit review</button>
                </div>

            </div>

            <div class="col-lg-4">
                <div class="content-box shadow-sm">
                    <h5 class="fw-bold mb-4">Get in touch</h5>
                    <div class="mb-3"><input type="text" class="form-control" placeholder="Your name"></div>
                    <div class="mb-3"><input type="email" class="form-control" placeholder="Your email"></div>
                    <div class="mb-3"><textarea class="form-control" rows="4" placeholder="Message"></textarea></div>
                    <button class="btn btn-orange w-100 mb-4">Send message <i class="fas fa-arrow-right ms-2"></i></button>
                    
                    <div class="small">
                        <p class="mb-2"><i class="fas fa-phone-alt me-2"></i> <strong>Mobile:</strong> 1-222-333-4444</p>
                        <p class="mb-2"><i class="fas fa-envelope me-2"></i> <strong>Email:</strong> emily.rose@gmail.com</p>
                        <p class="mb-2"><i class="fab fa-whatsapp me-2"></i> <strong>WhatsApp:</strong> 1-222-333-4444</p>
                    </div>
                </div>

                <div class="content-box shadow-sm">
                    <h5 class="fw-bold mb-3">Dealer Location</h5>
                    <img src="<?php echo $prefix; ?>/assets/images/map.png" class="img-fluid rounded mb-3" alt="Location Map">
                    <p class="small  mb-0"><i class="fas fa-map-marker-alt"></i> 123 Kingway Greenland, Manchester, M20 2XE</p>
                </div>

                <button class="btn btn-dark-custom w-100 mb-3">View all inventory <i class="fas fa-arrow-right ms-2"></i></button>
                <button class="btn btn-orange w-100 shadow-sm">View all dealers <i class="fas fa-arrow-right ms-2"></i></button>
            </div>

        </div>
    </div>




     <?php require_once(__DIR__ . '/../include/footer-script.php'); ?>
<?php require_once(__DIR__ . '/../include/footer.php'); ?>

</body>

</html>