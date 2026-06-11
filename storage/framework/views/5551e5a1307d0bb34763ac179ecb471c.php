<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Aquafin - Premium Portaal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap');
        
        body { 
            font-family: 'Outfit', sans-serif; 
        }
        
        /* Effet Glassmorphism version claire (Apple Style) */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 1);
            box-shadow: 0 10px 40px rgba(1, 124, 191, 0.08);
        }
        
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(1, 124, 191, 0.2);
            box-shadow: 0 15px 50px rgba(1, 124, 191, 0.15);
        }
        
        /* Fond animé clair et frais (Thème Eau) */
        .bg-animated {
            background: linear-gradient(-45deg, #f8fafc, #e0f2fe, #f0f9ff, #eff6ff);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="bg-animated min-h-screen flex flex-col justify-center items-center p-6 relative overflow-hidden text-slate-800">

    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full bg-blue-300/30 blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-cyan-300/20 blur-[100px] pointer-events-none"></div>

    <div class="text-center mb-16 z-10 relative">
        <h1 class="text-6xl md:text-7xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#005b96] to-cyan-500 tracking-tighter mb-4 drop-shadow-sm">AQUAFIN</h1>
        <p class="text-slate-500 text-lg md:text-xl font-medium tracking-wide uppercase letter-spacing-2">Enterprise Operations Portal</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-10 max-w-6xl w-full z-10 relative">
        
        
        <a href="<?php echo e(route('login', ['email' => 'lukas@aquafin.be'])); ?>" class="glass-card rounded-3xl p-8 flex flex-col items-center text-center group transition-all duration-500 hover:-translate-y-3">
            <div class="w-24 h-24 rounded-full bg-blue-50 flex items-center justify-center mb-8 group-hover:scale-110 group-hover:bg-blue-100 transition-all duration-500 relative shadow-inner">
                <div class="absolute inset-0 rounded-full border border-blue-200 group-hover:border-blue-400 group-hover:animate-[spin_4s_linear_infinite]"></div>
                <svg class="w-10 h-10 text-[#005b96]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 mb-3 tracking-wide">Technieker</h2>
            <p class="text-slate-500 text-sm leading-relaxed font-medium">Beheer installaties, logboeken en bestellingen in real-time.</p>
            <div class="mt-8 flex items-center text-[#005b96] text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-500 translate-y-2 group-hover:translate-y-0">
                Direct Inloggen <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </div>
        </a>

        
        <a href="<?php echo e(route('login', ['email' => 'magazijnier@aquafin.be'])); ?>" class="glass-card rounded-3xl p-8 flex flex-col items-center text-center group transition-all duration-500 hover:-translate-y-3">
            <div class="w-24 h-24 rounded-full bg-orange-50 flex items-center justify-center mb-8 group-hover:scale-110 group-hover:bg-orange-100 transition-all duration-500 relative shadow-inner">
                <div class="absolute inset-0 rounded-full border border-orange-200 group-hover:border-orange-400 group-hover:animate-[spin_4s_linear_infinite_reverse]"></div>
                <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 mb-3 tracking-wide">Magazijnier</h2>
            <p class="text-slate-500 text-sm leading-relaxed font-medium">Voorraadbeheer, inkomende leveringen en retourzendingen.</p>
            <div class="mt-8 flex items-center text-orange-600 text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-500 translate-y-2 group-hover:translate-y-0">
                Direct Inloggen <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </div>
        </a>

        
        <a href="<?php echo e(route('login', ['email' => 'admin@aquafin.be'])); ?>" class="glass-card rounded-3xl p-8 flex flex-col items-center text-center group transition-all duration-500 hover:-translate-y-3">
            <div class="w-24 h-24 rounded-full bg-purple-50 flex items-center justify-center mb-8 group-hover:scale-110 group-hover:bg-purple-100 transition-all duration-500 relative shadow-inner">
                <div class="absolute inset-0 rounded-full border border-purple-200 group-hover:border-purple-400 group-hover:animate-[spin_4s_linear_infinite]"></div>
                <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 mb-3 tracking-wide">Admin</h2>
            <p class="text-slate-500 text-sm leading-relaxed font-medium">Volledig dashboard, systeemconfiguratie en gebruikersbeheer.</p>
            <div class="mt-8 flex items-center text-purple-600 text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-500 translate-y-2 group-hover:translate-y-0">
                Direct Inloggen <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </div>
        </a>

    </div>
</body>
</html><?php /**PATH C:\Users\ramon\Aquafin-programming-project\resources\views/portal.blade.php ENDPATH**/ ?>