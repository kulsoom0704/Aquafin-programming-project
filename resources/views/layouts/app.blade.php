<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquafin - @yield('title', 'Dashboard')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');
        
        body { 
            font-family: 'Outfit', sans-serif; 
        }

        /* Fond clair thématique eau */
        .bg-animated {
            background: linear-gradient(-45deg, #f8fafc, #e0f2fe, #f0f9ff, #eff6ff);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            background-attachment: fixed;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Barre de navigation haute visibilité */
        .premium-nav {
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 2px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 91, 150, 0.08);
        }

        /* Cartes internes */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 1);
            box-shadow: 0 10px 30px rgba(1, 124, 191, 0.05);
            border-radius: 1.25rem;
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #005b96; }
    </style>
</head>

<body class="bg-animated text-slate-800 antialiased flex flex-col min-h-screen relative selection:bg-[#005b96] selection:text-white">

    <nav class="premium-nav sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">

                <div class="flex items-center space-x-3">
                    <div class="w-11 h-11 rounded-xl bg-blue-600 flex items-center justify-center shadow-md shadow-blue-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.907c.961 0 1.36 1.233.588 1.81l-3.97 2.883a1 1 0 00-.364 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.971-2.883a1 1 0 00-1.175 0l-3.97 2.883c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118l-3.97-2.883c-.772-.577-.373-1.81.588-1.81h4.906a1 1 0 00.95-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-2xl font-black tracking-tight text-[#005b96] leading-none">AQUAFIN</span>
                        <span class="text-[10px] text-slate-500 font-extrabold uppercase tracking-wider mt-0.5">Technieker Portaal</span>
                    </div>
                </div>

                <div class="hidden md:flex space-x-3 items-center bg-slate-100 p-1.5 rounded-xl border border-slate-200">
                    <a href="{{ route('technieker.meldingen') }}" class="px-5 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 {{ request()->routeIs('technieker.meldingen') ? 'bg-[#005b96] text-white shadow-md shadow-blue-900/10' : 'text-slate-600 hover:text-[#005b96] hover:bg-white/80' }}">
                        Meldingen
                    </a>
                    <a href="{{ route('materiaal.bestellen') }}" class="px-5 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 {{ request()->routeIs('materiaal.bestellen') ? 'bg-[#005b96] text-white shadow-md shadow-blue-900/10' : 'text-slate-600 hover:text-[#005b96] hover:bg-white/80' }}">
                        Materiaal bestellen
                    </a>
                    <a href="{{ route('technieker.historiek') }}" class="px-5 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 {{ request()->routeIs('technieker.historiek') ? 'bg-[#005b96] text-white shadow-md shadow-blue-900/10' : 'text-slate-600 hover:text-[#005b96] hover:bg-white/80' }}">
                        Historiek
                    </a>
                </div>

                <div class="flex items-center space-x-4 pl-4 border-l border-slate-200">
                    <div class="flex flex-col text-right hidden sm:block">
                        <span class="text-sm font-bold text-slate-900">{{ session('naam', 'Technieker') }}</span>
                        <a href="{{ route('logout') }}" class="text-xs text-red-600 hover:text-red-700 font-bold mt-0.5 transition-colors flex items-center justify-end group">
                            <span>Uitloggen</span>
                            <svg class="w-3. h-3 ml-1 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </a>
                    </div>
                    <img class="w-11 h-11 rounded-xl border border-slate-200 shadow-sm object-cover bg-white" src="https://ui-avatars.com/api/?name={{ urlencode(session('naam', 'T')) }}&background=005b96&color=fff&bold=true&font-size=0.4" alt="Avatar">
                </div>

            </div>
        </div>
    </nav>

    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 z-10 relative">
        
        {{-- Alertes Flash --}}
        @if(session('success'))
            <div class="mb-8 bg-emerald-50 border-2 border-emerald-200 text-emerald-900 px-6 py-4 rounded-xl flex items-center shadow-sm">
                <div class="bg-emerald-500 text-white p-1.5 rounded-lg mr-4 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <p class="font-bold text-sm">Succes!</p>
                    <p class="text-sm opacity-90">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 bg-rose-50 border-2 border-rose-200 text-rose-900 px-6 py-4 rounded-xl flex items-center shadow-sm">
                <div class="bg-rose-500 text-white p-1.5 rounded-lg mr-4 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <p class="font-bold text-sm">Foutmelding</p>
                    <p class="text-sm opacity-90">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @yield('content')
        
    </main>

</body>
</html>