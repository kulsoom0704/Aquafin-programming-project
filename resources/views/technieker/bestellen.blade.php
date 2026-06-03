@extends('layouts.app')

@section('title', 'Materiaal Bestellen')

@section('content')
<div class="max-w-6xl mx-auto">
        
    
    <div class="flex flex-col mb-8">
        <a href="{{ route('technieker.meldingen') }}" class="group flex items-center text-sm font-medium text-gray-500 hover:text-aquaBlue transition-colors mb-2 w-fit">
            <svg class="w-4 h-4 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Terug naar dashboard
        </a>
        <h1 class="text-3xl font-extrabold text-aquaDark tracking-tight">Materiaal Bestellen</h1>
        <p class="text-gray-500 mt-1">Beheer je voorraad en plaats nieuwe aanvragen voor wisselstukken.</p>
    </div>

    
    @if(session('success'))
        <div class="flex items-center bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg mb-6 shadow-sm">
            <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-green-800 font-medium">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error') || $errors->any())
        <div class="flex items-center bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg mb-6 shadow-sm">
            <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-red-800 font-medium">{{ session('error') ?? $errors->first() }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        
        <div class="lg:col-span-5">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 h-full transition-shadow hover:shadow-md">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="bg-blue-50 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-aquaBlue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Nieuwe Aanvraag</h2>
                </div>
                
                <form action="{{ route('materiaal.store') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="onderdeel_id">Onderdeel selecteren</label>
                        <div class="relative">
                            <select name="onderdeel_id" id="onderdeel_id" class="appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-aquaBlue/50 focus:border-aquaBlue transition-all cursor-pointer" required>
                                <option value="" disabled selected>-- Kies uit de catalogus --</option>
                                @foreach($onderdelen as $onderdeel)
                                    <option value="{{ $onderdeel->id }}">
                                        {{ $onderdeel->naam }} (Beschikbaar: {{ $onderdeel->voorraad }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="aantal">Hoeveelheid</label>
                        <input type="number" name="aantal" id="aantal" min="1" class="w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-aquaBlue/50 focus:border-aquaBlue transition-all" placeholder="Bijv. 2" required>
                    </div>

                    <button type="submit" class="w-full mt-4 bg-aquaDark hover:bg-aquaBlue text-white font-semibold py-3.5 px-4 rounded-xl shadow-lg shadow-aquaDark/30 transform hover:-translate-y-0.5 transition-all duration-200 active:scale-95 flex justify-center items-center space-x-2">
                        <span>Bestelling Plaatsen</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>
        </div>

       
        <div class="lg:col-span-7">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 h-full">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gray-50 p-2 rounded-lg">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Mijn Bestellingen</h2>
                    </div>
                    <span class="text-sm text-gray-400 font-medium bg-gray-100 px-3 py-1 rounded-full">{{ $bestellingen->count() }} items</span>
                </div>
                
                @if($bestellingen->count() > 0)
                    <div class="space-y-3 max-h-[450px] overflow-y-auto pr-2">
                        @foreach($bestellingen as $bestelling)
                            <div class="group flex items-center justify-between p-4 rounded-xl border border-gray-100 bg-gray-50 hover:bg-white hover:border-blue-200 hover:shadow-md transition-all duration-300">
                                <div class="flex items-center space-x-4">
                                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-aquaBlue font-bold text-lg shadow-inner">
                                        {{ $bestelling->aantal }}x
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 group-hover:text-aquaBlue transition-colors">{{ $bestelling->onderdeel->naam }}</p>
                                        <p class="text-xs text-gray-500 flex items-center mt-1">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ $bestelling->created_at->format('d M Y - H:i') }}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                   
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 border border-amber-200">
                                        <span class="w-2 h-2 bg-amber-500 rounded-full mr-2 animate-pulse"></span>
                                        {{ $bestelling->status }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    
                    <div class="flex flex-col items-center justify-center h-64 text-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        <p class="text-gray-600 font-medium">Je hebt nog geen materiaal besteld.</p>
                        <p class="text-sm text-gray-400 mt-1">Nieuwe aanvragen verschijnen direct hier.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection