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

    <section class="auth-section">
        <div class="container">
            <div class="auth-card row g-0">

                <!-- Image -->
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="auth-image">
                        <img src="/motokloz-demo/assets/images/truck.png" alt="truck">
                    </div>
                </div>

                <!-- Form -->
                <div class="signup-form col-lg-6 col-12">
                    <div class="auth-form text-center">

                        <span class="signup-badge">Sign Up</span>

                        <h2>Create an Account</h2>
                        <p>Motokloz your one-stop-shop for all your car buying needs!</p>
                        <form action="#" id="signup-form" class="user-form">
                            <div class="form-group">
                                <img src="/motokloz-demo/assets/images/userlogin.png" alt="">
                                <input type="text" class="form-control" placeholder="Username">
                            </div>

                            <div class="form-group">
                                <img src="/motokloz-demo/assets/images/Vector.png" alt="">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>

                            <div class="form-group">
                                <img src="/motokloz-demo/assets/images/password.png" alt="">
                                <input type="password" class="form-control" placeholder="****************">
                            </div>

                            <div class="form-group">
                                <img src="/motokloz-demo/assets/images/password.png" alt="">
                                <input type="password" class="form-control" placeholder="****************">
                            </div>

                            <button class="btn btn-auth d-flex align-items-center justify-content-center gap-2">
                                Sign Up
                                <img src="/motokloz-demo/assets/images/bttnarrow.png" alt=" arrow" width="18">
                            </button>
                        </form>

                        <div class="login-text">
                            Already have an account?
                            <a href="#">Login Here!</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>





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
                            <li><i class="fa-sharp fa-solid fa-location-dot"></i><a href="#">2356 Oakwood Drive, Suite
                                    18, San Francisco, California 94111, US</a></li>
                            <li><i class="fa-sharp fa-solid fa-clock"></i><a href="#">Hours: 8:00 - 17:00, Mon - Sat</a>
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