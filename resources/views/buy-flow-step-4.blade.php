<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/stepsform.css') }}">

</head>


<body>

    <section class="buy-section container">

        <div class="buy-card">

            <!-- Progress -->

            @include('partials.steps-form')

            <div class="banner">

                <div class="row align-items-center">

                    <div class="col-lg-8">

                        <div class="banner-text">

                            <img src="/assets/images/svglogo1 2 (1).png" class="pb-3">

                            <h2>Let's Talk Money.</h2>

                            <p>
                                Tell us how you'd like to handle financing and how much help you need. We'll make sure
                                the right people are ready for you.
                            </p>

                        </div>

                    </div>

                </div>

                <img src="/assets/images/carrr.png" class="banner-img">

            </div>


            <!-- Form -->

            <div class="form-area">

                <div class="row">

                    <!-- Left Column -->

                    <div class="col-md-6">

                        <div class="checkbox-item">
                            <input type="checkbox" checked>
                            <label class="check-content">I will need dealership financing</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox">
                            <label class="check-content">Open to best rate options, may pay cash</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox">
                            <label class="check-content">I won't need financing</label>
                        </div>

                    </div>


                    <!-- Right Column -->

                    <div class="col-md-6">

                        <h5 class="pref-title">
                            MY PREFERENCE (Select all that apply):
                        </h5>

                        <div class="checkbox-item">
                            <input type="checkbox" checked>
                            <label class="check-content">I don't need help</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox">
                            <label class="check-content">I need a lot of help</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox">
                            <label class="check-content">Help with vehicle selection</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox">
                            <label class="check-content">Help negotiating</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox">
                            <label class="check-content">Help with pricing</label>
                        </div>

                        <div class="checkbox-item">
                            <input type="checkbox">
                            <label class="check-content">Help with financing</label>
                        </div>

                    </div>

                </div>


                <!-- Button -->

                <div class="form-bottom">

                    <button class="save-btn">
                        Save To Profile
                    </button>

                </div>

            </div>

            @include('partials.steps-form-footer')
        </div>

    </section>


    <script src="{{ asset('assets/script/stepsform.js') }}"></script>

</body>

</html>