<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Gesprek</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen">

<div class="max-w-4xl mx-auto p-10">

    <h1 class="text-4xl font-black mb-8">
        Helpdesk Gesprek
    </h1>

    <div class="bg-white rounded-3xl shadow p-8">

        <h2 class="text-2xl font-bold mb-4">
            {{ $oproep->technieker->name ?? 'Onbekend' }}
        </h2>

        <p class="mb-4">
            <strong>Type:</strong>
            {{ $oproep->type }}
        </p>

        <p class="mb-6">
            <strong>Bericht:</strong><br>
            {{ $oproep->bericht }}
        </p>

        <div class="border-t pt-6">

            <label class="font-bold">
                Antwoord Admin
            </label>

            <textarea
                class="w-full border rounded-xl p-4 mt-2"
                rows="5"
                placeholder="Typ hier je antwoord..."
            ></textarea>

            <div class="flex gap-4 mt-4">

                <button
                    class="bg-blue-600 text-white px-6 py-3 rounded-xl">
                    Versturen
                </button>

                <form action="/admin/helpdesk/{{ $oproep->id }}/sluiten" method="POST">
                 @csrf
                 @method('PATCH')

                <button
                    type="submit"
                    class="bg-red-600 text-white px-6 py-3 rounded-xl hover:bg-red-700">
                    Gesprek afsluiten
                </button>
            </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>