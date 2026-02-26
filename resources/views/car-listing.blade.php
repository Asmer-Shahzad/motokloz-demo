@extends('layouts.app')

@section('content')

    <section class="banner-car-listing">
        <div class="container-fluid">
            <div class="car-listing-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="car-listing-cont">
                                <h4>Find cars for sale and for rent near you</h4>
                                <h2>Find Your Perfect Car</h2>
                                <p>Search and find your best car to buy with easy way</p>
                            </div>
                            <div class="search-wrapper search-container">
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
                                            <select>
                                                <option>Auto</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <div class="filter">
                                        <label>Make</label>
                                        <div class="select">
                                            <i class="fa-solid fa-car-side"></i>
                                            <select>
                                                <option>Modern compact</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <div class="filter">
                                        <label>Model</label>
                                        <div class="select">
                                            <i class="fa-solid fa-calendar"></i>
                                            <select>
                                                <option>2022</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <div class="filter price">
                                        <label>Price Range</label>
                                        <input type="range" min="10000" max="12000" value="11000" id="priceRange">
                                        <div class="price-value">$ <span id="priceVal">10,000 - 12,000</span></div>
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
        </div>
    </section>


    <section class="fleet-section">
        <div class="container">

            <div class="row fleet-top">
                <div class="col-12">
                    <h2 class="main-title">Our Vehicle Fleet</h2>
                    <p class="main-subtitle">Turning dreams into reality with versatile vehicles.</p>
                </div>
            </div>

            <div class="row g-4">
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
                                <i class="fa-solid fa-table-cells-large active"></i>
                                <i class="fa-solid fa-list ms-2"></i>
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
                                    <img src="https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=500" alt="Car">
                                    <div class="badge-mileage">
                                        <i class="fa-solid fa-gauge-high"></i> 25,100 Km
                                    </div>
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
                                    <div class="badge-mileage"><i class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
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
                                    <div class="badge-mileage"><i class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
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
                                    <div class="badge-mileage"><i class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
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
                                    <div class="badge-mileage"><i class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
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
                                    <div class="badge-mileage"><i class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
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
                                    <div class="badge-mileage"><i class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
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
                                    <div class="badge-mileage"><i class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
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
                                    <div class="badge-mileage"><i class="fa-solid fa-gauge-high"></i> 18,500 Km</div>
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
                    <div class="my-4">
                        @include('partials.pagination')
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection