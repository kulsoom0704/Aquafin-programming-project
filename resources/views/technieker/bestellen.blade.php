<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiaal Bestellen - Aquafin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-5xl mx-auto">
        
        <a href="{{ route('technieker.meldingen') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Terug naar meldingen</a>

        <div class="flex justify-between items-center mb-8 border-b-2 border-gray-200 pb-4">
            <h1 class="text-3xl font-bold text-blue-900">Materiaal Bestellen</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-6 font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-6 font-medium">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-6">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <div class="bg-white p-6 rounded-lg shadow-md h-fit">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Nieuwe bestelling plaatsen</h2>
                
                <form action="{{ route('materiaal.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="onderdeel_id">Kies een onderdeel:</label>
                        <select name="onderdeel_id" id="onderdeel_id" class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:border-blue-500" required>
                            <option value="" disabled selected>-- Selecteer een onderdeel --</option>
                            @foreach($onderdelen as $onderdeel)
                                <option value="{{ $onderdeel->id }}">
                                    {{ $onderdeel->naam }} (Voorraad: {{ $onderdeel->voorraad }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="aantal">Aantal:</label>
                        <input type="number" name="aantal" id="aantal" min="1" class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:border-blue-500" placeholder="Bijv. 2" required>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded transition duration-200">
                        Bestelling Bevestigen
                    </button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Mijn Bestellingen</h2>
                
                @if($bestellingen->count() > 0)
                    <div class="space-y-4">
                        @foreach($bestellingen as $bestelling)
                            <div class="border border-gray-200 rounded p-4 flex justify-between items-center">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $bestelling->aantal }}x {{ $bestelling->onderdeel->naam }}</p>
                                    <p class="text-xs text-gray-500">{{ $bestelling->created_at->format('d-m-Y H:i') }}</p>
                                </div>
                                <div>
                                    <span class="bg-yellow-200 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full">
                                        {{ $bestelling->status }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic">Je hebt nog geen materiaal besteld.</p>
                @endif
            </div>

        </div>

    </div>

</body>
</html>