<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Listing</title>
    <?php require_once(__DIR__ . '/../include/header-script.php'); ?>
</head>
<body>

<?php require_once(__DIR__ . '/../include/header.php'); ?>



<section class="agent-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-4">My Profile</h2>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        
        <div class="col-lg-3">
            <div class="sidebar-card shadow-sm">
                <div class="d-flex align-items-center mb-4 position-relative">
                    <img src="<?php echo $prefix; ?>/assets/images/border.png" class="rounded-circle me-3" alt="User">
                    <div>
                        <h6 class="mb-0">Steven Jobs</h6>
                        <small class="">Since 2017</small>
                    </div>
                    <i class="fas fa-edit position-absolute top-0 end-0 cursor-pointer"></i>
                </div>
                
                <nav class="nav flex-column">
                    <a class="nav-link active" href="#"><i class="fas fa-user me-2"></i> My Profile</a>
                    <a class="nav-link d-flex justify-content-between align-items-center" href="#">
                        <span><i class="fas fa-th-large me-2"></i> Dashboard</span>
                        <span class="badge badge-orange text-white">1</span>
                    </a>
                    <a class="nav-link" href="#"><i class="fas fa-list me-2"></i> Listings</a>
                    <a class="nav-link" href="#"><i class="fas fa-plus-circle me-2"></i> Add Listing</a>
                    <a class="nav-link" href="#"><i class="fas fa-heart me-2"></i> My Wishlist</a>
                    <a class="nav-link" href="#"><i class="fas fa-cog me-2"></i> Account Setting</a>
                </nav>
            </div>
        </div>

        <div class="col-lg-9">
            
    <div class="container">
    <div class="card-container">
        <h2 class="section-title">Car details</h2>
        
        <div class="row g-3 mb-4">
            <div class="col-md-3 col-6">
                <div class="img-upload-box">
                    <i class="fa-regular fa-image fa-2x mb-2"></i>
                    <span>Upload Image</span>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="preview-img-container">
                    <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&w=300" class="preview-img" alt="Car">
                    <div class="delete-btn"><i class="fa-solid fa-trash-can"></i></div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="preview-img-container">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=300" class="preview-img" alt="Car">
                    <div class="delete-btn"><i class="fa-solid fa-trash-can"></i></div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="preview-img-container">
                    <img src="https://images.unsplash.com/photo-1494976388531-d1058494cdd8?auto=format&fit=crop&w=300" class="preview-img" alt="Car">
                    <div class="delete-btn"><i class="fa-solid fa-trash-can"></i></div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12">
                <input type="text" class="form-control" placeholder="Listing Title *">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Model *">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Type *">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Condition *">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Stock Number">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Mileage">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Transmission">
            </div>
            <div class="col-12">
                <textarea class="form-control" rows="4" placeholder="Description"></textarea>
            </div>
        </div>

        <h4 class="mt-4 mb-3" style="font-weight: bold;">Features</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-check feature-checkbox"><input class="form-check-input" type="checkbox"> <label class="form-check-label">A/C: Front</label></div>
                <div class="form-check feature-checkbox"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Cruise Control</label></div>
                <div class="form-check feature-checkbox"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Touchscreen display</label></div>
                <div class="form-check feature-checkbox"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Phone connectivity</label></div>
                <div class="form-check feature-checkbox"><input class="form-check-input" type="checkbox"> <label class="form-check-label">In-car Wi-Fi</label></div>
                <div class="form-check feature-checkbox"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Brake assist (BA)</label></div>
            </div>
            <div class="col-md-6">
                <div class="form-check feature-checkbox"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Backup Camera</label></div>
                <div class="form-check feature-checkbox"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Audio system</label></div>
                <div class="form-check feature-checkbox"><input class="form-check-input" type="checkbox"> <label class="form-check-label">GPS navigation</label></div>
                <div class="form-check feature-checkbox"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Breakfast</label></div>
                <div class="form-check feature-checkbox"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Anti-lock brake system (ABS)</label></div>
                <div class="form-check feature-checkbox"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Airbags</label></div>
            </div>
        </div>
        <button class="btn btn-orange mt-3">Save Changes</button>
    </div>

    <div class="card-container">
        <h2 class="section-title">Pricing</h2>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Tour price ($)">
        </div>
        <label class="form-label fw-bold">Extra Services</label>
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Service title 1">
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" placeholder="Price ($)">
            </div>
            <div class="col-md-1 text-end">
                <i class="fa-solid fa-trash-can text-muted" style="cursor: pointer;"></i>
            </div>
        </div>
        <div class="text-end mt-3">
            <button class="btn btn-light-custom fw-bold">Add More</button>
        </div>
        <button class="btn btn-orange mt-3">Save Changes</button>
    </div>

    <div class="card-container">
        <h2 class="section-title">Car details</h2>
        <div class="row g-3">
            <div class="col-12">
                <input type="text" class="form-control" placeholder="Country">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Country">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="State">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="City">
            </div>
            <div class="col-12">
                <input type="text" class="form-control" placeholder="Address">
            </div>
            <div class="col-12">
                <input type="text" class="form-control" placeholder="Address 2">
            </div>
        </div>
        <button class="btn btn-orange mt-4">Save Changes</button>
    </div>
</div>
           

          

          

        </div>
    </div>
</div>







<?php require_once(__DIR__ . '/../include/footer-script.php'); ?>
<?php require_once(__DIR__ . '/../include/footer.php'); ?>
</body>
</html>




















<?php require_once(__DIR__ . '/../include/footer-script.php'); ?>
<?php require_once(__DIR__ . '/../include/footer.php'); ?>