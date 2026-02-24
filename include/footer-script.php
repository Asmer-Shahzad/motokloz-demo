<!-- Scroll Button with Dynamic Arrow -->
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

toggleBtn.addEventListener("click", function() {

    document.body.classList.toggle("dark-mode");

    if (document.body.classList.contains("dark-mode")) {
        icon.src = "<?php echo $prefix; ?>/assets/images/lightmood.png";
        localStorage.setItem("theme", "dark");
    } else {
        icon.src = "<?php echo $prefix; ?>/assets/images/darkmood.png";
        localStorage.setItem("theme", "light");
    }

});

// Page load par state restore
if (localStorage.getItem("theme") === "dark") {
    document.body.classList.add("dark-mode");
    icon.src = "<?php echo $prefix; ?>/assets/images/lightmood.png";
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
    spaceBetween: 30,

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
            slidesPerView: 4
        },
    }
});

// hover pause
const reviewEl = document.querySelector('.review-swiper');
reviewEl.addEventListener('mouseenter', () => reviewSwiper.autoplay.stop());
reviewEl.addEventListener('mouseleave', () => reviewSwiper.autoplay.start());
</script>

<script>
$(document).ready(function() {

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
        reviewEl.addEventListener('mouseenter', function() {
            if (typeof reviewSwiper !== 'undefined') reviewSwiper.autoplay.stop();
        });
        reviewEl.addEventListener('mouseleave', function() {
            if (typeof reviewSwiper !== 'undefined') reviewSwiper.autoplay.start();
        });
    }

});
</script>
<script>
$(document).ready(function() {

    // 1. Fixing the console error (Safety Check)
    // Yeh check karta hai ke element page par hai ya nahi
    const reviewTarget = document.querySelector('.review-swiper');

    if (reviewTarget && typeof reviewSwiper !== 'undefined') {
        reviewTarget.addEventListener('mouseenter', () => reviewSwiper.autoplay.stop());
        reviewTarget.addEventListener('mouseleave', () => reviewSwiper.autoplay.start());
    }

    // 2. Custom Stack (Accordion) Toggle Logic
    $('.mto-stack-trigger').on('click', function() {
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