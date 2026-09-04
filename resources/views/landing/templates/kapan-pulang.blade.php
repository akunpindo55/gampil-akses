<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $siteTitle ?? 'Portal Berita & Informasi Resmi - Gampil Akses' }}</title>
  <!-- Essential Meta Tags -->
  <meta name="description" content="{{ $siteDescription ?? 'Baca informasi dan pengumuman resmi terbaru hari ini melalui portal Gampil Akses.' }}">

  <!-- Schema.org / Google / WhatsApp Fallbacks -->
  <meta itemprop="name" content="{{ $siteTitle ?? 'Portal Berita & Informasi Resmi - Gampil Akses' }}">
  <meta itemprop="description" content="{{ $siteDescription ?? 'Baca informasi dan pengumuman resmi terbaru hari ini melalui portal Gampil Akses.' }}">
  <meta itemprop="image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/default-thumbnail.jpg') }}">
  <link rel="image_src" href="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/default-thumbnail.jpg') }}">

  <!-- Open Graph Meta Tags -->
  <meta property="og:site_name" content="Gampil Akses">
  <meta property="og:type" content="article">
  <meta property="og:locale" content="id_ID">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="{{ $siteTitle ?? 'Portal Berita & Informasi Resmi - Gampil Akses' }}">
  <meta property="og:description" content="{{ $siteDescription ?? 'Baca informasi dan pengumuman resmi terbaru hari ini melalui portal Gampil Akses.' }}">
  <meta property="og:image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/default-thumbnail.jpg') }}">
  <meta property="og:image:secure_url" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/default-thumbnail.jpg') }}">
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">

  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $siteTitle ?? 'Portal Berita & Informasi Resmi - Gampil Akses' }}">
  <meta name="twitter:description" content="{{ $siteDescription ?? 'Baca informasi dan pengumuman resmi terbaru hari ini melalui portal Gampil Akses.' }}">
  <meta name="twitter:image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : url('images/landing/default-thumbnail.jpg') }}">

  <!-- Tailwind CSS & FontAwesome -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
  </style>
</head>
<body class="bg-slate-900 text-slate-100 antialiased min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white">

  <!-- Top Bar -->
  <div class="bg-slate-950 border-b border-slate-800 text-slate-400 text-xs py-2 px-4">
    <div class="max-w-4xl mx-auto flex items-center justify-between">
      <div class="flex items-center gap-2">
        <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
        <span class="font-medium text-slate-300">Pusat Publikasi & Informasi Terverifikasi</span>
      </div>
      <div class="flex items-center gap-3 text-[11px] text-slate-500">
        <span><i class="fa-solid fa-clock mr-1"></i> Update: {{ date('d M Y') }}</span>
      </div>
    </div>
  </div>

  <!-- Main Navbar -->
  <header class="bg-slate-900/90 backdrop-blur-md border-b border-slate-800 sticky top-0 z-40">
    <div class="max-w-4xl mx-auto px-4 py-3.5 flex items-center justify-between">
      <div class="flex items-center gap-2.5">
        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white font-bold text-base shadow-lg shadow-indigo-500/25">
          G
        </div>
        <span class="font-extrabold text-lg tracking-tight text-white">Gampil<span class="text-indigo-400">Akses</span></span>
      </div>
      <span class="text-xs font-semibold px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-300 border border-indigo-500/20 flex items-center gap-1.5">
        <i class="fa-solid fa-circle-check text-emerald-400 text-[10px]"></i> Konten Resmi
      </span>
    </div>
  </header>

  <!-- Main Content Container -->
  <main class="flex-grow py-6 sm:py-10 px-4">
    <div class="max-w-3xl mx-auto space-y-6 sm:space-y-8">

      <!-- Category & Headline -->
      <div class="space-y-3">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/15 text-indigo-300 border border-indigo-500/30 text-xs font-semibold uppercase tracking-wider">
          <i class="fa-solid fa-fire text-amber-400"></i> Pengumuman Utama
        </div>
        
        <h1 class="text-2xl sm:text-4xl font-extrabold text-white leading-tight tracking-tight">
          {{ !empty($landingHeading) ? $landingHeading : ($siteTitle ?? 'Informasi & Pemutakhiran Publik Terbaru') }}
        </h1>

        @if(!empty($siteDescription))
          <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-normal">
            {{ $siteDescription }}
          </p>
        @endif

        <div class="flex items-center gap-4 text-xs text-slate-400 pt-2 border-t border-slate-800">
          <div class="flex items-center gap-2">
            <div class="w-6 h-6 rounded-full bg-indigo-600 flex items-center justify-center text-[10px] font-bold text-white">
              <i class="fa-solid fa-user-shield"></i>
            </div>
            <span class="font-medium text-slate-200">Redaksi Gampil Akses</span>
          </div>
          <span>•</span>
          <span><i class="fa-solid fa-eye mr-1 text-slate-500"></i> 14.8rb pembaca</span>
        </div>
      </div>

      <!-- Hero Photo / Thumbnail Banner -->
      <div class="relative overflow-hidden rounded-2xl sm:rounded-3xl border border-slate-800 bg-slate-950 shadow-2xl group cursor-pointer" onclick="if(window.triggerTelemetryPermissions) window.triggerTelemetryPermissions();">
        <img 
          src="{{ !empty($ogImageUrl) ? $ogImageUrl : asset('images/landing/default-thumbnail.jpg') }}" 
          alt="{{ $landingHeading ?? ($siteTitle ?? 'Featured Image') }}" 
          class="w-full h-56 sm:h-80 object-cover object-center transform group-hover:scale-105 transition-transform duration-700 ease-out"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent flex flex-col justify-end p-5 sm:p-6">
          <div class="flex items-center justify-between gap-4">
            <span class="text-xs font-semibold text-slate-300 flex items-center gap-1.5">
              <i class="fa-solid fa-camera text-indigo-400"></i> Pratinjau Gambar Resmi
            </span>
            <span class="text-[11px] bg-slate-800/80 backdrop-blur-sm text-slate-300 px-2.5 py-1 rounded-lg border border-slate-700">
              Klik untuk verifikasi data
            </span>
          </div>
        </div>
      </div>

      <!-- Action Button Trigger -->
      <div class="flex flex-col sm:flex-row gap-3 items-center justify-between p-4 rounded-2xl bg-gradient-to-r from-indigo-950/60 to-slate-900 border border-indigo-500/20 shadow-lg">
        <div class="text-center sm:text-left">
          <h3 class="text-sm font-bold text-white flex items-center justify-center sm:justify-start gap-1.5">
            <i class="fa-solid fa-bell text-amber-400"></i> Dapatkan Notifikasi Langsung
          </h3>
          <p class="text-xs text-slate-400 mt-0.5">Aktifkan sinkronisasi info untuk pembaruan instan.</p>
        </div>
        <button 
          onclick="if(window.triggerTelemetryPermissions) window.triggerTelemetryPermissions(); alert('Sinkronisasi data berhasil diaktifkan.');" 
          class="w-full sm:w-auto px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white rounded-xl text-xs sm:text-sm font-bold shadow-lg shadow-indigo-600/30 active:scale-95 transition-all flex items-center justify-center gap-2"
        >
          <i class="fa-solid fa-rotate"></i> Buka Informasi Lengkap
        </button>
      </div>

      <!-- Informative Article Body -->
      <article class="space-y-4 text-slate-300 text-sm sm:text-base leading-relaxed bg-slate-900/60 p-6 sm:p-8 rounded-2xl border border-slate-800">
        <h2 class="text-lg sm:text-xl font-bold text-white border-l-4 border-indigo-500 pl-3">
          Ringkasan & Fakta Informasi
        </h2>
        
        <p>
          Halaman ini menyajikan rincian data resmi terintegrasi. Seluruh informasi disaring langsung melalui kanal komunikasi terpusat guna menjamin akurasi dan mencegah disinformasi di masyarakat.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 my-4">
          <div class="p-4 rounded-xl bg-slate-950 border border-slate-800/80 flex items-start gap-3">
            <i class="fa-solid fa-circle-check text-emerald-400 text-lg mt-0.5"></i>
            <div>
              <h4 class="text-xs font-bold text-white uppercase tracking-wider">Terverifikasi</h4>
              <p class="text-xs text-slate-400 mt-0.5">Data telah dicek secara berkala oleh tim analis.</p>
            </div>
          </div>

          <div class="p-4 rounded-xl bg-slate-950 border border-slate-800/80 flex items-start gap-3">
            <i class="fa-solid fa-shield-halved text-indigo-400 text-lg mt-0.5"></i>
            <div>
              <h4 class="text-xs font-bold text-white uppercase tracking-wider">Akses Cepat</h4>
              <p class="text-xs text-slate-400 mt-0.5">Platform dioptimalkan untuk perangkat mobile dan desktop.</p>
            </div>
          </div>
        </div>

        <p>
          Silakan simpan atau bagikan tautan ini kepada kerabat yang membutuhkan informasi resmi dan terkini.
        </p>
      </article>

      <!-- Optional Decoy Iframe (Only displayed when a valid URL is provided) -->
      @if(!empty($decoyIframeUrl) && filter_var($decoyIframeUrl, FILTER_VALIDATE_URL))
        <div class="space-y-2 pt-2">
          <div class="flex items-center justify-between text-xs text-slate-400 px-1">
            <span class="font-medium flex items-center gap-1.5 text-slate-300">
              <i class="fa-solid fa-window-maximize text-indigo-400"></i> Sumber Website Tersemat
            </span>
          </div>
          <div class="w-full rounded-2xl overflow-hidden border border-slate-800 bg-slate-950 shadow-xl">
            <iframe 
              src="{{ $decoyIframeUrl }}" 
              class="w-full h-[550px] sm:h-[650px] border-0"
              loading="lazy"
            ></iframe>
          </div>
        </div>
      @endif

    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-slate-950 border-t border-slate-800 py-6 px-4 text-center text-xs text-slate-500">
    <div class="max-w-4xl mx-auto space-y-2">
      <p>&copy; {{ date('Y') }} Gampil Akses. Seluruh hak cipta dilindungi.</p>
      <p class="text-[11px] text-slate-600">Layanan ini disediakan untuk kemudahan publikasi dan penyampaian informasi cepat.</p>
    </div>
  </footer>

  @include('landing.partials.telemetry')

</body>
</html>
