<!DOCTYPE html>
<html lang="en">

<head>
    <title>Agent Setting</title>
    <?php require_once(__DIR__ . '/../include/header-script.php'); ?>
</head>

<body>
    <?php $pageTitle = 'My Profile'; ?>

    <?php require_once(__DIR__ . '/../include/header.php'); ?>




    <div class="container my-5">

        <!-- breadcrumbs -->

        <?php require_once(__DIR__ . '/../include/user-account-breadcrumbs.php'); ?>
        <div class="row">
            <div class="col-lg-3 page-title">
                <h1>My Profile</h1>
            </div>
        </div>
        <div class="row">

            <?php require_once(__DIR__ . '/../include/user-account-sidebar.php'); ?>

            <div class="col-lg-9">


                <div class="form-card shadow-sm">
                    <div class="agent-head">
                        <h5 class="mb-4 border-bottom pb-3 ">Update your profile</h5>
                    </div>


                    <div class="d-flex align-items-center m-4 gap-3">
                        <img src="<?php echo $prefix; ?>/assets/images/Travilla.png" class="rounded" alt="Avatar">
                        <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                        <button class="btn-orange shadow-sm">Change avatar</button>
                    </div>

                    <div class="row g-3   settng-all ">
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
                            <textarea class="form-control"
                                rows="4">We are AlliThemes, a creative and dedicated group of individuals who love web development...</textarea>
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
                    <button class="btn-orange mt-4 setting-btt">Save Changes</button>
                </div>

                <div class="form-card shadow-sm">
                    <div class="agent-head">
                        <h5 class="mb-4 border-bottom pb-3">Contact Information</h5>
                    </div>

                    <div class="row g-3   settng-all ">
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
                            <input type="text" class="form-control"
                                value="205 North Michigan Avenue, Suite 810, Chicago, 60601, USA">
                        </div>
                        <div class="col-12">
                            <label>Find On Map</label>
                            <input type="text" class="form-control"
                                value="205 North Michigan Avenue, Suite 810, Chicago, 60601, USA">
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
                    <button class="btn-orange mt-4 setting-btt">Save Changes</button>
                </div>

                <div class="form-card shadow-sm">
                    <div class="agent-head">
                        <h5 class="mb-4 border-bottom pb-3">Change Password</h5>
                    </div>

                    <div class="row g-3  settng-all">
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
                    <button class="btn-orange mt-4  setting-btt">Save Changes</button>
                </div>

            </div>
        </div>
    </div>


    <style>
    .agent-head {

        background-color: rgb(33 37 41 / 3%);
        padding: 8px;
    }

    .settng-all {
        padding: 20px;
    }

    .setting-btt {
        margin: 15px;
    }
    </style>




    <?php require_once(__DIR__ . '/../include/footer-script.php'); ?>
    <?php require_once(__DIR__ . '/../include/footer.php'); ?>
</body>

</html>




















<?php require_once(__DIR__ . '/../include/footer-script.php'); ?>
<?php require_once(__DIR__ . '/../include/footer.php'); ?>