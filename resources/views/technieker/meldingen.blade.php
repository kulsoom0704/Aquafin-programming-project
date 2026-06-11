
{{--
    Bestand: resources/views/technieker/meldingen.blade.php
    Doel: Overzicht dashboard voor technieker. Toont datum, statistieken en lijst
    met te behandelen installaties. 
--}}

@extends('layouts.app')

@section('title', 'Mijn Dashboard')

@section('content')
<div class="max-w-6xl mx-auto">
    
    {{-- Koptekst pagina met datum --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-4xl font-extrabold text-aquaDark tracking-tight mb-1">Overzicht Dashboard</h1>
            <p class="text-gray-500">Welkom terug. Hier is de actuele status van jouw regio.</p>
        </div>
        <div class="flex items-center space-x-2 bg-white/80 backdrop-blur-sm px-4 py-2.5 rounded-xl border border-gray-200 shadow-sm text-sm font-semibold text-gray-600">
            <svg class="w-5 h-5 text-aquaBlue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span>{{ \Carbon\Carbon::now()->locale('nl')->translatedFormat('l j F Y') }}</span>
        </div>
    </div>

    {{-- Statistieke rij --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        
        {{-- Stat 1: Openstaande meldingen --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute -right-6 -top-6 bg-blue-50 w-24 h-24 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <div class="flex justify-between items-center relative z-10">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Openstaande Meldingen</p>
                    <p class="text-4xl font-extrabold text-aquaDark">{{ $meldingen->count() }}</p>
                </div>
                <div class="p-3 bg-blue-50 text-aquaBlue rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
            </div>
        </div>

        {{-- Stat 2: Kritieke meldingen --}}
        @php $critiekCount = $meldingen->where('dagen_te_laat', '>', 30)->count() + $meldingen->where('dagen_te_laat', '===', 999)->count(); @endphp
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute -right-6 -top-6 bg-red-50 w-24 h-24 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <div class="flex justify-between items-center relative z-10">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Kritieke Status</p>
                    <p class="text-4xl font-extrabold {{ $critiekCount > 0 ? 'text-red-600' : 'text-gray-800' }}">{{ $critiekCount }}</p>
                </div>
                <div class="p-3 bg-red-50 text-red-500 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
            </div>
        </div>

    </div>

    {{-- Foutafhandeling --}}
    @if(isset($error))
        <div class="flex items-center bg-red-50/80 backdrop-blur-sm border border-red-100 p-4 rounded-xl mb-8">
            <p class="text-red-800 font-medium">{{ $error }}</p>
        </div>
    @endif

    {{-- Sectietitel --}}
    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-aquaBlue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
        Te Behandelen Installaties
    </h2>

    @if($meldingen->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($meldingen as $installatie)
                @php
                    $isCritical = $installatie->dagen_te_laat > 30 || $installatie->dagen_te_laat === 999;
                    $glowColor = $isCritical ? 'hover:shadow-red-500/20' : 'hover:shadow-amber-500/20';
                    $dotColor = $isCritical ? 'bg-red-500' : 'bg-amber-400';
                @endphp

                <div class="group bg-white/90 backdrop-blur-xl rounded-3xl p-7 border border-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] transition-all duration-300 hover:-translate-y-1 {{ $glowColor }} hover:shadow-xl relative overflow-hidden">
                    
                    <div class="absolute top-0 left-0 w-full h-1 {{ $dotColor }} opacity-80"></div>

                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <div class="flex items-center space-x-2 mb-3">
                                <span class="relative flex h-3 w-3">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $dotColor }} opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-3 w-3 {{ $dotColor }}"></span>
                                </span>
                                <span class="text-xs font-bold uppercase tracking-wider {{ $isCritical ? 'text-red-600' : 'text-amber-600' }}">
                                    {{ $isCritical ? 'Actie vereist' : 'Onderhoud gepland' }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-aquaBlue transition-colors duration-200">
                                {{ $installatie->naam }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                {{ $installatie->locatie ?? 'Onbekend' }}
                            </p>
                        </div>
                        
                        <div class="font-mono text-xs font-bold {{ $isCritical ? 'text-red-500 bg-red-50' : 'text-amber-600 bg-amber-50' }} px-3 py-1.5 rounded-lg border {{ $isCritical ? 'border-red-100' : 'border-amber-100' }}">
                            +{{ $installatie->dagen_te_laat === 999 ? '∞' : $installatie->dagen_te_laat }} DAGEN
                        </div>
                    </div>
                    
                    <div class="pt-5 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-sm w-full sm:w-auto">
                            <span class="text-gray-400 block sm:inline">Vervaldatum:</span> 
                            <span class="font-semibold text-gray-800">{{ $installatie->laatste_onderhoud_datum ?? 'Geen data' }}</span>
                        </div>
                        
                        <div class="flex space-x-3 w-full sm:w-auto">
                            <a href="{{ route('installatie.show', $installatie->id) }}" class="flex-1 sm:flex-none text-center px-4 py-2.5 bg-blue-50 text-[#005b96] hover:bg-blue-100 font-bold rounded-xl text-sm transition-colors border border-blue-200">
                                Logboek
                            </a>
                            
                            <form action="{{ route('installatie.valideren', $installatie->id) }}" method="POST" class="flex-1 sm:flex-none inline">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl text-sm transition-transform active:scale-95 shadow-sm tracking-wide flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    Valideren
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center h-72 text-center bg-white/90 backdrop-blur-xl rounded-2xl border-2 border-dashed border-green-200 shadow-sm mt-8 transition-all hover:bg-green-50/50">
            <div class="bg-green-100 p-4 rounded-full mb-5 shadow-inner">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m11 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </div>
            <h3 class="text-2xl font-extrabold text-gray-900 mb-2">Alles is up-to-date!</h3>
            <p class="text-gray-500 font-medium">Je hebt momenteel geen dringende onderhoudsmeldingen.<br>Tijd voor een koffiepauze.</p>
        </div>
    @endif
</div>
@endsection