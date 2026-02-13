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
            <strong class="seat-head">Account Setting</strong>
        </div>

        <h2 class="main-head">Account Setting</h2>

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
                                <img src="/motokloz-demo/assets/images/Link (3).png" class="edit-img">
                            </span>

                        </div>
                    </div>

                    <ul class="account-menu">

                        <li class="menu-item">
                            <img src="/motokloz-demo/assets/images/Vector (2).png" class="menu-icon">
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

                        <li class="menu-item">
                            <img src="/motokloz-demo/assets/images/Icon (3).png" class="menu-icon">
                            My Wishlist
                        </li>

                        <li class="menu-item active">
                            <img src="/motokloz-demo/assets/images/Icon (4).png" class="menu-icon">
                            Account Setting
                        </li>

                    </ul>

                </div>
            </div>


            <!-- Content -->
            <div class="col-lg-9">
                <div class="account-content">

                    <h5 class="account-content-head">Notifications</h5>

                    <!-- Row -->
                    <div class="notify-row">
                        <div class="notify-text">
                            <h6 class="notify-head">Booking Confirmations</h6>
                            <p class="notify-para">Instant notifications for flight, hotel, or activity bookings</p>
                        </div>

                        <div class="notify-switches">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label>SMS</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label>Email</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox">
                                <label>Push</label>
                            </div>
                        </div>
                    </div>

                    <div class="notify-row">
                        <div class="notify-text">
                            <h6 class="notify-head">Policy</h6>
                            <p class="notify-para">Stay informed about changes to our guidelines</p>
                        </div>

                        <div class="notify-switches">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label>SMS</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label>Email</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox">
                                <label>Push</label>
                            </div>
                        </div>
                    </div>

                    <div class="notify-row border-0">
                        <div class="notify-text">
                            <h6 class="notify-head">Promotions</h6>
                            <p class="notify-para">Updates on upcoming offers and promotions</p>
                        </div>

                        <div class="notify-switches">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label>SMS</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label>Email</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox">
                                <label>Push</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <style>
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

    .notify-row .notify-switches .form-switch .form-check-input:checked {
        border: 0 !important;
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
        background: #fff3e8;
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

    .notify-row .notify-switches .form-switch {
        padding: 0;
        flex-direction: column-reverse;
    }

    .notify-row .notify-switches .form-switch .form-check-input {
        margin: 0;
        float: unset !important;
        width: 32px;
        height: 16px;
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

    /* Notification rows */
    .notify-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 0;
        gap: 20px;
    }

    .account-content-head {
        color: var(--select-color);
        font-weight: 700 !important;
        font-size: 20px !important;
        line-height: 26px;
    }


    .notify-text .notify-head {
        font-size: 16px;
        font-weight: 700;
        margin: 0;
        color: var(--select-color);
        line-height: 24px;
    }

    .notify-text .notify-para {
        font-size: 14px;
        color: #737373;
        font-weight: 500;
        margin: 4px 0 0;
        line-height: 24px;
    }

    /* Switches */
    .notify-switches {
        display: flex;
        align-items: center;
        gap: 55px;
        font-size: 13px;
        color: #444;
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

    @media (max-width: 768px) {
        .notify-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .notify-switches {
            margin-top: 10px;
            gap: 16px;
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