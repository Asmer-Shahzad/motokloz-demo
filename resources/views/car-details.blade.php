@extends('layouts.app')

@section('content')


    <section class="gallery-section">
        <div class="container-fluid">
            <div class="row g-0">
                <div class="col-12">

                    <div class="swiper main-gallery-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="/assets/images/gallery1.png" alt="Slide 1">
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/gallery2.png" alt="Slide 2">
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/gallery3.png" alt="Slide 3">
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/gallery4.png" alt="Slide 4">
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/gallery5.png" alt="Slide 5">
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/gallery6.png" alt="Slide 6">
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/gallery7.png" alt="Slide 7">
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/gallery8.png" alt="Slide 8">
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/gallery9.png" alt="Slide 9">
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/gallery10.png" alt="Slide 10">
                            </div>
                        </div>

                        <div class="gallery-action-overlay">
                            <button class="btn-lexus-orange">
                                <i class="fa-solid fa-table-cells-large"></i> See All Photos
                            </button>
                            <button class="btn-lexus-white">
                                <i class="fa-solid fa-circle-play"></i> Video Clips
                            </button>
                        </div>

                        <div class="swiper-button-next arrow-round"></div>
                        <div class="swiper-button-prev arrow-round"></div>
                    </div>

                    <div class="swiper thumb-strip-slider mt-3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img src="/assets/images/gallery1.png">
                            </div>
                            <div class="swiper-slide"><img src="/assets/images/gallery2.png">
                            </div>
                            <div class="swiper-slide"><img src="/assets/images/gallery3.png">
                            </div>
                            <div class="swiper-slide"><img src="/assets/images/gallery4.png">
                            </div>
                            <div class="swiper-slide"><img src="/assets/images/gallery5.png">
                            </div>
                            <div class="swiper-slide"><img src="/assets/images/gallery6.png">
                            </div>
                            <div class="swiper-slide"><img src="/assets/images/gallery7.png">
                            </div>
                            <div class="swiper-slide"><img src="/assets/images/gallery8.png">
                            </div>
                            <div class="swiper-slide"><img src="/assets/images/gallery9.png">
                            </div>
                            <div class="swiper-slide"><img src="/assets/images/gallery10.png">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="mto-main-wrapper py-5">
        <div class="container">

            <div class="row mb-4 align-items-end">
                <div class="col-lg-8">
                    <h2 class="mto-top-headline fw-bold">Hyundai Accent 2015 - Modern compact sedan in
                        blue color on beautiful dark wheels</h2>
                    <div class="mto-meta-row d-flex flex-wrap gap-3 mt-3">
                        <span class="mto-meta-item"><i class="fa-solid fa-location-dot me-1"></i> Las Vegas, USA</span>
                        <a href="#" class="mto-map-link fw-bold">Show on map</a>
                        <span class="mto-meta-item flatt">
                            <img src="/assets/images/code.png" alt="">
                            <span class="">Fleet Code:</span>
                            <span class="value">LVA-4125</span>
                        </span>
                    </div>
                </div>
                <style>
                    span.mto-meta-item.flatt {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 10px;
                    }



                    .mto-meta-item .value {
                        font-weight: 600;
                        color: #000;
                        border-bottom: 1px solid #000;
                    }
                </style>
                <div class="col-lg-4">
                    <div class="mto-utility-btns d-flex gap-2 justify-content-lg-end mt-3 mt-lg-0">
                        <button class="mto-pill-btn"><i class="fa-solid fa-print me-1"></i> Print Details</button>
                        <button class="mto-pill-btn"><i class="fa-solid fa-share me-1"></i> Share</button>
                        <button class="mto-pill-btn"><i class="fa-solid fa-heart me-1"></i> Wishlist</button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">

                    <div class="mto-specs-container mb-5">
                        <div class="row g-2">
                            <div class="col-md-3 col-6">
                                <div class="mto-info-tile"><img src="/assets/images/icon01.png" alt=""> 56,500</div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="mto-info-tile"><img src="/assets/images/icon02.png" alt=""> Diesel</div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="mto-info-tile"><img src="/assets/images/icon03.png" alt=""> Automatic</div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="mto-info-tile"><img src="/assets/images/icon04.png" alt=""> 7 seats</div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="mto-info-tile"><img src="/assets/images/icon05.png" alt=""> 3 Large bags
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="mto-info-tile"><img src="/assets/images/icon06.png" alt=""> SUVs</div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="mto-info-tile"><img src="/assets/images/icon07.png" alt=""> 4 Doors</div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="mto-info-tile"><img src="/assets/images/icon08.png" alt=""> 2.5L</div>
                            </div>
                        </div>
                    </div>

                    <div class="mto-details-stack">

                        <div class="mto-stack-item mb-4">
                            <div class="mto-stack-trigger active d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold">Vehicle Description</h5>
                                <i class="fa-solid fa-chevron-up mto-arrow"></i>
                            </div>
                            <div class="mto-stack-content show">
                                <p class="text-muted">Elevate your Las Vegas experience to new heights with a journey
                                    aboard The High Roller at The LINQ. As the tallest observation wheel in the world,
                                    standing at an impressive 550 feet tall, The High Roller offers a bird's-eye
                                    perspective of the iconic Las Vegas Strip and its surrounding desert landscape.
                                    Every turn offers a new and breathtaking vista of the vibrant city below.</p>
                                <p>
                                    Whether you're a first-time visitor or a seasoned Las Vegas aficionado, The High
                                    Roller promises an unparalleled
                                    experience that will leave you in awe. With its climate-controlled cabins and
                                    immersive audio commentary, this
                                    attraction provides a unique opportunity to see Las Vegas from a whole new
                                    perspective, while learning about its rich
                                    history and famous landmarks along the way.
                                </p>
                            </div>
                        </div>

                        <div class="mto-stack-item mb-4">
                            <div class="mto-stack-trigger d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold">Options</h5>
                                <i class="fa-solid fa-chevron-down mto-arrow"></i>
                            </div>
                            <div class="mto-stack-content">
                                <div class="row gy-2">
                                    <div class="col-md-6 mto-opt"><i class="fa-solid fa-circle-check me-2"></i> Free
                                        cancellation up to 48 hours before pick-up</div>
                                    <div class="col-md-6 mto-opt"><i class="fa-solid fa-circle-check me-2"></i>
                                        Collision Damage Waiver with $700 deductible</div>
                                    <div class="col-md-6 mto-opt"><i class="fa-solid fa-circle-check me-2"></i> Theft
                                        Protection with ₫66,926,626 excess</div>
                                    <div class="col-md-6 mto-opt"><i class="fa-solid fa-circle-check me-2"></i>
                                        Unlimited mileage</div>
                                </div>
                            </div>
                        </div>

                        <div class="mto-stack-item mb-4">
                            <div class="mto-stack-trigger d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold">Question Answers</h5>
                                <i class="fa-solid fa-chevron-down mto-arrow"></i>
                            </div>
                            <div class="mto-stack-content">
                                <div class="mto-qa-card q-a border p-3 rounded-3">
                                    <h6 class="fw-bold"><i class="fa-regular fa-circle-question me-2"></i> Is The High
                                        Roller suitable for all ages?</h6>
                                    <p class="small text-muted mb-0 ms-4">Absolutely! The High Roller offers a
                                        family-friendly experience.</p>
                                </div>

                                <div class="mto-qa-card q-a  border p-3 rounded-3 active">
                                    <h6 class="fw-bold"><i class="fa-regular fa-circle-question me-2"></i>Can I bring
                                        food or drinks aboard The High Roller?</h6>
                                    <p class="small text-muted mb-0 ms-4">Outside food and beverages are not permitted
                                        on The High Roller. However, there are nearby dining options at
                                        The LINQ Promenade where you can enjoy a meal before or after your ride.</p>
                                </div>

                                <div class="mto-qa-card q-a  border p-3 rounded-3">
                                    <h6 class="fw-bold"><i class="fa-regular fa-circle-question me-2"></i>Is The High
                                        Roller wheelchair accessible?</h6>
                                    <p class="small text-muted mb-0 ms-4">es, The High Roller cabins are wheelchair
                                        accessible, making it possible for everyone to enjoy the breathtaking
                                        views of Las Vegas.</p>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
                <style>
                    .q-a {

                        margin-bottom: 10px;
                    }

                    .q-a.active {
                        background: #F2F4F6;
                    }
                </style>

                <div class="col-lg-4">
                    <div class="mto-sticky-side">
                        <div class="mto-card-unit mb-4 p-4 shadow-sm">
                            <h6 class="fw-bold mb-3">Get Started</h6>
                            <button class="mto-btn-orange w-100 mb-3">Schedule Test Drive <i
                                    class="fa-solid fa-arrow-right ms-2"></i></button>
                            <button class="mto-btn-black w-100">Make An Offer Price <i
                                    class="fa-solid fa-arrow-right ms-2"></i></button>
                        </div>

                        <div class="mto-card-unit p-4 shadow-sm">
                            <div class="d-flex justify-content-between mb-4 listed-card-right">
                                <span class="fw-bold">Listed by</span>
                                <span class="mto-rating-badge"><i class="fa-solid fa-star me-1"></i> 4.96 <span
                                        class="fw-normal text-muted ms-1">(672 reviews)</span></span>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <img src="/assets/images/car-profile.png" class="rounded-circle me-3" alt="Dealer">
                                <div>
                                    <h6 class="mb-0 fw-bold">Emily Rose</h6>
                                    <p class="small text-muted mb-0">Las Vegas, USA</p>
                                </div>
                            </div>
                            <div class="mto-contact-details small fw-semibold">

                                <div class="mb-2">
                                    <img src="/assets/images/Background (8).png" alt="phone" class="contact-icon">
                                    Mobile: 1-222-333-4444
                                </div>

                                <div class="mb-2">
                                    <img src="/assets/images/Background (10).png" alt="email" class="contact-icon">
                                    Email: emily-rose@gmail.com
                                </div>

                                <div class="mb-2">
                                    <img src="/assets/images/Background (11).png" alt="whatsapp" class="contact-icon">
                                    WhatsApp: 1-222-333-4444
                                </div>

                                <div class="mb-2">
                                    <img src="/assets/images/Background (12).png" alt="fax" class="contact-icon">
                                    Fax: 1-222-333-4444
                                </div>

                            </div>
                            <button class="mto-btn-orange w-100 mt-4 py-2">Dealer's Inventory <i
                                    class="fa-solid fa-arrow-right ms-2"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .listed-card-right {

            border-bottom: 1px solid #DDE1DE;
            padding-bottom: 14px;
        }

        .mto-contact-details div {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .contact-icon {
            width: 16px;
            /* size adjust kar sakte ho */
            height: 16px;
        }
    </style>
@endsection