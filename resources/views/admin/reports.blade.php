<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquafin - Rapporten</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <a href="/admin/users" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/5 transition font-medium">👥 Gebruikers</a>
            <a href="/admin/reports" class="flex items-center px-4 py-3 rounded-xl bg-white/10 font-bold">📑 Rapporten</a>
        </nav>
    </aside>

    <main class="flex-1 p-10">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900">Rapporten</h1>
                <p class="text-slate-500 font-medium mt-1">Analyse van regenval en overstromingsrisico.</p>
            </div>
            <button onclick="generateReport()" class="bg-[#005b96] hover:bg-blue-800 text-white px-6 py-3 rounded-xl font-bold shadow-lg transition-all hover:-translate-y-0.5">
                Rapport genereren
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            @php $stats = [
                ['label' => 'Totaal rapporten', 'val' => '24', 'color' => 'blue'],
                ['label' => 'Gem. regenval', 'val' => '232 mm', 'color' => 'cyan'],
                ['label' => 'Hoog risico', 'val' => '4', 'color' => 'red']
            ]; @endphp
            @foreach($stats as $stat)
            <div class="glass-card rounded-3xl p-6 border-t-4 border-{{$stat['color']}}-500 shadow-sm">
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">{{ $stat['label'] }}</p>
                <h2 class="text-4xl font-extrabold mt-2 text-slate-800">{{ $stat['val'] }}</h2>
            </div>
            @endforeach
        </div>

        <div class="glass-card rounded-3xl p-8 mb-10 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-slate-800">Seizoensrapport</h2>
                <select class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-sm font-bold text-slate-700" onchange="filterSeason(this.value)">
                    <option value="all">Alle seizoenen</option>
                    <option value="Winter">Winter</option>
                    <option value="Lente">Lente</option>
                    <option value="Zomer">Zomer</option>
                    <option value="Herfst">Herfst</option>
                </select>
            </div>
            <table class="w-full text-left">
                <thead class="text-slate-400 text-xs uppercase tracking-widest font-bold">
                    <tr>
                        <th class="pb-4">Seizoen</th>
                        <th class="pb-4">Neerslag</th>
                        <th class="pb-4">Risiconiveau</th>
                    </tr>
                </thead>
                <tbody id="seasonTable" class="text-slate-700 font-medium">
                    <tr data-season="Winter" class="border-t border-slate-100"><td class="py-4">Winter</td><td>242 mm</td><td><span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Laag</span></td></tr>
                    <tr data-season="Lente" class="border-t border-slate-100"><td class="py-4">Lente</td><td>193 mm</td><td><span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Laag</span></td></tr>
                    <tr data-season="Zomer" class="border-t border-slate-100"><td class="py-4">Zomer</td><td>238 mm</td><td><span class="bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Gemiddeld</span></td></tr>
                    <tr data-season="Herfst" class="border-t border-slate-100"><td class="py-4">Herfst</td><td>255 mm</td><td><span class="bg-orange-50 text-orange-700 px-3 py-1 rounded-full text-xs font-bold">Gemiddeld</span></td></tr>
                </tbody>
            </table>
        </div>

        <div class="glass-card rounded-3xl p-8 shadow-sm">
            <h2 class="text-xl font-bold mb-6 text-slate-800">Regenvalanalyse</h2>
            <canvas id="rainChart" class="max-h-[300px]"></canvas>
        </div>
    </main>

    <script>
        function generateReport() { alert("Rapport succesvol gegenereerd."); }

        function filterSeason(season) {
            document.querySelectorAll('#seasonTable tr').forEach(row => {
                row.style.display = (season === 'all' || row.dataset.season === season) ? '' : 'none';
            });
        }

        new Chart(document.getElementById('rainChart'), {
            type: 'bar',
            data: {
                labels: ['Winter', 'Lente', 'Zomer', 'Herfst'],
                datasets: [{
                    label: 'Regenval (mm)',
                    data: [242, 193, 238, 255],
                    backgroundColor: '#005b96',
                    borderRadius: 8
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    </script>
</body>
</html>