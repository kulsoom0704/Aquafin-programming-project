<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login - Aquafin Portaal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased min-h-screen flex justify-center items-center" style="background: linear-gradient(135deg, #005b96 0%, #003d66 100%);">
    
    <div class="bg-white rounded-2xl shadow-[0_20px_40px_rgba(0,0,0,0.2)] w-[500px] max-w-[95%] overflow-hidden relative">
        
        <div class="bg-gradient-to-br from-[#005b96] to-[#003d66] text-white p-8 text-center relative">
            
            <a href="<?php echo e(route('home')); ?>" class="absolute left-4 top-4 text-white/80 hover:text-white transition-colors flex items-center text-sm font-medium">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Terug
            </a>
            
            <h1 class="text-3xl font-bold mb-2 mt-4"> AQUAFIN</h1>
            <p class="text-sm opacity-90">Portaal voor medewerkers</p>
        </div>
        
        <div class="p-8">
            
            <?php if(session('error')): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                    <p class="font-bold">Fout!</p>
                    <p><?php echo e(session('error')); ?></p>
                </div>
            <?php endif; ?>
            <?php if(session('success')): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                    <p class="font-bold">Succes!</p>
                    <p><?php echo e(session('success')); ?></p>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="<?php echo e(route('login.post')); ?>">
                <?php echo csrf_field(); ?> 
                
                <div class="mb-5">
                    <label class="block font-bold text-[#005b96] mb-2"> Emailadres</label>
                    <input type="email" name="email" value="<?php echo e(request('email')); ?>" placeholder="vul je email in" required class="w-full p-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#005b96] transition-colors">
                </div>
                
                <div class="mb-6">
                    <label class="block font-bold text-[#005b96] mb-2"> Wachtwoord</label>
                    <input type="password" name="wachtwoord" placeholder="vul je wachtwoord in" required class="w-full p-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#005b96] transition-colors">
                </div>
                
                <button type="submit" class="w-full bg-gradient-to-br from-[#005b96] to-[#003d66] text-white p-3 rounded-lg font-bold hover:-translate-y-0.5 transition-transform shadow-md">
                    Inloggen
                </button>
            </form>
            
            <div class="bg-blue-50/50 border border-blue-100 p-4 rounded-lg mt-6 text-sm leading-relaxed">
                <strong class="text-[#005b96] block mb-2"> Demo (Wachtwoord: admin123) :</strong>
                <ul class="space-y-1 text-gray-600">
                    <li>• <strong>Admin :</strong> admin@aquafin.be</li>
                    <li>• <strong>Magazijnier :</strong> magazijnier@aquafin.be</li>
                    <li>• <strong>Technieker 1 :</strong> lukas@aquafin.be</li>
                    <li>• <strong>Technieker 2 :</strong> emma@aquafin.be</li>
                    <li>• <strong>Technieker 3 :</strong> thomas@aquafin.be</li>
                </ul>
            </div>
        </div>
    </div>

</body>
</html><?php /**PATH C:\Users\ramon\Aquafin-programming-project\resources\views/auth/login.blade.php ENDPATH**/ ?>