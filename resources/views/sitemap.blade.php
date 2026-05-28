<!-- Main Content -->
<div class="col-lg-9 wishlist-sec">

    <!-- Header Bar -->
    <div class="wishlist-header d-flex justify-content-between align-items-center px-3 px-md-4 py-3">
        <h5 class="search-head">Inventory List</h5>
        
        <!-- Optional: Add search/filter if needed -->
        <div class="d-flex align-items-center gap-2 header-actions">
            <div class="position-relative searchbar">
                <form action="{{ request()->url() }}" method="GET" id="searchForm">
                    <input type="text" 
                        name="search" 
                        class="form-control rounded-pill ps-5 pe-3 w-100" 
                        placeholder="Search Inventory"
                        value="{{ $searchTerm ?? '' }}">
                    <span class="position-absolute top-50 start-0 translate-middle-y ps-3">
                        <img src="/assets/images/Vector (13).png" alt="search" width="16" height="16">
                    </span>
                </form>
            </div>
        </div>
    </div>
    
    <div class="wishlist-body">
        <!-- Inventory Items -->
        <div class="wishlist-items">
            @forelse($inventories as $inventory)
                         @php
    // Check if this is Motokloz inventory
    $isMotoklozInventory = isset($inventory->source) && $inventory->source === 'Motokloz';
    
    // Get required data for modals
    $vehicleId = $inventory->id ?? '';
    $dealerId = $inventory->user_id ?? '';
    $dealerEmail = $inventory->dealer_email ?? '';
    
    // Create URL-friendly slug with validation
    $vehicleName = trim(($inventory->year ?? '') . ' ' . 
                  ($inventory->mfg_auto ?? '') . ' ' . 
                  ($inventory->model ?? ''));
    
    // Generate slug only if we have valid data
    if (!empty($vehicleName) && !empty($inventory->id)) {
        $slug = Str::slug($vehicleName, '-');
        // If slug is empty after slugify (e.g., special characters only), use fallback
        if (empty($slug)) {
            $slug = 'vehicle-' . $inventory->id;
        }
        try {
            $detailUrl = route('inventory_product_details', ['name' => $slug, 'id' => $inventory->id]);
        } catch (\Exception $e) {
            $detailUrl = 'javascript:void(0)';
        }
    } else {
        // Fallback for invalid data
        $slug = 'vehicle';
        $detailUrl = 'javascript:void(0)';
    }
    
    // Price formatting
    $cleanedPrice = preg_replace('/[^0-9.]/', '', $inventory->disclosed_price ?? '0');
    $displayPrice = round((float) $cleanedPrice);
    
    // Dealer location
    $dealerPostalCode = $inventory->dealer_postal_code ?? $inventory->postal_code ?? '';
    $dealerCity = $inventory->dealer_city ?? $inventory->city ?? '';
    $dealerProvince = $inventory->dealer_province ?? $inventory->province ?? '';
    $dealerCountry = $inventory->dealer_country ?? $inventory->country ?? '';
    
    // Phone for call seller
    $cardPhone = null;
    if (!empty($inventory->dealer->phone_no)) {
        $cardPhone = $inventory->dealer->phone_no;
    } elseif (!empty($inventory->dealer_phone_no)) {
        $cardPhone = $inventory->dealer_phone_no;
    }
    $disklozBaseUrl = 'https://diskloz.ca';
@endphp
                
                <!-- Inventory Card -->
                <div class="wishlist-card mb-4" data-aos="fade-up" data-aos-duration="600">
                    <div class="row g-0">
                        <div class="col-md-5">
                           @if($detailUrl !== 'javascript:void(0)')
                                <a href="{{ $detailUrl }}">
                                    <img style="width:10%" src="{{ $inventory->primary_image 
                                        ? (Str::startsWith($inventory->primary_image,'http') 
                                            ? $inventory->primary_image 
                                            : $disklozBaseUrl.'/admin_assets/images/inventory_images/'.$inventory->primary_image)
                                        : asset('assets/images/defaultimage.jpg') }}"
                                        alt="Vehicle Image"
                                        class="img-fluid rounded-start wishlist-img"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultimage.jpg') }}';">
                                </a>
                            @else
                                <img style="width:10%" src="{{ $inventory->primary_image 
                                    ? (Str::startsWith($inventory->primary_image,'http') 
                                        ? $inventory->primary_image 
                                        : $disklozBaseUrl.'/admin_assets/images/inventory_images/'.$inventory->primary_image)
                                    : asset('assets/images/defaultimage.jpg') }}"
                                    alt="Vehicle Image"
                                    class="img-fluid rounded-start wishlist-img"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultimage.jpg') }}';">
                            @endif
                        </div>
                        <div class="col-md-7 cards-wish-all">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2 badge-main">
                                    @if(isset($inventory->discount) && $inventory->discount > 0)
                                        <span class="discount-badge">-{{ $inventory->discount }}%</span>
                                    @else
                                        <span class="discount-badge">-{{ $inventory->discount ?? '0' }}%</span>
                                    @endif
                                </div>
                                
                                <div class="rating-all d-flex align-items-center gap-2 mb-2">
                                    <img src="/assets/images/Vector (12).png" alt="rating" width="16">
                                    <p class="rating-all-p mb-0">
                                        <strong>{{ $inventory->rating ?? '4.96' }}</strong> 
                                        ({{ $inventory->reviews ?? '672' }} reviews)
                                    </p>
                                </div>

                                <h5 class="card-title fw-bold mb-2">
                                    {{ $inventory->year ?? '' }} {{ $inventory->mfg_auto ?? '' }} {{ $inventory->model ?? '' }} {{ $inventory->trim ?? '' }}
                                </h5>

                                <p class="car-distance-away mb-2"
                                    data-dealer-postal="{{ $dealerPostalCode }}"
                                    data-dealer-city="{{ $dealerCity }}"
                                    data-dealer-province="{{ $dealerProvince }}"
                                    data-dealer-country="{{ $dealerCountry }}">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="distance-value">Loading...</span>
                                </p>

                                <div class="d-flex justify-content-between align-items-center">
                                    @if($displayPrice > 0)
                                        <div class="price-wrap">
                                            <span class="text-span">From</span>
                                            <span class="price-span">${{ number_format($displayPrice) }}</span>
                                            <span class="text-span">/ USD</span>
                                        </div>
                                    @else
                                        @if($cardPhone)
                                            <a href="tel:{{ $cardPhone }}" class="price-value call-seller text-decoration-none">
                                                <i class="fa-solid fa-phone-volume me-1"></i> Call Seller for Details
                                            </a>
                                        @else
                                            <span class="price-value call-seller">
                                                <i class="fa-solid fa-phone-volume me-1"></i> Call Seller for Details
                                            </span>
                                        @endif
                                    @endif
                                    
                                    @if($isMotoklozInventory)
                                        <button class="book-btn motokloz-book-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#motoklozBookNow"
                                                data-vehicle-id="{{ $vehicleId }}"
                                                data-dealer-email="{{ $dealerEmail }}">
                                            Book Now
                                        </button>
                                    @else
                                        <button class="book-btn dealer-book-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#testBookNow"
                                                data-dealer-id="{{ $dealerId }}"
                                                data-product-id="{{ $vehicleId }}">
                                            Book Now
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="fas fa-car fa-2x text-muted mb-3"></i>
                    <p class="text-muted">No inventory items found.</p>
                </div>
            @endforelse
        </div>
        
      
    </div>
</div>