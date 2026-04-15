<!DOCTYPE html>
<html>

<head>
    <title>Motokloz</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-title" content="Motokloz" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Anime JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user-auth.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=Lato:wght@100..900&family=Vend+Sans:wght@300..700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@100..900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Widgets Div Place Here -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">


</head>

<body @yield('body-attrs')>
    <!-- Premium Page Loader -->
    <div id="page-loader">
        <!-- Ambient glow orbs -->
        <div class="mto-orb mto-orb-1"></div>
        <div class="mto-orb mto-orb-2"></div>

        <div class="mto-loader-box">

            <!-- Speedometer SVG -->
            <div class="mto-speedo-wrap">
                <svg class="mto-speedo" viewBox="0 0 160 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <filter id="glow-orange">
                            <feGaussianBlur stdDeviation="3" result="blur" />
                            <feMerge>
                                <feMergeNode in="blur" />
                                <feMergeNode in="SourceGraphic" />
                            </feMerge>
                        </filter>
                        <filter id="glow-needle">
                            <feGaussianBlur stdDeviation="2" result="blur" />
                            <feMerge>
                                <feMergeNode in="blur" />
                                <feMergeNode in="SourceGraphic" />
                            </feMerge>
                        </filter>
                        <linearGradient id="arcGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#ff6a00" />
                            <stop offset="100%" stop-color="#ffcc00" />
                        </linearGradient>
                    </defs>

                    <!-- Outer ring -->
                    <circle cx="80" cy="90" r="72" stroke="#111" stroke-width="1.5" stroke-dasharray="4 6"
                        opacity="0.6" />

                    <!-- Track arc (background) -->
                    <path d="M18 90 A65 65 0 0 1 142 90" stroke="#1c1c1c" stroke-width="10" stroke-linecap="round" />

                    <!-- Glow arc (blur layer) -->
                    <path class="mto-speedo-glow" d="M18 90 A65 65 0 0 1 142 90" stroke="#ff9d00" stroke-width="14"
                        stroke-linecap="round" opacity="0.15" stroke-dasharray="204" stroke-dashoffset="204" />

                    <!-- Main fill arc -->
                    <path class="mto-speedo-fill" d="M18 90 A65 65 0 0 1 142 90" stroke="url(#arcGrad)"
                        stroke-width="10" stroke-linecap="round" stroke-dasharray="204" stroke-dashoffset="204"
                        filter="url(#glow-orange)" />

                    <!-- Tick marks — mathematically placed on arc circumference -->
                    <!-- Arc goes from -60deg to +60deg (left to right), center at 80,90, radius 65 -->
                    <!-- -60deg -->
                    <line x1="80" y1="25" x2="80" y2="33" stroke="#444" stroke-width="2"
                        transform="rotate(-60 80 90)" />
                    <!-- -45deg -->
                    <line x1="80" y1="25" x2="80" y2="30" stroke="#333" stroke-width="1.5"
                        transform="rotate(-45 80 90)" />
                    <!-- -30deg -->
                    <line x1="80" y1="25" x2="80" y2="33" stroke="#444" stroke-width="2"
                        transform="rotate(-30 80 90)" />
                    <!-- -15deg -->
                    <line x1="80" y1="25" x2="80" y2="30" stroke="#333" stroke-width="1.5"
                        transform="rotate(-15 80 90)" />
                    <!--   0deg -->
                    <line x1="80" y1="25" x2="80" y2="33" stroke="#444" stroke-width="2" transform="rotate(0 80 90)" />
                    <!-- +15deg -->
                    <line x1="80" y1="25" x2="80" y2="30" stroke="#333" stroke-width="1.5"
                        transform="rotate(15 80 90)" />
                    <!-- +30deg -->
                    <line x1="80" y1="25" x2="80" y2="33" stroke="#444" stroke-width="2" transform="rotate(30 80 90)" />
                    <!-- +45deg -->
                    <line x1="80" y1="25" x2="80" y2="30" stroke="#333" stroke-width="1.5"
                        transform="rotate(45 80 90)" />
                    <!-- +60deg -->
                    <line x1="80" y1="25" x2="80" y2="33" stroke="#444" stroke-width="2" transform="rotate(60 80 90)" />

                    <!-- Needle group — rotates around pivot (80,90) -->
                    <g class="mto-needle-group" filter="url(#glow-needle)">
                        <!-- Needle tail -->
                        <line x1="80" y1="90" x2="80" y2="100" stroke="#ff6a00" stroke-width="2" stroke-linecap="round"
                            opacity="0.6" />
                        <!-- Needle body -->
                        <line x1="80" y1="90" x2="80" y2="30" stroke="#ff9d00" stroke-width="2.5"
                            stroke-linecap="round" />
                        <!-- Needle tip glow dot -->
                        <circle cx="80" cy="30" r="2" fill="#ffcc00" opacity="0.9" />
                    </g>

                    <!-- Center hub outer -->
                    <circle cx="80" cy="90" r="7" fill="#1a1a1a" stroke="#ff9d00" stroke-width="1.5" />
                    <!-- Center hub inner -->
                    <circle cx="80" cy="90" r="3.5" fill="#ff9d00" />
                    <circle cx="80" cy="90" r="1.5" fill="#000" />
                </svg>

                <!-- Speed value display -->
                <div class="mto-speed-val"><span class="mto-speed-num">0</span><span class="mto-speed-unit">km/h</span>
                </div>
            </div>

            <!-- Brand name with letter animation -->
            <div class="mto-loader-brand">
                <span style="--i:0">M</span><span class="mto-orange" style="--i:1">O</span><span
                    style="--i:2">T</span><span style="--i:3">O</span><span style="--i:4">K</span><span
                    style="--i:5">L</span><span style="--i:6">O</span><span style="--i:7">Z</span>
            </div>

            <!-- Progress bar -->
            <div class="mto-progress-wrap">
                <div class="mto-progress-bar"></div>
            </div>
        </div>
    </div>
    <div id="snackbar"></div>
    <style>
        #page-loader {
            position: fixed;
            inset: 0;
            background: radial-gradient(ellipse at center, #0d0d0d 0%, #000 70%);
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.35s ease, visibility 0.35s ease;
            overflow: hidden;
        }

        /* Hide gtranslate & any fixed widgets behind loader when active */
        #page-loader.active~* .gtranslate_wrapper,
        #page-loader.active~* [class*="gt_"],
        body.loader-active .gtranslate_wrapper,
        body.loader-active [class*="gt_"],
        body.loader-active [id*="gt_"] {
            z-index: 1 !important;
            visibility: hidden !important;
        }

        #page-loader.active {
            opacity: 1;
            visibility: visible;
        }

        /* Ambient orbs */
        .mto-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
        }

        .mto-orb-1 {
            width: 300px;
            height: 300px;
            background: rgba(255, 157, 0, 0.07);
            top: -80px;
            left: -80px;
            animation: mto-orb-float 4s ease-in-out infinite alternate;
        }

        .mto-orb-2 {
            width: 250px;
            height: 250px;
            background: rgba(255, 100, 0, 0.05);
            bottom: -60px;
            right: -60px;
            animation: mto-orb-float 5s ease-in-out infinite alternate-reverse;
        }

        @keyframes mto-orb-float {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(30px, 20px);
            }
        }

        /* Loader box */
        .mto-loader-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            position: relative;
            z-index: 1;
        }

        /* Speedometer wrap */
        .mto-speedo-wrap {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .mto-speedo {
            width: 180px;
            height: 125px;
        }

        /* Arc animations */
        .mto-speedo-fill {
            animation: mto-sweep 1.8s cubic-bezier(0.4, 0, 0.2, 1) infinite alternate;
        }

        .mto-speedo-glow {
            animation: mto-sweep 1.8s cubic-bezier(0.4, 0, 0.2, 1) infinite alternate;
        }

        @keyframes mto-sweep {
            0% {
                stroke-dashoffset: 204;
            }

            100% {
                stroke-dashoffset: 0;
            }
        }

        /* Needle */
        .mto-needle-group {
            transform-origin: 80px 90px;
            animation: mto-needle 1.8s cubic-bezier(0.4, 0, 0.2, 1) infinite alternate;
        }

        @keyframes mto-needle {
            0% {
                transform: rotate(-60deg);
            }

            100% {
                transform: rotate(60deg);
            }
        }

        /* Speed value */
        .mto-speed-val {
            margin-top: -8px;
            display: flex;
            align-items: baseline;
            gap: 3px;
        }

        .mto-speed-num {
            font-family: 'Urbanist', sans-serif;
            font-size: 28px;
            font-weight: 800;
            color: #ff9d00;
            min-width: 42px;
            text-align: right;
            line-height: 1;
        }

        .mto-speed-unit {
            font-family: 'Urbanist', sans-serif;
            font-size: 11px;
            font-weight: 500;
            color: #555;
            letter-spacing: 1px;
        }

        /* Brand */
        .mto-loader-brand {
            font-family: 'Urbanist', sans-serif;
            font-size: 24px;
            font-weight: 900;
            letter-spacing: 6px;
            color: #fff;
            text-transform: uppercase;
            display: flex;
        }

        .mto-loader-brand span {
            display: inline-block;
            animation: mto-letter-pulse 1.8s ease-in-out infinite alternate;
            animation-delay: calc(var(--i) * 0.08s);
        }

        @keyframes mto-letter-pulse {
            0% {
                opacity: 0.3;
                transform: translateY(0);
            }

            100% {
                opacity: 1;
                transform: translateY(-3px);
            }
        }

        .mto-orange {
            color: #ff9d00;
        }

        /* Progress bar */
        .mto-progress-wrap {
            width: 160px;
            height: 3px;
            background: #1a1a1a;
            border-radius: 99px;
            overflow: hidden;
        }

        .mto-progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #ff6a00, #ffcc00);
            border-radius: 99px;
            animation: mto-progress 1.8s ease-in-out infinite alternate;
            box-shadow: 0 0 8px rgba(255, 157, 0, 0.6);
        }

        @keyframes mto-progress {
            0% {
                width: 0%;
            }

            100% {
                width: 100%;
            }
        }
    </style>

    <script>
        (function () {
            var loader = document.getElementById('page-loader');

            // Disable loader entirely on pages that opt out
            if (document.body.dataset.noLoader) {
                loader.style.display = 'none';
                return;
            }

            var numEl = loader.querySelector('.mto-speed-num');
            var rafId = null;
            var current = 0;
            var target = 0;

            /* Animate speed counter in sync with needle */
            function animateSpeed() {
                current += (target - current) * 0.12;
                if (numEl) numEl.textContent = Math.round(current);
                rafId = requestAnimationFrame(animateSpeed);
            }

            function startCounter() {
                var dir = 1;
                target = 180;
                animateSpeed();
                setInterval(function () {
                    dir *= -1;
                    target = dir > 0 ? 180 : 0;
                }, 1800);
            }

            // Page load pe bhi show karo
            loader.classList.add('active');
            document.body.classList.add('loader-active');
            startCounter();

            window.addEventListener('load', function () {
                setTimeout(function () {
                    loader.classList.remove('active');
                    document.body.classList.remove('loader-active');
                    cancelAnimationFrame(rafId);
                    current = 0; target = 0;
                    if (numEl) numEl.textContent = '0';
                }, 600);
            });

            // Form submit pe bhi show karo
            document.addEventListener('submit', function (e) {
                var form = e.target;
                if (form.dataset.ajax || form.dataset.noLoader) return;
                loader.classList.add('active');
                document.body.classList.add('loader-active');
                startCounter();
            });

            // Link click pe bhi show karo
            document.addEventListener('click', function (e) {
                var anchor = e.target.closest('a');
                if (!anchor) return;
                var href = anchor.getAttribute('href');
                if (!href || href === '#' || href.startsWith('#') ||
                    href.startsWith('javascript') || anchor.target === '_blank') return;
                loader.classList.add('active');
                document.body.classList.add('loader-active');
                startCounter();
            });

            window.addEventListener('pageshow', function (e) {
                if (e.persisted) {
                    loader.classList.remove('active');
                    document.body.classList.remove('loader-active');
                    cancelAnimationFrame(rafId);
                    current = 0; target = 0;
                    if (numEl) numEl.textContent = '0';
                }
            });
        })();
    </script>
    @include('partials.header')

    <!-- Professional Image Lightbox -->
    <div id="mto-lightbox" role="dialog" aria-modal="true" aria-label="Image preview">
        <div class="mto-lb-backdrop"></div>
        <div class="mto-lb-container">
            <!-- Top bar -->
            <div class="mto-lb-topbar">
                <span class="mto-lb-counter">1 / 1</span>
                <div class="mto-lb-actions">
                    <button class="mto-lb-btn" id="mto-lb-zoomin" title="Zoom In">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            <line x1="11" y1="8" x2="11" y2="14" />
                            <line x1="8" y1="11" x2="14" y2="11" />
                        </svg>
                    </button>
                    <button class="mto-lb-btn" id="mto-lb-zoomout" title="Zoom Out">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            <line x1="8" y1="11" x2="14" y2="11" />
                        </svg>
                    </button>
                    <button class="mto-lb-btn" id="mto-lb-reset" title="Reset Zoom">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                            <path d="M3 3v5h5" />
                        </svg>
                    </button>
                    <button class="mto-lb-btn mto-lb-close" id="mto-lb-close" title="Close">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Image stage -->
            <div class="mto-lb-stage" id="mto-lb-stage">
                <button class="mto-lb-arrow mto-lb-prev" id="mto-lb-prev">&#8249;</button>
                <div class="mto-lb-img-wrap" id="mto-lb-img-wrap">
                    <img id="mto-lb-img" src="" alt="Preview" draggable="false">
                </div>
                <button class="mto-lb-arrow mto-lb-next" id="mto-lb-next">&#8250;</button>
            </div>

            <!-- Zoom bar -->
            <div class="mto-lb-zoombar">
                <span class="mto-lb-zoom-pct" id="mto-lb-zoom-pct">100%</span>
                <input type="range" id="mto-lb-zoom-slider" min="50" max="400" value="100" step="5">
            </div>
        </div>
    </div>

    <style>
        /* ===================== Snackbar Base ===================== */
        #snackbar {
            visibility: hidden;
            min-width: 320px;
            max-width: 90%;
            background-color: #333;
            color: #fff;
            text-align: left;
            border-radius: 12px;
            padding: 16px 20px;
            position: fixed;
            z-index: 9999;
            left: 50%;
            bottom: 30px;
            transform: translateX(-50%) translateY(20px);
            font-size: 15px;
            font-weight: 500;
            opacity: 0;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.4s ease;
            pointer-events: none;
            /* Prevent clicks while hidden */
        }

        /* ===================== Show State ===================== */
        #snackbar.show {
            visibility: visible;
            opacity: 1;
            transform: translateX(-50%) translateY(0);
            pointer-events: auto;
            /* Allow interactions */
        }

        /* ===================== Variants ===================== */
        #snackbar.success {
            background-color: #ff9d00;
            /* Green */
        }

        #snackbar.error {
            background-color: #ff9d00;
            /* Red */
        }

        #snackbar.warning {
            background-color: #ffc107;
            /* Yellow */
            color: #212529;
        }

        /* ===================== Icon ===================== */
        #snackbar::before {
            content: '';
            display: inline-block;
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.3);
        }

        /* Icons for different types */
        #snackbar.success::before {
            background-color: rgba(255, 255, 255, 0.5);
            mask: url('data:image/svg+xml;utf8,<svg fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M13.485 1.929l-7.778 7.778-3.182-3.182-1.06 1.06 4.242 4.242 8.838-8.838-1.06-1.06z"/></svg>') no-repeat center / contain;
            -webkit-mask: url(...) no-repeat center / contain;
        }

        #snackbar.error::before {
            background-color: rgba(255, 255, 255, 0.5);
            mask: url('data:image/svg+xml;utf8,<svg fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M4.646 4.646l6.708 6.708m0-6.708l-6.708 6.708"/></svg>') no-repeat center / contain;
            -webkit-mask: url(...) no-repeat center / contain;
        }

        #snackbar.warning::before {
            background-color: rgba(0, 0, 0, 0.5);
            mask: url('data:image/svg+xml;utf8,<svg fill="black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M8 1l7 14H1L8 1zm0 10v-4m0 6v-2"/></svg>') no-repeat center / contain;
            -webkit-mask: url(...) no-repeat center / contain;
        }

        /* Lightbox overlay */
        #mto-lightbox {
            position: fixed;
            inset: 0;
            z-index: 9999999;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .gtranslate_wrapper.gt_container--c8la1f {
            z-index: 99;
        }

        #mto-lightbox.open {
            display: flex;
        }

        .mto-lb-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.92);
            backdrop-filter: blur(6px);
        }

        .mto-lb-container {
            position: relative;
            z-index: 1;
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top bar */
        .mto-lb-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 20px;
            background: rgba(0, 0, 0, 0.6);
            border-bottom: 1px solid rgba(255, 157, 0, 0.15);
        }

        .mto-lb-counter {
            font-family: 'Urbanist', sans-serif;
            font-size: 13px;
            color: #aaa;
            letter-spacing: 1px;
        }

        .mto-lb-actions {
            display: flex;
            gap: 6px;
        }

        .mto-lb-btn {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            cursor: pointer;
            color: #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, color 0.2s;
        }

        .mto-lb-btn svg {
            width: 16px;
            height: 16px;
        }

        .mto-lb-btn:hover {
            background: #ff9d00;
            color: #000;
            border-color: #ff9d00;
        }

        .mto-lb-close:hover {
            background: #e53e3e;
            border-color: #e53e3e;
            color: #fff;
        }

        /* Stage */
        .mto-lb-stage {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .mto-lb-img-wrap {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            cursor: grab;
        }

        .mto-lb-img-wrap.dragging {
            cursor: grabbing;
        }

        #mto-lb-img {
            max-width: 90%;
            max-height: 80vh;
            object-fit: contain;
            transform-origin: center center;
            transition: transform 0.2s ease;
            user-select: none;
            pointer-events: none;
            border-radius: 12px;
        }

        /* Arrows */
        .mto-lb-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 157, 0, 0.3);
            color: #ff9d00;
            font-size: 36px;
            line-height: 1;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, border-color 0.2s;
        }

        .mto-lb-arrow:hover {
            background: #ff9d00;
            color: #000;
            border-color: #ff9d00;
        }

        .mto-lb-prev {
            left: 16px;
        }

        .mto-lb-next {
            right: 16px;
        }

        /* Zoom bar */
        .mto-lb-zoombar {
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: center;
            padding: 10px 20px;
            background: rgba(0, 0, 0, 0.6);
            border-top: 1px solid rgba(255, 157, 0, 0.1);
        }

        .mto-lb-zoom-pct {
            font-family: 'Urbanist', sans-serif;
            font-size: 12px;
            color: #ff9d00;
            min-width: 40px;
            text-align: center;
        }

        #mto-lb-zoom-slider {
            width: 160px;
            accent-color: #ff9d00;
            cursor: pointer;
        }

        /* Fade in animation */
        @keyframes mto-lb-in {
            from {
                opacity: 0;
                transform: scale(0.96);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        #mto-lightbox.open .mto-lb-container {
            animation: mto-lb-in 0.2s ease;
        }
    </style>

    <script>
        (function () {
            var lb = document.getElementById('mto-lightbox');
            var lbImg = document.getElementById('mto-lb-img');
            var lbWrap = document.getElementById('mto-lb-img-wrap');
            var lbCounter = lb.querySelector('.mto-lb-counter');
            var lbZoomPct = document.getElementById('mto-lb-zoom-pct');
            var lbSlider = document.getElementById('mto-lb-zoom-slider');

            var images = [], currentIdx = 0, scale = 1;
            var dragStart = null, imgOffset = { x: 0, y: 0 }, imgPos = { x: 0, y: 0 };

            function collectImages() {
                images = Array.from(document.querySelectorAll('.mto-lightbox-trigger'));
            }

            function setScale(s) {
                scale = Math.min(Math.max(s, 0.5), 4);
                lbImg.style.transform = 'translate(' + imgPos.x + 'px,' + imgPos.y + 'px) scale(' + scale + ')';
                lbZoomPct.textContent = Math.round(scale * 100) + '%';
                lbSlider.value = Math.round(scale * 100);
            }

            function resetTransform() {
                imgPos = { x: 0, y: 0 };
                setScale(1);
            }

            function open(idx) {
                collectImages();
                currentIdx = idx;
                var src = images[idx].dataset.full || images[idx].src;
                lbImg.src = src;
                lbCounter.textContent = (idx + 1) + ' / ' + images.length;
                resetTransform();
                lb.classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            function close() {
                lb.classList.remove('open');
                document.body.style.overflow = '';
                lbImg.src = '';
            }

            function prev() { if (images.length < 2) return; currentIdx = (currentIdx - 1 + images.length) % images.length; open(currentIdx); }
            function next() { if (images.length < 2) return; currentIdx = (currentIdx + 1) % images.length; open(currentIdx); }

            // Delegate click on trigger images
            document.addEventListener('click', function (e) {
                var trigger = e.target.closest('.mto-lightbox-trigger');
                if (!trigger) return;
                collectImages();
                var idx = images.indexOf(trigger);
                open(idx >= 0 ? idx : 0);
            });

            document.getElementById('mto-lb-close').addEventListener('click', close);
            lb.querySelector('.mto-lb-backdrop').addEventListener('click', close);
            document.getElementById('mto-lb-prev').addEventListener('click', prev);
            document.getElementById('mto-lb-next').addEventListener('click', next);

            // Zoom buttons
            document.getElementById('mto-lb-zoomin').addEventListener('click', function () { setScale(scale + 0.25); });
            document.getElementById('mto-lb-zoomout').addEventListener('click', function () { setScale(scale - 0.25); });
            document.getElementById('mto-lb-reset').addEventListener('click', resetTransform);

            // Zoom slider
            lbSlider.addEventListener('input', function () { setScale(parseInt(this.value) / 100); });

            // Mouse wheel zoom
            lbWrap.addEventListener('wheel', function (e) {
                e.preventDefault();
                setScale(scale + (e.deltaY < 0 ? 0.1 : -0.1));
            }, { passive: false });

            // Drag to pan
            lbWrap.addEventListener('mousedown', function (e) {
                if (scale <= 1) return;
                dragStart = { x: e.clientX - imgPos.x, y: e.clientY - imgPos.y };
                lbWrap.classList.add('dragging');
            });
            document.addEventListener('mousemove', function (e) {
                if (!dragStart) return;
                imgPos.x = e.clientX - dragStart.x;
                imgPos.y = e.clientY - dragStart.y;
                lbImg.style.transform = 'translate(' + imgPos.x + 'px,' + imgPos.y + 'px) scale(' + scale + ')';
            });
            document.addEventListener('mouseup', function () {
                dragStart = null;
                lbWrap.classList.remove('dragging');
            });

            // Touch pinch zoom
            var lastDist = 0;
            lbWrap.addEventListener('touchstart', function (e) {
                if (e.touches.length === 2) {
                    lastDist = Math.hypot(e.touches[0].clientX - e.touches[1].clientX, e.touches[0].clientY - e.touches[1].clientY);
                }
            });
            lbWrap.addEventListener('touchmove', function (e) {
                if (e.touches.length === 2) {
                    e.preventDefault();
                    var dist = Math.hypot(e.touches[0].clientX - e.touches[1].clientX, e.touches[0].clientY - e.touches[1].clientY);
                    setScale(scale * (dist / lastDist));
                    lastDist = dist;
                }
            }, { passive: false });

            // Keyboard
            document.addEventListener('keydown', function (e) {
                if (!lb.classList.contains('open')) return;
                if (e.key === 'Escape') close();
                if (e.key === 'ArrowLeft') prev();
                if (e.key === 'ArrowRight') next();
                if (e.key === '+' || e.key === '=') setScale(scale + 0.25);
                if (e.key === '-') setScale(scale - 0.25);
                if (e.key === '0') resetTransform();
            });
        })();

        function showSnackbar(message, type = 'success', duration = 5000) {
            const snackbar = document.getElementById('snackbar');
            snackbar.textContent = message;

            // Reset classes
            snackbar.className = '';
            snackbar.classList.add(type, 'show');

            // Hide after duration
            setTimeout(() => {
                snackbar.classList.remove('show');
            }, duration);
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            gsap.registerPlugin(ScrollTrigger);

            function animateCards(container, cardSelector) {

                let cards = document.querySelectorAll(container + " " + cardSelector);

                if (!cards.length) return;

                gsap.fromTo(cards,
                    {
                        y: 100,
                        opacity: 0,
                        scale: 0.95
                    },
                    {
                        y: 0,
                        opacity: 1,
                        scale: 1,
                        duration: 0.9,
                        ease: "power3.out",
                        stagger: 0.15,
                        scrollTrigger: {
                            trigger: container,
                            start: "top 80%",   // 👈 jab section viewport me aaye
                            end: "bottom 60%",
                            toggleActions: "play none none none",
                            once: true          // 👈 sirf 1 dafa chale
                        }
                    }
                );
            }

            // ✅ dono sections
            animateCards("#vehicleContainer", ".vehicle-card");
            animateCards("#inventoryContainer", ".dealer-vehicle-card");

        });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        // You can also pass an optional settings object
        // below listed default settings
        AOS.init({
            // Global settings:
            disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
            startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
            initClassName: 'aos-init', // class applied after initialization
            animatedClassName: 'aos-animate', // class applied on animation
            useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
            disableMutationObserver: false, // disables automatic mutations' detections (advanced)
            debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
            throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)


            // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
            offset: 300, // offset (in px) from the original trigger point
            delay: 0, // values from 0 to 3000, with step 50ms
            duration: 1000, // values from 0 to 3000, with step 50ms
            easing: 'ease', // default easing for AOS animations
            once: true, // whether animation should happen only once - while scrolling down
            mirror: false, // whether elements should animate out while scrolling past them
            anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

        });
    </script>

    @yield('content')
    @include('partials.footer')
    @include('partials.script')
    @include('partials.login-modal')
</body>

</html>