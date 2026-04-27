@extends('layouts.app')

@section('content')


    @php
        function formatPrice($price)
        {
            $cleaned = str_replace(['$', ','], '', $price);
            $number = is_numeric($cleaned) ? (float) $cleaned : 0;
            return number_format(round($number), 0, '.', ',');
        }
    @endphp

    <section class="banner-section">
        <div class="container-fluid">
            <div class="banner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="search-wrapper">
                                <form id="vehicleFilterForm" action="{{ route('search_inventory') }}" method="GET"
                                    class="search-wrapper">
                                    <!-- Tabs -->
                                    <div class="tabs">
                                        <a class="tab active" data-condition="">All</a>
                                        <a class="tab" data-condition="NEW">New</a>
                                        <a class="tab" data-condition="USED">Used</a>

                                        <div class="help">
                                            <i class="fa-solid fa-user"></i>
                                            <span><a href="tel:+8773475569">Need help?</a></span>
                                        </div>
                                    </div>

                                    <!-- Hidden input for tabs -->
                                    <input type="hidden" name="selected_condition" id="selected_condition_input">

                                    <!-- Filter Bar -->
                                    <div class="filter-bar">

                                        <!-- Type -->
                                        <div class="filter">
                                            <label>Type</label>
                                            <div class="select">
                                                <i class="fa-solid fa-car"></i>
                                                <select id="filter-type" name="selected_asset" class="filter-options">
                                                    <option value="">Select Type</option>
                                                    @foreach($assets as $asset)
                                                        <option value="{{ $asset }}">{{ $asset }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="divider"></div>

                                        <!-- Make -->
                                        <div class="filter">
                                            <label>Make</label>
                                            <div class="select">
                                                <i class="fa-solid fa-car-side me-2"></i>
                                                <select id="filter-make" name="selected_make" class="filter-options">
                                                    <option value="">Select Make</option>
                                                    @foreach($makeTypes as $type => $makes)
                                                        @foreach($makes as $make)
                                                            <option value="{{ $make['name'] }}" data-type="{{ $type }}">
                                                                {{ $make['name'] }}
                                                            </option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="divider"></div>

                                        <!-- Model -->
                                        <div class="filter">
                                            <label>Model</label>
                                            <div class="select">
                                                <input class="form-control" type="text" name="selected_model" id="Model"
                                                    placeholder="Enter Model">
                                            </div>
                                        </div>

                                        <div class="divider"></div>

                                        <!-- Price Range -->
                                        <!-- <div class="price-box filter">
                                            <label>Price Range</label>
                                            <div class="range-container">
                                                <div class="slider-track" id="track"></div>
                                                <input class="filter-all" type="range" min="0" max="1000000" step="10000"
                                                    value="{{ request('selected_lowest_price', 0) }}" id="slider-1"
                                                    name="selected_lowest_price">
                                                <input class="filter-all" type="range" min="0" max="1000000" step="10000"
                                                    value="{{ request('selected_highest_price', 1000000) }}" id="slider-2"
                                                    name="selected_highest_price">
                                            </div>

                                            <div class="values">
                                                $ <span id="min-value"></span> - $ <span id="max-value"></span>
                                            </div>
                                        </div> -->
                                        <!-- Price Range -->
                                        <div class="price-box filter">
                                            <label>Price Range</label>

                                            <div class="pr-track-wrap" id="prTrack">
                                                <div class="pr-track"></div>
                                                <div class="pr-fill" id="prFill"></div>
                                                <div class="pr-handle" id="prHandleMin" tabindex="0" role="slider" aria-label="Minimum price">
                                                    <div class="pr-handle-inner"></div>
                                                </div>
                                                <div class="pr-handle" id="prHandleMax" tabindex="0" role="slider" aria-label="Maximum price">
                                                    <div class="pr-handle-inner"></div>
                                                </div>
                                            </div>

                                            <div class="pr-values values">
                                                <div class="pr-input-wrap"><input class="pr-input filter-all" id="prMinInput" type="text" inputmode="numeric"></div>
                                                <span class="pr-sep">—</span>
                                                <div class="pr-input-wrap"><input class="pr-input filter-all" id="prMaxInput" type="text" inputmode="numeric"></div>
                                            </div>

                                            {{-- Hidden inputs for form submission --}}
                                            <input type="hidden" id="hiddenMin" name="selected_lowest_price" value="{{ request('selected_lowest_price', 0) }}">
                                            <input type="hidden" id="hiddenMax" name="selected_highest_price" value="{{ request('selected_highest_price', 1000000) }}">
                                        </div>

                                        <div class="divider"></div>

                                        <!-- Distance to Seller -->
                                        <div class="filter distance-filter-wrap" id="home-distance-wrap">
                                            <label>Distance</label>
                                            <div class="select distance-dropdown-container">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <select name="selected_distance" id="home-distance-select" class="filter-options" style="display:none;">
                                                    <option value="">Any Distance</option>
                                                    <option value="50">Under 50 km</option>
                                                    <option value="100">Under 100 km</option>
                                                    <option value="250">Under 250 km</option>
                                                    <option value="500">Under 500 km</option>
                                                    <option value="1000">Under 1000 km</option>
                                                    <option value="provincial">Provincial</option>
                                                    <option value="national">National</option>
                                                </select>
                                                <button type="button" class="btn-allow-location" id="home-allow-location" style="display:none;">
                                                    <i class="fa-solid fa-location-crosshairs me-1"></i> Allow Location
                                                </button>
                                                <span id="home-location-unsupported" style="display:none; font-size:12px; color:#aaa;">Location not supported</span>
                                            </div>
                                            <input type="hidden" name="user_lat" id="home-user-lat">
                                            <input type="hidden" name="user_lng" id="home-user-lng">
                                        </div>

                                        <button type="submit" class="search-btn">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                            Find a Vehicle
                                        </button>

                                    </div>
                                </form>

                            </div>

                        </div>


                <div class="browse-slider">
                    <h2>Start Your Best Online Search Here</h2>
                    <p>Find The Perfect Ride For Any Occasion</p>

                            <div class="slider-wrapper">

                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">

                                        <div class="swiper-slide">
                                            <a href="/car-listing?selected_asset=AUTO" class="card">
                                                <img src="/assets/images/Auto.png" class="img-fluid">
                                                <span>{{ $assetCounts['AUTO'] ?? 0 }} vehicles</span>
                                                <h4>Auto</h4>
                                            </a>
                                        </div>

                                        <div class="swiper-slide">
                                            <a href="/car-listing?selected_asset=SNOWSPORTS" class="card">
                                                <img src="/assets/images/Snow.png" class="img-fluid">
                                                <span>{{ $assetCounts['SNOWSPORTS'] ?? 0 }} vehicles</span>
                                                <h4>Snowsports</h4>
                                            </a>
                                        </div>

                                        <div class="swiper-slide">
                                            <a href="/car-listing?selected_asset=WATERSPORT" class="card">
                                                <img src="/assets/images/Water.png" class="img-fluid">
                                                <span>{{ $assetCounts['WATERSPORT'] ?? 0 }} vehicles</span>
                                                <h4>Watersports</h4>
                                            </a>
                                        </div>

                                        <div class="swiper-slide">
                                            <a href="/car-listing?selected_asset=MARINE" class="card">
                                                <img src="/assets/images/Marine.png" class="img-fluid">
                                                <span>{{ $assetCounts['MARINE'] ?? 0 }} vehicles</span>
                                                <h4>Marine</h4>
                                            </a>
                                        </div>

                                        <div class="swiper-slide">
                                            <a href="/car-listing?selected_asset=RV / TRAILER" class="card">
                                                <img src="/assets/images/RV.png" class="img-fluid">
                                                <span>{{ $assetCounts['RV / TRAILER'] ?? 0 }} vehicles</span>
                                                <h4>RV</h4>
                                            </a>
                                        </div>

                                        <div class="swiper-slide">
                                            <a href="/car-listing?selected_asset=MOTORCYCLE / ATV / POWERSPORTS"
                                                class="card">
                                                <img src="/assets/images/Motorcycle.png" class="img-fluid">
                                                <span>{{ $assetCounts['MOTORCYCLE / ATV / POWERSPORTS'] ?? 0 }}
                                                    vehicles</span>
                                                <h4>Motorcycle</h4>
                                            </a>
                                        </div>

                                        <div class="swiper-slide">
                                            <a href="/car-listing?selected_asset=HEAVY TRUCK/EQUIPMENT" class="card">
                                                <img src="/assets/images/Heavy Truck.png" class="img-fluid">
                                                <span>{{ $assetCounts['HEAVY TRUCK/EQUIPMENT'] ?? 0 }} vehicles</span>
                                                <h4>Heavy Truck</h4>
                                            </a>
                                        </div>

                                        <div class="swiper-slide">
                                            <a href="/car-listing?selected_asset=HEAVY DUTY TRAILERS" class="card">
                                                <img src="/assets/images/Trailers.png" class="img-fluid">
                                                <span>{{ $assetCounts['HEAVY DUTY TRAILERS'] ?? 0 }} vehicles</span>
                                                <h4>Trailers</h4>
                                            </a>
                                        </div>

                                        <div class="swiper-slide">
                                            <a href="/car-listing?selected_asset=FARM EQUIPMENT" class="card">
                                                <img src="/assets/images/Farm Equipment.png" class="img-fluid">
                                                <span>{{ $assetCounts['FARM EQUIPMENT'] ?? 0 }} vehicles</span>
                                                <h4>Farm Equipment</h4>
                                            </a>
                                        </div>

                                    </div>
                                </div>

                                <!-- CUSTOM BUTTONS -->
                                <div class="custom-nav prev-btn">
                                    <i class="bi bi-arrow-left"></i>
                                </div>

                                <div class="custom-nav next-btn">
                                    <i class="bi bi-arrow-right"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
    </section>


    <style>
        .slider-wrapper {
            position: relative;
            /* padding: 0 50px; */
        }

        .swiper-wrapper {
            transition-timing-function: linear !important;
        }

        .custom-nav {
            position: absolute;
            top: 40%;
            transform: translateY(-40%);
            z-index: 10;

            width: 42px;
            height: 42px;
            border-radius: 50%;

            background: #ff9900;
            color: #fff;

            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* LEFT */
        .prev-btn {
            left: -50px;
        }

        /* RIGHT */
        .next-btn {
            right: -50px;
        }

        @media screen and (max-width: 767px) {
            .prev-btn {
                left: -10px;
            }

            /* RIGHT */
            .next-btn {
                right: -10px;
            }
        }
    </style>


    <section class="section-two">
        <div class="container">
            <div class="row">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="vehicle-box secure-box">
                        <div class="secure-content">
                            <h4>Secure My Vehicle Valuation</h4>
                            <p>Get a discreet trade-in estimate from trusted local dealers to help you decide where to
                                shop — no pressure, no obligation.</p>
                        </div>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="pre-approval-box secure-box">
                        <div class="secure-content">
                            <h4>Secure My Pre-Approval</h4>
                            <p>Know exactly how much you qualify for before you go. Shop confidently with a clear budget
                                in mind.</p>
                        </div>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="popular-vehicles">
        <div class="container">
            <div class="row align-items-center pb-5">
                <div class="col-lg-6">
                    <h2 data-aos="zoom-out-right">Popular Vehicles</h2>
                    <!-- <p>Favorite vehicles based on customer reviews</p> -->
                </div>
                {{-- <div class="col-lg-6 popular-button">
                    <ul>
                        <li><a href="javascript:void(0)">Categories <i class="fa-solid fa-angle-down"></i></a></li>
                        <li><a href="javascript:void(0)">Fuel Type <i class="fa-solid fa-angle-down"></i></a></li>
                        <li><a href="javascript:void(0)">Review / Rating <i class="fa-solid fa-angle-down"></i></a></li>
                        <li><a href="javascript:void(0)">Price range <i class="fa-solid fa-angle-down"></i></a></li>
                    </ul>
                </div> --}}
            </div>
            <div class="row g-4">
                @foreach ($assetData as $recent_vehicle)
                        <div class="col-lg-3 col-sm-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}"
                            data-aos-duration="600">
                            <div class="modern-car-card shadow-sm">
                                <div class="car-card-top">
                                    @php
                                        // Create a URL-friendly slug from the vehicle title
                                        $vehicleName = $recent_vehicle->year . ' ' . 
                                                    ($recent_vehicle->mfg_auto ?? '') . ' ' . 
                                                    ($recent_vehicle->model ?? '');
                                        $slug = Str::slug($vehicleName, '-');
                                        $detailUrl = route('inventory_product_details', ['name' => $slug, 'id' => $recent_vehicle->id]);
                                    @endphp

                                    <a href="{{ $detailUrl }}">
                                        <img style="width:100%" src="{{ $recent_vehicle->primary_image
                                            ? (Str::startsWith($recent_vehicle->primary_image, 'http')
                                                ? $recent_vehicle->primary_image
                                                : $disklozBaseUrl . '/admin_assets/images/inventory_images/' . $recent_vehicle->primary_image)
                                            : asset('assets/images/defaultimage.jpg') }}" alt="Vehicle Image" class="img-box img-fluid"
                                            onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultimage.jpg') }}';">
                                    </a>
                                    @php
                                        $isOwnCard = auth()->check()
                                            && strtolower($recent_vehicle->source ?? '') === 'motokloz'
                                            && !empty($recent_vehicle->client_id)
                                            && (int) $recent_vehicle->client_id === auth()->id();
                                    @endphp
                                    @if(!$isOwnCard)
                                    <button class="card-wishlist-btn"
                                        id="wishlist-btn-{{ $recent_vehicle->id }}"
                                        onclick="event.stopPropagation(); toggleLike({{ $recent_vehicle->id }}, this, {{ auth()->id() ?? 'null' }})"
                                        title="Add to Wishlist">
                                        <i class="fa fa-spinner fa-spin d-none" id="wishlist-spinner-{{ $recent_vehicle->id }}"></i>
                                        <i class="far fa-star" id="wishlist-icon-{{ $recent_vehicle->id }}"></i>
                                    </button>
                                    @endif
                                    <div class="badge-mileage d-flex align-items-center">
                                        <img src="/assets/images/mile1.png" alt="Mileage" class="me-2"
                                            style="width:20px; height:12px;">
                                         {{ $recent_vehicle->mileage 
                                        ? number_format((float) trim(str_ireplace('km', '', $recent_vehicle->mileage))) . ' km'
                                        : '0 km'
                                    }}
                                    </div>
                                </div>
                                <div class="car-card-bottom">
                                    <h5 class="car-main-title">{{ $recent_vehicle->year }} {{ $recent_vehicle->mfg_auto }}
                                        {{ $recent_vehicle->model }} {{ $recent_vehicle->trim }}
                                    </h5>
                                    @php
                                        $dealerPostalCode = data_get($recent_vehicle, 'dealer.postal_code')
                                            ?? $recent_vehicle->dealer_postal_code
                                            ?? $recent_vehicle->postal_code
                                            ?? '';
                                        $dealerCity = data_get($recent_vehicle, 'dealer.city')
                                            ?? $recent_vehicle->dealer_city
                                            ?? '';
                                        $dealerProvince = data_get($recent_vehicle, 'dealer.province')
                                            ?? $recent_vehicle->dealer_province
                                            ?? '';
                                        $dealerCountry = data_get($recent_vehicle, 'dealer.country')
                                            ?? $recent_vehicle->dealer_country
                                            ?? '';
                                    @endphp
                                    <p class="car-distance-away" data-dealer-postal="{{ $dealerPostalCode }}"
                                        data-dealer-city="{{ $dealerCity }}" data-dealer-province="{{ $dealerProvince }}"
                                        data-dealer-country="{{ $dealerCountry }}">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span class="distance-value">Loading...</span>
                                    </p>

                                    <!-- <div class="car-circle-icons-group">
                                        <img src="/assets/images/no-accidents.png" alt="">
                                        <img src="/assets/images/low-mileage.png" alt="">
                                        <img src="/assets/images/service-plan.png" alt="">
                                        <img src="/assets/images/powertrain-warranty.png" alt="">
                                        <span class="extra-icons-count">12+</span>
                                    </div> -->

                                    <div class="car-price-block text-end">
                                        @php $displayPrice = round($recent_vehicle->disclosed_price ?? 0); @endphp
                                        @if($displayPrice > 0)
                                            <h4 class="price-value">${{ formatPrice($displayPrice) }}</h4>
                                        @elseif($isOwnCard)
                                            <h4 class="price-value">$0</h4>
                                        @else
                                            @php
                                                $cardPhone = null;
                                                if (!empty($recent_vehicle->dealer->phone_no)) {
                                                    $cardPhone = $recent_vehicle->dealer->phone_no;
                                                } elseif (!empty($recent_vehicle->dealer_phone_no)) {
                                                    $cardPhone = $recent_vehicle->dealer_phone_no;
                                                }
                                            @endphp
                                            @if($cardPhone)
                                                <a href="tel:{{ $cardPhone }}" class="price-value call-seller d-block text-decoration-none" onclick="event.stopPropagation();">
                                                    <i class="fa-solid fa-phone-volume me-1"></i> Call Seller for Details
                                                </a>
                                            @else
                                                <h4 class="price-value call-seller">
                                                    <i class="fa-solid fa-phone-volume me-1"></i> Call Seller for Details
                                                </h4>
                                            @endif
                                        @endif
                                        <!-- <p class="price-sub-text">In sapien eu diam eu</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach


            </div>
        </div>
    </section>


    <section class="about-motokloz">
        <div class="container">
            <div class="row">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="about-bg">
                        <h2>About <span>Motokloz</span></h2>
                        <p>Motokloz is Canada’s newest buy-and-sell marketplace dedicated exclusively to motorized assets.
                            Built with transparency and trust at its core, Motokloz connects buyers and sellers in a
                            smarter, safer,
                            and more informed environment — whether you’re shopping for motorcycles, cars, boats,
                            powersports, RVs, or specialty vehicles.</p>
                        <p>Our platform is designed around full disclosure and user confidence. We believe great
                            transactions start with clear information, honest listings, and tools that empower both sides of
                            the deal. Sellers gain access to structured listing features that highlight key details and
                            build credibility, while buyers benefit from streamlined search, verified information, and an
                            intuitive browsing experience that removes guesswork from major purchases.</p>
                        <p>Motokloz isn’t just another classifieds site — it’s a purpose-built ecosystem focused on the
                            ultimate buying and selling experience. From discovery to decision, every feature is created to
                            reduce friction, increase transparency, and help Canadians move forward with confidence when
                            purchasing or selling motorized assets.</p>
                        <p>Whether you’re upgrading, downsizing, or finding your next ride, Motokloz delivers a modern
                            marketplace where trust, clarity, and performance drive every transaction.</p>
                        <a href="#" class="btn-custom">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="car-wrap">
            <img src="/assets/images/suv.png" class="car img-fluid" alt="car">
        </div>
    </section>



    <!-- <section class="testimonials-section">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-lg-12 testimonials-content">
                                                                    <h4><img src="/assets/images/persons.png" class="img-fluid">Testimonials</h4>
                                                                    <h2>What they say about us?</h2>
                                                                    <p>Egestas massa lobortis tellus libero sit suspendisse id elementum. <br>Est sit massa libero neque
                                                                        fermentum non.</p>

                                                                </div>
                                                            </div>
                                                            <div class="swiper review-swiper">
                                                                <div class="swiper-wrapper">

                                                                    <div class="swiper-slide">
                                                                        <div class="review-card">
                                                                            <img src="/assets/images/star.png" class="img-fluid">

                                                                            <div class="review-user">
                                                                                <h4>Sarah M.</h4>
                                                                                <span class="review-verified">✔</span>
                                                                            </div>

                                                                            <p>
                                                                                “Lorem ipsum dolor sit amet consectetur. At morbi pellentesque in ultricies. Accumsan
                                                                                neque convallis scelerisque mauris. Nam et lorem aliquam cum sagittis.”
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="swiper-slide">
                                                                        <div class="review-card">
                                                                            <img src="/assets/images/star.png" class="img-fluid">

                                                                            <div class="review-user">
                                                                                <h4>Sarah M.</h4>
                                                                                <span class="review-verified">✔</span>
                                                                            </div>

                                                                            <p>
                                                                                “Lorem ipsum dolor sit amet consectetur. At morbi pellentesque in ultricies. Accumsan
                                                                                neque convallis scelerisque mauris. Nam et lorem aliquam cum sagittis.”
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="swiper-slide">
                                                                        <div class="review-card">
                                                                            <img src="/assets/images/star.png" class="img-fluid">

                                                                            <div class="review-user">
                                                                                <h4>Alex K.</h4>
                                                                                <span class="review-verified">✔</span>
                                                                            </div>

                                                                            <p>
                                                                                “Lorem ipsum dolor sit amet consectetur. At morbi pellentesque in ultricies. Accumsan
                                                                                neque convallis scelerisque mauris. Nam et lorem aliquam cum sagittis.”
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="swiper-slide">
                                                                        <div class="review-card">
                                                                            <img src="/assets/images/star.png" class="img-fluid">

                                                                            <div class="review-user">
                                                                                <h4>James L.</h4>
                                                                                <span class="review-verified">✔</span>
                                                                            </div>

                                                                            <p>
                                                                                “Lorem ipsum dolor sit amet consectetur. At morbi pellentesque in ultricies. Accumsan
                                                                                neque convallis scelerisque mauris. Nam et lorem aliquam cum sagittis.”
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="swiper-slide">
                                                                        <div class="review-card">
                                                                            <img src="/assets/images/star.png" class="img-fluid">

                                                                            <div class="review-user">
                                                                                <h4>James L.</h4>
                                                                                <span class="review-verified">✔</span>
                                                                            </div>

                                                                            <p>
                                                                                “Lorem ipsum dolor sit amet consectetur. At morbi pellentesque in ultricies. Accumsan
                                                                                neque convallis scelerisque mauris. Nam et lorem aliquam cum sagittis.”
                                                                            </p>
                                                                        </div>
                                                                    </div>


                                                                    <div class="swiper-slide">
                                                                        <div class="review-card">
                                                                            <img src="/assets/images/star.png" class="img-fluid">

                                                                            <div class="review-user">
                                                                                <h4>James L.</h4>
                                                                                <span class="review-verified">✔</span>
                                                                            </div>

                                                                            <p>
                                                                                “Lorem ipsum dolor sit amet consectetur. At morbi pellentesque in ultricies. Accumsan
                                                                                neque convallis scelerisque mauris. Nam et lorem aliquam cum sagittis.”
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="swiper-slide">
                                                                        <div class="review-card">
                                                                            <img src="/assets/images/star.png" class="img-fluid">

                                                                            <div class="review-user">
                                                                                <h4>James L.</h4>
                                                                                <span class="review-verified">✔</span>
                                                                            </div>

                                                                            <p>
                                                                                “Lorem ipsum dolor sit amet consectetur. At morbi pellentesque in ultricies. Accumsan
                                                                                neque convallis scelerisque mauris. Nam et lorem aliquam cum sagittis.”
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </section> -->

    <!-- <section class="car-review">
                                                        <div class="container">
                                                            <div class="col-lg-12">
                                                                <h4>CAR REVIEW</h4>
                                                                <h2>Hyundai Tucson Plug-In <br>Hybrid 2025 review</h2>
                                                                <p>The Tucson Plug-in Hybrid is easy to drive and<br> provides a sufficient all-electric range.</p>
                                                                <a href="#" class="btn-custom-home">
                                                                    View Details
                                                                    <img src="/assets/images/bttnarrow.png" alt="arrow" class="btn-arrow-home">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </section> -->

    <style>
        .btn-custom-home {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: #f7931a;
            color: #fff;
            padding: 14px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-arrow-home {
            width: 20px;
            /* size adjust kar sakte ho */
            height: auto;
        }

        /* Base styling */
        .custom-swiper-btn {
            width: 40px;
            height: 40px;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
            top: 10%;
            /* transform: translateY(-50%); */
        }

        /* Hover effect */
        .custom-swiper-btn:hover {
            background-color: #ff6b00;
            /* bright orange */
        }

        /* Icon size */
        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 20px;
        }

        /* Position tweaks */
        .swiper-button-prev {
            left: 240px;
            top: 80%;
            color: #fff;
            background-color: #ff9800;
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        .swiper-button-next {
            right: 240px;
            top: 80%;
            z-index: 10;
            color: #fff;
            background-color: #ff9800;
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }
    </style>


    <script>
        const typeSelect = document.getElementById('filter-type');
        const makeSelect = document.getElementById('filter-make');

        function populateMakes(makes) {

            makeSelect.innerHTML = '<option value="">Select Make</option>';

            makes.forEach(make => {
                const option = document.createElement('option');

                option.value = make.name;
                option.textContent = make.name;

                makeSelect.appendChild(option);
            });
        }

        function fetchMakesByType(type) {
            return fetch(`{{ $disklozBaseUrl }}/api/search_inventory?selected_asset=${encodeURIComponent(type)}&per_page=1`)
                .then(res => res.json())
                .then(data => {
                    switch (type) {
                        case 'AUTO': return data.filters.MfgAuto || [];
                        case 'MARINE': return data.filters.MfgMarine || [];
                        case 'RV / TRAILER': return data.filters.MfgRvTrailer || [];
                        case 'SNOWSPORTS': return data.filters.MfgSnowsport || [];
                        case 'MOTORCYCLE': return data.filters.MfgMotorcycleAtv || [];
                        case 'POWERSPORTS': return data.filters.MfgMotorcycleAtv || [];
                        case 'WATERSPORT': return data.filters.MfgWatersport || [];
                        case 'FARM EQUIPMENT': return data.filters.MfgFarmEquipment || [];
                        case 'HEAVY TRUCK/EQUIPMENT': return data.filters.MfgHeavyTruckEquipment || [];
                        case 'HEAVY DUTY TRAILERS': return data.filters.MfgHeavyDutyTrailer || [];
                        default: return [];
                    }
                });
        }

        // On type change
        typeSelect.addEventListener('change', function () {
            const type = this.value;
            if (!type) {
                // If no type selected, show all makes
                fetchAllMakes();
                return;
            }
            fetchMakesByType(type)
                .then(populateMakes)
                .catch(err => console.error('Error fetching makes:', err));
        });

        // Function to fetch all makes from all types
        function fetchAllMakes() {
            const types = [
                'AUTO', 'MARINE', 'RV / TRAILER', 'SNOWSPORTS', 'MOTORCYCLE', 'POWERSPORTS',
                'WATERSPORT', 'FARM EQUIPMENT', 'HEAVY TRUCK/EQUIPMENT', 'HEAVY DUTY TRAILERS'
            ];

            Promise.all(types.map(fetchMakesByType))
                .then(results => {
                    // Flatten the array of arrays into a single list
                    const allMakes = results.flat();
                    populateMakes(allMakes);
                })
                .catch(err => console.error('Error fetching all makes:', err));
        }

        // Initial load: populate all makes
        fetchAllMakes();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slider1 = document.getElementById('slider-1');
            const slider2 = document.getElementById('slider-2');
            const minValueSpan = document.getElementById('min-value');
            const maxValueSpan = document.getElementById('max-value');
            const form = document.getElementById('vehicleFilterForm');

            // Function to fetch all makes from all types
            function fetchAllMakes() {
                const types = [
                    'AUTO', 'MARINE', 'RV / TRAILER', 'SNOWSPORTS', 'MOTORCYCLE / ATV / POWERSPORTS',
                    'WATERSPORT', 'FARM EQUIPMENT', 'HEAVY TRUCK/EQUIPMENT', 'HEAVY DUTY TRAILERS'
                ];

                slider1.addEventListener('input', () => { minValueSpan.textContent = slider1.value; });
                slider2.addEventListener('input', () => { maxValueSpan.textContent = slider2.value; });

                // Tabs redirect
                document.querySelectorAll('.tabs .tab').forEach(tab => {
                    tab.addEventListener('click', function () {
                        document.querySelectorAll('.tabs .tab').forEach(t => t.classList.remove('active'));
                        this.classList.add('active');

                        document.getElementById('selected_condition_input').value = this.dataset.condition || '';
                        form.submit(); // redirect with filters
                    });
                });
            });
    </script>

<script>
var DISKLOZ_BASE_HOME = "{{ env('diskloz_base_url') }}";
$(document).ready(function () {
    @auth
    var authId = {{ auth()->id() }};
    fetch(DISKLOZ_BASE_HOME + '/api/favorites?client_id=' + authId)
        .then(function(res) { return res.json(); })
        .then(function(data) {
            var likedIds = new Set((data || []).map(function(item) { return item.inventory_id; }));
            $('button[id^="wishlist-btn-"]').each(function () {
                var id = parseInt(this.id.replace('wishlist-btn-', ''));
                if (likedIds.has(id)) {
                    $(this).addClass('active');
                    $('#wishlist-icon-' + id).removeClass('far').addClass('fas').css('color', '#f0a500');
                }
            });
        }).catch(function() {});
    @endauth
});

function toggleLike(vehicleId, element, authId) {
    if (!authId || authId === 'null') { window.location.href = '/login'; return; }
    var $btn = $(element), $icon = $('#wishlist-icon-' + vehicleId);
    var isLiked = $btn.hasClass('active');
    $btn.prop('disabled', true);
    $('#wishlist-spinner-' + vehicleId).removeClass('d-none');
    $icon.addClass('d-none');
    var fd = new FormData();
    fd.append('client_id', authId);
    fd.append('vehicle_id', vehicleId);
    $.ajax({
        url: isLiked ? '/remove_like' : '/add_like', type: 'POST',
        data: fd, processData: false, contentType: false, dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(res) {
            if (res.success) {
                if (isLiked) { $btn.removeClass('active'); $icon.removeClass('fas').addClass('far').css('color', '#aaa'); }
                else { $btn.addClass('active'); $icon.removeClass('far').addClass('fas').css('color', '#f0a500'); }
            }
        },
        complete: function() { $('#wishlist-spinner-' + vehicleId).addClass('d-none'); $icon.removeClass('d-none'); $btn.prop('disabled', false); }
    });
}
</script>

{{-- Distance Filter GPS JS --}}
<script>
(function () {
    var LAT_KEY = 'motokloz_user_lat';
    var LNG_KEY = 'motokloz_user_lng';
    function storedLat() { return localStorage.getItem(LAT_KEY); }
    function storedLng() { return localStorage.getItem(LNG_KEY); }
    function hasStoredCoords() { return storedLat() !== null && storedLng() !== null; }
    function saveCoords(lat, lng) { localStorage.setItem(LAT_KEY, lat); localStorage.setItem(LNG_KEY, lng); }

    function populateInputs(lat, lng) {
        var latEl = document.getElementById('home-user-lat');
        var lngEl = document.getElementById('home-user-lng');
        if (latEl) latEl.value = lat;
        if (lngEl) lngEl.value = lng;
    }

    function showGranted() {
        var sel = document.getElementById('home-distance-select');
        var btn = document.getElementById('home-allow-location');
        if (sel) sel.style.display = '';
        if (btn) btn.style.display = 'none';
    }

    function showAllow() {
        var sel = document.getElementById('home-distance-select');
        var btn = document.getElementById('home-allow-location');
        if (sel) sel.style.display = 'none';
        if (btn) btn.style.display = '';
    }

    function requestLocation() {
        if (!navigator.geolocation) {
            document.getElementById('home-location-unsupported').style.display = '';
            return;
        }
        navigator.geolocation.getCurrentPosition(
            function(pos) {
                saveCoords(pos.coords.latitude, pos.coords.longitude);
                populateInputs(pos.coords.latitude, pos.coords.longitude);
                showGranted();
            },
            function() { showAllow(); },
            { timeout: 10000, maximumAge: 300000 }
        );
    }

    document.addEventListener('DOMContentLoaded', function () {
        if (!navigator.geolocation) {
            document.getElementById('home-location-unsupported').style.display = '';
            return;
        }
        if (hasStoredCoords()) {
            populateInputs(storedLat(), storedLng());
            showGranted();
        } else {
            showAllow();
        }
        var btn = document.getElementById('home-allow-location');
        if (btn) btn.addEventListener('click', function(e) { e.preventDefault(); requestLocation(); });

        // Populate coords on form submit
        var form = document.getElementById('vehicleFilterForm');
        if (form) form.addEventListener('submit', function() {
            if (hasStoredCoords()) populateInputs(storedLat(), storedLng());
        });
    });
})();
</script>

@endsection