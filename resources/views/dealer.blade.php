@extends('layouts.app')

@section('content')


    <section class="dealer-fleet-section container">
        <div class=" my-4">

            <div class="top-back">
                <a href="#" class="dashboard-back">
                    <span class="back-icon">
                        <img src="/assets/images/Carento (5).png" alt="Back">
                    </span>
                    <span class="back-text">Go back to Dealer Profile</span>
                </a>
            </div>

            <!-- Collapsible Content -->
            <div class="collapse show" id="overviewContent">

                <div class="d-flex align-items-start mb-4 border p-4 rounded-3">
                    <img src="/assets/images/Carento2.png" class="me-3 rounded" alt="Logo">
                    <div>
                        <h3 class="mb-0 fw-bold">Peugeot Sheffield</h3>
                        <p class="mb-0">
                            <i class="fas fa-map-marker-alt"></i>
                            123 Kingsway Strandeif, Manchester, M19 2XS
                        </p>
                        <span class="badge bg-light text-dark border mt-2 p-2 rounded-5">
                            180 Vehicles
                        </span>
                    </div>
                </div>

            </div>


        </div>
        <div class="car-dealer">
            <div>
                <div class="row">
                    <div class="col-lg-12">


                        <div class="search-wrapper search-dealer-container">
                            <!-- Tabs -->
                            <div class="tabs">
                                <a class="tab active">All</a>
                                <a class="tab">New</a>
                                <a class="tab">Used</a>

                                <div class="help">
                                    <i class="fa-solid fa-user"></i>
                                    <span>Need help?</span>
                                </div>
                            </div>

                            <!-- Filter Bar -->
                            <div class="filter-bar">

                                <div class="filter">
                                    <label>Type</label>
                                    <div class="select">
                                        <i class="fa-solid fa-car"></i>
                                        <select class="filter-options">
                                            <option>Auto</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="divider"></div>

                                <div class="filter">
                                    <label>Make</label>
                                    <div class="select">
                                        <i class="fa-solid fa-car-side me-2"></i>
                                        <span class="filter-all">Modern Compact</span>
                                    </div>
                                </div>

                                <div class="divider"></div>

                                <div class="filter">
                                    <label>Model</label>
                                    <div class="select">
                                        <i class="fa-solid fa-calendar me-2"></i>
                                        <span class="filter-all">2022</span>
                                    </div>
                                </div>

                                <div class="divider"></div>
                                {{--
                                <div class="filter price">
                                    <label>Price Range</label>
                                    <input type="range" min="10000" max="12000" value="11000" id="priceRange">
                                    <div class="price-value">$ <span id="priceVal">10,000 - 12,000</span></div>
                                </div> --}}

                                <div class="price-box filter">
                                    <label>Model</label>

                                    <div class="range-container ">
                                        <div class="slider-track" id="track"></div>
                                        <input class="filter-all " type="range" min="0" max="1000000" step="10000"
                                            value="100000" id="slider-1">
                                        <input class="filter-all " type="range" min="0" max="1000000" step="10000"
                                            value="500000" id="slider-2">
                                    </div>

                                    <div class="values">
                                        $ <span id="min-value"></span>
                                        &nbsp; - &nbsp;
                                        <span id="max-value"></span>
                                    </div>
                                </div>
                                <button class="search-btn">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    Find a Vehicle
                                </button>

                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div>


            <div class="row g-4 ">
                <div class="col-lg-3 col-md-4">
                    <aside class="complete-sidebar">
                        <h5 class="sidebar-main-heading">Filter Search</h5>

                        <div class="filter-group">
                            <label class="sidebar-label">Condition</label>
                            <select class="form-select sidebar-input">
                                <option>Select Condition</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="sidebar-label">Asset Type</label>
                            <select class="form-select sidebar-input">
                                <option>Select Asset Type</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="sidebar-label">Power Type</label>
                            <select class="form-select sidebar-input">
                                <option>Select Power Type</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="sidebar-label">Lowest Price</label>
                            <input type="text" class="form-control sidebar-input" placeholder="Enter Price">
                        </div>

                        <div class="filter-group">
                            <label class="sidebar-label">Max Price</label>
                            <input type="text" class="form-control sidebar-input" placeholder="Enter Price">
                        </div>



                        <div class="filter-group">
                            <label class="sidebar-label">Year</label>
                            <select class="form-select sidebar-input">
                                <option>Select Year</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="sidebar-label">Make</label>
                            <select class="form-select sidebar-input">
                                <option>Select Make</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="sidebar-label">Model</label>
                            <input type="text" class="form-control sidebar-input" placeholder="Enter Model">
                        </div>

                        <div class="filter-group">
                            <label class="sidebar-label">Max Mileage</label>
                            <input type="text" class="form-control sidebar-input" placeholder="Enter Max Mileage">
                        </div>

                        <div class="filter-group">
                            <label class="sidebar-label">Body Style</label>
                            <select class="form-select sidebar-input">
                                <option>Select Body Style</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="sidebar-label">Fuel Type</label>
                            <select class="form-select sidebar-input">
                                <option>Select Fuel Type</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="sidebar-label">Add for sale by</label>
                            <select class="form-select sidebar-input">
                                <option>Select Any</option>
                            </select>
                        </div>


                    </aside>
                    <div class="sidebar-map-box mt-4 complete-sidebar">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="map-label">Show on map</span>
                            <i class="fa-solid fa-chevron-down map-toggle-icon"></i>
                        </div>
                        <img src="/assets/images/map.png" class="img-fluid rounded-3" alt="Map">
                    </div>
                </div>


                <div class="col-lg-9 col-md-8">

                    <div style="    border-bottom: 1px solid #DDE1DE;     padding-bottom: 10px;"
                        class="fleet-toolbar d-flex flex-wrap justify-content-between align-items-center mb-4">
                        <div class="toolbar-left d-flex align-items-center">
                            <div class="view-icons me-3">
                                {{-- <i class="fa-solid fa-table-cells-large active light-dark"></i> --}}
                                {{-- <i class="fa-solid fa-list ms-2"></i> --}}
                                <svg width="22" height="24" viewBox="0 0 22 24" fill="none" class="light-dark me-2"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 9.5V4.25C20 3.8375 19.6625 3.5 19.25 3.5H14C13.5875 3.5 13.25 3.8375 13.25 4.25V9.5C13.25 9.9125 13.5875 10.25 14 10.25H19.25C19.6625 10.25 20 9.9125 20 9.5ZM19.25 2C20.495 2 21.5 3.005 21.5 4.25V9.5C21.5 10.745 20.495 11.75 19.25 11.75H14C12.755 11.75 11.75 10.745 11.75 9.5V4.25C11.75 3.005 12.755 2 14 2H19.25Z"
                                        fill="black" />
                                    <path
                                        d="M20 20.75V15.5C20 15.0875 19.6625 14.75 19.25 14.75H14C13.5875 14.75 13.25 15.0875 13.25 15.5V20.75C13.25 21.1625 13.5875 21.5 14 21.5H19.25C19.6625 21.5 20 21.1625 20 20.75ZM19.25 13.25C20.495 13.25 21.5 14.255 21.5 15.5V20.75C21.5 21.995 20.495 23 19.25 23H14C12.755 23 11.75 21.995 11.75 20.75V15.5C11.75 14.255 12.755 13.25 14 13.25H19.25Z"
                                        fill="black" />
                                    <path
                                        d="M8 10.25C8.4125 10.25 8.75 9.9125 8.75 9.5V4.25C8.75 3.8375 8.4125 3.5 8 3.5H2.75C2.3375 3.5 2 3.8375 2 4.25V9.5C2 9.9125 2.3375 10.25 2.75 10.25H8ZM8 2C9.245 2 10.25 3.005 10.25 4.25V9.5C10.25 10.745 9.245 11.75 8 11.75H2.75C1.505 11.75 0.5 10.745 0.5 9.5V4.25C0.5 3.005 1.505 2 2.75 2H8Z"
                                        fill="black" />
                                    <path
                                        d="M8 21.5C8.4125 21.5 8.75 21.1625 8.75 20.75V15.5C8.75 15.0875 8.4125 14.75 8 14.75H2.75C2.3375 14.75 2 15.0875 2 15.5V20.75C2 21.1625 2.3375 21.5 2.75 21.5H8ZM8 13.25C9.245 13.25 10.25 14.255 10.25 15.5V20.75C10.25 21.995 9.245 23 8 23H2.75C1.505 23 0.5 21.995 0.5 20.75V15.5C0.5 14.255 1.505 13.25 2.75 13.25H8Z"
                                        fill="black" />
                                </svg>

                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" class="light-dark"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.788 0H1.09497C0.491194 0 0 0.486501 0 1.08456V4.74269C0 5.34075 0.491194 5.82729 1.09497 5.82729H4.788C5.39177 5.82729 5.88297 5.34075 5.88297 4.74269V1.08456C5.88297 0.486501 5.39177 0 4.788 0ZM4.80951 4.74273C4.80951 4.75328 4.79865 4.76404 4.788 4.76404H1.09497C1.08432 4.76404 1.07345 4.75328 1.07345 4.74273V1.08456C1.07345 1.07401 1.08432 1.06329 1.09497 1.06329H4.788C4.79865 1.06329 4.80951 1.07401 4.80951 1.08456V4.74273ZM7.53412 1.32686C7.53412 1.03321 7.77444 0.795211 8.07084 0.795211H20.4632C20.7596 0.795211 21 1.03321 21 1.32686C21 1.62046 20.7596 1.8585 20.4632 1.8585H8.07084C7.77444 1.8585 7.53412 1.62046 7.53412 1.32686ZM21 4.50043C21 4.79408 20.7597 5.03208 20.4633 5.03208H8.07084C7.77444 5.03208 7.53412 4.79408 7.53412 4.50043C7.53412 4.20683 7.77444 3.96879 8.07084 3.96879H20.4632C20.7597 3.96879 21 4.20683 21 4.50043ZM4.788 7.58633H1.09497C0.491194 7.58633 0 8.07283 0 8.67089V12.329C0 12.9271 0.491194 13.4136 1.09497 13.4136H4.788C5.39177 13.4136 5.88297 12.9271 5.88297 12.329V8.67089C5.88297 8.07288 5.39177 7.58633 4.788 7.58633ZM4.80951 12.3291C4.80951 12.3396 4.79865 12.3504 4.788 12.3504H1.09497C1.08432 12.3504 1.07345 12.3396 1.07345 12.3291V8.67094C1.07345 8.66039 1.08432 8.64967 1.09497 8.64967H4.788C4.79865 8.64967 4.80951 8.66039 4.80951 8.67094V12.3291ZM4.788 15.1727H1.09497C0.491194 15.1727 0 15.6592 0 16.2573V19.9154C0 20.5135 0.491194 21 1.09497 21H4.788C5.39177 21 5.88297 20.5135 5.88297 19.9154V16.2573C5.88297 15.6592 5.39177 15.1727 4.788 15.1727ZM4.80951 19.9154C4.80951 19.926 4.79865 19.9368 4.788 19.9368H1.09497C1.08432 19.9368 1.07345 19.926 1.07345 19.9154V16.2573C1.07345 16.2468 1.08432 16.236 1.09497 16.236H4.788C4.79865 16.236 4.80951 16.2468 4.80951 16.2573V19.9154ZM21 12.0868C21 12.3805 20.7597 12.6185 20.4633 12.6185H8.07084C7.77444 12.6185 7.53412 12.3805 7.53412 12.0868C7.53412 11.7932 7.77444 11.5552 8.07084 11.5552H20.4632C20.7597 11.5552 21 11.7932 21 12.0868ZM21 8.91328C21 9.20688 20.7597 9.44492 20.4633 9.44492H8.07084C7.77444 9.44492 7.53412 9.20688 7.53412 8.91328C7.53412 8.61963 7.77444 8.38163 8.07084 8.38163H20.4632C20.7597 8.38163 21 8.61963 21 8.91328ZM21 16.4996C21 16.7932 20.7597 17.0313 20.4633 17.0313H8.07084C7.77444 17.0313 7.53412 16.7932 7.53412 16.4996C7.53412 16.206 7.77444 15.968 8.07084 15.968H20.4632C20.7597 15.968 21 16.206 21 16.4996ZM21 19.6732C21 19.9668 20.7597 20.2048 20.4633 20.2048H8.07084C7.77444 20.2048 7.53412 19.9668 7.53412 19.6732C7.53412 19.3796 7.77444 19.1415 8.07084 19.1415H20.4632C20.7597 19.1415 21 19.3796 21 19.6732Z"
                                        fill="#737373" />
                                </svg>


                            </div>
                            <span class="results-info">1 - 10 of 19 tours found</span>
                        </div>
                        <div class="toolbar-right d-flex gap-2">
                            <button class="btn-clear-filters">Clear Filters</button>
                            <select class="form-select form-select-sm tool-select">
                                <option>Show 10</option>
                            </select>
                            <select class="form-select form-select-sm tool-select">
                                <option>Sort by: Name</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-4 col-sm-6">
                            <div class="modern-car-card shadow-sm">
                                <div class="car-card-top">
                                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500" alt="Car">
                                    <div class="badge-mileage"><img src="/assets/images/mile1.png" alt="Mileage"
                                            class="me-2" style="width:20px; height:12px;"> 18,500 Km</div>
                                </div>
                                <div class="car-card-bottom">
                                    <h5 class="car-main-title">2022 Cadillac XT6 Premium Luxury</h5>
                                    <p class="car-distance-away"><i class="fa-solid fa-location-dot"></i> 12 Km away</p>

                                    <div class="car-circle-icons-group">
                                        <img src="/assets/images/no-accidents.png" alt="">
                                        <img src="/assets/images/low-mileage.png" alt="">
                                        <img src="/assets/images/service-plan.png" alt="">
                                        <img src="/assets/images/powertrain-warranty.png" alt="">
                                        <span class="extra-icons-count">12+</span>
                                    </div>

                                    <div class="car-price-block text-end">
                                        <h4 class="price-value">$60089.32</h4>
                                        <p class="price-sub-text">In sapien eu diam eu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="modern-car-card shadow-sm">
                                <div class="car-card-top">
                                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500" alt="Car">
                                    <div class="badge-mileage"><img src="/assets/images/mile1.png" alt="Mileage"
                                            class="me-2" style="width:20px; height:12px;"> 18,500 Km</div>
                                </div>
                                <div class="car-card-bottom">
                                    <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                    <p class="car-distance-away"><i class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                    <div class="car-circle-icons-group">
                                        <img src="/assets/images/no-accidents.png" alt="">
                                        <img src="/assets/images/low-mileage.png" alt="">
                                        <img src="/assets/images/service-plan.png" alt="">
                                        <img src="/assets/images/powertrain-warranty.png" alt="">
                                        <span class="extra-icons-count">12+</span>
                                    </div>
                                    <div class="car-price-block text-end">
                                        <h4 class="price-value">$95400.00</h4>
                                        <p class="price-sub-text">In sapien eu diam eu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="modern-car-card shadow-sm">
                                <div class="car-card-top">
                                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500" alt="Car">
                                    <div class="badge-mileage"><img src="/assets/images/mile1.png" alt="Mileage"
                                            class="me-2" style="width:20px; height:12px;"> 18,500 Km</div>
                                </div>
                                <div class="car-card-bottom">
                                    <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                    <p class="car-distance-away"><i class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                    <div class="car-circle-icons-group">
                                        <img src="/assets/images/no-accidents.png" alt="">
                                        <img src="/assets/images/low-mileage.png" alt="">
                                        <img src="/assets/images/service-plan.png" alt="">
                                        <img src="/assets/images/powertrain-warranty.png" alt="">
                                        <span class="extra-icons-count">12+</span>
                                    </div>
                                    <div class="car-price-block text-end">
                                        <h4 class="price-value">$95400.00</h4>
                                        <p class="price-sub-text">In sapien eu diam eu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="modern-car-card shadow-sm">
                                <div class="car-card-top">
                                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500" alt="Car">
                                    <div class="badge-mileage"><img src="/assets/images/mile1.png" alt="Mileage"
                                            class="me-2" style="width:20px; height:12px;"> 18,500 Km</div>
                                </div>
                                <div class="car-card-bottom">
                                    <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                    <p class="car-distance-away"><i class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                    <div class="car-circle-icons-group">
                                        <img src="/assets/images/no-accidents.png" alt="">
                                        <img src="/assets/images/low-mileage.png" alt="">
                                        <img src="/assets/images/service-plan.png" alt="">
                                        <img src="/assets/images/powertrain-warranty.png" alt="">
                                        <span class="extra-icons-count">12+</span>
                                    </div>
                                    <div class="car-price-block text-end">
                                        <h4 class="price-value">$95400.00</h4>
                                        <p class="price-sub-text">In sapien eu diam eu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="modern-car-card shadow-sm">
                                <div class="car-card-top">
                                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500" alt="Car">
                                    <div class="badge-mileage"><img src="/assets/images/mile1.png" alt="Mileage"
                                            class="me-2" style="width:20px; height:12px;"> 18,500 Km</div>
                                </div>
                                <div class="car-card-bottom">
                                    <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                    <p class="car-distance-away"><i class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                    <div class="car-circle-icons-group">
                                        <img src="/assets/images/no-accidents.png" alt="">
                                        <img src="/assets/images/low-mileage.png" alt="">
                                        <img src="/assets/images/service-plan.png" alt="">
                                        <img src="/assets/images/powertrain-warranty.png" alt="">
                                        <span class="extra-icons-count">12+</span>
                                    </div>
                                    <div class="car-price-block text-end">
                                        <h4 class="price-value">$95400.00</h4>
                                        <p class="price-sub-text">In sapien eu diam eu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="modern-car-card shadow-sm">
                                <div class="car-card-top">
                                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500" alt="Car">
                                    <div class="badge-mileage"><img src="/assets/images/mile1.png" alt="Mileage"
                                            class="me-2" style="width:20px; height:12px;"> 18,500 Km</div>
                                </div>
                                <div class="car-card-bottom">
                                    <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                    <p class="car-distance-away"><i class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                    <div class="car-circle-icons-group">
                                        <img src="/assets/images/no-accidents.png" alt="">
                                        <img src="/assets/images/low-mileage.png" alt="">
                                        <img src="/assets/images/service-plan.png" alt="">
                                        <img src="/assets/images/powertrain-warranty.png" alt="">
                                        <span class="extra-icons-count">12+</span>
                                    </div>
                                    <div class="car-price-block text-end">
                                        <h4 class="price-value">$95400.00</h4>
                                        <p class="price-sub-text">In sapien eu diam eu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="modern-car-card shadow-sm">
                                <div class="car-card-top">
                                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500" alt="Car">
                                    <div class="badge-mileage"><img src="/assets/images/mile1.png" alt="Mileage"
                                            class="me-2" style="width:20px; height:12px;"> 18,500 Km</div>
                                </div>
                                <div class="car-card-bottom">
                                    <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                    <p class="car-distance-away"><i class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                    <div class="car-circle-icons-group">
                                        <img src="/assets/images/no-accidents.png" alt="">
                                        <img src="/assets/images/low-mileage.png" alt="">
                                        <img src="/assets/images/service-plan.png" alt="">
                                        <img src="/assets/images/powertrain-warranty.png" alt="">
                                        <span class="extra-icons-count">12+</span>
                                    </div>
                                    <div class="car-price-block text-end">
                                        <h4 class="price-value">$95400.00</h4>
                                        <p class="price-sub-text">In sapien eu diam eu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="modern-car-card shadow-sm">
                                <div class="car-card-top">
                                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500" alt="Car">
                                    <div class="badge-mileage"><img src="/assets/images/mile1.png" alt="Mileage"
                                            class="me-2" style="width:20px; height:12px;"> 18,500 Km</div>
                                </div>
                                <div class="car-card-bottom">
                                    <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                    <p class="car-distance-away"><i class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                    <div class="car-circle-icons-group">
                                        <img src="/assets/images/no-accidents.png" alt="">
                                        <img src="/assets/images/low-mileage.png" alt="">
                                        <img src="/assets/images/service-plan.png" alt="">
                                        <img src="/assets/images/powertrain-warranty.png" alt="">
                                        <span class="extra-icons-count">12+</span>
                                    </div>
                                    <div class="car-price-block text-end">
                                        <h4 class="price-value">$95400.00</h4>
                                        <p class="price-sub-text">In sapien eu diam eu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="modern-car-card shadow-sm">
                                <div class="car-card-top">
                                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=500" alt="Car">
                                    <div class="badge-mileage"><img src="/assets/images/mile1.png" alt="Mileage"
                                            class="me-2" style="width:20px; height:12px;"> 18,500 Km</div>
                                </div>
                                <div class="car-card-bottom">
                                    <h5 class="car-main-title">2023 Porsche Cayenne Turbo</h5>
                                    <p class="car-distance-away"><i class="fa-solid fa-location-dot"></i> 5 Km away</p>
                                    <div class="car-circle-icons-group">
                                        <img src="/assets/images/no-accidents.png" alt="">
                                        <img src="/assets/images/low-mileage.png" alt="">
                                        <img src="/assets/images/service-plan.png" alt="">
                                        <img src="/assets/images/powertrain-warranty.png" alt="">
                                        <span class="extra-icons-count">12+</span>
                                    </div>
                                    <div class="car-price-block text-end">
                                        <h4 class="price-value">$95400.00</h4>
                                        <p class="price-sub-text">In sapien eu diam eu</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="my-4 pt-5">
                        @include('partials.pagination')
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection