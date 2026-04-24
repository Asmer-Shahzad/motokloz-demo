{{-- <!-- Scroll Button with Dynamic Arrow -->
<button id="scrollTopBtn" class="btn rounded-circle">
    ↑
</button>

<style>
    #scrollTopBtn {
        position: fixed;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        z-index: 1000;
        background-color: #F58D02;
        color: white;
        font-size: 24px;
        width: 50px;
        height: 50px;
        border: none;
        display: none;
        cursor: pointer;

        /* Smooth fade-in/out */
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    #scrollTopBtn.show {
        display: block;
        opacity: 1;
    }

    #scrollTopBtn:hover {
        transform: translateY(-50%) scale(1.1);
    }
</style>

<script>
    const scrollBtn = document.getElementById('scrollTopBtn');
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.scrollY;

        // Show/hide button after 100px
        if (currentScroll > 100) {
            scrollBtn.classList.add('show');
        } else {
            scrollBtn.classList.remove('show');
        }

        // Arrow direction: down scroll → ↑ (scroll to top)
        //                  up scroll → ↓ (scroll to bottom)
        if (currentScroll > lastScroll) {
            scrollBtn.textContent = '↑'; // scrolling down
        } else if (currentScroll < lastScroll) {
            scrollBtn.textContent = '↓'; // scrolling up
        }

        lastScroll = currentScroll <= 0 ? 0 : currentScroll;
    });

    // Scroll behavior on click
    scrollBtn.addEventListener('click', () => {
        if (scrollBtn.textContent === '↑') {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        } else {
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });
        }
    });
</script> --}}


<!-- Scroll Button with VIP Animation -->
<button id="scrollTopBtn" class="btn rounded-circle" aria-label="Scroll to top or bottom">
    ↑
</button>

<style>
    #scrollTopBtn {
        position: fixed;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        z-index: 1000;
        /* Premium gold gradient */
        background: #f58d02;
        color: #fff;
        font-size: 28px;
        font-weight: bold;
        width: 56px;
        height: 56px;
        border: none;
        border-radius: 50%;
        display: none;
        cursor: pointer;
        box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4), 0 0 0 2px rgba(255, 215, 0, 0.2);
        opacity: 0;
        transition: opacity 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275),
            transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275),
            box-shadow 0.3s ease;
        backdrop-filter: blur(2px);
        line-height: 1;
    }

    #scrollTopBtn.show {
        display: block;
        opacity: 1;
        animation: vipAppear 0.5s ease-out forwards;
    }

    @keyframes vipAppear {
        0% {
            transform: translateY(-50%) scale(0.8);
            opacity: 0;
            box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.6);
        }

        50% {
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 0 20px 10px rgba(212, 175, 55, 0.5);
        }

        100% {
            transform: translateY(-50%) scale(1);
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4), 0 0 0 2px rgba(255, 215, 0, 0.2);
        }
    }

    /* #scrollTopBtn:hover {
        transform: translateY(-50%) scale(1.15);
        box-shadow: 0 12px 28px rgba(212, 175, 55, 0.7), 0 0 0 4px rgba(255, 215, 0, 0.3);
        background: linear-gradient(135deg, #ffefb0 0%, #e5c100 50%, #c5a028 100%);
    } */

    /* Direction change with subtle rotation */
    #scrollTopBtn.changed {
        animation: arrowFlip 0.3s ease;
    }

    @keyframes arrowFlip {
        0% {
            transform: translateY(-50%) rotate(0deg);
        }

        50% {
            transform: translateY(-50%) rotate(180deg);
            opacity: 0.7;
        }

        100% {
            transform: translateY(-50%) rotate(360deg);
        }
    }
</style>

<script>
    const scrollBtn = document.getElementById('scrollTopBtn');
    let lastScroll = 0;
    let directionChanged = false;

    window.addEventListener('scroll', () => {
        const currentScroll = window.scrollY;

        // Show/hide with threshold
        if (currentScroll > 100) {
            if (!scrollBtn.classList.contains('show')) {
                scrollBtn.classList.add('show');
            }
        } else {
            scrollBtn.classList.remove('show');
        }

        // Determine direction and update arrow + trigger flip animation
        if (currentScroll > lastScroll && currentScroll > 100) {
            // Scrolling down → show up arrow
            if (scrollBtn.textContent !== '↑') {
                scrollBtn.textContent = '↑';
                triggerFlip();
            }
        } else if (currentScroll < lastScroll && currentScroll > 100) {
            // Scrolling up → show down arrow
            if (scrollBtn.textContent !== '↓') {
                scrollBtn.textContent = '↓';
                triggerFlip();
            }
        }

        lastScroll = currentScroll <= 0 ? 0 : currentScroll;
    });

    function triggerFlip() {
        scrollBtn.classList.add('changed');
        setTimeout(() => {
            scrollBtn.classList.remove('changed');
        }, 300);
    }

    // Click action: top or bottom
    scrollBtn.addEventListener('click', () => {
        if (scrollBtn.textContent === '↑') {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else {
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        }
    });
</script>
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

    toggleBtn.addEventListener("click", function () {

        document.body.classList.toggle("dark-mode");

        if (document.body.classList.contains("dark-mode")) {
            icon.src = "/assets/images/lightmood.png";
            localStorage.setItem("theme", "dark");
        } else {
            icon.src = "/assets/images/darkmood.png";
            localStorage.setItem("theme", "light");
        }

    });

    // Page load par state restore
    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark-mode");
        icon.src = "/assets/images/lightmood.png";
    }
</script>
<script>
    $(document).ready(function () {

        $('.tab').click(function () {
            $('.tab').removeClass('active');
            $(this).addClass('active');
        });

        $('#priceRange').on('input', function () {
            $('#priceVal').text('10,000 - 12,000');
        });

    });
</script>
{{--
<script>
    window.gtranslateSettings = {
        "default_language": "en",
        "native_language_names": true,
        "detect_browser_language": true,
        "wrapper_selector": ".gtranslate_wrapper",
        "flag_style": "3d"
    };
</script>
<script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script> --}}

<script>
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 7,
    spaceBetween: 20,
    loop: true,

    // ✅ CUSTOM BUTTONS (IMPORTANT CHANGE)
    navigation: {
        nextEl: '.next-btn',
        prevEl: '.prev-btn',
    },


    autoplay:false, // Disable default autoplay to use freeMode for continuous sliding

    freeMode: true,
    freeModeMomentum: false,

    grabCursor: true,

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
    var swiper = new Swiper(".review-swiper", {
        slidesPerView: 1.2, // Mobile par ek poora aur ek thoda sa dikhega
        centeredSlides: true, // Main card hamesha beech mein rahega
        spaceBetween: 20,
        loop: true, // Is se side wale empty nahi lagenge
        breakpoints: {
            640: {
                slidesPerView: 2.5,
            },
            1024: {
                slidesPerView: 3.5, // Desktop par side wale cards cut honge (jaisa image mein tha)
            },
        },
    });
    // const reviewSwiper = new Swiper(".review-swiper", {
    //     slidesPerView: 3,
    //     spaceBetween: 30,

    //     loop: true,
    //     speed: 5000,

    //     autoplay: {
    //         delay: 0,
    //         disableOnInteraction: false,
    //     },

    //     breakpoints: {
    //         0: {
    //             slidesPerView: 1.2
    //         },
    //         768: {
    //             slidesPerView: 2
    //         },
    //         1024: {
    //             slidesPerView: 4
    //         },
    //     }
    // });

    // hover pause
    const reviewEl = document.querySelector('.review-swiper');
    reviewEl.addEventListener('mouseenter', () => reviewSwiper.autoplay.stop());
    reviewEl.addEventListener('mouseleave', () => reviewSwiper.autoplay.start());
</script>

<script>
    $(document).ready(function () {

        // 1. Initialize Thumbnail Slider First
        var galleryThumbs = new Swiper(".thumb-strip-slider", {
            spaceBetween: 15,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
            slideToClickedSlide: true, // Fixes the last thumbnail click issue
            breakpoints: {
                768: {
                    slidesPerView: 5
                },
                1200: {
                    slidesPerView: 7
                }
            }
        });

        // 2. Initialize Main Slider (Linked with Thumbs)
        var galleryMain = new Swiper(".main-gallery-slider", {
            loop: true,
            spaceBetween: 0,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: galleryThumbs,
            },
        });

        // Error Handling: Preventing 'null' reading error (image_983c05.png)
        const reviewEl = document.querySelector('.review-swiper');
        if (reviewEl) {
            reviewEl.addEventListener('mouseenter', function () {
                if (typeof reviewSwiper !== 'undefined') reviewSwiper.autoplay.stop();
            });
            reviewEl.addEventListener('mouseleave', function () {
                if (typeof reviewSwiper !== 'undefined') reviewSwiper.autoplay.start();
            });
        }

    });
</script>
<script>
    $(document).ready(function () {

        // 1. Fixing the console error (Safety Check)
        // Yeh check karta hai ke element page par hai ya nahi
        const reviewTarget = document.querySelector('.review-swiper');

        if (reviewTarget && typeof reviewSwiper !== 'undefined') {
            reviewTarget.addEventListener('mouseenter', () => reviewSwiper.autoplay.stop());
            reviewTarget.addEventListener('mouseleave', () => reviewSwiper.autoplay.start());
        }

        // 2. Custom Stack (Accordion) Toggle Logic
        $('.mto-stack-trigger').on('click', function () {
            const targetBody = $(this).next('.mto-stack-content');

            // Slide current one
            targetBody.slideToggle(350);
            $(this).toggleClass('active');

            // Change Icon
            const icon = $(this).find('.mto-arrow');
            if ($(this).hasClass('active')) {
                icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
            } else {
                icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
            }
        });

    });
</script>



<!-- <script>
    // Wait for DOM to fully load
    document.addEventListener('DOMContentLoaded', function() {
        // Get DOM elements
        const slider1 = document.getElementById("slider-1");
        const slider2 = document.getElementById("slider-2");
        const track = document.getElementById("track");
        const minValue = document.getElementById("min-value");
        const maxValue = document.getElementById("max-value");

        // Check if elements exist
        if (!slider1 || !slider2 || !track || !minValue || !maxValue) {
            console.error("Price range slider elements not found");
            return;
        }

        const minGap = 0;
        const sliderMaxValue = parseInt(slider1.max);

        // Format amount with commas
        function formatAmount(amount) {
            return new Intl.NumberFormat('en-US').format(amount);
        }

        // Handle left slider
        function slideOne() {
            let val1 = parseInt(slider1.value);
            let val2 = parseInt(slider2.value);
            
            if (val2 - val1 <= minGap) {
                slider1.value = val2 - minGap;
            }
            
            fillColor();
            updateValues();
        }

        // Handle right slider
        function slideTwo() {
            let val1 = parseInt(slider1.value);
            let val2 = parseInt(slider2.value);
            
            if (val2 - val1 <= minGap) {
                slider2.value = val1 + minGap;
            }
            
            fillColor();
            updateValues();
        }

        // Update slider track color
        function fillColor() {
            let percent1 = (slider1.value / sliderMaxValue) * 100;
            let percent2 = (slider2.value / sliderMaxValue) * 100;

            track.style.background = `linear-gradient(
                to right,
                #d9d9d9 ${percent1}%,
                #f7941d ${percent1}%,
                #f7941d ${percent2}%,
                #d9d9d9 ${percent2}%
            )`;
        }

        // Update displayed values
        function updateValues() {
            minValue.textContent = formatAmount(slider1.value);
            maxValue.textContent = formatAmount(slider2.value);
        }

        // Add event listeners
        slider1.addEventListener("input", slideOne);
        slider2.addEventListener("input", slideTwo);

        // Initialize
        updateValues();
        fillColor();
    });
</script> -->

<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const MIN = 0, MAX = 1000000, STEP = 100;
        let minVal = parseInt(document.getElementById('hiddenMin').value) || 0;
        let maxVal = parseInt(document.getElementById('hiddenMax').value) || MAX;

        const track   = document.getElementById('prTrack');
        const fill    = document.getElementById('prFill');
        const hMin    = document.getElementById('prHandleMin');
        const hMax    = document.getElementById('prHandleMax');
        const minInp  = document.getElementById('prMinInput');
        const maxInp  = document.getElementById('prMaxInput');
        const hidMin  = document.getElementById('hiddenMin');
        const hidMax  = document.getElementById('hiddenMax');

        const fmt     = n => new Intl.NumberFormat('en-US').format(n);
        const unformat = s => parseInt(s.replace(/,/g, '')) || 0;
        const snap    = v => Math.round(v / STEP) * STEP;
        const clamp   = (v, a, b) => Math.max(a, Math.min(b, v));
        const pct     = v => ((v - MIN) / (MAX - MIN)) * 100;

        function render() {
            hMin.style.left = pct(minVal) + '%';
            hMax.style.left = pct(maxVal) + '%';
            fill.style.left  = pct(minVal) + '%';
            fill.style.width = (pct(maxVal) - pct(minVal)) + '%';
            // ✅ ye 2 lines add karo
            hMin.style.zIndex = minVal >= maxVal - STEP ? 3 : 1;
            hMax.style.zIndex = minVal >= maxVal - STEP ? 1 : 3;
            minInp.value = fmt(minVal);
            maxInp.value = fmt(maxVal);
            hidMin.value = minVal;
            hidMax.value = maxVal;
        }

        function getValFromPx(clientX) {
            const r = track.getBoundingClientRect();
            return snap(MIN + clamp((clientX - r.left) / r.width, 0, 1) * (MAX - MIN));
        }

        function makeDraggable(handle, isMin) {
            let active = false;
            const start = e => { active = true; handle.style.zIndex = 10; bind(); e.preventDefault(); };
            const move  = e => {
                if (!active) return;
                const cx = e.touches ? e.touches[0].clientX : e.clientX;
                const v  = getValFromPx(cx);
                isMin ? (minVal = clamp(v, MIN, maxVal - STEP)) : (maxVal = clamp(v, minVal + STEP, MAX));
                render(); e.preventDefault();
            };
            const stop = () => { active = false; handle.style.zIndex = ''; unbind(); render(); }; // ✅ render() add kiya
            const bind  = () => { document.addEventListener('mousemove', move); document.addEventListener('mouseup', stop); document.addEventListener('touchmove', move, { passive: false }); document.addEventListener('touchend', stop); };
            const unbind= () => { document.removeEventListener('mousemove', move); document.removeEventListener('mouseup', stop); document.removeEventListener('touchmove', move); document.removeEventListener('touchend', stop); };

            handle.addEventListener('mousedown',  start);
            handle.addEventListener('touchstart', start, { passive: false });
            handle.addEventListener('keydown', e => {
                const d = e.shiftKey ? STEP * 5 : STEP;
                if (e.key === 'ArrowLeft')  { isMin ? (minVal = clamp(minVal - d, MIN, maxVal - STEP)) : (maxVal = clamp(maxVal - d, minVal + STEP, MAX)); render(); e.preventDefault(); }
                if (e.key === 'ArrowRight') { isMin ? (minVal = clamp(minVal + d, MIN, maxVal - STEP)) : (maxVal = clamp(maxVal + d, minVal + STEP, MAX)); render(); e.preventDefault(); }
            });
        }

        // Click on track to move nearest handle
        track.addEventListener('click', e => {
            if (e.target === hMin || e.target === hMax || e.target.parentElement === hMin || e.target.parentElement === hMax) return;
            const v = getValFromPx(e.clientX);
            Math.abs(v - minVal) <= Math.abs(v - maxVal)
                ? (minVal = clamp(v, MIN, maxVal - STEP))
                : (maxVal = clamp(v, minVal + STEP, MAX));
            render();
        });

        // Manual text input
        const onBlur = isMin => () => {
            const v = snap(clamp(unformat(isMin ? minInp.value : maxInp.value), MIN, MAX));
            isMin ? (minVal = Math.min(v, maxVal - STEP)) : (maxVal = Math.max(v, minVal + STEP));
            render();
        };
        minInp.addEventListener('input', () => {
            let v = unformat(minInp.value);
            if (isNaN(v)) return;

            minVal = clamp(v, MIN, maxVal - STEP);
            render(true); // 👈 no formatting while typing
        });

        maxInp.addEventListener('input', () => {
            let v = unformat(maxInp.value);
            if (isNaN(v)) return;

            maxVal = clamp(v, minVal + STEP, MAX);
            render(true);
        });
        [minInp, maxInp].forEach(i => i.addEventListener('keydown', e => { if (e.key === 'Enter') i.blur(); }));

        makeDraggable(hMin, true);
        makeDraggable(hMax, false);
        render();
    });
</script> -->

<script>
document.addEventListener('DOMContentLoaded', function () {

    const MIN = 0, MAX = 1000000, STEP = 1;

    let minVal = parseInt(document.getElementById('hiddenMin').value);
    let maxVal = parseInt(document.getElementById('hiddenMax').value);

    if (isNaN(minVal)) minVal = MIN;
    if (isNaN(maxVal)) maxVal = MAX;

    const track   = document.getElementById('prTrack');
    const fill    = document.getElementById('prFill');
    const hMin    = document.getElementById('prHandleMin');
    const hMax    = document.getElementById('prHandleMax');
    const minInp  = document.getElementById('prMinInput');
    const maxInp  = document.getElementById('prMaxInput');
    const hidMin  = document.getElementById('hiddenMin');
    const hidMax  = document.getElementById('hiddenMax');

    const fmt = n => new Intl.NumberFormat('en-US').format(n);

    const parseSafe = (val) => {
        if (!val) return null;
        let num = parseFloat(val.toString().replace(/,/g, ''));
        return isNaN(num) ? null : num;
    };

    const clamp = (v,a,b) => Math.max(a, Math.min(b,v));
    const pct = v => ((v - MIN) / (MAX - MIN)) * 100;

    function render(skipFormat = false) {

        hMin.style.left = pct(minVal) + '%';
        hMax.style.left = pct(maxVal) + '%';

        fill.style.left  = pct(minVal) + '%';
        fill.style.width = (pct(maxVal) - pct(minVal)) + '%';

        // overlap fix
        if (minVal >= maxVal - STEP) {
            hMin.style.zIndex = 3;
            hMax.style.zIndex = 2;
        } else {
            hMin.style.zIndex = 2;
            hMax.style.zIndex = 3;
        }

        if (!skipFormat) {
            minInp.value = fmt(minVal);
            maxInp.value = fmt(maxVal);
        }

        hidMin.value = minVal;
        hidMax.value = maxVal;
    }

    function getValFromPx(clientX) {
        const r = track.getBoundingClientRect();
        return MIN + Math.max(0, Math.min(1, (clientX - r.left) / r.width)) * (MAX - MIN);
    }

    function makeDraggable(handle, isMin) {
        let active = false;

        const start = e => {
            active = true;
            document.addEventListener('mousemove', move);
            document.addEventListener('mouseup', stop);
            document.addEventListener('touchmove', move, { passive: false });
            document.addEventListener('touchend', stop);
            e.preventDefault();
        };

        const move = e => {
            if (!active) return;

            const cx = e.touches ? e.touches[0].clientX : e.clientX;
            let v = getValFromPx(cx);

            if (isMin) {
                minVal = clamp(v, MIN, maxVal - STEP);
            } else {
                maxVal = clamp(v, minVal + STEP, MAX);
            }

            render(false);
        };

        const stop = () => {
            active = false;
            render();
            document.removeEventListener('mousemove', move);
            document.removeEventListener('mouseup', stop);
            document.removeEventListener('touchmove', move);
            document.removeEventListener('touchend', stop);
        };

        handle.addEventListener('mousedown', start);
        handle.addEventListener('touchstart', start, { passive: false });
    }

    makeDraggable(hMin, true);
    makeDraggable(hMax, false);

    // click on track
    track.addEventListener('click', e => {
        const v = getValFromPx(e.clientX);

        if (Math.abs(v - minVal) < Math.abs(v - maxVal)) {
            minVal = clamp(v, MIN, maxVal - STEP);
        } else {
            maxVal = clamp(v, minVal + STEP, MAX);
        }

        render();
    });

    // 🔥 LIVE INPUT FIX (SMOOTH)
    minInp.addEventListener('input', () => {
        let v = parseSafe(minInp.value);

        if (v === null) return; // allow typing

        minVal = clamp(v, MIN, maxVal - STEP);
        render(true);
    });

    maxInp.addEventListener('input', () => {
        let v = parseSafe(maxInp.value);

        if (v === null) return;

        maxVal = clamp(v, minVal + STEP, MAX);
        render(true);
    });

    // blur → format nicely
    minInp.addEventListener('blur', () => render());
    maxInp.addEventListener('blur', () => render());

    render(); // initial load
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const gridBtn = document.getElementById("gridViewBtn");
        const listBtn = document.getElementById("listViewBtn");
        const cards = document.querySelectorAll(".vehicle-card");

        function animateCards(callback) {

            cards.forEach(card => {
                card.classList.add("animating");
            });

            setTimeout(() => {
                callback();

                cards.forEach(card => {
                    card.classList.remove("animating");
                    card.classList.add("show");
                });

            }, 200);
        }

        function setView(view) {

            animateCards(() => {

                if (view === "grid") {
                    cards.forEach(card => {
                        card.classList.remove("col-12");
                        card.classList.add("col-lg-4", "col-sm-6");
                    });

                    gridBtn.classList.add("active");
                    listBtn.classList.remove("active");
                }
                else {

                    cards.forEach(card => {
                        card.classList.remove("col-lg-4", "col-sm-6");
                        card.classList.add("col-12");
                    });

                    listBtn.classList.add("active");
                    gridBtn.classList.remove("active");
                }

            });

            localStorage.setItem("vehicleView", view);
        }

        const savedView = localStorage.getItem("vehicleView") || "grid";
        setView(savedView);

        gridBtn.addEventListener("click", () => setView("grid"));
        listBtn.addEventListener("click", () => setView("list"));

    });

</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const distanceNodes = Array.from(document.querySelectorAll(".car-distance-away[data-dealer-postal]"));
        if (!distanceNodes.length) {
            return;
        }

        const formatDistance = (distanceKm) => {
            if (!Number.isFinite(distanceKm)) {
                return "Distance unavailable";
            }
            if (distanceKm < 10) {
                return `${distanceKm.toFixed(1)} Km away`;
            }
            return `${Math.round(distanceKm)} Km away`;
        };

        const haversineDistanceKm = (lat1, lon1, lat2, lon2) => {
            const toRad = (deg) => (deg * Math.PI) / 180;
            const earthRadiusKm = 6371;
            const dLat = toRad(lat2 - lat1);
            const dLon = toRad(lon2 - lon1);
            const a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return earthRadiusKm * c;
        };

        const normalizePostalCode = (postalCode) => (postalCode || "").toString().toUpperCase().replace(/\s+/g, "").trim();
        const getDistanceLabelNode = (container) => container.querySelector(".distance-value");

        const formatPostalForQuery = (postalCode) => {
            const normalized = normalizePostalCode(postalCode);
            if (normalized.length === 6) {
                return `${normalized.slice(0, 3)} ${normalized.slice(3)}`;
            }
            return normalized;
        };

        const normalizeText = (value) => (value || "").toString().trim();

        const geocodePostalCode = async (postalCode, city = "", province = "", country = "") => {
            const normalizedPostal = normalizePostalCode(postalCode);
            if (!normalizedPostal) {
                return null;
            }

            const countryText = normalizeText(country);
            const cityText = normalizeText(city);
            const provinceText = normalizeText(province);
            const cacheKey = `dealer_geo_${normalizedPostal}_${countryText.toLowerCase() || "any"}`;
            try {
                const cached = localStorage.getItem(cacheKey);
                if (cached) {
                    const parsed = JSON.parse(cached);
                    if (Number.isFinite(parsed.lat) && Number.isFinite(parsed.lon)) {
                        return parsed;
                    }
                }
            } catch (err) {
                // ignore cache read issues
            }

            const postalWithSpace = formatPostalForQuery(normalizedPostal);
            const queryVariants = [
                [postalWithSpace, cityText, provinceText, countryText].filter(Boolean).join(", "),
                [postalWithSpace, cityText, countryText].filter(Boolean).join(", "),
                [postalWithSpace, countryText].filter(Boolean).join(", "),
                [normalizedPostal, countryText].filter(Boolean).join(", "),
                postalWithSpace,
                normalizedPostal,
            ];

            const providers = [
                (query) => `https://nominatim.openstreetmap.org/search?format=jsonv2&limit=1&q=${encodeURIComponent(query)}`,
                () => {
                    const params = new URLSearchParams({
                        format: "jsonv2",
                        limit: "1",
                        postalcode: postalWithSpace,
                    });
                    if (countryText) {
                        params.set("country", countryText);
                    }
                    return `https://nominatim.openstreetmap.org/search?${params.toString()}`;
                },
                (query) => `https://geocode.maps.co/search?q=${encodeURIComponent(query)}`
            ];

            for (const queryText of queryVariants) {
                for (const provider of providers) {
                    try {
                        const response = await fetch(provider(queryText));
                        if (!response.ok) {
                            continue;
                        }
                        const rows = await response.json();
                        if (!Array.isArray(rows) || !rows.length) {
                            continue;
                        }
                        const lat = Number(rows[0].lat);
                        const lon = Number(rows[0].lon);
                        if (Number.isFinite(lat) && Number.isFinite(lon)) {
                            try {
                                localStorage.setItem(cacheKey, JSON.stringify({ lat, lon }));
                            } catch (err) {
                                // ignore cache write issues
                            }
                            return { lat, lon };
                        }
                    } catch (err) {
                        // Try next provider/query variant
                    }
                }
            }

            // Final fallback for Canadian postals
            try {
                const zippopotamPostal = postalWithSpace.replace(/\s+/g, "").toLowerCase();
                const zippopotamCountries = ["ca", "us"];
                for (const countryCode of zippopotamCountries) {
                    const response = await fetch(`https://api.zippopotam.us/${countryCode}/${zippopotamPostal}`);
                    if (response.ok) {
                        const payload = await response.json();
                        const place = Array.isArray(payload.places) ? payload.places[0] : null;
                        const lat = Number(place?.latitude);
                        const lon = Number(place?.longitude);
                        if (Number.isFinite(lat) && Number.isFinite(lon)) {
                            try {
                                localStorage.setItem(cacheKey, JSON.stringify({ lat, lon }));
                            } catch (err) {
                                // ignore cache write issues
                            }
                            return { lat, lon };
                        }
                    }
                }
            } catch (err) {
                // no-op
            }

            return null;
        };

        const setAllLabels = (text) => {
            distanceNodes.forEach((node) => {
                const label = getDistanceLabelNode(node);
                if (label) {
                    label.textContent = text;
                }
            });
        };

        const groupedByPostalCode = new Map();
        distanceNodes.forEach((node) => {
            const label = getDistanceLabelNode(node);
            if (!label) {
                return;
            }
            const normalized = normalizePostalCode(node.dataset.dealerPostal);
            const dealerCity = normalizeText(node.dataset.dealerCity);
            const dealerProvince = normalizeText(node.dataset.dealerProvince);
            const dealerCountry = normalizeText(node.dataset.dealerCountry);
            if (!normalized) {
                label.textContent = "Distance unavailable";
                return;
            }

            const groupKey = [normalized, dealerCountry.toLowerCase() || "any"].join("|");
            if (!groupedByPostalCode.has(groupKey)) {
                groupedByPostalCode.set(groupKey, {
                    postalCode: normalized,
                    city: dealerCity,
                    province: dealerProvince,
                    country: dealerCountry,
                    labels: [],
                });
            }
            groupedByPostalCode.get(groupKey).labels.push(label);
        });

        if (!groupedByPostalCode.size) {
            return;
        }

        const updateDistancesForUser = async (userLat, userLon) => {
            const geocodeCache = new Map();
            for (const [groupKey, locationGroup] of groupedByPostalCode.entries()) {
                let dealerCoords = geocodeCache.get(groupKey);
                if (typeof dealerCoords === "undefined") {
                    dealerCoords = await geocodePostalCode(
                        locationGroup.postalCode,
                        locationGroup.city,
                        locationGroup.province,
                        locationGroup.country
                    );
                    geocodeCache.set(groupKey, dealerCoords);
                }

                const distanceText = dealerCoords
                    ? formatDistance(haversineDistanceKm(userLat, userLon, dealerCoords.lat, dealerCoords.lon))
                    : "Distance unavailable";

                locationGroup.labels.forEach((label) => {
                    label.textContent = distanceText;
                });
            }
        };

        const fetchIpLocation = async () => {
            try {
                const response = await fetch("https://ipapi.co/json/");
                if (!response.ok) {
                    return null;
                }
                const payload = await response.json();
                const lat = Number(payload.latitude);
                const lon = Number(payload.longitude);
                if (Number.isFinite(lat) && Number.isFinite(lon)) {
                    return { lat, lon };
                }
            } catch (err) {
                return null;
            }
            return null;
        };

        const tryGetBrowserLocation = (options) => new Promise((resolve, reject) => {
            navigator.geolocation.getCurrentPosition(resolve, reject, options);
        });

        const runDistanceFlow = async () => {
            if (!window.isSecureContext) {
                // Non-HTTPS custom domains often block geolocation silently.
                const ipLocation = await fetchIpLocation();
                if (ipLocation) {
                    await updateDistancesForUser(ipLocation.lat, ipLocation.lon);
                    return;
                }
                setAllLabels("Enable location");
                return;
            }

            if (!("geolocation" in navigator)) {
                const ipLocation = await fetchIpLocation();
                if (ipLocation) {
                    await updateDistancesForUser(ipLocation.lat, ipLocation.lon);
                    return;
                }
                setAllLabels("Enable location");
                return;
            }

            try {
                let position = null;
                try {
                    position = await tryGetBrowserLocation({
                        enableHighAccuracy: false,
                        timeout: 30000,
                        maximumAge: 300000,
                    });
                } catch (firstError) {
                    // Retry once with high accuracy if first attempt timed out or unavailable.
                    position = await tryGetBrowserLocation({
                        enableHighAccuracy: true,
                        timeout: 30000,
                        maximumAge: 0,
                    });
                }

                await updateDistancesForUser(position.coords.latitude, position.coords.longitude);
            } catch (geoError) {
                const ipLocation = await fetchIpLocation();
                if (ipLocation) {
                    await updateDistancesForUser(ipLocation.lat, ipLocation.lon);
                    return;
                }

                // Show permission message only for real permission denials.
                if (geoError && geoError.code === 1) {
                    setAllLabels("Enable location");
                    return;
                }

                setAllLabels("Distance unavailable");
            }
        };

        if (navigator.permissions && typeof navigator.permissions.query === "function") {
            navigator.permissions.query({ name: "geolocation" }).then((permissionStatus) => {
                if (permissionStatus.state === "denied") {
                    setAllLabels("Enable location");
                    return;
                }
                runDistanceFlow();
            }).catch(() => {
                runDistanceFlow();
            });
        } else {
            runDistanceFlow();
        }
    });
</script>
<script>window.gtranslateSettings = { "default_language": "en", "native_language_names": true, "detect_browser_language": true, "wrapper_selector": ".gtranslate_wrapper", "flag_style": "3d", "alt_flags": { "en": "canada" } }</script>
<script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

<script>
    // AOS Animation Init
    if (typeof AOS !== 'undefined') {
        AOS.init({
            once: true,
            duration: 600,
            easing: 'ease-out-cubic',
            offset: 60,
        });
    }
</script>
