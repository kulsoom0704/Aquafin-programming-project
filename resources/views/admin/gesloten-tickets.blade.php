<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Gesloten Tickets</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen">

<div class="max-w-7xl mx-auto p-10">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-black">
            Gesloten Tickets
        </h1>

        <a href="/admin/helpdesk"
           class="bg-blue-600 text-white px-5 py-3 rounded-xl">
            Terug naar Helpdesk
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow p-6">

        @forelse($oproepen as $oproep)

            <div class="border-b py-4 flex justify-between items-center">

                <div>
                    <h2 class="font-bold text-lg">
                        {{ $oproep->technieker->name ?? 'Onbekend' }}
                    </h2>

                    <p class="text-slate-600">
                        {{ $oproep->type }}
                    </p>

                    <p class="text-sm text-slate-500">
                        {{ $oproep->created_at }}
                    </p>
                </div>

                <a href="/admin/helpdesk/{{ $oproep->id }}"
                   class="bg-slate-200 px-4 py-2 rounded-xl">
                    Bekijk gesprek
                </a>

            </div>

        @empty

            <p class="text-slate-500">
                Geen gesloten tickets gevonden.
            </p>

        @endforelse

    </div>

</div>

</body>
</html>