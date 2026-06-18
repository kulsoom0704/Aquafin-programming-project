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
        
        /* Achtergrond donkerblauw */
        .bg-darkblue {
            background: linear-gradient(-45deg, #0a1628, #0f2847, #1a3a6b, #0a1628);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /*  Druppel animatie - donkerblauw */
        .drop {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(100, 180, 255, 0.3), rgba(0, 30, 60, 0.6));
            box-shadow: inset 0 0 20px rgba(0, 50, 100, 0.3), 0 0 30px rgba(0, 100, 200, 0.1);
            animation: fall linear infinite;
            pointer-events: none;
            border: 1px solid rgba(100, 180, 255, 0.1);
        }
        
        .drop::after {
            content: '';
            position: absolute;
            top: 15%;
            left: 25%;
            width: 30%;
            height: 30%;
            background: radial-gradient(circle, rgba(150, 210, 255, 0.3), transparent);
            border-radius: 50%;
        }
        
        @keyframes fall {
            0% { transform: translateY(-100px) scale(0.5); opacity: 0; }
            10% { opacity: 0.6; }
            90% { opacity: 0.6; }
            100% { transform: translateY(calc(100vh + 100px)) scale(1.2); opacity: 0; }
        }
        
        .drop:nth-child(1) { left: 5%; width: 60px; height: 70px; animation-duration: 8s; animation-delay: 0s; }
        .drop:nth-child(2) { left: 15%; width: 35px; height: 40px; animation-duration: 6s; animation-delay: 2s; }
        .drop:nth-child(3) { left: 25%; width: 80px; height: 90px; animation-duration: 10s; animation-delay: 1s; }
        .drop:nth-child(4) { left: 40%; width: 45px; height: 50px; animation-duration: 7s; animation-delay: 3s; }
        .drop:nth-child(5) { left: 55%; width: 70px; height: 80px; animation-duration: 9s; animation-delay: 0.5s; }
        .drop:nth-child(6) { left: 70%; width: 30px; height: 35px; animation-duration: 5s; animation-delay: 4s; }
        .drop:nth-child(7) { left: 85%; width: 90px; height: 100px; animation-duration: 11s; animation-delay: 2.5s; }
        .drop:nth-child(8) { left: 95%; width: 50px; height: 55px; animation-duration: 7.5s; animation-delay: 1.5s; }
        .drop:nth-child(9) { left: 10%; width: 25px; height: 30px; animation-duration: 5.5s; animation-delay: 3.5s; }
        .drop:nth-child(10) { left: 75%; width: 40px; height: 45px; animation-duration: 6.5s; animation-delay: 4.5s; }
        .drop:nth-child(11) { left: 35%; width: 55px; height: 60px; animation-duration: 8.5s; animation-delay: 2s; }
        .drop:nth-child(12) { left: 60%; width: 65px; height: 75px; animation-duration: 9.5s; animation-delay: 0.8s; }
        
        /* Cirkels */
        .circle-blur {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
            opacity: 0.3;
        }
        
        @media (max-width: 600px) {
            .glass-card { width: 95% !important; margin: 10px auto; border-radius: 20px !important; }
            .p-8 { padding: 20px !important; }
            h1 { font-size: 24px !important; }
            input, button { font-size: 16px !important; padding: 12px !important; }
            .drop { display: none; }
        }
    </style>
</head>
<body class="bg-darkblue min-h-screen flex justify-center items-center p-4 relative overflow-hidden">

    <!-- 💧 Waterdruppels donkerblauw -->
    <div class="drop"></div>
    <div class="drop"></div>
    <div class="drop"></div>
    <div class="drop"></div>
    <div class="drop"></div>
    <div class="drop"></div>
    <div class="drop"></div>
    <div class="drop"></div>
    <div class="drop"></div>
    <div class="drop"></div>
    <div class="drop"></div>
    <div class="drop"></div>

    <!-- Cirkels donkerblauw -->
    <div class="circle-blur w-[40%] h-[40%] top-[-10%] left-[-10%]" style="background: radial-gradient(circle, #1a4a7a, transparent 70%);"></div>
    <div class="circle-blur w-[35%] h-[35%] bottom-[-5%] right-[-5%]" style="background: radial-gradient(circle, #0f2847, transparent 70%);"></div>
    <div class="circle-blur w-[25%] h-[25%] top-[40%] right-[20%]" style="background: radial-gradient(circle, #2d6bb8, transparent 70%);"></div>

    <div class="glass-card rounded-3xl w-[460px] max-w-[95%] overflow-hidden relative transition-all duration-500" style="z-index: 10;">
        
        <!-- Header -->
        <div class="bg-gradient-to-br from-[#0a1628] to-[#1a3a6b] text-white p-7 text-center relative">
            <h1 class="text-3xl font-bold mb-1 mt-4 text-white tracking-wide"> AQUAFIN</h1>
            <p class="text-sm text-white/70 font-light">Portaal voor medewerkers</p>
        </div>
        
        <!-- Body -->
        <div class="p-8 bg-white/90">
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
                    <label class="block font-semibold text-[#0a1628] mb-2 text-sm"> Emailadres</label>
                    <input type="email" name="email" value="{{ request('email') }}" placeholder="vul je email in" required class="w-full p-3.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-[#1a3a6b] focus:ring-2 focus:ring-[#1a3a6b]/20 transition-all duration-300 bg-white/80">
                </div>
                
                <div class="mb-5">
                    <label class="block font-semibold text-[#0a1628] mb-2 text-sm"> Wachtwoord</label>
                    <input type="password" name="wachtwoord" placeholder="vul je wachtwoord in" required class="w-full p-3.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-[#1a3a6b] focus:ring-2 focus:ring-[#1a3a6b]/20 transition-all duration-300 bg-white/80">
                </div>
                
                <button type="submit" class="w-full bg-gradient-to-br from-[#0a1628] to-[#1a3a6b] text-white p-3.5 rounded-xl font-semibold hover:-translate-y-0.5 transition-all duration-300 shadow-md hover:shadow-lg">
                     Inloggen
                </button>
            </form>
        </div>
    </div>

</body>
</html>