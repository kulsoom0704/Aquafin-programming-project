@extends('layouts.app')

{{--
    Bestand: resources/views/technieker/logboek.blade.php
    Doel: Logboekpagina voor de technieker. Toont installatiegegevens,
    formulier om nieuwe notities toe te voegen en de historiek van notities.
--}}

@section('title', 'Logboek - ' . $installatie->naam)

@section('content')
<div class="max-w-4xl mx-auto">
        
    {{-- Terug-knop naar het technieker dashboard --}}
    <div class="mb-8">
        <a href="{{ route('technieker.meldingen') }}" class="group flex items-center text-sm font-medium text-gray-500 hover:text-aquaBlue transition-colors w-fit">
            <svg class="w-4 h-4 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Terug naar dashboard
        </a>
    </div>

    {{-- Overzicht kaart: installatie naam, locatie en laatste onderhoud --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-2 h-full bg-aquaBlue"></div>
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-aquaDark tracking-tight mb-2">{{ $installatie->naam }}</h1>
                <div class="flex items-center space-x-6 text-sm text-gray-600">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $installatie->locatie }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Laatste onderhoud: <strong class="ml-1 text-gray-800">{{ $installatie->laatste_onderhoud_datum ?? 'Nooit' }}</strong>
                    </span>
                </div>
            </div>
            <div class="bg-blue-50 p-3 rounded-xl hidden sm:block">
                <svg class="w-8 h-8 text-aquaBlue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
        </div>
    </div>

    {{-- Feedback berichten: succes of fouten vanuit de controller --}}
    @if(session('success'))
        <div class="flex items-center bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg mb-8 shadow-sm">
            <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-green-800 font-medium">{{ session('success') }}</p>
        </div>
    @endif
    @if($errors->any())
        <div class="flex items-center bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg mb-8 shadow-sm">
            <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-red-800 font-medium">{{ $errors->first() }}</p>
        </div>
    @endif

    {{-- Formulier sectie: nieuwe notitie toevoegen voor deze installatie --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-5 flex items-center">
            <svg class="w-5 h-5 mr-2 text-aquaBlue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            Nieuwe notitie toevoegen
        </h2>
        
        {{-- Verstuur naar route die notities opslaat gekoppeld aan installatie id --}}
        <form action="{{ route('notitie.store', $installatie->id) }}" method="POST">
            @csrf
            <div class="relative">
                <textarea name="opmerking" rows="3" class="w-full bg-gray-50 border border-gray-200 text-gray-700 py-4 px-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-aquaBlue/50 focus:border-aquaBlue transition-all resize-none" placeholder="Wat is er gebeurd tijdens de interventie? Geef details over vervangen onderdelen of opgeloste storingen..." required></textarea>
            </div>
            
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-aquaDark hover:bg-aquaBlue text-white font-semibold py-2.5 px-6 rounded-xl shadow-md shadow-aquaDark/20 transform hover:-translate-y-0.5 transition-all duration-200 active:scale-95 flex items-center">
                    <span>Notitie Opslaan</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </button>
            </div>
        </form>
    </div>

    {{-- Historiek sectie: toont alle notities gerelateerd aan deze installatie --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-xl font-bold text-gray-900 mb-8 flex items-center">
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Historiek Logboek
        </h2>
        
        {{-- Indien er notities bestaan, lijst deze op in timeline stijl --}}
        @if($installatie->notities->count() > 0)
            <div class="relative border-l-2 border-gray-100 ml-3 space-y-8 pb-4">
                {{-- Per notitie: toon technieker, datum en opmerking --}}
                @foreach($installatie->notities as $notitie)
                    <div class="relative pl-8">
                        <div class="absolute -left-[9px] top-1.5 w-4 h-4 bg-white border-2 border-aquaBlue rounded-full shadow-sm"></div>
                        
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 hover:border-blue-200 hover:shadow-md transition-all duration-300">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center space-x-3">
                                    {{-- Initialen/avatar van technieker (fallback 'U') --}}
                                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-aquaBlue font-bold text-xs">
                                        {{ substr($notitie->technieker->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="font-bold text-gray-900 block text-sm">{{ $notitie->technieker->name ?? 'Onbekende technieker' }}</span>
                                    </div>
                                </div>
                                <span class="text-xs font-medium text-gray-400 bg-white px-2.5 py-1 rounded-md border border-gray-200 shadow-sm">
                                    {{ $notitie->created_at->format('d M Y - H:i') }}
                                </span>
                            </div>
                            <p class="text-gray-700 text-sm leading-relaxed">{{ $notitie->opmerking }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Geen notities: toon lege staat met uitnodiging om notitie toe te voegen --}}
            <div class="flex flex-col items-center justify-center h-48 text-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 mt-4">
                <svg class="w-10 h-10 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <p class="text-gray-500 font-medium text-sm">Er zijn nog geen notities voor deze installatie.</p>
            </div>
        @endif
    </div>

</div>
@endsection