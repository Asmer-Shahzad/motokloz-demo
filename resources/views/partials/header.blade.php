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
                    <!-- <div class="logo-o">Protect
                        <span class="speed-line"></span>
                    </div>
                    <div class="logo-o">Borrow
                        <span class="speed-line"></span>
                    </div> -->
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
                                    <a class="nav-link" href="/car-listing?selected_asset=AUTO">Auto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/car-listing?selected_asset=RV / TRAILER">RV</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/car-listing?selected_asset=MOTORCYCLE">Motorcycle</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/car-listing?selected_asset=POWERSPORTS">Powersports</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/car-listing?selected_asset=HEAVY TRUCK/EQUIPMENT">Heavy Truck</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/car-listing?selected_asset=HEAVY DUTY TRAILERS">Trailers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/car-listing?selected_asset=FARM EQUIPMENT">Farm Equipment</a>
                                </li>
                            </ul>
                            <div class="mobile-btn">

                                <div class="logo-o">Buy
                                    <span class="speed-line"></span>
                                </div>
                                <div class="logo-o">Sell
                                    <span class="speed-line"></span>
                                </div>
                                <!-- <div class="logo-o">Protect
                                    <span class="speed-line"></span>
                                </div>
                                <div class="logo-o">Borrow
                                    <span class="speed-line"></span>
                                </div> -->
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
                <div class="col-lg-6 d-flex align-items-center" style="gap:4px;">
                    <a href="/" class="site-logo">
                        <img src="/assets/images/darklogo.png" class="logo logo-dark" alt="Motokloz Logo">
                        <img src="/assets/images/lightlogo.png" class="logo logo-light" alt="Motokloz Logo">
                    </a>

                    <!-- Google Translate Dropdown Container -->
                    {{-- <div class="gtranslate_wrapper"></div> --}}

                    <!-- Language Dropdown -->
                    <div class="dropdownn m-4 lang-dropdown">
                        <button class="btn btn-light border rounded-pill px-3 py-1 dropdown-toggle" type="button"
                            data-bs-toggle="dropdown">
                            ENG
                        </button>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item change-lang" data-lang="en">English</a></li>
                            <li><a class="dropdown-item change-lang" data-lang="es">Spanish</a></li>
                            <li><a class="dropdown-item change-lang" data-lang="fr">French</a></li>
                            <li><a class="dropdown-item change-lang" data-lang="de">German</a></li>
                            <li><a class="dropdown-item change-lang" data-lang="zh-CN">Chinese</a></li>
                            <li><a class="dropdown-item change-lang" data-lang="tr">Turkish</a></li>
                            <li><a class="dropdown-item change-lang" data-lang="ru">Russian</a></li>
                            <li><a class="dropdown-item change-lang" data-lang="id">Indonesian</a></li>
                        </ul>
                    </div>

                    <!-- Hidden GTranslate Wrapper -->
                    <div class="gtranslate_wrapper" style="display:none;"></div>

                    {{-- <!-- GTranslate Settings -->
                    <script>
                        window.gtranslateSettings = {
                            default_language: "en",
                            detect_browser_language: true,
                            wrapper_selector: ".gtranslate_wrapper"
                        };
                    </script>

                    <!-- GTranslate Script -->
                    <script src="https://cdn.gtranslate.net/widgets/latest/dropdown.js" defer></script>

                    <!-- Custom Language Switch Script -->
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {

                            function waitForSelectAndChange(lang) {

                                let interval = setInterval(function () {

                                    let select = document.querySelector(".gtranslate_wrapper select");

                                    if (select) {
                                        select.value = lang;
                                        select.dispatchEvent(new Event("change"));
                                        clearInterval(interval);
                                    }

                                }, 300);
                            }

                            // Change language on click
                            document.querySelectorAll(".change-lang").forEach(function (el) {

                                el.addEventListener("click", function (e) {
                                    e.preventDefault();

                                    let lang = this.getAttribute("data-lang");

                                    waitForSelectAndChange(lang);

                                    // Update button text
                                    document.querySelector(".lang-dropdown button").innerText = lang.toUpperCase();

                                    // Save selected language in localStorage
                                    localStorage.setItem("selectedLang", lang);
                                });

                            });

                            // Load saved language on page load
                            let savedLang = localStorage.getItem("selectedLang");

                            if (savedLang) {
                                waitForSelectAndChange(savedLang);
                                document.querySelector(".lang-dropdown button").innerText = savedLang.toUpperCase();
                            }

                        });
                    </script> --}}
                    <button id="themeToggle" aria-label="Toggle theme">
                        <img id="themeIcon" src="/assets/images/darkmood.png" alt="Theme toggle" />
                    </button>
                </div>
                <div class="col-lg-6 btn-header">
                    @php
                        $showImageRoutes = [
                            'wishlist',
                            'chat',
                            'agent.settings',
                            'agent.dashboard',
                            'add.listings',
                            'account.settings',
                            'listings'
                        ];
                    @endphp

                    @if(in_array(Route::currentRouteName(), $showImageRoutes))
                        <img src="/assets/images/Frame 1707481624.png" alt="Logo">
                    @endif
                    <div class="logo-o">Buy
                        <span class="speed-line"></span>
                    </div>
                    <div class="logo-o">Sell
                        <span class="speed-line"></span>
                    </div>
                    <!-- <div class="logo-o logo-2nd">Protect
                        <span class="speed-line"></span>
                    </div>
                    <div class="logo-o logo-2nd ">Borrow
                        <span class="speed-line"></span>
                    </div> -->



                    {{-- User Profile Dropdown / Login Button --}}
                    <div class="user-profile-btn">
                        @auth
                            {{-- ✅ User is logged in --}}
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                                    id="userDropdown">
                                    <img src="/assets/images/user.png" class="img-fluid light-dark">
                                </a>
                                <ul class="dropdown-menu nav-drop dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('agent.settings') ? 'active-link' : '' }}"
                                            href="{{ route('agent.settings') }}">
                                            My Profile
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('agent.dashboard') ? 'active-link' : '' }}"
                                            href="{{ route('agent.dashboard') }}">
                                            Dashboard
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('listings') ? 'active-link' : '' }}"
                                            href="{{ route('listings') }}">
                                            Listings
                                        </a>
                                    </li>


                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('add.listings') ? 'active-link' : '' }}"
                                            href="{{ route('add.listings') }}">
                                            Add Listing
                                        </a>
                                    </li>


                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('wishlist') ? 'active-link' : '' }}"
                                            href="{{ route('wishlist') }}">
                                            My Wishlist
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('account.settings') ? 'active-link' : '' }}"
                                            href="{{ route('account.settings') }}">
                                            Account Settings
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endauth

                        @guest
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                                    id="userDropdown">
                                    <img src="/assets/images/user.png" class="img-fluid light-dark">
                                </a>
                                <ul class="dropdown-menu nav-drop dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('login') ? 'active-link' : '' }}"
                                            href="{{ route('login') }}">
                                            Login
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('login') ? 'active-link' : '' }}"
                                            href="#">
                                            Support
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('signup') ? 'active-link' : '' }}"
                                            href="{{ route('signup') }}">
                                            Register
                                        </a>
                                    </li>
                                </ul>
                            </div>


                        @endguest
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>


<style>
    .active-link {
        color: #F58D02 !important;
        font-weight: 600;
    }

    .dropdown-item.active,
    .dropdown-item:active {
        background-color: transparent !important;
        color: #F58D02 !important;
    }
</style>
<style>
    /* Hide the default Bootstrap dropdown caret */
    .user-profile-btn .dropdown-toggle::after {
        display: none !important;
    }

    .user-profile-btn .dropdown-toggle:focus {
        outline: none;
        box-shadow: none;
    }



    /* Wrapper */
    .lang-dropdown {
        position: relative;
    }

    /* Button */
    .lang-dropdown .btn {
        font-weight: 500;
        border-radius: 999px;
        transition: all 0.25s ease;
    }

    .lang-dropdown .btn:hover {
        background: #fff3e6;
        border-color: #F58D02;
        color: #F58D02;
    }

    /* Dropdown base (hidden smoothly) */
    .lang-dropdown .dropdown-menu {
        display: block;
        /* important */
        opacity: 0;
        transform: translateY(10px);
        pointer-events: none;
        border: none;
        border-radius: 14px;
        padding: 8px;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        transition: opacity 0.25s ease, transform 0.25s ease;
    }

    /* Bootstrap adds .show → animate */
    .lang-dropdown .dropdown-menu.show {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    /* Items */
    .lang-dropdown .dropdown-item {
        border-radius: 8px;
        padding: 8px 12px;
        transition: all 0.2s ease;
    }

    .lang-dropdown .dropdown-item:hover {
        background: rgba(245, 141, 2, 0.08);
        color: #F58D02;
        transform: translateX(4px);
    }
</style>
<style>
    .logo-2nd {
        background: var(--bg-button);
        border: 2px solid var(--border-button);
        color: #fff;
    }

    .logo-2nd:hover {
        background: #fff;
        color: #000;
    }
</style>