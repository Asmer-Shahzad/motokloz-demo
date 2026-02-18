<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <?php require_once(__DIR__ . '/../include/header-script.php'); ?>


</head>

<body>

    <?php require_once(__DIR__ . '/../include/header.php'); ?>

    <section class="auth-section">
        <div class="container">
            <div class="auth-card row g-0">

                <!-- Image -->
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="auth-image">
                        <img src="<?php echo $prefix; ?>/assets/images/truck.png" alt="truck">
                    </div>
                </div>

                <!-- Form -->
                <div class="signup-form col-lg-6 col-12">
                    <div class="auth-form text-center">

                        <span class="signup-badge">Sign Up</span>

                        <h2>Create an Account</h2>
                        <p>Motokloz your one-stop-shop for all your car buying needs!</p>
                        <form action="#" id="signup-form" class="user-form">
                            <div class="form-group">
                                <img src="<?php echo $prefix; ?>/assets/images/userlogin.png" alt="">
                                <input type="text" class="form-control" placeholder="Username">
                            </div>

                            <div class="form-group">
                                <img src="<?php echo $prefix; ?>/assets/images/Vector.png" alt="">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>

                            <div class="form-group">
                                <img src="<?php echo $prefix; ?>/assets/images/password.png" alt="">
                                <input type="password" class="form-control" placeholder="****************">
                            </div>

                            <div class="form-group">
                                <img src="<?php echo $prefix; ?>/assets/images/password.png" alt="">
                                <input type="password" class="form-control" placeholder="****************">
                            </div>

                            <button class="btn btn-auth d-flex align-items-center justify-content-center gap-2">
                                Sign Up
                                <img src="<?php echo $prefix; ?>/assets/images/bttnarrow.png" alt=" arrow" width="18">
                            </button>
                        </form>

                        <div class="login-text">
                            Already have an account?
                            <a href="#">Login Here!</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>





     <?php require_once(__DIR__ . '/../include/footer-script.php'); ?>
<?php require_once(__DIR__ . '/../include/footer.php'); ?>

</body>

</html>