<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Aquafin - Logistiek Portaal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;900&display=swap');
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-4 md:p-8 selection:bg-[#017CBF] selection:text-white">

    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-[20%] -right-[10%] w-[70vw] h-[70vw] bg-[#017CBF]/10 rounded-full blur-[100px]"></div>
        <div class="absolute -bottom-[20%] -left-[10%] w-[60vw] h-[60vw] bg-[#131236]/5 rounded-full blur-[80px]"></div>
    </div>

    <div class="w-full max-w-5xl bg-white rounded-[2rem] md:rounded-[3rem] shadow-[0_20px_80px_-20px_rgba(0,0,0,0.1)] overflow-hidden flex flex-col md:flex-row relative z-10">
        
        <div class="hidden sm:flex w-full md:w-5/12 bg-[#131236] p-10 lg:p-14 flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#017CBF] opacity-20 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
            
            <div class="relative z-10">
                <div class="w-14 h-14 bg-[#017CBF] rounded-2xl flex items-center justify-center shadow-lg shadow-[#017CBF]/30 mb-8">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.25c-2.485 5.517-5.25 9.774-5.25 13.5a5.25 5.25 0 0010.5 0c0-3.726-2.765-7.983-5.25-13.5z"></path>
                    </svg>
                </div>
                
                <h2 class="text-3xl lg:text-4xl font-black text-white tracking-tight leading-[1.1] mb-6">
                    Logistiek<br><span class="text-[#017CBF]">Portaal.</span>
                </h2>
                <p class="text-slate-300 font-medium text-sm leading-relaxed max-w-[250px]">
                    Het centraal beheerplatform voor materiaal en technische interventies.
                </p>
            </div>

            <div class="relative z-10 mt-12">
                <div class="inline-flex items-center gap-3 bg-white/5 backdrop-blur-sm px-4 py-2.5 rounded-xl border border-white/10">
                    <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                    <span class="text-xs font-bold text-white uppercase tracking-wider">Systeem Actief</span>
                </div>
            </div>
        </div>

        <div class="w-full md:w-7/12 p-8 sm:p-12 lg:p-16 flex flex-col justify-center">
            
            <div class="sm:hidden w-12 h-12 bg-[#017CBF] rounded-xl flex items-center justify-center shadow-lg shadow-[#017CBF]/30 mb-8">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.25c-2.485 5.517-5.25 9.774-5.25 13.5a5.25 5.25 0 0010.5 0c0-3.726-2.765-7.983-5.25-13.5z"></path></svg>
            </div>

            <div class="mb-10">
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Welkom terug</h1>
                <p class="text-sm text-slate-500 font-medium mt-2">Log in met je e-mailadres en wachtwoord.</p>
            </div>

            @if ($errors->any())
                <div class="mb-8 flex items-start gap-3 p-4 bg-rose-50 rounded-2xl border border-rose-100">
                    <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <span class="text-sm font-bold text-rose-700">{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2 pl-1">E-mailadres</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-semibold placeholder-slate-400 focus:bg-white focus:border-[#017CBF] focus:ring-4 focus:ring-[#017CBF]/10 outline-none transition-all"
                        placeholder="naam@aquafin.be">
                </div>

                <div>
                    <div class="flex justify-between items-end mb-2 pl-1 pr-1">
                        <label for="wachtwoord" class="block text-xs font-bold text-slate-700 uppercase tracking-wide">Wachtwoord</label>
                        <a href="#" class="text-[11px] font-bold text-[#017CBF] hover:text-[#131236] transition-colors">Vergeten?</a>
                    </div>
                    <input type="password" id="wachtwoord" name="wachtwoord" required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-semibold placeholder-slate-400 focus:bg-white focus:border-[#017CBF] focus:ring-4 focus:ring-[#017CBF]/10 outline-none transition-all"
                        placeholder="••••••••">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-[#131236] hover:bg-[#017CBF] text-white font-bold text-sm py-4 rounded-2xl shadow-lg shadow-slate-200 active:scale-[0.98] transition-all duration-300 flex justify-center items-center gap-2 group">
                        Inloggen
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </button>
                </div>
            </form>

            <div class="mt-8 sm:mt-12 text-center">
                <p class="text-xs font-semibold text-slate-400">© 2026 Aquafin NV. Alle rechten voorbehouden.</p>
            </div>

        </div>
    </div>

</body>
</html>