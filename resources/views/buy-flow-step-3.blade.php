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

                            <h2>I know exactly what I want.</h2>

                            <p>
                                Perfect. Lock in your year, make, model and budget and we'll find your exact match from
                                verified listings across Canada.
                            </p>

                        </div>

                    </div>

                </div>


                <img src="/assets/images/amico.png" class="banner-img">

            </div>


            <!-- Form -->
            <div class="form-area">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Year</label>
                        <input type="text" class="form-control form-text-field" placeholder="Add Body Style">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Make</label>
                        <input type="text" class="form-control form-text-field" placeholder="Add Body Style">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Model</label>
                        <input type="text" class="form-control form-text-field" placeholder="Add Body Style">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Trim</label>
                        <input type="text" class="form-control form-text-field" placeholder="Add Body Style">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Max Price</label>
                        <input type="text" class="form-control form-text-field" placeholder="Add Body Style">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Max Payment</label>
                        <input type="text" class="form-control form-text-field" placeholder="Add Body Style">
                    </div>

                </div>

                <div class="form-bottom">

                    <a href="#" class="skip">Skip</a>

                    <button class="continue-btn">
                        Continue
                    </button>

                </div>

            </div>
            @include('partials.steps-form-footer')


        </div>

    </section>

    <script src="{{ asset('assets/script/stepsform.js') }}"></script>

</body>

</html>