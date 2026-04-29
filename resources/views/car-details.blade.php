@extends('layouts.app')
@section('title', $pageTitle ?? 'Motokloz | Car Details')

@section('meta')
@php
function formatPrice($price)
{
    $cleaned = str_replace(['$', ','], '', $price);
    $number = is_numeric($cleaned) ? (float) $cleaned : 0;
    return number_format($number, 0, '.', ','); // 👈 yahan 2 → 0
}
@endphp
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
@section('title', $vehicleTitle)
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

    // ✅ Source directly from inventory record — most reliable
    $source = strtolower($searched_vehicle->source ?? '');
    if (!in_array($source, ['motokloz', 'diskloz'])) {
        // fallback: is_motokloz_user flag check
        $source = ($dealer && !empty($dealer->is_motokloz_user)) ? 'motokloz' : 'diskloz';
    }

    $dealerLogo = ($dealer && !empty($dealer->logo))
        ? (Str::startsWith($dealer->logo, 'http')
            ? $dealer->logo
            : env('diskloz_base_url') . '/admin_assets/images/dealer_images/' . $dealer->logo)
        : asset('assets/images/defaultdealerlogo.png');

    // ✅ Create slug from dealer name
    $dealerNameForUrl = $dealer->dba ?? $dealer->first_name ?? 'dealer';
    $dealerSlug = preg_replace('/[^a-z0-9]+/', '-', strtolower($dealerNameForUrl));
    $dealerSlug = trim($dealerSlug, '-');
    $dealerId = $dealer->id ?? 0;

    // ✅ Fix: Pass both 'name' and 'id' parameters
    $detailUrl = ($dealer && !empty($dealer->id))
        ? route('dealer_inventory_details', ['name' => $dealerSlug, 'id' => $dealer->id, 'source' => $source])
        : '#';

    $profileUrl   = $detailUrl;
    
    $inventoryUrl = ($dealer && !empty($dealer->id))
        ? route('dealer_inventory', ['id' => $dealer->id, 'source' => $source])
        : '#';

    $dealerCity     = $dealer->city          ?? null;
    $dealerProvince = $dealer->province      ?? null;
    $dealerName     = $dealer->dba    ?? $dealer->first_name ?? 'N/A';
    $dealerPhone    = $dealer->phone_no      ?? 'N/A';
    $dealerEmail    = $dealer->email         ?? 'N/A';
    $dealerAddress  = $dealer ? collect([
                            $dealer->physical_address ?? null,
                            $dealer->city             ?? null,
                            $dealer->province         ?? null,
                            $dealer->postal_code      ?? null,
                        ])->filter()->implode(', ') : '';
    $dealerRegulator = $dealer->regulator     ?? null;
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

        <div style="    z-index: 1;
    position: relative;" class="row mb-4 align-items-end " data-aos="fade-up" data-aos-duration="600">
            <div class="col-lg-8">
                <h1 class="mto-top-headline fw-bold">
                    {{ $searched_vehicle->inventory_condition ?? '' }}
                    {{ $searched_vehicle->year ?? '' }}
                    {{ $searched_vehicle->mfg_auto ?? '' }}
                    {{ $searched_vehicle->model ?? '' }}
                    {{ $searched_vehicle->trim ?? '' }}
                    {{ $searched_vehicle->stock_number ?? '' }}
                </h1>
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

                    @php
                        $shareTitle = urlencode(trim(($searched_vehicle->year ?? '') . ' ' . ($searched_vehicle->mfg_auto ?? '') . ' ' . ($searched_vehicle->model ?? '')));
                        $shareUrl   = urlencode(url()->current());
                    @endphp
                    <div style="position:relative; display:flex;">
                        <button class="mto-pill-btn" onclick="document.getElementById('sm').classList.toggle('d-none');event.stopPropagation()">
                            <img src="/assets/images/SVG.png" class="me-1" alt=""> Share
                        </button>
                        <div id="sm" class="d-none" style="position:absolute;top:calc(100% + 8px);left:0;background:#fff;border:1px solid #eee;border-radius:14px;box-shadow:0 8px 28px rgba(0,0,0,.13);z-index:200;padding:8px;display:flex;gap:8px;white-space:nowrap;">
                            <a href="https://wa.me/?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" title="WhatsApp" style="display:flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:50%;background:#25D366;color:#fff;text-decoration:none;font-size:18px;"><svg width="20" height="20" viewBox="0 0 24 24" fill="#fff"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" title="Facebook" style="display:flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:50%;background:#1877F2;color:#fff;text-decoration:none;font-size:18px;"><svg width="20" height="20" viewBox="0 0 24 24" fill="#fff"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                            <a href="https://twitter.com/intent/tweet?text={{ $shareTitle }}&url={{ $shareUrl }}" target="_blank" title="Twitter/X" style="display:flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:50%;background:#000;color:#fff;text-decoration:none;font-size:18px;"><svg width="18" height="18" viewBox="0 0 24 24" fill="#fff"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
                            <a href="https://www.instagram.com/" target="_blank" title="Instagram" style="display:flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:50%;background:linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888);color:#fff;text-decoration:none;font-size:18px;"><svg width="18" height="18" viewBox="0 0 24 24" fill="#fff"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
                            <button onclick="navigator.clipboard.writeText(window.location.href);document.getElementById('sm').classList.add('d-none')" title="Copy Link" style="display:flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:50%;background:#6c757d;color:#fff;border:none;cursor:pointer;font-size:18px;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg></button>
                        </div>
                    </div>
                    <script>document.addEventListener('click',function(){var m=document.getElementById('sm');if(m)m.classList.add('d-none')});</script>

                    @if(!($isOwnVehicle ?? false))
                    <button class="mto-pill-btn"
                        id="wishlist-btn-{{ $searched_vehicle->id }}"
                        onclick="toggleLike({{ $searched_vehicle->id }}, this, {{ auth()->id() ?? 'null' }})">
                        <i class="fa fa-spinner fa-spin me-1" id="wishlist-spinner-{{ $searched_vehicle->id }}"></i>
                        <i class="far fa-star me-1 d-none" id="wishlist-icon-{{ $searched_vehicle->id }}"></i>
                        Wishlist
                    </button>
                    @endif
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
                    <!-- Dealer Card -->
                    <div class="mto-card-unit p-4 mb-4 shadow-sm">
                        <div class="d-flex justify-content-between mb-4 listed-card-right">
                            <span class="fw-bold">Listed by</span>
                            <!-- <span class="mto-rating-badge">
                                <i class="fa-solid fa-star me-1"></i> 4.96
                                <span class="fw-normal text-muted ms-1">(672 reviews)</span>
                            </span> -->
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
                                        <p class="small text-muted mb-0">
                                            {{ $dealerAddress }}
                                        </p>
                                        <p class="small text-muted mb-0">
                                            <i class="fas fa-id-card text-warning me-1"></i>
                                            {{ $dealerRegulator }}
                                        </p>
                                    </div>
                                </div>
                            </a>

                            <div class="mto-contact-details small fw-semibold">
                                <div class="mb-2">
                                    <img src="/assets/images/Background (8).png" alt="phone" class="contact-icon light-dark">
                                    @if($dealerPhone !== 'N/A')
                                        Phone: <a href="tel:{{ $dealerPhone }}" class="dealer-contact-link">{{ $dealerPhone }}</a>
                                    @else
                                        Phone: N/A
                                    @endif
                                </div>
                                <div class="mb-2">
                                    <img src="/assets/images/Background (10).png" alt="email" class="contact-icon light-dark">
                                    Email: {{ $dealerEmail }}
                                </div>
                                <div class="mb-2">
                                    <img src="/assets/images/Background (11).png" alt="whatsapp" class="contact-icon light-dark">
                                    @if($dealerPhone !== 'N/A')
                                        WhatsApp: <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $dealerPhone) }}" target="_blank" class="dealer-contact-link">{{ $dealerPhone }}</a>
                                    @else
                                        WhatsApp: N/A
                                    @endif
                                </div>
                                @if($searched_vehicle->dealer && $searched_vehicle->dealer->subaccount && $dealer->subaccount->twilio_phone_number)
                                    <div class="mb-2">
                                        <img src="/assets/images/Background (11).png" width="20" alt="whatsapp" class="contact-icon light-dark"> 
                                        SMS: {{ $searched_vehicle->dealer->subaccount->twilio_phone_number }}
                                    </div>
                                @endif
                            </div>
                        @else
                            <p class="text-muted small">Dealer info not available.</p>
                        @endif

                        {{-- Dealer Inventory Button --}}
                        @if($dealer && !empty($dealer->id) && $source !== 'motokloz')
                            <a href="{{ $inventoryUrl }}">
                                <button class="mto-btn-orange mt-2 w-100 py-2">
                                    Dealer's Inventory
                                    <i class="fa-solid fa-arrow-right ms-2"></i>
                                </button>
                            </a>
                        @endif
                    </div>
                    @if(strtolower($source ?? '') === 'motokloz')
                        <div class="mto-card-unit mb-4 p-4 shadow-sm">

                            <h6 class="fw-bold mb-3">Get Started</h6>

                            <!-- NEW Test Drive Button -->
                            <button type="button" class="mto-btn-orange w-100 mb-3"
                                data-bs-toggle="modal" data-bs-target="#motoklozTestDriveModal">
                                Schedule Test Drive <i class="fa-solid fa-car ms-2"></i>
                            </button>

                            <!-- NEW Offer Button -->
                            <button type="button" class="mto-btn-black w-100 mb-3"
                                data-bs-toggle="modal" data-bs-target="#motoklozOfferModal">
                                Make An Offer <i class="fa-solid fa-hand-holding-dollar ms-2"></i>
                            </button>

                            <!-- NEW Chat Button -->
                            <button type="button"
                                class="mto-btn-black w-100 mb-3"
                                onclick="window.location.href='sms:{{ $dealerPhone }}'">
                                <i class="fa-solid fa-message me-2"></i> SMS
                            </button>

                            {{-- Chat with Dealer --}}
                            @if($localInventoryId && $localDealerId)
                                @auth
                                    @if(auth()->id() == $localDealerId)
                                        {{-- Owner: go to messages page --}}
                                        <a href="{{ route('chat.index') }}" class="mb-3 d-block">
                                            <button type="button" class="mto-btn-black w-100">
                                                <i class="fa-regular fa-comment me-2"></i> My Messages
                                            </button>
                                        </a>
                                    @else
                                        <form method="POST" action="{{ route('chat.start') }}">
                                            @csrf
                                            <input type="hidden" name="inventory_id" value="{{ $localInventoryId }}">
                                            <input type="hidden" name="dealer_id"    value="{{ $localDealerId }}">
                                            <input type="hidden" name="source"       value="{{ $source }}">
                                            <button type="submit" class="mto-btn-black w-100">
                                                <i class="fa-regular fa-comment me-2"></i> Chat with Dealer
                                            </button>
                                        </form>
                                @endif
                                @else
                                    <button type="button" class="mto-btn-black w-100"
                                        onclick="openChatLoginModal({{ $localInventoryId }}, {{ $localDealerId }}, '{{ route('chat.start') }}')">
                                        <i class="fa-regular fa-comment me-2"></i> Chat with Dealer
                                    </button>
                                @endauth
                            @endif
                        </div>
                    @else
                        <!-- Get Started -->
                        <div class="mto-card-unit mb-4 p-4 shadow-sm">
                            <h6 class="fw-bold mb-3">Get Started</h6>

                            <button type="button" class="mto-btn-orange w-100 mb-3"
                                data-bs-toggle="modal" data-bs-target="#testDriveModals">
                                Schedule Test Drive <i class="fa-solid fa-car ms-2"></i>
                            </button>

                            <button type="button" class="mto-btn-black w-100 mb-3"
                                data-bs-toggle="modal" data-bs-target="#offerModal">
                                Make An Offer <i class="fa-solid fa-hand-holding-dollar ms-2"></i>
                            </button>

                            <button type="button"
                                class="mto-btn-black w-100 mb-3"
                                onclick="window.location.href='sms:{{ $dealerPhone }}'">
                                <i class="fa-solid fa-message me-2"></i> SMS
                            </button>

                            {{-- Chat with Dealer --}}
                            @if($localInventoryId && $localDealerId)
                                @auth
                                    @if(auth()->id() == $localDealerId)
                                        {{-- Owner: go to messages page --}}
                                        <a href="{{ route('chat.index') }}" class="mb-3 mt-4 d-block">
                                            <button type="button" class="mto-btn-black w-100">
                                                <i class="fa-regular fa-comment me-2"></i> My Messages
                                            </button>
                                        </a>
                                    @else
                                        <form method="POST" action="{{ route('chat.start') }}">
                                            @csrf
                                            <input type="hidden" name="inventory_id" value="{{ $localInventoryId }}">
                                            <input type="hidden" name="dealer_id"    value="{{ $localDealerId }}">
                                            <input type="hidden" name="source"       value="{{ $source }}">
                                            <button type="submit" class="mto-btn-black w-100">
                                                <i class="fa-regular fa-comment me-2"></i> Chat with Dealer
                                            </button>
                                        </form>
                                @endif
                                @else
                                    <button type="button" class="mto-btn-black w-100"
                                        onclick="openChatLoginModal({{ $localInventoryId }}, {{ $localDealerId }}, '{{ route('chat.start') }}')">
                                        <i class="fa-regular fa-comment me-2"></i> Chat with Dealer
                                    </button>
                                @endauth
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Test Drive Modal -->
    <div class="modal fade" id="testDriveModals" tabindex="-1" aria-labelledby="testDriveModalLabel" aria-hidden="true">
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
    @if(!empty($matchedVehicles) && count($matchedVehicles) > 0)
        <div class="container row g-4 m-auto">
            <div class="container mt-5">
                <div class="dealer-top-section" data-aos="fade-up" data-aos-duration="600">
                    @if($isFromSameDealer && $dealerName)
                        <h4 class="dealer-top-title">More From This Dealer</h4>
                        <p class="dealer-top-subtitle">Check out other vehicles from the same dealer</p>
                    @else
                        <h4 class="dealer-top-title">Similar Vehicles</h4>
                        <p class="dealer-top-subtitle">You might also like these similar vehicles</p>
                    @endif
                </div>
            </div>
            <div class="row" id="relatedVehiclesContainer">
                 @foreach ($matchedVehicles as $relatedVehicle)
                    <div class="col-lg-3 col-sm-6 dealer-vehicle-card">
                        <div class="modern-car-card shadow-sm">
                            <div class="car-card-top">
                                @php
                                    // Generate slug for the related vehicle
                                    $relatedVehicleName = trim(
                                        ($relatedVehicle->year ?? '') . ' ' . 
                                        ($relatedVehicle->make ?? '') . ' ' . 
                                        ($relatedVehicle->model ?? '') . ' ' . 
                                        ($relatedVehicle->trim ?? '')
                                    );
                                    $relatedSlug = $relatedVehicleName ? Str::slug($relatedVehicleName) : 'vehicle';
                                    $relatedDetailUrl = route('inventory_product_details', ['name' => $relatedSlug, 'id' => $relatedVehicle->id]);
                                    
                                    $defaultImage = asset('assets/images/defaultimage.jpg');
                                    
                                    $relatedImg = $relatedVehicle->primary_image
                                        ? (Str::startsWith($relatedVehicle->primary_image, 'http')
                                            ? $relatedVehicle->primary_image
                                            : $disklozBaseUrl . '/admin_assets/images/inventory_images/' . $relatedVehicle->primary_image)
                                        : $defaultImage;
                                    
                                    $relatedDealer = $relatedVehicle->dealer ?? null;
                                    $relatedDealerName = $relatedDealer->dba ?? $relatedDealer->name ?? 'Dealer';
                                @endphp
                                
                                <a href="{{ $relatedDetailUrl }}">
                                    <img style="width:100%"
                                        src="{{ $relatedImg }}"
                                        alt="{{ $relatedVehicle->model }}"
                                        class="img-box img-fluid"
                                        onerror="this.onerror=null;this.src='{{ $defaultImage }}';">
                                </a>
                                @php
                                    $relatedIsOwn = auth()->check()
                                        && strtolower($relatedVehicle->source ?? '') === 'motokloz'
                                        && !empty($relatedVehicle->client_id)
                                        && (int) $relatedVehicle->client_id === auth()->id();
                                @endphp
                                @if(!$relatedIsOwn)
                                <button class="card-wishlist-btn"
                                    id="wishlist-btn-{{ $relatedVehicle->id }}"
                                    onclick="event.stopPropagation(); toggleLike({{ $relatedVehicle->id }}, this, {{ auth()->id() ?? 'null' }})"
                                    title="Add to Wishlist">
                                    <i class="fa fa-spinner fa-spin d-none" id="wishlist-spinner-{{ $relatedVehicle->id }}"></i>
                                    <i class="far fa-star" id="wishlist-icon-{{ $relatedVehicle->id }}"></i>
                                </button>
                                @endif
                                <div class="badge-mileage">
                                    <img src="/assets/images/mile1.png" alt="Mileage" class="me-2" style="width:20px; height:12px;"> 
                                    {{ $relatedVehicle->mileage 
                                        ? number_format((float) trim(str_ireplace('km', '', $relatedVehicle->mileage))) . ' km'
                                        : '0 km'
                                    }}
                                </div>
                            </div>
                            <div class="car-card-bottom">
                                <h5 class="car-main-title">
                                    {{ $relatedVehicle->year }} {{ $relatedVehicle->mfg_auto }}
                                    {{ $relatedVehicle->model }} {{ $relatedVehicle->trim }}
                                </h5>
                                
                                @php
                                    $dealerPostalCode = data_get($relatedVehicle, 'dealer.postal_code')
                                        ?? $relatedVehicle->dealer_postal_code
                                        ?? '';
                                    $dealerCity = data_get($relatedVehicle, 'dealer.city')
                                        ?? $relatedVehicle->dealer_city
                                        ?? '';
                                    $dealerProvince = data_get($relatedVehicle, 'dealer.province')
                                        ?? $relatedVehicle->dealer_province
                                        ?? '';
                                    $dealerCountry = data_get($relatedVehicle, 'dealer.country')
                                        ?? $relatedVehicle->dealer_country
                                        ?? '';
                                @endphp
                                
                                <p class="car-distance-away"
                                    data-dealer-postal="{{ $dealerPostalCode }}"
                                    data-dealer-city="{{ $dealerCity }}"
                                    data-dealer-province="{{ $dealerProvince }}"
                                    data-dealer-country="{{ $dealerCountry }}">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="distance-value">Loading...</span>
                                </p>

                                <div class="car-price-block text-end">
                                    @php 
                                $cleanedPrice = preg_replace('/[^0-9.]/', '', $relatedVehicle->disclosed_price ?? '0');
                                $displayPrice = round((float) $cleanedPrice); 
                                @endphp
                                    @if($displayPrice > 0)
                                        <h4 class="price-value">${{ number_format($displayPrice) }}</h4>
                                    @elseif($relatedIsOwn)
                                        <h4 class="price-value">$0</h4>
                                    @else
                                        @php
                                            $cardPhone = null;
                                            if (!empty($relatedVehicle->dealer->phone_no)) {
                                                $cardPhone = $relatedVehicle->dealer->phone_no;
                                            } elseif (!empty($relatedVehicle->dealer_phone_no)) {
                                                $cardPhone = $relatedVehicle->dealer_phone_no;
                                            } elseif (!empty($dealer) && !empty($dealer->phone_no)) {
                                                $cardPhone = $dealer->phone_no;
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
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
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
    $('#testDriveModals form').on('submit', function (e) {
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
                $('#testDriveModals').modal('hide');
                $('#testDriveModals form')[0].reset();
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
                        $icon.removeClass('far').addClass('fas').css('color', '#f0a500');
                        $(this).addClass('active');
                    } else {
                        $icon.removeClass('fas').addClass('far').css('color', '');
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
                    $icon.removeClass('fas').addClass('far').css('color', '');
                    showSnackbar('Removed from wishlist.', 'info');
                } else {
                    $btn.addClass('active');
                    $icon.removeClass('far').addClass('fas').css('color', '#f0a500');
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
    .dealer-top-title {
        font-weight: 600;
        font-size: 40px;
        color: var(--select-color);
    }

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