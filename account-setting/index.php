<!DOCTYPE html>
<html>

<head>
    <title>Account Setting</title>
    <?php require_once(__DIR__ . '/../include/header-script.php'); ?>
</head>

<body>
    <?php require_once(__DIR__ . '/../include/header.php'); ?>

    <div class="container account-setting my-4">

        <!-- Breadcrumb -->
        <div class="d-flex align-items-center gap-2 mb-2 text-muted small Breadcrumb">
            <span class="Breadcrumb-home">Home</span>
            <span>›</span>
            <strong class="seat-head">Account Setting</strong>
        </div>

        <h2 class="main-head">Account Setting</h2>

        <div class="row g-4">

            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="account-sidebar">

                    <div class="side-top">
                        <div class="user-box mb-4">

                            <img src="<?php echo $prefix; ?>/assets/images/border.png" class=" user-img">

                            <div class="user-info">
                                <h6 class="user-info-head">Steven Jobs</h6>
                                <small class="user-info-para">Since 2019</small>
                            </div>

                            <span class="edit-btn">
                                <img src="<?php echo $prefix; ?>/assets/images/Link (3).png" class="edit-img">
                            </span>

                        </div>
                    </div>

                    <ul class="account-menu">

                        <li class="menu-item">
                            <img src="<?php echo $prefix; ?>/assets/images/Vector (2).png" class="menu-icon">
                            My Profile
                        </li>

                        <li class="menu-item d-flex justify-content-between align-items-center">
                            <div>
                                <img src="<?php echo $prefix; ?>/assets/images/Icon (1).png" class="menu-icon">
                                Dashboard
                            </div>
                            <span class="badge">1</span>
                        </li>

                        <li class="menu-item">
                            <img src="<?php echo $prefix; ?>/assets/images/Icon (2).png" class="menu-icon">
                            Listings
                        </li>

                        <li class="menu-item">
                            <img src="<?php echo $prefix; ?>/assets/images/material-symbols_add-rounded.png"
                                class="menu-icon">
                            Add Listing
                        </li>

                        <li class="menu-item">
                            <img src="<?php echo $prefix; ?>/assets/images/Icon (3).png" class="menu-icon">
                            My Wishlist
                        </li>

                        <li class="menu-item active">
                            <img src="<?php echo $prefix; ?>/assets/images/Icon (4).png" class="menu-icon">
                            Account Setting
                        </li>

                    </ul>

                </div>
            </div>


            <!-- Content -->
            <div class="col-lg-9">
                <div class="account-content">

                    <h5 class="account-content-head">Notifications</h5>

                    <!-- Row -->
                    <div class="notify-row">
                        <div class="notify-text">
                            <h6 class="notify-head">Booking Confirmations</h6>
                            <p class="notify-para">Instant notifications for flight, hotel, or activity bookings</p>
                        </div>

                        <div class="notify-switches">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label>SMS</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label>Email</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox">
                                <label>Push</label>
                            </div>
                        </div>
                    </div>

                    <div class="notify-row">
                        <div class="notify-text">
                            <h6 class="notify-head">Policy</h6>
                            <p class="notify-para">Stay informed about changes to our guidelines</p>
                        </div>

                        <div class="notify-switches">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label>SMS</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label>Email</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox">
                                <label>Push</label>
                            </div>
                        </div>
                    </div>

                    <div class="notify-row border-0">
                        <div class="notify-text">
                            <h6 class="notify-head">Promotions</h6>
                            <p class="notify-para">Updates on upcoming offers and promotions</p>
                        </div>

                        <div class="notify-switches">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label>SMS</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                                <label>Email</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox">
                                <label>Push</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <style>
    .Breadcrumb-home {
        font-size: 16px;
        line-height: 26px;
        color: #4D4D4D;
    }

    /* Base */
    .account-setting {
        font-family: "Vend Sans", sans-serif;
        color: #222;
    }

    /* Breadcrumb */
    .account-setting .seat-head {
        font-weight: 700;
        color: var(--select-color);
        font-size: 16px;
        line-height: 26px;
    }

    .Breadcrumb {
        border: 1px solid #DDE1DE;
        width: 228px;
        height: 44px;
        border-radius: 12px;
        border-color: #DDE1DE;
        padding: 10px;
    }

    /* Sidebar */
    .account-sidebar {
        border: 1px solid #eaeaea;
        border-radius: 14px;

        background: var(--bg-color);
        color: var(--select-color);
    }

    .user-box {
        display: flex;
        align-items: center;
        gap: 12px;

    }

    .form-check-input:checked {
        background-color: #3ad65c !important;
        border-color: #0d6efd;
    }

    .side-top {
        padding: 16px 13px;
        background: #21252908;
        margin: 0px;
        border-radius: 11px 11px 0 0;
        border-bottom: 1px solid #E4E6E8;
    }

    .user-box .user-info-head {
        font-size: 20px;
        font-weight: 700;
        line-height: 24px;
        color: var(--select-color);
    }

    .user-box .user-info-para {
        font-size: 14px;
        font-weight: 400;
        line-height: 24px;
        color: var(--select-color);
    }

    .user-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #DADEE2;
    }

    .edit-btn {
        margin-left: auto;
        font-size: 13px;
        color: #999;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .edit-btn:hover {
        color: #555;
    }

    /* Sidebar menu */
    .account-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .main-head {
        font-weight: 700;
        font-size: 45px;
        list-style: none;
        line-height: 58px;
        color: var(--select-color);
        padding: 10px 0;
    }

    .notify-row .notify-switches .form-switch .form-check-input:checked {
        border: 0 !important;
    }

    .account-menu li {
        display: flex;
        align-items: center;
        justify-content: start;
        padding: 10px 12px;
        border-radius: 8px;
        gap: 12px;
        font-size: 15px;
        color: var(--select-color);
        cursor: pointer;
        font-weight: 600;
        line-height: 24px;
    }

    img.menu-icon {
        width: 13px;
        height: 14px;
        object-fit: scale-down;
    }

    .account-menu li:hover {
        background: #f6f6f6;
    }

    .account-menu li.active {
        background: #fff3e8;
        color: #ff7a00;
        font-weight: 500;
    }

    .account-menu .badge {
        background: #F58D02;
        font-size: 15px;
        font-weight: 500;
        width: 24px;
        height: 24px;
        border-radius: 50px;
    }

    .notify-row .notify-switches .form-switch {
        padding: 0;
        flex-direction: column-reverse;
    }

    .notify-row .notify-switches .form-switch .form-check-input {
        margin: 0;
        float: unset !important;
        width: 32px;
        height: 16px;
    }

    img.edit-img {
        height: 28px;
        width: 28px;
        object-fit: cover;
    }

    /* Content */
    .account-content {
        border: 1px solid #eaeaea;
        border-radius: 14px;
        padding: 22px 24px;
        background: var(--bg-color);
        color: var(--select-color);
    }

    .account-content h5 {
        font-size: 16px;
    }

    h2.fw-bold.mb-4 {
        font-weight: 700;
        line-height: 58px;
        font-size: 44px;
        color: #000000;
    }

    label {
        font-size: 14px;
        line-height: 24px;
        font-weight: 700;
        color: var(--select-color);
    }

    /* Notification rows */
    .notify-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 0;
        gap: 20px;
    }

    .account-content-head {
        color: var(--select-color);
        font-weight: 700 !important;
        font-size: 20px !important;
        line-height: 26px;
    }


    .notify-text .notify-head {
        font-size: 16px;
        font-weight: 700;
        margin: 0;
        color: var(--select-color);
        line-height: 24px;
    }

    .notify-text .notify-para {
        font-size: 14px;
        color: #737373;
        font-weight: 500;
        margin: 4px 0 0;
        line-height: 24px;
    }

    /* Switches */
    .notify-switches {
        display: flex;
        align-items: center;
        gap: 55px;
        font-size: 13px;
        color: #444;
    }

    .form-switch {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-switch .form-check-input {
        cursor: pointer;
        accent-color: #3ad65c;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .account-sidebar {
            margin-bottom: 20px;
        }
    }

    @media (max-width: 768px) {
        .notify-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .notify-switches {
            margin-top: 10px;
            gap: 16px;
        }
    }
    </style>













    <?php require_once(__DIR__ . '/../include/footer-script.php'); ?>
    <?php require_once(__DIR__ . '/../include/footer.php'); ?>


</body>

</html>