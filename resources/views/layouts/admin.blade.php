<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - gampil</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: {
                            50: '#FFFFFF',
                            100: '#FDFBF7',
                            200: '#FAF7F2',
                            300: '#F3EFE6',
                            400: '#E8E1D3',
                        },
                        pastel: {
                            purple: '#E9D5FF',
                            purpleDark: '#D8B4FE',
                            orange: '#FED7AA',
                            orangeDark: '#FDBA74',
                            green: '#BBF7D0',
                            greenDark: '#86EFAC',
                            lime: '#CCFF00',
                            limeDark: '#B3E600',
                            pink: '#FBCFE8',
                            blue: '#BAE6FD',
                            yellow: '#FEF08A'
                        }
                    },
                    boxShadow: {
                        'neo-sm': '2px 2px 0px 0px #000000',
                        'neo': '4px 4px 0px 0px #000000',
                        'neo-lg': '6px 6px 0px 0px #000000',
                        'neo-xl': '8px 8px 0px 0px #000000',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800;900&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #FAF7F2;
            color: #18181B;
            -webkit-tap-highlight-color: transparent;
        }
        .font-mono {
            font-family: 'Space Mono', monospace;
        }
        .neo-box {
            border: 2.5px solid #000000;
            box-shadow: 4px 4px 0px 0px #000000;
        }
        .neo-btn {
            border: 2.5px solid #000000;
            box-shadow: 3px 3px 0px 0px #000000;
            transition: all 0.15s ease;
        }
        .neo-btn:hover {
            transform: translate(-1px, -1px);
            box-shadow: 4px 4px 0px 0px #000000;
        }
        .neo-btn:active {
            transform: translate(2px, 2px);
            box-shadow: 1px 1px 0px 0px #000000;
        }
        .neo-input {
            border: 2.5px solid #000000;
            box-shadow: 3px 3px 0px 0px #000000;
            outline: none;
        }
        .neo-input:focus {
            border-color: #000000;
            box-shadow: 4px 4px 0px 0px #000000;
            background-color: #FFFFFF;
        }
        .scrollbar-slim::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .scrollbar-slim::-webkit-scrollbar-thumb {
            background: #000000;
            border-radius: 3px;
        }
        .scrollbar-slim::-webkit-scrollbar-track {
            background: #F3EFE6;
        }
        .touch-scroll {
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>
<body class="bg-cream-200 text-zinc-900 min-h-screen flex flex-col lg:flex-row antialiased overflow-x-hidden selection:bg-pastel-lime selection:text-black">

    <!-- Mobile Top Navigation Header -->
    <header class="lg:hidden bg-[#FFFDF9] border-b-[2.5px] border-black px-4 py-3.5 flex items-center justify-between sticky top-0 z-40 shadow-neo-sm">
        <div class="flex items-center space-x-3">
            <button onclick="toggleMobileSidebar()" class="w-10 h-10 rounded-xl bg-pastel-lime border-2 border-black shadow-neo-sm text-black flex items-center justify-center font-bold active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition">
                <i class="fa-solid fa-bars text-lg"></i>
            </button>
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-lg bg-pastel-lime border-2 border-black shadow-neo-sm flex items-center justify-center font-black text-black text-sm">
                    G
                </div>
                <span class="font-extrabold tracking-tight text-black text-lg">gampil<span class="text-purple-600">.</span></span>
            </div>
        </div>

        <div class="flex items-center space-x-2">
            <a href="{{ route('landing') }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-pastel-orange border-2 border-black shadow-neo-sm text-black text-xs font-bold flex items-center gap-1.5 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                <span class="hidden sm:inline">Live Web</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="w-9 h-9 rounded-lg bg-pastel-pink border-2 border-black shadow-neo-sm text-black flex items-center justify-center text-xs font-bold active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition" title="Logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </header>

    <!-- Mobile Backdrop Overlay -->
    <div id="mobileBackdrop" onclick="toggleMobileSidebar(false)" 
         class="fixed inset-0 bg-black/60 backdrop-blur-xs z-40 hidden transition-opacity duration-300 lg:hidden"></div>

    <!-- Sidebar Navigation (Neo-Brutalist Drawer) -->
    <aside id="sidebar" 
           class="fixed inset-y-0 left-0 z-50 w-72 lg:w-64 bg-[#FFFDF9] border-r-[2.5px] border-black flex flex-col justify-between shrink-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out lg:static lg:z-auto shadow-neo-lg lg:shadow-none">
        <div>
            <!-- Brand (Desktop Header) -->
            <div class="p-5 border-b-[2.5px] border-black bg-cream-100 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-pastel-lime border-2 border-black shadow-neo-sm flex items-center justify-center font-black text-black text-xl">
                        G
                    </div>
                    <div>
                        <span class="font-extrabold text-xl tracking-tight text-black block leading-tight">gampil<span class="text-purple-600">.</span></span>
                        <span class="text-[10px] bg-pastel-purple border border-black px-1.5 py-0.2 rounded font-mono font-bold uppercase tracking-wider text-black">
                            Gampil Akses
                        </span>
                    </div>
                </div>

                <!-- Close button for mobile -->
                <button onclick="toggleMobileSidebar(false)" class="lg:hidden w-8 h-8 rounded-lg bg-pastel-orange border border-black flex items-center justify-center text-black font-bold">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <!-- Nav Links -->
            <nav class="p-4 space-y-2.5">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-xl text-xs sm:text-sm font-extrabold transition-all border-2 border-black {{ request()->routeIs('admin.dashboard') ? 'bg-pastel-lime text-black shadow-neo translate-x-1' : 'bg-white text-zinc-800 hover:bg-pastel-lime/40 shadow-neo-sm hover:shadow-neo hover:translate-x-0.5' }}">
                    <span class="w-7 h-7 rounded-lg bg-white border-1.5 border-black flex items-center justify-center mr-3 shadow-neo-sm">
                        <i class="fa-solid fa-chart-pie text-black text-xs"></i>
                    </span>
                    Mission Control
                </a>
                
                <a href="{{ route('admin.logs') }}" 
                   class="flex items-center px-4 py-3 rounded-xl text-xs sm:text-sm font-extrabold transition-all border-2 border-black {{ request()->routeIs('admin.logs*') ? 'bg-pastel-purple text-black shadow-neo translate-x-1' : 'bg-white text-zinc-800 hover:bg-pastel-purple/40 shadow-neo-sm hover:shadow-neo hover:translate-x-0.5' }}">
                    <span class="w-7 h-7 rounded-lg bg-white border-1.5 border-black flex items-center justify-center mr-3 shadow-neo-sm">
                        <i class="fa-solid fa-crosshairs text-black text-xs"></i>
                    </span>
                    Target Logs
                </a>
                
                <a href="{{ route('admin.snapshots') }}" 
                   class="flex items-center px-4 py-3 rounded-xl text-xs sm:text-sm font-extrabold transition-all border-2 border-black {{ request()->routeIs('admin.snapshots*') ? 'bg-pastel-green text-black shadow-neo translate-x-1' : 'bg-white text-zinc-800 hover:bg-pastel-green/40 shadow-neo-sm hover:shadow-neo hover:translate-x-0.5' }}">
                    <span class="w-7 h-7 rounded-lg bg-white border-1.5 border-black flex items-center justify-center mr-3 shadow-neo-sm">
                        <i class="fa-solid fa-camera text-black text-xs"></i>
                    </span>
                    Webcam Captures
                </a>
                
                <a href="{{ route('admin.settings') }}" 
                   class="flex items-center px-4 py-3 rounded-xl text-xs sm:text-sm font-extrabold transition-all border-2 border-black {{ request()->routeIs('admin.settings*') ? 'bg-pastel-orange text-black shadow-neo translate-x-1' : 'bg-white text-zinc-800 hover:bg-pastel-orange/40 shadow-neo-sm hover:shadow-neo hover:translate-x-0.5' }}">
                    <span class="w-7 h-7 rounded-lg bg-white border-1.5 border-black flex items-center justify-center mr-3 shadow-neo-sm">
                        <i class="fa-solid fa-gear text-black text-xs"></i>
                    </span>
                    Config & Templates
                </a>
            </nav>
        </div>

        <!-- User Profile & Footer Actions -->
        <div class="p-4 border-t-[2.5px] border-black bg-cream-100 space-y-3">
            <div class="p-3 bg-white rounded-xl border-2 border-black shadow-neo-sm flex items-center justify-between">
                <div class="flex items-center space-x-2.5 truncate">
                    <div class="w-8 h-8 rounded-lg bg-pastel-yellow border-1.5 border-black flex items-center justify-center text-xs text-black font-bold shrink-0 shadow-neo-sm">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="text-xs truncate">
                        <div class="text-black font-extrabold truncate">{{ auth()->user()->name }}</div>
                        <div class="text-zinc-500 text-[10px] uppercase font-mono font-bold">{{ auth()->user()->role }}</div>
                    </div>
                </div>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('landing') }}" target="_blank" class="flex-1 text-center py-2 px-3 text-xs font-bold rounded-xl bg-pastel-lime border-2 border-black shadow-neo-sm hover:shadow-neo active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition flex items-center justify-center gap-1.5 text-black">
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> Live Web
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="py-2 px-3.5 text-xs font-bold rounded-xl bg-pastel-pink border-2 border-black shadow-neo-sm hover:shadow-neo active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition text-black" title="Logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto bg-cream-200">
        <!-- Topbar Notification Alerts -->
        @if(session('success'))
            <div class="m-4 mb-0 sm:m-6 sm:mb-0 p-4 rounded-xl bg-pastel-green border-2 border-black shadow-neo text-black font-bold text-xs sm:text-sm flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <span class="w-6 h-6 rounded-full bg-black text-pastel-green flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-check"></i>
                    </span>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="m-4 mb-0 sm:m-6 sm:mb-0 p-4 rounded-xl bg-pastel-pink border-2 border-black shadow-neo text-black font-bold text-xs sm:text-sm flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <span class="w-6 h-6 rounded-full bg-black text-pastel-pink flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-exclamation"></i>
                    </span>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <main class="p-4 sm:p-6 lg:p-8 flex-1 w-full max-w-full">
            @yield('content')
        </main>
    </div>

    <!-- Mobile Drawer Helper Script -->
    <script>
        function toggleMobileSidebar(show) {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('mobileBackdrop');
            
            const isCurrentlyOpen = !sidebar.classList.contains('-translate-x-full');
            const shouldOpen = show !== undefined ? show : !isCurrentlyOpen;

            if (shouldOpen) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }
    </script>
    @yield('scripts')
</body>
</html>
