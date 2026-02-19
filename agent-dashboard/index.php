<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <?php require_once(__DIR__ . '/../include/header-script.php'); ?>
</head>

<body>
    <?php $pageTitle = 'Dashboard'; ?>
    <?php require_once(__DIR__ . '/../include/header.php'); ?>




    <div class="container account-setting my-py-80">

        <?php require_once(__DIR__ . '/../include/user-account-breadcrumbs.php'); ?>

        <h2 class="main-head">Dashboard</h2>

        <div class="row g-4">

            <!-- Sidebar -->
            <?php require_once(__DIR__ . '/../include/user-account-sidebar.php'); ?>


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
                                        <img src="<?php echo $prefix; ?>/assets/images/filter.png" class="me-2 filter-icon"
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
                                                <img src="<?php echo $prefix; ?>/assets/images/img.png" class=" car-img">
                                                <div>
                                                    <div class="fw-semibold">Infiniti QX60</div>
                                                    <small class="text-muted">Hatchback</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$2,380</td>
                                        <td>12 Jul 2025</td>
                                        <td><span class="status-button pending">
                                                <img src="<?php echo $prefix; ?>/assets/images/button-arro.png" alt="">
                                                Pending</span></td>
                                    </tr>

                                    <tr>
                                        <td class="id"># CR-1256</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="<?php echo $prefix; ?>/assets/images/img (1).png" class="car-img">
                                                <div>
                                                    <div class="fw-semibold">Toyota 86 Coupe</div>
                                                    <small class="text-muted">Sedan</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$1,400</td>
                                        <td>26 Jul 2025</td>
                                        <td><span class="status-button completed">
                                                <img src="<?php echo $prefix; ?>/assets/images/button-arro.png" alt="">
                                                Completed</span></td>
                                    </tr>

                                    <tr>
                                        <td class="id"># CR-2356</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="<?php echo $prefix; ?>/assets/images/img (2).png" class="car-img">
                                                <div>
                                                    <div class="fw-semibold">Jeep Wrangler</div>
                                                    <small class="text-muted">Coupe</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$1,810</td>
                                        <td>10 Aug 2025</td>
                                        <td><span class="status-button completed">
                                                <img src="<?php echo $prefix; ?>/assets/images/button-arro.png"
                                                    alt="">Completed</span></td>
                                    </tr>

                                    <tr>
                                        <td class="id"># CR-5414</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="<?php echo $prefix; ?>/assets/images/img (3).png" class="car-img">
                                                <div>
                                                    <div class="fw-semibold">Jaguar XK</div>
                                                    <small class="text-muted">Sedan</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$1,450</td>
                                        <td>22 Aug 2025</td>
                                        <td><span class="status-button canceled">
                                                <img src="<?php echo $prefix; ?>/assets/images/button-arro.png"
                                                    alt="">Canceled</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

<?php require_once(__DIR__ . '/../include/pagination.php'); ?>
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
                                            <img src="<?php echo $prefix; ?>/assets/images/filter.png" class="me-2 filter-icon"
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
                                            <img src="<?php echo $prefix; ?>/assets/images/img-icon.png" alt="">
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
                                            <img src="<?php echo $prefix; ?>/assets/images/img-icon (2).png" alt="">
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
                                            <img src="<?php echo $prefix; ?>/assets/images/img-icon (3).png" alt="">
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
                                            <img src="<?php echo $prefix; ?>/assets/images/img-icon (4).png" alt="">
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
                                            <img src="<?php echo $prefix; ?>/assets/images/filter.png" class="me-2 filter-icon"
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
                                    <img src="<?php echo $prefix; ?>/assets/images/img (4).png" class="purchase-img">
                                    <div class="flex-grow-1 text-start">
                                        <div class="fw-semibold">GMC Sierra 2500HD Denali ( Australia )</div>
                                        <small class="text-muted time">Date : 01 Jan 2025</small>
                                        <small class="text-muted date">Time: 06:30 AM </small>
                                    </div>
                                    <span class="text-muted small">Paid</span>
                                </div>

                                <div class="purchase-item">
                                    <img src="<?php echo $prefix; ?>/assets/images/img (5).png" class="purchase-img">
                                    <div class="flex-grow-1 text-start">
                                        <div class="fw-semibold">Ford Mustang GT Premium ( Australia ) </div>
                                        <small class="text-muted time">Date : 01 Jan 2025</small>
                                        <small class="text-muted date">Time: 06:30 AM </small>
                                    </div>
                                    <span class="text-muted small">Paid</span>
                                </div>

                                <div class="purchase-item">
                                    <img src="<?php echo $prefix; ?>/assets/images/img (6).png" class="purchase-img">
                                    <div class="flex-grow-1 text-start">
                                        <div class="fw-semibold">Subaru Impreza WRX STI ( Australia ) </div>
                                        <small class="text-muted time">Date : 01 Jan 2025</small>
                                        <small class="text-muted date">Time: 06:30 AM </small>
                                    </div>
                                    <span class="text-muted small">Paid</span>
                                </div>


                                <div class="purchase-item">
                                    <img src="<?php echo $prefix; ?>/assets/images/img (7).png" class="purchase-img">
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
            border-bottom: 1px solid var(--border-color);
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
            border: 1px solid var(--border-color);
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
            border: 1px solid var(--border-color);
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





     <?php require_once(__DIR__ . '/../include/footer-script.php'); ?>
    <?php require_once(__DIR__ . '/../include/footer.php'); ?>


</body>

</html>