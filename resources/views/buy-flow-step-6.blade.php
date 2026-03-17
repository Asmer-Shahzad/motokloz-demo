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

            @include('partials.steps-form-snd')


            <!-- BANNER -->

            <div class="banner">

                <div class="row align-items-center">

                    <div class="col-lg-8">

                        <div class="banner-text">

                            <img src="/assets/images/svglogo1 2 (1).png" class="pb-3">

                            <h2>Let's Find You the Best Rate.</h2>

                            <p>
                                Tell us about your budget, credit situation, and any trade-in — we'll match you with the
                                right lenders discreetly, with no impact to your credit score.
                            </p>

                        </div>

                    </div>

                </div>

                <img src="/assets/images/rafikii.png" class="banner-img">

            </div>


            <!-- FORM -->

            <div class="form-box">


                <!-- Budget -->

                <div class="form-group">

                    <h5 class="form-title">Budget</h5>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-labels">Best Rate</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-labels">Best Payment</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-labels">Best Overall Cost</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-labels">Apply to My Lender Choice</label>
                    </div>

                </div>



                <!-- Credit -->

                <div class="form-group mt-4">

                    <h5 class="form-title">Credit</h5>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-labels">Great Credit</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-labels">Decent Credit</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-labels">OK-ish Credit</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-labels">Poor Beacon – Need Help</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-labels">Poor Credit & Nervous</label>
                    </div>

                    <textarea class="form-control text-content mt-3" placeholder="Reason why"></textarea>

                </div>



                <!-- Trade -->

                <div class="form-group mt-4">

                    <h5 class="form-title">Trade-in</h5>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-labels">I have a trade</label>
                    </div>

                    <textarea class="form-control text-content mt-3" placeholder="Details"></textarea>

                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-labels">
                            Yes, I want my trade bid discreetly
                            <img src="/assets/images/infoo.png">
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-labels">I do not have a trade</label>
                    </div>

                </div>



                <!-- SAVE -->

                <div class="text-end mt-4">
                    <button class="save-btn">Save</button>
                </div>


            </div>
            @include('partials.steps-form-footer')


        </div>

    </section>
    <script src="{{ asset('assets/script/stepsform.js') }}"></script>

</body>

</html>