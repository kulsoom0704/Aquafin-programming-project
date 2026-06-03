<!DOCTYPE html>
<html lang="nl">
<head>
    {{--
        Bestand: resources/views/layouts/app.blade.php
        Doel: Globale layout voor de technieker sectie. Bevat de navigatie,
        hoofdstructuur en Tailwind-config. 
    --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquafin - @yield('title', 'Dashboard')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        aquaBlue: '#017CBF',
                        aquaDark: '#131236',
                        beigeSoft: '#F8F9FA', // Plus neutre, façon "galerie"
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #017CBF; }
        
        /* Achtergrondraster voor een professionele/technische look */
        .bg-grid {
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 32px 32px;
        }
    </style>
</head>
<body class="bg-beigeSoft text-gray-800 font-sans antialiased flex flex-col min-h-screen relative selection:bg-aquaBlue selection:text-white">

    <div class="absolute inset-0 z-0 bg-grid opacity-50 pointer-events-none"></div>

    <nav class="bg-aquaDark/95 backdrop-blur-md text-white border-b border-white/10 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-br from-aquaBlue to-blue-600 text-white p-2.5 rounded-xl shadow-[0_0_15px_rgba(1,124,191,0.5)] border border-white/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-2xl font-extrabold tracking-widest text-white leading-none drop-shadow-md">AQUAFIN</span>
                        <span class="text-[10px] text-aquaBlue font-bold uppercase tracking-widest mt-1">Technieker</span>
                    </div>
                </div>

                <div class="hidden md:flex space-x-2 items-center bg-black/20 p-1.5 rounded-2xl border border-white/5 backdrop-blur-sm">
                    <a href="{{ route('technieker.meldingen') }}" class="group flex items-center space-x-2 px-5 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('technieker.meldingen') ? 'bg-white/10 text-white shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <span class="font-medium text-sm">Meldingen</span>
                    </a>
                    <a href="{{ route('materiaal.bestellen') }}" class="group flex items-center space-x-2 px-5 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('materiaal.bestellen') ? 'bg-white/10 text-white shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <span class="font-medium text-sm">Materiaal</span>
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="flex flex-col text-right hidden sm:block">
                        <span class="text-sm font-bold text-white">Lukas Peeters</span>
                    </div>
                    <img class="w-10 h-10 rounded-full border-2 border-aquaBlue/50 object-cover" src="https://ui-avatars.com/api/?name=Lukas+Peeters&background=017CBF&color=fff&bold=true" alt="Avatar">
                </div>

            </div>
        </div>
    </nav>

    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 z-10">
        @yield('content')
    </main>

</body>
</html>