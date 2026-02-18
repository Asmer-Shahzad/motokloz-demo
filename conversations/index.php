<!DOCTYPE html>
<html>

<head>
   <title>Conversations</title>
    <?php require_once(__DIR__ . '/../include/header-script.php'); ?>


</head>

<body>

    <?php require_once(__DIR__ . '/../include/header.php'); ?>

    <div class="top-back">
        <a href="#" class="dashboard-back">
            <span class="back-icon">
                <img src="<?php echo $prefix; ?>/assets/images/Carento (5).png" alt="Back">
            </span>
            <span class="back-text">Go back to dashboard</span>
        </a>
    </div>





    <section class="main-chat">
        <div class="chat-wrapper">

            <!-- ========== LEFT SIDEBAR ========== -->
            <div class="chat-sidebar">
                <div class="sidebar-header">
                    <h3 class="sidebar-head">Conversations</h3>
                    <div class="sidebar-icons">
                        <!-- Search icons - both trigger search bar -->



                    </div>
                </div>

                <!-- Search Bar (hidden by default) -->
                <div class="search-bar-container" style="display: none; padding: 10px 20px;">
                    <div style="position: relative;">
                        <input type="text" class="search-input" placeholder="Search conversations..."
                            style="width: 100%; padding: 10px 40px 10px 16px; border-radius: 30px; border: 1px solid #E6EBF5; background: #F5F7FA; font-size: 15px;">
                        <span class="search-close"
                            style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 18px; color: #7D8592;">&times;</span>
                    </div>
                </div>

                <!-- Chat list with scroll -->
                <div class="chat-list scrol-bar">
                    <!-- ===== REQUESTED MESSAGES (COLLAPSIBLE) ===== -->
                    <div class="section-header" onclick="toggleSection('requestedSection')">
                        <span class="section-heading" style="cursor: pointer;">˅ { Vichele Type } Messages</span>
                    </div>
                    <div id="requestedSection" class="section-content">
                        <div class="chat-item request-item">
                            <img src="https://i.pravatar.cc/40?img=5" alt="">
                            <div>
                                <h6 class="chat-heading">Garrett Watson</h6>
                                <p class="chat-paragraph">Hi! Please, change the statu…</p>
                            </div>
                            <span class="chat-time">12:04</span>
                        </div>
                        <div class="chat-item request-item">
                            <img src="https://i.pravatar.cc/40?img=6" alt="">
                            <div>
                                <h6 class="chat-heading">Caroline Santos</h6>
                                <p class="chat-paragraph">Hi! Please, change the statu…</p>
                            </div>
                            <span class="chat-time">12:04</span>
                        </div>
                    </div>

                    <!-- ===== MESSAGES (COLLAPSIBLE) ===== -->
                    <div class="section-header" onclick="toggleSection('messagesSection')">
                        <span class="section-heading" style="cursor: pointer;">˅ Messages</span>
                    </div>
                    <div id="messagesSection" class="section-content">
                        <div class="chat-item">
                            <img src="https://i.pravatar.cc/40?img=1" alt="">
                            <div>
                                <h6 class="chat-heading">Garrett Watson</h6>
                                <p class="chat-paragraph">Hi! Please, change the statu…</p>
                            </div>
                            <span class="chat-time">12:04</span>
                        </div>
                        <div class="chat-item">
                            <img src="https://i.pravatar.cc/40?img=2" alt="">
                            <div>
                                <h6 class="chat-heading">Caroline Santos</h6>
                                <p class="chat-paragraph">Hi Please, change the status...</p>
                            </div>
                            <span class="chat-time">12:04</span>
                        </div>
                        <div class="chat-item">
                            <img src="https://i.pravatar.cc/40?img=3" alt="">
                            <div>
                                <h6 class="chat-heading">Leon Nunez</h6>
                                <p class="chat-paragraph">Hi Please, change the status...</p>
                            </div>
                            <span class="chat-time">12:04</span>
                        </div>
                        <div class="chat-item active">
                            <img src="https://i.pravatar.cc/40?img=4" alt="">
                            <div>
                                <h6 class="chat-heading">Oscar Holloway</h6>
                                <p class="chat-paragraph">Hi Please, change the status in...</p>
                            </div>
                            <span class="chat-time">12:04</span>
                        </div>
                        <div class="chat-item">
                            <img src="https://i.pravatar.cc/40?img=7" alt="">
                            <div>
                                <h6 class="chat-heading">Ralph Harris</h6>
                                <p class="chat-paragraph">Hi Please, change the statu…</p>
                            </div>
                            <span class="chat-time">12:04</span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- ========== RIGHT CHAT AREA ========== -->
            <div class="chat-content">
                <div class="chat-topbar">
                    <div style="display: flex; align-items: center;">

                        <div class="chat-user">
                            <img class="chat-user-img" src="https://i.pravatar.cc/40?img=4" alt="">
                            <div>
                                <h6 class="chat-user-heading">Oscar Holloway</h6>
                                <small class="chat-user-category">UI/UX Designer</small>
                            </div>
                        </div>
                    </div>
                    <div class="chat-actions">
                        <a href="#"><img src="<?php echo $prefix; ?>/assets/images/icon (7).png" alt=""></a>
                        <a href="#"><img src="<?php echo $prefix; ?>/assets/images/icon (8).png" alt=""></a>
                        <a href="#"><img src="<?php echo $prefix; ?>/assets/images/icon (9).png" mages/icon (9).png" alt=""></a>
                    </div>
                </div>

                <div class="chat-messages scrol-bar">
                    <!-- Request Box -->
                    <div class="chat-request">
                        <small>Friday, September 8</small>
                        <h6>Oscar Holloway wants to chat with you</h6>
                        <div class="request-buttons">
                            <a href="#" class="btn-decline">Decline</a>
                            <a href="#" class="btn-accept">Accept</a>
                        </div>
                    </div>

                    <!-- ===== MESSAGES AREA - INSTAGRAM STYLE ===== -->
                    <div class="messages-body">
                        <!-- Received message (other person) - LEFT -->
                        <div class="message received">
                            <img src="https://i.pravatar.cc/40?img=4" class="msg-avatar" alt="">
                            <div class="msg-content">
                                <div class="msg-header">
                                    <span class="msg-name">Oscar Holloway</span>
                                    <span class="msg-time">12:10 AM</span>
                                </div>
                                <div class="msg-text">
                                    Hi, Oscar! Nice to meet you
                                    We will work with new prject together
                                </div>
                            </div>
                        </div>

                        <!-- Sent message (You) - RIGHT -->
                        <!-- <div class="message sent">
                            <div class="msg-content">
                                <div class="msg-header">

                                    <span class="msg-time">12:15 AM</span>
                                </div>
                                <div class="msg-text">
                                    Hi, Oscar! Nice to meet you<br>
                                    We will work with new project together
                                </div>
                            </div>
                        </div> -->

                        <!-- Another received message
                        <div class="message received">
                            <img src="https://i.pravatar.cc/40?img=4" class="msg-avatar" alt="">
                            <div class="msg-content">
                                <div class="msg-header">
                                    <span class="msg-name">Oscar Holloway</span>
                                    <span class="msg-time">12:18 AM</span>
                                </div>
                                <div class="msg-text">
                                    Great! I'll share the wireframes soon.
                                </div>
                            </div>
                        </div> -->

                        <!-- Another sent message -->
                        <!-- <div class="message sent">
                            <div class="msg-content">
                                <div class="msg-header">

                                    <span class="msg-time">12:22 AM</span>
                                </div>
                                <div class="msg-text">
                                    Perfect, looking forward to it!
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="chat-input">
                    <a href="#"><img src="<?php echo $prefix; ?>/assets/images/mention.png" alt=""></a>
                    <input class="text-input" type="text" placeholder="Type your message here...">
                    <a href="#"><img src="<?php echo $prefix; ?>/assets/images/emoji.png" alt=""></a>
                    <a href="#"><img src="<?php echo $prefix; ?>/assets/images/chatsubmite.png" alt=""></a>

                </div>
            </div>
        </div>
    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap');


        /* width */
        .scrol-bar::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        .scrol-bar::-webkit-scrollbar-track {
            background: transparent;
        }

        /* Handle */
        .scrol-bar::-webkit-scrollbar-thumb {
            background: #F58D02;
        }

        /* Handle on hover */
        .scrol-bar::-webkit-scrollbar-thumb:hover {
            background: #8c6838;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Nunito Sans", sans-serif !important;
            background: #EFF6FC;
        }

        input:focus {
            box-shadow: none !important;
            outline: none;
        }

        h6.chat-heading:hover {
            color: black !important;
        }



        /* ---------- VIP BACK BUTTON (Mobile only, inside chat) ---------- */
        .vip-back-btn {
            display: none;
            /* Hidden on desktop */
            align-items: center;
            gap: 8px;
            background: linear-gradient(145deg, #ffffff, #f2f5fc);
            border: 1px solid rgba(63, 140, 255, 0.2);
            border-radius: 40px;
            padding: 10px 20px 10px 16px;
            margin-right: 12px;
            font-size: 16px;
            font-weight: 700;
            color: #0A1629;
            box-shadow: 0 6px 14px rgba(0, 20, 50, 0.08);
            cursor: pointer;
            transition: all 0.25s ease;
            letter-spacing: 0.3px;
            backdrop-filter: blur(2px);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .vip-back-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0));
            pointer-events: none;
        }

        .vip-back-btn:hover {
            background: linear-gradient(145deg, #ffffff, #e9eff9);
            box-shadow: 0 10px 18px rgba(63, 140, 255, 0.15);
            transform: scale(1.02);
        }

        .vip-back-btn:active {
            transform: scale(0.98);
        }

        .back-arrow {
            font-size: 22px;
            line-height: 1;
            color: #3F8CFF;
            font-weight: 600;
        }

        /* ---------- MAIN CHAT LAYOUT ---------- */
        .main-chat {
            background: var(--bg-color);
            height: 100vh;
            padding: 20px;
            position: relative;

        }

        .chat-wrapper {
            background: #fff;
            height: 100%;
            border-radius: 14px;
            display: flex;
            overflow: hidden;
            border: 1px solid #DADEE2;
        }

        /* ---------- SIDEBAR ---------- */
        .chat-sidebar {
            width: 30%;
            border-right: 1px solid #E6EBF5;
            display: flex;
            flex-direction: column;
            background: var(--bg-color);
        }

        .sidebar-header {
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #E6EBF5;
        }

        h3.sidebar-head {
            font-size: 40px;
            font-weight: 800;
            color: var(--select-color);
            margin: 0;
        }

        .sidebar-icons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .sidebar-icons img {
            object-fit: contain;
            cursor: pointer;
        }

        /* ----- Search Bar ----- */
        .search-bar-container {
            border-bottom: 1px solid #E6EBF5;
            background: #fff;
        }

        .search-input {
            width: 100%;
            padding: 10px 40px 10px 16px;
            border-radius: 30px;
            border: 1px solid #E6EBF5;
            background: #F5F7FA;
            font-size: 15px;
            transition: 0.2s;
        }

        .search-input:focus {
            border-color: #3F8CFF;
            background: #fff;
        }

        .search-close {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px;
            color: #7D8592;
            line-height: 1;
        }

        .search-close:hover {
            color: #0A1629;
        }

        /* ----- Chat List (Scrollable) ----- */
        .chat-list {
            flex: 1;
            overflow-y: auto;
            padding: 20px 15px;
            /* scrollbar-width: thin;
        scrollbar-color: #C1C7D0 #F5F7FA; */
        }



        .scrol-bar::-webkit-scrollbar-thumb {

            border-radius: 10px;
        }

        /* ----- Section Headers (Collapsible) ----- */
        .section-header {
            padding: 12px 16px 8px;
            cursor: pointer;
            user-select: none;
        }

        .section-heading {
            font-size: 15px;
            font-weight: 700;
            color: #F58D02;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .section-content {
            transition: all 0.2s ease;
        }

        .section-content.collapsed {
            display: none;
        }

        /* ----- Chat Items ----- */
        .chat-item {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            gap: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-bottom: 4px;
            border-radius: 16px;
        }

        .chat-item img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .chat-item .chat-heading {
            margin: 0 0 4px 0;
            font-size: 18px;
            font-weight: 700;
            color: var(--select-color);
            line-height: 1.3;
            transition: .3s ease;
        }

        .chat-item .chat-paragraph {
            margin: 0;
            font-size: 16px;
            color: #91929E;
            font-weight: 400;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .chat-item .chat-time {
            margin-left: auto;
            font-size: 15px;
            color: #7D8592;
            font-weight: 600;
            /* white-space: nowrap; */
        }

        .chat-item:hover {
            background: #FFE1B9;
        }

        .chat-item.active {
            background: #FFE1B9;
        }

        .chat-item.active .chat-heading {
            color: black;
        }

        .chat-item:hover .chat-heading {
            color: black;
        }

        /* ---------- RIGHT CONTENT ---------- */
        .chat-content {
            width: 70%;
            display: flex;
            flex-direction: column;
            background: var(--bg-color);
        }

        .chat-topbar {
            padding: 18px 25px;
            border-bottom: 1px solid #E6EBF5;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-user {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .chat-user .chat-user-img {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .chat-user-heading {
            font-size: 19px;
            font-weight: 700;
            color: var(--select-color);
            margin: 0 0 4px 0;
            line-height: 1.2;
        }

        .chat-user-category {
            font-size: 16px;
            font-weight: 400;
            color: #91929E;
        }

        .chat-actions {
            display: flex;
            gap: 18px;
        }

        .chat-actions img {
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .chat-actions img:hover {
            opacity: 1;
        }

        /* ----- Messages Area ----- */
        .chat-messages {
            flex: 1;
            padding: 25px;
            overflow-y: auto;
            background: var(--bg-color);
            display: flex;
            flex-direction: column;
        }





        .messages-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        /* ---------- REQUEST BOX ---------- */
        .chat-request {
            max-width: 440px;
            margin: 0 auto 30px;
            padding: 24px;
            text-align: center;
            background: #fff;
            border-radius: 24px;
            border: 1px solid #E6EBF5;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        .chat-request small {
            color: #7D8592;
            font-size: 16px;
            font-weight: 700;
            display: block;
            margin-bottom: 8px;
        }

        .chat-request h6 {
            margin: 0 0 20px 0;
            font-size: 20px;
            font-weight: 800;
            color: #0A1629;
            line-height: 1.4;
        }

        .request-buttons {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn-decline,
        .btn-accept {
            display: inline-block;
            padding: 10px 42px;
            border-radius: 60px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
            text-align: center;
        }

        .btn-decline {
            background: #fff;
            border: 1.5px solid #E6EBF5;
            color: #030303;
        }

        .btn-decline:hover {
            background: #F5F5F5;
        }

        .btn-accept {
            background: #F58D02;
            border: none;
            color: #fff;
        }

        .btn-accept:hover {
            background: #1a1a1a;
        }

        /* ===== INSTAGRAM-STYLE MESSAGES ===== */
        .message {
            display: flex;
            margin-bottom: 24px;
            max-width: 70%;
            clear: both;
        }

        /* Received (other person) - LEFT */
        .message.received {
            align-self: flex-start;
            flex-direction: row;
            gap: 12px;
        }

        .message.received .msg-content {


            color: var(--select-color);
        }

        /* Sent (You) - RIGHT */
        .message.sent {
            align-self: flex-end;
            flex-direction: row-reverse;
            gap: 8px;
        }

        .message.sent .msg-content {
            background: #3F8CFF;
            padding: 12px 16px;
            border-radius: 20px 20px 4px 20px;
            color: white;
        }

        .message.sent .msg-name,
        .message.sent .msg-time,
        .message.sent .msg-text {
            color: white;
        }

        .message.sent .msg-time {
            color: rgba(255, 255, 255, 0.8);
        }

        /* ===== TOP BACK TO DASHBOARD ===== */
        .top-back {
            padding: 20px 0 10px 20px;
            background: var(--bg-color);
            color: var(--select-color);
        }

        h6.chat-heading:hover .dashboard-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-weight: 500;
        }

        .back-icon img {
            width: 15px;
            height: 15px;
            object-fit: contain;
        }

        .dashboard-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 17px;
            font-weight: 700;
            line-height: 24px;
            color: var(--select-color);
            transition: 0.2s ease;
        }

        .dashboard-back .back-icon {
            font-size: 18px;
            line-height: 1;
        }

        .dashboard-back:hover {
            color: #F58D02;
        }

        .msg-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            align-self: flex-end;
        }

        .message.sent .msg-avatar {
            display: none;
            /* No avatar for sent messages (Instagram style) */
        }

        .msg-content {
            display: flex;
            flex-direction: column;
            max-width: 100%;
            word-wrap: break-word;
        }

        .msg-header {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-bottom: 4px;
            flex-wrap: wrap;
        }

        .msg-name {
            font-weight: 700;
            font-size: 18px;
        }

        .msg-time {
            font-size: 12px;
            color: #65676B;
        }

        .msg-text {
            font-size: 18px;
            line-height: 1.5;
            width: 330px;
        }

        /* ----- Chat Input ----- */
        .chat-input {
            margin: 16px 20px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 18px;
            border-radius: 8px;
            border: 1px solid #E6EBF5;
            background: var(--bg-color) !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        }

        /* width */
        .chat-list::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        .chat-list::-webkit-scrollbar-track {
            background: transparent;
        }

        /* Handle */
        .chat-list::-webkit-scrollbar-thumb {
            background-color: #F58D02;
            border-radius: 6px;
        }

        /* Handle on hover */
        .chat-list::-webkit-scrollbar-thumb:hover {
            background-color: #8c6838;
        }


        .text-input {
            flex: 1;
            border: none;
            outline: none;
            padding: 8px 0;
            font-size: 16px;
            box-shadow: none;
            background: transparent !important;
            color: var(--select-color);
        }

        .text-input::placeholder {
            color: var(--select-color);
        }

        /* ========== RESPONSIVE BREAKPOINTS ========== */

        /* 1024px and below – Fix layout */
        @media (max-width: 1024px) {
            .main-chat {
                padding: 15px;
            }

            .chat-sidebar {
                width: 35%;
            }

            .chat-content {
                width: 65%;
            }

            .chat-item {
                padding: 12px 16px;
                gap: 10px;
            }

            .chat-item img {
                width: 42px;
                height: 42px;
            }

            .chat-item .chat-heading {
                font-size: 17px;
            }

            .chat-item .chat-paragraph {
                font-size: 15px;
            }

            .chat-item .chat-time {
                font-size: 14px;
            }

            .sidebar-header {
                padding: 14px 20px;
            }

            h3.sidebar-head {
                font-size: 20px;
            }

            .chat-topbar {
                padding: 16px 20px;
            }

            .chat-user .chat-user-img {
                width: 46px;
                height: 46px;
            }

            .chat-user-heading {
                font-size: 18px;
            }

            .chat-request {
                max-width: 380px;
                padding: 20px;
            }

            .chat-request h6 {
                font-size: 19px;
            }
        }

        /* Tablet (992px and below) */
        @media (max-width: 992px) {
            .chat-sidebar {
                width: 40%;
            }

            .chat-content {
                width: 60%;
            }

            .chat-item .chat-heading {
                font-size: 16px;
            }

            .chat-item .chat-paragraph {
                font-size: 14px;
            }

            .chat-item .chat-time {
                font-size: 13px;
            }

            .section-heading {
                font-size: 14px;
                padding: 10px 16px 6px;
            }

            .chat-request {
                max-width: 340px;
                padding: 18px;
            }

            .chat-request h6 {
                font-size: 18px;
            }

            .btn-decline,
            .btn-accept {
                padding: 8px 32px;
                font-size: 15px;
            }

            .message {
                max-width: 80%;
            }
        }

        /* Mobile (768px and below) – Instagram toggle + VIP back button visible */
        @media (max-width: 768px) {
            .main-chat {
                padding: 10px;
                height: calc(100vh - 20px);
            }

            .chat-wrapper {
                height: 100%;
            }

            .chat-sidebar,
            .chat-content {
                width: 100% !important;
            }

            body.mobile-mode .chat-content {
                display: none;
            }

            body.mobile-mode .chat-sidebar {
                display: block;
            }

            body.mobile-mode.chat-active .chat-sidebar {
                display: none;
            }

            body.mobile-mode.chat-active .chat-content {
                display: flex;
            }

            /* VIP Back button visible on mobile */
            .vip-back-btn {
                display: inline-flex !important;
            }

            /* Hide feed back button on mobile (replaced by VIP back) */
            .feed-back-btn {
                display: none;
            }

            .chat-topbar {
                padding: 12px;
            }

            .chat-user .chat-user-img {
                width: 40px;
                height: 40px;
            }

            .chat-user-heading {
                font-size: 17px;
            }

            .chat-user-category {
                font-size: 15px;
            }

            .chat-request {
                max-width: 100%;
                padding: 20px 16px;
                margin: 0 0 20px 0;
            }

            .chat-request h6 {
                font-size: 18px;
                margin-bottom: 16px;
            }

            .btn-decline,
            .btn-accept {
                padding: 10px 24px;
                font-size: 15px;
                flex: 1;
                max-width: 160px;
            }

            .chat-item {
                padding: 12px 15px;
            }

            .chat-item img {
                width: 40px;
                height: 40px;
            }

            .chat-item .chat-heading {
                font-size: 17px;
            }

            .chat-item .chat-paragraph {
                font-size: 15px;
            }

            .chat-messages {
                padding: 15px;
            }

            .message {
                max-width: 85%;
            }

            .msg-avatar {
                width: 32px;
                height: 32px;
            }

            .msg-name {
                font-size: 14px;
            }

            .msg-time {
                font-size: 11px;
            }

            .msg-text {
                font-size: 14px;
            }

            .chat-input {
                margin: 8px;
                padding: 10px 16px;
            }
        }

        /* Small phones (480px and below) */
        @media (max-width: 480px) {
            .sidebar-header {
                padding: 12px 16px;
            }

            h3.sidebar-head {
                font-size: 19px;
            }

            .sidebar-icons img {
                width: 22px;
                object-fit: contain;
            }

            .chat-item {
                padding: 10px 14px;
            }

            .chat-item .chat-heading {
                font-size: 16px;
            }

            .chat-item .chat-paragraph {
                font-size: 14px;
            }

            .chat-item .chat-time {
                font-size: 12px;
            }

            .chat-user .chat-user-img {
                width: 36px;
                height: 36px;
            }

            .chat-user-heading {
                font-size: 16px;
            }

            .chat-user-category {
                font-size: 14px;
            }

            .chat-request {
                padding: 16px;
            }

            .chat-request small {
                font-size: 14px;
            }

            .chat-request h6 {
                font-size: 16px;
            }

            .btn-decline,
            .btn-accept {
                padding: 8px 16px;
                font-size: 14px;
                max-width: 130px;
            }

            .message {
                max-width: 90%;
            }

            .vip-back-btn {
                padding: 8px 16px 8px 12px;
                font-size: 14px;
            }

            .back-arrow {
                font-size: 18px;
            }
        }
    </style>



    <style>
        /* ===============================
   GLOBAL FIXES
=================================*/
        html,
        body {
            height: 100%;
        }

        .main-chat {
            height: 100dvh;
            /* mobile safe height */
            padding: 16px;
        }

        .chat-wrapper {
            height: 100%;
        }

        /* Prevent horizontal scroll everywhere */
        * {
            max-width: 100%;
        }

        /* ===============================
   SIDEBAR FIX
=================================*/
        .chat-sidebar {
            min-width: 280px;
        }

        /* ===============================
   MESSAGE AREA IMPROVEMENTS
=================================*/
        .chat-messages {
            padding: 20px;
        }

        .messages-body {
            gap: 6px;
        }

        /* Bubble width fix */
        .message {
            width: fit-content;
            max-width: 75%;
        }

        /* Text wrapping */
        .msg-text {
            word-break: break-word;
        }

        /* Avatar scaling */
        .msg-avatar {
            width: 34px;
            height: 34px;
        }

        /* ===============================
   INPUT BAR FIX
=================================*/
        .chat-input {
            position: sticky;
            bottom: 0;
            background: #fff;
            z-index: 5;
        }

        /* ===============================
   TABLET (<=1024px)
=================================*/
        @media (max-width: 1024px) {

            .chat-sidebar {
                width: 38%;
            }

            .chat-content {
                width: 62%;
            }

            .message {
                max-width: 80%;
            }
        }

        /* ===============================
   MOBILE MAIN MODE (<=768px)
=================================*/
        @media (max-width: 768px) {

            .main-chat {
                padding: 0;
            }

            .chat-wrapper {
                border-radius: 0;
            }

            .chat-messages {
                padding: 14px;
            }

            .message {
                max-width: 88%;
                margin-bottom: 16px;
            }

            .msg-content {
                padding: 10px 14px;
            }

            .msg-text {
                font-size: 14px;
                line-height: 1.4;
            }

            .msg-name {
                font-size: 13px;
            }

            .msg-time {
                font-size: 10px;
            }

            .msg-avatar {
                width: 30px;
                height: 30px;
            }

            .chat-input {
                margin: 8px;
                padding: 10px 14px;
            }

            .text-input {
                font-size: 14px;
            }
        }

        /* ===============================
   SMALL PHONES (<=480px)
=================================*/
        @media (max-width: 480px) {

            .message {
                max-width: 92%;
            }

            .chat-user-heading {
                font-size: 15px;
            }

            .chat-user-category {
                font-size: 13px;
            }

            .chat-item {
                padding: 10px 12px;
            }

            .chat-item img {
                width: 36px;
                height: 36px;
            }

            .chat-item .chat-heading {
                font-size: 15px;
            }

            .chat-item .chat-paragraph {
                font-size: 13px;
            }

            .chat-input {
                border-radius: 20px;
            }
        }

        /* ===============================
   EXTRA SMALL (<=360px)
=================================*/
        @media (max-width: 360px) {

            .msg-text {
                font-size: 13px;
            }

            .chat-input {
                gap: 6px;
            }

            .chat-input img {
                width: 18px;
            }

            .text-input {
                font-size: 13px;
            }
        }
    </style>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ---------- RESPONSIVE MODE (Mobile Toggle) ----------
            function handleResponsive() {
                const body = document.body;
                const isMobile = window.innerWidth <= 768;
                if (isMobile) {
                    body.classList.add('mobile-mode');
                    body.classList.remove('chat-active');
                } else {
                    body.classList.remove('mobile-mode', 'chat-active');
                }
            }
            handleResponsive();

            // Open chat on mobile when clicking a chat item
            document.querySelectorAll('.chat-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    if (document.body.classList.contains('mobile-mode')) {
                        document.body.classList.add('chat-active');
                        document.querySelectorAll('.chat-item').forEach(i => i.classList.remove(
                            'active'));
                        this.classList.add('active');
                    }
                });
            });

            // VIP Back button on mobile
            const vipBackBtn = document.querySelector('.vip-back-btn');
            if (vipBackBtn) {
                vipBackBtn.addEventListener('click', function() {
                    if (document.body.classList.contains('mobile-mode')) {
                        document.body.classList.remove('chat-active');
                    }
                });
            }

            window.addEventListener('resize', handleResponsive);

            // ---------- COLLAPSIBLE SECTIONS ----------
            window.toggleSection = function(sectionId) {
                const section = document.getElementById(sectionId);
                const header = section.previousElementSibling.querySelector('.section-heading');
                if (section.classList.contains('collapsed')) {
                    section.classList.remove('collapsed');
                    header.innerHTML = '˅ ' + (sectionId === 'requestedSection' ? 'Requested Messages' :
                        'Messages');
                } else {
                    section.classList.add('collapsed');
                    header.innerHTML = '› ' + (sectionId === 'requestedSection' ? 'Requested Messages' :
                        'Messages');
                }
            };

            // Initialize all sections as expanded
            document.querySelectorAll('.section-content').forEach(el => el.classList.remove('collapsed'));

            // ---------- SEARCH TOGGLE (Both Icons) ----------
            const searchTriggers = document.querySelectorAll('.search-icon-trigger');
            const searchBarContainer = document.querySelector('.search-bar-container');
            const searchClose = document.querySelector('.search-close');
            const searchInput = document.querySelector('.search-input');

            function toggleSearch(e) {
                e.preventDefault();
                if (searchBarContainer.style.display === 'none' || !searchBarContainer.style.display) {
                    searchBarContainer.style.display = 'block';
                    if (searchInput) searchInput.focus();
                } else {
                    searchBarContainer.style.display = 'none';
                }
            }

            searchTriggers.forEach(trigger => {
                trigger.addEventListener('click', toggleSearch);
            });

            if (searchClose) {
                searchClose.addEventListener('click', function() {
                    searchBarContainer.style.display = 'none';
                });
            }

            if (searchInput) {
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        searchBarContainer.style.display = 'none';
                    }
                });
            }
        });
    </script>









    <?php require_once(__DIR__ . '/../include/footer-script.php'); ?>
<?php require_once(__DIR__ . '/../include/footer.php'); ?>
</body>

</html>