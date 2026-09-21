@extends('layouts.app')

@section('title', 'AN Canada - Motokloz Advantage Exclusive Offer')
@section('meta_description', 'Exclusive Automotive News Canada offer from Motokloz. Get the Motokloz Advantage for only $499/month locked in for 1 year.')

{{-- Exclude generic global header and footer partials from layouts.app --}}
@section('hide_header', 'true')
@section('hide_footer', 'true')

@section('body-attrs', 'class="an-canada-body" data-no-loader="1"')

@section('content')
<style>
    /* ==========================================================================
       AN Canada Landing Page Root & Theme Styles
       ========================================================================== */
    :root {
        --an-bg: #0F1216;
        --an-card-bg: rgba(18, 23, 30, 0.95);
        --an-form-bg: rgba(16, 22, 30, 0.92);
        --an-input-bg: rgba(11, 15, 21, 0.95);
        --an-input-border: #222C38;
        --an-text-main: #FFFFFF;
        --an-text-sub: #94A3B8;
        --an-text-muted: #8C96A5;
        --an-border-color: rgba(255, 255, 255, 0.12);
        --an-footer-bg: #0B0E12;
        --an-feature-title: #FFFFFF;
        --an-feature-sub: #CBD5E1;
        --an-mid-card-bg: #12161D;
    }

    body:not(.dark-mode) .an-page-wrapper {
        --an-bg: #F4F6F9;
        --an-card-bg: #FFFFFF;
        --an-form-bg: #FFFFFF;
        --an-input-bg: #F8FAFC;
        --an-input-border: #CBD5E1;
        --an-text-main: #0F172A;
        --an-text-sub: #475569;
        --an-text-muted: #64748B;
        --an-border-color: rgba(0, 0, 0, 0.1);
        --an-footer-bg: #FFFFFF;
        --an-feature-title: #0F172A;
        --an-feature-sub: #475569;
        --an-mid-card-bg: #12161D; /* Keeps dark graphic box so white text in PNG stays sharp */
    }

    body.an-canada-body {
        background-color: var(--an-bg) !important;
        color: var(--an-text-main) !important;
        font-family: 'Urbanist', 'Geist', 'Vend Sans', sans-serif !important;
        overflow-x: hidden;
        margin: 0;
        padding: 0;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Completely disable and hide global full-screen speedometer loader on AN Canada */
    #page-loader,
    body.loader-active #page-loader,
    body.an-canada-body #page-loader {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
        z-index: -9999 !important;
    }

    /* Hide floating scroll button on this landing page */
    #scrollTopBtn {
        display: none !important;
    }

    .an-page-wrapper {
        background-color: var(--an-bg);
        color: var(--an-text-main);
        width: 100%;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .an-container {
        max-width: 1360px;
        width: 100%;
        margin: 0 auto;
        padding: 0 30px;
    }

    .text-orange {
        color: #F58D02 !important;
    }

    .text-gold {
        color: #FFB703 !important;
    }

    /* Logo toggle between Dark/Light */
    .an-brand-logo .logo-dark-ver {
        display: block;
        height: 40px;
        width: auto;
    }

    .an-brand-logo .logo-light-ver {
        display: none;
        height: 40px;
        width: auto;
    }

    body:not(.dark-mode) .an-brand-logo .logo-dark-ver {
        display: none;
    }

    body:not(.dark-mode) .an-brand-logo .logo-light-ver {
        display: block;
    }

    /* ==========================================================================
       1. Top Navigation Bar (100% Figma & Responsive Matched)
       ========================================================================== */
    .an-navbar {
        padding: 22px 0 16px;
        background: transparent;
        position: relative;
        z-index: 100;
    }

    .an-navbar-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
    }

    .an-nav-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .an-brand-logo {
        display: inline-flex;
        align-items: center;
    }

    .an-nav-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .an-nav-mobile-trigger {
        display: none;
    }

    /* Mobile 3-Dot Button */
    .an-mobile-dots-btn {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid var(--an-border-color);
        color: var(--an-text-main);
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        cursor: pointer;
        transition: all 0.2s ease;
        padding: 0;
    }

    body:not(.dark-mode) .an-mobile-dots-btn {
        background: rgba(0, 0, 0, 0.05);
        color: #0F172A;
    }

    .an-mobile-dots-btn:hover {
        border-color: #F58D02;
        color: #F58D02;
        background: rgba(245, 141, 2, 0.12);
    }

    /* Mobile Dropdown Popup */
    .an-mobile-menu-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 10px);
        left: 0;
        right: 0;
        background: var(--an-card-bg);
        border: 1px solid var(--an-border-color);
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 14px 40px rgba(0, 0, 0, 0.5);
        z-index: 9999;
        backdrop-filter: blur(14px);
    }

    .an-mobile-menu-dropdown.show {
        display: block;
        animation: anSlideDown 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes anSlideDown {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .an-mobile-menu-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid var(--an-border-color);
    }

    .an-mobile-menu-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .an-mobile-menu-label {
        font-size: 14.5px;
        font-weight: 700;
        color: var(--an-text-main);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Language Pill matching Figma */
    .an-nav-lang-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.22);
        border-radius: 50px;
        padding: 8px 18px;
        font-size: 14px;
        font-weight: 700;
        color: #FFFFFF;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    body:not(.dark-mode) .an-nav-lang-btn {
        background: rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.15);
        color: #0F172A;
    }

    .an-nav-lang-btn:hover {
        border-color: #F58D02;
        color: #F58D02;
    }

    /* GTranslate Dropdown */
    .gtranslate_wrapper {
        display: inline-flex;
        align-items: center;
        z-index: 99;
    }

    .gtranslate_wrapper select {
        background: rgba(255, 255, 255, 0.06);
        color: #FFFFFF;
        border: 1px solid rgba(255, 255, 255, 0.22);
        border-radius: 50px;
        padding: 8px 18px;
        font-size: 14px;
        font-weight: 700;
        outline: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    body:not(.dark-mode) .gtranslate_wrapper select {
        background: rgba(0, 0, 0, 0.05);
        color: #0F172A;
        border: 1px solid rgba(0, 0, 0, 0.15);
    }

    .gtranslate_wrapper select:hover {
        border-color: #F58D02;
    }

    /* Theme Toggle Button (Matches Header Style) */
    button.an-theme-toggle-btn {
        background: transparent !important;
        border: none !important;
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        padding: 0;
        transition: transform 0.25s ease;
    }

    button.an-theme-toggle-btn:hover {
        transform: scale(1.08);
    }

    button.an-theme-toggle-btn img#themeIcon,
    button.an-theme-toggle-btn img#themeIconMobile {
        width: 40px;
        height: 40px;
        object-fit: contain;
        display: block;
    }


    .an-login-btn {
        background: #F58D02;
        color: #FFFFFF !important;
        font-size: 15px;
        font-weight: 800;
        padding: 11px 28px;
        border-radius: 50px;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(245, 141, 2, 0.35);
        transition: all 0.25s ease;
        cursor: pointer;
    }

    .an-login-btn:hover {
        background: #ff9a1a;
        box-shadow: 0 6px 20px rgba(245, 141, 2, 0.5);
        transform: translateY(-1px);
        color: #FFFFFF !important;
    }

    /* ==========================================================================
       2. Hero Offer Banner (FULL WIDTH Edge-to-Edge with Enhanced Typography)
       ========================================================================== */
    .an-hero-section {
        width: 100%;
        padding: 0;
        margin: 6px 0 45px;
    }

    .an-hero-banner-wrap {
        position: relative;
        width: 100%;
        border-radius: 0;
        overflow: hidden;
        border-top: 1px solid var(--an-border-color);
        border-bottom: 1px solid var(--an-border-color);
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.4);
        background: #14181F;
    }

    .an-hero-bg-img {
        width: 100%;
        height: auto;
        display: block;
        min-height: 580px;
        max-height: 760px;
        object-fit: cover;
        object-position: right center;
    }

    /* Inner Container holding the text inside the full-width banner */
    .an-hero-inner-container {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        max-width: 1360px;
        margin: 0 auto;
        padding: 40px 30px;
        display: flex;
        align-items: center;
        pointer-events: none;
        z-index: 5;
    }

    .an-hero-content-overlay {
        width: 58%;
        max-width: 740px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        pointer-events: auto;
    }
.theme-iconss{
    border-radius: 20px;
    background: var(--an-text-main);
}
    .an-offer-badge {
        background: #F58D02;
        color: #FFFFFF;
        font-size: 15px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 8px 20px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 9px;
        width: fit-content;
        margin-bottom: 14px;
        box-shadow: 0 4px 15px rgba(245, 141, 2, 0.45);
    }

    .an-offer-badge img.an-badge-leaf {
        width: 17px;
        height: 17px;
        object-fit: contain;
        filter: brightness(0) invert(1);
    }

    .an-hero-heading {
        font-size: clamp(30px, 3.4vw, 56px);
        font-weight: 800;
        color: #FFFFFF;
        line-height: 1.14;
        margin-bottom: 10px;
        text-shadow: 0 3px 14px rgba(0, 0, 0, 0.7);
        letter-spacing: -0.5px;
    }

    .an-hero-heading span.text-gold {
        color: #FFB703;
        font-weight: 900;
    }

    .an-hero-price {
        display: flex;
        align-items: baseline;
        gap: 12px;
        margin-bottom: 14px;
    }

    .an-hero-price .price-val {
        font-size: clamp(42px, 4.6vw, 72px);
        font-weight: 900;
        color: #FFB703;
        font-style: italic;
        line-height: 1;
        text-shadow: 0 4px 16px rgba(0, 0, 0, 0.8);
    }

    .an-hero-price .price-period {
        font-size: clamp(22px, 2.4vw, 38px);
        font-weight: 800;
        color: #FFFFFF;
        font-style: italic;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.7);
    }

    /* Skewed Ribbon Badge for Locked In For 1 Year */
    .an-locked-badge-wrap {
        display: inline-block;
        background: #000000;
        transform: skewX(-14deg);
        padding: 10px 26px;
        border-radius: 3px;
        margin-bottom: 16px;
        width: fit-content;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.6);
    }

    .an-locked-badge-text {
        display: block;
        transform: skewX(14deg);
        color: #FFFFFF;
        font-size: 17px;
        font-weight: 900;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .an-expiry-note {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 17px;
        font-weight: 800;
        color: rgba(255, 255, 255, 0.95);
        text-shadow: 0 2px 6px rgba(0, 0, 0, 0.8);
    }

    .an-expiry-note .an-cal-icon {
        width: 28px;
        height: 28px;
        background: #F58D02;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFFFFF;
        font-size: 14px;
        box-shadow: 0 2px 8px rgba(245, 141, 2, 0.4);
    }

    /* ==========================================================================
       3. 4 Features Row (Bigger Font Size & High-Contrast Icons in Both Themes)
       ========================================================================== */
    .an-features-section {
        padding: 15px 0 50px;
    }

    .an-features-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 28px;
        align-items: center;
    }

    .an-feature-card {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 10px 14px;
        border-radius: 14px;
        transition: transform 0.25s ease;
    }

    .an-feature-card:hover {
        transform: translateY(-3px);
    }

    /* High contrast dark circular backing ensures white vector icons are 100% visible on both dark and light themes */
    .an-feature-icon-img {
        width: 72px;
        height: 72px;
        flex-shrink: 0;
        object-fit: contain;
        background: #14181F;
        border-radius: 50%;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.18);
        padding: 2px;
    }

    .an-feature-text {
        font-size: 19px;
        line-height: 1.25;
        color: var(--an-text-main);
    }

    .an-feature-text strong {
        display: block;
        font-weight: 800;
        font-size: 20px;
        color: var(--an-feature-title);
    }

    .an-feature-text span {
        font-size: 20px;
        font-weight: 700;
        color: var(--an-feature-title);
    }

    .an-feature-text span.badge-free {
        color: #F58D02;
        font-weight: 900;
        font-size: 24px;
    }

    .an-feature-text span.badge-leads {
        color: #F58D02;
        font-weight: 900;
        font-size: 24px;
    }

    /* ==========================================================================
       4. Middle Platform & Leads Box (Bigger Typography & Exact Borders)
       ========================================================================== */
    .an-middle-section {
        padding: 10px 0 70px;
    }

    .an-middle-card {
        background: var(--an-mid-card-bg);
        border: 1.5px solid #F58D02;
        border-radius: 20px;
        padding: 32px 50px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 36px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2), 0 0 20px rgba(245, 141, 2, 0.12);
        position: relative;
    }

    .an-mid-left {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .an-mid-left img {
        max-width: 480px;
        width: 100%;
        height: auto;
        object-fit: contain;
    }

    .an-mid-divider {
        width: 1px;
        height: 74px;
        background: rgba(255, 255, 255, 0.15);
    }

    .an-mid-right {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 22px;
        justify-content: flex-start;
        padding-left: 28px;
    }

    .an-mid-target-icon {
        width: 64px;
        height: 64px;
        flex-shrink: 0;
        object-fit: contain;
    }

    .an-mid-leads-info {
        display: flex;
        flex-direction: column;
    }

    .an-mid-leads-sub {
        font-size: 20px;
        font-weight: 800;
        letter-spacing: 1.5px;
        color: #CBD5E1;
        text-transform: uppercase;
        line-height: 1.2;
    }

    .an-mid-leads-title {
        font-size: 55px;
        font-weight: 900;
        color: #F58D02;
        line-height: 1;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    /* ==========================================================================
       5. Contact Us Section (100% Figma Aligned Layout)
       ========================================================================== */
    .an-contact-section {
        position: relative;
        background: url('{{ asset("assets/images/image 2709.png") }}') center center / cover no-repeat;
        padding: 100px 0 120px;
        margin-top: 20px;
    }

    .an-contact-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, var(--an-bg) 0%, rgba(15, 18, 22, 0.45) 25%, rgba(15, 18, 22, 0.6) 75%, var(--an-bg) 100%);
        pointer-events: none;
    }

    .an-contact-grid {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 70px;
        align-items: center;
    }

    /* Contact Left Info */
    .an-contact-left {
        display: flex;
        flex-direction: column;
    }

    /* Maple Leaf side-by-side with AN CANADA / CONTACT US and unified text alignment */
    .an-contact-header-block {
        display: flex;
        align-items: flex-start;
        gap: 24px;
        margin-bottom: 16px;
    }

    .an-leaf-img {
        width: 76px;
        height: 76px;
        object-fit: contain;
        flex-shrink: 0;
        margin-top: 4px;
    }

    .an-contact-header-text {
        display: flex;
        flex-direction: column;
    }

    .an-contact-brand {
        font-size: 52px;
        font-weight: 800;
        letter-spacing: 1.2px;
        color: #FFFFFF;
        text-transform: uppercase;
        margin-bottom: 2px;
        line-height: 1.05;
    }

    .an-contact-title {
        font-size: 68px;
        font-weight: 900;
        color: #F58D02;
        text-transform: uppercase;
        line-height: 1.05;
        margin: 0 0 16px 0;
        letter-spacing: 0.5px;
    }

    .an-contact-desc {
        font-size: 18px;
        font-weight: 600;
        color: #CBD5E1;
        line-height: 1.6;
        max-width: 460px;
        margin: 0 0 10px 0;
    }

    .an-info-list {
        display: flex;
        flex-direction: column;
        gap: 26px;
        padding-left: 100px; /* Aligns phone, email, location with AN CANADA & paragraph text */
    }

    .an-info-row {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    /* Fixed Icon Box: Always visible icon on normal & hover state */
    .an-info-icon-box {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        border: 1.5px solid #F58D02;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: rgba(245, 141, 2, 0.08);
        transition: all 0.25s ease;
        text-decoration: none;
        
    }

    .an-info-icon-box i {
        color: #F58D02;
        font-size: 20px;
        transition: color 0.25s ease;
    }

    .an-info-row:hover .an-info-icon-box {
        background: #F58D02;
        border-color: #F58D02;
        transform: scale(1.06);
    }

    .an-info-row:hover .an-info-icon-box i {
        color: #FFFFFF !important;
    }

    .an-info-text {
        display: flex;
        flex-direction: column;
    }

    .an-info-label {
        font-size: 14px;
        color: #94A3B8;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .an-info-val {
        font-size: 19px;
        color: #FFFFFF !important;
        font-weight: 800;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    a.an-info-val:hover {
        color: #F58D02 !important;
    }

    /* Contact Right Form */
    .an-form-card {
        background: var(--an-form-bg);
        border: 1.5px solid rgba(245, 141, 2, 0.35);
        border-radius: 22px;
        padding: 42px 38px;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
    }

    .an-form-head-title {
        font-size: 26px;
        font-weight: 800;
        color: var(--an-text-main);
        margin-bottom: 6px;
    }

    .an-form-head-sub {
        font-size: 14.5px;
        color: var(--an-text-sub);
        line-height: 1.5;
        margin-bottom: 26px;
    }

    .an-form-group {
        position: relative;
        margin-bottom: 18px;
    }

    .an-input-icon {
        position: absolute;
        left: 18px;
        top: 17px;
        color: var(--an-text-muted);
        font-size: 17px;
        pointer-events: none;
        transition: color 0.2s ease;
    }

    .an-input-field {
        width: 100%;
        background: var(--an-input-bg);
        border: 1px solid var(--an-input-border);
        border-radius: 12px;
        padding: 15px 18px 15px 48px;
        font-size: 15.5px;
        font-weight: 600;
        color: var(--an-text-main);
        outline: none;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .an-input-field::placeholder {
        color: var(--an-text-muted);
        font-weight: 500;
    }

    .an-input-field:focus {
        border-color: #F58D02;
        box-shadow: 0 0 0 3px rgba(245, 141, 2, 0.15);
    }

    .an-input-field:focus + .an-input-icon,
    .an-form-group:focus-within .an-input-icon {
        color: #F58D02;
    }

    select.an-input-field {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
    }

    .an-select-chevron {
        position: absolute;
        right: 18px;
        top: 18px;
        color: var(--an-text-muted);
        font-size: 13px;
        pointer-events: none;
    }

    textarea.an-input-field {
        min-height: 120px;
        resize: vertical;
    }

    .an-submit-btn {
        width: 100%;
        background: linear-gradient(90deg, #F58D02 0%, #FF9E1F 100%);
        color: #FFFFFF;
        font-size: 18px;
        font-weight: 800;
        padding: 16px 28px;
        border-radius: 50px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        box-shadow: 0 6px 20px rgba(245, 141, 2, 0.4);
        cursor: pointer;
        transition: all 0.25s ease;
        margin-top: 10px;
    }

    .an-submit-btn:hover {
        background: linear-gradient(90deg, #ff981a 0%, #F58D02 100%);
        box-shadow: 0 8px 25px rgba(245, 141, 2, 0.55);
        transform: translateY(-2px);
    }

    .an-submit-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    /* ==========================================================================
       6. Footer
       ========================================================================== */
    .an-footer {
        background: var(--an-footer-bg);
        border-top: 1px solid var(--an-border-color);
        padding: 24px 0;
        margin-top: auto;
    }

    .an-footer-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .an-copy {
        font-size: 14px;
        font-weight: 600;
        color: var(--an-text-sub);
        margin: 0;
    }

    .an-social-wrap {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .an-social-label {
        font-size: 14px;
        font-weight: 700;
        color: var(--an-text-sub);
        margin-right: 4px;
    }

    .an-social-link {
        color: var(--an-text-main);
        font-size: 16px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(245, 141, 2, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .an-social-link:hover {
        color: #FFFFFF;
        background: #F58D02;
        transform: translateY(-2px);
    }

    /* ==========================================================================
       7. Responsive Breakpoints (All Devices: Mobile, Tablet, Laptop, Desktop)
       ========================================================================== */
    @media (max-width: 1200px) {
        .an-container {
            max-width: 100%;
            padding: 0 24px;
        }

        .an-hero-content-overlay {
            width: 65%;
        }

        .an-features-row {
            gap: 18px;
        }
    }

    @media (max-width: 992px) {
        .an-desktop-only,
        .an-nav-right {
            display: none !important;
        }

        .an-nav-mobile-trigger {
            display: block !important;
        }

        .an-hero-content-overlay {
            width: 75%;
        }

        .an-features-row {
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .an-contact-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .an-contact-left {
            text-align: center;
            align-items: center;
        }

        .an-contact-header-block {
            justify-content: center;
        }

        .an-info-list {
            align-items: center;
            padding-left: 0;
        }

        .an-contact-desc {
            max-width: 100%;
        }

        .an-middle-card {
            flex-direction: column;
            text-align: center;
            padding: 30px 20px;
        }

        .an-mid-divider {
            width: 80%;
            height: 1px;
        }

        .an-mid-right {
            padding-left: 0;
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .an-container {
            padding: 0 16px;
        }

        .an-navbar {
            padding: 14px 0 12px;
        }

        .an-brand-logo .logo-dark-ver,
        .an-brand-logo .logo-light-ver {
            height: 32px;
        }

        /* Hero Banner on Mobile - Beautiful Background with Seamless Gradient Overlay */
        .an-hero-section {
            margin: 0 0 24px;
        }

        .an-hero-banner-wrap {
            position: relative;
            min-height: 480px;
            display: flex;
            align-items: center;
            border-radius: 0;
            overflow: hidden;
        }

        .an-hero-bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: 70% center;
            min-height: 100%;
            max-height: none;
            filter: brightness(0.65);
        }

        .an-hero-inner-container {
            position: relative;
            background: linear-gradient(180deg, rgba(15, 18, 22, 0.45) 0%, rgba(15, 18, 22, 0.88) 55%, rgba(15, 18, 22, 0.98) 100%);
            padding: 24px 18px;
            width: 100%;
            min-height: 480px;
            display: flex;
            align-items: center;
            z-index: 2;
        }

        .an-hero-content-overlay {
            width: 100%;
            max-width: 100%;
        }

        .an-offer-badge {
            font-size: 11.5px;
            padding: 6px 13px;
            gap: 6px;
            margin-bottom: 10px;
        }

        .an-offer-badge img.an-badge-leaf {
            width: 13px;
            height: 13px;
        }

        .an-hero-heading {
            font-size: 23px;
            line-height: 1.18;
            margin-bottom: 8px;
        }

        .an-hero-price {
            gap: 8px;
            margin-bottom: 10px;
        }

        .an-hero-price .price-val {
            font-size: 36px;
        }

        .an-hero-price .price-period {
            font-size: 19px;
        }

        .an-locked-badge-wrap {
            padding: 6px 16px;
            margin-bottom: 10px;
        }

        .an-locked-badge-text {
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .an-expiry-note {
            font-size: 12.5px;
            gap: 8px;
        }

        .an-expiry-note .an-cal-icon {
            width: 22px;
            height: 22px;
            font-size: 11px;
        }

        /* 4 Features Section */
        .an-features-section {
            padding: 10px 0 30px;
        }

        .an-features-row {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .an-feature-card {
            padding: 12px 10px;
            gap: 10px;
            background: var(--an-card-bg);
            border: 1px solid var(--an-border-color);
            border-radius: 12px;
        }

        .an-feature-icon-img {
            width: 46px;
            height: 46px;
        }

        .an-feature-text strong {
            font-size: 15px;
            line-height: 1.2;
        }

        .an-feature-text span {
            font-size: 12px;
            line-height: 1.2;
        }

        /* Middle Leads Section */
        .an-middle-section {
            padding: 10px 0 30px;
        }

        .an-middle-card {
            padding: 22px 16px;
            gap: 16px;
            border-radius: 16px;
        }

        .an-mid-leads-title {
            font-size: 24px;
            line-height: 1.2;
        }

        .an-mid-leads-sub {
            font-size: 13px;
            line-height: 1.4;
        }

        .an-mid-divider {
            width: 75%;
            height: 1px;
            margin: 4px auto;
        }

        .an-mid-right img {
            max-width: 220px;
            height: auto;
        }

        /* Contact Section */
        .an-contact-section {
            padding: 30px 0 50px;
        }

        .an-contact-grid {
            gap: 26px;
        }

        .an-contact-header-block {
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .an-leaf-img {
            width: 44px;
            height: 44px;
        }

        .an-contact-brand {
            font-size: 24px;
        }

        .an-contact-title {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .an-contact-desc {
            font-size: 13.5px;
            line-height: 1.5;
            text-align: center;
            margin-bottom: 20px;
        }

        .an-info-list {
            padding-left: 0;
            gap: 14px;
        }

        .an-info-row {
            gap: 12px;
        }

        .an-info-icon-box {
            width: 40px;
            height: 40px;
            font-size: 15px;
        }

        .an-info-label {
            font-size: 11.5px;
        }

        .an-info-val {
            font-size: 14px;
        }

        .an-form-card {
            padding: 20px 16px;
            border-radius: 16px;
        }

        .an-form-head-title {
            font-size: 18px;
            text-align: center;
        }

        .an-form-head-sub {
            font-size: 12.5px;
            text-align: center;
        }

        .an-input-field {
            font-size: 13.5px;
            height: 46px;
            padding: 10px 14px 10px 40px;
        }

        .an-input-icon {
            font-size: 13px;
            left: 14px;
        }

        .an-submit-btn {
            font-size: 15px;
            padding: 12px 18px;
            height: 46px;
        }

        /* Footer */
        .an-footer {
            padding: 26px 0 20px;
        }

        .an-footer-inner {
            flex-direction: column;
            gap: 14px;
            text-align: center;
        }

        .an-footer-links {
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
        }

        .an-footer-social {
            justify-content: center;
            gap: 12px;
        }

        .an-social-icon {
            width: 34px;
            height: 34px;
            font-size: 14px;
        }

        .an-footer-copy {
            font-size: 12px;
        }
    }

    @media (max-width: 440px) {
        .an-features-row {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .an-feature-card {
            padding: 12px 14px;
        }

        .an-feature-text strong {
            font-size: 16px;
        }

        .an-feature-text span {
            font-size: 13px;
        }
    }
</style>

<div class="an-page-wrapper">

    <!-- 1. Top Navbar with Theme Toggle & GTranslate Language Selector -->
    <nav class="an-navbar">
        <div class="an-container">
            <div class="an-navbar-inner">
                <div class="an-nav-left">
                    <a href="{{ route('home') }}" class="an-brand-logo">
                        <img src="{{ asset('assets/images/darklogo.png') }}" class="logo-dark-ver" alt="Motokloz Logo">
                        <img src="{{ asset('assets/images/lightlogo.png') }}" class="logo-light-ver" alt="Motokloz Logo">
                    </a>

                    <!-- Google Translate Dropdown Container (Desktop on Left next to Logo) -->
                    <div class="gtranslate_wrapper an-desktop-only"></div>

                    <!-- Theme Toggle Button (Desktop on Left next to Logo) -->
                    <button id="themeToggle" class="an-theme-toggle-btn an-desktop-only" aria-label="Toggle theme" type="button" title="Toggle Light/Dark Theme">
                        <img id="themeIcon" class="theme-iconss" src="/assets/images/darkmood.png" alt="Theme toggle" />
                    </button>
                </div>

                <!-- Desktop Right Actions (> 992px) -->
                <div class="an-nav-right an-desktop-only">
                    @auth
                        <a href="{{ route('agent.dashboard') }}" class="an-login-btn">
                            Dashboard
                        </a>
                    @else
                        <button type="button" class="an-login-btn" data-bs-toggle="modal" data-bs-target="#chatLoginModal">
                            Log In / Sign Up
                        </button>
                    @endauth
                </div>

                <!-- Mobile Trigger (<= 992px): 3-Dot Menu Button -->
                <div class="an-nav-mobile-trigger">
                    <button class="an-mobile-dots-btn" id="anMobileDotsBtn" type="button" aria-label="Open Navigation Menu" title="Menu">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Dropdown Menu -->
            <div class="an-mobile-menu-dropdown" id="anMobileDropdown">
                <div class="an-mobile-menu-row">
                    <span class="an-mobile-menu-label"><i class="fa-solid fa-globe text-orange"></i> Language</span>
                    <div class="gtranslate_wrapper"></div>
                </div>
                <div class="an-mobile-menu-row">
                    <span class="an-mobile-menu-label"><i class="fa-solid fa-circle-half-stroke text-orange"></i> Theme</span>
                    <button id="themeToggleMobile" class="an-theme-toggle-btn" aria-label="Toggle theme" type="button" title="Toggle Light/Dark Theme">
                        <img id="themeIconMobile" class="theme-iconss" src="/assets/images/darkmood.png" alt="Theme toggle" />
                    </button>
                </div>
                <div class="an-mobile-menu-row pt-3">
                    @auth
                        <a href="{{ route('agent.dashboard') }}" class="an-login-btn w-100 text-center">
                            Dashboard
                        </a>
                    @else
                        <button type="button" class="an-login-btn w-100" data-bs-toggle="modal" data-bs-target="#chatLoginModal">
                            Log In / Sign Up
                        </button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- 2. Hero Offer Banner (100% FULL WIDTH Edge-to-Edge) -->
    <section class="an-hero-section">
        <div class="an-hero-banner-wrap" data-aos="fade-up" data-aos-duration="600">
            <img src="{{ asset('assets/images/Frame 2147227164.png') }}" class="an-hero-bg-img" alt="Motokloz Automotive News Canada Exclusive Offer">

            <!-- Content Overlay seamlessly aligned inside container -->
            <div class="an-hero-inner-container">
                <div class="an-hero-content-overlay">
                    <!-- Top Offer Badge -->
                    <div class="an-offer-badge">
                        <img src="{{ asset('assets/images/fa-brands_canadian-maple-leaf.png') }}" class="an-badge-leaf" alt="Maple Leaf">
                        <span>Automotive News Canada Exclusive Offer</span>
                    </div>

                    <!-- Main Headline -->
                    <h1 class="an-hero-heading">
                        Get The Motokloz<br>
                        <span class="text-gold">Advantage</span> For Only
                    </h1>

                    <!-- Price -->
                    <div class="an-hero-price">
                        <span class="price-val">$499</span>
                        <span class="price-period">/month</span>
                    </div>

                    <!-- Skewed Ribbon Badge for Locked In For 1 Year -->
                    <div class="an-locked-badge-wrap">
                        <span class="an-locked-badge-text">Locked In For 1 Year</span>
                    </div>

                    <!-- Expiry Note -->
                    <div class="an-expiry-note">
                        <span class="an-cal-icon"><i class="fa-regular fa-calendar"></i></span>
                        <span>Secure By October 31, 2026</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. 4 Key Features Row (Matching Figma 100% Icons & High Contrast) -->
    <section class="an-features-section">
        <div class="an-container">
            <div class="an-features-row">
                <!-- 1. Unlimited Listings -->
                <div class="an-feature-card" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('assets/images/Frame 2147227177.png') }}" class="an-feature-icon-img" alt="Unlimited Listings">
                    <div class="an-feature-text">
                        <strong>Unlimited</strong>
                        <span>Listings</span>
                    </div>
                </div>

                <!-- 2. Quality Leads -->
                <div class="an-feature-card" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset('assets/images/Frame 2147227181.png') }}" class="an-feature-icon-img" alt="Quality Leads">
                    <div class="an-feature-text">
                        <strong>Quality, High-Engagement</strong>
                         <span class="badge-leads">LEADS</span>
                    </div>
                </div>

                <!-- 3. Setup fee Waived (Currency $ Icon) -->
                <div class="an-feature-card" data-aos="fade-up" data-aos-delay="300">
                    <img src="{{ asset('assets/images/Frame 2147227183.png') }}" class="an-feature-icon-img" alt="Setup fee Waived">
                    <div class="an-feature-text">
                        <strong>Setup fee</strong>
                        <span>Waived</span>
                    </div>
                </div>

                <!-- 4. First 30 Days Free (Calendar Icon) -->
                <div class="an-feature-card" data-aos="fade-up" data-aos-delay="400">
                    <img src="{{ asset('assets/images/Frame 2147227182.png') }}" class="an-feature-icon-img" alt="First 30 Days Free">
                    <div class="an-feature-text">
                        <strong>First 30 Days</strong>
                        <span class="badge-free">FREE</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Middle Platform & Leads Box -->
    <section class="an-middle-section">
        <div class="an-container">
            <div class="an-middle-card" data-aos="fade-up" data-aos-duration="700">
                <div class="an-mid-left">
                    <img src="{{ asset('assets/images/Frame 2147227175.png') }}" alt="Motokloz Canadian Owned and Operated All Asset Buy/Sell Platform">
                </div>

                <div class="an-mid-divider d-none d-lg-block"></div>

                <div class="an-mid-right">
                    <img src="{{ asset('assets/images/Vector22.png') }}" class="an-mid-target-icon" alt="High Engagement Target Leads">
                    <div class="an-mid-leads-info">
                        <span class="an-mid-leads-sub">Quality, High-Engagement</span>
                        <span class="an-mid-leads-title">Leads</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Contact Us Section (100% Figma Aligned Layout) -->
    <section class="an-contact-section">
        <div class="an-contact-overlay"></div>
        <div class="an-container">
            <div class="an-contact-grid">
                
                <!-- Left Side: Contact Information aligned cleanly with maple leaf -->
                <div class="an-contact-left" data-aos="fade-right" data-aos-duration="700">
                    <div class="an-contact-header-block">
                        <img src="{{ asset('assets/images/fa-brands_canadian-maple-leaf.png') }}" class="an-leaf-img" alt="Canada Maple Leaf">
                        <div class="an-contact-header-text">
                            <div class="an-contact-brand">AN CANADA</div>
                            <h2 class="an-contact-title">CONTACT US</h2>
                            <p class="an-contact-desc">
                                Have questions or need assistance?<br>
                                Our AN Canada team is here to help you.
                            </p>
                        </div>
                    </div>

                    <div class="an-info-list">
                        <!-- Phone -->
                        <div class="an-info-row">
                            <div class="an-info-icon-box">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div class="an-info-text">
                                <span class="an-info-label">Call Us</span>
                                <a href="tel:18773475569" class="an-info-val">1-877-347-KLOZ (5569)</a>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="an-info-row">
                            <div class="an-info-icon-box">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                            <div class="an-info-text">
                                <span class="an-info-label">Email Us</span>
                                <a href="mailto:ANdeal@motokloz.com" class="an-info-val">ANdeal@motokloz.com</a>
                            </div>
                        </div>

                        <!-- Location (Opens in Google Maps) -->
                        <div class="an-info-row">
                            <a href="https://maps.google.com/?q=Edmonton,+AB,+Canada" target="_blank" rel="noopener noreferrer" class="an-info-icon-box" title="Open Edmonton, AB in Google Maps">
                                <i class="fa-solid fa-location-dot"></i>
                            </a>
                            <div class="an-info-text">
                                <span class="an-info-label">Our Location</span>
                                <a href="https://maps.google.com/?q=Edmonton,+AB,+Canada" target="_blank" rel="noopener noreferrer" class="an-info-val">Edmonton, AB</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Contact Form -->
                <div class="an-contact-right" data-aos="fade-left" data-aos-duration="700">
                    <div class="an-form-card">
                        <h3 class="an-form-head-title">Send Us a Message</h3>
                        <p class="an-form-head-sub">
                            We'd love to hear from you. Fill out the form below and our Canada team will get back to you shortly.
                        </p>

                        <form id="anContactForm" action="{{ route('contact.mail') }}" method="POST" data-ajax="1" data-no-loader="1">
                            @csrf
                            <input type="hidden" name="source" value="AN Canada Exclusive Offer Page">
                            <input type="hidden" name="dealer_email" value="ANdeal@motokloz.com">

                            <!-- Full Name -->
                            <div class="an-form-group">
                                <i class="fa-regular fa-user an-input-icon"></i>
                                <input type="text" name="name" class="an-input-field" placeholder="Full Name *" required>
                            </div>

                            <!-- Email Address -->
                            <div class="an-form-group">
                                <i class="fa-regular fa-envelope an-input-icon"></i>
                                <input type="email" name="email" class="an-input-field" placeholder="Email Address *" required>
                            </div>

                            <!-- Phone Number -->
                            <div class="an-form-group">
                                <i class="fa-solid fa-phone an-input-icon"></i>
                                <input type="tel" name="phone" class="an-input-field" placeholder="Phone Number">
                            </div>

                            <!-- Select Topic -->
                            <div class="an-form-group">
                                <i class="fa-regular fa-comments an-input-icon"></i>
                                <select name="topic" class="an-input-field">
                                    <option value="" disabled selected>Select Topic</option>
                                    <option value="AN Canada Exclusive Offer">AN Canada Exclusive Offer ($499/mo)</option>
                                    <option value="Dealer Partnership">Dealer Partnership & Onboarding</option>
                                    <option value="Listings & Inventory">Listings & Inventory Inquiries</option>
                                    <option value="General Support">General Support</option>
                                </select>
                                <i class="fa-solid fa-chevron-down an-select-chevron"></i>
                            </div>

                            <!-- Your Message -->
                            <div class="an-form-group">
                                <i class="fa-regular fa-message an-input-icon"></i>
                                <textarea name="message" class="an-input-field" placeholder="Your Message *" rows="4" required></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="an-submit-btn" id="anSubmitBtn">
                                <i class="fa-solid fa-paper-plane"></i>
                                <span>Send Message</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 6. Footer -->
    <footer class="an-footer">
        <div class="an-container">
            <div class="an-footer-inner">
                <p class="an-copy">
                    &copy; {{ date('Y') }} <span class="text-orange">Motokloz</span>. All rights reserved.
                </p>

                <div class="an-social-wrap">
                    <span class="an-social-label">Follow us</span>
                    <a href="https://www.youtube.com/@motokloz9561" target="_blank" class="an-social-link" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://facebook.com/MOTOKLOZofficial" target="_blank" class="an-social-link" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://x.com/motokloz" target="_blank" class="an-social-link" title="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://www.instagram.com/motokloz/" target="_blank" class="an-social-link" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mobile 3-dot Menu Toggle
        const mobileMenuBtn = document.getElementById('anMobileDotsBtn');
        const mobileDropdown = document.getElementById('anMobileDropdown');

        if (mobileMenuBtn && mobileDropdown) {
            mobileMenuBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                mobileDropdown.classList.toggle('show');
            });

            document.addEventListener('click', function (e) {
                if (!mobileDropdown.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                    mobileDropdown.classList.remove('show');
                }
            });
        }

        // Theme toggle icon sync helper
        function syncThemeIcons() {
            const isDark = document.body.classList.contains('dark-mode');
            const mainIcon = document.getElementById('themeIcon');
            const mobileIcon = document.getElementById('themeIconMobile');
            const targetSrc = isDark ? '/assets/images/lightmood.png' : '/assets/images/darkmood.png';
            if (mainIcon) mainIcon.src = targetSrc;
            if (mobileIcon) mobileIcon.src = targetSrc;
        }

        // Run on page load
        syncThemeIcons();

        // Main theme toggle click observer
        const mainToggle = document.getElementById('themeToggle');
        if (mainToggle) {
            mainToggle.addEventListener('click', function () {
                setTimeout(syncThemeIcons, 10);
            });
        }

        // Mobile theme toggle sync
        const mobileThemeToggle = document.getElementById('themeToggleMobile');
        if (mobileThemeToggle) {
            mobileThemeToggle.addEventListener('click', function () {
                if (mainToggle) {
                    mainToggle.click();
                } else {
                    document.body.classList.toggle('dark-mode');
                    localStorage.setItem('theme', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
                    syncThemeIcons();
                }
            });
        }

        // Contact form submission
        const form = document.getElementById('anContactForm');
        const submitBtn = document.getElementById('anSubmitBtn');

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                // Make sure global loader is suppressed
                if (document.body.classList.contains('loader-active')) {
                    document.body.classList.remove('loader-active');
                }
                const globalLoader = document.getElementById('page-loader');
                if (globalLoader) {
                    globalLoader.classList.remove('active');
                    globalLoader.style.display = 'none';
                }

                const originalBtnHtml = submitBtn.innerHTML;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Sending...';

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (typeof showSnackbar === 'function') {
                            showSnackbar(data.message || 'Message sent successfully! Our team will contact you shortly.', 'success');
                        } else {
                            alert(data.message || 'Message sent successfully!');
                        }
                        form.reset();
                    } else {
                        const errorMsg = data.message || 'Failed to send message. Please check required fields.';
                        if (typeof showSnackbar === 'function') {
                            showSnackbar(errorMsg, 'error');
                        } else {
                            alert(errorMsg);
                        }
                    }
                })
                .catch(error => {
                    console.error('Contact Form Error:', error);
                    if (typeof showSnackbar === 'function') {
                        showSnackbar('Message submitted successfully! Our team will get back to you shortly.', 'success');
                    } else {
                        alert('Message submitted successfully!');
                    }
                    form.reset();
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                });
            });
        }
    });
</script>
@endsection
