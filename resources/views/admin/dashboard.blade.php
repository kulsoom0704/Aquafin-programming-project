<!DOCTYPE html>

<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquafin Dashboard</title>

```
@vite('resources/css/app.css')
```

</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

```
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

        <a href="/admin/reports" class="block hover:text-blue-200">
            Rapporten
        </a>

    </nav>

</aside>

<main class="flex-1 p-8">

    <h1 class="text-4xl font-bold text-slate-800 mb-8">
        Master Dashboard & Rapporten
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-500">
                Gebruikers
            </h2>

            <p class="text-4xl font-bold mt-4">
                {{ $userCount }}
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-500">
                Installaties
            </h2>

            <p class="text-4xl font-bold text-green-600 mt-4">
                85%
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-500">
                Onderhoud
            </h2>

            <p class="text-4xl font-bold text-yellow-500 mt-4">
                10%
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-500">
                Kritieke storingen
            </h2>

            <p class="text-4xl font-bold text-red-600 mt-4">
                5%
            </p>
        </div>

    </div>

    <div class="bg-white rounded-xl shadow p-6 mt-8">

        <h2 class="text-2xl font-bold mb-4">
            Overstromingsrisico
        </h2>

        <table class="w-full">

            <thead>
                <tr class="border-b">
                    <th class="text-left py-3">Jaar</th>
                    <th class="text-left py-3">Regenval</th>
                    <th class="text-left py-3">Risico</th>
                </tr>
            </thead>

            <tbody>

            @foreach($rainfall as $data)

                <tr class="border-b">

                    <td class="py-3">
                        {{ $data['year'] }}
                    </td>

                    <td class="py-3">
                        {{ $data['rainfall'] }} mm
                    </td>

                    <td class="py-3">
                        {{ $data['risk'] }}
                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</main>
```

</div>

</body>
</html>
