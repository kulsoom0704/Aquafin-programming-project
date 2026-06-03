<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logboek - {{ $installatie->naam }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto">
        
        
        <a href="{{ route('technieker.meldingen') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Terug naar meldingen</a>

        
        <div class="bg-white p-6 rounded-lg shadow-md mb-8 border-t-4 border-blue-900">
            <h1 class="text-3xl font-bold text-gray-800">{{ $installatie->naam }}</h1>
            <p class="text-gray-600 mt-2"><strong>Locatie:</strong> {{ $installatie->locatie }}</p>
            <p class="text-gray-600"><strong>Laatste onderhoud:</strong> {{ $installatie->laatste_onderhoud_datum ?? 'Nooit' }}</p>
        </div>

        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-6">
                {{ $errors->first() }}
            </div>
        @endif

       
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Nieuwe notitie toevoegen</h2>
            <form action="{{ route('notitie.store', $installatie->id) }}" method="POST">
                @csrf
                <textarea name="opmerking" rows="3" class="w-full border border-gray-300 rounded p-3 mb-4 focus:outline-none focus:border-blue-500" placeholder="Wat is er gebeurd tijdens de interventie?..." required></textarea>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Notitie Opslaan
                </button>
            </form>
        </div>


        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Historiek Logboek</h2>
            
            @if($installatie->notities->count() > 0)
                <div class="space-y-6">
                    @foreach($installatie->notities as $notitie)
                        <div class="border-b border-gray-200 pb-4 last:border-0">
                            <div class="flex justify-between text-sm text-gray-500 mb-2">
                                <span class="font-bold text-blue-900">{{ $notitie->technieker->name ?? 'Onbekende technieker' }}</span>
                                <span>{{ $notitie->created_at->format('d-m-Y H:i') }}</span>
                            </div>
                            <p class="text-gray-700">{{ $notitie->opmerking }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 italic">Er zijn nog geen notities voor deze installatie.</p>
            @endif
        </div>

    </div>

</body>
</html>