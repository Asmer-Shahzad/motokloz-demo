<footer class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Subscribe to get deals on services near you!</h3>
                </div>
                <div class="subscribe-box col-lg-4">
                    <form data-ajax="true" id="subscribeForm" action="{{ route('subscribe.application.submit') }}" method="POST">
                        @csrf
                        <input type="email" name="email" id="email" placeholder="Enter your email" required>
                        <button type="submit">Subscribe</button>
                    </form>

                    <p id="msg"></p>
                </div>
            </div>
        </div>
        <div class="footer-mid">
            <div class="row">
                <div class="col-lg-6">
                    <a href="/">
                        <img src="/assets/images/darklogo.png" class="img-fluid" alt="Motokloz Logo">
                    </a>
                    <ul>
                        <li>
                            <i class="fa-sharp fa-solid fa-location-dot"></i>
                            <a href="#">#202 – 14204 128 AVE NW<br>
                                EDMONTON AB T5H 3L5
                            </a>
                        </li>
                        <li><i class="fa-sharp fa-solid fa-clock"></i><a href="#">Hours: 8:00 - 17:00, Mon - Sat</a>
                        </li>
                        <li><i class="fa-sharp fa-solid fa-envelope"></i><a
                                href="mailto:support@motokloz.com">support@motokloz.com</a></li>
                    </ul>
                    <div class="calltoaction">
                        <h5><i class="fa-sharp fa-solid fa-phone"></i> Need help? Call us</h5>
                        <h6><a href="tel:+8773475569">877-347-5569</a></h6>

                        <!-- Customer Support Button -->
                        <a href="javascript:void(0)" class="btn-custom" data-bs-toggle="modal" data-bs-target="#testDriveModal" data-title="Customer Support">
                            <i class="fa-solid fa-headset"></i> Customer Support
                        </a>
                    </div>
                </div>
                <!-- Hide Footer Right Side -->
                <!-- <div class="col-lg-2">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="/coming-soon">About Us</a></li>
                        <li><a href="/coming-soon">Our Mission</a></li>
                        <li><a href="/coming-soon">Careers</a></li>
                        <li><a href="/coming-soon">Merchandise</a></li>
                        <li><a href="/coming-soon">Terms of Use</a></li>
                        <li><a href="/coming-soon">Privacy Notice</a></li>
                        <li><a href="/coming-soon">Press Releases </a></li>
                    </ul>
                </div>

                <div class="col-lg-2">
                        <h4>Our Partners</h4>
                    <ul>
                        <li><a href="/coming-soon">Affiliates</a></li>
                        <li><a href="/coming-soon">Travel Agents</a></li>
                        <li><a href="/coming-soon">AARP Members</a></li>
                        <li><a href="/coming-soon">Points Programs</a></li>
                        <li><a href="/coming-soon">Military & Veterans</a></li>
                        <li><a href="/coming-soon">Work with us</a></li>
                        <li><a href="/coming-soon">Advertise with us</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="/coming-soon">Virtual Walk Arounds</a></li>
                        <li><a href="/coming-soon">Prebid Trade</a></li>
                        <li><a href="/coming-soon">Buyer Checklist</a></li>
                        <li><a href="/coming-soon">Seller Checklists</a></li>
                        <li><a href="/coming-soon">Secure The Best Approval</a></li>
                        <li><a href="/coming-soon">Get Verified</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h4>Support</h4>
                    <ul>
                        <li data-bs-toggle="modal" data-bs-target="#testDriveModal" data-title="Forum support">
                            <a href="javascript:void(0)">Forum support</a>
                        </li>
                        <li data-bs-toggle="modal" data-bs-target="#testDriveModal" data-title="Help Center">
                            <a href="javascript:void(0)">Help Center</a>
                        </li>
                        <li data-bs-toggle="modal" data-bs-target="#testDriveModal" data-title="Live chat">
                            <a href="javascript:void(0)">Live chat</a>
                        </li>
                        <li data-bs-toggle="modal" data-bs-target="#testDriveModal" data-title="Ad Guideline">
                            <a href="javascript:void(0)">Ad Guideline</a>
                        </li>
                        <li data-bs-toggle="modal" data-bs-target="#testDriveModal" data-title="Ad Support">
                            <a href="javascript:void(0)">Ad Support</a>
                        </li>
                        <li data-bs-toggle="modal" data-bs-target="#testDriveModal" data-title="Faq's">
                            <a href="javascript:void(0)">Faq's</a>
                        </li>
                        <li data-bs-toggle="modal" data-bs-target="#testDriveModal" data-title="Dealer Support">
                            <a href="javascript:void(0)">Dealer Support</a>
                        </li>
                    </ul>
                </div> -->

            </div>
        </div>
        <div class="footer-bottom">
            <div class="row">
                <div class="col-lg-6">
                    <p>© 2026 <a href="/">Motokloz</a>. All rights reserved.</p>
                </div>
                <div class="col-lg-6">
                    <ul class="social-icons">
                        <li>Follow us</li>
                        <li>
                            <a href="#">
                                <img src="/assets/images/insta (1).png" alt="Instagram" width="20">
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <img src="/assets/images/insta (2).png" alt="Facebook" width="20">
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <img src="/assets/images/insta (3).png" alt="Twitter" width="20">
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <img src="/assets/images/insta.png" alt="YouTube" width="20">
                            </a>
                        </li>



                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('partials.support-modal')
</footer>

<script>
$(document).ready(function () {

    $('#subscribeForm').on('submit', function (e) {
        e.preventDefault();

        let $form = $(this);
        let $btn = $form.find('button[type="submit"]');
        let originalText = $btn.html();

        let email = $('#email').val();

        $btn.prop('disabled', true).text('Subscribing...');

        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                email: email
            },

            success: function (res) {
                showSnackbar(res.message || 'Subscribed successfully!', 'success');
                $form[0].reset();
            },

            error: function (xhr) {
                let msg = xhr.responseJSON?.message || 'Something went wrong';
                showSnackbar(msg, 'error');
            },

            complete: function () {
                $btn.prop('disabled', false).html(originalText);
            }
        });

    });

});
</script>


<style>
    .social-icons img {
        width: 22px;
        height: 22px;
        object-fit: contain;
    }
</style>