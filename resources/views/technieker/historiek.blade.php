@extends('layouts.app')

@section('title', 'Mijn Bestelhistoriek')

@section('content')
<div class="max-w-4xl mx-auto pb-24 relative">
    
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight flex items-center">
            <svg class="w-8 h-8 mr-3 text-[#005b96]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            Mijn Bestelhistoriek
        </h1>
        <p class="text-slate-500 mt-2 font-medium">Volg hier de status van je aangevraagde materialen.</p>
    </div>

    <div class="space-y-4">
        @forelse($bestellingen as $order)
        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:shadow-md transition-shadow">
            
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 shrink-0 rounded-xl flex items-center justify-center shadow-inner {{ $order->status == 'klaargezet' ? 'bg-emerald-50 text-emerald-500 border border-emerald-100' : 'bg-amber-50 text-amber-500 border border-amber-100' }}">
                    @if($order->status == 'klaargezet')
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    @else
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    @endif
                </div>

                <div>
                    <h3 class="font-extrabold text-slate-800 text-lg leading-tight">{{ $order->materiaal->omschrijving ?? 'Onbekend materiaal' }}</h3>
                    <div class="text-[11px] font-black text-slate-400 uppercase tracking-widest mt-0.5 mb-1">{{ $order->materiaal->artikelnummer ?? 'N/A' }}</div>
                    
                    <p class="text-sm text-slate-500 font-medium flex items-center gap-2">
                        <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded text-xs font-bold">{{ $order->aantal }} stuks</span> 
                        • Besteld op {{ $order->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>

            <div class="sm:text-right flex sm:block items-center justify-between mt-2 sm:mt-0 border-t sm:border-0 border-slate-100 pt-3 sm:pt-0">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block sm:mb-1">Status</span>
                @if($order->status == 'klaargezet')
                    <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full text-sm font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-sm">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span> Klaargezet
                    </span>
                @else
                    <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full text-sm font-bold bg-amber-50 text-amber-700 border border-amber-200 shadow-sm">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> In afwachting
                    </span>
                @endif
            </div>

        </div>
        @empty
        <div class="text-center py-20 text-slate-400 bg-slate-50/50 rounded-3xl border-2 border-dashed border-slate-200">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <p class="font-bold text-lg text-slate-600 mb-1">Je historiek is leeg.</p>
            <p class="text-sm font-medium">Je hebt nog geen materiaal besteld via de webshop.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection