<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - gampil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#FAF7F2',
                        pastel: {
                            purple: '#E9D5FF',
                            orange: '#FED7AA',
                            green: '#BBF7D0',
                            lime: '#CCFF00',
                            pink: '#FBCFE8',
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800;900&family=Space+Mono:wght@700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAF7F2;
            background-image: radial-gradient(#000000 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .font-mono {
            font-family: 'Space Mono', monospace;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 selection:bg-pastel-lime selection:text-black">

    <div class="w-full max-w-md bg-[#FFFDF9] border-[3px] border-black rounded-3xl p-6 sm:p-8 shadow-neo-xl relative">
        
        <!-- Top decorative badge -->
        <div class="flex justify-between items-center mb-6">
            <span class="px-2.5 py-1 bg-pastel-purple border-2 border-black rounded-lg text-[10px] font-mono font-bold uppercase shadow-neo-sm">
                RESTRICTED AREA
            </span>
            <span class="px-2.5 py-1 bg-pastel-lime border-2 border-black rounded-lg text-[10px] font-mono font-bold uppercase shadow-neo-sm">
                <i class="fa-solid fa-lock text-[9px] mr-1"></i> SSL 256-BIT
            </span>
        </div>

        <!-- Logo & Heading -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto rounded-2xl bg-pastel-lime border-[2.5px] border-black shadow-neo flex items-center justify-center font-black text-black text-3xl mb-4">
                G
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-black tracking-tight">gampil<span class="text-purple-600">.</span></h1>
            <p class="text-xs text-zinc-600 font-mono font-bold mt-1">OPERATOR ACCESS CONSOLE</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-3.5 rounded-xl bg-pastel-pink border-2 border-black shadow-neo-sm text-black text-xs font-bold flex items-center space-x-2.5">
                <span class="w-5 h-5 rounded-full bg-black text-pastel-pink flex items-center justify-center text-[10px] shrink-0">
                    <i class="fa-solid fa-xmark"></i>
                </span>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">
                    Email Operator
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-black pointer-events-none font-bold">
                        <i class="fa-solid fa-envelope text-sm"></i>
                    </span>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@r4ven.local" required autofocus
                           class="w-full pl-10 pr-4 py-3 bg-white border-2 border-black rounded-xl text-sm font-bold text-black focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm transition placeholder-zinc-400">
                </div>
            </div>

            <div>
                <label for="password" class="block text-xs font-black text-black mb-1.5 uppercase tracking-wider">
                    Security Password
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-black pointer-events-none font-bold">
                        <i class="fa-solid fa-key text-sm"></i>
                    </span>
                    <input type="password" id="password" name="password" placeholder="••••••••" required
                           class="w-full pl-10 pr-4 py-3 bg-white border-2 border-black rounded-xl text-sm font-bold text-black focus:outline-none focus:bg-pastel-yellow/30 shadow-neo-sm transition placeholder-zinc-400">
                </div>
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center text-black font-bold cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-2 border-black text-black focus:ring-0">
                    <span class="ml-2">Remember session</span>
                </label>
                <span class="text-[11px] text-zinc-500 font-mono">2FA Ready</span>
            </div>

            <button type="submit" class="w-full mt-4 py-3.5 px-4 bg-pastel-lime hover:bg-pastel-limeDark active:translate-x-0.5 active:translate-y-0.5 active:shadow-none text-black font-black text-sm uppercase tracking-wider rounded-xl border-2 border-black shadow-neo transition">
                <i class="fa-solid fa-arrow-right-to-bracket mr-1.5"></i> Authenticate & Enter
            </button>
        </form>

        <div class="mt-6 pt-4 border-t-2 border-dashed border-black/30 text-center">
            <span class="text-[11px] font-mono font-bold text-zinc-500">
                &copy; {{ date('Y') }} Gampil Akses • Telemetry Platform
            </span>
        </div>
    </div>

</body>
</html>
