<header>
    <div class="header-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 btn-mobile">
                    <a href="{{ route('buy.step1') }}" style="text-decoration: none; color: inherit;">
                        <div class="logo-o">
                            Buy
                            <span class="speed-line"></span>
                        </div>
                    </a>
                    <a href="{{ route('sell') }}" style="text-decoration: none; color: inherit;">
                        <div class="logo-o">
                            Sell
                            <span class="speed-line"></span>
                        </div>
                    </a>
                    <!-- <div class="logo-o">Protect
                        <span class="speed-line"></span>
                    </div>
                    <div class="logo-o">Borrow
                        <span class="speed-line"></span>
                    </div> -->
                </div>
                <div class="col-lg-11">
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
                            <div class="mob-menu">
                                <ul class="navbar-nav  mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/car-listing?selected_asset=AUTO">Auto</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/car-listing?selected_asset=SNOWSPORTS">Snowsports</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/car-listing?selected_asset=WATERSPORT">Watersports</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/car-listing?selected_asset=MARINE">Marine</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/car-listing?selected_asset=RV / TRAILER">RV</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/car-listing?selected_asset=MOTORCYCLE / ATV / POWERSPORTS">Motorcycle</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/car-listing?selected_asset=HEAVY TRUCK/EQUIPMENT">Heavy Truck</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="/car-listing?selected_asset=HEAVY DUTY TRAILERS">Trailers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/car-listing?selected_asset=FARM EQUIPMENT">Farm
                                            Equipment</a>
                                    </li>
                                </ul>
                                <div class="mobile-btn">

                                    <a href="{{ route('buy.step1') }}" style="text-decoration: none; color: inherit;">
                                        <div class="logo-o">
                                            Buy
                                            <span class="speed-line"></span>
                                        </div>
                                    </a>
                                    <a href="{{ route('sell') }}" style="text-decoration: none; color: inherit;">
                                        <div class="logo-o">
                                            Sell
                                            <span class="speed-line"></span>
                                        </div>
                                    </a>
                                    <!-- <div class="logo-o">Protect
                                        <span class="speed-line"></span>
                                    </div>
                                    <div class="logo-o">Borrow
                                        <span class="speed-line"></span>
                                    </div> -->
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
                <div class="col-lg-6 d-flex align-items-center" style="gap:4px;">
                    <a href="/" class="site-logo">
                        <img src="/assets/images/darklogo.png" class="logo logo-dark" alt="Motokloz Logo">
                        <img src="/assets/images/lightlogo.png" class="logo logo-light" alt="Motokloz Logo">
                    </a>

                    <!-- Google Translate Dropdown Container -->
                    {{-- <div class="gtranslate_wrapper"></div> --}}

                    <!-- Language Dropdown -->
                    {{-- <div class="dropdownn m-4 lang-dropdown">
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
                    </div> --}}
                    <div class="gtranslate_wrapper"></div>



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

                    @auth
                        <a href="{{ route('chat.index') }}" style="position:relative; display:inline-flex;">
                            @if(in_array(Route::currentRouteName(), $showImageRoutes))
                                <img src="/assets/images/Frame 1707481624.png" alt="Logo">
                            @else
                                <img src="/assets/images/Frame 1707481624.png" alt="Logo">
                            @endif
                            <span id="chatUnreadBadge" style="display:none; position:absolute; top:-4px; right:-4px; background:#F58D02; color:#fff; border-radius:50%; min-width:18px; height:18px; font-size:11px; font-weight:700; align-items:center; justify-content:center; line-height:1; padding:0 4px;"></span>
                        </a>
                    @endauth
                    @guest
                        @if(in_array(Route::currentRouteName(), $showImageRoutes))
                            <a href="{{ route('chat.index') }}">
                                <img src="/assets/images/Frame 1707481624.png" alt="Logo">
                            </a>
                        @endif
                    @endguest
                    <a href="{{ route('buy.step1') }}" style="text-decoration: none; color: inherit;">
                        <div class="logo-o">
                            Buy
                            <span class="speed-line"></span>
                        </div>
                    </a>
                    <a href="{{ route('sell') }}" style="text-decoration: none; color: inherit;">
                        <div class="logo-o">
                            Sell
                            <span class="speed-line"></span>
                        </div>
                    </a>
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
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="userDropdown">
                                    <img src="{{ $userInfo->avatar ?? asset('/assets/images/defaultdealerlogo.png') }}" 
                                        class="img-fluid" 
                                        alt="User Avatar"
                                        style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                </a>
                                <ul class="dropdown-menu nav-drop dropdown-menu-end" aria-labelledby="userDropdown">
    
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('profile.settings') ? 'active-link' : '' }}"
                                        href="{{ route('profile.settings') }}">
                                            <i class="fa-solid fa-user me-2"></i> My Profile
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('agent.dashboard') ? 'active-link' : '' }}"
                                        href="{{ route('agent.dashboard') }}">
                                            <i class="fa-solid fa-gauge-high me-2"></i> Dashboard
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('listings') ? 'active-link' : '' }}"
                                        href="{{ route('listings') }}">
                                            <i class="fa-solid fa-car me-2"></i> Listings
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('add.listings') ? 'active-link' : '' }}"
                                        href="{{ route('add.listings') }}">
                                            <i class="fa-solid fa-plus me-2"></i> Add Listing
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('wishlist') ? 'active-link' : '' }}"
                                        href="{{ route('wishlist', ['u' => auth()->id()]) }}">
                                            <i class="fa-solid fa-heart me-2"></i> My Wishlist
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('account.settings') ? 'active-link' : '' }}"
                                        href="{{ route('account.settings') }}">
                                            <i class="fa-solid fa-gear me-2"></i> Account Settings
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('chat.index') ? 'active-link' : '' }}"
                                        href="{{ route('chat.index') }}"
                                        style="display:flex; align-items:center; justify-content:space-between;">
                                            <span><i class="fa-regular fa-comment me-2"></i> Messages</span>
                                            <span id="dropdownUnreadBadge" style="display:none; background:#F58D02; color:#fff; border-radius:50%; min-width:20px; height:20px; font-size:11px; font-weight:700; align-items:center; justify-content:center; padding:0 4px;"></span>
                                        </a>
                                    </li>

                                    <li><hr class="dropdown-divider"></li>

                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                                            </button>
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
                                            <i class="fa fa-sign-in-alt me-2"></i> Login
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#testDriveModal" data-title="Support">
                                            <i class="fa fa-headset me-2"></i> Support
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('signup') ? 'active-link' : '' }}"
                                            href="{{ route('signup') }}">
                                            <i class="fa fa-user-plus me-2"></i> Register
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
</headerx>
@include('partials.support-modal')
@auth

<script>
(function () {
    var badge = document.getElementById('chatUnreadBadge');
    if (!badge) return;

    function updateBadge() {
        fetch('/chat/unread-count', {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            var count = data.count || 0;
            // Header icon badge
            var badge = document.getElementById('chatUnreadBadge');
            if (badge) {
                if (count > 0) {
                    badge.textContent = count > 99 ? '99+' : count;
                    badge.style.display = 'inline-flex';
                } else {
                    badge.style.display = 'none';
                }
            }
            // Dropdown badge
            var dropBadge = document.getElementById('dropdownUnreadBadge');
            if (dropBadge) {
                if (count > 0) {
                    dropBadge.textContent = count > 99 ? '99+' : count;
                    dropBadge.style.display = 'inline-flex';
                } else {
                    dropBadge.style.display = 'none';
                }
            }
            // Sidebar conversation badges (chat page)
            if (data.conversations) {
                document.querySelectorAll('.conv-unread-badge').forEach(function(el) {
                    var key = el.getAttribute('data-conv');
                    var c = data.conversations[key] || 0;
                    if (c > 0) {
                        el.textContent = c > 99 ? '99+' : c;
                        el.style.display = 'inline-flex';
                    } else {
                        el.style.display = 'none';
                    }
                });
            }
        })
        .catch(function() {});
    }

    updateBadge();
    // On chat page, this polling is redundant — chat.blade.php handles badges itself
    if (!window.location.pathname.startsWith('/chat/')) {
        setInterval(updateBadge, 30000);
    }
})();
</script>

@endauth


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