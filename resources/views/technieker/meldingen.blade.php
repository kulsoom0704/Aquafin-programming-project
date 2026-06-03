<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onderhoudsmeldingen - Aquafin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto">
        
        <div class="flex justify-between items-center mb-8 border-b-2 border-gray-200 pb-4">
            <h1 class="text-3xl font-bold text-blue-900">Mijn Onderhoudsmeldingen</h1>
            
            @if(isset($huidigeTechnieker))
            <div class="flex items-center space-x-3 bg-white px-4 py-2 rounded-full shadow-sm border">
                <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">
                    {{ substr($huidigeTechnieker, 0, 1) }}
                </div>
                <span class="font-medium text-gray-700">Ingelogd als: {{ $huidigeTechnieker }}</span>
            </div>
            @endif
        </div>

        @if(isset($error))
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-6">
                <p>{{ $error }}</p>
            </div>
        @endif

        @if($meldingen->count() > 0)
            <div class="space-y-4">
                @foreach($meldingen as $installatie)
                    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 {{ $installatie->dagen_te_laat > 30 ? 'border-red-700' : 'border-orange-500' }}">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">{{ $installatie->naam }}</h2>
                                <p class="text-sm text-gray-600">Locatie: {{ $installatie->locatie ?? 'Onbekend' }}</p>
                            </div>
                            <div class="text-right">
                                @if($installatie->dagen_te_laat === 999)
                                    <span class="bg-red-200 text-red-800 text-xs font-bold px-2.5 py-0.5 rounded-full">CRITIEK: Nooit onderhouden</span>
                                @else
                                    <span class="bg-orange-200 text-orange-800 text-xs font-bold px-2.5 py-0.5 rounded-full">+{{ $installatie->dagen_te_laat }} dagen overtijd</span>
                                @endif
                                
                                <p class="text-xs text-gray-500 mt-2">
                                    Laatste onderhoud: {{ $installatie->laatste_onderhoud_datum ?? 'Geen' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded">
                <p class="font-medium">Geen onderhoudsmeldingen voor jouw installaties. Alles is up-to-date!</p>
            </div>
        @endif
    </div>

</body>
</html>