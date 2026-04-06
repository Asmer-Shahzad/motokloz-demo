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
                <form action="{{ route('store.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-container">
                        <h2 class="section-title">Car details</h2>

                        <!-- IMAGE UPLOAD -->
                        <div class="row g-3 mb-4" id="image-upload-container">
                            <!-- Fixed Upload Box -->
                            <div class="col-md-3 col-6">
                                <div class="img-upload-box" id="img-upload-box">
                                    <i class="fa-regular fa-image fa-2x mb-2"></i>
                                    <span>Upload Image</span>
                                    <input type="file" id="image-input" multiple style="display:none;" name="images[]">
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
                                <input type="text" class="form-control" placeholder="Listing Title *" name="title" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Model *" name="model" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Type *" name="type" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Condition *" name="condition" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Stock Number" name="stock_number">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Mileage" name="mileage">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Transmission" name="transmission">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" rows="4" placeholder="Description" name="description"></textarea>
                            </div>
                        </div>

                        <!-- FEATURES -->
                        <h4 class="mt-4 mb-3 fw-bold">Features</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check feature-checkbox">
                                    <input class="form-check-input" type="checkbox" name="features[]" value="A/C: Front">
                                    <label class="form-check-label">A/C: Front</label>
                                </div>
                                <div class="form-check feature-checkbox">
                                    <input class="form-check-input" type="checkbox" name="features[]" value="Cruise Control">
                                    <label class="form-check-label">Cruise Control</label>
                                </div>
                                <div class="form-check feature-checkbox">
                                    <input class="form-check-input" type="checkbox" name="features[]" value="Touchscreen display">
                                    <label class="form-check-label">Touchscreen display</label>
                                </div>
                                <div class="form-check feature-checkbox">
                                    <input class="form-check-input" type="checkbox" name="features[]" value="Phone connectivity">
                                    <label class="form-check-label">Phone connectivity</label>
                                </div>
                                <div class="form-check feature-checkbox">
                                    <input class="form-check-input" type="checkbox" name="features[]" value="In-car Wi-Fi">
                                    <label class="form-check-label">In-car Wi-Fi</label>
                                </div>
                                <div class="form-check feature-checkbox">
                                    <input class="form-check-input" type="checkbox" name="features[]" value="Brake assist (BA)">
                                    <label class="form-check-label">Brake assist (BA)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check feature-checkbox">
                                    <input class="form-check-input" type="checkbox" name="features[]" value="Backup Camera">
                                    <label class="form-check-label">Backup Camera</label>
                                </div>
                                <div class="form-check feature-checkbox">
                                    <input class="form-check-input" type="checkbox" name="features[]" value="Audio system">
                                    <label class="form-check-label">Audio system</label>
                                </div>
                                <div class="form-check feature-checkbox">
                                    <input class="form-check-input" type="checkbox" name="features[]" value="GPS navigation">
                                    <label class="form-check-label">GPS navigation</label>
                                </div>
                                <div class="form-check feature-checkbox">
                                    <input class="form-check-input" type="checkbox" name="features[]" value="Breakfast">
                                    <label class="form-check-label">Breakfast</label>
                                </div>
                                <div class="form-check feature-checkbox">
                                    <input class="form-check-input" type="checkbox" name="features[]" value="Anti-lock brake system (ABS)">
                                    <label class="form-check-label">Anti-lock brake system (ABS)</label>
                                </div>
                                <div class="form-check feature-checkbox">
                                    <input class="form-check-input" type="checkbox" name="features[]" value="Airbags">
                                    <label class="form-check-label">Airbags</label>
                                </div>
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
                                    <input type="text" class="form-control" placeholder="Service title 1" name="extra_services[0][title]">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" placeholder="Price ($)" name="extra_services[0][price]">
                                </div>
                                <div class="col-md-1 text-end">
                                    <i class="fa-solid fa-trash-can text-muted remove-service" style="cursor: pointer;"></i>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-3">
                            <button type="button" class="btn btn-light-custom fw-bold" id="add-service-btn">Add More</button>
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
        background-color: #ff6b00; /* bright orange */
    }

    /* Icon size */
    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 20px;
    }

    /* Position tweaks */
    .swiper-button-prev {
        left: 10px;
        color:#fff;
        background-color: #ff9800;
        border-radius: 50%;
        width: 40px;
        height: 40px;
    }
    .swiper-button-next {
        right: 10px;
        z-index: 10;
        color:#fff;
        background-color: #ff9800;
        border-radius: 50%;
        width: 40px;
        height: 40px;
    }

    /* Optional: Add shadow for better visibility */
    .custom-swiper-btn {
        box-shadow: 0 2px 5px rgba(0,0,0,0.5);
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
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    /* Primary selected border */
    .primary-selected .preview-img-container {
        border: 3px solid #ff9800 !important;
        box-shadow: 0 0 0 2px #ff9800;
    }
</style>
@endsection

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
            container.addEventListener('click', function(e){
                if(e.target.classList.contains('remove-service')){
                    const row = e.target.closest('.extra-service-row');
                    if(row) row.remove();
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
        imageInput.addEventListener('change', function() {
            swiperWrapper.innerHTML = '';
            resetPrimarySelection();
            
            const files = Array.from(this.files);
            if (files.length === 0) return;
            
            files.forEach((file, idx) => {
                const reader = new FileReader();
                reader.onload = function(e) {
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
            form.addEventListener('submit', function(e) {
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
    document.addEventListener('DOMContentLoaded', function() {
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