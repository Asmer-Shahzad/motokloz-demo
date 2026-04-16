@extends('layouts.app')

@section('content')

    <section class="agent-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('partials.user-account-breadcrumbs')
                    <h2 class="fw-bold mb-4">Add Listing</h2>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">

            @include('partials.user-account-sidebar')

            <div class="col-lg-9">

                <div class="container">

                    <!-- FORM START -->
                    <form action="{{ route('store.save_inventory') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12" hidden>
                            <input type="hidden" value="Motokloz" class="form-control" placeholder="Source *" name="source"
                                required>
                        </div>
                        <div class="card-container">
                            <h2 class="section-title">Car details</h2>

                            <!-- IMAGE UPLOAD -->
                            <div class="row g-3 mb-4" id="image-upload-container">
                                <!-- Fixed Upload Box -->
                                <div class="col-md-3 col-6">
                                    <div class="img-upload-box" id="img-upload-box">
                                        <i class="fa-regular fa-image fa-2x mb-2"></i>
                                        <span>Upload Image</span>
                                        <input type="file" id="image-input" multiple style="display:none;" name="inventory_logo[]">
                                        <input type="hidden" name="primary_image_index" id="primary_image_index" value="">
                                    </div>
                                </div>

                                <!-- Swiper Slider Container -->
                                <div class="col-9">
                                    <div class="swiper mySwiper">
                                        <div class="swiper-wrapper" id="swiper-wrapper">
                                            <!-- JS se images slides yaha add honge -->
                                        </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- CAR DETAILS -->
                            <div class="row g-3">

                                <div class="col-12">
                                    <input type="hidden" value="Motokloz" name="source">
                                </div>

                                <div class="col-md-12">
                                    <select id="asset" name="selected_asset" class="form-select">
                                        <option value="">Select Asset</option>
                                        @foreach($assets as $asset)
                                            <option value="{{ $asset }}">{{ $asset }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!--  HERE IS WHERE PARTIAL WILL LOAD -->
                                <div id="dynamic-form-area">
                                    @include('listings-form.default')
                                </div>
                            </div>
                        </div>

                        <!-- PRICING -->
                        <div class="card-container mt-4">
                            <h2 class="section-title">Pricing</h2>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Tour price ($)" name="price">
                            </div>

                            <label class="form-label fw-bold">Extra Services</label>
                            <div id="extra-services-container">
                                <div class="row g-3 align-items-center extra-service-row mb-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Service title 1"
                                            name="extra_services[0][title]">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" placeholder="Price ($)"
                                            name="extra_services[0][price]">
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <i class="fa-solid fa-trash-can text-muted remove-service"
                                            style="cursor: pointer;"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-3">
                                <button type="button" class="btn btn-light-custom fw-bold" id="add-service-btn">Add
                                    More</button>
                            </div>
                            <button type="submit" class="btn btn-orange mt-3">Save Changes</button>
                        </div>
                    </form>
                    <!-- FORM END -->

                </div>

            </div>
        </div>
    </div>
    <style>
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
            top: 50%;
            transform: translateY(-50%);
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
            left: 10px;
            color: #fff;
            background-color: #ff9800;
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        .swiper-button-next {
            right: 10px;
            z-index: 10;
            color: #fff;
            background-color: #ff9800;
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        /* Optional: Add shadow for better visibility */
        .custom-swiper-btn {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        .swiper-pagination-bullet-active {
            opacity: var(--swiper-pagination-bullet-opacity, 1);
            background: #ff9800;
        }

        .primary-selected .preview-img-container {
            border: 3px solid #ff9800 !important;
            box-shadow: 0 0 0 2px #ff9800;
        }

        .set-primary-btn:hover {
            background-color: #ff9800 !important;
            color: #000 !important;
        }

        .primary-badge i {
            margin-right: 4px;
        }

        /* Set as Primary button - always visible & active */
        .set-primary-btn {
            transition: all 0.3s ease;
            opacity: 0.9;
        }

        .set-primary-btn:hover {
            background-color: #ff9800 !important;
            color: #000 !important;
            transform: scale(1.02);
        }

        .set-primary-btn i {
            margin-right: 5px;
        }

        /* Preview image container hover effect */
        .preview-img-container {
            transition: all 0.2s ease;
        }

        .preview-img-container:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Primary selected border */
        .primary-selected .preview-img-container {
            border: 3px solid #ff9800 !important;
            box-shadow: 0 0 0 2px #ff9800;
        }
    </style>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function () {

        $('#asset').on('change', function () {

            let asset = $(this).val();

            // ✅ Clear everything and stop if no asset selected
            if (!asset) {
                $('#dynamic-form-area').html('');
                $('#make').html('<option value="">Select Make</option>');
                $('#body_style').html('<option value="">Select Body Style</option>');
                $('#year').html('<option value="">Select Year</option>');
                $('#condition').html('<option value="">Select Condition</option>');
                $('#engine').html('<option value="">Select Engine</option>');
                $('#transmission').html('<option value="">Select Transmission</option>');
                $('#drive_train').html('<option value="">Select Drive Train</option>');
                return;
            }

            $.ajax({
                url: "{{ route('load.asset.form') }}",
                type: "GET",
                data: { asset },

                success: function (res) {

                    // ---------------- FORM ----------------
                    $('#dynamic-form-area').html(res.html);

                    // Re-init floor plans multiselect if present
                    if (document.getElementById('fpMultiselect')) {
                        window.fpSelected = [];
                        // Execute any scripts injected via AJAX
                        $('#dynamic-form-area script').each(function() {
                            try { eval($(this).text()); } catch(e) {}
                        });
                    }

                    // ---------------- MAKE ----------------
                    let make = $('#make');
                    make.html('<option value="">Select Make</option>');

                    res.makes.forEach(m => {
                        make.append(`<option value="${m.name}">${m.name}</option>`);
                    });

                    // ---------------- BODY STYLE ----------------
                    let body = $('#body_style');
                    body.html('<option value="">Select Body Style</option>');

                    res.bodyStyles.forEach(b => {
                        body.append(`<option value="${b.name}">${b.name}</option>`);
                    });


                    // ---------------- Year STYLE ----------------
                    let year = $('#year');
                    year.html('<option value="">Select Year</option>');

                    res.year.forEach(y => {
                        year.append(`<option value="${y.name}">${y.name}</option>`);
                    });

                    // ---------------- Condition STYLE ----------------
                    let condition = $('#condition');
                    condition.html('<option value="">Select Condition</option>');

                    res.condition.forEach(c => {
                        condition.append(`<option value="${c.name}">${c.name}</option>`);
                    });

                    // ENGINE
                    let engine = $('#engine');
                    engine.html('<option value="">Select Engine</option>');

                    if (res.engine) {
                        res.engine.forEach(e => {
                            engine.append(`<option value="${e.name}">${e.name}</option>`);
                        });
                    }


                    // TRANSMISSION
                    let transmission = $('#transmission');
                    transmission.html('<option value="">Select Transmission</option>');

                    if (res.transmission) {
                        res.transmission.forEach(t => {
                            transmission.append(`<option value="${t.name}">${t.name}</option>`);
                        });
                    }

                    // DRIVE TRAIN
                    let driveTrain = $('#drive_train');
                    driveTrain.html('<option value="">Select Drive Train</option>');

                    if (res.driveTrain) {
                        res.driveTrain.forEach(d => {
                            driveTrain.append(`<option value="${d.name}">${d.name}</option>`);
                        });
                    }
                }
            });

        });

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const assetSelect = document.getElementById('asset');
        const makeSelect = document.getElementById('make');
        const bodySelect = document.getElementById('body_style');

        // -------- RESET --------
        function resetSelect(select, placeholder) {
            select.innerHTML = `<option value="">${placeholder}</option>`;
        }

        // -------- FETCH DATA --------
        function fetchFiltersByAsset(asset) {
            return fetch(`{{ env('diskloz_base_url') }}/api/search_inventory?selected_asset=${encodeURIComponent(asset)}&per_page=1`)
                .then(res => res.json())
                .then(data => {

                    if (!data || !data.filters) return { makes: [], bodies: [] };

                    switch (asset) {

                        case 'AUTO':
                            return {
                                makes: data.filters.MfgAuto || [],
                                bodies: data.filters.BodyStyle || []
                            };

                        case 'SNOWSPORTS':
                            return {
                                makes: data.filters.MfgSnowsport || [],
                                bodies: data.filters.BodyStyleSnowSport || []
                            };

                        case 'WATERSPORT':
                            return {
                                makes: data.filters.MfgWatersport || [],
                                bodies: data.filters.BodyStyle || []
                            };

                        case 'MARINE':
                            return {
                                makes: data.filters.MfgMarine || [],
                                bodies: data.filters.BodyStyle || []
                            };

                        case 'RV / TRAILER':
                            return {
                                makes: data.filters.MfgRvTrailer || [],
                                bodies: data.filters.BodyStyleRvTrailer || []
                            };

                        case 'MOTORCYCLE / ATV / POWERSPORTS':
                            return {
                                makes: data.filters.MfgMotorcycleAtv || [],
                                bodies: data.filters.BodyStyleMotorcycleAtv || []
                            };

                        case 'HEAVY TRUCK/EQUIPMENT':
                            return {
                                makes: data.filters.MfgHeavyTruckEquipment || [],
                                bodies: data.filters.BodyStyleHeavyTruckEquipment || []
                            };

                        case 'HEAVY DUTY TRAILERS':
                            return {
                                makes: data.filters.MfgHeavyDutyTrailer || [],
                                bodies: data.filters.BodyStyleHeavyDutyTrailer || []
                            };

                        case 'FARM EQUIPMENT':
                            return {
                                makes: data.filters.MfgFarmEquipment || [],
                                bodies: data.filters.BodyStyleFarmEquipment || []
                            };

                        default:
                            return { makes: [], bodies: [] };
                    }
                })
                .catch(() => ({ makes: [], bodies: [] }));
        }

        // -------- POPULATE --------
        function populateSelect(select, items, placeholder) {
            resetSelect(select, placeholder);

            items.forEach(item => {
                const option = document.createElement('option');
                option.value = item.name;
                option.textContent = item.name;
                select.appendChild(option);
            });
        }

        // -------- EVENT --------
        if (assetSelect) {
            assetSelect.addEventListener('change', function () {

                const asset = this.value;

                resetSelect(makeSelect, 'Select Make');
                resetSelect(bodySelect, 'Select Body Style');

                if (!asset) return;

                fetchFiltersByAsset(asset).then(res => {
                    populateSelect(makeSelect, res.makes, 'Select Make');
                    populateSelect(bodySelect, res.bodies, 'Select Body Style');
                });
            });

            // page load default
            if (assetSelect.value) {
                assetSelect.dispatchEvent(new Event('change'));
            }
        }

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ---------- Extra services logic (same as before) ----------
        let serviceIndex = 1;
        const container = document.getElementById('extra-services-container');
        const addBtn = document.getElementById('add-service-btn');
        if (addBtn) {
            addBtn.addEventListener('click', function () {
                const newRow = document.createElement('div');
                newRow.classList.add('row', 'align-items-center', 'extra-service-row', 'mb-3');
                newRow.innerHTML = `
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Service title" name="extra_services[${serviceIndex}][title]">
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" placeholder="Price ($)" name="extra_services[${serviceIndex}][price]">
                    </div>
                    <div class="col-md-1 text-end">
                        <i class="fa-solid fa-trash-can remove-service" style="cursor: pointer;"></i>
                    </div>
                `;
                container.appendChild(newRow);
                serviceIndex++;
            });
        }
        if (container) {
            container.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-service')) {
                    const row = e.target.closest('.extra-service-row');
                    if (row) row.remove();
                }
            });
        }

        // ---------- IMAGE UPLOAD WITH PRIMARY SELECTION ----------
        const uploadBox = document.getElementById('img-upload-box');
        const imageInput = document.getElementById('image-input');
        const swiperWrapper = document.getElementById('swiper-wrapper');
        const primaryIndexInput = document.getElementById('primary_image_index');

        // Swiper initialization
        let swiper = new Swiper('.mySwiper', {
            slidesPerView: 3,
            spaceBetween: 10,
            loop: false,
            autoplay: false,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                1024: { slidesPerView: 3 },
            }
        });

        swiper.autoplay.stop();

        // Click on upload box triggers file input
        if (uploadBox) {
            uploadBox.addEventListener('click', () => imageInput.click());
        }

        // Function to reset primary selection
        function resetPrimarySelection() {
            primaryIndexInput.value = '';
            document.querySelectorAll('.swiper-slide').forEach(slide => {
                const primaryBadge = slide.querySelector('.primary-badge');
                if (primaryBadge) primaryBadge.remove();
                slide.classList.remove('primary-selected');
            });
        }

        // Function to mark primary image based on index
        function setPrimaryImage(index) {
            const slides = document.querySelectorAll('.swiper-slide');
            if (!slides[index]) return false;

            slides.forEach(slide => {
                const badge = slide.querySelector('.primary-badge');
                if (badge) badge.remove();
                slide.classList.remove('primary-selected');
            });

            const selectedSlide = slides[index];
            selectedSlide.classList.add('primary-selected');
            const badge = document.createElement('div');
            badge.className = 'primary-badge';
            badge.innerHTML = '<i class="fa-solid fa-star"></i> Primary';
            badge.style.position = 'absolute';
            badge.style.top = '5px';
            badge.style.left = '5px';
            badge.style.backgroundColor = '#ffc107';
            badge.style.color = '#000';
            badge.style.padding = '2px 8px';
            badge.style.borderRadius = '20px';
            badge.style.fontSize = '12px';
            badge.style.fontWeight = 'bold';
            badge.style.zIndex = '10';
            selectedSlide.querySelector('.preview-img-container').appendChild(badge);

            primaryIndexInput.value = index;
            return true;
        }

        // Helper to get current index of a slide element
        function getSlideIndex(slideElement) {
            const slides = Array.from(document.querySelectorAll('.swiper-slide'));
            return slides.indexOf(slideElement);
        }

        // When files are selected
        imageInput.addEventListener('change', function () {
            swiperWrapper.innerHTML = '';
            resetPrimarySelection();

            const files = Array.from(this.files);
            if (files.length === 0) return;

            files.forEach((file, idx) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const slide = document.createElement('div');
                    slide.classList.add('swiper-slide');
                    slide.innerHTML = `
                        <div class="preview-img-container position-relative" style="border-radius:8px; overflow:hidden; border:2px solid transparent;">
                            <img src="${e.target.result}" style="width:100%; height:150px; object-fit:cover; border-radius:8px;">
                            <div class="delete-btn" style="position:absolute; top:5px; right:5px; background:rgba(0,0,0,0.6); border-radius:50%; width:30px; height:30px; display:flex; align-items:center; justify-content:center; cursor:pointer;">
                                <i class="fa-solid fa-trash-can text-white"></i>
                            </div>
                            <div class="set-primary-btn" style="position:absolute; bottom:5px; left:5px; background:rgba(0,0,0,0.6); border-radius:20px; padding:4px 10px; cursor:pointer; font-size:12px; color:white;">
                                <i class="fa-regular fa-star"></i> Set as Primary
                            </div>
                        </div>
                    `;
                    swiperWrapper.appendChild(slide);
                    swiper.update();

                    // ---- FIX: Set as Primary button - use runtime index ----
                    const setPrimaryBtn = slide.querySelector('.set-primary-btn');
                    setPrimaryBtn.addEventListener('click', (event) => {
                        event.stopPropagation();
                        const currentIndex = getSlideIndex(slide);
                        setPrimaryImage(currentIndex);
                    });

                    // Delete button logic
                    const deleteBtn = slide.querySelector('.delete-btn');
                    deleteBtn.addEventListener('click', (event) => {
                        event.stopPropagation();
                        // Remove file from input
                        const dt = new DataTransfer();
                        const currentFiles = Array.from(imageInput.files);
                        const currentIdx = getSlideIndex(slide);
                        currentFiles.splice(currentIdx, 1);
                        currentFiles.forEach(f => dt.items.add(f));
                        imageInput.files = dt.files;

                        // Remove slide
                        slide.remove();
                        swiper.update();

                        // Adjust primary selection after deletion
                        const currentPrimary = parseInt(primaryIndexInput.value);
                        if (currentPrimary === currentIdx) {
                            resetPrimarySelection();
                        } else if (currentPrimary > currentIdx) {
                            primaryIndexInput.value = currentPrimary - 1;
                            // Update badge on the new index (since primary shifted)
                            const newPrimaryIndex = currentPrimary - 1;
                            const newPrimarySlide = document.querySelectorAll('.swiper-slide')[newPrimaryIndex];
                            if (newPrimarySlide && !newPrimarySlide.querySelector('.primary-badge')) {
                                setPrimaryImage(newPrimaryIndex);
                            }
                        }
                    });

                    // OPTIONAL: Click on whole image also sets primary (aap chahe to enable karein)
                    const imgContainer = slide.querySelector('.preview-img-container');
                    imgContainer.style.cursor = 'pointer';
                    imgContainer.addEventListener('click', (event) => {
                        if (event.target.closest('.delete-btn')) return;
                        const currentIndex = getSlideIndex(slide);
                        setPrimaryImage(currentIndex);
                    });
                };
                reader.readAsDataURL(file);
            });
        });

        // Form submit validation
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function (e) {
                const primaryIndex = primaryIndexInput.value;
                const files = imageInput.files;
                if (files.length === 0) {
                    e.preventDefault();
                    showSnackbar('Please upload at least one image.', 'warning');
                    return;
                }
                if (primaryIndex === '' || primaryIndex === null) {
                    e.preventDefault();
                    showSnackbar('Please select a primary image from the uploaded images.', 'warning');
                    return;
                }
            });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Check for flash messages from Laravel
        @if(session('success'))
            showSnackbar('{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            showSnackbar('{{ session('error') }}', 'error');
        @endif

        @if($errors->any())
            showSnackbar('{{ $errors->first() }}', 'error');
        @endif
    });
</script>