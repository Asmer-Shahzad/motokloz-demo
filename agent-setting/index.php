<!DOCTYPE html>
<html lang="en">
<head>
    <title>Agent Setting</title>
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
            

            <div class="form-card shadow-sm">
                <h5 class="mb-4 border-bottom pb-3">Update your profile</h5>
                
                <div class="d-flex align-items-center mb-4 gap-3">
                    <img src="<?php echo $prefix; ?>/assets/images/Travilla.png" class="rounded" alt="Avatar">
                    <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                    <button class="btn-orange shadow-sm">Change avatar</button>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Full Name *</label>
                        <input type="text" class="form-control" value="Steven Job">
                    </div>
                    <div class="col-md-6">
                        <label>Email *</label>
                        <input type="email" class="form-control" value="stevenjob@gmail.com">
                    </div>
                    <div class="col-md-6">
                        <label>Contact number *</label>
                        <input type="text" class="form-control" value="01 - 234 567 89">
                    </div>
                    <div class="col-md-6">
                        <label>Personal website</label>
                        <input type="text" class="form-control" value="https://allithemes.com">
                    </div>
                    <div class="col-12">
                        <label>Bio</label>
                        <textarea class="form-control" rows="4">We are AlliThemes, a creative and dedicated group of individuals who love web development...</textarea>
                    </div>
                    <div class="col-md-6">
                        <label>Languages</label>
                        <input type="text" class="form-control" value="English, French">
                    </div>
                    <div class="col-md-6">
                        <label>Nationality</label>
                        <input type="text" class="form-control" value="France">
                    </div>
                </div>
                <button class="btn-orange mt-4">Save Changes</button>
            </div>

            <div class="form-card shadow-sm">
                <h5 class="mb-4 border-bottom pb-3">Contact Information</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Country</label>
                        <input type="text" class="form-control" value="United States of America">
                    </div>
                    <div class="col-md-6">
                        <label>City</label>
                        <input type="text" class="form-control" value="Chicago">
                    </div>
                    <div class="col-12">
                        <label>Complete Address</label>
                        <input type="text" class="form-control" value="205 North Michigan Avenue, Suite 810, Chicago, 60601, USA">
                    </div>
                    <div class="col-12">
                        <label>Find On Map</label>
                        <input type="text" class="form-control" value="205 North Michigan Avenue, Suite 810, Chicago, 60601, USA">
                    </div>
                    <div class="col-md-6">
                        <label>Latitude</label>
                        <input type="text" class="form-control" placeholder="Address">
                    </div>
                    <div class="col-md-6">
                        <label>Longitude</label>
                        <input type="text" class="form-control" placeholder="Address 2">
                    </div>
                </div>
                <button class="btn-orange mt-4">Save Changes</button>
            </div>

            <div class="form-card shadow-sm">
                <h5 class="mb-4 border-bottom pb-3">Change Password</h5>
                <div class="row g-3">
                    <div class="col-12">
                        <label>Old Password</label>
                        <input type="password" class="form-control" value="**********">
                    </div>
                    <div class="col-12">
                        <label>New Password</label>
                        <input type="password" class="form-control" value="**********">
                    </div>
                    <div class="col-12">
                        <label>Confirm new password</label>
                        <input type="password" class="form-control" value="**********">
                    </div>
                </div>
                <button class="btn-orange mt-4">Save Changes</button>
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