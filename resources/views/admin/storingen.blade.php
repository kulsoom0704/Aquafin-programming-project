
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquafin - Storingen</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Outfit', sans-serif;
        }

        .glass-card {
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.8);
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
            <a href="/admin/dashboard" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium"> Dashboard</a>
            <a href="/admin/users" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium">Gebruikers</a>
            <a href="/admin/reports" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium">Rapporten</a>
            <a href="/admin/storingen" class="flex items-center px-4 py-3 rounded-xl bg-white/10 font-bold">Storingen</a>
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
    <main class="flex-1 p-10">

        <header class="mb-10">

            <h1 class="text-4xl font-black text-slate-900">
                Storingen Overzicht
            </h1>

            <p class="text-slate-500 font-medium mt-1">
                Overzicht van alle geregistreerde storingen.
            </p>

        </header>

        <!-- Storingen tabelen -->
        <div class="glass-card rounded-3xl p-8 shadow-sm">

            <table class="w-full text-left">

                <thead>

                    <tr class="text-slate-400 text-xs uppercase tracking-widest font-bold">
                        <th class="pb-4">Locatie</th>
                        <th class="pb-4">Type</th>
                        <th class="pb-4">Status</th>
                    </tr>

                </thead>

                <tbody class="text-slate-700 font-medium">

                    @foreach($storingen as $storing)

                    <tr class="border-t border-slate-100">

                        <td class="py-5">
                            {{ $storing['locatie'] }}
                        </td>

                        <td class="py-5">
                            {{ $storing['type'] }}
                        </td>

                        <td class="py-5">

                            @if($storing['status'] == 'Kritiek')

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Kritiek
                                </span>

                            @elseif($storing['status'] == 'Gemiddeld')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Gemiddeld
                                </span>

                            @else

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Laag
                                </span>

                            @endif

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </main>

</body>
</html>
```
