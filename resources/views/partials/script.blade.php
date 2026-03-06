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
        color: #1a1a1a;
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

    #scrollTopBtn:hover {
        transform: translateY(-50%) scale(1.15);
        box-shadow: 0 12px 28px rgba(212, 175, 55, 0.7), 0 0 0 4px rgba(255, 215, 0, 0.3);
        background: linear-gradient(135deg, #ffefb0 0%, #e5c100 50%, #c5a028 100%);
    }

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



<script>
    const slider1 = document.getElementById("slider-1");
    const slider2 = document.getElementById("slider-2");
    const track = document.getElementById("track");
    const minValue = document.getElementById("min-value");
    const maxValue = document.getElementById("max-value");

    const minGap = 0;
    const sliderMaxValue = slider1.max;

    function slideOne() {
        if (parseInt(slider2.value) - parseInt(slider1.value) <= minGap) {
            slider1.value = parseInt(slider2.value) - minGap;
        }
        fillColor();
        updateValues();
    }

    function slideTwo() {
        if (parseInt(slider2.value) - parseInt(slider1.value) <= minGap) {
            slider2.value = parseInt(slider1.value) + minGap;
        }
        fillColor();
        updateValues();
    }

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

    function updateValues() {
        minValue.textContent = Number(slider1.value).toLocaleString();
        maxValue.textContent = Number(slider2.value).toLocaleString();
    }

    slider1.addEventListener("input", slideOne);
    slider2.addEventListener("input", slideTwo);

    updateValues();
    fillColor();
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const gridBtn = document.getElementById("gridViewBtn");
    const listBtn = document.getElementById("listViewBtn");
    const cards = document.querySelectorAll(".vehicle-card");

    function animateCards(callback){

        cards.forEach(card=>{
            card.classList.add("animating");
        });

        setTimeout(()=>{
            callback();

            cards.forEach(card=>{
                card.classList.remove("animating");
                card.classList.add("show");
            });

        },200);
    }

    function setView(view){

        animateCards(()=>{

            if(view === "grid"){
                cards.forEach(card=>{
                    card.classList.remove("col-12");
                    card.classList.add("col-lg-4","col-sm-6");
                });

                gridBtn.classList.add("active");
                listBtn.classList.remove("active");
            }
            else{

                cards.forEach(card=>{
                    card.classList.remove("col-lg-4","col-sm-6");
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

    gridBtn.addEventListener("click", ()=>setView("grid"));
    listBtn.addEventListener("click", ()=>setView("list"));

});

</script>