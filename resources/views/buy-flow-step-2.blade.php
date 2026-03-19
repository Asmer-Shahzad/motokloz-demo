<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/stepsform.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


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

                            <h2>I’m still figuring it out.</h2>

                            <p>
                                No problem. Set your budget and tell us what matters most — we'll help narrow it down so
                                you're not drowning in options.
                            </p>

                        </div>

                    </div>

                </div>

                <img src="/assets/images/amico.png" class="banner-img">

            </div>


            <!-- Form -->
            <div class="form-area">



                <div class="budget-section">
                    <h5 class="form-title">Budget</h5>

                    <div class="range-slider">

                        <div class="slider-track"></div>

                        <input type="range" min="0" max="1000" value="93" id="minRange">
                        <input type="range" min="0" max="1000" value="123" id="maxRange">

                    </div>

                    <div class="price-inputs">

                        <div class="price-box">
                            <span>Min price:</span>
                            <input type="text" value="$93">
                        </div>

                        <div class="price-box">
                            <span>Max price:</span>
                            <input type="text" value="$123">
                        </div>

                    </div>

                </div>

                <h5 class="form-title mt-4">Body Style</h5>

                <input type="text" class="form-control mb-3 form-text-field"" placeholder=" Add Body Style">

                <div class="tag-list">

                    <span class="tag">Sapien quisque</span>
                    <span class="tag">Sapien quisque</span>
                    <span class="tag">Sapien quisque</span>

                </div>


                <h5 class="form-title mt-4">Must-Haves</h5>

                <input type="text" class="form-control mb-3 form-text-field" placeholder="Add Body Style">

                <div class="tag-list">

                    <span class="tag">Sapien quisque</span>
                    <span class="tag">Sapien quisque</span>
                    <span class="tag">Sapien quisque</span>

                </div>


                <div class="form-actions">

                    <a href="#" class="skip">Skip</a>

                    <button class="continue-btn">
                        Continue
                    </button>

                </div>

            </div>
            <!-- #region -->



            @include('partials.steps-form-footer')
        </div>

    </section>




    <script src="{{ asset('assets/script/stepsform.js') }}"></script>
</body>

</html>