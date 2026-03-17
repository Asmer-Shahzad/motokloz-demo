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
            @include('partials.steps-form-snd')




            <div class="banner">

                <div class="row align-items-center">

                    <div class="col-lg-8">

                        <div class="banner-text">

                            <img src="/assets/images/svglogo1 2 (1).png" class="pb-3">

                            <h2>Protect Your Investment — Discreetly.</h2>

                            <p>
                                Select the coverage you're interested in and we'll get you discreet quotes from trusted
                                providers — no sales calls, no obligation, just real numbers.
                            </p>

                        </div>

                    </div>

                </div>

                <img src="/assets/images/rafikii.png" class="banner-img">

            </div>



            <div class="form-area">

                <div class="form-section">

                    <p class="form-label-title">Select Any:</p>

                    <div class="checkbox-item">
                        <input type="checkbox">
                        <label class="check-content requires-info-content">
                            Asset Insurance Protection
                            <img src="/assets/images/infoo.png" class="info-icon" alt="info">
                        </label>
                    </div>

                    <div class="checkbox-item">
                        <input type="checkbox">
                        <label class="check-content requires-info-content">
                            Mechanical Protection
                            <img src="/assets/images/infoo.png" class="info-icon" alt="info">
                        </label>
                    </div>

                    <div class="checkbox-item">
                        <input type="checkbox">
                        <label class="check-content requires-info-content">
                            Appearance Protection
                            <img src="/assets/images/infoo.png" class="info-icon" alt="info">
                        </label>
                    </div>

                    <div class="checkbox-item">
                        <input type="checkbox">
                        <label class="check-content requires-info-content">
                            Creditor Protection
                            <img src="/assets/images/infoo.png" class="info-icon" alt="info">
                        </label>
                    </div>

                </div>


                <div class="form-section mt-4">

                    <p class="form-label-title">This is for:</p>

                    <div class="checkbox-item">
                        <input type="checkbox" checked>
                        <label class="check-content">Vehicle I currently own</label>
                    </div>

                    <div class="checkbox-item">
                        <input type="checkbox">
                        <label class="check-content">Vehicle I want to sell</label>
                    </div>

                    <div class="checkbox-item">
                        <input type="checkbox">
                        <label class="check-content">Vehicle I want to buy</label>
                    </div>

                </div>


                <div class="form-bottom">

                    <button class="save-btn">
                        Get My Discreet Quotes
                    </button>

                </div>

            </div>

            @include('partials.steps-form-footer')

        </div>

    </section>



    <script src="{{ asset('assets/script/stepsform.js') }}"></script>

</body>


</html>