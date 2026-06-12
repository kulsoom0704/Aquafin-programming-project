@extends('layouts.app')

@section('title', 'Mijn Bestelhistoriek')

@section('content')
<div class="max-w-7xl mx-auto relative pb-24 px-4 sm:px-6 lg:px-8 mt-6">
    
    <!-- EN-TÊTE PREMIUM BLEU -->
    <div class="mb-10 flex flex-col md:flex-row justify-between md:items-end gap-6 pt-6">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#005b96] to-cyan-500 flex items-center justify-center shadow-lg shadow-blue-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">Bestelhistoriek</h1>
            </div>
            <p class="text-slate-500 font-medium ml-13">Volg hier de status van je aangevraagde materialen bij het magazijn.</p>
        </div>
        
        <div class="flex items-center gap-3 relative z-50">
            <a href="{{ route('materiaal.bestellen') }}" class="bg-white text-slate-600 border border-blue-100 hover:border-[#005b96] hover:text-[#005b96] px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nieuwe bestelling
            </a>
        </div>
    </div>

    <!-- BESTELLINGENLIJST -->
    <div class="space-y-4">
        @forelse($bestellingen as $order)
            @php
                $prefix = strtoupper(substr($order->materiaal->artikelnummer ?? '', 0, 3));
                $gradient = match($prefix) {
                    'BEV' => 'from-blue-500 to-blue-700', 
                    'PBM' => 'from-orange-400 to-orange-600', 
                    'GER' => 'from-amber-400 to-amber-600', 
                    'TEC' => 'from-cyan-500 to-blue-600', 
                    'AQF' => 'from-sky-400 to-sky-600', 
                    default => 'from-slate-400 to-slate-600'
                };
                $iconPath = match($prefix) {
                    'BEV' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>',
                    'PBM' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>',
                    'GER' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>',
                    'TEC' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>',
                    'AQF' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>',
                    default => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>'
                };
            @endphp

            <div class="bg-white rounded-[1.5rem] border border-blue-50 shadow-[0_2px_15px_rgba(0,91,150,0.03)] hover:shadow-[0_10px_25px_rgba(0,91,150,0.08)] hover:border-blue-200 transition-all duration-300 p-4 lg:p-5 flex flex-col md:flex-row gap-5 items-start md:items-center group">
                
                <!-- Icône ou Photo Dynamique -->
                <div class="w-16 h-16 shrink-0 rounded-2xl bg-gradient-to-br {{ $gradient }} flex items-center justify-center overflow-hidden shadow-inner group-hover:scale-105 transition-transform duration-500">
                    @if(isset($order->materiaal->foto) && $order->materiaal->foto)
                        <img src="{{ asset('storage/' . $order->materiaal->foto) }}" alt="Foto" class="w-full h-full object-cover">
                    @else
                        <svg class="w-8 h-8 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $iconPath !!}
                        </svg>
                    @endif
                </div>

                <!-- Informations -->
                <div class="flex-grow">
                    <div class="flex items-center gap-3 mb-1">
                        <span class="text-[10px] font-black tracking-[0.15em] text-slate-400 bg-slate-50 px-2 py-0.5 rounded">{{ $order->materiaal->artikelnummer ?? 'N/A' }}</span>
                        <span class="text-xs font-bold text-slate-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $order->created_at->format('d M Y - H:i') }}
                        </span>
                    </div>
                    <h3 class="text-lg font-extrabold text-slate-800 leading-tight group-hover:text-[#005b96] transition-colors">{{ $order->materiaal->omschrijving ?? 'Onbekend materiaal' }}</h3>
                </div>

                <!-- Quantité & Statut (Zone Droite) -->
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto shrink-0 md:pl-6 md:border-l border-slate-100 pt-4 md:pt-0">
                    
                    <!-- Quantité -->
                    <div class="bg-blue-50/50 border border-blue-100 px-4 py-2 rounded-xl flex items-center gap-2">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Aantal:</span>
                        <span class="text-lg font-black text-[#005b96]">{{ $order->aantal }}</span>
                    </div>

                    <!-- Badge Statut -->
                    @if($order->status == 'klaargezet')
                        <span class="w-full sm:w-44 flex justify-center items-center gap-2 py-2.5 px-4 rounded-xl text-[11px] font-black bg-emerald-50 text-emerald-600 border border-emerald-200 shadow-sm uppercase tracking-widest">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Klaar in magazijn
                        </span>
                    @else
                        <span class="w-full sm:w-44 flex justify-center items-center gap-2 py-2.5 px-4 rounded-xl text-[11px] font-black bg-amber-50 text-amber-600 border border-amber-200 shadow-sm uppercase tracking-widest">
                            <span class="relative flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500"></span>
                            </span>
                            In behandeling
                        </span>
                    @endif
                </div>

            </div>
        @empty
            <!-- LEGE STATUS -->
            <div class="bg-white rounded-[2rem] border border-dashed border-slate-300 p-12 flex flex-col items-center justify-center text-center shadow-sm mt-8">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-5 text-slate-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-2">Je historiek is leeg</h3>
                <p class="text-slate-500 font-medium mb-6">Je hebt nog geen materiaal besteld via de webshop.</p>
                <a href="{{ route('materiaal.bestellen') }}" class="bg-[#005b96] hover:bg-[#003d66] text-white px-6 py-3 rounded-xl font-bold transition-all shadow-md flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Nu materiaal bestellen
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection