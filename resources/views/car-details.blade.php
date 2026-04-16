@extends('layouts.app')
@section('meta')
@php
    $year = $searched_vehicle->year ?? '';
    $make = $searched_vehicle->mfg_auto ?? '';
    $model = $searched_vehicle->model ?? '';
    $trim = $searched_vehicle->trim ?? '';
    $condition = $searched_vehicle->inventory_condition ?? '';
    
    // ✅ Add dots (.) between variables
    $vehicleTitle = trim($year . ' ' . $make . ' ' . $model);
    if (empty($vehicleTitle)) {
        $vehicleTitle = "Vehicle for Sale | Motokloz";
    }
    
    // ✅ Add dots (.) between variables
    $vehicleDescription = trim($condition . ' ' . $year . ' ' . $make . ' ' . $model . ' ' . $trim);
    if (empty($vehicleDescription)) {
        $vehicleDescription = "Check out this vehicle at Motokloz. Contact us for more details and pricing.";
    }
    
    $primaryImage = $searched_vehicle->primary_image ?? '';
    $defaultImage = 'https://motokloz.com/assets/images/defaultimage.jpg';
    $imageUrl = $defaultImage;
    
    if (!empty($primaryImage)) {
        // ✅ Fix: Remove spaces from filename
        $cleanImage = str_replace(' ', '%20', $primaryImage);
        
        if (str_starts_with($primaryImage, 'http')) {
            $imageUrl = $primaryImage;
        } else {
            $imageUrl = 'https://diskloz.ca/admin_assets/images/inventory_images/' . $cleanImage;
        }
    }
@endphp

{{-- CRITICAL META TAGS --}}
<title>{{ $vehicleTitle }}</title>
<meta name="title" content="{{ $vehicleTitle }}">
<meta name="description" content="{{ $vehicleDescription }}">

<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $vehicleTitle }}">
<meta property="og:description" content="{{ $vehicleDescription }}">
<meta property="og:image" content="{{ $imageUrl }}">
<meta property="og:site_name" content="Motokloz">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $vehicleTitle }}">
<meta name="twitter:description" content="{{ $vehicleDescription }}">
<meta name="twitter:image" content="{{ $imageUrl }}">

@endsection
<script>
    const BASE_URL = "{{ env('diskloz_base_url') }}";
</script>
@section('content')

@php
    $dealer = $dealer ?? null;

    // ✅ Source ek baar yahan set karo
    $source = ($dealer && !empty($dealer->is_motokloz_user)) ? 'motokloz' : 'diskloz';

    $dealerLogo = ($dealer && !empty($dealer->logo))
        ? (Str::startsWith($dealer->logo, 'http')
            ? $dealer->logo
            : env('diskloz_base_url') . '/admin_assets/images/dealer_images/' . $dealer->logo)
        : asset('assets/images/defaultdealerlogo.png');

    $detailUrl = ($dealer && !empty($dealer->id))
        ? route('dealer_inventory_details', ['id' => $dealer->id, 'source' => $source])
        : '#';

    $profileUrl   = $detailUrl;
    $inventoryUrl = ($dealer && !empty($dealer->id))
        ? route('dealer_inventory', ['id' => $dealer->id, 'source' => $source])
        : '#';

    $dealerCity     = $dealer->city          ?? null;
    $dealerProvince = $dealer->province      ?? null;
    $dealerName     = $dealer->legal_name    ?? $dealer->first_name ?? 'N/A';
    $dealerPhone    = $dealer->phone_no      ?? 'N/A';
    $dealerEmail    = $dealer->email         ?? 'N/A';
    $dealerAddress  = $dealer ? collect([
                            $dealer->physical_address ?? null,
                            $dealer->city             ?? null,
                            $dealer->province         ?? null,
                            $dealer->postal_code      ?? null,
                        ])->filter()->implode(', ') : '';

    $localInventoryId = $searched_vehicle->id     ?? null;
    $localDealerId    = $searched_vehicle->user_id
                        ?? $searched_vehicle->client_id
                        ?? $dealer->id
                        ?? null;
@endphp

<section class="gallery-section">
    <div class="container-fluid">
        <div class="row g-0">
            <div class="col-12">

                @php
                    $logo = [];

                    if (!empty($searched_vehicle->primary_image)) {
                        $logo[] = $searched_vehicle->primary_image;
                    }

                    if (!empty($searched_vehicle->inventory_logo)) {
                        $extra = explode('|', $searched_vehicle->inventory_logo);
                        $logo  = array_merge($logo, $extra);
                    }

                    if (empty($logo)) {
                        $logo[] = 'car_thumb.png';
                    }

                    $images       = array_filter($logo);
                    $images       = empty($images) ? ['default'] : $images;
                    $defaultImage = asset('assets/images/defaultimage.jpg');
                @endphp

                <!-- MAIN GALLERY -->
                <div class="swiper main-gallery-slider">
                    <div class="swiper-wrapper">
                        @foreach ($images as $eachLogo)
                            @php
                                $img = ($eachLogo == 'default' || str_contains($eachLogo, 'car_thumb.png'))
                                    ? $defaultImage
                                    : (Str::startsWith($eachLogo, 'http')
                                        ? $eachLogo
                                        : env('diskloz_base_url') . '/admin_assets/images/inventory_images/' . $eachLogo);
                            @endphp
                            <div class="swiper-slide">
                                <img src="{{ $img }}"
                                    class="img-fluid mto-lightbox-trigger"
                                    alt="Vehicle Image"
                                    data-full="{{ $img }}"
                                    style="cursor:zoom-in;"
                                    onerror="this.onerror=null;this.src='{{ $defaultImage }}';">
                            </div>
                        @endforeach
                    </div>

                    <div class="gallery-action-overlay">
                        <button class="btn-lexus-orange" data-bs-toggle="modal" data-bs-target="#galleryModal">
                            <i class="fa-solid fa-table-cells-large"></i> See All Photos ({{ count($images) }})
                        </button>
                        <button class="btn-lexus-white" data-bs-toggle="modal" data-bs-target="#videoModal">
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
                                $img = ($eachLogo == 'default' || str_contains($eachLogo, 'car_thumb.png'))
                                    ? $defaultImage
                                    : (Str::startsWith($eachLogo, 'http')
                                        ? $eachLogo
                                        : env('diskloz_base_url') . '/admin_assets/images/inventory_images/' . $eachLogo);
                            @endphp
                            <div class="swiper-slide">
                                <div class="thumbnail">
                                    <img src="{{ $img }}"
                                        class="img-thumbnail"
                                        alt="Thumbnail"
                                        onerror="this.onerror=null;this.src='{{ $defaultImage }}';">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0 position-sticky top-0 bg-dark z-3">
                <h5 class="modal-title text-white">
                    <i class="fa-solid fa-image me-2"></i> Photo Gallery
                    <span class="badge bg-orange ms-2">{{ count($images) }} Photos</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3">
                <div class="modal-gallery-grid">
                    @foreach ($images as $index => $eachLogo)
                        @php
                            $img = ($eachLogo == 'default' || str_contains($eachLogo, 'car_thumb.png'))
                                ? $defaultImage
                                : (Str::startsWith($eachLogo, 'http')
                                    ? $eachLogo
                                    : env('diskloz_base_url') . '/admin_assets/images/inventory_images/' . $eachLogo);
                        @endphp
                        <div class="modal-gallery-item" data-index="{{ $index }}">
                            <img src="{{ $img }}"
                                class="modal-gallery-img mto-lightbox-trigger"
                                alt="Vehicle Image {{ $index + 1 }}"
                                loading="lazy"
                                onclick="openImageViewer({{ $index }})"
                                onerror="this.onerror=null;this.src='{{ $defaultImage }}';">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<section class="mto-main-wrapper py-5">
    <div class="container">

        <div class="row mb-4 align-items-end" data-aos="fade-up" data-aos-duration="600">
            <div class="col-lg-8">
                <h2 class="mto-top-headline fw-bold">
                    {{ $searched_vehicle->inventory_condition ?? '' }}
                    {{ $searched_vehicle->year ?? '' }}
                    {{ $searched_vehicle->mfg_auto ?? '' }}
                    {{ $searched_vehicle->model ?? '' }}
                    {{ $searched_vehicle->trim ?? '' }}
                </h2>
                <div class="mto-meta-row d-flex flex-wrap gap-3 mt-3">
                    @if($dealerCity || $dealerProvince)
                        <span class="mto-meta-item">
                            <i class="fa-solid fa-location-dot me-1"></i>
                            {{ collect([$dealerCity, $dealerProvince])->filter()->implode(', ') }}
                        </span>
                    @endif

                    @if($dealer && !empty($dealer->id))
                        <a href="{{ $detailUrl }}" class="mto-map-link fw-bold">Show on map</a>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                <div class="mto-utility-btns d-flex gap-2 justify-content-lg-end mt-3 mt-lg-0">
                    <input type="hidden" id="inv_id" value="{{ $searched_vehicle->id ?? '' }}">

                    <button id="fetchButton" onclick="fetchAndPrint()" class="mto-pill-btn">
                        <img src="/assets/images/Printer.png" class="me-1" alt=""> Print Details
                    </button>

                    <button class="mto-pill-btn">
                        <img src="/assets/images/SVG.png" class="me-1" alt=""> Share
                    </button>

                    <button class="mto-pill-btn"
                        id="wishlist-btn-{{ $searched_vehicle->id }}"
                        onclick="toggleLike({{ $searched_vehicle->id }}, this, {{ auth()->id() ?? 'null' }})">
                        <i class="fa fa-spinner fa-spin me-1" id="wishlist-spinner-{{ $searched_vehicle->id }}"></i>
                        <i class="far fa-heart me-1 d-none" id="wishlist-icon-{{ $searched_vehicle->id }}"></i>
                        Wishlist
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">

                <div class="mto-specs-container mb-5" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
                    <div class="row g-2">
                        <div class="col-md-3 col-6">
                            <div class="mto-info-tile"><img src="/assets/images/icon01.png" alt=""> {{ $searched_vehicle->mileage ?? '' }} km</div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="mto-info-tile"><img src="/assets/images/icon02.png" alt=""> {{ $searched_vehicle->power_type ?? '' }}</div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="mto-info-tile"><img src="/assets/images/icon03.png" alt=""> {{ $searched_vehicle->transmission ?? '' }}</div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="mto-info-tile"><img src="/assets/images/drivetrains.png" alt=""> {{ $searched_vehicle->drivetrain ?? '' }}</div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="mto-info-tile"><img src="/assets/images/interiorcolor.png" width="20" alt=""> {{ $searched_vehicle->int_color ?? '' }}</div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="mto-info-tile"><img src="/assets/images/exteriorcolor.png" width="20" alt=""> {{ $searched_vehicle->ext_color ?? '' }}</div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="mto-info-tile"><img src="/assets/images/icon06.png" alt=""> {{ $searched_vehicle->body_style ?? '' }}</div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="mto-info-tile"><img src="/assets/images/icon08.png" alt=""> {{ $searched_vehicle->engine ?? '' }}</div>
                        </div>
                    </div>
                </div>

                <div class="mto-details-stack">

                    <div class="mto-stack-item mb-4" data-aos="fade-up" data-aos-duration="600">
                        <div class="mto-stack-trigger active d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">Vehicle Description</h5>
                            <i class="fa-solid fa-chevron-up mto-arrow"></i>
                        </div>
                        <div class="mto-stack-content show">
                            <p class="text-muted">{{ $searched_vehicle->notes_dicussion ?? 'No Description Mentioned!' }}</p>
                        </div>
                    </div>

                    <div class="mto-stack-item mb-4">
                        <div class="mto-stack-trigger d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">Seller Details & Promises</h5>
                            <i class="fa-solid fa-chevron-up mto-arrow"></i>
                        </div>
                        <div class="mto-stack-content">
                            <p class="text-muted">{{ $searched_vehicle->benefits_features ?? 'No Promises Mentioned!' }}</p>
                        </div>
                    </div>

                    <div class="mto-stack-item mb-4">
                        <div class="mto-stack-trigger d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">Options</h5>
                            <i class="fa-solid fa-chevron-down mto-arrow"></i>
                        </div>
                        <div class="mto-stack-content">
                            @php
                                $allOptions = array_filter(array_merge(
                                    array_filter(explode(',', $searched_vehicle->interior         ?? '')),
                                    array_filter(explode(',', $searched_vehicle->extras           ?? '')),
                                    array_filter(explode(',', $searched_vehicle->imp              ?? '')),
                                    array_filter(explode(',', $searched_vehicle->after_market_items ?? '')),
                                    array_filter(explode(';', $searched_vehicle->options          ?? ''))
                                ));
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

                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-left" data-aos-duration="700" data-aos-delay="100">
                <div class="mto-sticky-side">

                    
                    @if(strtolower($source ?? '') === 'motokloz')
                        <div class="mto-card-unit mb-4 p-4 shadow-sm">

                            <h6 class="fw-bold mb-3">Get Started</h6>

                            <!-- NEW Test Drive Button -->
                            <button type="button" class="mto-btn-orange w-100 mb-3"
                                data-bs-toggle="modal" data-bs-target="#motoklozTestDriveModal">
                                Schedule Test Drive <i class="fa-solid fa-car ms-2"></i>
                            </button>

                            <!-- NEW Offer Button -->
                            <button type="button" class="mto-btn-black w-100"
                                data-bs-toggle="modal" data-bs-target="#motoklozOfferModal">
                                Make An Offer Price <i class="fa-solid fa-hand-holding-dollar ms-2"></i>
                            </button>

                        </div>
                    @else
                        <!-- Get Started -->
                        <div class="mto-card-unit mb-4 p-4 shadow-sm">
                            <h6 class="fw-bold mb-3">Get Started</h6>

                            <button type="button" class="mto-btn-orange w-100 mb-3"
                                data-bs-toggle="modal" data-bs-target="#testDriveModal">
                                Schedule Test Drive <i class="fa-solid fa-car ms-2"></i>
                            </button>

                            <button type="button" class="mto-btn-black w-100"
                                data-bs-toggle="modal" data-bs-target="#offerModal">
                                Make An Offer Price <i class="fa-solid fa-hand-holding-dollar ms-2"></i>
                            </button>
                        </div>
                    @endif

                    <!-- Dealer Card -->
                    <div class="mto-card-unit p-4 shadow-sm">
                        <div class="d-flex justify-content-between mb-4 listed-card-right">
                            <span class="fw-bold">Listed by</span>
                            <span class="mto-rating-badge">
                                <i class="fa-solid fa-star me-1"></i> 4.96
                                <span class="fw-normal text-muted ms-1">(672 reviews)</span>
                            </span>
                        </div>

                        @if($dealer)

                            <a class="link-text-decoration" href="{{ $profileUrl }}">
                                <div class="d-flex align-items-center mb-4">
                                    <img src="{{ $dealerLogo }}"
                                        class="img-fluid dealerlogo rounded-circle me-3"
                                        alt="Dealer"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultdealerlogo.png') }}';">
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $dealerName }}</h6>
                                        <p class="small text-muted mb-0">{{ $dealerAddress }}</p>
                                    </div>
                                </div>
                            </a>

                            <div class="mto-contact-details small fw-semibold">
                                <div class="mb-2">
                                    <img src="/assets/images/Background (8).png" alt="phone" class="contact-icon light-dark">
                                    Mobile: {{ $dealerPhone }}
                                </div>
                                <div class="mb-2">
                                    <img src="/assets/images/Background (10).png" alt="email" class="contact-icon light-dark">
                                    Email: {{ $dealerEmail }}
                                </div>
                                <div class="mb-2">
                                    <img src="/assets/images/Background (11).png" alt="whatsapp" class="contact-icon light-dark">
                                    WhatsApp: {{ $dealerPhone }}
                                </div>
                            </div>
                        @else
                            <p class="text-muted small">Dealer info not available.</p>
                        @endif

                        {{-- Chat with Dealer --}}
                        @if($localInventoryId && $localDealerId)
                            @auth
                                @if(auth()->id() == $localDealerId)
                                    {{-- Owner: go to messages page --}}
                                    <a href="{{ route('chat.index') }}" class="mb-3 mt-4 d-block">
                                        <button type="button" class="mto-btn-black w-100 py-2">
                                            <i class="fa-regular fa-comment me-2"></i> My Messages
                                        </button>
                                    </a>
                                @else
                                    <form method="POST" action="{{ route('chat.start') }}" class="mb-3 mt-4">
                                        @csrf
                                        <input type="hidden" name="inventory_id" value="{{ $localInventoryId }}">
                                        <input type="hidden" name="dealer_id"    value="{{ $localDealerId }}">
                                        <button type="submit" class="mto-btn-black w-100 py-2">
                                            <i class="fa-regular fa-comment me-2"></i> Chat with Dealer
                                        </button>
                                    </form>
                            @endif
                            @else
                                <button type="button" class="mto-btn-black w-100 mt-4 mb-3 py-2"
                                    onclick="openChatLoginModal({{ $localInventoryId }}, {{ $localDealerId }}, '{{ route('chat.start') }}')">
                                    <i class="fa-regular fa-comment me-2"></i> Chat with Dealer
                                </button>
                            @endauth
                        @endif

                        {{-- Dealer Inventory Button --}}
                        @if($dealer && !empty($dealer->id) && $source !== 'motokloz')
                            <a href="{{ $inventoryUrl }}">
                                <button class="mto-btn-orange w-100 py-2">
                                    Dealer's Inventory
                                    <i class="fa-solid fa-arrow-right ms-2"></i>
                                </button>
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Test Drive Modal -->
    <div class="modal fade" id="testDriveModal" tabindex="-1" aria-labelledby="testDriveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testDriveModalLabel">Schedule Test Drive</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form data-ajax="true">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="name1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="number" class="form-control" id="phone1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Preferred Date</label>
                            <input type="date" class="form-control" id="date1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" id="message1" rows="3" placeholder="Any additional notes..."></textarea>
                        </div>
                        <button type="submit" class="mto-btn-orange w-100 mb-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Offer Modal -->
    <div class="modal fade" id="offerModal" tabindex="-1" aria-labelledby="offerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="offerModalLabel">Make An Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form data-ajax="true">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="name2" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email2" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="number" class="form-control" id="phone2" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Offer Price</label>
                            <input type="number" class="form-control" id="offerPrice" required>
                        </div>
                        <button type="submit" class="mto-btn-orange w-100 mb-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Motokloz Test Drive Modal -->
    <div class="modal fade" id="motoklozTestDriveModal" tabindex="-1" aria-labelledby="motoklozTestDriveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="motoklozTestDriveModalLabel">Schedule Test Drive</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="motoklozTestDriveForm" data-ajax="true">
                        @csrf
                        <input type="hidden" name="source" value="motokloz">
                        <input type="hidden" name="vehicle_id" value="{{ $searched_vehicle->id ?? '' }}">
                        <input type="hidden" name="dealer_email" value="{{ $dealerEmail }}">
                        
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="m_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="m_email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control" name="phone" id="m_phone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Preferred Date</label>
                            <input type="date" class="form-control" name="date" id="m_date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="message" id="m_message" rows="3" placeholder="Any additional notes..."></textarea>
                        </div>
                        <button type="submit" class="mto-btn-orange w-100 mb-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Motokloz Offer Modal -->
    <div class="modal fade" id="motoklozOfferModal" tabindex="-1" aria-labelledby="motoklozOfferModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="motoklozOfferModalLabel">Make An Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="motoklozOfferForm" data-ajax="true">
                        @csrf
                        <input type="hidden" name="source" value="motokloz">
                        <input type="hidden" name="vehicle_id" value="{{ $searched_vehicle->id ?? '' }}">
                        <input type="hidden" name="dealer_email" value="{{ $dealerEmail }}">
                        
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="m_offer_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="m_offer_email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control" name="phone" id="m_offer_phone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Offer Price</label>
                            <input type="number" class="form-control" name="offer_price" id="m_offer_price" required>
                        </div>
                        <button type="submit" class="mto-btn-orange w-100 mb-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="height: 60vh;">
                <div class="modal-header">
                    <h5 class="modal-title">Vehicle Videos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="overflow-y: auto; max-height: calc(60vh - 70px);">
                    @if(!empty($videos) && count($videos) > 0)
                        <div class="row">
                            @foreach($videos as $video)
                                <div class="col-md-6 mb-3">
                                    <video width="100%" height="200" controls controlslist="nodownload"
                                        style="object-fit: cover; border-radius: 12px;">
                                        <source src="{{ $video->video_url ?? '' }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No videos available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>


// ===================== GLOBAL ERROR HANDLER =====================
function handleAjaxError(xhr) {
    console.error('AJAX Error Details:', {
        status: xhr.status,
        statusText: xhr.statusText,
        responseText: xhr.responseText,
        responseJSON: xhr.responseJSON
    });
    
    if (xhr.status === 422 && xhr.responseJSON?.errors) {
        const msgs = Object.values(xhr.responseJSON.errors).flat();
        showSnackbar(msgs.join(' | '), 'error');
    } else if (xhr.status === 419) {
        showSnackbar('Session expired. Refreshing...', 'warning');
        setTimeout(() => location.reload(), 1500);
    } else if (xhr.status === 0) {
        showSnackbar('Network error. Check your connection.', 'error');
    } else if (xhr.status === 404) {
        showSnackbar('Resource not found.', 'error');
    } else if (xhr.status === 500) {
        showSnackbar('Server error. Please try again later.', 'error');
    } else {
        showSnackbar(xhr.responseJSON?.message || 'Something went wrong.', 'error');
    }
}

// ===================== BUTTON HELPERS =====================
function setButtonLoading($btn) {
    $btn.prop('disabled', true)
        .data('original-html', $btn.html())
        .html('<i class="fas fa-spinner fa-spin"></i> Please wait...');
}

function resetButton($btn) {
    $btn.prop('disabled', false).html($btn.data('original-html'));
}

// ===================== CSRF =====================
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

$(document).ready(function () {
    
    // CSRF Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // Test Drive Form Submit
    $('#motoklozTestDriveForm').on('submit', function (e) {
        e.preventDefault();
        
        var $form = $(this);
        var $btn = $form.find('button[type="submit"]');
        
        // Get form data
        var formData = {
            name: $('#m_name').val().trim(),
            email: $('#m_email').val().trim(),
            phone: $('#m_phone').val().trim(),
            date: $('#m_date').val().trim(),
            message: $('#m_message').val(),
            source: $form.find('input[name="source"]').val(),
            vehicle_id: $form.find('input[name="vehicle_id"]').val(),
            dealer_email: $form.find('input[name="dealer_email"]').val()
        };

        // Validation
        if (!formData.name || !formData.email || !formData.phone || !formData.date) {
            showSnackbar('Please fill all required fields!', 'warning');
            return;
        }

        // Disable button
        var $btn = $(this).find('button[type="submit"]');
        setButtonLoading($btn);

        // Send AJAX
        $.ajax({
            url: "/test-drive-mail",
            method: "POST",
            data: formData,
            success: function (response) {
                showSnackbar('Test drive request sent successfully!');
                $('#motoklozTestDriveModal').modal('hide');
                $form[0].reset();
            },
            error: function (xhr) {
                if (xhr.status === 419) {
                    showSnackbar('Session expired. Refreshing page...', 'error');
                    location.reload();
                } else {
                    showSnackbar('Error: ' + (xhr.responseJSON?.message || 'Something went wrong'), 'error');
                }
            },
            complete: function () {
                $btn.prop('disabled', false).text('Submit');
            }
        });
    });

    // Offer Form Submit
    $('#motoklozOfferForm').on('submit', function (e) {
        e.preventDefault();
        
        var $form = $(this);
        var $btn = $form.find('button[type="submit"]');
        
        // Get form data
        var formData = {
            name: $('#m_offer_name').val().trim(),
            email: $('#m_offer_email').val().trim(),
            phone: $('#m_offer_phone').val().trim(),
            offer_price: $('#m_offer_price').val(),
            source: $form.find('input[name="source"]').val(),
            vehicle_id: $form.find('input[name="vehicle_id"]').val(),
            dealer_email: $form.find('input[name="dealer_email"]').val()
        };

        // Validation
        if (!formData.name || !formData.email || !formData.phone || !formData.offer_price) {
            showSnackbar('Please fill all required fields!', 'warning');
            return;
        }

        // Disable button
        var $btn = $(this).find('button[type="submit"]');
        setButtonLoading($btn);

        // Send AJAX
        $.ajax({
            url: "/offer-mail",
            method: "POST",
            data: formData,
            success: function (response) {
                showSnackbar('Offer sent successfully!');
                $('#motoklozOfferModal').modal('hide');
                $form[0].reset();
            },
            error: function (xhr) {
                if (xhr.status === 419) {
                    showSnackbar('Session expired. Refreshing page...', 'error');
                    location.reload();
                } else {
                    showSnackbar('Error: ' + (xhr.responseJSON?.message || 'Something went wrong'), 'error');
                }
            },
            complete: function () {
                $btn.prop('disabled', false).text('Submit');
            }
        });
    });

});


$(document).ready(function () {
    // ✅ dealer id — PHP se ek baar set karo
    var dealerId = {{ ($dealer && !empty($dealer->id)) ? $dealer->id : 'null' }};
    var productId = {{ $searched_vehicle->id ?? 'null' }};

    // ===================== TEST DRIVE =====================
    $('#testDriveModal form').on('submit', function (e) {
        e.preventDefault();

        var name     = $('#name1').val().trim();
        var email    = $('#email1').val().trim();
        var phone    = $('#phone1').val().trim();
        var bookDate = $('#date1').val().trim();

        if (!name || !email || !phone) {
            showSnackbar('Name, email and phone are required.', 'warning');
            return;
        }
        if (!/^[^\s@]+@([^\s@]+\.)+[^\s@]+$/.test(email)) {
            showSnackbar('Please enter a valid email address.', 'warning');
            return;
        }
        if (!bookDate) {
            showSnackbar('Please select a preferred date.', 'warning');
            return;
        }

        var $btn = $(this).find('button[type="submit"]');
        setButtonLoading($btn);

        $.ajax({
            url: "{{ env('diskloz_base_url') }}/api/leads",
            method: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify({
                name, email, phone,
                book_date: bookDate,
                message: $('#message1').val(),
                reason: 'Schedule Test Drive',
                type: 'WEBLEAD',
                source: 'Motokloz',
                lead_status: 'NEW',
                dealer_id: dealerId,
                product_id: productId,
                lead_source: 'Website',
                lead_type: 'Test Drive'
            }),
            success: function () {
                showSnackbar('Test drive scheduled successfully!', 'success');
                $('#testDriveModal').modal('hide');
                $('#testDriveModal form')[0].reset();
            },
            error: handleAjaxError,
            complete: function () { resetButton($btn); }
        });
    });

    // ===================== OFFER =====================
    $('#offerModal form').on('submit', function (e) {
        e.preventDefault();

        var name       = $('#name2').val().trim();
        var email      = $('#email2').val().trim();
        var phone      = $('#phone2').val().trim();
        var offerPrice = parseFloat($('#offerPrice').val());

        if (!name || !email || !phone) {
            showSnackbar('Name, email and phone are required.', 'warning');
            return;
        }
        if (!/^[^\s@]+@([^\s@]+\.)+[^\s@]+$/.test(email)) {
            showSnackbar('Please enter a valid email address.', 'warning');
            return;
        }
        if (!offerPrice || offerPrice <= 0) {
            showSnackbar('Please enter a valid offer price.', 'warning');
            return;
        }

        var $btn = $(this).find('button[type="submit"]');
        setButtonLoading($btn);

        $.ajax({
            url: "{{ env('diskloz_base_url') }}/api/leads",
            method: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify({
                name, email, phone,
                offer_price: offerPrice,
                reason: 'Make An Offer Price',
                type: 'WEBLEAD',
                source: 'Motokloz',
                lead_status: 'NEW',
                dealer_id: dealerId,
                product_id: productId,
                lead_source: 'Website',
                lead_type: 'Offer'
            }),
            success: function () {
                showSnackbar('Offer submitted successfully!', 'success');
                $('#offerModal').modal('hide');
                $('#offerModal form')[0].reset();
            },
            error: handleAjaxError,
            complete: function () { resetButton($btn); }
        });
    });

    // ===================== FAVORITES =====================
    var clientId = {{ auth()->id() ?? 'null' }};

    function loadFavorites() {
        if (!clientId) { hideAllSpinners(); return; }

        fetch(`${BASE_URL}/api/favorites?client_id=${clientId}`)
            .then(res => { if (!res.ok) throw new Error(res.status); return res.json(); })
            .then(data => {
                var likedIds = new Set((data || []).map(item => item.inventory_id));
                $('button[id^="wishlist-btn-"]').each(function () {
                    var id      = parseInt(this.id.replace('wishlist-btn-', ''));
                    var $spinner = $('#wishlist-spinner-' + id);
                    var $icon    = $('#wishlist-icon-' + id);
                    $spinner.addClass('d-none');
                    $icon.removeClass('d-none');
                    if (likedIds.has(id)) {
                        $icon.removeClass('far').addClass('fas');
                        $(this).addClass('active');
                    } else {
                        $icon.removeClass('fas').addClass('far');
                        $(this).removeClass('active');
                    }
                });
            })
            .catch(() => hideAllSpinners());
    }

    function hideAllSpinners() {
        $('[id^="wishlist-spinner-"]').addClass('d-none');
        $('[id^="wishlist-icon-"]').removeClass('d-none');
    }

    loadFavorites();
});

// ===================== WISHLIST TOGGLE =====================
function toggleLike(vehicleId, element, authId) {
    if (!authId || authId === 'null') { window.location.href = '/login'; return; }

    var $btn  = $(element);
    var $icon = $('#wishlist-icon-' + vehicleId);
    var isLiked = $btn.hasClass('active');

    $btn.prop('disabled', true);

    var formData = new FormData();
    formData.append('client_id', authId);
    formData.append('vehicle_id', vehicleId);

    $.ajax({
        url: isLiked ? '/remove_like' : '/add_like',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                if (isLiked) {
                    $btn.removeClass('active');
                    $icon.removeClass('fas').addClass('far');
                    showSnackbar('Removed from wishlist.', 'info');
                } else {
                    $btn.addClass('active');
                    $icon.removeClass('far').addClass('fas');
                    showSnackbar('Added to wishlist!', 'success');
                }
            } else {
                showSnackbar(res.message || 'Operation failed.', 'error');
            }
        },
        error: handleAjaxError,
        complete: function () { $btn.prop('disabled', false); }
    });
}

// ===================== PDF PRINT =====================
function fetchAndPrint() {
    var $btn  = $('#fetchButton');
    var invId = parseInt($('#inv_id').val());

    if (!invId || invId <= 0 || isNaN(invId)) {
        showSnackbar('Inventory ID not found. Please refresh.', 'error');
        return;
    }

    setButtonLoading($btn);

    $.ajax({
        url: '/pdf/disklozer/' + invId,
        method: 'GET',
        xhrFields: { responseType: 'blob' },
        success: function (blob) {
            if (blob.type === 'application/pdf') {
                var url = URL.createObjectURL(blob);
                var win = window.open(url, '_blank');
                if (!win || win.closed || typeof win.closed === 'undefined') {
                    showSnackbar('Popup blocked. Please allow popups for this site.', 'warning');
                }
                setTimeout(() => URL.revokeObjectURL(url), 2000);
            } else {
                var reader = new FileReader();
                reader.onload = function () {
                    try {
                        var err = JSON.parse(reader.result);
                        showSnackbar(err.message || 'Error generating PDF.', 'error');
                    } catch (e) {
                        showSnackbar('Unexpected error generating PDF.', 'error');
                    }
                };
                reader.readAsText(blob);
            }
        },
        error: handleAjaxError,
        complete: function () { resetButton($btn); }
    });
}

// ===================== GALLERY =====================
let galleryImages = [];
let currentImageIndex = 0;

document.addEventListener('DOMContentLoaded', function () {
    galleryImages = {!! json_encode(array_map(function ($img) use ($defaultImage) {
        if ($img == 'default' || str_contains($img, 'car_thumb.png')) {
            return $defaultImage;
        }
        return Str::startsWith($img, 'http')
            ? $img
            : env('diskloz_base_url') . '/admin_assets/images/inventory_images/' . $img;
    }, $images)) !!};

    window.openImageViewer = function (index) {
        currentImageIndex = index;
        updateFullscreenImage();
        new bootstrap.Modal(document.getElementById('imageViewerModal')).show();
    };

    function updateFullscreenImage() {
        var el = document.getElementById('fullscreenImage');
        if (el && galleryImages[currentImageIndex]) el.src = galleryImages[currentImageIndex];
    }

    window.nextImage = function () {
        currentImageIndex = (currentImageIndex < galleryImages.length - 1) ? currentImageIndex + 1 : 0;
        updateFullscreenImage();
    };

    window.prevImage = function () {
        currentImageIndex = (currentImageIndex > 0) ? currentImageIndex - 1 : galleryImages.length - 1;
        updateFullscreenImage();
    };

    document.addEventListener('keydown', function (e) {
        var modal = document.getElementById('imageViewerModal');
        if (modal && modal.classList.contains('show')) {
            if (e.key === 'ArrowLeft')  prevImage();
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'Escape') modal.querySelector('.btn-close')?.click();
        }
    });

    var fullscreenImg = document.getElementById('fullscreenImage');
    if (fullscreenImg) {
        let scale = 1;
        fullscreenImg.addEventListener('click', function (e) {
            e.stopPropagation();
            scale = scale === 1 ? 2 : 1;
            this.style.transform  = `scale(${scale})`;
            this.style.transition = 'transform 0.3s ease';
            this.style.cursor     = scale === 2 ? 'zoom-out' : 'zoom-in';
        });
    }
});
</script>

<style>
    .listed-card-right { border-bottom: 1px solid #DDE1DE; padding-bottom: 14px; }
    .mto-contact-details div { display: flex; align-items: center; gap: 8px; }
    .contact-icon { width: 16px; height: 16px; }
    .mto-pill-btn.disabled, .mto-pill-btn:disabled { opacity: 0.6; cursor: not-allowed; pointer-events: none; }
    .modal-gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; padding: 10px; }
    .modal-gallery-item { position: relative; cursor: pointer; overflow: hidden; border-radius: 12px; aspect-ratio: 4/3; background-color: #2a2a2a; transition: transform .3s ease, box-shadow .3s ease; }
    .modal-gallery-item:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,.3); }
    .modal-gallery-img { width: 100%; height: 100%; object-fit: cover; transition: transform .3s ease; }
    .modal-gallery-item:hover .modal-gallery-img { transform: scale(1.05); }
    @media (max-width: 768px) { .modal-gallery-grid { grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 12px; } }
    @media (max-width: 480px) { .modal-gallery-grid { grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 8px; } }
</style>

@endsection