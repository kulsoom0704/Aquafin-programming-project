@extends('layouts.app')

@section('title', 'Mijn Dashboard')

@section('content')
<div class="max-w-7xl mx-auto relative pb-24 px-4 sm:px-6 lg:px-8 mt-6">
    
    <div class="flex flex-col lg:flex-row justify-between lg:items-end gap-6 mb-10">
        <div>
            <span class="text-xs font-black tracking-[0.2em] text-[#005b96] uppercase mb-2 block">
                {{ \Carbon\Carbon::now()->translatedFormat('l d F Y') }}
            </span>
            <h1 class="text-3xl lg:text-5xl font-black text-slate-900 tracking-tight">
                Welkom terug, <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#005b96] to-cyan-500">{{ explode(' ', $huidigeTechnieker)[0] }}</span>
            </h1>
        </div>
        
        <div class="flex gap-4">
            <div class="bg-white border border-slate-200 rounded-2xl px-6 py-4 shadow-sm flex items-center gap-5 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center text-rose-500 border border-rose-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <div class="text-3xl font-black text-slate-800 leading-none">{{ $meldingen->count() }}</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Interventies</div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($weer) && $weer['is_beschikbaar'])
        <div class="mb-12">
            <div class="bg-gradient-to-br from-[#002a4a] to-[#004274] rounded-[2rem] p-6 md:p-8 relative overflow-hidden shadow-xl border border-[#005b96]">
                <div class="absolute top-[-50%] right-[-10%] w-96 h-96 bg-cyan-400/20 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="px-3 py-1 rounded-lg bg-cyan-500/20 text-cyan-300 text-[10px] font-black tracking-widest uppercase border border-cyan-400/20">Live Weer & Veiligheid</span>
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        </div>
                        <h2 class="text-2xl font-black text-white tracking-tight">Operationele Status</h2>
                        <p class="text-blue-200 mt-1 text-sm font-medium max-w-lg">Houd rekening met de actuele omstandigheden tijdens je interventies. Controleer je PBM's in de webshop indien nodig.</p>
                    </div>

                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-4 bg-white/5 border border-white/10 px-5 py-3 rounded-2xl backdrop-blur-sm">
                            <div class="text-white">
                                @if($weer['code'] <= 3)
                                    <svg class="w-10 h-10 text-amber-400 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                @elseif($weer['code'] >= 71)
                                    <svg class="w-10 h-10 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                                @else
                                    <svg class="w-10 h-10 text-cyan-300 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                                @endif
                            </div>
                            <div class="h-10 w-px bg-white/20"></div>
                            <div>
                                <div class="text-[10px] uppercase tracking-widest text-cyan-100/70 font-bold mb-0.5">Brussel</div>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-2xl font-black text-white leading-none">{{ $weer['temp'] }}°</span>
                                    <span class="text-sm font-bold {{ $weer['gevaar'] == 'Kritiek' ? 'text-rose-400' : ($weer['gevaar'] == 'Gemiddeld' ? 'text-amber-400' : 'text-emerald-400') }}">
                                        {{ $weer['gevaar'] == 'Kritiek' ? 'Zware Neerslag' : ($weer['gevaar'] == 'Gemiddeld' ? 'Lichte Regen' : 'Optimaal') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('materiaal.bestellen') }}" class="hidden md:flex h-16 w-16 bg-cyan-500 hover:bg-cyan-400 text-[#002a4a] rounded-2xl items-center justify-center transition-all shadow-lg hover:shadow-cyan-500/50 hover:-translate-y-1">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-black text-[#003d66] tracking-tight">Openstaande Taken</h2>
        <div class="text-sm font-bold text-slate-400">{{ $meldingen->count() }} installatie(s) vereisen onderhoud</div>
    </div>

    <div class="space-y-4">
        @forelse($meldingen as $taak)
            <div class="bg-white rounded-[1.5rem] border border-slate-200 shadow-[0_2px_15px_rgba(0,91,150,0.03)] hover:shadow-[0_10px_25px_rgba(0,91,150,0.08)] hover:border-blue-200 transition-all duration-300 p-5 lg:p-6 flex flex-col md:flex-row gap-6 items-start md:items-center group">
                
                <div class="w-16 h-16 shrink-0 rounded-2xl bg-gradient-to-br from-slate-50 to-blue-50/50 border border-blue-100 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                    <svg class="w-8 h-8 text-[#005b96] opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>

                <div class="flex-grow">
                    <div class="flex items-center gap-3 mb-1">
                        <span class="text-[10px] font-black tracking-widest uppercase text-slate-400">{{ $taak->locatie ?? 'Locatie Onbekend' }}</span>
                        
                        @if($taak->dagen_te_laat == 999)
                            <span class="px-2.5 py-0.5 rounded-md bg-rose-50 border border-rose-100 text-rose-600 text-[10px] font-black tracking-wide">EERSTE ONDERHOUD</span>
                        @elseif($taak->dagen_te_laat > 0)
                            <span class="px-2.5 py-0.5 rounded-md bg-rose-50 border border-rose-100 text-rose-600 text-[10px] font-black tracking-wide flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                {{ $taak->dagen_te_laat }} DAGEN OVERTIJD
                            </span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-md bg-amber-50 border border-amber-100 text-amber-600 text-[10px] font-black tracking-wide">ONDERHOUD VANDAAG</span>
                        @endif
                    </div>
                    
                    <h3 class="text-xl font-extrabold text-slate-800 leading-tight group-hover:text-[#005b96] transition-colors">{{ $taak->naam }}</h3>
                    <p class="text-sm text-slate-500 font-medium mt-1 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Laatste controle: {{ $taak->laatste_onderhoud_datum ? \Carbon\Carbon::parse($taak->laatste_onderhoud_datum)->format('d/m/Y') : 'Geen historiek' }}
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto shrink-0 md:pl-6 md:border-l border-slate-100">
                    <form action="{{ route('installatie.valideren', $taak->id) }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit" class="w-full sm:w-auto px-5 py-3.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 rounded-xl font-bold text-sm transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            Snel Valideren
                        </button>
                    </form>
                    
                    <a href="{{ route('installatie.show', $taak->id) }}" class="w-full sm:w-auto px-5 py-3.5 bg-slate-900 hover:bg-[#005b96] text-white rounded-xl font-bold text-sm transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Logboek openen
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-[2rem] border border-dashed border-slate-300 p-12 flex flex-col items-center justify-center text-center shadow-sm">
                <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-5 text-emerald-500 border border-emerald-100">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-2">Alles is in orde!</h3>
                <p class="text-slate-500 font-medium">Er zijn momenteel geen installaties die onderhoud vereisen.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection