<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Helpdesk Gesprek</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 min-h-screen">

<div class="max-w-5xl mx-auto p-4 md:p-10">

   <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">

        <h1 class="text-2xl md:text-4xl font-black">
            Helpdesk Gesprek
        </h1>

        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">

            <a href="/admin/helpdesk"
               class="bg-slate-200 hover:bg-slate-300 px-4 py-2 rounded-xl font-medium">
                ← Helpdesk
            </a>

            <a href="/admin/dashboard"
               class="bg-[#005b96] hover:bg-blue-800 text-white px-4 py-2 rounded-xl font-medium">
                Dashboard
            </a>

        </div>

    </div>

    <!-- Gesprek detail -->
  <div class="bg-white rounded-3xl shadow p-4 md:p-8">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3 mb-4">

            <h2 class="text-2xl font-bold">
                {{ $oproep->technieker->name ?? 'Onbekend' }}
            </h2>

            @if($oproep->status == 'open')

                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold">
                    Open
                </span>

            @else

                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-bold">
                    Gesloten
                </span>

            @endif

        </div>

        <p class="mb-2">
            <strong>Type:</strong>
            {{ $oproep->type }}
        </p>

        <p class="mb-6">
            <strong>Oorspronkelijk bericht:</strong>
            {{ $oproep->bericht }}
        </p>

        <!-- Berichten overzicht -->
        <div class="border-t pt-6">

            <div class="bg-slate-100 rounded-3xl p-6 h-[500px] overflow-y-auto mb-6">

                @foreach($oproep->berichten as $bericht)

                    @if($bericht->afzender_rol == 'Admin')

                        <div class="flex justify-end mb-4">

                        class="bg-blue-600 text-white px-5 py-3 rounded-3xl rounded-br-md max-w-[85%] md:max-w-sm shadow"

                                <p>{{ $bericht->bericht }}</p>

                                <small class="text-blue-100 text-xs">
                                    {{ $bericht->created_at->format('H:i') }}
                                </small>

                            </div>

                        </div>

                    @else

                        <!-- Technieker bericht -->
                        <div class="flex justify-start mb-4">

                            <div class="bg-white px-5 py-3 rounded-3xl rounded-bl-md max-w-sm shadow">

                                <p>{{ $bericht->bericht }}</p>

                                <small class="text-slate-500 text-xs">
                                    {{ $bericht->created_at->format('H:i') }}
                                </small>

                            </div>

                        </div>

                    @endif

                @endforeach

            </div>

            @if($oproep->status == 'open')

            <form method="POST" action="/admin/helpdesk/{{ $oproep->id }}/bericht">

                @csrf

                <div class="flex flex-col sm:flex-row gap-3">

                    <textarea
                        name="bericht"
                        rows="2"
                        class="flex-1 border rounded-2xl p-4 resize-none"
                        placeholder="Typ een bericht..."
                        required></textarea>

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-2xl font-bold">
                        Versturen
                    </button>

                </div>

            </form>

            <form
                action="/admin/helpdesk/{{ $oproep->id }}/sluiten"
                method="POST"
                class="mt-6 flex justify-center md:justify-end"

                @csrf
                @method('PATCH')

                <button>
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl">
                    Gesprek afsluiten
                </button>

            </form>

            @endif

        </div>

    </div>

</div>

</body>
</html>