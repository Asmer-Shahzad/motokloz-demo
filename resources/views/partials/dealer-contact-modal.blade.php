{{-- ============================================================
     DEALER CONTACT POPUP MODAL
     Usage: @include('partials.dealer-contact-modal')
     Button needs: onclick="handleCallClick(event, this)"
     data-phone, data-dealer, data-email, data-address,
     data-website, data-whatsapp, data-vehicle
============================================================ --}}
<div id="dealerContactModal" class="dealer-modal-overlay" onclick="closeDealerModal(event)">
    <div class="dealer-modal-box" onclick="event.stopPropagation()">
        <button class="dealer-modal-close" onclick="closeDealerModal()" aria-label="Close">&times;</button>

        {{-- Header --}}
        <div class="dealer-modal-header">
            <div class="dealer-modal-icon"><i class="fa-solid fa-store"></i></div>
            <div class="dealer-modal-header-text">
                <h5 class="dealer-modal-title" id="dmpDealerName">Dealer</h5>
                <p class="dealer-modal-vehicle" id="dmpVehicle"></p>
            </div>
        </div>
        <div class="dealer-modal-divider"></div>

        {{-- Loading --}}
        <div class="dealer-modal-loading" id="dmpLoading" style="display:none;">
            <div class="dealer-modal-spinner"></div>
            <p>Loading details…</p>
        </div>

        {{-- No details message --}}
        <div class="dealer-modal-no-details" id="dmpNoDetails" style="display:none;">
            <div class="dmp-no-icon"><i class="fa-solid fa-circle-info"></i></div>
            <p class="dmp-no-title">Contact Dealer Directly</p>
            <p class="dmp-no-msg">Pricing and contact details for this listing are not available online. Please visit the dealership or check their website for more information.</p>
        </div>

        {{-- Info rows --}}
        <div class="dealer-modal-body" id="dmpBody">

            {{-- Phone --}}
            <div class="dealer-modal-row" id="dmpPhoneRow">
                <div class="dealer-modal-row-icon"><i class="fa-solid fa-phone"></i></div>
                <div class="dealer-modal-row-content">
                    <span class="dealer-modal-label">Phone</span>
                    <div class="dealer-modal-phone-wrap">
                        <span class="dealer-modal-value" id="dmpPhone"></span>
                        <button class="dmp-copy-btn" id="dmpCopyBtn" onclick="copyDealerPhone()" title="Copy number">
                            <i class="fa-regular fa-copy" id="dmpCopyIcon"></i>
                            <span id="dmpCopyText">Copy</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- WhatsApp --}}
            <div class="dealer-modal-row" id="dmpWhatsappRow">
                <div class="dealer-modal-row-icon"><i class="fa-brands fa-whatsapp"></i></div>
                <div>
                    <span class="dealer-modal-label">WhatsApp</span>
                    <a class="dealer-modal-value" id="dmpWhatsapp" href="#" target="_blank" rel="noopener"></a>
                </div>
            </div>

            {{-- Email --}}
            <div class="dealer-modal-row" id="dmpEmailRow">
                <div class="dealer-modal-row-icon"><i class="fa-solid fa-envelope"></i></div>
                <div>
                    <span class="dealer-modal-label">Email</span>
                    <a class="dealer-modal-value" id="dmpEmail" href="#"></a>
                </div>
            </div>

            {{-- Address --}}
            <div class="dealer-modal-row" id="dmpAddressRow">
                <div class="dealer-modal-row-icon"><i class="fa-solid fa-location-dot"></i></div>
                <div>
                    <span class="dealer-modal-label">Address</span>
                    <span class="dealer-modal-value" id="dmpAddress"></span>
                </div>
            </div>

            {{-- Website --}}
            <div class="dealer-modal-row" id="dmpWebsiteRow">
                <div class="dealer-modal-row-icon"><i class="fa-solid fa-globe"></i></div>
                <div>
                    <span class="dealer-modal-label">Website</span>
                    <a class="dealer-modal-value" id="dmpWebsite" href="#" target="_blank" rel="noopener"></a>
                </div>
            </div>

        </div>

        {{-- Call Now (mobile only) --}}
        <div class="dealer-modal-footer" id="dmpFooter">
            <a class="dealer-modal-call-btn" id="dmpCallBtn" href="#">
                <i class="fa-solid fa-phone-volume me-2"></i> Call Now
            </a>
        </div>
    </div>
</div>

<style>
    .dealer-modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.55);backdrop-filter:blur(4px);z-index:99999;align-items:center;justify-content:center;padding:16px}
    .dealer-modal-overlay.active{display:flex}
    .dealer-modal-box{background:#fff;border-radius:22px;width:100%;max-width:480px;padding:28px 24px 24px;position:relative;box-shadow:0 24px 64px rgba(0,0,0,.22);animation:dmpIn .28s cubic-bezier(.34,1.56,.64,1) both;max-height:90vh;overflow-y:auto}
    @keyframes dmpIn{from{opacity:0;transform:translateY(28px) scale(.96)}to{opacity:1;transform:translateY(0) scale(1)}}
    .dealer-modal-close{position:absolute;top:16px;right:16px;width:36px;height:36px;border-radius:50%;border:none;background:#f2f2f2;color:#555;font-size:20px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .18s;z-index:1}
    .dealer-modal-close:hover{background:#e4e4e4;color:#111}
    .dealer-modal-header{display:flex;align-items:center;gap:16px;margin-bottom:20px;padding-right:40px}
    .dealer-modal-icon{width:58px;height:58px;border-radius:16px;background:#f0a500;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 4px 14px rgba(240,165,0,.35)}
    .dealer-modal-icon i{color:#fff;font-size:24px}
    .dealer-modal-title{font-size:18px;font-weight:700;color:#111;margin:0 0 4px}
    .dealer-modal-vehicle{font-size:13px;color:#888;margin:0}
    .dealer-modal-divider{height:1px;background:#f0f0f0;margin-bottom:20px}
    .dealer-modal-loading{display:flex;flex-direction:column;align-items:center;gap:12px;padding:24px 0 28px}
    .dealer-modal-spinner{width:40px;height:40px;border:4px solid #f0f0f0;border-top-color:#f0a500;border-radius:50%;animation:dmpSpin .65s linear infinite}
    @keyframes dmpSpin{to{transform:rotate(360deg)}}
    .dealer-modal-loading p{color:#aaa;font-size:13px;margin:0}
    .dealer-modal-no-details{display:flex;flex-direction:column;align-items:center;text-align:center;padding:10px 8px 24px;gap:10px}
    .dmp-no-icon{width:56px;height:56px;border-radius:50%;background:#fff8e6;display:flex;align-items:center;justify-content:center}
    .dmp-no-icon i{color:#f0a500;font-size:24px}
    .dmp-no-title{font-size:16px;font-weight:700;color:#111;margin:0}
    .dmp-no-msg{font-size:13px;color:#888;margin:0;line-height:1.6}
    .dealer-modal-body{display:flex;flex-direction:column;gap:4px;margin-bottom:22px}
    .dealer-modal-row{display:flex;align-items:center;gap:14px;padding:10px 0;border-bottom:1px solid #f5f5f5}
    .dealer-modal-row:last-child{border-bottom:none}
    .dealer-modal-row-icon{width:42px;height:42px;border-radius:12px;background:#fff8e6;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .dealer-modal-row-icon i{color:#f0a500;font-size:16px}
    .dealer-modal-label{display:block;font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.8px;color:#bbb;margin-bottom:3px}
    .dealer-modal-value{font-size:15px;font-weight:600;color:#111;text-decoration:none;word-break:break-word;display:block}
    a.dealer-modal-value:hover{color:#f0a500}
    .dealer-modal-row-content{flex:1;min-width:0}
    .dealer-modal-phone-wrap{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
    .dmp-copy-btn{display:inline-flex;align-items:center;gap:5px;padding:4px 12px;background:#fff8e6;border:1.5px solid #f0a500;border-radius:20px;color:#f0a500;font-size:12px;font-weight:600;cursor:pointer;transition:background .18s,color .18s;white-space:nowrap}
    .dmp-copy-btn:hover,.dmp-copy-btn.copied{background:#f0a500;color:#fff}
    .dealer-modal-footer{margin-top:4px}
    .dealer-modal-call-btn{display:flex;align-items:center;justify-content:center;width:100%;padding:16px;background:#f0a500;color:#fff!important;border-radius:14px;font-size:17px;font-weight:700;text-decoration:none!important;box-shadow:0 6px 20px rgba(240,165,0,.38);transition:background .18s,transform .15s}
    .dealer-modal-call-btn:hover{background:#d99400;transform:translateY(-2px);color:#fff!important}
    /* Desktop: hide Call Now — can't call from desktop */
    @media(min-width:768px){.dealer-modal-footer{display:none!important}}
    /* Mobile: hide copy btn, show popup only when no phone */
    @media(max-width:767px){.dealer-modal-overlay{display:none}.dealer-modal-overlay.active.no-phone{display:flex!important}.dmp-copy-btn{display:none}}
</style>

<script>
    function isMobile(){
        return window.innerWidth <= 767 || /Mobi|Android|iPhone|iPad/i.test(navigator.userAgent);
    }

    function handleCallClick(e, el) {
        e.stopPropagation();
        e.preventDefault();
        var phone    = el.getAttribute('data-phone')    || '';
        var dealer   = el.getAttribute('data-dealer')   || 'Dealer';
        var email    = el.getAttribute('data-email')    || '';
        var address  = el.getAttribute('data-address')  || '';
        var website  = el.getAttribute('data-website')  || '';
        var whatsapp = el.getAttribute('data-whatsapp') || phone; // fallback to phone
        var vehicle  = el.getAttribute('data-vehicle')  || '';

        // Mobile + phone → direct call
        if (isMobile() && phone) { window.location.href = 'tel:' + phone; return; }

        // Populate header
        document.getElementById('dmpDealerName').textContent = dealer;
        document.getElementById('dmpVehicle').textContent    = vehicle;

        // Show loading
        document.getElementById('dmpLoading').style.display   = 'flex';
        document.getElementById('dmpBody').style.display      = 'none';
        document.getElementById('dmpNoDetails').style.display = 'none';
        document.getElementById('dmpFooter').style.display    = '';

        var modal = document.getElementById('dealerContactModal');
        modal.classList.add('active');
        if (!phone) modal.classList.add('no-phone');
        else        modal.classList.remove('no-phone');
        document.body.style.overflow = 'hidden';

        setTimeout(function () {
            document.getElementById('dmpLoading').style.display = 'none';
            var hasDetails = phone || email || address || website || whatsapp;
            if (!hasDetails) {
                document.getElementById('dmpNoDetails').style.display = 'flex';
                document.getElementById('dmpBody').style.display      = 'none';
                document.getElementById('dmpFooter').style.display    = 'none';
                return;
            }
            document.getElementById('dmpBody').style.display = 'flex';

            // Phone
            var pr = document.getElementById('dmpPhoneRow');
            if (phone) {
                document.getElementById('dmpPhone').textContent    = phone;
                document.getElementById('dmpCallBtn').href         = 'tel:' + phone;
                document.getElementById('dmpFooter').style.display = '';
                pr.style.display = '';
            } else {
                pr.style.display = 'none';
                document.getElementById('dmpFooter').style.display = 'none';
            }

            // WhatsApp
            var wr2 = document.getElementById('dmpWhatsappRow');
            var waNum = whatsapp.replace(/\D/g, '');
            if (waNum) {
                var waEl = document.getElementById('dmpWhatsapp');
                waEl.textContent = whatsapp;
                waEl.href = 'https://wa.me/' + waNum;
                wr2.style.display = '';
            } else { wr2.style.display = 'none'; }

            // Email
            var er = document.getElementById('dmpEmailRow');
            if (email) {
                document.getElementById('dmpEmail').textContent = email;
                document.getElementById('dmpEmail').href        = 'mailto:' + email;
                er.style.display = '';
            } else { er.style.display = 'none'; }

            // Address
            var ar = document.getElementById('dmpAddressRow');
            if (address) {
                document.getElementById('dmpAddress').textContent = address;
                ar.style.display = '';
            } else { ar.style.display = 'none'; }

            // Website
            var wr = document.getElementById('dmpWebsiteRow');
            if (website) {
                var dw = website.replace(/^https?:\/\//, '').replace(/\/$/, '');
                document.getElementById('dmpWebsite').textContent = dw;
                document.getElementById('dmpWebsite').href = website.startsWith('http') ? website : 'https://' + website;
                wr.style.display = '';
            } else { wr.style.display = 'none'; }

        }, 350);
    }

    function closeDealerModal(e) {
        if (e && e.target !== document.getElementById('dealerContactModal')) return;
        document.getElementById('dealerContactModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    function copyDealerPhone() {
        var phone = document.getElementById('dmpPhone').textContent.trim();
        if (!phone) return;
        navigator.clipboard.writeText(phone).then(function () {
            var btn = document.getElementById('dmpCopyBtn');
            document.getElementById('dmpCopyIcon').className   = 'fa-solid fa-check';
            document.getElementById('dmpCopyText').textContent = 'Copied!';
            btn.classList.add('copied');
            setTimeout(function () {
                btn.classList.remove('copied');
                document.getElementById('dmpCopyIcon').className   = 'fa-regular fa-copy';
                document.getElementById('dmpCopyText').textContent = 'Copy';
            }, 2000);
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.getElementById('dealerContactModal').classList.remove('active');
            document.body.style.overflow = '';
        }
    });
</script>
