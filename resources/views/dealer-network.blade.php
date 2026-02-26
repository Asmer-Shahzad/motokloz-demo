@extends('layouts.app')

@section('content')

    <!-- DEALER BANNER -->
    <section class="dealer-network-section p-3">

        <div class="dealer-banner">
            <div class="banner-overlay"></div>
            <div class="container">
                <div class="banner-content text-white">
                    <h2 class="fw-bold mb-0">Dealer Network</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- DEALER SEARCH & CARDS -->
    <section class="dealer-search py-4">
        <div class="container">
            <!-- SEARCH BAR -->
            <div class="dealer-search-wrap">
                <form>
                    <div class="dealer-search-inner">
                        <div class="deal-sec">
                            <div class="search-field">
                                <input type="text" placeholder="Enter Dealer Name" aria-label="Dealer Name">
                            </div>
                            <div class="divider"></div>
                            <div class="search-field">
                                <input type="text" placeholder="Enter Postal Code" aria-label="Postal Code">
                            </div>
                        </div>

                        <button class="btn-search" type="submit">
                            <img src="/assets/images/Vector (4).png" alt="Search icon">
                            Find a Vehicle
                        </button>

                        <button class="btn-dealer" type="button">
                            Become a Dealer
                            <img src="/assets/images/Vector (3).png" alt="Dealer icon">
                        </button>
                    </div>
                </form>
            </div>
            <!-- DEALER CARDS (FIXED BOOTSTRAP GRID) -->
            <div class="row g-3">
                <!-- card 1 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493.png" class="dealer-avatar" alt="">
                            <div>
                                <h6 class="dealer-card-head">Opel Manchester</h6>
                                <p class="dealer-address mb-2">
                                    123 Kingsway StranddRt, Manchester, M19 2XS
                                </p>
                                <span class="vehicle-badge">180 Vehicles</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card 2 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493 (1).png" class="dealer-avatar" alt="">
                            <div>
                                <h6 class="dealer-card-head">BMW Birmingham</h6>
                                <p class="dealer-address mb-2">
                                    45 SouthRd Road, Birmingham, B91 2DA
                                </p>
                                <span class="vehicle-badge">180 Vehicles</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card 3 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493 (2).png" class="dealer-avatar" alt="">
                            <div>
                                <h6 class="dealer-card-head">Toyota London</h6>
                                <p class="dealer-address mb-2">
                                    78 High Street Roadman, London, E1 6RL
                                </p>
                                <span class="vehicle-badge">180 Vehicles</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card 4 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493 (3).png" class="dealer-avatar" alt="">
                            <div>
                                <h6 class="dealer-card-head">Ford Glasgow</h6>
                                <p class="dealer-address mb-2">
                                    15 Buchanan Street, Glasgow, G1 3HL
                                </p>
                                <span class="vehicle-badge">180 Vehicles</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card 5 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493 (4).png" class="dealer-avatar" alt="">
                            <div>
                                <h6 class="dealer-card-head">Volkswagen Leeds</h6>
                                <p class="dealer-address mb-2">
                                    230 block 90 Kirkstall Road, Leeds, LS3 1HS
                                </p>
                                <span class="vehicle-badge">180 Vehicles</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card 6 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493 (5).png" class="dealer-avatar" alt="">
                            <div>
                                <h6 class="dealer-card-head">Honda Edinburgh</h6>
                                <p class="dealer-address mb-2">
                                    62 Princes Street, Edinburgh, EH2 4AD
                                </p>
                                <span class="vehicle-badge">180 Vehicles</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card 7 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493 (6).png" class="dealer-avatar" alt="">
                            <div>
                                <h6 class="dealer-card-head">Nissan Bristol</h6>
                                <p class="dealer-address mb-2">
                                    11 Clifton Down Road, Bristol, BS8 4AB
                                </p>
                                <span class="vehicle-badge">180 Vehicles</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card 8 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493 (7).png" class="dealer-avatar" alt="">
                            <div>
                                <h6 class="dealer-card-head">Kia Liverpool</h6>
                                <p class="dealer-address mb-2">
                                    29 Hope Street, Liverpool, L1 9BX
                                </p>
                                <span class="vehicle-badge">180 Vehicles</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card 9 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493 (8).png" class="dealer-avatar" alt="">
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
                <!-- card 10 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493 (9).png" class="dealer-avatar" alt="">
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
                <!-- card 11 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493 (10).png" class="dealer-avatar" alt="">
                            <div>
                                <h6 class="dealer-card-head">Mazda Southampton</h6>
                                <p class="dealer-address mb-2">
                                    123 Kingsway Strandeif, Manchester, M19 2XS
                                </p>
                                <span class="vehicle-badge">180 Vehicles</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card 12 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493 (11).png" class="dealer-avatar" alt="">
                            <div>
                                <h6 class="dealer-card-head">Land Rover Norwich</h6>
                                <p class="dealer-address mb-2">
                                    45 Solihull Road, Birmingham, B91 2DA
                                </p>
                                <span class="vehicle-badge">180 Vehicles</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card 13 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493 (12).png" class="dealer-avatar" alt="">
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
                <!-- card 14 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493 (13).png" class="dealer-avatar" alt="">
                            <div>
                                <h6 class="dealer-card-head">BMW Manchester</h6>
                                <p class="dealer-address mb-2">
                                    11 Clifton Down Road, Bristol, BS8 4AB
                                </p>
                                <span class="vehicle-badge">180 Vehicles</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card 15 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="dealer-card">
                        <div class="d-flex align-items-start gap-3">
                            <img src="/assets/images/Ellipse 6493 (14).png" class="dealer-avatar" alt="">
                            <div>
                                <h6 class="dealer-card-head">Ford Manchester</h6>
                                <p class="dealer-address mb-2">
                                    123 Kingsway Strandeif, Manchester, M19 2XS
                                </p>
                                <span class="vehicle-badge">180 Vehicles</span>
                            </div>
                        </div>
                    </div>
                </div>
                @include('partials.pagination')

            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>

    <!-- MISSION SECTION -->
    <section class="mission-section py-5">
        <div class="container">
            <div class="row align-items-center g-4">
                <!-- LEFT CONTENT -->
                <div class="col-lg-6">
                    <button class="btn-dealer">Our Mission</button>
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
                    <button class="btn btn-dealer mt-2">
                        Get Started Now
                        <img src="/assets/images/Vector (3).png" alt="">
                    </button>
                </div>

                <!-- RIGHT IMAGES (responsive grid) -->
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6">
                            <img src="/assets/images/Carento (1).png" class="mission-img" alt="">
                        </div>
                        <div class="col-6">
                            <img src="/assets/images/Carento (2).png" class="mission-img" alt="">
                        </div>
                        <div class="col-5">
                            <img src="/assets/images/Carento (3).png" class="mission-img" alt="">
                        </div>
                        <div class="col-7">
                            <img src="/assets/images/Carento (4).png" class="mission-img" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <style>
        .dealer-search-wrap {
            padding: 0 0 20px;
            max-width: 100%;
            overflow-x: hidden;
            /* prevent any accidental horizontal scroll */
        }

        .dealer-search-inner {
            background: var(--banner-bg-color);
            border: 1px solid #DDE1DE;
            border-radius: 18px;
            padding: 12px 14px;
            display: flex;
            flex-wrap: wrap;
            /* ← very important */
            gap: 12px;
            align-items: center;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        }

        .deal-sec {
            display: flex;
            align-items: center;
            flex: 1 1 100%;
            /* take full width on small screens */
            min-width: 0;
            /* allows shrinking below content size */
            gap: 12px;
        }

        .search-field {
            flex: 1;
            min-width: 120px;
            /* reasonable minimum */
        }

        .search-field input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
            color: var(--select-color);
            background: transparent;
            padding: 8px;
        }

        .divider {
            width: 1px;
            height: 28px;
            background: #e5e7eb;
            flex-shrink: 0;
        }

        .btn-search,
        .btn-dealer {
            background: #F58D02;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 999px;
            font-weight: 500;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            cursor: pointer;
            transition: background 0.2s;
            flex-shrink: 0;
        }

        .btn-search:hover,
        .btn-dealer:hover {
            background: #e67f00;
        }

        .btn-search img,
        .btn-dealer img {
            width: 16px;
            height: 16px;
            object-fit: contain;
        }

        /* ────────────────────────────────────────
               Mobile-first responsive adjustments
            ───────────────────────────────────────── */

        @media (max-width: 640px) {
            .dealer-search-inner {
                padding: 12px;
                gap: 10px;
            }

            .deal-sec {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .divider {
                display: none;
                /* hide on very small screens */
            }

            .search-field {
                min-width: unset;
            }

            .btn-search,
            .btn-dealer {
                width: 100%;
                /* full width buttons on mobile */
                justify-content: center;
                padding: 12px 16px;
            }
        }

        @media (min-width: 641px) {
            .dealer-search-inner {
                /* flex-wrap: nowrap; */
            }

            .deal-sec {
                flex: 1 1 auto;
                min-width: 0;
            }

            .btn-search,
            .btn-dealer {
                flex: 0 0 auto;
            }
        }

        .deal-sec {
            display: flex;
            align-items: center;
            flex: auto;
            border: 1px solid #DDE1DE;
            border-radius: 50px;
            padding: 10px;
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

        /* Active page */
        .page-item.active .page-link {
            background: #ff9800;
            color: #fff;
            border-color: unset !important;
        }

        /* Hover effect */
        .page-link:hover {
            background: #e9ecef;
            color: #000;
        }

        /* Dots */
        .dots {
            pointer-events: none;
            background: #f1f3f5;
        }

        /* Prev/Next icons */
        .page-link img {
            width: 20px;
            height: 20px;
            object-fit: contain;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .page-square {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }


        }

        @media (max-width: 480px) {
            .page-square {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }

            .page-link img {
                width: 16px;
                height: 16px;
            }
        }

        /* ===== GLOBAL / VARIABLES ===== */
        :root {
            --primary: #F58D02;
            --primary-hover: #e67f00;
            --text-dark: #000000;
            --text-muted: #737373;
            --border-light: #e5e7eb;
            --card-border: #DDE1DE;
        }

        /* ===== BANNER SECTION ===== */
        .dealer-banner {
            position: relative;
            min-height: 465px;
            border-radius: 20px;
            overflow: hidden;
            background: url('/assets/images/Carento.png') center/cover no-repeat;
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
            position: relative;
            height: 405px;
            display: flex;
            align-items: end;
            padding-bottom: 2rem;
            /* added spacing */
        }

        .banner-content h2 {
            font-size: 40px;
            font-weight: 700;
        }

        /* ===== SEARCH BAR ===== */
        /*===== search bar styles (100% original) =====*/

        /* ===== DEALER CARDS ===== */
        .dealer-card {
            border: 1px solid var(--card-border);
            background: var(--banner-bg-color);
            border-radius: 8px !important;
            padding: 20px !important;
            /* reduced from 23px 26px for smaller devices */
            height: 100%;
            transition: box-shadow 0.25s ease;
        }

        .dealer-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .dealer-avatar {
            width: 78px;
            height: 78px;
            border-radius: 50%;
            object-fit: cover;
        }

        .dealer-card-head {
            font-size: 24px;
            line-height: 32px;
            font-weight: 700;
            color: var(--select-color);
        }

        .dealer-address {
            font-size: 16px;
            color: var(--text-muted);
            line-height: 26px;
        }

        .vehicle-badge {
            padding: 4px 10px;
            background: #F2F4F6;
            border-radius: 18px;
            display: inline-block;
            color: var(--text-dark);
            border: 1px solid var(--card-border);
            font-weight: 700;
            font-size: 12px;
            line-height: 18px;
        }

        /* ===== MISSION SECTION ===== */
        .mission-section {
            padding: 70px 0;
        }

        .mission-title {
            font-weight: 700;
            font-size: 36px;
            line-height: 42px;
            color: var(--select-color);
        }

        .mission-text {
            color: var(--text-muted);
            margin: 16px 0;
            max-width: 510px;
            font-size: 18px;
            line-height: 28px;
            font-weight: 500;
        }

        .mission-list {
            list-style: none;
            padding: 0;
            margin-bottom: 10px;
        }

        .mission-list li {
            position: relative;
            padding-left: 28px;
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: 700;
            left: 0;
            /* removed left offset */
            color: var(--select-color);
            padding-bottom: 12px;
        }

        .mission-list li::before {
            content: "";
            position: absolute;
            width: 18px;
            height: 18px;
            background: url('/assets/images/tick.png') no-repeat center;
            background-size: contain;
            left: 0;
            top: 4px;
        }

        .mission-img {
            width: 100%;
            height: 269px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* make images stack nicely on mobile */
        @media (max-width: 768px) {
            .mission-img {
                height: auto;
                aspect-ratio: 4/3;
            }
        }

        /* ===== MEDIA QUERIES FOR BANNER & CARDS ===== */
        @media (max-width: 768px) {
            .dealer-banner {
                min-height: 300px;
            }

            .banner-content {
                height: 300px;
            }

            .banner-content h2 {
                font-size: 28px;
            }

            .dealer-card-head {
                font-size: 20px;
                line-height: 28px;
            }

            .dealer-address {
                font-size: 14px;
                line-height: 22px;
            }
        }

        @media (max-width: 576px) {
            .mission-title {
                font-size: 28px;
                line-height: 36px;
            }

            .mission-text {
                font-size: 16px;
                line-height: 24px;
            }
        }

        /* ensure images in mission don't overflow */
        .row.g-3 {
            --bs-gutter-y: 1rem;
        }

        body {

            font-family: Vend Sans !important;



        }

        /* ===== FIX: tablet landscape layout ===== */
        @media (min-width: 768px) and (max-width: 1000px) {

            /* ensure grid behaves like 2 columns */
            .dealer-card {
                padding: 18px !important;
                border-radius: 10px !important;
            }

            /* fix card content alignment */
            .dealer-card .d-flex {
                flex-direction: row;
                align-items: center;
                gap: 12px;
            }

            .dealer-avatar {
                width: 64px;
                height: 64px;
            }

            .dealer-card-head {
                font-size: 17px;
                line-height: 24px;
            }

            .dealer-address {
                font-size: 12px;
                line-height: 19px;
            }

            /* fix badge wrapping */
            .vehicle-badge {
                font-size: 10px;
                padding: 3px 8px;
            }
        }
    </style>









@endsection