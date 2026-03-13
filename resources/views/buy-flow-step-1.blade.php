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
            @include('partials.steps-form')


            <div class="banner">

                <div class="row align-items-center">

                    <div class="col-lg-8">

                        <div class="banner-text">

                            <img src="/assets/images/svglogo1 2 (1).png" class="pb-3">

                            <h2>Take Control of Your Next Move.</h2>

                            <p>
                                Tell us what you're looking for and we'll match you with the right inventory,
                                the right dealer, and the right deal — no runaround, no pressure.
                            </p>

                        </div>

                    </div>

                </div>

                <img src="/assets/images/pana.png" class="banner-img">

            </div>


            <!-- Form -->

            <div class="form-area">

                <h4 class="form-heading">
                    I would like to buy (select all that apply):
                </h4>

                <p class="form-para">Asset Type</p>


                <div class="checkbox-list">

                    <label><input type="checkbox" checked> Vehicle</label>

                    <label><input type="checkbox"> Trailers</label>

                    <label><input type="checkbox"> RV</label>

                    <label><input type="checkbox"> Powersport</label>

                    <label><input type="checkbox"> Heavy Truck</label>

                    <label><input type="checkbox"> Farm Equipment</label>

                    <label><input type="checkbox"> Motorcycle</label>

                    <button class=" con-btt">Continue</button>

                </div>

            </div>


            @include('partials.steps-form-footer')

        </div>

    </section>

    <script src="{{ asset('assets/script/stepsform.js') }}"></script>

</body>

</html>