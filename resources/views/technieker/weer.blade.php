@extends('layouts.app')

@section('title', 'Weerdashboard')

@section('content')

@if(isset($foutmelding))

<div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl mb-6">
    {{ $foutmelding }}
</div>

@else


//comment voor test

<div class="space-y-8">

    <div>
        <h1 class="text-5xl font-extrabold text-aquaDark tracking-tight">
            Weerdashboard
        </h1>

        <p class="mt-2 text-gray-500 text-lg">
            Bekijk neerslaggegevens en overstromingsgevaar voor jouw regio.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm uppercase tracking-wider text-gray-400 font-semibold">
                Seizoen
            </p>

            <h2 class="text-3xl font-bold text-aquaDark mt-3">
                {{ $seizoen }}
            </h2>

            <p class="text-gray-500 mt-2">
                Jaar {{ $jaar }}
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm uppercase tracking-wider text-gray-400 font-semibold">
                Totale Neerslag
            </p>

            <h2 class="text-3xl font-bold text-aquaBlue mt-3">
                {{ round($totaalVerwachteNeerslag, 1) }} mm
                {{-- {{ $totaleNeerslagSeizoen }} mm --}}
            </h2>

            <p class="text-gray-500 mt-2">
                Gemeten voor dit seizoen
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm uppercase tracking-wider text-gray-400 font-semibold">
                Overstromingsgevaar
            </p>

            <h2 class="text-3xl font-bold mt-3
                @if($overstromingsgevaar === 'Hoog')
                    text-red-500
                @elseif($overstromingsgevaar === 'Gemiddeld')
                    text-yellow-500
                @else
                    text-green-500
                @endif">
                {{ $overstromingsgevaar }}
            </h2>

            <p class="text-gray-500 mt-2">
                Grenswaarde: {{ $grenswaarde }} mm
            </p>
        </div>

    </div>

</div>
    <div class="mt-12">

    <h2 class="text-2xl font-bold text-aquaDark mb-6">
        Voorspelling komende dagen
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @foreach($voorspellingen as $voorspelling)

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

                <p class="text-sm uppercase tracking-wider text-gray-400 font-semibold">
                    {{ $voorspelling['dag'] }}
                </p>

                <h3 class="text-3xl font-bold text-aquaBlue mt-3">
                    {{ $voorspelling['neerslag'] }} mm
                </h3>

                <p class="text-gray-500 mt-2">
                    Verwachte neerslag 
                </p>

            </div>

        @endforeach

    </div>

    </div>
        <div class="mt-12">

        <h2 class="text-2xl font-bold text-aquaDark mb-2">
        Kritieke Materialen
        </h2>

        <p class="text-gray-500 mb-6">
        Aanbevolen materialen op basis van het actuele overstromingsgevaar.
        </p>
            @if($overstromingsgevaar == 'Hoog')
        <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-xl mb-6">
            ⚠ Hoog overstromingsgevaar gedetecteerd. Controleer de voorraad van kritieke onderdelen.
        </div>
    @endif

    @if($overstromingsgevaar == 'Gemiddeld')
        <div class="bg-yellow-100 border border-yellow-300 text-yellow-700 p-4 rounded-xl mb-6">
            ⚠ Gemiddeld overstromingsgevaar. Extra controle van kritieke onderdelen aanbevolen.
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6"> 

        @foreach($kritiekeMaterialen as $materiaal)

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

                <h3 class="text-lg font-bold text-aquaDark">
                    {{ $materiaal->naam }}
                </h3>

                <p class="text-gray-600 mt-2">
                    Voorraad: {{ $materiaal->voorraad }}
                </p>

                @if($materiaal->voorraad > 0)

                    <p class="text-green-600 font-semibold mt-2">
                        ✓ Beschikbaar
                    </p>

                @else

                    <p class="text-red-600 font-semibold mt-2">
                        ⚠ Niet beschikbaar
                    </p>

                @endif

            </div>

        @endforeach

    </div>

</div>
@endif
@endsection