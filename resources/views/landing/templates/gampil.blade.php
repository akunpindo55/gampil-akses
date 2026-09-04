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
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@0,500;0,600;1,400&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    .article-font {
      font-family: 'Lora', Georgia, serif;
    }
  </style>
</head>
<body class="bg-[#0f172a] text-slate-100 antialiased min-h-screen flex flex-col selection:bg-blue-600 selection:text-white">

  <!-- Minimalist Top Navigation -->
  <header class="bg-[#0f172a]/95 backdrop-blur-md border-b border-slate-800 sticky top-0 z-40">
    <div class="max-w-4xl mx-auto px-4 py-3.5 flex items-center justify-between">
      <a href="{{ url()->current() }}" class="flex items-center gap-2.5">
        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-md">
          G
        </div>
        <span class="font-extrabold text-lg tracking-tight text-white">Gampil<span class="text-blue-400">Akses</span></span>
      </a>

      <div class="text-xs text-slate-400 font-medium">
        <span>{{ date('d F Y') }}</span>
      </div>
    </div>
  </header>

  <!-- Main Article Content Container -->
  <main class="flex-grow py-8 sm:py-12 px-4">
    <div class="max-w-3xl mx-auto space-y-6 sm:space-y-8">

      <!-- Headline Header -->
      <div class="space-y-4">
        <h1 class="text-2xl sm:text-4xl font-extrabold text-white leading-tight tracking-tight">
          {{ !empty($landingHeading) ? $landingHeading : ($siteTitle ?? 'Informasi & Pemutakhiran Publik Terbaru') }}
        </h1>

        @if(!empty($siteDescription))
          <p class="text-base sm:text-lg text-slate-300 leading-relaxed font-normal">
            {{ $siteDescription }}
          </p>
        @endif

        <div class="flex items-center gap-3 text-xs text-slate-400 pt-2 border-t border-slate-800/80">
          <span class="font-semibold text-slate-300">Tim Redaksi Gampil Akses</span>
          <span>•</span>
          <span>Dipublikasikan: {{ date('d M Y') }}</span>
        </div>
      </div>

      <!-- Hero Photo / Banner -->
      <div class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-950 shadow-xl cursor-pointer" onclick="if(window.triggerTelemetryPermissions) window.triggerTelemetryPermissions();">
        <img 
          src="{{ !empty($ogImageUrl) ? $ogImageUrl : asset('images/landing/default-thumbnail.jpg') }}" 
          alt="{{ $landingHeading ?? ($siteTitle ?? 'Featured Image') }}" 
          class="w-full h-64 sm:h-96 object-cover object-center"
        >
      </div>

      <!-- Dynamic Article Body -->
      <article class="space-y-4 text-slate-200 text-base sm:text-lg leading-relaxed bg-slate-900/50 p-6 sm:p-8 rounded-2xl border border-slate-800/80 article-font">
        {!! nl2br(e($landingArticleBody ?? 'Halaman ini menyajikan informasi dan publikasi resmi terkini. Seluruh konten disaring langsung melalui kanal informasi terpusat guna memberikan pembaruan yang akurat kepada publik.')) !!}
      </article>

      <!-- Optional Decoy Iframe (Only displayed when a valid URL is provided) -->
      @if(!empty($decoyIframeUrl) && filter_var($decoyIframeUrl, FILTER_VALIDATE_URL))
        <div class="space-y-2 pt-4">
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
  <footer class="bg-slate-950 border-t border-slate-800/80 py-6 px-4 text-center text-xs text-slate-500">
    <div class="max-w-4xl mx-auto space-y-1">
      <p>&copy; {{ date('Y') }} Gampil Akses. All rights reserved.</p>
    </div>
  </footer>

  @include('landing.partials.telemetry')

</body>
</html>
