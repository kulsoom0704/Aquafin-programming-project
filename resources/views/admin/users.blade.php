<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquafin - Gebruikersbeheer</title>
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
            <p class="text-blue-200 text-xs font-bold uppercase tracking-widest mt-1">Beheerplatform</p>
        </div>
        <nav class="flex-grow px-4 space-y-2">
            <a href="/admin/dashboard" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium">📊 Dashboard</a>
            <a href="/admin/users" class="flex items-center px-4 py-3 rounded-xl bg-white/10 font-bold">👥 Gebruikers</a>
            <a href="/admin/reports" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium">📑 Rapporten</a>
        </nav>
    </aside>

    <main class="flex-1 p-10">
        <header class="mb-10">
            <h1 class="text-4xl font-black text-slate-900">Gebruikersbeheer</h1>
            <p class="text-slate-500 font-medium mt-1">Beheer gebruikers, rollen en toegangsrechten.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            @php $stats = [
                ['label' => 'Totaal', 'val' => $users->count(), 'color' => 'blue'],
                ['label' => 'Actief', 'val' => $users->where('active', true)->count(), 'color' => 'green'],
                ['label' => 'Gedeactiveerd', 'val' => $users->where('active', false)->count(), 'color' => 'red']
            ]; @endphp
            @foreach($stats as $stat)
            <div class="glass-card rounded-3xl p-6 border-t-4 border-{{$stat['color']}}-500 shadow-sm">
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">{{ $stat['label'] }}</p>
                <h2 class="text-4xl font-extrabold mt-2 text-slate-800">{{ $stat['val'] }}</h2>
            </div>
            @endforeach
        </div>

        <div class="glass-card rounded-3xl p-8 mb-10 shadow-sm">
            <h2 class="text-xl font-bold mb-6 text-slate-800">Nieuwe gebruiker toevoegen</h2>
            <form action="/admin/users" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @csrf
                <input type="text" name="name" placeholder="Naam" required class="bg-white border border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                <input type="email" name="email" placeholder="E-mail" required class="bg-white border border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                <select name="role" class="bg-white border border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="Admin">Admin</option>
                    <option value="Technieker">Technieker</option>
                    <option value="Magazijnier">Magazijnier</option>
                </select>
                <button type="submit" class="bg-[#005b96] hover:bg-blue-800 text-white rounded-xl font-bold transition">Toevoegen</button>
            </form>
        </div>

        <div class="glass-card rounded-3xl p-8 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-slate-800">Gebruikerslijst</h2>
                <span class="bg-blue-50 text-[#005b96] px-4 py-1.5 rounded-lg text-xs font-black uppercase">{{ $users->count() }} Totaal</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="text-slate-400 text-xs uppercase tracking-widest font-bold">
                        <tr>
                            <th class="pb-4">Naam</th>
                            <th class="pb-4">E-mail</th>
                            <th class="pb-4">Rol</th>
                            <th class="pb-4">Status</th>
                            <th class="pb-4">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700 font-medium">
                        @foreach($users as $user)
                        <tr class="border-t border-slate-100 hover:bg-slate-50/50 transition">
                            <td class="py-5">{{ $user->name }}</td>
                            <td class="py-5">{{ $user->email }}</td>
                            <td class="py-5">{{ $user->role }}</td>
                            <td class="py-5">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $user->active ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                    {{ $user->active ? 'Actief' : 'Gedeactiveerd' }}
                                </span>
                            </td>
                            <td class="py-5 flex gap-2">
                                <form action="/admin/users/{{ $user->id }}/toggle" method="POST" onsubmit="return confirm('Wijzigen?')">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="text-xs bg-amber-50 text-amber-700 px-3 py-1.5 rounded-lg font-bold hover:bg-amber-100">
                                        {{ $user->active ? 'Deactiveren' : 'Activeren' }}
                                    </button>
                                </form>
                                <form action="/admin/users/{{ $user->id }}" method="POST" onsubmit="return confirm('Verwijderen?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs bg-red-50 text-red-700 px-3 py-1.5 rounded-lg font-bold hover:bg-red-100">Verwijderen</button>
                                </form>
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