<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <?php require_once(__DIR__ . '/../include/header-script.php'); ?>


</head>

<body>
    <?php require_once(__DIR__ . '/../include/header.php'); ?>

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

                            <img src="<?php echo $prefix; ?>/assets/images/border.png" class="user-img">

                            <div class="user-info">
                                <h6 class="user-info-head">Steven Jobs</h6>
                                <small class="user-info-para">Since 2019</small>
                            </div>

                            <span class="edit-btn">
                                <img src="<?php echo $prefix; ?>/assets/images/Link (3).png" class="edit-img">
                            </span>

                        </div>
                    </div>

                    <ul class="account-menu">

                        <li class="menu-item">
                            <img src="<?php echo $prefix; ?>/assets/images/Vector (2).png" class="menu-icon icon">
                            My Profile
                        </li>

                        <li class="menu-item d-flex justify-content-between align-items-center">
                            <div>
                                <img src="<?php echo $prefix; ?>/assets/images/Icon (1).png" class="menu-icon">
                                Dashboard
                            </div>
                            <span class="badge">1</span>
                        </li>

                        <li class="menu-item">
                            <img src="<?php echo $prefix; ?>/assets/images/Icon (2).png" class="menu-icon">
                            Listings
                        </li>

                        <li class="menu-item">
                            <img src="<?php echo $prefix; ?>/assets/images/material-symbols_add-rounded.png"
                                class="menu-icon">
                            Add Listing
                        </li>

                        <li class="menu-item active">
                            <img src="<?php echo $prefix; ?>/assets/images/Icon (3).png" class="menu-icon">
                            My Wishlist
                        </li>

                        <li class="menu-item">
                            <img src="<?php echo $prefix; ?>/assets/images/Icon (4).png" class="menu-icon">
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
                                <img src="<?php echo $prefix; ?>/assets/images/Vector (13).png" alt="search" width="16"
                                    height="16">
                            </span>
                        </div>

                        <!-- Sort -->
                        <div class="dropdown">
                            <button class="filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <img src="<?php echo $prefix; ?>/assets/images/filter.png" class="me-2 filter-icon"
                                    alt="">
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
                                <img src="<?php echo $prefix; ?>/assets/images/wish-1 (1).png"
                                    class="img-fluid rounded-start wishlist-img" alt="Mini Cooper S Hardtop 2 Door">
                            </div>
                            <div class="col-md-7 cards-wish-all">
                                <div class="card-body">

                                    <div class="d-flex justify-content-between align-items-start mb-2 badge-main">

                                        <span class="discount-badge">-25%</span>
                                    </div>
                                    <div class="rating-all d-flex align-items-center gap-2">
                                        <img src="<?php echo $prefix; ?>/assets/images/Vector (12).png" alt="rating"
                                            width="16">
                                        <p class="rating-all-p mb-0">
                                            <strong>4.96</strong> (672 reviews)
                                        </p>
                                    </div>


                                    <h5 class="card-title fw-bold">Mini Cooper S Hardtop 2 Door</h5>

                                    <p class="card-text location mb-3">
                                        <img src="<?php echo $prefix; ?>/assets/images/Vector (11).png" class="icon">
                                        Manchester,
                                        England
                                    </p>

                                    <div class="features d-flex flex-wrap gap-3 mb-3">


                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon01.png" class="icon">
                                            Unlimited mileage
                                        </span>

                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon03.png" class="icon">
                                            Automatic
                                        </span>

                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon05.png" class="icon"> 3
                                            Large
                                            bags
                                        </span>

                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon02.png" class="icon">
                                            Diesel
                                        </span>

                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon04.png" class="icon"> 7
                                            seats

                                        </span>

                                        <span class="feature suv-badge">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon06.png" class="icon">
                                            SUVs
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
                                <img src="<?php echo $prefix; ?>/assets/images/wish-1 (1).png"
                                    class="img-fluid rounded-start wishlist-img" alt="Mini Cooper S Hardtop 2 Door">
                            </div>
                            <div class="col-md-7 cards-wish-all">
                                <div class="card-body">

                                    <div class="d-flex justify-content-between align-items-start mb-2 badge-main">
                                        <span class="discount-badge">-25%</span>
                                    </div>

                                    <div class="rating-all d-flex align-items-center gap-2">
                                        <img src="<?php echo $prefix; ?>/assets/images/Vector (12).png" alt="rating"
                                            width="16">
                                        <p class="rating-all-p mb-0">
                                            <strong>4.96</strong> (672 reviews)
                                        </p>
                                    </div>

                                    <h5 class="card-title fw-bold">Mini Cooper S Hardtop 2 Door</h5>

                                    <p class="card-text location mb-3">
                                        <img src="<?php echo $prefix; ?>/assets/images/Vector (11).png" class="icon">
                                        Manchester,
                                        England
                                    </p>
                                    <div class="features d-flex flex-wrap gap-3 mb-3">


                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon01.png" class="icon">
                                            Unlimited mileage
                                        </span>

                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon03.png" class="icon">
                                            Automatic
                                        </span>

                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon05.png" class="icon">
                                            Diesel
                                        </span>

                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon02.png" class="icon"> 7
                                            seats
                                        </span>

                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon04.png" class="icon"> 3
                                            Large bags
                                        </span>

                                        <span class="feature suv-badge">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon06.png" class="icon">
                                            SUVs
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
                                <img src="<?php echo $prefix; ?>/assets/images/wish-1 (1).png"
                                    class="img-fluid rounded-start wishlist-img" alt="Mini Cooper S Hardtop 2 Door">
                            </div>
                            <div class="col-md-7 cards-wish-all">
                                <div class="card-body">

                                    <div class="d-flex justify-content-between align-items-start mb-2 badge-main">
                                        <span class="discount-badge">-25%</span>
                                    </div>

                                    <div class="rating-all d-flex align-items-center gap-2">
                                        <img src="<?php echo $prefix; ?>/assets/images/Vector (12).png" alt="rating"
                                            width="16">
                                        <p class="rating-all-p mb-0">
                                            <strong>4.96</strong> (672 reviews)
                                        </p>
                                    </div>

                                    <h5 class="card-title fw-bold">Mini Cooper S Hardtop 2 Door</h5>

                                    <p class="card-text location mb-3">
                                        <img src="<?php echo $prefix; ?>/assets/images/Vector (11).png" class="icon">
                                        Manchester,
                                        England
                                    </p>

                                    <div class="features d-flex flex-wrap gap-3 mb-3">


                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon01.png" class="icon">
                                            Unlimited mileage
                                        </span>

                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon03.png" class="icon">
                                            Automatic
                                        </span>

                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon05.png" class="icon">
                                            Diesel
                                        </span>

                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon02.png" class="icon"> 7
                                            seats
                                        </span>

                                        <span class="feature">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon04.png" class="icon"> 3
                                            Large bags
                                        </span>

                                        <span class="feature suv-badge">
                                            <img src="<?php echo $prefix; ?>/assets/images/icon06.png" class="icon">
                                            SUVs
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
                            <img src="<?php echo $prefix; ?>/assets/images/vector (5).png" alt="Next"
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
                            <img src="<?php echo $prefix; ?>/assets/images/vector (6).png" alt="Next"
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
        -webkit-mask-image: url('/motokloz-demo/assets/images/badge-bg.png');
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

    <?php require_once(__DIR__ . '/../include/footer-script.php'); ?>
    <?php require_once(__DIR__ . '/../include/footer.php'); ?>


</body>

</html>