<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <?php require_once(__DIR__ . '/../include/header-script.php'); ?>
</head>
<?php $pageTitle = 'Listing'; ?>

<body>
    <?php require_once(__DIR__ . '/../include/header.php'); ?>
    <div class="listing-page my-py-80">
        <div class="container">
            <div class="page-content">
                <!-- Page Top -->
                <div class="page-top">
                    <!-- breadcrumbs -->

                    <?php require_once(__DIR__ . '/../include/user-account-breadcrumbs.php'); ?>

                    <div class="row">
                        <div class="col-lg-2 page-title">
                            <h1>Listings</h1>
                        </div>
                    </div>
                </div>
                <!-- Page Bottom -->
                <div class="page-bottom">
                    <div class="row">

                        <!-- SideBar -->
                        <?php require_once(__DIR__ . '/../include/user-account-sidebar.php'); ?>
                        <div class="col-lg-9 listing">
                            <div class="listing-top">
                                <div class="warning-div">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7 0C5.72444 0 4.55 0.311111 3.47667 0.933333C2.40333 1.55556 1.55556 2.40333 0.933333 3.47667C0.311111 4.55 0 5.72444 0 7C0 8.27556 0.311111 9.45 0.933333 10.5233C1.55556 11.5967 2.40333 12.4444 3.47667 13.0667C4.55 13.6889 5.72444 14 7 14C8.27556 14 9.45 13.6889 10.5233 13.0667C11.5967 12.4444 12.4444 11.5967 13.0667 10.5233C13.6889 9.45 14 8.27556 14 7C14 5.72444 13.6889 4.55 13.0667 3.47667C12.4444 2.40333 11.5967 1.55556 10.5233 0.933333C9.45 0.311111 8.27556 0 7 0ZM7 12.8333C5.94222 12.8333 4.97 12.5689 4.08333 12.04C3.19667 11.5111 2.48889 10.8033 1.96 9.91667C1.43111 9.03 1.16667 8.05778 1.16667 7C1.16667 5.94222 1.43111 4.97 1.96 4.08333C2.48889 3.19667 3.19667 2.48889 4.08333 1.96C4.97 1.43111 5.94222 1.16667 7 1.16667C8.05778 1.16667 9.03 1.43111 9.91667 1.96C10.8033 2.48889 11.5111 3.19667 12.04 4.08333C12.5689 4.97 12.8333 5.94222 12.8333 7C12.8333 8.05778 12.5689 9.03 12.04 9.91667C11.5111 10.8033 10.8033 11.5111 9.91667 12.04C9.03 12.5689 8.05778 12.8333 7 12.8333ZM7 5.83333H6.44C6.25333 5.83333 6.10556 5.88778 5.99667 5.99667C5.88778 6.10556 5.83333 6.24556 5.83333 6.41667C5.83333 6.58778 5.88778 6.72778 5.99667 6.83667C6.10556 6.94556 6.25333 7 6.44 7H7V10.5C7 10.6556 7.05444 10.7878 7.16333 10.8967C7.27222 11.0056 7.41222 11.06 7.58333 11.06C7.75444 11.06 7.89444 11.0056 8.00333 10.8967C8.11222 10.7878 8.16667 10.6556 8.16667 10.5V7C8.16667 6.68889 8.05 6.41667 7.81667 6.18333C7.58333 5.95 7.31111 5.83333 7 5.83333ZM6.11333 3.78C6.11333 4.02889 6.19889 4.23889 6.37 4.41C6.54111 4.58111 6.75111 4.66667 7 4.66667C7.24889 4.66667 7.45889 4.58111 7.63 4.41C7.80111 4.23889 7.88667 4.02889 7.88667 3.78C7.88667 3.53111 7.80111 3.32111 7.63 3.15C7.45889 2.97889 7.24889 2.90111 7 2.91667C6.75111 2.93222 6.54111 3.01778 6.37 3.17333C6.19889 3.32889 6.11333 3.53111 6.11333 3.78Z"
                                            fill="#F58D02" />
                                    </svg>
                                    <span class="warning-text">Join the year-end sale to boost your sales now</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <g clip-path="url(#clip0_286_3029)">
                                            <path
                                                d="M0.256188 0.256375C0.420275 0.0923373 0.642794 0.000186359 0.874813 0.000186359C1.10683 0.000186359 1.32935 0.0923373 1.49344 0.256375L6.99981 5.76275L12.5062 0.256375C12.5869 0.172803 12.6835 0.106144 12.7902 0.0602858C12.897 0.0144279 13.0118 -0.00971005 13.128 -0.0107196C13.2441 -0.0117292 13.3594 0.0104098 13.4669 0.0544055C13.5744 0.0984013 13.6721 0.163373 13.7543 0.245529C13.8364 0.327685 13.9014 0.42538 13.9454 0.532915C13.9894 0.640449 14.0115 0.755669 14.0105 0.871851C14.0095 0.988032 13.9854 1.10285 13.9395 1.2096C13.8937 1.31636 13.827 1.41291 13.7434 1.49362L8.23706 7L13.7434 12.5064C13.9028 12.6714 13.991 12.8924 13.989 13.1219C13.987 13.3513 13.895 13.5707 13.7328 13.733C13.5705 13.8952 13.3511 13.9872 13.1217 13.9892C12.8922 13.9912 12.6712 13.903 12.5062 13.7436L6.99981 8.23725L1.49344 13.7436C1.32841 13.903 1.10738 13.9912 0.877962 13.9892C0.64854 13.9872 0.429079 13.8952 0.266847 13.733C0.104615 13.5707 0.012592 13.3513 0.0105984 13.1219C0.00860474 12.8924 0.0967999 12.6714 0.256188 12.5064L5.76256 7L0.256188 1.49362C0.092151 1.32954 0 1.10702 0 0.875C0 0.642981 0.092151 0.420461 0.256188 0.256375Z"
                                                fill="black" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_286_3029">
                                                <rect width="14" height="14" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                            <div class="listing-bottom">
                                <div class="listing-main">
                                    <div class="listing-head">
                                        <div class="listing-left">
                                            <h2>Listings</h2>
                                        </div>
                                        <div class="listing-center search-form">
                                            <form action="#">
                                                <input type="text" name="carsearch" id="carsearch" placeholder="Search">
                                                <button type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 14 14" fill="none">
                                                        <path
                                                            d="M13.8675 13.0275L10.3675 9.52753C11.0209 8.74975 11.4331 7.86309 11.6042 6.86753C11.7753 5.87197 11.6975 4.89975 11.3709 3.95086C11.0442 3.00197 10.5075 2.18531 9.76086 1.50086C9.01419 0.816419 8.15086 0.365308 7.17086 0.147531C6.19086 -0.0702477 5.21864 -0.0469141 4.25419 0.21753C3.28975 0.481975 2.44197 0.979753 1.71086 1.71086C0.979749 2.44197 0.481971 3.28975 0.217527 4.2542C-0.0469176 5.21864 -0.0702509 6.19086 0.147527 7.17086C0.365305 8.15086 0.816416 9.0142 1.50086 9.76086C2.1853 10.5075 3.00197 11.0442 3.95086 11.3709C4.89975 11.6975 5.87197 11.7753 6.86753 11.6042C7.86308 11.4331 8.74975 11.0209 9.52753 10.3675L13.0275 13.8675C13.152 13.9609 13.292 14.0075 13.4475 14.0075C13.6031 14.0075 13.7353 13.9531 13.8442 13.8442C13.9531 13.7353 14.0075 13.6031 14.0075 13.4475C14.0075 13.292 13.9609 13.152 13.8675 13.0275ZM5.84086 10.5075C5.00086 10.5075 4.22308 10.2975 3.50753 9.87753C2.79197 9.45753 2.22419 8.88975 1.80419 8.1742C1.38419 7.45864 1.17419 6.68086 1.17419 5.84086C1.17419 5.00086 1.38419 4.22309 1.80419 3.50753C2.22419 2.79198 2.79197 2.2242 3.50753 1.8042C4.22308 1.3842 5.00086 1.1742 5.84086 1.1742C6.68086 1.1742 7.45864 1.3842 8.17419 1.8042C8.88975 2.2242 9.45753 2.79198 9.87753 3.50753C10.2975 4.22309 10.5075 5.00086 10.5075 5.84086C10.5075 6.68086 10.2975 7.45864 9.87753 8.1742C9.45753 8.88975 8.88975 9.45753 8.17419 9.87753C7.45864 10.2975 6.68086 10.5075 5.84086 10.5075Z"
                                                            fill="#393F4D" />
                                                    </svg>
                                                </button>
                                            </form>

                                        </div>
                                        <div class="listing-right">
                                            <div class="filter">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path
                                                        d="M10.5 3.45334C10.5 2.83111 10.2744 2.29445 9.82333 1.84334C9.37222 1.39222 8.83556 1.16667 8.21333 1.16667H2.28667C1.66444 1.16667 1.12778 1.39222 0.676667 1.84334C0.225556 2.29445 0 2.81556 0 3.40667C0 3.99778 0.186667 4.51111 0.56 4.94667L3.5 8.4V10.5C3.5 10.6867 3.57778 10.8422 3.73333 10.9667L6.06667 12.6933C6.16 12.7867 6.26111 12.8333 6.37 12.8333C6.47889 12.8333 6.58 12.8178 6.67333 12.7867C6.89111 12.6622 7 12.4756 7 12.2267V8.4L9.94 4.94667C10.3133 4.51111 10.5 4.01334 10.5 3.45334ZM9.05333 4.2L5.97333 7.79334C5.88 7.88667 5.83333 8.01111 5.83333 8.16667V11.1067L4.66667 10.22V8.16667C4.66667 8.01111 4.62 7.88667 4.52667 7.79334L1.44667 4.2C1.26 3.98222 1.16667 3.72556 1.16667 3.43C1.16667 3.13445 1.27556 2.87778 1.49333 2.66C1.71111 2.44222 1.97556 2.33334 2.28667 2.33334H8.21333C8.52444 2.33334 8.78889 2.44222 9.00667 2.66C9.22444 2.87778 9.33333 3.13445 9.33333 3.43C9.33333 3.72556 9.24 3.98222 9.05333 4.2ZM14 11.6667C14 11.8222 13.9456 11.9622 13.8367 12.0867C13.7278 12.2111 13.58 12.2733 13.3933 12.2733H8.77333C8.58667 12.2733 8.43889 12.2111 8.33 12.0867C8.22111 11.9622 8.16667 11.8222 8.16667 11.6667C8.16667 11.5111 8.22111 11.3789 8.33 11.27C8.43889 11.1611 8.58667 11.1067 8.77333 11.1067H13.44C13.5956 11.1067 13.7278 11.1611 13.8367 11.27C13.9456 11.3789 14 11.5111 14 11.6667ZM14 9.33334C14 9.48889 13.9456 9.62889 13.8367 9.75334C13.7278 9.87778 13.58 9.94 13.3933 9.94H8.77333C8.58667 9.94 8.43889 9.87778 8.33 9.75334C8.22111 9.62889 8.16667 9.48889 8.16667 9.33334C8.16667 9.17778 8.22111 9.04556 8.33 8.93667C8.43889 8.82778 8.58667 8.77334 8.77333 8.77334H13.44C13.5956 8.77334 13.7278 8.82778 13.8367 8.93667C13.9456 9.04556 14 9.17778 14 9.33334ZM10.5 6.44H13.44C13.5956 6.44 13.7278 6.49445 13.8367 6.60334C13.9456 6.71222 14 6.84445 14 7C14 7.15556 13.9456 7.29556 13.8367 7.42C13.7278 7.54445 13.58 7.60667 13.3933 7.60667H10.5C10.3444 7.60667 10.2122 7.54445 10.1033 7.42C9.99444 7.29556 9.94 7.15556 9.94 7C9.94 6.84445 9.99444 6.71222 10.1033 6.60334C10.2122 6.49445 10.3444 6.44 10.5 6.44Z"
                                                        fill="#737373" />
                                                </svg>
                                            </div>
                                            <!-- <div class="sort">
                                                sort
                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="4"
                                                    viewBox="0 0 8 4" fill="none">
                                                    <mask id="path-1-inside-1_286_3048" fill="white">
                                                        <path d="M0 0H8V4H0V0Z" />
                                                    </mask>
                                                    <g clip-path="url(#paint0_diamond_286_3048_clip_path)"
                                                        data-figma-skip-parse="true"
                                                        mask="url(#path-1-inside-1_286_3048)">
                                                        <g transform="matrix(0.004 0 0 0.004 4 0)">
                                                            <rect x="0" y="0" width="1250" height="1250"
                                                                fill="url(#paint0_diamond_286_3048)" opacity="1"
                                                                shape-rendering="crispEdges" />
                                                            <rect x="0" y="0" width="1250" height="1250"
                                                                transform="scale(1 -1)"
                                                                fill="url(#paint0_diamond_286_3048)" opacity="1"
                                                                shape-rendering="crispEdges" />
                                                            <rect x="0" y="0" width="1250" height="1250"
                                                                transform="scale(-1 1)"
                                                                fill="url(#paint0_diamond_286_3048)" opacity="1"
                                                                shape-rendering="crispEdges" />
                                                            <rect x="0" y="0" width="1250" height="1250"
                                                                transform="scale(-1)"
                                                                fill="url(#paint0_diamond_286_3048)" opacity="1"
                                                                shape-rendering="crispEdges" />
                                                        </g>
                                                    </g>
                                                    <path
                                                        d="M0 0V-4H-4V0H0ZM8 0H12V-4H8V0ZM0 0V4H8V0V-4H0V0ZM8 0H4V4H8H12V0H8ZM0 4H4V0H0H-4V4H0Z"
                                                        data-figma-gradient-fill="{&quot;type&quot;:&quot;GRADIENT_DIAMOND&quot;,&quot;stops&quot;:[{&quot;color&quot;:{&quot;r&quot;:0.45098039507865906,&quot;g&quot;:0.45098039507865906,&quot;b&quot;:0.45098039507865906,&quot;a&quot;:1.0},&quot;position&quot;:0.99999988079071045},{&quot;color&quot;:{&quot;r&quot;:0.0,&quot;g&quot;:0.0,&quot;b&quot;:0.0,&quot;a&quot;:0.0},&quot;position&quot;:1.0}],&quot;stopsVar&quot;:[{&quot;color&quot;:{&quot;r&quot;:0.45098039507865906,&quot;g&quot;:0.45098039507865906,&quot;b&quot;:0.45098039507865906,&quot;a&quot;:1.0},&quot;position&quot;:0.99999988079071045},{&quot;color&quot;:{&quot;r&quot;:0.0,&quot;g&quot;:0.0,&quot;b&quot;:0.0,&quot;a&quot;:0.0},&quot;position&quot;:1.0}],&quot;transform&quot;:{&quot;m00&quot;:8.0,&quot;m01&quot;:0.0,&quot;m02&quot;:0.0,&quot;m10&quot;:0.0,&quot;m11&quot;:8.0,&quot;m12&quot;:-4.0},&quot;opacity&quot;:1.0,&quot;blendMode&quot;:&quot;NORMAL&quot;,&quot;visible&quot;:true}"
                                                        mask="url(#path-1-inside-1_286_3048)" />
                                                    <defs>
                                                        <clipPath id="paint0_diamond_286_3048_clip_path">
                                                            <path
                                                                d="M0 0V-4H-4V0H0ZM8 0H12V-4H8V0ZM0 0V4H8V0V-4H0V0ZM8 0H4V4H8H12V0H8ZM0 4H4V0H0H-4V4H0Z"
                                                                mask="url(#path-1-inside-1_286_3048)" />
                                                        </clipPath>
                                                        <linearGradient id="paint0_diamond_286_3048" x1="0" y1="0"
                                                            x2="500" y2="500" gradientUnits="userSpaceOnUse">
                                                            <stop offset="1" stop-color="#737373" />
                                                            <stop offset="1" stop-opacity="0" />
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="listing-body">
                                        <div class="row g-4">
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="modern-car-card shadow-sm">
                                                    <div class="car-card-top">
                                                        <img src="https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=500"
                                                            alt="Car">
                                                        <div class="badge-mileage">
                                                            <i class="fa-solid fa-gauge-high"></i> 25,100 Km
                                                        </div>
                                                    </div>
                                                    <div class="car-card-bottom">
                                                        <h5 class="car-main-title">2022 Cadillac XT6 Premium Luxury</h5>
                                                        <p class="car-distance-away"><i
                                                                class="fa-solid fa-location-dot"></i> 12 Km away</p>

                                                        <div class="car-circle-icons-group">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-1.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-2.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-3.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-4.png"
                                                                alt="">
                                                            <span class="extra-icons-count">12+</span>
                                                        </div>

                                                        <div class="car-price-block text-end">
                                                            <h4 class="price-value">$60089.32</h4>
                                                            <p class="price-sub-text">In sapien eu diam eu</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="modern-car-card shadow-sm">
                                                    <div class="car-card-top">
                                                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500"
                                                            alt="Car">
                                                        <div class="badge-mileage"><i
                                                                class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
                                                    </div>
                                                    <div class="car-card-bottom">
                                                        <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                                        <p class="car-distance-away"><i
                                                                class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                                        <div class="car-circle-icons-group">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-1.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-2.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-3.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-4.png"
                                                                alt="">
                                                            <span class="extra-icons-count">12+</span>
                                                        </div>
                                                        <div class="car-price-block text-end">
                                                            <h4 class="price-value">$95400.00</h4>
                                                            <p class="price-sub-text">In sapien eu diam eu</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="modern-car-card shadow-sm">
                                                    <div class="car-card-top">
                                                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500"
                                                            alt="Car">
                                                        <div class="badge-mileage"><i
                                                                class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
                                                    </div>
                                                    <div class="car-card-bottom">
                                                        <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                                        <p class="car-distance-away"><i
                                                                class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                                        <div class="car-circle-icons-group">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-1.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-2.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-3.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-4.png"
                                                                alt="">
                                                            <span class="extra-icons-count">12+</span>
                                                        </div>
                                                        <div class="car-price-block text-end">
                                                            <h4 class="price-value">$95400.00</h4>
                                                            <p class="price-sub-text">In sapien eu diam eu</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="modern-car-card shadow-sm">
                                                    <div class="car-card-top">
                                                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500"
                                                            alt="Car">
                                                        <div class="badge-mileage"><i
                                                                class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
                                                    </div>
                                                    <div class="car-card-bottom">
                                                        <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                                        <p class="car-distance-away"><i
                                                                class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                                        <div class="car-circle-icons-group">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-1.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-2.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-3.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-4.png"
                                                                alt="">
                                                            <span class="extra-icons-count">12+</span>
                                                        </div>
                                                        <div class="car-price-block text-end">
                                                            <h4 class="price-value">$95400.00</h4>
                                                            <p class="price-sub-text">In sapien eu diam eu</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="modern-car-card shadow-sm">
                                                    <div class="car-card-top">
                                                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500"
                                                            alt="Car">
                                                        <div class="badge-mileage"><i
                                                                class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
                                                    </div>
                                                    <div class="car-card-bottom">
                                                        <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                                        <p class="car-distance-away"><i
                                                                class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                                        <div class="car-circle-icons-group">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-1.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-2.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-3.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-4.png"
                                                                alt="">
                                                            <span class="extra-icons-count">12+</span>
                                                        </div>
                                                        <div class="car-price-block text-end">
                                                            <h4 class="price-value">$95400.00</h4>
                                                            <p class="price-sub-text">In sapien eu diam eu</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="modern-car-card shadow-sm">
                                                    <div class="car-card-top">
                                                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500"
                                                            alt="Car">
                                                        <div class="badge-mileage"><i
                                                                class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
                                                    </div>
                                                    <div class="car-card-bottom">
                                                        <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                                        <p class="car-distance-away"><i
                                                                class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                                        <div class="car-circle-icons-group">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-1.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-2.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-3.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-4.png"
                                                                alt="">
                                                            <span class="extra-icons-count">12+</span>
                                                        </div>
                                                        <div class="car-price-block text-end">
                                                            <h4 class="price-value">$95400.00</h4>
                                                            <p class="price-sub-text">In sapien eu diam eu</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="modern-car-card shadow-sm">
                                                    <div class="car-card-top">
                                                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500"
                                                            alt="Car">
                                                        <div class="badge-mileage"><i
                                                                class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
                                                    </div>
                                                    <div class="car-card-bottom">
                                                        <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                                        <p class="car-distance-away"><i
                                                                class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                                        <div class="car-circle-icons-group">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-1.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-2.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-3.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-4.png"
                                                                alt="">
                                                            <span class="extra-icons-count">12+</span>
                                                        </div>
                                                        <div class="car-price-block text-end">
                                                            <h4 class="price-value">$95400.00</h4>
                                                            <p class="price-sub-text">In sapien eu diam eu</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="modern-car-card shadow-sm">
                                                    <div class="car-card-top">
                                                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500"
                                                            alt="Car">
                                                        <div class="badge-mileage"><i
                                                                class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
                                                    </div>
                                                    <div class="car-card-bottom">
                                                        <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                                        <p class="car-distance-away"><i
                                                                class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                                        <div class="car-circle-icons-group">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-1.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-2.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-3.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-4.png"
                                                                alt="">
                                                            <span class="extra-icons-count">12+</span>
                                                        </div>
                                                        <div class="car-price-block text-end">
                                                            <h4 class="price-value">$95400.00</h4>
                                                            <p class="price-sub-text">In sapien eu diam eu</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="modern-car-card shadow-sm">
                                                    <div class="car-card-top">
                                                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500"
                                                            alt="Car">
                                                        <div class="badge-mileage"><i
                                                                class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
                                                    </div>
                                                    <div class="car-card-bottom">
                                                        <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                                        <p class="car-distance-away"><i
                                                                class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                                        <div class="car-circle-icons-group">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-1.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-2.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-3.png"
                                                                alt="">
                                                            <img src="<?php echo $prefix; ?>/assets/images/badge-4.png"
                                                                alt="">
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
                                        <div class="pagination-section mt-56">
                                                <?php require_once(__DIR__ . '/../include/pagination.php'); ?>
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







    <?php require_once(__DIR__ . '/../include/footer-script.php'); ?>
    <?php require_once(__DIR__ . '/../include/footer.php'); ?>


</body>

</html>