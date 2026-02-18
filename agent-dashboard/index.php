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




    <div class="container account-setting my-4">

        <!-- Breadcrumb -->
        <div class="d-flex align-items-center gap-2 mb-2 text-muted small Breadcrumb">
            <span class="Breadcrumb-home">Home</span>
            <span>›</span>
            <strong class="seat-head">Dashboard</strong>
        </div>

        <h2 class="main-head">Dashboard</h2>

        <div class="row g-4">

            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="account-sidebar">

                    <div class="side-top">
                        <div class="user-box mb-4">

                            <img src="/motokloz-demo/assets/images/border.png" class=" user-img">

                            <div class="user-info">
                                <h6 class="user-info-head">Steven Jobs</h6>
                                <small class="user-info-para">Since 2019</small>
                            </div>

                            <span class="edit-btn">
                                <img src="/motokloz-demo/assets/images/link (3).png" class="edit-img">
                            </span>

                        </div>
                    </div>
                    <style>

                    </style>



                    <ul class="account-menu">

                        <li class="menu-item">
                            <img src="/motokloz-demo/assets/images/vector (2).png" class="menu-icon">
                            My Profile
                        </li>

                        <li class="menu-item d-flex justify-content-between align-items-center  active">
                            <div>
                                <img src="/motokloz-demo/assets/images/setting2 (2).png" class="menu-icon">
                                Dashboard
                            </div>
                            <span class="badge">1</span>
                        </li>

                        <li class="menu-item">
                            <img src="/motokloz-demo/assets/images/icon (2).png" class="menu-icon">
                            My Listings
                        </li>

                        <li class="menu-item">
                            <img src="/motokloz-demo/assets/images/material-symbols_add-rounded.png" class="menu-icon">
                            Add Listing
                        </li>

                        <li class="menu-item">
                            <img src="/motokloz-demo/assets/images/icon (3).png" class="menu-icon">
                            My Wishlist
                        </li>

                        <li class="menu-item">
                            <img src="/motokloz-demo/assets/images/setting2 (1).png" class="menu-icon">
                            Account Setting
                        </li>

                    </ul>

                </div>
            </div>


            <div class="col-lg-9">
                <div class="dashboard-content">

                    <!-- ===== My Vehicles ===== -->
                    <div class="vehicles-card dashboard-card  mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 vehicle-sec">My Vehicles</h5>
                            <div class="d-flex gap-2">
                                <button class=" btn-add">Add a Vehicle</button>
                                <div class="dropdown">
                                    <button class="btn filter-btn dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="/motokloz-demo/assets/images/filter.png" class="me-2 filter-icon"
                                            alt="">
                                        Filter
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Newest</a></li>
                                        <li><a class="dropdown-item" href="#">Oldest</a></li>
                                        <li><a class="dropdown-item" href="#">Reservation</a></li>
                                        <li><a class="dropdown-item" href="#">Payment</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table vehicle-table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Car & Type</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="id"># CR-5236</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="/motokloz-demo/assets/images/img.png" class=" car-img">
                                                <div>
                                                    <div class="fw-semibold">Infiniti QX60</div>
                                                    <small class="text-muted">Hatchback</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$2,380</td>
                                        <td>12 Jul 2025</td>
                                        <td><span class="status-button pending">
                                                <img src="/motokloz-demo/assets/images/button-arro.png" alt="">
                                                Pending</span></td>
                                    </tr>

                                    <tr>
                                        <td class="id"># CR-1256</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="/motokloz-demo/assets/images/img (1).png" class="car-img">
                                                <div>
                                                    <div class="fw-semibold">Toyota 86 Coupe</div>
                                                    <small class="text-muted">Sedan</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$1,400</td>
                                        <td>26 Jul 2025</td>
                                        <td><span class="status-button completed">
                                                <img src="/motokloz-demo/assets/images/button-arro.png" alt="">
                                                Completed</span></td>
                                    </tr>

                                    <tr>
                                        <td class="id"># CR-2356</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="/motokloz-demo/assets/images/img (2).png" class="car-img">
                                                <div>
                                                    <div class="fw-semibold">Jeep Wrangler</div>
                                                    <small class="text-muted">Coupe</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$1,810</td>
                                        <td>10 Aug 2025</td>
                                        <td><span class="status-button completed">
                                                <img src="/motokloz-demo/assets/images/button-arro.png"
                                                    alt="">Completed</span></td>
                                    </tr>

                                    <tr>
                                        <td class="id"># CR-5414</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="/motokloz-demo/assets/images/img (3).png" class="car-img">
                                                <div>
                                                    <div class="fw-semibold">Jaguar XK</div>
                                                    <small class="text-muted">Sedan</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$1,450</td>
                                        <td>22 Aug 2025</td>
                                        <td><span class="status-button canceled">
                                                <img src="/motokloz-demo/assets/images/button-arro.png"
                                                    alt="">Canceled</span></td>
                                    </tr>
                                </tbody>
                            </table>
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

                    <!-- ===== Bottom Cards ===== -->
                    <div class="row g-3">

                        <!-- Member Offers -->
                        <div class="col-md-5">
                            <div class="vehicles-card dashboard-card h-100">
                                <div class="card-header d-flex justify-content-between">
                                    <h6 class="mb-0 head-vehicles">Member Offers</h6>
                                    <div class="dropdown">
                                        <button class="btn filter-btn dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="/motokloz-demo/assets/images/filter.png" class="me-2 filter-icon"
                                                alt="">
                                            All
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Newest</a></li>
                                            <li><a class="dropdown-item" href="#">Oldest</a></li>
                                            <li><a class="dropdown-item" href="#">Reservation</a></li>
                                            <li><a class="dropdown-item" href="#">Payment</a></li>
                                        </ul>
                                    </div>

                                </div>

                                <!-- Item -->
                                <div class="offer-item d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="offer-icon">
                                            <img src="/motokloz-demo/assets/images/img-icon.png" alt="">
                                        </div>
                                        <div class="offer-content">
                                            <h6 class="title text-start">Reservation Confirmed</h6>
                                            <p class="text-start">Your car rental reservation #12345 has been
                                                successfully confirmed.</p>
                                        </div>
                                    </div>
                                    <small class="time text-success">2 mins ago</small>
                                </div>

                                <!-- Item -->
                                <div class="offer-item d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="offer-icon">
                                            <img src="/motokloz-demo/assets/images/img-icon (2).png" alt="">
                                        </div>
                                        <div class="offer-content">
                                            <h6 class="title text-start">Payment Successful</h6>
                                            <p class="text-start">Payment for your upcoming rental has been processed
                                                successfully.</p>
                                        </div>
                                    </div>
                                    <small class="time text-success">25 mins ago</small>
                                </div>

                                <!-- Item -->
                                <div class="offer-item d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="offer-icon ">
                                            <img src="/motokloz-demo/assets/images/img-icon (3).png" alt="">
                                        </div>
                                        <div class="offer-content">
                                            <h6 class="title text-start">New Promotion Alert</h6>
                                            <p class="text-start">Enjoy 20% off on all SUV rentals booked this weekend.
                                            </p>
                                        </div>
                                    </div>
                                    <small class="time text-success">2 hours ago</small>
                                </div>

                                <div class="offer-item d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="offer-icon ">
                                            <img src="/motokloz-demo/assets/images/img-icon (4).png" alt="">
                                        </div>
                                        <div class="offer-content">
                                            <h6 class="title text-start">New Promotion Alert</h6>
                                            <p class="text-start">Enjoy 20% off on all SUV rentals booked this weekend.
                                            </p>
                                        </div>
                                    </div>
                                    <small class="time text-success">2 hours ago</small>
                                </div>

                            </div>
                        </div>


                        <!-- Purchases -->
                        <div class=" col-md-7">
                            <div class="vehicles-card dashboard-card h-100">
                                <div class="card-header d-flex justify-content-between">
                                    <h6 class="mb-0 head-vehicles">Purchases</h6>
                                    <div class="dropdown">
                                        <button class="btn filter-btn dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="/motokloz-demo/assets/images/filter.png" class="me-2 filter-icon"
                                                alt="">
                                            Filter
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Newest</a></li>
                                            <li><a class="dropdown-item" href="#">Oldest</a></li>
                                            <li><a class="dropdown-item" href="#">Reservation</a></li>
                                            <li><a class="dropdown-item" href="#">Payment</a></li>
                                        </ul>
                                    </div>

                                </div>

                                <div class="purchase-item">
                                    <img src="/motokloz-demo/assets/images/img (4).png" class="purchase-img">
                                    <div class="flex-grow-1 text-start">
                                        <div class="fw-semibold">GMC Sierra 2500HD Denali ( Australia )</div>
                                        <small class="text-muted time">Date : 01 Jan 2025</small>
                                        <small class="text-muted date">Time: 06:30 AM </small>
                                    </div>
                                    <span class="text-muted small">Paid</span>
                                </div>

                                <div class="purchase-item">
                                    <img src="/motokloz-demo/assets/images/img (5).png" class="purchase-img">
                                    <div class="flex-grow-1 text-start">
                                        <div class="fw-semibold">Ford Mustang GT Premium ( Australia ) </div>
                                        <small class="text-muted time">Date : 01 Jan 2025</small>
                                        <small class="text-muted date">Time: 06:30 AM </small>
                                    </div>
                                    <span class="text-muted small">Paid</span>
                                </div>

                                <div class="purchase-item">
                                    <img src="/motokloz-demo/assets/images/img (6).png" class="purchase-img">
                                    <div class="flex-grow-1 text-start">
                                        <div class="fw-semibold">Subaru Impreza WRX STI ( Australia ) </div>
                                        <small class="text-muted time">Date : 01 Jan 2025</small>
                                        <small class="text-muted date">Time: 06:30 AM </small>
                                    </div>
                                    <span class="text-muted small">Paid</span>
                                </div>


                                <div class="purchase-item">
                                    <img src="/motokloz-demo/assets/images/img (7).png" class="purchase-img">
                                    <div class="flex-grow-1 text-start">
                                        <div class="fw-semibold">Mazda MX-5 Miata Club ( Australia )</div>
                                        <small class="text-muted time">Date : 01 Jan 2025</small>
                                        <small class="text-muted date">Time: 06:30 AM </small>
                                    </div>
                                    <span class="text-muted small">Paid</span>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>





    <style>
    .offer-item {
        padding: 15px 0;

    }

    .offer-item:last-child {
        border-bottom: none;
    }

    .offer-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
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

    .filter-btn:hover {
        background: #e5e7eb;
    }

    .filter-icon {
        width: 14px;
        height: 14px;
        object-fit: contain;
    }

    .dropdown-toggle::after {
        margin-left: 10px;
        vertical-align: middle;
    }


    .offer-icon img {
        width: 20px;
    }

    .offer-content .title {
        font-weight: 600;
        margin-bottom: 3px;
    }

    .offer-content {
        color: var(--select-color);
    }

    .offer-content p {
        margin: 0;
        font-size: 14px;
        color: #666;
    }

    .time {
        font-size: 14px;
        white-space: nowrap;
    }

    .time-vehicles {
        font-weight: 500;
        font-size: 14px;
        line-height: 24px;
        color: #235922 ! IMPORTANT;
    }

    .sub-head-vehicles {
        font-weight: 600 !important;
        font-size: 16px;
        line-height: 26px;
        color: #212529;
    }

    .head-vehicles {

        font-size: 20px;
        line-height: 26px;
        font-weight: 700;
        color: #101010;
    }

    span.status-button.pending {
        background: #FFC700;
    }

    .table-responsive {
        padding: 20px;

    }

    .card-header {
        /* background: var(--bg-color); */
        border-bottom: 1px solid #E4E6E8;
        padding: 14px 16px;
    }

    thead {
        background: #F8FAFB !important;
    }

    thead th {
        background: #E4E6E8 !important;
    }

    table tbody tr:nth-child(2n +1) td {
        background: #E7EDF2 !important;
    }

    .status-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 18px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 500;
        color: #fff;
    }

    .status-button img {
        width: 7px;
        height: 7px;
        object-fit: contain;
    }


    span.status-button.completed {
        background: #34D674;
    }

    span.status-button.canceled {
        background: #FC7272;
    }

    .vehicle-sec {
        color: var(--select-color);
        font-size: 20px;
        line-height: 26px;
        font-weight: 700;
    }

    .head-vehicles {
        color: var(--select-color);
    }

    td.id {
        color: #3ADA37 !important;
    }

    small.text-muted {
        font-weight: 400;
        font-size: 14px;
        line-height: 24px;
        color: #737373 !important;
    }

    .status-button {
        display: inline-block;
        font-size: 12px;
        padding: 8px 16px;
        border-radius: 800px;
        line-height: 11px;
        color: #ffff;
        margin-bottom: 8px;
    }



    .vehicles-card {
        background: var(--bg-color);
        border-radius: 14px;
        text-align: center;

    }

    .dashboard-card {
        border-radius: 6px;
        border: 1px solid #E4E6E8;
        background: var(--bg-color);
    }

    .btn-add {
        background: #ff8a00;
        color: #fff;
        border-radius: 20px;
        padding: 6px 14px;
        border: none;
        font-size: 13px;
    }

    .vehicle-table th {
        font-size: 14px;
        color: #111827;
        font-weight: 600;
        line-height: 24px;
    }

    .vehicle-table td {
        vertical-align: middle;
        font-size: 14px;
        font-weight: 500;
        line-height: 24px;
        color: #101010;
    }

    .car-img {
        width: 60px;
        height: 40px;
        object-fit: cover;
        border-radius: 6px;
    }

    .id {
        color: #28a745;
        font-weight: 600;
    }

    .badge {
        font-size: 11px;
        padding: 6px 10px;
        border-radius: 20px;
    }

    .badge-pending {
        background: #fff3cd;
        color: #b78103;
    }

    .badge-success {
        background: #d4edda;
        color: #1e7e34;
    }

    .badge-danger {
        background: #f8d7da;
        color: #b02a37;
    }

    .offer-item {
        display: flex;
        gap: 12px;
        padding: 12px 16px;

    }

    .offer-icon {

        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .offer-icon img {
        width: 42px;
        height: 42px;
        object-fit: cover;
    }


    .purchase-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        margin: 10px;
        border: 1px solid #E7EDF2;
        color: var(--select-color);
        border-radius: 6px;
    }

    .purchase-img {
        width: 70px;
        height: 50px;
        object-fit: cover;
        border-radius: 6px;
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
        display: flex !important;
        align-items: center !important;
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
        color: black;
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


    .account-content h5 {
        font-size: 16px;
    }

    h2.fw-bold.mb-4 {
        font-weight: 700;
        line-height: 58px;
        font-size: 44px;
        color: #000000;
    }

    label {
        font-size: 14px;
        line-height: 24px;
        font-weight: 700;
        color: var(--select-color);
    }





    .form-switch {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-switch .form-check-input {
        cursor: pointer;
        accent-color: #3ad65c;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .account-sidebar {
            margin-bottom: 20px;
        }
    }
    </style>

    <style>
    /* ========== BASE ========== */
    .account-setting {
        font-family: "Vend Sans", sans-serif;
        color: #222;
    }

    /* Headings */
    .main-head {
        font-weight: 700;
        font-size: 42px;
        line-height: 54px;
        color: var(--select-color);
        padding: 10px 0;
    }

    /* Breadcrumb */
    .Breadcrumb {
        border: 1px solid #DDE1DE;
        border-radius: 12px;
        padding: 8px 14px;
        width: fit-content;
    }

    /* Cards */
    .dashboard-card {
        border-radius: 10px;
        border: 1px solid #E4E6E8;
        background: var(--bg-color);
    }

    .vehicles-card {
        border-radius: 14px;
    }

    /* Table */
    .table-responsive {
        padding: 20px;
    }

    .vehicle-table th {
        font-size: 14px;
        font-weight: 600;
    }

    .vehicle-table td {
        font-size: 14px;
        font-weight: 500;
    }

    /* Sidebar */
    .account-sidebar {
        border: 1px solid #eaeaea;
        border-radius: 14px;
        background: var(--bg-color);
    }

    .side-top {
        padding: 16px;
        background: #21252908;
        border-bottom: 1px solid #E4E6E8;
    }

    .user-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    /* Buttons */
    .btn-add {
        background: #ff8a00;
        color: #fff;
        border-radius: 20px;
        padding: 7px 16px;
        border: none;
        font-size: 13px;
    }

    .filter-btn {
        background: #f3f4f6;
        border: none;
        padding: 8px 18px;
        font-size: 14px;
        border-radius: 50px;
    }

    /* Status */
    .status-button {
        font-size: 12px;
        padding: 7px 14px;
        border-radius: 50px;
        color: #fff;
    }

    /* Pagination */
    .page-square {
        width: 42px;
        height: 42px;
        border-radius: 6px;
        display: flex;
        background: #F2F4F6;
        align-items: center;
        justify-content: center;
    }

    /* Purchase item */
    .purchase-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        border: 1px solid #E7EDF2;
        border-radius: 6px;
    }

    /* Offer */
    .offer-item {
        display: flex;
        gap: 12px;
        padding: 12px 16px;
    }

    /* ========================= */
    /* ====== TABLET (≤991px) === */
    /* ========================= */

    @media (max-width: 991px) {

        .main-head {
            font-size: 34px;
            line-height: 46px;
        }

        .account-sidebar {
            margin-bottom: 20px;
        }

        .vehicle-table th,
        .vehicle-table td {
            font-size: 13px;
        }

        .btn-add {
            padding: 6px 14px;
            font-size: 12px;
        }

    }

    /* ========================= */
    /* ===== MOBILE (≤768px) ==== */
    /* ========================= */

    @media (max-width: 768px) {

        .main-head {
            font-size: 28px;
            line-height: 38px;
        }

        .Breadcrumb {
            font-size: 13px;
            padding: 6px 10px;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 10px;
        }

        .btn-add {
            width: 100%;
            text-align: center;
        }

        .filter-btn {
            width: 100%;
            justify-content: center;
        }

        .table-responsive {
            padding: 10px;
        }

        .vehicle-table th,
        .vehicle-table td {
            font-size: 12px;
            white-space: nowrap;
        }

        .car-img {
            width: 48px;
            height: 34px;
        }

        .purchase-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 6px;
        }

        .purchase-img {
            width: 100%;
            height: auto;
            object-fit: cover;

        }

        .offer-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .time {
            font-size: 12px;
        }

        .pagination {
            flex-wrap: wrap;
            gap: 6px;
        }

    }

    /* ========================= */
    /* ===== SMALL MOBILE ====== */
    /* ========================= */

    @media (max-width: 480px) {

        .main-head {
            font-size: 24px;
            line-height: 32px;
        }

        .vehicle-sec,
        .head-vehicles {
            font-size: 16px;
        }

        .status-button {
            font-size: 11px;
            padding: 6px 12px;
        }

        .user-info-head {
            font-size: 16px !important;
        }

        .user-info-para {
            font-size: 12px !important;
        }

    }

    /* ===== Pagination Responsive ===== */

    @media (max-width: 768px) {

        .pagination {
            justify-content: center !important;
            /* center on mobile */
            gap: 6px !important;
            padding: 6px 10px;
        }

        .page-square {
            width: 34px;
            height: 34px;
            font-size: 13px;
        }

    }

    @media (max-width: 480px) {

        .pagination {
            gap: 4px !important;
        }

        .page-square {
            width: 30px;
            height: 30px;
            font-size: 12px;
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
                            <li><i class="fa-sharp fa-solid fa-location-dot"></i><a href="#">2356 Oakwood
                                    Drive,
                                    Suite
                                    18, San Francisco, California 94111, US</a></li>
                            <li><i class="fa-sharp fa-solid fa-clock"></i><a href="#">Hours: 8:00 - 17:00,
                                    Mon -
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