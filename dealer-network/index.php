<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-title" content="Motokloz" />
    <!-- <link rel="icon" type="image/svg+xml" href="/images/favicon.png" /> -->
    <!-- <link rel="shortcut icon" href="/images/favicon.png" /> -->
    <title>Motokloz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <link rel="stylesheet" href="/motokloz-demo/assets/css/custom.css">
    <link rel="stylesheet" href="/motokloz-demo/assets/css/user-auth.css">
    <link rel="stylesheet" href="/motokloz-demo/assets/css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Vend+Sans:ital,wght@0,300..700;1,300..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


</head>

<body>

    <header>
        <div class="header-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 btn-mobile">
                        <div class="logo-o">Buy
                            <span class="speed-line"></span>
                        </div>
                        <div class="logo-o">Sell
                            <span class="speed-line"></span>
                        </div>
                        <div class="logo-o">Protect
                            <span class="speed-line"></span>
                        </div>
                        <div class="logo-o">Borrow
                            <span class="speed-line"></span>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <nav class="navbar navbar-expand-lg">
                            <!-- <a class="navbar-brand" href="/">
                            <img src="/assets/images/logo.png" class="img-fluid" alt="Logo">
                        </a> -->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav  mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/">Auto</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/pricing/">RV</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/aboutus/">Motorcycle</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/contact-us/">Powersports</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/contact-us/">Heavy Truck</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/contact-us/">Trailers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/contact-us/">Farm Equipment</a>
                                    </li>
                                </ul>
                                <div class="mobile-btn">
                                    <div class="logo-o">Buy
                                        <span class="speed-line"></span>
                                    </div>
                                    <div class="logo-o">Sell
                                        <span class="speed-line"></span>
                                    </div>
                                    <div class="logo-o">Protect
                                        <span class="speed-line"></span>
                                    </div>
                                    <div class="logo-o">Borrow
                                        <span class="speed-line"></span>
                                    </div>
                                </div>
                            </div>

                        </nav>
                    </div>

                </div>
            </div>
        </div>
        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="/motokloz-demo/assets/images/darklogo.png" class="logo logo-dark" alt="Motokloz Logo">
                        <img src="/motokloz-demo/assets/images/lightlogo.png" class="logo logo-light"
                            alt="Motokloz Logo">
                        <button id="themeToggle" aria-label="Toggle theme">
                            <img id="themeIcon" src="/motokloz-demo/assets/images/darkmood.png" alt="Theme toggle" />
                        </button>
                    </div>
                    <div class="col-lg-6 btn-header">
                        <div class="logo-o">Buy
                            <span class="speed-line"></span>
                        </div>
                        <div class="logo-o">Sell
                            <span class="speed-line"></span>
                        </div>
                        <div class="logo-o">Protect
                            <span class="speed-line"></span>
                        </div>
                        <div class="logo-o">Borrow
                            <span class="speed-line"></span>
                        </div>
                        <img src="/motokloz-demo/assets/images/user.png" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="dealer-network-section py-3">
        <div class="container-fluid">
            <div class="dealer-banner position-relative overflow-hidden rounded-4">

                <!-- Background Image -->
                <img src="/motokloz-demo/assets/images/carento.png" alt="Dealer Network"
                    class="img-fluid w-100 banner-img">

                <!-- Overlay -->
                <div class="banner-overlay"></div>

                <!-- Text -->
                <div class="banner-content position-absolute top-50 start-0 translate-middle-y text-white px-4 px-md-5">
                    <h2 class="fw-bold mb-0">Dealer Network</h2>
                </div>

            </div>
        </div>
    </section>
    <section class="dealer-search py-4">
        <div class="container">

            <div class="dealer-search-wrap">
                <div class="dealer-search-inner">

                    <div class="search-field">
                        <input type="text" placeholder="Enter Dealer Name">
                    </div>

                    <div class="divider"></div>

                    <div class="search-field">
                        <input type="text" placeholder="Enter Postal Code">
                    </div>

                    <button class="btn-search">
                        🔍 Find a Vehicle
                    </button>

                    <button class="btn-dealer">
                        Become a Dealer →
                    </button>

                </div>
            </div>



            <div class="row g-3">
                <div class="deal-card">
                    <!-- CARD -->
                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493.png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">Opel Manchester</h6>
                                    <p class="dealer-address mb-2">
                                        123 Kingsway StranddRt,
                                        Manchester, M19 2XS
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493 (1).png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">BMW Birmingham</h6>
                                    <p class="dealer-address mb-2">
                                        45 SouthRd Road, Birmingham,
                                        B91 2DA
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493 (2).png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">Toyota London</h6>
                                    <p class="dealer-address mb-2">
                                        78 High Street Roadman,
                                        London, E1 6RL
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493 (3).png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">Ford Glasgow</h6>
                                    <p class="dealer-address mb-2">
                                        15 Buchanan Street, Glasgow, G1
                                        3HL
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493 (4).png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">Volkswagen Leeds</h6>
                                    <p class="dealer-address mb-2">
                                        230 block 90 Kirkstall Road,
                                        Leeds, LS3 1HS
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493 (5).png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">Honda Edinburgh</h6>
                                    <p class="dealer-address mb-2">
                                        62 Princes Street,
                                        Edinburgh, EH2 4AD
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493 (6).png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">Nissan Bristol</h6>
                                    <p class="dealer-address mb-2">
                                        11 Clifton Down Road, Bristol, BS8
                                        4AB
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493 (7).png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">Kia Liverpoo</h6>
                                    <p class="dealer-address mb-2">
                                        29 Hope Street, Liverpool, L1 9BX
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493 (8).png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">Peugeot Sheffield</h6>
                                    <p class="dealer-address mb-2">
                                        Block 123 / 90 Kirkstall Road, Leeds, LS3 1HS
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493 (9).png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">Volvo Oxford</h6>
                                    <p class="dealer-address mb-2">
                                        45 Solihull Road, Birmingham, B91 2DA
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493 (10).png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">Mazda Southampton</h6>
                                    <p class="dealer-address mb-2">
                                        123 Kingsway Strandeif,
                                        Manchester, M19 2XS
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493 (11).png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">Land Rover Norwich</h6>
                                    <p class="dealer-address mb-2">
                                        45 Solihull Road, Birmingham,
                                        B91 2DA
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493 (12).png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">Jeep Nottingham</h6>
                                    <p class="dealer-address mb-2">
                                        123 Kingsway Strandeif, Manchester, M19 2XS
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493 (13).png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">BMW Manchester</h6>
                                    <p class="dealer-address mb-2">
                                        11 Clifton Down Road,
                                        Bristol, BS8 4AB
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="col-md-4">
                        <div class="dealer-card bg-white rounded-4 p-3 h-100">

                            <div class="d-flex align-items-start gap-3">
                                <img src="/motokloz-demo/assets/images/ellipse 6493 (14).png" class="dealer-avatar">

                                <div>
                                    <h6 class="dealer-card-head">Ford Manchester</h6>
                                    <p class="dealer-address mb-2">
                                        123 Kingsway Strandeif,
                                        Manchester, M19 2XS
                                    </p>
                                    <span class="vehicle-badge">180 Vehicles</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>



    </section>


    <section class="mission-section py-5">
        <div class="container">
            <div class="row align-items-center g-4">

                <!-- LEFT CONTENT -->
                <div class="col-lg-6">

                    <span class="mission-badge">Our Mission</span>

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

                    <button class="btn btn-orange mt-2">
                        Get Started Now →
                    </button>

                </div>

                <!-- RIGHT IMAGES -->
                <div class="col-lg-6">
                    <div class="row g-3">

                        <div class="col-7">
                            <img src="/motokloz-demo/assets/images/carento (1).png" class="mission-img">
                        </div>

                        <div class="col-5">
                            <img src="/motokloz-demo/assets/images/carento (2).png" class="mission-img">
                        </div>

                        <div class="col-4">
                            <img src="/motokloz-demo/assets/images/carento (3).png" class="mission-img">
                        </div>

                        <div class="col-8">
                            <img src="/motokloz-demo/assets/images/carento (4).png" class="mission-img">
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>



    <style>
    .dealer-banner {
        position: relative;
        min-height: 430px;
        /* required height */
        border-radius: 20px;
    }

    .banner-img {
        width: 100%;
        height: 100%;
        min-height: 430px;
        object-fit: cover;
        display: block;
    }

    .banner-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg,
                rgba(0, 0, 0, 0.70) 0%,
                rgba(0, 0, 0, 0.35) 40%,
                rgba(0, 0, 0, 0) 70%);
    }

    .banner-content {
        position: absolute;
        left: 60px;
        /* text left spacing */
        top: 50%;
        transform: translateY(-50%);
    }

    .banner-content h2 {
        font-size: 40px;
        font-weight: 700;
    }

    @media (max-width: 768px) {

        .dealer-banner,
        .banner-img {
            min-height: 300px;
        }

        .banner-content {
            left: 25px;
        }

        .banner-content h2 {
            font-size: 28px;
        }
    }

    .dealer-search-wrap {
        padding: 20px;
    }

    .dealer-search-inner {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 12px 14px;
        display: flex;
        align-items: center;
        gap: 14px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
    }

    .search-field {
        flex: 1;
    }

    .search-field input {
        border: none;
        outline: none;
        width: 100%;
        font-size: 14px;
        color: #6b7280;
        background: transparent;
    }

    .divider {
        width: 1px;
        height: 28px;
        background: #e5e7eb;
    }

    /* Buttons */
    .btn-search {
        background: #F58D02;
        color: #fff;
        border: none;
        padding: 10px 18px;
        border-radius: 999px;
        font-weight: 500;
        white-space: nowrap;
    }

    .btn-dealer {
        background: #F58D02;
        color: #fff;
        border: none;
        padding: 10px 18px;
        border-radius: 999px;
        font-weight: 500;
        white-space: nowrap;
    }

    .btn-search:hover,
    .btn-dealer:hover {
        background: #e67f00;
    }



    /* Dealer Card */
    .dealer-card {
        border: 1px solid #DDE1DE;
        transition: 0.25s ease;
        background: #FFFFFF;
        border-radius: 8px !important;
        padding: 23px 26px !important;
    }

    .dealer-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    }

    .deal-card .col-md-4 {
        width: calc(33% - 13px) !important;
    }

    .deal-card {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
    }

    .dealer-avatar {
        width: 78px;
        height: 78px;
        border-radius: 50%;
        object-fit: cover;
    }

    .dealer-address {
        font-size: 16px;
        color: #737373;
        line-height: 26px;
    }

    .vehicle-badge {
        padding: 4px 10px;
        background: #F2F4F6;
        border-radius: 18px;
        display: inline-block;
        color: #000000;
        border: 1px solid #DDE1DE;
        font-weight: 700;
        font-size: 12px;
        line-height: 18px;
    }



    .mission-section {
        padding: 70px 0;
    }

    /* Badge */
    .mission-badge {
        background: #F58D02;
        color: #fff;
        padding: 10px 18px;
        border-radius: 42px;
        font-weight: 700;
        font-size: 14px;
        line-height: 26px;
    }

    /* Title */
    .mission-title {
        font-weight: 700;
        font-size: 36px;
        line-height: 42px;
        color: #000000;
    }

    /* Text */
    .mission-text {
        color: #737373;
        margin: 16px 0;
        font-size: 18px;
        line-height: 28px;
        font-weight: 500;
    }

    /* List */
    .mission-list {
        list-style: none;
        padding: 0;
        margin-bottom: 10px;
    }

    .mission-list li {
        position: relative;
        padding-left: 28px;
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: 700;
        left: 22px;
        color: #000000;
        padding-bottom: 12px;
    }


    .mission-list li::before {
        content: "";
        position: absolute;
        width: 18px;
        height: 18px;
        background: url('/motokloz-demo/assets/images/tick.png') no-repeat center;
        background-size: contain;
        left: 0;
        top: 4px;
    }

    /* Button */
    .btn-orange {
        background: #ff9800;
        color: #fff;
        border-radius: 999px;
        padding: 10px 18px;
        font-weight: 600;
    }

    .btn-orange:hover {
        background: #f08c00;
        color: #fff;
    }

    /* Images */
    .mission-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
    }










    .dealer-card-head {
        font-size: 24px;
        line-height: 32px;
        font-weight: 700;
        color: #000000;
    }
    </style>











    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>Subscribe to see secret deals prices drop the moment you sign up!</h3>
                    </div>
                    <div class="subscribe-box col-lg-6">
                        <input type="email" placeholder="Enter your Email">
                        <button type="submit">Subscribe</button>
                    </div>
                </div>
            </div>
            <div class="footer-mid">
                <div class="row">
                    <div class="col-lg-4">
                        <img src="/motokloz-demo/assets/images/darklogo.png" class="img-fluid" alt="Motokloz Logo">
                        <ul>
                            <li><i class="fa-sharp fa-solid fa-location-dot"></i><a href="#">2356 Oakwood Drive,
                                    Suite
                                    18, San Francisco, California 94111, US</a></li>
                            <li><i class="fa-sharp fa-solid fa-clock"></i><a href="#">Hours: 8:00 - 17:00, Mon -
                                    Sat</a>
                            </li>
                            <li><i class="fa-sharp fa-solid fa-envelope"></i><a
                                    href="mailto:support@carento.com">support@carento.com</a></li>
                        </ul>
                        <div class="calltoaction">
                            <h5><i class="fa-sharp fa-solid fa-phone"></i> Need help? Call us</h5>
                            <h6><a href="tel:+1 222-555-33-99">+1 222-555-33-99</a></h6>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <h4>Company</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Our Awards</a></li>
                            <li><a href="#">Agencies</a></li>
                            <li><a href="#">Copyright Notices</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privacy Notice</a></li>
                            <li><a href="#">Lost & Found</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2">
                        <h4>Our Partners</h4>
                        <ul>
                            <li><a href="#">Affiliates</a></li>
                            <li><a href="#">Travel Agents</a></li>
                            <li><a href="#">AARP Members</a></li>
                            <li><a href="#">Points Programs</a></li>
                            <li><a href="#">Military & Veterans</a></li>
                            <li><a href="#">Work with us</a></li>
                            <li><a href="#">Advertise with us</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <h4>Support</h4>
                        <ul>
                            <li><a href="#">Forum support</a></li>
                            <li><a href="#">Help Center</a></li>
                            <li><a href="#">Live chat</a></li>
                            <li><a href="#">How it works</a></li>
                            <li><a href="#">Security</a></li>
                            <li><a href="#">Refund Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <h4>Our Services</h4>
                        <ul>
                            <li><a href="#">Car Rental Services</a></li>
                            <li><a href="#">Vehicle Leasing Options</a></li>
                            <li><a href="#">Long-Term Car Rentals</a></li>
                            <li><a href="#">Car Sales and Trade-Ins</a></li>
                            <li><a href="#">Luxury Car Rentals</a></li>
                            <li><a href="#">Rent-to-Own Programs</a></li>
                            <li><a href="#">Fleet Management Solutions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-lg-6">
                        <p>© 2026 <span>Motokloz</span>. All rights reserved.</p>
                    </div>
                    <div class="col-lg-6">
                        <ul>
                            <li>Follow us</li>
                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>







    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- <script>
const toggleBtn = document.getElementById("themeToggle");
const icon = toggleBtn.querySelector("i");

// Page load pe saved theme check
if (localStorage.getItem("theme") === "dark") {
    document.body.classList.add("dark");
    icon.classList.replace("fa-moon", "fa-sun");
}

toggleBtn.addEventListener("click", () => {
    document.body.classList.toggle("dark");

    if (document.body.classList.contains("dark")) {
        icon.classList.replace("fa-moon", "fa-sun");
        localStorage.setItem("theme", "dark");
    } else {
        icon.classList.replace("fa-sun", "fa-moon");
        localStorage.setItem("theme", "light");
    }
});
</script> -->

    <script>
    const toggleBtn = document.getElementById("themeToggle");
    const icon = document.getElementById("themeIcon");

    toggleBtn.addEventListener("click", function() {

        document.body.classList.toggle("dark-mode");

        if (document.body.classList.contains("dark-mode")) {
            icon.src = "/motokloz-demo/assets/images/lightmood.png";
            localStorage.setItem("theme", "dark");
        } else {
            icon.src = "/motokloz-demo/assets/images/darkmood.png";
            localStorage.setItem("theme", "light");
        }

    });

    // Page load par state restore
    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark-mode");
        icon.src = "/motokloz-demo/assets/images/lightmood.png";
    }
    </script>
    <script>
    $(document).ready(function() {

        $('.tab').click(function() {
            $('.tab').removeClass('active');
            $(this).addClass('active');
        });

        $('#priceRange').on('input', function() {
            $('#priceVal').text('10,000 - 12,000');
        });

    });
    </script>

    <script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 7,
        spaceBetween: 20,
        autoplay: false,
        loop: false,
        // autoplay: {
        //     delay: 2500,
        // },
        breakpoints: {
            0: {
                slidesPerView: 2
            },
            768: {
                slidesPerView: 4
            },
            1024: {
                slidesPerView: 6
            }
        }
    });
    </script>
    <script>
    var swiper = new Swiper(".carSwiper", {
        slidesPerView: 4,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            1024: {
                slidesPerView: 4
            },
        }
    });
    </script>
    <script>
    const reviewSwiper = new Swiper(".review-swiper", {
        slidesPerView: 3,
        spaceBetween: 24,
        loop: true,
        speed: 5000,

        autoplay: {
            delay: 0,
            disableOnInteraction: false,
        },

        breakpoints: {
            0: {
                slidesPerView: 1.2
            },
            768: {
                slidesPerView: 2
            },
            1024: {
                slidesPerView: 3
            },
        }
    });

    // hover pause
    const reviewEl = document.querySelector('.review-swiper');
    reviewEl.addEventListener('mouseenter', () => reviewSwiper.autoplay.stop());
    reviewEl.addEventListener('mouseleave', () => reviewSwiper.autoplay.start());
    </script>


</body>

</html>