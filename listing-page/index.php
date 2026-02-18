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



    <div class="container listing-page my-4">

        <!-- Breadcrumb -->
        <div class="d-flex align-items-center gap-2 mb-2 text-muted small Breadcrumb">
            <span class="Breadcrumb-home">Home</span>
            <span>›</span>
            <strong class="seat-head">My Wishlist</strong>
        </div>

        <h2 class="main-head">My Wishlist</h2>

        <div class="row g-4">

            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="account-sidebar">

                    <div class="side-top">
                        <div class="user-box mb-4">

                            <img src="/motokloz-demo/assets/images/border.png" class="user-img">

                            <div class="user-info">
                                <h6 class="user-info-head">Steven Jobs</h6>
                                <small class="user-info-para">Since 2019</small>
                            </div>

                            <span class="edit-btn">
                                <img src="/motokloz-demo/assets/images/Link (3).png" class="edit-img">
                            </span>

                        </div>
                    </div>

                    <ul class="account-menu">

                        <li class="menu-item">
                            <img src="/motokloz-demo/assets/images/Vector (2).png" class="menu-icon icon">
                            My Profile
                        </li>

                        <li class="menu-item d-flex justify-content-between align-items-center">
                            <div>
                                <img src="/motokloz-demo/assets/images/Icon (1).png" class="menu-icon">
                                Dashboard
                            </div>
                            <span class="badge">1</span>
                        </li>

                        <li class="menu-item">
                            <img src="/motokloz-demo/assets/images/Icon (2).png" class="menu-icon">
                            Listings
                        </li>

                        <li class="menu-item">
                            <img src="/motokloz-demo/assets/images/material-symbols_add-rounded.png" class="menu-icon">
                            Add Listing
                        </li>

                        <li class="menu-item active">
                            <img src="/motokloz-demo/assets/images/Icon (3).png" class="menu-icon">
                            My Wishlist
                        </li>

                        <li class="menu-item">
                            <img src="/motokloz-demo/assets/images/Icon (4).png" class="menu-icon">
                            Account Setting
                        </li>

                    </ul>

                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9 wishlist-sec">

                <!-- Wishlist Header Bar -->
                <div class="wishlist-header d-flex justify-content-between align-items-center px-3 px-md-4 py-3 mb-4">

                    <h5 class=" search-head">My Wishlist</h5>

                    <div class="d-flex align-items-center gap-2 header-actions">

                        <!-- Search -->
                        <div class="position-relative searchbar">
                            <input type="text" class="form-control rounded-pill ps-5 pe-3 w-100" placeholder="Search">

                            <span class="position-absolute top-50 start-0 translate-middle-y ps-3">
                                <img src="/motokloz-demo/assets/images/Vector (13).png" alt="search" width="16"
                                    height="16">
                            </span>
                        </div>

                        <!-- Sort -->
                        <div class="dropdown">
                            <button class="filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <img src="/motokloz-demo/assets/images/filter.png" class="me-2 filter-icon" alt="">
                                Sort
                            </button>
                        </div>

                    </div>

                </div>

                <!-- Wishlist Items -->
                <div class="wishlist-items">

                    <!-- Item 1 -->
                    <div class=" wishlist-card mb-4">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="/motokloz-demo/assets/images/wish-1 (1).png"
                                    class="img-fluid rounded-start wishlist-img" alt="Mini Cooper S Hardtop 2 Door">
                            </div>
                            <div class="col-md-7 cards-wish-all">
                                <div class="card-body">

                                    <div class="d-flex justify-content-between align-items-start mb-2 badge-main">

                                        <span class="discount-badge">-25%</span>
                                    </div>
                                    <div class="rating-all d-flex align-items-center gap-2">
                                        <img src="/motokloz-demo/assets/images/Vector (12).png" alt="rating" width="16">
                                        <p class="rating-all-p mb-0">
                                            <strong>4.96</strong> (672 reviews)
                                        </p>
                                    </div>


                                    <h5 class="card-title fw-bold">Mini Cooper S Hardtop 2 Door</h5>

                                    <p class="card-text location mb-3">
                                        <img src="/motokloz-demo/assets/images/Vector (11).png" class="icon">
                                        Manchester,
                                        England
                                    </p>

                                    <div class="features d-flex flex-wrap gap-3 mb-3">


                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon01.png" class="icon">
                                            Unlimited mileage
                                        </span>

                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon03.png" class="icon">
                                            Automatic
                                        </span>

                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon05.png" class="icon"> 3 Large
                                            bags
                                        </span>

                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon02.png" class="icon">
                                            Diesel
                                        </span>

                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon04.png" class="icon"> 7 seats

                                        </span>

                                        <span class="feature suv-badge">
                                            <img src="/motokloz-demo/assets/images/icon06.png" class="icon"> SUVs
                                        </span>


                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="price-wrap">
                                            <span class="text-span">From</span>
                                            <span class="price-span">$202.87</span>
                                            <span class="text-span">/ USD</span>
                                        </div>
                                        <button class=" book-btn">Book Now</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Item 1 -->
                    <div class=" wishlist-card mb-4">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="/motokloz-demo/assets/images/wish-1 (1).png"
                                    class="img-fluid rounded-start wishlist-img" alt="Mini Cooper S Hardtop 2 Door">
                            </div>
                            <div class="col-md-7 cards-wish-all">
                                <div class="card-body">

                                    <div class="d-flex justify-content-between align-items-start mb-2 badge-main">
                                        <span class="discount-badge">-25%</span>
                                    </div>

                                    <div class="rating-all d-flex align-items-center gap-2">
                                        <img src="/motokloz-demo/assets/images/Vector (12).png" alt="rating" width="16">
                                        <p class="rating-all-p mb-0">
                                            <strong>4.96</strong> (672 reviews)
                                        </p>
                                    </div>

                                    <h5 class="card-title fw-bold">Mini Cooper S Hardtop 2 Door</h5>

                                    <p class="card-text location mb-3">
                                        <img src="/motokloz-demo/assets/images/Vector (11).png" class="icon">
                                        Manchester,
                                        England
                                    </p>
                                    <div class="features d-flex flex-wrap gap-3 mb-3">


                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon01.png" class="icon">
                                            Unlimited mileage
                                        </span>

                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon03.png" class="icon">
                                            Automatic
                                        </span>

                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon05.png" class="icon"> Diesel
                                        </span>

                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon02.png" class="icon"> 7
                                            seats
                                        </span>

                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon04.png" class="icon"> 3
                                            Large bags
                                        </span>

                                        <span class="feature suv-badge">
                                            <img src="/motokloz-demo/assets/images/icon06.png" class="icon"> SUVs
                                        </span>


                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="price-wrap">
                                            <span class="text-span">From</span>
                                            <span class="price-span">$202.87</span>
                                            <span class="text-span">/ USD</span>
                                        </div>
                                        <button class=" book-btn">Book Now</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Item 1 -->
                    <div class=" wishlist-card mb-4">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="/motokloz-demo/assets/images/wish-1 (1).png"
                                    class="img-fluid rounded-start wishlist-img" alt="Mini Cooper S Hardtop 2 Door">
                            </div>
                            <div class="col-md-7 cards-wish-all">
                                <div class="card-body">

                                    <div class="d-flex justify-content-between align-items-start mb-2 badge-main">
                                        <span class="discount-badge">-25%</span>
                                    </div>

                                    <div class="rating-all d-flex align-items-center gap-2">
                                        <img src="/motokloz-demo/assets/images/Vector (12).png" alt="rating" width="16">
                                        <p class="rating-all-p mb-0">
                                            <strong>4.96</strong> (672 reviews)
                                        </p>
                                    </div>

                                    <h5 class="card-title fw-bold">Mini Cooper S Hardtop 2 Door</h5>

                                    <p class="card-text location mb-3">
                                        <img src="/motokloz-demo/assets/images/Vector (11).png" class="icon">
                                        Manchester,
                                        England
                                    </p>

                                    <div class="features d-flex flex-wrap gap-3 mb-3">


                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon01.png" class="icon">
                                            Unlimited mileage
                                        </span>

                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon03.png" class="icon">
                                            Automatic
                                        </span>

                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon05.png" class="icon"> Diesel
                                        </span>

                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon02.png" class="icon"> 7
                                            seats
                                        </span>

                                        <span class="feature">
                                            <img src="/motokloz-demo/assets/images/icon04.png" class="icon"> 3
                                            Large bags
                                        </span>

                                        <span class="feature suv-badge">
                                            <img src="/motokloz-demo/assets/images/icon06.png" class="icon"> SUVs
                                        </span>


                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="price-wrap">
                                            <span class="text-span">From</span>
                                            <span class="price-span">$202.87</span>
                                            <span class="text-span">/ USD</span>
                                        </div>

                                        <button class=" book-btn">Book Now</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <ul class="pagination justify-content-start align-items-center gap-2">

                    <!-- Prev -->
                    <li class="page-item">
                        <a class="page-link page-square" href="#">
                            <img src="/motokloz-demo/assets/images/vector (5).png" alt="Next"
                                style="width:20px; height:20px; object-fit: scale-down;">
                        </a>
                    </li>

                    <!-- Pages -->
                    <li class="page-item"><a class="page-link page-square" href="#">1</a></li>

                    <li class="page-item active">
                        <a class="page-link page-square" href="#">2</a>
                    </li>

                    <li class="page-item"><a class="page-link page-square" href="#">3</a></li>
                    <li class="page-item"><a class="page-link page-square" href="#">4</a></li>
                    <li class="page-item"><a class="page-link page-square" href="#">5</a></li>

                    <!-- Dots -->
                    <li class="page-item">
                        <span class="page-link page-square dots">…</span>
                    </li>

                    <!-- Next -->
                    <li class="page-item">
                        <a class="page-link page-square" href="#">
                            <img src="/motokloz-demo/assets/images/vector (6).png" alt="Next"
                                style="width:20px; height:20px; object-fit: scale-down;">
                        </a>

                    </li>

                </ul>


            </div>

        </div>
    </div>

    <style>
    .page-item.active .page-link {
        background: #ff9800;
        color: #fff;
        border-color: unset !important;
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

    .pagination {
        padding: 8px 25px;
    }

    .price-wrap {
        display: flex;
        align-items: baseline;
        gap: 6px;
    }

    .price-span {
        font-size: 24px;
        line-height: 32px;
        color: #101010 !important;
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
        color: #737373;
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
        background: #FFFFFF;
        box-shadow: 0 2px 7px #00000012;
    }

    .cards-wish-all {
        height: auto;
        flex: 1 !important;
        background: #ffffff;
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
        -webkit-mask-image: url(/motokloz-demo/assets/images/badge-bg.png);
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
        color: #555;
    }

    .discount-badge {
        background: #000;
        color: #fff;
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 4px;
    }

    .location {
        color: #666;
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
        border: 1px solid #E4E6E8;
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

        border: 1px solid #E4E6E8
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
        border: 1px solid #DDE1DE;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        margin: 25px 20px;
        position: relative;
    }


    .wishlist-img {
        height: 360px !important;
        width: 100% !important;
        object-fit: cover;
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
        color: #101010;
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

    .suv-badge {

        padding: 2px 8px;
        border-radius: 12px;
        font-size: 13px;
        color: #333;
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