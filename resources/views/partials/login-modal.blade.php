{{-- OLX-Style Login Modal --}}
<div class="modal fade" id="chatLoginModal" tabindex="-1" aria-labelledby="chatLoginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
        <div class="modal-content olx-modal-content">

            {{-- Close Button --}}
            <button type="button" class="olx-modal-close" data-bs-dismiss="modal" aria-label="Close">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>

            <div class="olx-modal-body" id="olxModalBody">

                {{-- ===== MAIN SCREEN ===== --}}
                <div id="olxMainScreen">
                    <h4 class="olx-modal-title">Login into your account</h4>
                    <p class="olx-modal-subtitle">Login or create an account to message the dealer</p>

                    {{-- Google --}}
                    <a href="{{ route('auth.oauth.redirect', 'google') }}" class="olx-social-btn olx-google-btn" id="googleLoginBtn">
                        <svg width="20" height="20" viewBox="0 0 48 48">
                            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                        </svg>
                        Login with Google
                    </a>

                    {{-- Facebook --}}
                    <a href="{{ route('auth.oauth.redirect', 'facebook') }}" class="olx-social-btn olx-facebook-btn" id="facebookLoginBtn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#1877F2">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        Login with Facebook
                    </a>

                    <div class="olx-divider"><span>OR</span></div>

                    {{-- Email --}}
                    <button type="button" class="olx-social-btn olx-email-btn" onclick="olxShowScreen('emailScreen')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 7 10-7"/>
                        </svg>
                        Login with Email
                    </button>

                    {{-- Phone --}}
                    <button type="button" class="olx-social-btn olx-phone-btn" onclick="olxShowScreen('phoneScreen')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.82a16 16 0 0 0 6.29 6.29l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        Login with Phone
                    </button>

                    <div class="olx-register-link">
                        New here? <a href="#" onclick="olxShowScreen('registerScreen'); return false;">Create an account</a>
                    </div>
                </div>

                {{-- ===== EMAIL SCREEN ===== --}}
                <div id="emailScreen" class="d-none">
                    <button class="olx-back-btn" onclick="olxShowScreen('mainScreen')">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M19 12H5M12 5l-7 7 7 7"/>
                        </svg>
                        Back
                    </button>
                    <h4 class="olx-modal-title">Login with Email</h4>

                    <form id="chatLoginForm" novalidate>
                        @csrf
                        <input type="hidden" name="intended_inventory_id" id="loginIntendedInventoryId">
                        <input type="hidden" name="intended_dealer_id" id="loginIntendedDealerId">

                        <div class="olx-field">
                            <label>Email or Username</label>
                            <input type="text" name="email" class="olx-input" placeholder="Enter your email" autocomplete="email" required>
                        </div>
                        <div class="olx-field">
                            <label>Password</label>
                            <input type="password" name="password" class="olx-input" placeholder="Enter your password" autocomplete="current-password" required>
                        </div>

                        <div id="loginError" class="olx-error d-none"></div>

                        <button type="submit" class="olx-submit-btn" id="loginSubmitBtn">
                            <span class="btn-text">Login</span>
                            <span class="btn-spinner spinner-border spinner-border-sm d-none ms-2" role="status"></span>
                        </button>
                    </form>

                    <div class="olx-register-link mt-3">
                        No account? <a href="#" onclick="olxShowScreen('registerScreen'); return false;">Register</a>
                    </div>
                </div>

                {{-- ===== PHONE SCREEN ===== --}}
                <div id="phoneScreen" class="d-none">
                    <button class="olx-back-btn" onclick="olxShowScreen('mainScreen')">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M19 12H5M12 5l-7 7 7 7"/>
                        </svg>
                        Back
                    </button>
                    <h4 class="olx-modal-title">Login with Phone</h4>
                    <p class="olx-modal-subtitle">Enter your phone number to receive a verification code.</p>

                    <div class="olx-field">
                        <label>Phone Number</label>
                        <input type="tel" id="phoneInput" class="olx-input" placeholder="+1 234 567 8900">
                    </div>
                    <div id="phoneError" class="olx-error d-none"></div>
                    <button type="button" class="olx-submit-btn" onclick="olxSendOtp()">
                        <span>Send Code</span>
                    </button>
                    <p class="olx-modal-subtitle mt-3" style="font-size:12px;">
                        Phone login requires SMS integration (Twilio/etc). Contact admin to enable.
                    </p>
                </div>

                {{-- ===== REGISTER SCREEN ===== --}}
                <div id="registerScreen" class="d-none">
                    <button class="olx-back-btn" onclick="olxShowScreen('mainScreen')">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M19 12H5M12 5l-7 7 7 7"/>
                        </svg>
                        Back
                    </button>
                    <h4 class="olx-modal-title">Create an Account</h4>

                    <form id="chatRegisterForm" novalidate>
                        @csrf
                        <input type="hidden" name="intended_inventory_id" id="registerIntendedInventoryId">
                        <input type="hidden" name="intended_dealer_id" id="registerIntendedDealerId">

                        <div class="olx-field">
                            <label>Full Name</label>
                            <input type="text" name="name" class="olx-input" placeholder="Your full name" autocomplete="name" required>
                        </div>
                        <div class="olx-field">
                            <label>Email</label>
                            <input type="email" name="email" class="olx-input" placeholder="Your email address" autocomplete="email" required>
                        </div>
                        <div class="olx-field">
                            <label>Password</label>
                            <input type="password" name="password" class="olx-input" placeholder="Min 8 characters" autocomplete="new-password" required>
                        </div>
                        <div class="olx-field">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="olx-input" placeholder="Repeat password" autocomplete="new-password" required>
                        </div>

                        <div id="registerError" class="olx-error d-none"></div>

                        <button type="submit" class="olx-submit-btn" id="registerSubmitBtn">
                            <span class="btn-text">Create Account</span>
                            <span class="btn-spinner spinner-border spinner-border-sm d-none ms-2" role="status"></span>
                        </button>
                    </form>
                </div>

            </div>{{-- /olxModalBody --}}
        </div>
    </div>
</div>

<style>
.olx-modal-content {
    background: #fff;
    border: none;
    border-radius: 16px;
    padding: 0;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.18);
}
.olx-modal-close {
    position: absolute;
    top: 16px;
    right: 16px;
    background: none;
    border: none;
    color: #333;
    cursor: pointer;
    padding: 4px;
    z-index: 10;
    line-height: 1;
    border-radius: 50%;
    transition: background 0.15s;
}
.olx-modal-close:hover { background: #f0f0f0; }
.olx-modal-body { padding: 36px 32px 32px; }
.olx-modal-title {
    font-family: 'Urbanist', sans-serif;
    font-weight: 700;
    font-size: 22px;
    color: #1a1a1a;
    margin-bottom: 6px;
    text-align: center;
}
.olx-modal-subtitle {
    color: #888;
    font-size: 13px;
    text-align: center;
    margin-bottom: 24px;
}
.olx-social-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    width: 100%;
    padding: 12px 16px;
    border-radius: 10px;
    border: 1.5px solid #ddd;
    background: #fff;
    color: #1a1a1a;
    font-family: 'Urbanist', sans-serif;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    margin-bottom: 12px;
    text-decoration: none;
    transition: border-color 0.15s, background 0.15s;
}
.olx-social-btn:hover { border-color: #aaa; background: #fafafa; color: #1a1a1a; text-decoration: none; }
.olx-google-btn:hover  { border-color: #EA4335; }
.olx-facebook-btn:hover { border-color: #1877F2; }
.olx-divider {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 4px 0 12px;
    color: #bbb;
    font-size: 13px;
}
.olx-divider::before, .olx-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #e8e8e8;
}
.olx-register-link {
    text-align: center;
    font-size: 14px;
    color: #555;
    margin-top: 16px;
}
.olx-register-link a { color: #ff9d00; font-weight: 600; text-decoration: none; }
.olx-register-link a:hover { text-decoration: underline; }
.olx-back-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    background: none;
    border: none;
    color: #555;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    padding: 0;
    margin-bottom: 20px;
    transition: color 0.15s;
}
.olx-back-btn:hover { color: #1a1a1a; }
.olx-field { margin-bottom: 16px; }
.olx-field label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #444;
    margin-bottom: 6px;
}
.olx-input {
    width: 100%;
    padding: 11px 14px;
    border: 1.5px solid #ddd;
    border-radius: 10px;
    font-size: 14px;
    color: #1a1a1a;
    background: #fff;
    transition: border-color 0.2s;
    outline: none;
}
.olx-input:focus { border-color: #ff9d00; box-shadow: 0 0 0 3px rgba(255,157,0,0.1); }
.olx-submit-btn {
    width: 100%;
    padding: 13px;
    background: #ff9d00;
    color: #000;
    border: none;
    border-radius: 10px;
    font-family: 'Urbanist', sans-serif;
    font-weight: 700;
    font-size: 15px;
    cursor: pointer;
    margin-top: 4px;
    transition: background 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}
.olx-submit-btn:hover { background: #e68c00; }
.olx-submit-btn:disabled { opacity: 0.6; cursor: not-allowed; }
.olx-error {
    background: #fff5f5;
    border: 1px solid #fcc;
    color: #c0392b;
    font-size: 13px;
    border-radius: 8px;
    padding: 10px 14px;
    margin-bottom: 12px;
}
</style>

<script>
(function () {
    var csrfToken = (document.querySelector('meta[name="csrf-token"]') || {}).getAttribute
        ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '';

    // Screen navigation
    window.olxShowScreen = function(screen) {
        ['mainScreen','emailScreen','phoneScreen','registerScreen'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el) el.classList.add('d-none');
        });
        var target = document.getElementById(screen);
        if (target) target.classList.remove('d-none');
    };

    window.olxSendOtp = function() {
        var phone = document.getElementById('phoneInput').value.trim();
        var err = document.getElementById('phoneError');
        if (!phone) {
            err.textContent = 'Please enter a phone number.';
            err.classList.remove('d-none');
            return;
        }
        err.classList.add('d-none');
        alert('SMS integration not configured. Please use Email login or contact admin.');
    };

    function setLoading(btn, loading) {
        btn.disabled = loading;
        var spinner = btn.querySelector('.btn-spinner');
        if (spinner) spinner.classList.toggle('d-none', !loading);
    }

    function showError(el, msg) { el.textContent = msg; el.classList.remove('d-none'); }
    function hideError(el) { el.classList.add('d-none'); }

    function submitForm(formEl, endpoint, errorEl, btnEl) {
        formEl.addEventListener('submit', function(e) {
            e.preventDefault();
            hideError(errorEl);
            setLoading(btnEl, true);
            fetch(endpoint, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                body: new FormData(formEl)
            })
            .then(function(res) { return res.json().then(function(d) { return { status: res.status, data: d }; }); })
            .then(function(res) {
                setLoading(btnEl, false);
                if (res.data.success) {
                    window.location.href = res.data.redirect;
                } else {
                    var msg = res.data.message || 'Something went wrong.';
                    if (res.data.errors) {
                        var first = Object.values(res.data.errors)[0];
                        msg = Array.isArray(first) ? first[0] : first;
                    }
                    showError(errorEl, msg);
                }
            })
            .catch(function() { setLoading(btnEl, false); showError(errorEl, 'Network error. Please try again.'); });
        });
    }

    submitForm(
        document.getElementById('chatLoginForm'),
        '{{ route("auth.login.ajax") }}',
        document.getElementById('loginError'),
        document.getElementById('loginSubmitBtn')
    );

    submitForm(
        document.getElementById('chatRegisterForm'),
        '{{ route("auth.register.ajax") }}',
        document.getElementById('registerError'),
        document.getElementById('registerSubmitBtn')
    );

    // Public API
    window.openChatLoginModal = function(inventoryId, dealerId, intendedUrl) {
        document.getElementById('loginIntendedInventoryId').value    = inventoryId || '';
        document.getElementById('loginIntendedDealerId').value       = dealerId    || '';
        document.getElementById('registerIntendedInventoryId').value = inventoryId || '';
        document.getElementById('registerIntendedDealerId').value    = dealerId    || '';

        // Store intended URL
        var url = intendedUrl || window.location.href;
        fetch('{{ route("chat.set.intent") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
            body: JSON.stringify({ url: url })
        }).finally(function() {
            // Also update OAuth redirect links with intent
            var googleBtn = document.getElementById('googleLoginBtn');
            var fbBtn = document.getElementById('facebookLoginBtn');
            if (googleBtn) googleBtn.href = '{{ route("auth.oauth.redirect", "google") }}';
            if (fbBtn) fbBtn.href = '{{ route("auth.oauth.redirect", "facebook") }}';

            olxShowScreen('mainScreen');
            bootstrap.Modal.getOrCreateInstance(document.getElementById('chatLoginModal')).show();
        });
    };
})();
</script>
