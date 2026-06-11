<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Account aanmaken - Aquafin</title>
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
<body class="bg-animated min-h-screen flex justify-center items-center p-6 relative overflow-hidden">

    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full blur-[100px] pointer-events-none bg-blue-300/30"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full blur-[100px] pointer-events-none bg-cyan-300/20"></div>

    <div class="glass-card rounded-3xl w-[500px] max-w-[95%] overflow-hidden relative transition-all duration-500">
        
        <div class="bg-gradient-to-br from-[#60a5fa] to-[#3b82f6] p-8 text-center relative">
            <a href="{{ route('login') }}" class="absolute left-4 top-4 text-white/80 hover:text-white transition-colors flex items-center text-sm font-medium">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Terug
            </a>
            <h1 class="text-3xl font-bold mb-2 mt-4 text-white"> AQUAFIN</h1>
            <p class="text-sm text-white/90">Account aanmaken</p>
        </div>
        
        <div class="p-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-xl">
                    <p class="font-bold"> Succes!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            
            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-xl">
                    <p class="font-bold"> Fout!</p>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="{{ route('register.post') }}">
                @csrf 
                
                <div class="mb-5">
                    <label class="block font-bold text-blue-600 mb-2"> Volledige naam</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="bv. Jan Janssens" required class="w-full p-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition-all duration-300">
                </div>
                
                <div class="mb-5">
                    <label class="block font-bold text-blue-600 mb-2"> Emailadres</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="bv. jan@aquafin.be" required class="w-full p-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition-all duration-300">
                </div>
                
                <div class="mb-5">
                    <label class="block font-bold text-blue-600 mb-2"> Wachtwoord</label>
                    <input type="password" name="password" placeholder="minimaal 4 tekens" required class="w-full p-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition-all duration-300">
                </div>
                
                <div class="mb-6">
                    <label class="block font-bold text-blue-600 mb-2"> Bevestig wachtwoord</label>
                    <input type="password" name="password_confirmation" placeholder="typ hetzelfde wachtwoord" required class="w-full p-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition-all duration-300">
                </div>
                
                <button type="submit" class="w-full bg-gradient-to-br from-[#60a5fa] to-[#3b82f6] text-white p-3 rounded-xl font-bold hover:-translate-y-0.5 transition-all duration-300 shadow-md hover:shadow-lg">
                     Account aanmaken
                </button>
            </form>
        </div>
    </div>

</body>
</html>