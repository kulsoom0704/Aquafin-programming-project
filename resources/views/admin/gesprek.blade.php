<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Gesprek</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen">

    <!-- Helpdesk gesprek pagina -->
<div class="max-w-4xl mx-auto p-10">

    <h1 class="text-4xl font-black mb-8">
        Helpdesk Gesprek
    </h1>

    <!-- Gesprek details -->
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

        <!-- Berichten overzicht -->
        <div class="border-t pt-6">

            <label class="font-bold">
                Antwoord Admin
            </label>
<div class="space-y-4 mb-6">

    @foreach($oproep->berichten as $bericht)

        @if($bericht->afzender_rol == 'Admin')

            <div class="flex justify-end">
                <div class="bg-blue-600 text-white p-4 rounded-2xl max-w-md">
                    {{ $bericht->bericht }}
                </div>
            </div>

        @else

            <div class="flex justify-start">
                <div class="bg-slate-200 p-4 rounded-2xl max-w-md">
                    {{ $bericht->bericht }}
                </div>
            </div>

        @endif

    @endforeach

</div>

            <!-- Antwoord formumier -->
            <form method="POST" action="/admin/helpdesk/{{ $oproep->id }}/bericht">

    @csrf

    <textarea
        name="bericht"
        rows="4"
        class="w-full border rounded-xl p-4"
        placeholder="Typ hier je antwoord..."
        required></textarea>

    <button
        type="submit"
        class="bg-blue-600 text-white px-6 py-3 rounded-xl mt-4">
        Versturen
    </button>

    </form>
    
    <!-- Gesprek afsluiten -->
    <form action="/admin/helpdesk/{{ $oproep->id }}/sluiten" method="POST">
    @csrf
    @method('PATCH')

    <button
        type="submit"
        class="bg-red-600 text-white px-6 py-3 rounded-xl mt-4">
        Gesprek afsluiten
    </button>
</form>


            </div>

        </div>

    </div>

</div>

</body>
</html>