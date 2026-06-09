<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login - Aquafin Portaal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap');
        body { font-family: 'Outfit', sans-serif; }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 1);
            box-shadow: 0 10px 40px rgba(1, 124, 191, 0.08);
        }
        
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
<?php
    $kleur = request('kleur', 'blauw');
    
    if ($kleur == 'oranje') {
        $hoofd_kleur = '#f97316';
        $gradient_from = '#f97316';
        $gradient_to = '#ea580c';
    } elseif ($kleur == 'paars') {
        $hoofd_kleur = '#c084fc';
        $gradient_from = '#c084fc';
        $gradient_to = '#a855f7';
    } else {
        $hoofd_kleur = '#60a5fa';
        $gradient_from = '#60a5fa';
        $gradient_to = '#3b82f6';
    }
?>
<body class="bg-animated min-h-screen flex justify-center items-center p-6 relative overflow-hidden">
    
    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full blur-[100px] pointer-events-none" style="background: <?php echo $hoofd_kleur; ?>30"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full blur-[100px] pointer-events-none" style="background: <?php echo $hoofd_kleur; ?>20"></div>

    <div class="glass-card rounded-3xl w-[500px] max-w-[95%] overflow-hidden relative transition-all duration-500">
        
        <div class="bg-gradient-to-br p-8 text-center relative" style="background: linear-gradient(135deg, <?php echo $gradient_from; ?>, <?php echo $gradient_to; ?>);">
            <a href="{{ route('home') }}" class="absolute left-4 top-4 text-white/80 hover:text-white transition-colors flex items-center text-sm font-medium">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Terug
            </a>
            <h1 class="text-3xl font-bold mb-2 mt-4 text-white"> AQUAFIN</h1>
            <p class="text-sm text-white/90">Portaal voor medewerkers</p>
        </div>
        
        <div class="p-8">
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-xl">
                    <p class="font-bold"> Fout!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            
            <form method="POST" action="{{ route('login.post') }}">
                @csrf 
                
                <div class="mb-5">
                    <label class="block font-bold mb-2" style="color: <?php echo $hoofd_kleur; ?>;"> Emailadres</label>
                    <input type="email" name="email" value="{{ request('email') }}" placeholder="vul je email in" required class="w-full p-3 border-2 border-gray-200 rounded-xl focus:outline-none transition-all duration-300 focus:shadow-md" style="focus:border-color: <?php echo $hoofd_kleur; ?>;">
                </div>
                
                <div class="mb-6">
                    <label class="block font-bold mb-2" style="color: <?php echo $hoofd_kleur; ?>;"> Wachtwoord</label>
                    <input type="password" name="wachtwoord" placeholder="vul je wachtwoord in" required class="w-full p-3 border-2 border-gray-200 rounded-xl focus:outline-none transition-all duration-300">
                </div>
                
                <button type="submit" class="w-full text-white p-3 rounded-xl font-bold hover:-translate-y-0.5 transition-all duration-300 shadow-md hover:shadow-lg" style="background: linear-gradient(135deg, <?php echo $gradient_from; ?>, <?php echo $gradient_to; ?>);">
                     Inloggen
                </button>
            </form>
            
            <div class="bg-blue-50/50 border border-blue-100 rounded-xl p-4 mt-6 text-sm leading-relaxed">
                <strong class="block mb-2" style="color: <?php echo $hoofd_kleur; ?>;"> Demo (Wachtwoord: admin123) :</strong>
                <ul class="space-y-1 text-gray-600">
                    <?php if ($kleur == 'paars'): ?>
                        <li>• <strong style="color: #c084fc;">Admin :</strong> admin@aquafin.be</li>
                    <?php elseif ($kleur == 'oranje'): ?>
                        <li>• <strong style="color: #f97316;">Magazijnier :</strong> magazijnier@aquafin.be</li>
                    <?php else: ?>
                        <li>• <strong style="color: #60a5fa;">Technieker :</strong> lukas@aquafin.be</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

</body>
</html>