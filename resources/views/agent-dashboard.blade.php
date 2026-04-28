@extends('layouts.app')
@section('content')


    <div class="container account-setting my-py-80">

        @include('partials.user-account-breadcrumbs')

        <h2 class="main-head">Dashboard</h2>

        <div class="row g-4">

            <!-- Sidebar -->

            @include('partials.user-account-sidebar')


            <div class="col-lg-9">
                <div class="dashboard-content">

                    <!-- ===== My Vehicles ===== -->
                    <div class="vehicles-card dashboard-card mb-4" data-aos="fade-up" data-aos-duration="600">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 vehicle-sec">My Vehicles</h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('add.listings') }}" class="btn-add">Add a Vehicle</a>
                                <div class="dropdown">
                                    <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="/assets/images/filter.png" class="me-2 filter-icon" alt="">
                                        Filter
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item filter-item" href="#" data-sort="newest">Newest</a></li>
                                        <li><a class="dropdown-item filter-item" href="#" data-sort="oldest">Oldest</a></li>
                                        <li><a class="dropdown-item filter-item" href="#" data-sort="price_asc">Price: Low to High</a></li>
                                        <li><a class="dropdown-item filter-item" href="#" data-sort="price_desc">Price: High to Low</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table vehicle-table align-middle mb-0">
                                <thead class="agent-table">
                                    <tr>
                                        <th>ID</th>
                                        <th>Car & Type</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody class="table-content" id="vehiclesTableBody">
                                    @forelse($listings as $listing)
                                    @php $listing = (object) $listing; @endphp
                                    <tr data-id="{{ $listing->id }}" 
                                        data-price="{{ $listing->disclosed_price ?? 0 }}" 
                                        data-date="{{ $listing->created_at }}">
                                        <td class="id">#{{ $listing->id }}</td>
                                        <td>
                                            @php
                                                // Create a URL-friendly slug from the vehicle title    
                                                $vehicleName = $listing->year . ' ' . 
                                                            ($listing->mfg_auto ?? '') . ' ' . 
                                                            ($listing->model ?? '');
                                                $slug = Str::slug($vehicleName, '-');
                                                $detailUrl = route('inventory_product_details', ['name' => $slug, 'id' => $listing->id]);
                                            @endphp
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="{{ $detailUrl }}">
                                                    <img style="width: 60px; height: 50px; object-fit: cover; border-radius: 8px;" src="{{ $listing->primary_image
                                                    ? (Str::startsWith($listing->primary_image, 'http')
                                                        ? $listing->primary_image
                                                        : $disklozBaseUrl . '/admin_assets/images/inventory_images/' . $listing->primary_image)
                                                    : asset('assets/images/defaultimage.jpg') }}" alt="Vehicle Image"
                                                class="img-box img-fluid"
                                                onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultimage.jpg') }}';">
                                                </a>
                                                <div>
                                                    <div class="fw-semibold">
                                                        {{ $listing->year ?? '' }} {{ $listing->mfg_auto ?? '' }} {{ $listing->model ?? 'N/A' }}
                                                    </div>
                                                    <small class="text-muted">{{ $listing->trim ?? 'N/A' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                                @php
                                                $cleanedPrice = preg_replace('/[^0-9.]/', '', $inventory->disclosed_price ?? '0');
                                                $displayPrice = round((float) $cleanedPrice);
                                                @endphp
                                            ${{ number_format($displayPrice) }}</td>
                                        <td>{{ $listing->created_at ? \Carbon\Carbon::parse($listing->created_at)->format('d M Y') : 'N/A' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-car fa-3x text-muted mb-3"></i>
                                                <h6>No vehicles found</h6>
                                                <p class="text-muted">Click "Add a Vehicle" to create your first listing.</p>
                                                <a href="{{ route('add.listings') }}" class="btn-add">Add a Vehicle</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($listings->count() > 0)
                            <div class="pagination-container mt-0">
                                @include('partials.pagination')
                            </div>
                        @endif
                    </div>

        <style>
            .vehicle-table th, .vehicle-table td {
                padding: 15px 10px;
                vertical-align: middle;
            }
            
            .car-img {
                width: 60px;
                height: 50px;
                object-fit: cover;
                border-radius: 8px;
            }
            
            .btn-add {
                background-color: #ff9800;
                color: white;
                border: none;
                padding: 8px 20px;
                border-radius: 8px;
                text-decoration: none;
                display: inline-block;
                transition: all 0.3s ease;
            }
            
            .btn-add:hover {
                background-color:#ff9800;
                color: white;
            }
            
            .filter-btn {
                background-color: #f8f9fa;
                border: 1px solid #dee2e6;
                padding: 8px 15px;
            }
            
            .empty-state {
                text-align: center;
                padding: 50px;
            }
            
            .dropdown-item i {
                width: 20px;
            }
        </style>

        

                    <!-- ===== Bottom Cards ===== -->
                    <div class="row g-3">

                        <!-- Member Offers -->
                        <div class="col-md-5" data-aos="fade-up" data-aos-delay="0" data-aos-duration="600">
                            <div class="vehicles-card dashboard-card h-100">
                                <div class="card-header d-flex justify-content-between">
                                    <h6 class="mb-0 head-vehicles">Member Offers</h6>
                                    <div class="dropdown">
                                        <button class="btn filter-btn dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="/assets/images/filter.png" class="me-2 filter-icon" alt="">
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
                                            <img src="/assets/images/img-icon.png" alt="">
                                        </div>
                                        <div class="offer-content">
                                            <h6 class="title text-start">Reservation Confirmed</h6>
                                            <p class="text-start">Your car rental reservation #12345 has been
                                                successfully confirmed.</p>
                                        </div>
                                    </div>
                                    <small class="time  text-success">2 mins ago</small>
                                </div>

                                <!-- Item -->
                                <div class="offer-item d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="offer-icon">
                                            <img src="/assets/images/img-icon (2).png" alt="">
                                        </div>
                                        <div class="offer-content">
                                            <h6 class="title text-start">Payment Successful</h6>
                                            <p class="text-start">Payment for your upcoming rental has been processed
                                                successfully.</p>
                                        </div>
                                    </div>
                                    <small class="time  text-success">25 mins ago</small>
                                </div>

                                <!-- Item -->
                                <div class="offer-item d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="offer-icon ">
                                            <img src="/assets/images/img-icon (3).png" alt="">
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
                                            <img src="/assets/images/img-icon (4).png" alt="">
                                        </div>
                                        <div class="offer-content">
                                            <h6 class="title text-start">New Promotion Alert</h6>
                                            <p class="text-start">Enjoy 20% off on all SUV rentals booked this weekend.
                                            </p>
                                        </div>
                                    </div>
                                    <small class="time  text-success">2 hours ago</small>
                                </div>

                            </div>
                        </div>


                        <!-- Purchases -->
                        <div class=" col-md-7" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
                            <div class="vehicles-card dashboard-card h-100">
                                <div class="card-header d-flex justify-content-between">
                                    <h6 class="mb-0 head-vehicles">Purchases</h6>
                                    <div class="dropdown">
                                        <button class="btn filter-btn dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="/assets/images/filter.png" class="me-2 filter-icon" alt="">
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
                                    <img src="/assets/images/Img (4).png" class="purchase-img">
                                    <div class="flex-grow-1 text-start">
                                        <div class="fw-semibold">GMC Sierra 2500HD Denali ( Australia )</div>
                                        <small class="text-muted time border-and-gap">Date : 01 Jan 2025</small>
                                        <small class="text-muted date">Time: 06:30 AM </small>
                                    </div>
                                    <span class="text-muted small">Paid</span>
                                </div>

                                <div class="purchase-item">
                                    <img src="/assets/images/Img (5).png" class="purchase-img">
                                    <div class="flex-grow-1 text-start">
                                        <div class="fw-semibold">Ford Mustang GT Premium ( Australia ) </div>
                                        <small class="text-muted time border-and-gap">Date : 01 Jan 2025</small>
                                        <small class="text-muted date">Time: 06:30 AM </small>
                                    </div>
                                    <span class="text-muted small">Paid</span>
                                </div>

                                <div class="purchase-item">
                                    <img src="/assets/images/Img (6).png" class="purchase-img">
                                    <div class="flex-grow-1 text-start">
                                        <div class="fw-semibold">Subaru Impreza WRX STI ( Australia ) </div>
                                        <small class="text-muted time border-and-gap">Date : 01 Jan 2025</small>
                                        <small class="text-muted date">Time: 06:30 AM </small>
                                    </div>
                                    <span class="text-muted small">Paid</span>
                                </div>


                                <div class="purchase-item">
                                    <img src="/assets/images/Img (7).png" class="purchase-img">
                                    <div class="flex-grow-1 text-start">
                                        <div class="fw-semibold">Mazda MX-5 Miata Club ( Australia )</div>
                                        <small class="text-muted time border-and-gap">Date : 01 Jan 2025</small>
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
            margin-right: 0 !important;
        }

        .dropdown-toggle::after {
            margin-left: 3px;
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

        .border-and-gap {
            border-right: 1px solid #DDE1DE;
            margin-right: 10px;
            padding-right: 10px;
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
            border-bottom: 1px solid var(--border-color);
            background-color: rgb(33 37 41 / 3%);
            border-radius: 0 !important;
        }

        .table-content tr:last-child td {
            border: 0;
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
            padding: 8px 20px;
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

<script>
    // Delete listing function with snackbar
    function deleteListing(id) {
        // Show loading state on the delete button
        const deleteBtn = document.querySelector(`tr[data-id="${id}"] .delete-btn`);
        if (deleteBtn) {
            deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            deleteBtn.disabled = true;
        }
        
        fetch(`/listings/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the row from table
                const row = document.querySelector(`tr[data-id="${id}"]`);
                if (row) {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0';
                    setTimeout(() => {
                        row.remove();
                        showSnackbar('Vehicle deleted successfully!', 'success', 3000);
                        
                        // Check if table is empty, reload page after 2 seconds
                        const tbody = document.getElementById('vehiclesTableBody');
                        if (tbody && tbody.children.length === 0) {
                            setTimeout(() => location.reload(), 2000);
                        }
                    }, 300);
                } else {
                    showSnackbar('Vehicle deleted successfully!', 'success', 3000);
                    setTimeout(() => location.reload(), 1500);
                }
            } else {
                showSnackbar(data.message || 'Failed to delete vehicle', 'error', 4000);
                // Reset button
                if (deleteBtn) {
                    deleteBtn.innerHTML = '<i class="fas fa-trash"></i>';
                    deleteBtn.disabled = false;
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showSnackbar('Error deleting vehicle', 'error', 4000);
            // Reset button
            if (deleteBtn) {
                deleteBtn.innerHTML = '<i class="fas fa-trash"></i>';
                deleteBtn.disabled = false;
            }
        });
    }
    
    // Add vehicle button click
    document.querySelector('.btn-add')?.addEventListener('click', function(e) {
        if (this.getAttribute('href')) {
            // If it's a link, let it navigate
            return;
        }
        e.preventDefault();
        window.location.href = '{{ route("add.listings") }}';
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    function showSnackbar(message, type = 'success', duration = 3000) {
        let snackbar = document.getElementById('snackbar');
        if (!snackbar) {
            snackbar = document.createElement('div');
            snackbar.id = 'snackbar';
            document.body.appendChild(snackbar);
        }

        snackbar.textContent = message;
        snackbar.className = '';
        snackbar.classList.add(type, 'show');

        setTimeout(() => snackbar.classList.remove('show'), duration);
    }

    const filterItems = document.querySelectorAll('.filter-item');

    // ✅ Click on filter item
    filterItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const sort = this.dataset.sort;
            const text = this.textContent.trim();

            // Store selected sort & snackbar message in localStorage
            localStorage.setItem('snackbar', `Sorted by: ${text}`);
            localStorage.setItem('selectedSort', sort);

            // Redirect with sort param
            const url = new URL(window.location.href);
            url.searchParams.set('sort', sort);
            url.searchParams.delete('page'); // reset pagination
            window.location.href = url.toString();
        });
    });

    // ✅ Page load actions
    const snackbarMessage = localStorage.getItem('snackbar');
    const selectedSort = localStorage.getItem('selectedSort');

    if (snackbarMessage) {
        showSnackbar(snackbarMessage, 'info', 2000);
        localStorage.removeItem('snackbar');
    }

    if (selectedSort) {
        filterItems.forEach(item => {
            if (item.dataset.sort === selectedSort) {
                item.classList.add('active'); // Highlight selected
                item.textContent = item.textContent + " ✓"; // Optional: add check mark
            } else {
                item.classList.remove('active');
            }
        });
        localStorage.removeItem('selectedSort');
    }

});
</script>
@endsection