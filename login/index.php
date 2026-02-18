<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
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
                        <img src="<?php echo $prefix; ?>/assets/images/Main.png" alt="main image">
                    </div>
                </div>

                <!-- Form -->
                <div class="signup-form col-lg-6 col-12">
                    <div class="auth-form text-center">

                        <span class="signup-badge">Sign In</span>

                        <h2>Welcome back</h2>
                        <p>Motokloz your one-stop-shop for all your car buying needs!</p>
                        <form action="#" id="signup-form" class="user-form">
                            <div class="form-group">
                                <img src="<?php echo $prefix; ?>/assets/images/userlogin.png" alt="">
                                <input type="text" class="form-control" placeholder="Email / Username">
                            </div>
                            <div class="form-group">
                                <img src="<?php echo $prefix; ?>/assets/images/password.png" alt="">
                                <input type="password" class="form-control" placeholder="****************">
                            </div>
                            <div class="remember-row">
                                <label class="remember-me">
                                    <input type="checkbox">
                                    <span>Remember me</span>
                                </label>

                                <a href="#" class="forgot-link">Forgot password?</a>
                            </div>


                            <button class="btn btn-auth d-flex align-items-center justify-content-center gap-2">
                                Login
                                <img src="<?php echo $prefix; ?>/assets/images/bttnarrow.png" alt=" arrow" width="18">
                            </button>
                        </form>

                        <div class="login-text">
                            Don’t have an account?
                            <a href="#">Register Here !</a>
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