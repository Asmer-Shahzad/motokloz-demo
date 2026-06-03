{{-- ============================================================
     DEALER CONTACT POPUP MODAL
     Button needs: onclick="handleCallClick(event, this)"
     data-phone, data-dealer, data-email, data-address,
     data-website, data-whatsapp, data-vehicle,
     data-avatar, data-location
============================================================ --}}
<div id="dealerContactModal" class="dmp-overlay" onclick="closeDealerModal(event)">
    <div class="dmp-box" onclick="event.stopPropagation()">

        {{-- Close --}}
        <button class="dmp-close" onclick="closeDealerModal()" aria-label="Close">&times;</button>

        {{-- Header: circular avatar + name + address + vehicle --}}
        <div class="dmp-header">
            <div class="dmp-avatar-wrap" id="dmpIconWrap">
                <img id="dmpAvatarImg" src="" alt="Dealer" class="dmp-avatar-img" style="display:none;">
                <span class="dmp-avatar-fallback" id="dmpIconFallback">
                    {{-- SVG person silhouette --}}
                    <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="40" cy="40" r="40" fill="#555"/>
                        <circle cx="40" cy="30" r="13" fill="#888"/>
                        <ellipse cx="40" cy="65" rx="22" ry="14" fill="#888"/>
                    </svg>
                </span>
            </div>
            <div class="dmp-header-info">
                <h5 class="dmp-name" id="dmpDealerName">Dealer</h5>
                <p class="dmp-address-line" id="dmpLocation"></p>
                <p class="dmp-vehicle-line" id="dmpVehicle"></p>
            </div>
        </div>

        <div class="dmp-divider"></div>

        {{-- Loading --}}
        <div class="dmp-loading" id="dmpLoading" style="display:none;">
            <div class="dmp-spinner"></div>
        </div>

        {{-- No details --}}
        <div class="dmp-no-details" id="dmpNoDetails" style="display:none;">
            <p>No contact details available for this listing.</p>
        </div>

        {{-- Contact rows --}}
        <div class="dmp-body" id="dmpBody">

            {{-- Phone --}}
            <div class="dmp-row" id="dmpPhoneRow">
                <span class="dmp-row-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.01 1.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/>
                    </svg>
                </span>
                <span class="dmp-row-label">Phone:</span>
                <span class="dmp-row-value" id="dmpPhone"></span>
            </div>

            {{-- Email --}}
            <div class="dmp-row" id="dmpEmailRow">
                <span class="dmp-row-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                        <polyline points="2,4 12,13 22,4"/>
                    </svg>
                </span>
                <span class="dmp-row-label">Email:</span>
                <a class="dmp-row-value dmp-link" id="dmpEmail" href="#"></a>
            </div>

            {{-- WhatsApp --}}
            <div class="dmp-row" id="dmpWhatsappRow">
                <span class="dmp-row-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                    </svg>
                </span>
                <span class="dmp-row-label">WhatsApp:</span>
                <a class="dmp-row-value dmp-link" id="dmpWhatsapp" href="#" target="_blank" rel="noopener"></a>
            </div>

            {{-- Address --}}
            <div class="dmp-row" id="dmpAddressRow" style="display:none;">
                <span class="dmp-row-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </span>
                <span class="dmp-row-label">Address:</span>
                <span class="dmp-row-value" id="dmpAddress"></span>
            </div>

            {{-- Website --}}
            <div class="dmp-row" id="dmpWebsiteRow" style="display:none;">
                <span class="dmp-row-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="2" y1="12" x2="22" y2="12"/>
                        <path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>
                    </svg>
                </span>
                <span class="dmp-row-label">Website:</span>
                <a class="dmp-row-value dmp-link" id="dmpWebsite" href="#" target="_blank" rel="noopener"></a>
            </div>

        </div>

        {{-- Call Now button (mobile only) --}}
        <div class="dmp-footer" id="dmpFooter">
            <a class="dmp-call-btn" id="dmpCallBtn" href="#">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px;margin-right:8px;">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.01 1.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/>
                </svg>
                Call Now
            </a>
        </div>

    </div>
</div>

<style>
    /* ── Overlay ── */
    .dmp-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.65);backdrop-filter:blur(3px);z-index:99999;align-items:center;justify-content:center;padding:16px}
    .dmp-overlay.active{display:flex}

    /* ── Box ── */
    .dmp-box{background:#2e2e2e;border-radius:16px;width:100%;max-width:500px;padding:32px 28px 24px;position:relative;box-shadow:0 20px 60px rgba(0,0,0,.5);animation:dmpIn .25s cubic-bezier(.34,1.4,.64,1) both;max-height:90vh;overflow-y:auto}
    @keyframes dmpIn{from{opacity:0;transform:translateY(24px) scale(.97)}to{opacity:1;transform:none}}

    /* ── Close ── */
    .dmp-close{position:absolute;top:14px;right:14px;width:34px;height:34px;border-radius:50%;border:none;background:#444;color:#ccc;font-size:20px;line-height:1;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .15s}
    .dmp-close:hover{background:#555;color:#fff}

    /* ── Header ── */
    .dmp-header{display:flex;align-items:center;gap:20px;margin-bottom:22px;padding-right:36px}

    /* Circular avatar */
    .dmp-avatar-wrap{width:72px;height:72px;border-radius:50%;border:3px solid #666;flex-shrink:0;overflow:hidden;background:#555;display:flex;align-items:center;justify-content:center}
    .dmp-avatar-img{width:100%;height:100%;object-fit:cover}
    .dmp-avatar-fallback{width:100%;height:100%;display:flex;align-items:center;justify-content:center}
    .dmp-avatar-fallback svg{width:100%;height:100%}

    /* Header text */
    .dmp-header-info{flex:1;min-width:0}
    .dmp-name{font-size:17px;font-weight:700;color:#fff;margin:0 0 4px;text-transform:uppercase;letter-spacing:.3px}
    .dmp-address-line{font-size:13px;color:#ccc;margin:0 0 3px;line-height:1.4;word-break:break-word}
    .dmp-address-line:empty{display:none}
    .dmp-vehicle-line{font-size:12px;color:#999;margin:0}
    .dmp-vehicle-line:empty{display:none}

    /* ── Divider ── */
    .dmp-divider{height:1px;background:#444;margin-bottom:20px}

    /* ── Loading ── */
    .dmp-loading{display:flex;justify-content:center;padding:20px 0}
    .dmp-spinner{width:36px;height:36px;border:3px solid #555;border-top-color:#f0a500;border-radius:50%;animation:dmpSpin .6s linear infinite}
    @keyframes dmpSpin{to{transform:rotate(360deg)}}

    /* ── No details ── */
    .dmp-no-details{text-align:center;padding:16px 0 24px;color:#aaa;font-size:14px}

    /* ── Body rows ── */
    .dmp-body{display:flex;flex-direction:column;gap:0;margin-bottom:20px}
    .dmp-row{display:flex;align-items:center;gap:14px;padding:13px 0;border-bottom:1px solid #3d3d3d}
    .dmp-row:last-child{border-bottom:none}

    /* Icon */
    .dmp-row-icon{width:22px;height:22px;flex-shrink:0;color:#ccc;display:flex;align-items:center;justify-content:center}
    .dmp-row-icon svg{width:20px;height:20px;stroke:#ccc}

    /* Label */
    .dmp-row-label{font-size:15px;font-weight:700;color:#fff;white-space:nowrap}

    /* Value */
    .dmp-row-value{font-size:15px;font-weight:600;color:#fff;word-break:break-word;text-decoration:none}
    .dmp-link{color:#fff;text-decoration:none}
    .dmp-link:hover{color:#f0a500;text-decoration:underline}

    /* ── Footer (mobile call btn) ── */
    .dmp-footer{margin-top:4px}
    .dmp-call-btn{display:flex;align-items:center;justify-content:center;width:100%;padding:15px;background:#f0a500;color:#fff!important;border-radius:12px;font-size:16px;font-weight:700;text-decoration:none!important;transition:background .18s}
    .dmp-call-btn:hover{background:#d99400;color:#fff!important}

    /* Desktop: hide Call Now */
    @media(min-width:768px){.dmp-footer{display:none!important}}
    /* Mobile: direct call, show popup only when no phone */
    @media(max-width:767px){.dmp-overlay{display:none}.dmp-overlay.active.no-phone{display:flex!important}}
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
        var whatsapp = el.getAttribute('data-whatsapp') || phone;
        var vehicle  = el.getAttribute('data-vehicle')  || '';
        var avatar   = el.getAttribute('data-avatar')   || '';
        var location = el.getAttribute('data-location') || '';

        // Mobile + phone → direct call
        if (isMobile() && phone) { window.location.href = 'tel:' + phone; return; }

        // Header
        document.getElementById('dmpDealerName').textContent = dealer;
        document.getElementById('dmpVehicle').textContent    = vehicle;

        // Location line under name (address from enriched data)
        var locEl = document.getElementById('dmpLocation');
        locEl.textContent = location || address || '';

        // Avatar
        var avatarImg    = document.getElementById('dmpAvatarImg');
        var iconFallback = document.getElementById('dmpIconFallback');
        if (avatar) {
            avatarImg.src = avatar;
            avatarImg.style.display = 'block';
            iconFallback.style.display = 'none';
            avatarImg.onerror = function() {
                avatarImg.style.display = 'none';
                iconFallback.style.display = 'flex';
            };
        } else {
            avatarImg.style.display = 'none';
            iconFallback.style.display = 'flex';
        }

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
                document.getElementById('dmpNoDetails').style.display = 'block';
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

            // Email
            var er = document.getElementById('dmpEmailRow');
            if (email) {
                document.getElementById('dmpEmail').textContent = email;
                document.getElementById('dmpEmail').href        = 'mailto:' + email;
                er.style.display = '';
            } else { er.style.display = 'none'; }

            // WhatsApp
            var wr = document.getElementById('dmpWhatsappRow');
            var waNum = whatsapp.replace(/\D/g, '');
            if (waNum) {
                var waEl = document.getElementById('dmpWhatsapp');
                waEl.textContent = whatsapp;
                waEl.href = 'https://wa.me/' + waNum;
                wr.style.display = '';
            } else { wr.style.display = 'none'; }

            // Address
            var ar = document.getElementById('dmpAddressRow');
            if (address) {
                document.getElementById('dmpAddress').textContent = address;
                ar.style.display = '';
            } else { ar.style.display = 'none'; }

            // Website
            var wsr = document.getElementById('dmpWebsiteRow');
            if (website) {
                var dw = website.replace(/^https?:\/\//, '').replace(/\/$/, '');
                document.getElementById('dmpWebsite').textContent = dw;
                document.getElementById('dmpWebsite').href = website.startsWith('http') ? website : 'https://' + website;
                wsr.style.display = '';
            } else { wsr.style.display = 'none'; }

        }, 300);
    }

    function closeDealerModal(e) {
        if (e && e.target !== document.getElementById('dealerContactModal')) return;
        document.getElementById('dealerContactModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.getElementById('dealerContactModal').classList.remove('active');
            document.body.style.overflow = '';
        }
    });
</script>
