@extends('layouts.app')

@section('content')


    <section class="gallery-section">
        <div class="container-fluid">
            <div class="row g-0">
                <div class="col-12">

                    @php
                        $logo = [];

                        if(!empty($searched_vehicle->primary_image)){
                            $logo[] = $searched_vehicle->primary_image;
                        }

                        if(!empty($searched_vehicle->inventory_logo)){
                            $extra = explode('|', $searched_vehicle->inventory_logo);
                            $logo = array_merge($logo, $extra);
                        }

                        if(empty($logo)){
                            $logo[] = 'car_thumb.png';
                        }
                    @endphp


                    <!-- MAIN GALLERY -->
                    <div class="swiper main-gallery-slider">
                        <div class="swiper-wrapper">

                            @php
                                $images = $logo ?? [];

                                // empty values remove
                                $images = array_filter($images);

                                // agar koi image nahi
                                if(empty($images)){
                                    $images = ['default'];
                                }

                                $defaultImage = asset('assets/images/defaultimage.jpg');
                            @endphp

                            @foreach ($images as $eachLogo)

                                @php
                                    if($eachLogo == 'default' || str_contains($eachLogo,'car_thumb.png')){
                                        $img = $defaultImage;
                                    }else{
                                        $img = Str::startsWith($eachLogo,'http')
                                            ? $eachLogo
                                            : env('diskloz_base_url').'/admin_assets/images/inventory_images/'.$eachLogo;
                                    }
                                @endphp

                                <div class="swiper-slide">
                                    <img 
                                        src="{{ $img }}"
                                        class="img-fluid mto-lightbox-trigger"
                                        alt="Vehicle Image"
                                        data-full="{{ $img }}"
                                        style="cursor:zoom-in;"
                                        onerror="this.onerror=null;this.src='{{ $defaultImage }}';"
                                    >
                                </div>

                            @endforeach

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


                    <!-- THUMBNAILS -->
                    <div class="swiper thumb-strip-slider mt-3">
                        <div class="swiper-wrapper">

                            @foreach ($images as $eachLogo)

                                @php
                                    if($eachLogo == 'default' || str_contains($eachLogo,'car_thumb.png')){
                                        $img = $defaultImage;
                                    }else{
                                        $img = Str::startsWith($eachLogo,'http')
                                            ? $eachLogo
                                            : env('diskloz_base_url').'/admin_assets/images/inventory_images/'.$eachLogo;
                                    }
                                @endphp

                                <div class="swiper-slide">
                                    <div class="thumbnail">
                                        <img 
                                            src="{{ $img }}"
                                            class="img-thumbnail"
                                            alt="Thumbnail"
                                            onerror="this.onerror=null;this.src='{{ $defaultImage }}';"
                                        >
                                    </div>
                                </div>

                            @endforeach

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
                    <h2 class="mto-top-headline fw-bold">{{ isset($searched_vehicle->inventory_condition) ? $searched_vehicle->inventory_condition : '' }}
                        {{ isset($searched_vehicle->year) ?  $searched_vehicle->year : '' }}
                        {{ isset($searched_vehicle->mfg_auto) ? $searched_vehicle->mfg_auto : '' }}
                        {{isset( $searched_vehicle->model) ? $searched_vehicle->model : '' }} {{ isset($searched_vehicle->trim) ? $searched_vehicle->trim : '' }}</h2>
                    <div class="mto-meta-row d-flex flex-wrap gap-3 mt-3">
                        <span class="mto-meta-item"><i class="fa-solid fa-location-dot me-1"></i> Las Vegas, USA</span>
                        <a href="#" class="mto-map-link fw-bold">Show on map</a>
                        <span class="mto-meta-item flatt">
                            <img src="/assets/images/code.png" class="light-dark" alt="">
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
                        color: var(--select-color);
                        border-bottom: 1px solid  var(--select-color);
                    }
                </style>
                <div class="col-lg-4">
                    <div class="mto-utility-btns d-flex gap-2 justify-content-lg-end mt-3 mt-lg-0">
                        <button class="mto-pill-btn"><img src="/assets/images/Printer.png" class="me-1" alt=""> Print Details</button>
                        <button class="mto-pill-btn"><img src="/assets/images/SVG.png" class="me-1" alt=""> Share</button>
                        <button class="mto-pill-btn"><img src="/assets/images/Wishlish.png" class="me-1" alt=""> Wishlist</button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">

                    <div class="mto-specs-container mb-5">
                        <div class="row g-2">
                            <div class="col-md-3 col-6">
                                <div class="mto-info-tile"><img src="/assets/images/icon01.png" alt=""> {{ isset($searched_vehicle->mileage) ? $searched_vehicle->mileage : '' }} km</div>
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
                                <p class="text-muted">{{ $searched_vehicle->notes_dicussion ? $searched_vehicle->notes_dicussion : 'No Description Mentioned!' }}</p>
                            </div>
                        </div>
                        <div class="mto-stack-item mb-4">
                            <div class="mto-stack-trigger d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold">Seller Details & Promises</h5>
                                <i class="fa-solid fa-chevron-up mto-arrow"></i>
                            </div>
                            <div class="mto-stack-content">
                                <p class="text-muted">{{ $searched_vehicle->benefits_features ? $searched_vehicle->benefits_features : 'No Promises Mentioned!' }}</p>
                            </div>
                        </div>

                        <div class="mto-stack-item mb-4">
                            <div class="mto-stack-trigger d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold">Options</h5>
                                <i class="fa-solid fa-chevron-down mto-arrow"></i>
                            </div>
                            <div class="mto-stack-content">

                                @php
                                    $interior_array = array_filter(explode(',', $searched_vehicle->interior ?? ''));
                                    $extras_array = array_filter(explode(',', $searched_vehicle->extras ?? ''));
                                    $imp_array = array_filter(explode(',', $searched_vehicle->imp ?? ''));
                                    $after_market_items_array = array_filter(explode(',', $searched_vehicle->after_market_items ?? ''));
                                    $optArray = array_filter(explode(';', $searched_vehicle->options ?? ''));

                                    $allOptions = array_merge(
                                        $interior_array,
                                        $extras_array,
                                        $imp_array,
                                        $after_market_items_array,
                                        $optArray
                                    );
                                @endphp

                                @if(!empty($allOptions))

                                <div class="row gy-2">

                                    @foreach($allOptions as $option)

                                        @if(!empty(trim($option)))

                                        <div class="col-md-6 mto-opt">
                                            <i class="fa-solid fa-circle-check me-2"></i>
                                            {{ trim($option) }}
                                        </div>

                                        @endif

                                    @endforeach

                                </div>

                                @endif

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
                        background: var(--text-color);
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
                            @php
                                $detailUrl = route('dealer_inventory_details', $searched_vehicle->dealer->id);

                                $dealerLogo = $searched_vehicle->dealer->logo
                                    ? (Str::startsWith($searched_vehicle->dealer->logo, 'http')
                                        ? $searched_vehicle->dealer->logo
                                        : env('diskloz_base_url') . '/admin_assets/images/dealer_images/' . $searched_vehicle->dealer->logo)
                                    : asset('assets/images/defaultdealerlogo.png');
                            @endphp

                            <a class="link-text-decoration" href="{{ $detailUrl }}">
                                <div class="d-flex align-items-center mb-4">

                                    <img src="{{ $dealerLogo }}"
                                    class="img-fluid dealerlogo rounded-circle me-3"
                                    alt="Dealer"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultdealerlogo.png') }}';">
            
                                    <div>
                                        <h6 class="mb-0 fw-bold">
                                            {{$searched_vehicle->dealer->legal_name}}
                                            <!--{{ $searched_vehicle->dealer->first_name }} {{ $searched_vehicle->dealer->last_name }}-->
                                        </h6>
                                        <p class="small text-muted mb-0">
                                            {{ $searched_vehicle->dealer->physical_address }}
                                        </p>
                                    </div>

                                </div>
                            </a>

                            <div class="mto-contact-details small fw-semibold">

                                <div class="mb-2">
                                    <img src="/assets/images/Background (8).png" alt="phone" class="contact-icon light-dark">
                                    Mobile: {{ $searched_vehicle->dealer->phone_no }}
                                </div>

                                <div class="mb-2">
                                    <img src="/assets/images/Background (10).png" alt="email" class="contact-icon light-dark">
                                    Email: {{ $searched_vehicle->dealer->email }}
                                </div>

                                <div class="mb-2">
                                    <img src="/assets/images/Background (11).png" alt="whatsapp" class="contact-icon light-dark">
                                    WhatsApp: {{ $searched_vehicle->dealer->phone_no }}
                                </div>

                                <div class="mb-2">
                                    <img src="/assets/images/Background (12).png" alt="fax" class="contact-icon light-dark">
                                    Fax: {{ $searched_vehicle->dealer->phone_no }}
                                </div>

                            </div>
                            <a href="{{ route('dealer_inventory', $searched_vehicle->dealer->id) }}">
                                <button class="mto-btn-orange w-100 mt-4 py-2">
                                    Dealer's Inventory 
                                    <i class="fa-solid fa-arrow-right ms-2"></i>
                                </button>
                            </a>
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