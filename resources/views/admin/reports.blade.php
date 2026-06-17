```php
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overstromingsrapporten</title>

    @vite('resources/css/app.css')
</head>
<div class="mb-6">

    <select
        class="border rounded-lg p-3"
        onchange="filterSeason(this.value)"
    >
        <option value="all">Alle seizoenen</option>
        <option value="Winter">Winter</option>
        <option value="Lente">Lente</option>
        <option value="Zomer">Zomer</option>
        <option value="Herfst">Herfst</option>
    </select>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

function generateReport()
{
    alert(
        "Rapport succesvol gegenereerd en opgeslagen."
    );
}

const ctx = document.getElementById('rainChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            'Winter',
            'Lente',
            'Zomer',
            'Herfst'
        ],
        datasets: [{
            label: 'Neerslag (mm)',
            data: [242, 193, 238, 255]
        }]
    }
});
</script>
<div class="bg-white rounded-xl shadow p-6 mt-8">

    <h2 class="text-2xl font-bold mb-4">
        Neerslaganalyse
    </h2>

    <canvas id="rainChart"></canvas>

</div>
<body class="bg-slate-100">

<div class="flex min-h-screen">

    <aside class="w-64 bg-blue-700 text-white p-6">

        <h2 class="text-2xl font-bold mb-8">
            Aquafin
        </h2>

        <nav class="space-y-4">
            <a href="/admin/dashboard" class="block hover:text-blue-200">
                Dashboard
            </a>

            <a href="/admin/users" class="block hover:text-blue-200">
                Gebruikers
            </a>

            <a href="/admin/reports" class="block font-bold">
                Rapporten
            </a>
        </nav>

    </aside>

    <main class="flex-1 p-8">

        <div class="flex justify-between items-center mb-8">

            <h1 class="text-4xl font-bold">
                Overstromingsrapporten
            </h1>

            <button
                onclick="generateReport()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg"
            >
                Rapport genereren
            </button>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-gray-500">
                    Totaal rapporten
                </h3>

                <p class="text-4xl font-bold mt-2">
                    24
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-gray-500">
                    Gemiddelde neerslag
                </h3>

                <p class="text-4xl font-bold text-blue-600 mt-2">
                    232 mm
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-gray-500">
                    Hoog risico zones
                </h3>

                <p class="text-4xl font-bold text-red-600 mt-2">
                    4
                </p>
            </div>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <h2 class="text-2xl font-bold mb-4">
                Seizoensrapport
            </h2>

            <table class="w-full">

                <thead>

                    <tr class="border-b">
                        <th class="text-left py-3">Seizoen</th>
                        <th class="text-left py-3">Neerslag</th>
                        <th class="text-left py-3">Risico</th>
                    </tr>

                </thead>

                <tbody>

                    <tr class="border-b">
                        <td class="py-3">Winter</td>
                        <td class="py-3">242 mm</td>
                        <td class="py-3">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                Laag
                            </span>
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-3">Lente</td>
                        <td class="py-3">193 mm</td>
                        <td class="py-3">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                Laag
                            </span>
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-3">Zomer</td>
                        <td class="py-3">238 mm</td>
                        <td class="py-3">
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                                Gemiddeld
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="py-3">Herfst</td>
                        <td class="py-3">255 mm</td>
                        <td class="py-3">
                            <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full">
                                Gemiddeld
                            </span>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </main>

</div>

<script>
function generateReport()
{
    alert(
        "Rapport succesvol gegenereerd en opgeslagen."
    );
}
</script>

</body>
</html>
```
