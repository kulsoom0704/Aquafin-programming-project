<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquafin - Helpdesk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 min-h-screen flex">

   <aside class="w-72 bg-[#005b96] text-white flex flex-col shadow-2xl">
        <div class="p-8">
            <h2 class="text-2xl font-black tracking-tight">AQUAFIN</h2>
            <p class="text-blue-200 text-xs font-bold uppercase tracking-widest mt-1">Admin Portaal</p>
        </div>
        <nav class="flex-grow px-4 space-y-2">
            <a href="/admin/dashboard" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium"> Dashboard</a>
            <a href="/admin/users" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium">Gebruikers</a>
            <a href="/admin/reports" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium">Rapporten</a>
            <a href="/admin/storingen" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium">Storingen</a>
            <a href="/admin/helpdesk"  class="flex items-center px-4 py-3 rounded-xl bg-white/10 font-bold"> Helpdesk</a>
            </nav>
            <div class="p-4">
    <a href="/logout"
       class="block text-center bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-xl transition">
         Uitloggen
    </a>
</div>
    </aside>

    <!-- Main -->
    <main class="flex-1 p-10">

        <div class="mb-8">
            <h1 class="text-4xl font-black text-slate-800">
                Helpdesk
            </h1>

            <p class="text-slate-500 mt-2">
                Overzicht van alle vragen en noodoproepen van techniekers.
            </p>
        </div>

        <!-- Statistiek kaartsen -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white rounded-3xl p-6 shadow">
                <p class="text-slate-500 text-sm uppercase font-bold">
                    Open Tickets
                </p>

                <h2 class="text-4xl font-black text-red-500 mt-2">
                    {{ $oproepen->where('status', 'open')->count() }}
                </h2>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow">
                <p class="text-slate-500 text-sm uppercase font-bold">
                    Gesloten Tickets
                </p>

                <h2 class="text-4xl font-black text-green-500 mt-2">
                    {{ $oproepen->where('status', 'gesloten')->count() }}
                </h2>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow">
                <p class="text-slate-500 text-sm uppercase font-bold">
                    Totaal
                </p>

                <h2 class="text-4xl font-black text-blue-500 mt-2">
                    {{ $oproepen->count() }}
                </h2>
            </div>

        </div>

        <!-- Tickets Tabel -->
        <div class="bg-white rounded-3xl shadow overflow-hidden">

            <div class="p-6 border-b">
                <h2 class="text-xl font-bold">
                    Helpdesk Berichten
                </h2>
            </div>

            <table class="w-full">

                <thead class="bg-slate-100">
                    <tr>
                        <th class="text-left p-4">Technieker</th>
                        <th class="text-left p-4">Type</th>
                        <th class="text-left p-4">Bericht</th>
                        <th class="text-left p-4">Status</th>
                        <th class="text-left p-4">Actie</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($oproepen as $oproep)

                    <tr class="border-b hover:bg-slate-50">

                        <td class="p-4 font-medium">
                            {{ $oproep->technieker->name ?? 'Onbekend' }}
                        </td>

                        <td class="p-4">
                            {{ $oproep->type }}
                        </td>

                        <td class="p-4">
                            {{ $oproep->bericht }}
                        </td>

                        <td class="p-4">

                            @if($oproep->status == 'open')
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold">
                                    Open
                                </span>
                            @else
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">
                                    Gesloten
                                </span>
                            @endif

                        </td>

                        <td class="p-4">
                            <a href="/admin/helpdesk/{{ $oproep->id }}"
                              class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700">
                                    Open gesprek
                                </a>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center p-8 text-slate-500">
                            Geen noodoproepen gevonden.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </main>

</body>
</html>