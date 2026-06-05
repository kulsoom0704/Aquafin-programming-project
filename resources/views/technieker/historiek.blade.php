@extends('layouts.app')

@section('title', 'Mijn Historiek')

@section('content')
<div class="max-w-4xl mx-auto">

    {{-- Koptekst --}}
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-aquaDark tracking-tight mb-1">Mijn Gevalideerde Taken</h1>
        <p class="text-gray-500">Overzicht van al jouw uitgevoerde interventies en updates.</p>
    </div>

    {{-- Foutafhandeling --}}
    @if(isset($error))
        <div class="flex items-center bg-red-50 border border-red-100 p-4 rounded-xl mb-8">
            <p class="text-red-800 font-medium">{{ $error }}</p>
        </div>
    @endif

    {{-- Lijst met validaties --}}
    @if($notities->count() > 0)
        <div class="space-y-6">
            @foreach($notities as $notitie)
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-[0_4px_20px_rgb(0,0,0,0.02)] relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-green-400 opacity-60"></div>
                    
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                        <div>
                            <span class="text-xs font-bold text-green-600 bg-green-50 px-2.5 py-1 rounded-md border border-green-100 uppercase tracking-wider">
                                Gevalideerd ✓
                            </span>
                            <h3 class="text-lg font-bold text-gray-900 mt-2">
                                {{ $notitie->installatie->naam ?? 'Onbekende installatie' }}
                            </h3>
                            <p class="text-xs text-gray-400 flex items-center mt-0.5">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                {{ $notitie->installatie->locatie ?? 'Geen locatie' }}
                            </p>
                        </div>
                        <span class="text-xs font-mono font-medium text-gray-400 bg-gray-50 px-2.5 py-1 rounded-md border border-gray-200">
                            {{ $notitie->created_at->format('d M Y - H:i') }}
                        </span>
                    </div>

                    {{-- De ingevoerde tekst --}}
                    <div class="bg-gray-50/60 rounded-xl p-4 border border-gray-100 text-sm text-gray-700 leading-relaxed">
                        {{ $notitie->opmerking }}
                    </div>

                    {{-- Als er een foto is geüpload, tonen we die hier --}}
                    @if($notitie->afbeelding)
                        <div class="mt-4 rounded-xl overflow-hidden border border-gray-200 bg-gray-50 max-w-md">
                            <img src="{{ asset('storage/' . $notitie->afbeelding) }}" alt="Bewijs" class="w-full h-auto max-h-48 object-cover">
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        {{-- Lege staat --}}
        <div class="flex flex-col items-center justify-center h-64 text-center bg-white rounded-2xl border-2 border-dashed border-gray-200">
            <div class="bg-gray-50 p-4 rounded-full mb-4 shadow-inner">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1">Nog geen geschiedenis</h3>
            <p class="text-gray-400 text-sm max-w-sm">Je hebt momenteel nog geen onderhoudstaken gevalideerd via dit account.</p>
        </div>
    @endif

</div>
@endsection