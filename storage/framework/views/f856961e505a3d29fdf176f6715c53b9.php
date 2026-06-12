<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquafin - <?php echo $__env->yieldContent('title', 'Dashboard'); ?></title>
    
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

                <!-- 🟢 NOUVEL ORDRE DES BOUTONS -->
                <div class="hidden md:flex space-x-3 items-center bg-slate-100 p-1.5 rounded-xl border border-slate-200">
                    <a href="<?php echo e(route('materiaal.bestellen')); ?>" class="px-5 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 <?php echo e(request()->routeIs('materiaal.bestellen') ? 'bg-[#005b96] text-white shadow-md shadow-blue-900/10' : 'text-slate-600 hover:text-[#005b96] hover:bg-white/80'); ?>">
                        Materiaal bestellen
                    </a>
                    <a href="<?php echo e(route('technieker.historiek')); ?>" class="px-5 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 <?php echo e(request()->routeIs('technieker.historiek') ? 'bg-[#005b96] text-white shadow-md shadow-blue-900/10' : 'text-slate-600 hover:text-[#005b96] hover:bg-white/80'); ?>">
                        Historiek
                    </a>
                    <a href="<?php echo e(route('technieker.meldingen')); ?>" class="px-5 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 <?php echo e(request()->routeIs('technieker.meldingen') ? 'bg-[#005b96] text-white shadow-md shadow-blue-900/10' : 'text-slate-600 hover:text-[#005b96] hover:bg-white/80'); ?>">
                        Meldingen
                    </a>
                </div>

                <div class="flex items-center space-x-4 pl-4 border-l border-slate-200">
                    <div class="flex flex-col text-right hidden sm:block">
                        <span class="text-sm font-bold text-slate-900"><?php echo e(session('naam', 'Technieker')); ?></span>
                        <a href="<?php echo e(route('logout')); ?>" class="text-xs text-red-600 hover:text-red-700 font-bold mt-0.5 transition-colors flex items-center justify-end group">
                            <span>Uitloggen</span>
                            <svg class="w-3. h-3 ml-1 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </a>
                    </div>
                    <img class="w-11 h-11 rounded-xl border border-slate-200 shadow-sm object-cover bg-white" src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(session('naam', 'T'))); ?>&background=005b96&color=fff&bold=true&font-size=0.4" alt="Avatar">
                </div>

            </div>
        </div>
    </nav>

    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 z-10 relative">
        
        
        <?php if(session('success')): ?>
            <div class="mb-8 bg-emerald-50 border-2 border-emerald-200 text-emerald-900 px-6 py-4 rounded-xl flex items-center shadow-sm">
                <div class="bg-emerald-500 text-white p-1.5 rounded-lg mr-4 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <p class="font-bold text-sm">Succes!</p>
                    <p class="text-sm opacity-90"><?php echo e(session('success')); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="mb-8 bg-rose-50 border-2 border-rose-200 text-rose-900 px-6 py-4 rounded-xl flex items-center shadow-sm">
                <div class="bg-rose-500 text-white p-1.5 rounded-lg mr-4 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <p class="font-bold text-sm">Foutmelding</p>
                    <p class="text-sm opacity-90"><?php echo e(session('error')); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
        
    </main>

    <div id="support-widget" class="fixed bottom-6 right-6 z-[100] flex flex-col items-end">
        
        <div id="chat-panel" class="hidden w-80 sm:w-96 glass-card rounded-2xl overflow-hidden mb-4 shadow-2xl transition-all origin-bottom-right border border-white/50">
            
            <div class="bg-gradient-to-r from-[#005b96] to-cyan-500 p-4 flex justify-between items-center text-white shadow-md">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/30">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <span class="block font-bold leading-tight">Aquafin Support</span>
                        <span class="block text-[10px] text-cyan-100 uppercase tracking-widest font-semibold">Live Dispatch</span>
                    </div>
                </div>
                <button onclick="toggleChat()" class="text-white/80 hover:text-white hover:rotate-90 transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-5 bg-white/60 backdrop-blur-xl">
                <p class="text-sm text-slate-600 mb-5 font-medium leading-relaxed">Heb je dringend hulp nodig op de werkvloer? Stuur direct een noodoproep naar het magazijn of de admin.</p>
                
                <form id="emergency-chat-form" onsubmit="sendEmergencyMessage(event)">
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Type probleem</label>
                        <select name="type" required class="w-full bg-white border border-slate-200 text-slate-700 text-sm py-2.5 px-3 rounded-xl focus:outline-none focus:border-[#005b96] focus:ring-2 focus:ring-blue-100 transition-all shadow-sm">
                            <option value="" disabled selected>Selecteer de urgentie...</option>
                            <option value="Materiaal onverwacht defect">Materiaal onverwacht defect</option>
                            <option value="Dringende stockaanvulling nodig">Dringende stockaanvulling nodig</option>
                            <option value="Technisch advies nodig (Admin)">Technisch advies nodig (Admin)</option>
                            <option value="Andere noodsituatie">Andere noodsituatie</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Jouw Bericht</label>
                        <textarea name="bericht" required rows="3" placeholder="Beschrijf de situatie kort en bondig..." class="w-full bg-white border border-slate-200 text-slate-700 text-sm py-2.5 px-3 rounded-xl focus:outline-none focus:border-[#005b96] focus:ring-2 focus:ring-blue-100 transition-all shadow-sm resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full py-3 bg-[#005b96] hover:bg-blue-800 text-white font-bold rounded-xl text-sm transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5 flex justify-center items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        Verstuur Noodoproep
                    </button>
                </form>
            </div>
            
            <div id="chat-success" class="hidden p-8 text-center bg-white/80 backdrop-blur-xl">
                <div class="w-20 h-20 bg-emerald-100 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h3 class="text-xl font-extrabold text-slate-800 mb-2">Oproep verzonden!</h3>
                <p class="text-sm text-slate-500 mb-6 font-medium">De dispatch heeft je bericht ontvangen. We nemen zo snel mogelijk contact met je op.</p>
                <button onclick="toggleChat()" class="px-6 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors">Sluiten</button>
            </div>
        </div>

        <button onclick="toggleChat()" class="w-16 h-16 bg-gradient-to-r from-[#005b96] to-cyan-500 text-white rounded-full flex items-center justify-center shadow-[0_10px_25px_rgba(0,91,150,0.4)] hover:shadow-[0_15px_35px_rgba(0,91,150,0.6)] hover:scale-110 transition-all duration-300 group z-50">
            <svg class="w-7 h-7 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        </button>
    </div>

    <script>
        function toggleChat() {
            const panel = document.getElementById('chat-panel');
            const formContainer = document.getElementById('emergency-chat-form').parentElement;
            const successContainer = document.getElementById('chat-success');
            
            if (panel.classList.contains('hidden')) {
                panel.classList.remove('hidden');
                formContainer.classList.remove('hidden');
                successContainer.classList.add('hidden');
                document.getElementById('emergency-chat-form').reset();
            } else {
                panel.classList.add('hidden');
            }
        }

        
        function sendEmergencyMessage(event) {
            event.preventDefault(); 
            
            const form = document.getElementById('emergency-chat-form');
            const formData = new FormData(form);

            
            fetch("<?php echo e(route('support.noodoproep')); ?>", {
                method: "POST",
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' 
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    
                    const formContainer = form.parentElement;
                    const successContainer = document.getElementById('chat-success');
                    formContainer.classList.add('hidden');
                    successContainer.classList.remove('hidden');
                    
                    setTimeout(() => {
                        if (!document.getElementById('chat-panel').classList.contains('hidden')) {
                            toggleChat();
                        }
                    }, 4000);
                } else {
                    alert('Er is iets fout gegaan bij het versturen.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Netwerkfout opgetreden.');
            });
        }
    </script>
</body>
</html><?php /**PATH C:\Users\ramon\Aquafin-programming-project\resources\views/layouts/app.blade.php ENDPATH**/ ?>