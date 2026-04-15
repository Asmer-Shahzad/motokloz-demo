@extends('layouts.app')

@section('content')


    @php
        function formatPrice($price) {
            $cleaned = str_replace(['$', ','], '', $price);
            $number = is_numeric($cleaned) ? (float)$cleaned : 0;
            return number_format($number, 2, '.', ',');
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
                                            <span>Need help?</span>
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
                                        <div class="price-box filter">
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
                    <h2>Browse By Type</h2>
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
                                    <a href="/car-listing?selected_asset=MOTORCYCLE / ATV / POWERSPORTS" class="card">
                                        <img src="/assets/images/Motorcycle.png" class="img-fluid">
                                        <span>{{ $assetCounts['MOTORCYCLE / ATV / POWERSPORTS'] ?? 0 }} vehicles</span>
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
                        <div class="col-lg-3 col-sm-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}" data-aos-duration="600">
                            <div class="modern-car-card shadow-sm">
                                <div class="car-card-top">
                                    @php
                                        $detailUrl = route('inventory_product_details', $recent_vehicle->id);
                                    @endphp

                                    <a href="{{ $detailUrl }}">
                                        <img style="width:100%" src="{{ $recent_vehicle->primary_image
                    ? (Str::startsWith($recent_vehicle->primary_image, 'http')
                        ? $recent_vehicle->primary_image
                        : $disklozBaseUrl . '/admin_assets/images/inventory_images/' . $recent_vehicle->primary_image)
                    : asset('assets/images/defaultimage.jpg') }}" alt="Vehicle Image" class="img-box img-fluid"
                                            onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultimage.jpg') }}';">
                                    </a>
                                    <div class="badge-mileage d-flex align-items-center">
                                        <img src="/assets/images/mile1.png" alt="Mileage" class="me-2"
                                            style="width:20px; height:12px;">
                                        {{ $recent_vehicle->mileage ? $recent_vehicle->mileage . ' km' : '0 km' }}
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

                                    <div class="car-circle-icons-group">
                                        <img src="/assets/images/no-accidents.png" alt="">
                                        <img src="/assets/images/low-mileage.png" alt="">
                                        <img src="/assets/images/service-plan.png" alt="">
                                        <img src="/assets/images/powertrain-warranty.png" alt="">
                                        <span class="extra-icons-count">12+</span>
                                    </div>

                                    <div class="car-price-block text-end">
                                        <h4 class="price-value">
                                            ${{ formatPrice($recent_vehicle->price_retail_date ?? 0) }}
                                        </h4>
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
            background-color: #ff6b00; /* bright orange */
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
            color:#fff;
            background-color: #ff9800;
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }
        .swiper-button-next {
            right: 240px;
            top: 80%;
            z-index: 10;
            color:#fff;
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


@endsection