<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aquafin Portaal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap');
        body { font-family: 'Outfit', sans-serif; }
        
        /* Glassmorphism effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 20px 60px rgba(1, 124, 191, 0.08);
        }
        
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 1);
            box-shadow: 0 25px 70px rgba(1, 124, 191, 0.12);
        }
        /* Zachte geanimeerde achtergrond */
        .bg-soft {
            background: linear-gradient(-45deg, #f0f7ff, #e6f0fa, #f5faff, #eef6fc);
            background-size: 400% 400%;
            animation: gradient 12s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        /* Zachte cirkels */
        .circle-blur {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
            opacity: 0.5;
        }
        
        @media (max-width: 600px) {
            .glass-card { width: 95% !important; margin: 10px auto; border-radius: 20px !important; }
            .p-8 { padding: 20px !important; }
            h1 { font-size: 24px !important; }
            input, button { font-size: 16px !important; padding: 12px !important; }
        }
    </style>
</head>
<body class="bg-soft min-h-screen flex justify-center items-center p-4 relative overflow-hidden">
    <!--Zachte achtergrondcirkels -->
    <div class="circle-blur w-[40%] h-[40%] top-[-10%] left-[-10%]" style="background: radial-gradient(circle, #b3d9ff, transparent 70%);"></div>
    <div class="circle-blur w-[35%] h-[35%] bottom-[-5%] right-[-5%]" style="background: radial-gradient(circle, #c7e6ff, transparent 70%);"></div>
    <div class="circle-blur w-[25%] h-[25%] top-[40%] right-[20%]" style="background: radial-gradient(circle, #d4ecff, transparent 70%);"></div>

    <div class="glass-card rounded-3xl w-[460px] max-w-[95%] overflow-hidden relative transition-all duration-500">
        
        <!-- Header -->
        <div class="bg-gradient-to-br from-[#4a90d9] to-[#2c6aa0] text-white p-7 text-center relative">
            <a href="{{ route('home') }}" class="absolute left-4 top-4 text-white/80 hover:text-white transition-colors flex items-center text-sm font-medium">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Terug
            </a>
            <h1 class="text-3xl font-bold mb-1 mt-4 text-white tracking-wide"> AQUAFIN</h1>
            <p class="text-sm text-white/80 font-light">Portaal voor medewerkers</p>
        </div>
        
        <!-- Body -->
        <div class="p-8">
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 p-4 mb-5 rounded-xl text-sm">
                    <p class="font-semibold"> Fout!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-600 p-4 mb-5 rounded-xl text-sm">
                    <p class="font-semibold"> Succes!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            
            <form method="POST" action="{{ route('login.post') }}">
                @csrf 
                
                <div class="mb-4">
                    <label class="block font-semibold text-[#2c6aa0] mb-2 text-sm"> Emailadres</label>
                    <input type="email" name="email" value="{{ request('email') }}" placeholder="vul je email in" required class="w-full p-3.5 border border-gray-200 rounded-xl focus:outline-none focus:border-[#4a90d9] focus:ring-2 focus:ring-[#4a90d9]/20 transition-all duration-300 bg-white/70">
                </div>
                
                <div class="mb-5">
                    <label class="block font-semibold text-[#2c6aa0] mb-2 text-sm"> Wachtwoord</label>
                    <input type="password" name="wachtwoord" placeholder="vul je wachtwoord in" required class="w-full p-3.5 border border-gray-200 rounded-xl focus:outline-none focus:border-[#4a90d9] focus:ring-2 focus:ring-[#4a90d9]/20 transition-all duration-300 bg-white/70">
                </div>
                
                <button type="submit" class="w-full bg-gradient-to-br from-[#4a90d9] to-[#2c6aa0] text-white p-3.5 rounded-xl font-semibold hover:-translate-y-0.5 transition-all duration-300 shadow-md hover:shadow-lg">
                     Inloggen
                </button>
            </form>
        </div>
    </div>

</body>
</html>