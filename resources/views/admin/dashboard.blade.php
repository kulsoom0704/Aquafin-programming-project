<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquafin - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Outfit', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex">

    <aside class="w-72 bg-[#005b96] text-white flex flex-col shadow-2xl">
        <div class="p-8">
            <h2 class="text-2xl font-black tracking-tight">AQUAFIN</h2>
            <p class="text-blue-200 text-xs font-bold uppercase tracking-widest mt-1">Admin Portaal</p>
        </div>
        <nav class="flex-grow px-4 space-y-2">
            <a href="/admin/dashboard" class="flex items-center px-4 py-3 rounded-xl bg-white/10 font-bold">📊 Dashboard</a>
            <a href="/admin/users" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium">👥 Gebruikers</a>
            <a href="/admin/reports" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium">📑 Rapporten</a>
        </nav>
    </aside>

    <main class="flex-1 p-10 bg-slate-50">
        <header class="mb-10">
            <h1 class="text-4xl font-black text-slate-900">Dashboard</h1>
            <p class="text-slate-500 font-medium mt-1">Overzicht van gebruikers, installaties en risicoanalyses.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
           <div class="glass-card rounded-3xl p-6 border-t-4 border-blue-500 shadow-sm">
    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Gebruikers</p>
    <h2 class="text-4xl font-extrabold mt-2 text-slate-800">{{ $userCount }}</h2>
</div>

<div class="glass-card rounded-3xl p-6 border-t-4 border-green-500 shadow-sm">
    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Installaties</p>
    <h2 class="text-4xl font-extrabold mt-2 text-slate-800">85%</h2>
</div>

<div class="glass-card rounded-3xl p-6 border-t-4 border-yellow-500 shadow-sm">
    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Onderhoud</p>
    <h2 class="text-4xl font-extrabold mt-2 text-slate-800">10%</h2>
</div>

<a href="/admin/storingen">
    <div class="glass-card rounded-3xl p-6 border-t-4 border-red-500 shadow-sm hover:scale-105 transition cursor-pointer">
        <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Storingen</p>
        <h2 class="text-4xl font-extrabold mt-2 text-slate-800">5%</h2>
    </div>
</a>
        </div>

        <div class="glass-card rounded-3xl p-8 mt-10 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-slate-800">Overstromingsrisico</h2>
                <span class="bg-blue-50 text-[#005b96] px-4 py-1.5 rounded-lg text-xs font-black uppercase tracking-wider border border-blue-100">2026 - 2030</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-slate-400 text-xs uppercase tracking-widest font-bold">
                            <th class="pb-4">Jaar</th>
                            <th class="pb-4">Regenval</th>
                            <th class="pb-4">Risico</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700 font-medium">
                        @foreach($rainfall as $data)
                        <tr class="border-t border-slate-100 hover:bg-slate-50/50 transition">
                            <td class="py-5">{{ $data['year'] }}</td>
                            <td class="py-5">{{ $data['rainfall'] }} mm</td>
                            <td class="py-5">
                                @php $colors = ['Laag' => 'green', 'Gemiddeld' => 'yellow', 'Hoog' => 'red']; @endphp
                                <span class="bg-{{$colors[$data['risk']]}}-50 text-{{$colors[$data['risk']]}}-700 px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $data['risk'] }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>