@extends('layouts.app')
<script>
    const BASE_URL = "{{ env('diskloz_base_url') }}";
</script>

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
                        <input type="hidden" id="inv_id" value="{{ $searched_vehicle->id ?? '' }}">

                        <!-- Your button with ID -->
                        <button id="fetchButton" onclick="fetchAndPrint()" class="mto-pill-btn">
                            <img src="/assets/images/Printer.png" class="me-1" alt=""> Print Details
                        </button>
                        
                        <button class="mto-pill-btn"><img src="/assets/images/SVG.png" class="me-1" alt=""> Share</button>
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
                        <!-- Buttons -->
                        <div class="mto-card-unit mb-4 p-4 shadow-sm">
                            <h6 class="fw-bold mb-3">Get Started</h6>
                            <button type="button" class="mto-btn-orange w-100 mb-3" data-bs-toggle="modal" data-bs-target="#testDriveModal">
                                Schedule Test Drive <i class="fa-solid fa-arrow-right ms-2"></i>
                            </button>
                            <button type="button" class="mto-btn-black w-100" data-bs-toggle="modal" data-bs-target="#offerModal">
                                Make An Offer Price <i class="fa-solid fa-arrow-right ms-2"></i>
                            </button>
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

        <!-- Test Drive Modal -->
        <div class="modal fade" id="testDriveModal" tabindex="-1" aria-labelledby="testDriveModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testDriveModalLabel">Schedule Test Drive</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name1" required>
                        </div>
                        <div class="mb-3">
                            <label for="email1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email1" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone1" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="phone1" required>
                        </div>
                        <div class="mb-3">
                            <label for="date1" class="form-label">Preferred Date</label>
                            <input type="date" class="form-control" id="date1" required>
                        </div>
                        <div class="mb-3">
                            <label for="message1" class="form-label">Message</label>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name2" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name2" required>
                        </div>
                        <div class="mb-3">
                            <label for="email2" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email2" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone2" class="form-label">Phone</label>
                            <input type="numbe2" class="form-control" id="phone2" required>
                        </div>
                        <div class="mb-3">
                            <label for="offerPrice" class="form-label">Offer Price</label>
                            <input type="number" class="form-control" id="offerPrice" required>
                        </div>
                        <button type="submit" class="mto-btn-orange w-100 mb-3">Submit</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function(){
    $('#testDriveModal form').on('submit', function(e){
        e.preventDefault();
        
        // Get dealer and product IDs safely
        var dealerId = {{ $searched_vehicle->dealer->id ?? 'null' }};
        var productId = {{ $searched_vehicle->id ?? 'null' }};
        
        // Validate IDs
        if (!dealerId || dealerId === 'null' || !productId || productId === 'null') {
            alert('Error: Dealer or vehicle information is missing. Please refresh the page.');
            return;
        }
        
        var formData = {
            name: $('#name1').val(),
            email: $('#email1').val(),
            phone: $('#phone1').val(),
            book_date: $('#date1').val(),
            message: $('#message1').val(),
            reason: 'Schedule Test Drive',
            type: 'WEBLEAD',
            source: 'Motokloz',
            lead_status: 'NEW',
            dealer_id: dealerId,
            product_id: productId, // Changed from product_id to inventory_id
            // Add any other required fields
            lead_source: 'Website',
            lead_type: 'Test Drive'
        };
        
        // Validate required fields
        if (!formData.name || !formData.email || !formData.phone) {
            alert('Please fill in all required fields (Name, Email, Phone)');
            return;
        }
        
        // Validate email format
        var emailRegex = /^[^\s@]+@([^\s@]+\.)+[^\s@]+$/;
        if (!emailRegex.test(formData.email)) {
            alert('Please enter a valid email address');
            return;
        }
        
        // Disable submit button to prevent double submission
        var $submitBtn = $(this).find('button[type="submit"]');
        $submitBtn.prop('disabled', true).text('Submitting...');
        
        $.ajax({
            url: "{{ env('diskloz_base_url') }}/api/leads",
            method: 'POST',
            data: JSON.stringify(formData), // Send as JSON
            contentType: 'application/json', // Important: Set content type to JSON
            dataType: 'json',
            crossDomain: true,
            success: function(response){
                console.log('Success:', response);
                alert(response.message || 'Test drive scheduled successfully!');
                $('#testDriveModal').modal('hide');
                $('#testDriveModal form')[0].reset();
            },
            error: function(xhr){
                console.log('Error Response:', xhr.responseJSON);
                
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    let errorMessages = '';
                    $.each(xhr.responseJSON.errors, function(field, messages) {
                        errorMessages += field + ': ' + messages.join(', ') + '\n';
                    });
                    alert('Validation Error:\n' + errorMessages);
                } else if (xhr.status === 500) {
                    alert('Server error. Please try again later.');
                } else {
                    alert(xhr.responseJSON?.message || 'Something went wrong. Please try again.');
                }
            },
            complete: function() {
                // Re-enable submit button
                $submitBtn.prop('disabled', false).text('Submit');
            }
        });
    });
    
    $('#offerModal form').on('submit', function(e){
        e.preventDefault();
        
        var dealerId = {{ $searched_vehicle->dealer->id ?? 'null' }};
        var productId = {{ $searched_vehicle->id ?? 'null' }};
        
        if (!dealerId || dealerId === 'null' || !productId || productId === 'null') {
            alert('Error: Dealer or vehicle information is missing. Please refresh the page.');
            return;
        }
        
        var formData = {
            name: $('#name2').val(),
            email: $('#email2').val(),
            phone: $('#phone2').val(),
            message: $('#message2').val(), // Fixed: was using message1
            reason: 'Make An Offer Price',
            type: 'WEBLEAD',
            source: 'Motokloz',
            lead_status: 'NEW',
            offer_price: $('#offerPrice').val(),
            dealer_id: dealerId,
            product_id: productId, // Changed from product_id to inventory_id
            lead_source: 'Website',
            lead_type: 'Offer'
        };
        
        // Validate required fields
        if (!formData.name || !formData.email || !formData.phone) {
            alert('Please fill in all required fields (Name, Email, Phone)');
            return;
        }
        
        // Validate offer price
        if (!formData.offer_price || formData.offer_price <= 0) {
            alert('Please enter a valid offer price');
            return;
        }
        
        var $submitBtn = $(this).find('button[type="submit"]');
        $submitBtn.prop('disabled', true).text('Submitting...');
        
        $.ajax({
            url: "{{ env('diskloz_base_url') }}/api/leads",
            method: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            dataType: 'json',
            crossDomain: true,
            success: function(response){
                console.log('Success:', response);
                alert(response.message || 'Offer submitted successfully!');
                $('#offerModal').modal('hide');
                $('#offerModal form')[0].reset();
            },
            error: function(xhr){
                console.log('Error Response:', xhr.responseJSON);
                
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    let errorMessages = '';
                    $.each(xhr.responseJSON.errors, function(field, messages) {
                        errorMessages += field + ': ' + messages.join(', ') + '\n';
                    });
                    alert('Validation Error:\n' + errorMessages);
                } else if (xhr.status === 500) {
                    alert('Server error. Please try again later.');
                } else {
                    alert(xhr.responseJSON?.message || 'Something went wrong. Please try again.');
                }
            },
            complete: function() {
                $submitBtn.prop('disabled', false).text('Submit');
            }
        });
    });
});

       $(document).ready(function(){

            let clientId = {{ auth()->id() ?? 'null' }};

            // =============================
            // LOAD FAVORITES (PAGE LOAD)
            // =============================
            function loadFavorites() {

                if (!clientId) {
                    hideAllSpinners();
                    return;
                }

                fetch(`${BASE_URL}/api/favorites?client_id=${clientId}`)
                    .then(res => res.json())
                    .then(data => {

                        let likedIds = new Set((data || []).map(item => item.inventory_id));

                        $('button[id^="wishlist-btn-"]').each(function () {
                            let inventoryId = parseInt(this.id.replace('wishlist-btn-', ''));

                            let spinner = $('#wishlist-spinner-' + inventoryId);
                            let icon = $('#wishlist-icon-' + inventoryId);

                            spinner.addClass('d-none');
                            icon.removeClass('d-none');

                            if (likedIds.has(inventoryId)) {
                                icon.removeClass('far').addClass('fas');
                                $(this).addClass('active');
                            } else {
                                icon.removeClass('fas').addClass('far');
                                $(this).removeClass('active');
                            }
                        });

                    })
                    .catch(() => {
                        hideAllSpinners();
                    });
            }

            function hideAllSpinners() {
                $('[id^="wishlist-spinner-"]').addClass('d-none');
                $('[id^="wishlist-icon-"]').removeClass('d-none');
            }

            loadFavorites();

        });


       // Add CSRF token to all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function toggleLike(vehicleId, element, authId) {
            if (!authId) {
                alert('Login required');
                return;
            }

            let $btn = $(element);
            let $icon = $('#wishlist-icon-' + vehicleId);
            let isLiked = $btn.hasClass('active');

            $btn.prop('disabled', true);

            let url = isLiked ? '/remove_like' : '/add_like';
            
            // Use FormData instead of JSON (simpler)
            let formData = new FormData();
            formData.append('client_id', authId);
            formData.append('vehicle_id', vehicleId);
            
            console.log('Sending request:', {
                url: url,
                client_id: authId,
                vehicle_id: vehicleId,
                isLiked: isLiked
            });

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,  // Don't process the data
                contentType: false,  // Let jQuery set the content type
                dataType: 'json',
                success: function(response) {
                    console.log('Success response:', response);
                    if (response.success) {
                        if (isLiked) {
                            $btn.removeClass('active');
                            $icon.removeClass('fas').addClass('far');
                        } else {
                            $btn.addClass('active');
                            $icon.removeClass('far').addClass('fas');
                        }
                    } else {
                        alert(response.message || 'Operation failed');
                        // Revert the UI if operation failed
                        if (isLiked) {
                            $btn.addClass('active');
                            $icon.removeClass('far').addClass('fas');
                        } else {
                            $btn.removeClass('active');
                            $icon.removeClass('fas').addClass('far');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error details:', {
                        status: xhr.status,
                        statusText: xhr.statusText,
                        responseText: xhr.responseText,
                        error: error
                    });
                    
                    let errorMessage = 'An error occurred. ';
                    if (xhr.status === 400) {
                        try {
                            let response = JSON.parse(xhr.responseText);
                            errorMessage += response.message || 'Bad request. Please check your input.';
                        } catch(e) {
                            errorMessage += 'Invalid request data.';
                        }
                    } else if (xhr.status === 419) {
                        errorMessage = 'Session expired. Please refresh the page.';
                        location.reload();
                    } else if (xhr.status === 500) {
                        errorMessage = 'Server error. Please check the console for details.';
                        // Try to get more details from response
                        try {
                            let response = JSON.parse(xhr.responseText);
                            if (response.message) {
                                errorMessage += '\nDetails: ' + response.message;
                            }
                        } catch(e) {}
                    } else {
                        errorMessage += 'Please try again.';
                    }
                    alert(errorMessage);
                    
                    // Revert UI on error
                    if (isLiked) {
                        $btn.addClass('active');
                        $icon.removeClass('far').addClass('fas');
                    } else {
                        $btn.removeClass('active');
                        $icon.removeClass('fas').addClass('far');
                    }
                },
                complete: function() {
                    $btn.prop('disabled', false);
                }
            });
        }

        function fetchAndPrint() {
            var button = document.getElementById('fetchButton');
            var loader = document.getElementById('pdfLoader');
            var invIdInput = document.getElementById('inv_id');
            
            // Get inventory ID
            var id = invIdInput ? invIdInput.value : null;
            
            // If no hidden input, try to get from data attribute
            if (!id || id === 'null' || id === '') {
                id = button.getAttribute('data-inv-id');
            }
            
            // Validate ID
            if (!id || id === 'null' || id === '') {
                console.error('No inventory ID found');
                alert('Error: Inventory ID not found. Please refresh the page.');
                return;
            }
            
            // Validate ID is numeric
            id = parseInt(id);
            if (isNaN(id) || id <= 0) {
                console.error('Invalid inventory ID:', id);
                alert('Error: Invalid inventory ID');
                return;
            }
            
            // Disable button and add loading class
            button.disabled = true;
            button.classList.add('disabled', 'loading');
            
            // Show loader spinner
            if (loader) {
                loader.style.display = 'block';
            }
            
            console.log('Generating PDF for inventory ID:', id);
            
            $.ajax({
                url: '/pdf/disklozer/' + id,
                method: 'GET',
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(blob) {
                    // Check if response is PDF
                    if (blob.type === 'application/pdf') {
                        var url = URL.createObjectURL(blob);
                        // Open PDF in new tab
                        var pdfWindow = window.open(url, '_blank');
                        
                        // If popup blocked, show message
                        if (!pdfWindow || pdfWindow.closed || typeof pdfWindow.closed === 'undefined') {
                            alert('Please allow popups for this site to view the PDF.');
                        }
                        
                        // Clean up URL object after delay
                        setTimeout(function() {
                            URL.revokeObjectURL(url);
                        }, 1000);
                    } else {
                        // Handle error response
                        var reader = new FileReader();
                        reader.onload = function() {
                            try {
                                var errorResponse = JSON.parse(reader.result);
                                console.error('Error:', errorResponse);
                                alert(errorResponse.message || 'Error generating PDF');
                            } catch(e) {
                                console.error('Error response:', reader.result);
                                alert('Error generating PDF. Please try again.');
                            }
                        };
                        reader.readAsText(blob);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching PDF:", {
                        status: xhr.status,
                        statusText: xhr.statusText,
                        error: error
                    });
                    
                    let errorMessage = 'Failed to generate PDF. ';
                    
                    if (xhr.status === 404) {
                        errorMessage += 'Inventory not found.';
                    } else if (xhr.status === 500) {
                        errorMessage += 'Server error. Please try again later.';
                    } else if (xhr.status === 419) {
                        errorMessage += 'Session expired. Please refresh the page.';
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        errorMessage += 'Please check your connection and try again.';
                    }
                    
                    alert(errorMessage);
                },
                complete: function() {
                    // Re-enable button and remove loading classes
                    button.disabled = false;
                    button.classList.remove('disabled', 'loading');
                    
                    // Hide loader spinner
                    if (loader) {
                        loader.style.display = 'none';
                    }
                }
            });
        }

        function printDetails() {
            var $printable = $('#printable');
            
            if (!$printable.length) {
                console.error('Element with id="printable" not found');
                alert('Error: Could not find content to print');
                return;
            }
            
            var printContents = $printable.html();
            var originalContents = $('body').html();
            
            $('body').html(printContents);
            window.print();
            $('body').html(originalContents);
            
            // Optional: Reload to restore event handlers
            location.reload();
        }
    </script>

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

        /* Spinner animation */
        .spinner-border {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            vertical-align: text-bottom;
            border: 0.25em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border 0.75s linear infinite;
        }

        @keyframes spinner-border {
            to { transform: rotate(360deg); }
        }

        /* Disabled button style */
        .mto-pill-btn.disabled,
        .mto-pill-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Optional: Add a spinner on button itself */
        .mto-pill-btn.loading {
            position: relative;
            padding-left: 35px;
        }

        .mto-pill-btn.loading:before {
            content: "";
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            border: 2px solid #fff;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spinner-border 0.75s linear infinite;
        }
    </style>
@endsection