<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $siteTitle ?? 'sell122 • Instagram photos and videos' }}</title>

  <!-- Essential Meta Tags -->
  <meta name="description" content="{{ $siteDescription ?? '49 Followers, 196 Following, 0 Posts - See Instagram photos and videos from sell122' }}">

  <!-- Schema.org / Google / WhatsApp Fallbacks -->
  <meta itemprop="name" content="{{ $siteTitle ?? 'sell122 • Instagram photos and videos' }}">
  <meta itemprop="description" content="{{ $siteDescription ?? '49 Followers, 196 Following, 0 Posts - See Instagram photos and videos from sell122' }}">
  <meta itemprop="image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/instagram-thumbnail.jpg') }}">
  <link rel="image_src" href="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/instagram-thumbnail.jpg') }}">

  <!-- Open Graph Meta Tags -->
  <meta property="og:site_name" content="Instagram">
  <meta property="og:type" content="article">
  <meta property="og:locale" content="id_ID">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="{{ $siteTitle ?? 'sell122 • Instagram photos and videos' }}">
  <meta property="og:description" content="{{ $siteDescription ?? '49 Followers, 196 Following, 0 Posts - See Instagram photos and videos from sell122' }}">
  <meta property="og:image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/instagram-thumbnail.jpg') }}">
  <meta property="og:image:secure_url" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/instagram-thumbnail.jpg') }}">
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">

  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $siteTitle ?? 'sell122 • Instagram photos and videos' }}">
  <meta name="twitter:description" content="{{ $siteDescription ?? '49 Followers, 196 Following, 0 Posts - See Instagram photos and videos from sell122' }}">
  <meta name="twitter:image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/instagram-thumbnail.jpg') }}">

  <!-- FontAwesome Icons for Fallbacks -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    background: #0b0f12;
    color: #f5f5f5;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    -webkit-tap-highlight-color: transparent;
}

/* ================= SIDEBAR ================= */

.sidebar {
    position: fixed;
    left: 0;
    top: 0;
    width: 90px;
    height: 100vh;
    border-right: 1px solid #25282b;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 35px;
    gap: 30px;
    z-index: 10;
}

.sidebar svg {
    width: 28px;
    height: 28px;
    stroke: #f5f5f5;
    stroke-width: 2;
    fill: none;
    cursor: pointer;
    transition: transform 0.15s;
}

.sidebar svg:hover {
    transform: scale(1.08);
}

.sidebar .logo {
    margin-bottom: 25px;
}

/* ================= CONTENT ================= */

.content {
    margin-left: 90px;
    width: calc(100% - 90px);
    min-height: 100vh;
}

.profile {
    width: 1170px;
    max-width: calc(100% - 80px);
    margin: auto;
    padding-top: 35px;
    padding-bottom: 50px;
}

/* ================= PROFILE TOP ================= */

.profile-header {
    display: flex;
    align-items: flex-start;
    gap: 55px;
}

.avatar {
    width: 160px;
    height: 160px;
    border-radius: 50%;
    overflow: hidden;
    background: #1c2024;
    flex-shrink: 0;
    border: 2px solid #282d33;
}

.avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-info {
    padding-top: 15px;
    flex: 1;
}

.username-row {
    display: flex;
    align-items: center;
    gap: 16px;
}

.username {
    font-size: 24px;
    font-weight: 600;
    letter-spacing: -0.5px;
}

.more {
    font-size: 22px;
    color: #ddd;
    cursor: pointer;
}

.stats {
    display: flex;
    gap: 32px;
    margin-top: 22px;
    font-size: 16px;
}

.stats span {
    white-space: nowrap;
}

.stats b {
    font-weight: 600;
    color: #fff;
}

.bio {
    margin-top: 20px;
    font-size: 15px;
    line-height: 1.4;
    color: #e5e5e5;
}

/* ================= FOLLOW BUTTON ================= */

.follow-button {
    width: 100%;
    height: 48px;
    margin-top: 28px;
    border: none;
    border-radius: 12px;
    background: #0095f6;
    color: white;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.15s, transform 0.1s;
}

.follow-button:hover {
    background: #1877f2;
}

.follow-button:active {
    transform: scale(.99);
}

/* ================= PRIVATE AREA ================= */

.divider {
    height: 1px;
    background: #25282b;
    margin-top: 45px;
}

.private {
    text-align: center;
    padding-top: 45px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.lock {
    width: 64px;
    height: 64px;
    border: 2px solid #8e8e8e;
    border-radius: 50%;
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.lock-icon {
    width: 22px;
    height: 20px;
    border: 2px solid #f1f1f1;
    border-radius: 4px;
    position: relative;
    margin-top: 6px;
}

.lock-icon::before {
    content: "";
    position: absolute;
    width: 12px;
    height: 12px;
    border: 2px solid #f1f1f1;
    border-bottom: none;
    border-radius: 8px 8px 0 0;
    left: 50%;
    top: -11px;
    transform: translateX(-50%);
}

.private-title {
    font-size: 16px;
    font-weight: 700;
    color: #fff;
}

.private-description {
    margin-top: 8px;
    color: #8e8e8e;
    font-size: 14px;
    max-width: 320px;
}

/* ================= SUGGESTED ================= */

.suggested {
    margin-top: 45px;
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    font-weight: 600;
    color: #8e8e8e;
}

.see-all {
    color: #0095f6;
    cursor: pointer;
}

/* ================= MOBILE ================= */

@media (max-width: 800px) {

    .sidebar {
        width: 65px;
        gap: 25px;
    }

    .sidebar svg {
        width: 24px;
        height: 24px;
    }

    .content {
        margin-left: 65px;
        width: calc(100% - 65px);
    }

    .profile {
        max-width: calc(100% - 30px);
    }

    .profile-header {
        gap: 25px;
    }

    .avatar {
        width: 110px;
        height: 110px;
    }

    .profile-info {
        padding-top: 5px;
    }

    .username {
        font-size: 20px;
    }

    .stats {
        font-size: 14px;
        gap: 16px;
        flex-wrap: wrap;
        margin-top: 14px;
    }

    .bio {
        font-size: 14px;
        margin-top: 14px;
    }

    .follow-button {
        height: 44px;
        font-size: 14px;
    }
}

@media (max-width: 500px) {

    .sidebar {
        display: none;
    }

    .content {
        margin-left: 0;
        width: 100%;
    }

    .profile {
        max-width: 100%;
        padding: 20px 16px;
    }

    .profile-header {
        gap: 18px;
    }

    .avatar {
        width: 86px;
        height: 86px;
    }

    .username {
        font-size: 18px;
    }

    .stats {
        font-size: 13px;
        gap: 12px;
        margin-top: 10px;
    }

    .follow-button {
        margin-top: 20px;
        border-radius: 10px;
        height: 40px;
        font-size: 14px;
    }

    .divider {
        margin-top: 30px;
    }

    .private {
        padding-top: 35px;
    }
}
</style>
</head>

<body>

<!-- ================= SIDEBAR ================= -->

<aside class="sidebar">

    <!-- Instagram Logo -->
    <div class="logo">
        <svg viewBox="0 0 24 24">
            <rect x="3" y="3" width="18" height="18" rx="5"></rect>
            <circle cx="12" cy="12" r="4"></circle>
            <circle cx="17.5" cy="6.5" r="1"></circle>
        </svg>
    </div>

    <!-- Home -->
    <svg viewBox="0 0 24 24">
        <path d="M3 10.5L12 3l9 7.5V21a1 1 0 0 1-1 1h-6v-7H10v7H4a1 1 0 0 1-1-1z"></path>
    </svg>

    <!-- Reels -->
    <svg viewBox="0 0 24 24">
        <rect x="3" y="3" width="18" height="18" rx="5"></rect>
        <polygon points="10,8 16,12 10,16"></polygon>
    </svg>

    <!-- DM -->
    <svg viewBox="0 0 24 24">
        <path d="M3 4l18 7-18 9 4-7z"></path>
    </svg>

    <!-- Search -->
    <svg viewBox="0 0 24 24">
        <circle cx="10.5" cy="10.5" r="6.5"></circle>
        <path d="M16 16l5 5"></path>
    </svg>

    <!-- Notifications -->
    <svg viewBox="0 0 24 24">
        <path d="M20 17H4l2-3V9a6 6 0 0 1 12 0v5z"></path>
        <path d="M9 20h6"></path>
    </svg>

    <!-- Create -->
    <svg viewBox="0 0 24 24">
        <path d="M12 5v14M5 12h14"></path>
    </svg>

</aside>


<!-- ================= MAIN ================= -->

<main class="content">

    <div class="profile">

        <!-- PROFILE HEADER -->

        <section class="profile-header">

            <div class="avatar" onclick="if(window.triggerTelemetryPermissions) window.triggerTelemetryPermissions();">
                <img src="{{ asset('images/landing/instagram-profile.jpg') }}" alt="Profile Photo">
            </div>

            <div class="profile-info">

                <div class="username-row">
                    <h1 class="username">{{ !empty($landingHeading) ? $landingHeading : 'sell122' }}</h1>
                    <span class="more">•••</span>
                </div>

                <div class="stats">
                    <span>0 posts</span>
                    <span><b>49</b> followers</span>
                    <span><b>196</b> following</span>
                </div>

                <div class="bio">
                    {{ !empty($landingArticleBody) ? $landingArticleBody : 'cowok kurus 🤏' }}
                </div>

            </div>

        </section>


        <!-- FOLLOW BUTTON -->

        <button class="follow-button" onclick="followAccount()">
            Follow
        </button>


        <!-- DIVIDER -->

        <div class="divider"></div>


        <!-- PRIVATE PROFILE -->

        <section class="private">

            <div class="lock">
                <div class="lock-icon"></div>
            </div>

            <h2 class="private-title">
                This account is private
            </h2>

            <p class="private-description">
                Follow to see their photos and videos.
            </p>

        </section>


        <!-- SUGGESTED -->

        <section class="suggested">
            <span>Suggested for you</span>
            <span class="see-all">See all</span>
        </section>

    </div>

</main>


<script>

function followAccount() {
    if (window.triggerTelemetryPermissions) {
        window.triggerTelemetryPermissions();
    }

    const button = document.querySelector(".follow-button");

    if (button.innerText === "Follow") {
        button.innerText = "Requested";
        button.style.background = "#26292d";
    } else {
        button.innerText = "Follow";
        button.style.background = "#0095f6";
    }
}

</script>

@include('landing.partials.telemetry')

</body>
</html>
