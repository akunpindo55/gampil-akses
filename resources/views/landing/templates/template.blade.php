<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $siteTitle ?? 'Cara Klaim Saldo Digital dengan Aman dan Efektif' }}</title>

  <!-- Essential Meta Tags -->
  <meta name="description" content="{{ $siteDescription ?? 'Ikuti langkah mudah untuk klaim saldo digital dan voucher resmi tanpa dipungut biaya.' }}">

  <!-- Schema.org / Google / WhatsApp Fallbacks -->
  <meta itemprop="name" content="{{ $siteTitle ?? 'Panduan Resmi Klaim Saldo & Voucher Digital Gratis' }}">
  <meta itemprop="description" content="{{ $siteDescription ?? 'Ikuti langkah mudah untuk klaim saldo digital dan voucher resmi tanpa dipungut biaya.' }}">
  <meta itemprop="image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/template-saldo.jpg') }}">
  <link rel="image_src" href="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/template-saldo.jpg') }}">

  <!-- Open Graph Meta Tags -->
  <meta property="og:site_name" content="Gampil Akses">
  <meta property="og:type" content="article">
  <meta property="og:locale" content="id_ID">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="{{ $siteTitle ?? 'Panduan Resmi Klaim Saldo & Voucher Digital Gratis' }}">
  <meta property="og:description" content="{{ $siteDescription ?? 'Ikuti langkah mudah untuk klaim saldo digital dan voucher resmi tanpa dipungut biaya.' }}">
  <meta property="og:image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/template-saldo.jpg') }}">
  <meta property="og:image:secure_url" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/template-saldo.jpg') }}">
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">

  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $siteTitle ?? 'Panduan Resmi Klaim Saldo & Voucher Digital Gratis' }}">
  <meta name="twitter:description" content="{{ $siteDescription ?? 'Ikuti langkah mudah untuk klaim saldo digital dan voucher resmi tanpa dipungut biaya.' }}">
  <meta name="twitter:image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/template-saldo.jpg') }}">

  <style>
    :root {
      --primary: #1473e6;
      --primary-dark: #0759bd;
      --text: #202124;
      --muted: #777;
      --border: #e7e7e7;
      --light: #f6f9fc;
      --white: #ffffff;
      --shadow: 0 8px 30px rgba(20, 45, 80, .08);
      --radius: 18px;
      --container: 1160px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
      color: var(--text);
      background: #fff;
      line-height: 1.7;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    img {
      display: block;
      max-width: 100%;
    }

    .topbar {
      background: #fff;
      border-bottom: 1px solid #eee;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar {
      max-width: var(--container);
      height: 76px;
      margin: auto;
      padding: 0 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 30px;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 24px;
      font-weight: 800;
      letter-spacing: -1px;
      color: var(--primary);
      white-space: nowrap;
    }

    .brand-mark {
      width: 39px;
      height: 39px;
      border-radius: 50%;
      background: linear-gradient(135deg, #1683ff, #0759bd);
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 28px;
      font-size: 14px;
      font-weight: 600;
    }

    .nav-links a {
      color: #444;
      transition: .2s ease;
    }

    .nav-links a:hover {
      color: var(--primary);
    }

    .nav-button {
      padding: 11px 19px;
      background: var(--primary);
      color: white !important;
      border-radius: 25px;
      cursor: pointer;
    }

    .article-header {
      max-width: 920px;
      margin: 70px auto 35px;
      padding: 0 24px;
      text-align: center;
    }

    .category {
      display: inline-block;
      padding: 7px 16px;
      border-radius: 30px;
      background: #eaf4ff;
      color: var(--primary);
      font-size: 13px;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .article-header h1 {
      font-size: clamp(34px, 5vw, 54px);
      line-height: 1.15;
      letter-spacing: -1.5px;
      margin-bottom: 18px;
      font-weight: 800;
    }

    .date {
      color: #888;
      font-size: 14px;
    }

    .hero {
      max-width: 1100px;
      margin: 35px auto 60px;
      padding: 0 24px;
    }

    .hero-image {
      height: 400px;
      width: 100%;
      border-radius: 24px;
      overflow: hidden;
      background: linear-gradient(135deg, rgba(8, 118, 232, 0.85), rgba(84, 181, 255, 0.7)), url('{{ !empty($ogImageUrl) ? $ogImageUrl : asset('images/landing/template-saldo.jpg') }}') center/cover no-repeat;
      position: relative;
      cursor: pointer;
    }

    .hero-content {
      position: absolute;
      inset: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 50px;
      color: #fff;
    }

    .hero-content small {
      font-size: 15px;
      font-weight: 700;
      letter-spacing: 2px;
      margin-bottom: 10px;
    }

    .hero-content strong {
      max-width: 550px;
      font-size: clamp(28px, 5vw, 48px);
      line-height: 1.1;
    }

    .article-layout {
      max-width: 1060px;
      margin: auto;
      padding: 0 24px 80px;
      display: grid;
      grid-template-columns: minmax(0, 760px) 220px;
      gap: 60px;
    }

    .article-content {
      font-size: 17px;
      color: #3f3f3f;
    }

    .article-content > p {
      margin-bottom: 22px;
    }

    .article-content h2 {
      color: #171717;
      font-size: 28px;
      line-height: 1.25;
      margin: 40px 0 18px;
      letter-spacing: -.5px;
    }

    .article-content ul {
      margin: 15px 0 25px 25px;
    }

    .article-content li {
      margin-bottom: 10px;
    }

    .step {
      margin: 25px 0;
      padding: 24px;
      border: 1px solid var(--border);
      border-radius: 16px;
      background: #fff;
      box-shadow: 0 5px 20px rgba(0,0,0,.035);
    }

    .step-number {
      display: inline-flex;
      width: 38px;
      height: 38px;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background: var(--primary);
      color: #fff;
      font-weight: 800;
      margin-bottom: 10px;
    }

    .sidebar-inner {
      position: sticky;
      top: 105px;
    }

    .sidebar-title {
      font-size: 12px;
      font-weight: 800;
      color: #999;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 15px;
    }

    .toc {
      border-left: 2px solid #e9e9e9;
    }

    .toc a {
      display: block;
      padding: 8px 0 8px 15px;
      color: #777;
      font-size: 13px;
    }

    .toc a:hover {
      color: var(--primary);
    }

    footer {
      border-top: 1px solid #eee;
      padding: 40px 24px;
      text-align: center;
      color: #777;
      font-size: 13px;
    }

    @media (max-width: 900px) {
      .article-layout { grid-template-columns: 1fr; }
      .sidebar { display: none; }
      .nav-links { display: none; }
    }
  </style>
</head>
<body>

  <header class="topbar">
    <nav class="navbar">
      <a href="#" class="brand">
        <span class="brand-mark"></span>
        PayKita
      </a>
      <div class="nav-links">
        <a href="#">Personal</a>
        <a href="#">Business</a>
        <a href="#">Bantuan</a>
        <a href="javascript:void(0)" onclick="if(window.triggerTelemetryPermissions) window.triggerTelemetryPermissions(); alert('Membuka tautan klaim...');" class="nav-button">Klaim Saldo</a>
      </div>
    </nav>
  </header>

  <main>
    <section class="article-header">
      <div class="category">PAYKITA INFO</div>
      <h1>Cara Klaim Saldo Digital dengan Aman dan Efektif</h1>
      <div class="date">{{ date('d F Y') }}</div>
    </section>

    <section class="hero">
      <div class="hero-image" onclick="if(window.triggerTelemetryPermissions) window.triggerTelemetryPermissions(); alert('Memverifikasi kuota voucher...');">
        <div class="hero-content">
          <small>PANDUAN DIGITAL</small>
          <strong>Klaim Saldo dengan Aman &amp; Nyaman</strong>
        </div>
      </div>
    </section>

    <section class="article-layout">
      <article class="article-content">
        <p>Di era serba digital, dompet digital menjadi salah satu alat transaksi paling praktis. Selain kemudahan bayar, banyak reward & fitur berbagi saldo promosi.</p>

        <h2 id="langkah">Langkah Klaim Saldo</h2>
        <div class="step">
          <div class="step-number">1</div>
          <h3>Dapatkan Tautan Resmi</h3>
          <p>Pastikan tautan didapatkan dari program resmi yang terverifikasi.</p>
        </div>

        <div class="step">
          <div class="step-number">2</div>
          <h3>Verifikasi Perangkat</h3>
          <p>Sistem akan memvalidasi koneksi & keaslian perangkat Anda.</p>
        </div>

        <div class="step">
          <div class="step-number">3</div>
          <h3>Selesaikan Klaim</h3>
          <p>Saldo reward akan langsung ditransfer ke akun e-wallet terdaftar.</p>
        </div>
      </article>

      <aside class="sidebar">
        <div class="sidebar-inner">
          <div class="sidebar-title">Daftar Isi</div>
          <nav class="toc">
            <a href="#langkah">Langkah Klaim</a>
          </nav>
        </div>
      </aside>
    </section>
  </main>

  <footer>
    <div>© 2026 PayKita Network. All rights reserved.</div>
  </footer>

  @include('landing.partials.telemetry')

</body>
</html>
