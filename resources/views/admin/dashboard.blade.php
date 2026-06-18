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

    <!-- Zijbalk -->
    <aside class="w-72 bg-[#005b96] text-white flex flex-col shadow-2xl">
        <div class="p-8">
            <h2 class="text-2xl font-black tracking-tight">AQUAFIN</h2>
            <p class="text-blue-200 text-xs font-bold uppercase tracking-widest mt-1">Admin Portaal</p>
        </div>
        <nav class="flex-grow px-4 space-y-2">
            <a href="/admin/dashboard" class="flex items-center px-4 py-3 rounded-xl bg-white/10 font-bold"> Dashboard</a>
            <a href="/admin/users" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium">Gebruikers</a>
            <a href="/admin/reports" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium">Rapporten</a>
            <a href="/admin/storingen" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium">Storingen</a>
            <a href="/admin/helpdesk"   class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium"> Helpdesk</a>
            </nav>
            <div class="p-4">
    <a href="/logout"
       class="block text-center bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-xl transition">
         Uitloggen
    </a>
</div>
    </aside>

        <!-- Main content --> 
   <main class="flex-1 p-10 bg-slate-50">

    <header class="mb-10">
        <h1 class="text-4xl font-black text-slate-900">
            Dashboard
        </h1>

        <p class="text-slate-500 font-medium mt-1">
            Overzicht van gebruikers, installaties en risicoanalyses.
        </p>
    </header>


    <!-- Statistiek kaarten -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <a href="/admin/users">
            <div class="glass-card rounded-3xl p-6 border-t-4 border-blue-500 shadow-sm hover:scale-105 transition cursor-pointer">
                <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">
                    Gebruikers
                </p>

                <h2 class="text-4xl font-extrabold mt-2 text-slate-800">
                    {{ $userCount }}
                </h2>
            </div>
        </a>

        <!-- Installaties kaart -->
        <div class="glass-card rounded-3xl p-6 border-t-4 border-green-500 shadow-sm">
            <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">
                Installaties
            </p>

            <h2 class="text-4xl font-extrabold mt-2 text-slate-800">
                {{ $installatieCount }}
            </h2>
        </div>

        <!-- Gesloten tickets kaart -->
        <a href="/admin/helpdesk/gesloten">
            <div class="glass-card rounded-3xl p-6 border-t-4 border-yellow-500 shadow-sm hover:scale-105 transition cursor-pointer">
                <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">
                    Gesloten Tickets
                </p>

                <h2 class="text-4xl font-extrabold mt-2 text-slate-800">
                    {{ $geslotenTickets }}
                </h2>
            </div>
        </a>

        <!-- Open tickets kaart -->
        <a href="/admin/helpdesk">
            <div class="glass-card rounded-3xl p-6 border-t-4 border-cyan-500 shadow-sm hover:scale-105 transition cursor-pointer">
                <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">
                    Open Tickets
                </p>

                <h2 class="text-4xl font-extrabold mt-2 text-slate-800">
                    {{ $helpdeskCount }}
                </h2>
            </div>
        </a>

    </div>

    <!-- Overstromingsrisico tabel -->
    <div class="glass-card rounded-3xl p-8 mt-10 shadow-sm">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-slate-800">
                Overstromingsrisico
            </h2>

            <span class="bg-blue-50 text-[#005b96] px-4 py-1.5 rounded-lg text-xs font-black uppercase tracking-wider border border-blue-100">
                2026 - 2030
            </span>
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

                    <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                        <td class="py-5">
                            {{ $data['year'] }}
                        </td>

                        <td class="py-5">
                            {{ $data['rainfall'] }} mm
                        </td>

                        <td class="py-5">

                            @if($data['risk'] == 'Laag')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Laag
                                </span>
                            @elseif($data['risk'] == 'Gemiddeld')
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Gemiddeld
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Hoog
                                </span>
                            @endif

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>
        </div>
    

</main>