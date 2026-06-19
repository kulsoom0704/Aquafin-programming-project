<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquafin - Magazijnier Portaal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;900&display=swap');
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        
        .sectie { display: none; animation: fadeIn 0.4s ease-out forwards; }
        .sectie.actief { display: block; }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        .popup-achtergrond {
            display: none; position: fixed; inset: 0; background: rgba(19, 18, 54, 0.4); backdrop-filter: blur(4px); z-index: 999;
        }
        .suggesties-lijst {
            position: absolute; width: 100%; background: white; border-radius: 0.75rem; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); margin-top: 0.5rem; max-height: 250px; overflow-y: auto; display: none; z-index: 50; border: 1px solid #e2e8f0;
        }
        .suggestie-item { padding: 0.75rem 1rem; cursor: pointer; border-bottom: 1px solid #f1f5f9; font-size: 0.875rem; font-weight: 500; color: #334155; }
        .suggestie-item:hover { background: #f8fafc; color: #017CBF; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-slate-800">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#131236] flex flex-col shadow-2xl relative z-20 shrink-0 h-full">
        <div class="p-6 flex items-center gap-4 border-b border-white/10">
            <div class="w-10 h-10 bg-[#017CBF] rounded-xl flex items-center justify-center shadow-lg shadow-[#017CBF]/20 shrink-0">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.25c-2.485 5.517-5.25 9.774-5.25 13.5a5.25 5.25 0 0010.5 0c0-3.726-2.765-7.983-5.25-13.5z"></path></svg>
            </div>
            <div>
                <h1 class="text-white font-black tracking-widest leading-tight">AQUAFIN</h1>
                <p class="text-[#017CBF] text-[10px] font-bold uppercase tracking-widest">Magazijnier</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto" id="sidebar-menu">
            <button onclick="toonSectie('voorraad')" id="btn-voorraad" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-slate-400 hover:text-white hover:bg-white/5 transition-all text-left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Voorraad
            </button>

            <button onclick="toonSectie('catalogus')" id="btn-catalogus" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-slate-400 hover:text-white hover:bg-white/5 transition-all text-left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Catalogus (Foto's)
            </button>

            <button onclick="toonSectie('meldingen')" id="btn-meldingen" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-slate-400 hover:text-white hover:bg-white/5 transition-all text-left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                Bestellingen
            </button>

            <button onclick="toonSectie('leveringen')" id="btn-leveringen" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-slate-400 hover:text-white hover:bg-white/5 transition-all text-left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                Uitgifte
            </button>

            <button onclick="toonSectie('retours')" id="btn-retours" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-slate-400 hover:text-white hover:bg-white/5 transition-all text-left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                Retours
            </button>

            <button onclick="toonSectie('archief')" id="btn-archief" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-slate-400 hover:text-white hover:bg-white/5 transition-all text-left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                Archief
            </button>

            @php
                $unread = \App\Models\ChatBericht::whereHas('noodoproep', function($q) {
                    $q->where('type', 'Magazijnier')->where('status', 'open');
                })->where('afzender_rol', 'Technieker')->where('gelezen', false)->count();
            @endphp
            <div class="pt-6 mt-6 border-t border-white/10">
                <a href="/materiaal/helpdesk" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-bold text-emerald-400 hover:bg-emerald-400/10 transition-all text-left">
                    <span class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        Helpdesk
                    </span>
                    @if($unread > 0)
                        <span class="bg-rose-500 text-white text-[10px] px-2 py-0.5 rounded-full animate-pulse">{{ $unread }}</span>
                    @endif
                </a>
            </div>
        </nav>

        <div class="p-4 bg-black/20 backdrop-blur-md border-t border-white/5 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#017CBF] to-cyan-400 flex items-center justify-center text-white font-black text-sm shadow-md">
                {{ strtoupper(substr(Auth::user()->name ?? 'M', 0, 2)) }}
            </div>
            <div class="flex-1 overflow-hidden">
                <p class="text-white text-sm font-bold truncate">{{ Auth::user()->name ?? 'Magazijnier' }}</p>
                <a href="/logout" class="text-rose-400 hover:text-rose-300 text-xs font-bold transition-colors">Uitloggen</a>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 overflow-y-auto p-6 md:p-10 relative">
        
        @if(session('succes') || session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-3 animate-fade-in shadow-sm">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="font-bold text-sm">{{ session('succes') ?? session('success') }}</span>
            </div>
        @endif
        @if(session('fout') || session('error') || $errors->any())
            <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl flex items-center gap-3 animate-fade-in shadow-sm">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <span class="font-bold text-sm">{{ session('fout') ?? session('error') ?? $errors->first() }}</span>
            </div>
        @endif

        <!-- SECTIE: VOORRAAD -->
        <div class="sectie actief" id="sectie-voorraad">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-black text-[#131236] tracking-tight">Voorraad Overzicht</h1>
                    <p class="text-sm text-slate-500 font-medium mt-1">Beheer de actuele voorraad van dit depot.</p>
                </div>
                <div class="relative w-full md:w-72">
                    <input type="text" id="magazijn-zoek" placeholder="Zoek artikel..." autocomplete="off" 
                        class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:border-[#017CBF] focus:ring-4 focus:ring-[#017CBF]/10 outline-none transition-all shadow-sm">
                    <div class="suggesties-lijst" id="magazijn-suggesties"></div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs text-slate-500 uppercase tracking-wider font-black">
                                <th class="py-4 px-6">Artikelnummer</th>
                                <th class="py-4 px-6">Omschrijving</th>
                                <th class="py-4 px-6">Locatie</th>
                                <th class="py-4 px-6 text-center">Beschikbaar</th>
                                <th class="py-4 px-6 text-right">Actie</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium text-slate-700 divide-y divide-slate-100">
                            @foreach ($materialen as $item)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6 font-bold text-[#131236]">{{ $item->artikelnummer }}</td>
                                <td class="py-4 px-6">{{ $item->omschrijving }}</td>
                                <td class="py-4 px-6 text-slate-500">{{ $item->locatie }}</td>
                                <td class="py-4 px-6 text-center">
                                    @if($item->beschikbaar < 5)
                                        <span class="inline-flex px-3 py-1 bg-rose-50 text-rose-600 rounded-lg font-black border border-rose-100">{{ $item->beschikbaar }}</span>
                                    @else
                                        <span class="inline-flex px-3 py-1 bg-slate-100 text-slate-700 rounded-lg font-bold">{{ $item->beschikbaar }}</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <button class="btn-details bg-white border border-slate-200 text-[#017CBF] hover:bg-[#017CBF] hover:text-white px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider transition-colors shadow-sm"
                                        onclick="toonPopup('{{ $item->id }}','{{ $item->artikelnummer }}','{{ $item->omschrijving }}','{{ $item->locatie }}','{{ $item->beschikbaar }}')">
                                        Details
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- SECTIE: CATALOGUS (FOTO UPLOAD) -->
        <div class="sectie" id="sectie-catalogus">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-[#017CBF]/10 rounded-2xl flex items-center justify-center text-[#017CBF]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-[#131236] tracking-tight">Catalogus Beheer</h1>
                    <p class="text-sm text-slate-500 font-medium mt-1">Voeg foto's toe om verwarring bij techniekers te voorkomen.</p>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs text-slate-500 uppercase tracking-wider font-black">
                                <th class="py-4 px-6">Artikelnr.</th>
                                <th class="py-4 px-6">Omschrijving</th>
                                <th class="py-4 px-6 text-center">Huidige Foto</th>
                                <th class="py-4 px-6 text-right">Actie</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium text-slate-700 divide-y divide-slate-100">
                            @foreach($materialen as $item)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6 font-bold text-[#131236]">{{ $item->artikelnummer }}</td>
                                <td class="py-4 px-6">{{ $item->omschrijving }}</td>
                                <td class="py-4 px-6 text-center">
                                    @if($item->foto)
                                        <!-- Photo manuelle -->
                                        <div class="w-12 h-12 mx-auto rounded-lg overflow-hidden border border-[#017CBF] shadow-sm relative">
                                            <div class="absolute top-0 right-0 bg-[#017CBF] text-white text-[8px] font-black px-1 rounded-bl-lg">Eigen</div>
                                            <img src="{{ str_starts_with($item->foto, 'http') ? $item->foto : asset('storage/' . $item->foto) }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <!-- Image par défaut -->
                                        @php
                                            $prefix = strtoupper(substr($item->artikelnummer, 0, 3));
                                            $defaultImg = match($prefix) {
                                                'BEV' => 'https://images.unsplash.com/photo-1581166397057-235af2b3c6dd?q=80&w=150&auto=format&fit=crop',
                                                'PBM' => 'https://images.unsplash.com/photo-1584704135557-d8dc7ea50cf0?q=80&w=150&auto=format&fit=crop',
                                                'GER' => 'https://images.unsplash.com/photo-1508873699372-7aeab60b44ab?q=80&w=150&auto=format&fit=crop',
                                                'TEC' => 'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?q=80&w=150&auto=format&fit=crop',
                                                'AQF' => 'https://images.unsplash.com/photo-1584464457692-5eb89fb1b460?q=80&w=150&auto=format&fit=crop',
                                                default => 'https://images.unsplash.com/photo-1586864387967-d02ef85d93e8?q=80&w=150&auto=format&fit=crop'
                                            };
                                        @endphp
                                        <div class="w-12 h-12 mx-auto rounded-lg overflow-hidden border border-slate-200 shadow-sm relative opacity-60 grayscale hover:grayscale-0 transition-all">
                                            <div class="absolute top-0 right-0 bg-slate-500 text-white text-[8px] font-black px-1 rounded-bl-lg">Auto</div>
                                            <img src="{{ $defaultImg }}" class="w-full h-full object-cover">
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <form action="{{ url('/materiaal/'.$item->id.'/foto') }}" method="POST" enctype="multipart/form-data" class="m-0 flex justify-end">
                                        @csrf
                                        <label class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 hover:border-[#017CBF] hover:text-[#017CBF] text-slate-600 rounded-lg text-xs font-bold uppercase tracking-wider transition-colors shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"></path></svg>
                                            {{ $item->foto ? 'Wijzigen' : 'Uploaden' }}
                                            <input type="file" name="foto" class="hidden" accept="image/*" onchange="this.form.submit()">
                                        </label>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- SECTIE: BESTELLINGEN -->
        <div class="sectie" id="sectie-meldingen">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-black text-[#131236] tracking-tight">Bestellingen</h1>
                    <p class="text-sm text-slate-500 font-medium mt-1">Openstaande aanvragen van techniekers.</p>
                </div>
                <div class="bg-[#017CBF]/10 text-[#017CBF] px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Actueel</div>
            </div>

            @php $bestellingen = \App\Models\Bestelling::with(['onderdeel','user','materiaal'])->whereIn('status', ['In behandeling', 'in afwachting'])->latest()->get(); @endphp
            @if($bestellingen->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center shadow-sm">
                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    <p class="text-slate-500 font-medium">Geen openstaande bestellingen.</p>
                </div>
            @else
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200 text-xs text-slate-500 uppercase tracking-wider font-black">
                                    <th class="py-4 px-6">Nummer</th>
                                    <th class="py-4 px-6">Technieker</th>
                                    <th class="py-4 px-6">Onderdeel</th>
                                    <th class="py-4 px-6">Aantal</th>
                                    <th class="py-4 px-6">Datum</th>
                                    <th class="py-4 px-6">Status</th>
                                    <th class="py-4 px-6 text-right">Actie</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-medium text-slate-700 divide-y divide-slate-100">
                                @foreach($bestellingen as $bestelling)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="py-4 px-6 text-[#017CBF] font-bold">#{{ $bestelling->id }}</td>
                                    <td class="py-4 px-6 font-bold">{{ $bestelling->user->name ?? '-' }}</td>
                                    <td class="py-4 px-6">{{ $bestelling->materiaal->omschrijving ?? ($bestelling->onderdeel->naam ?? '-') }}</td>
                                    <td class="py-4 px-6"><span class="bg-slate-100 text-slate-700 px-2.5 py-1 rounded-lg font-bold">{{ $bestelling->aantal }}</span></td>
                                    <td class="py-4 px-6 text-slate-500">{{ $bestelling->created_at->format('d/m/Y') }}</td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-600 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> In behandeling
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <form method="POST" action="/magazijnier/bestellingen/{{ $bestelling->id }}/klaarzetten" class="m-0">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-[#131236] hover:bg-[#017CBF] text-white px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider transition-all shadow-md active:scale-95 flex items-center gap-2 ml-auto">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Goedkeuren
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
            <!-- SECTIE: UITGIFTE -->
            <div class="sectie bg-white border border-slate-200 rounded-3xl p-8 shadow-sm" id="sectie-leveringen">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-[#017CBF]/10 rounded-2xl flex items-center justify-center text-[#017CBF]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-black text-[#131236] tracking-tight">Materiaal uitgifte</h1>
                        <p class="text-sm text-slate-500 font-medium mt-1">Registreer direct materiaal dat wordt meegegeven.</p>
                    </div>
                </div>
                
                <form method="POST" action="/levering" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2 pl-1">Naam technieker</label>
                        <input type="text" name="technieker_naam" placeholder="Bv. Lukas Peeters" required
                            class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-semibold placeholder-slate-400 focus:bg-white focus:border-[#017CBF] focus:ring-4 focus:ring-[#017CBF]/10 outline-none transition-all">
                    </div>

                    <div class="relative">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2 pl-1">Zoek en voeg artikel toe</label>
                        <div class="relative">
                            <input type="text" id="zoek-uitgifte" placeholder="Typ artikelnummer of naam..." autocomplete="off" onkeyup="filterUitgifte()"
                                class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-semibold placeholder-slate-400 focus:bg-white focus:border-[#017CBF] focus:ring-4 focus:ring-[#017CBF]/10 outline-none transition-all pl-12">
                            <svg class="w-5 h-5 text-slate-400 absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <div class="absolute z-20 w-full mt-2 bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden" id="zoek-suggesties"></div>
                    </div>

                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200 min-h-[100px]">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-3">Geselecteerde artikelen</label>
                        <div id="artikelen-lijst" class="space-y-2"></div>
                    </div>

                    <button type="submit" class="w-full bg-[#017CBF] hover:bg-[#005b96] text-white font-bold text-sm py-4 rounded-2xl shadow-lg shadow-[#017CBF]/20 active:scale-[0.98] transition-all flex justify-center items-center gap-2">
                        Uitgifte registreren
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>

            <!-- SECTIE: RETOURS -->
            <div class="sectie bg-white border border-slate-200 rounded-3xl p-8 shadow-sm" id="sectie-retours">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-[#131236]/5 rounded-2xl flex items-center justify-center text-[#131236]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-black text-[#131236] tracking-tight">Retour registreren</h1>
                        <p class="text-sm text-slate-500 font-medium mt-1">Scan of typ het bestelnummer in.</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2 pl-1">Bestelnummer</label>
                        <input type="text" id="bestelnummer-input" placeholder="Bv. 8 of scan barcode" autocomplete="off"
                            class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm font-semibold placeholder-slate-400 focus:bg-white focus:border-[#131236] focus:ring-4 focus:ring-[#131236]/10 outline-none transition-all">
                        <div id="bestelling-resultaat" class="mt-4"></div>
                    </div>

                    <form method="POST" action="/retour" id="retour-form" style="display:none;" class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-5 animate-fade-in">
                        @csrf
                        <input type="hidden" name="materiaal_id[]" id="retour-materiaal-id">
                        <input type="hidden" name="technieker_naam" id="retour-technieker-naam">
                        <input type="hidden" name="bestelling_id" id="retour-bestelling-id">

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2 pl-1">Aantal terug te brengen</label>
                            <input type="number" name="aantal[]" id="retour-aantal" min="1"
                                class="w-full px-5 py-3.5 bg-white border border-slate-200 rounded-xl text-slate-900 text-sm font-semibold focus:border-[#131236] outline-none">
                        </div>

                        <button type="submit" class="w-full bg-[#131236] hover:bg-black text-white font-bold text-sm py-4 rounded-xl shadow-lg active:scale-[0.98] transition-all flex justify-center items-center gap-2">
                            Bevestig retour
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- SECTIE: ARCHIEF -->
        <div class="sectie mt-8" id="sectie-archief">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-[#131236] tracking-tight">Archief</h1>
                    <p class="text-sm text-slate-500 font-medium mt-1">Afgehandelde en geretourneerde bestellingen.</p>
                </div>
            </div>

            @php $gearchiveerdeBestellingen = \App\Models\Bestelling::with(['onderdeel','user','materiaal'])->whereIn('status', ['klaargezet', 'Goedgekeurd', 'geretourneerd'])->latest()->get(); @endphp
            @if($gearchiveerdeBestellingen->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center shadow-sm">
                    <p class="text-slate-500 font-medium">Geen gearchiveerde bestellingen.</p>
                </div>
            @else
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200 text-xs text-slate-500 uppercase tracking-wider font-black">
                                    <th class="py-4 px-6">Nummer</th>
                                    <th class="py-4 px-6">Technieker</th>
                                    <th class="py-4 px-6">Onderdeel</th>
                                    <th class="py-4 px-6">Aantal</th>
                                    <th class="py-4 px-6">Datum</th>
                                    <th class="py-4 px-6">Status</th>
                                    <th class="py-4 px-6 text-right">Actie</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-medium text-slate-700 divide-y divide-slate-100">
                                @foreach($gearchiveerdeBestellingen as $bestelling)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="py-4 px-6 font-bold text-slate-400">#{{ $bestelling->id }}</td>
                                    <td class="py-4 px-6">{{ $bestelling->user->name ?? '-' }}</td>
                                    <td class="py-4 px-6">{{ $bestelling->materiaal->omschrijving ?? ($bestelling->onderdeel->naam ?? '-') }}</td>
                                    <td class="py-4 px-6"><span class="bg-slate-100 px-2 py-1 rounded-lg font-bold text-slate-500">{{ $bestelling->aantal }}</span></td>
                                    <td class="py-4 px-6 text-slate-500">{{ $bestelling->created_at->format('d/m/Y') }}</td>
                                    <td class="py-4 px-6">
                                        @if($bestelling->status === 'geretourneerd')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-200">Geretourneerd</span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-200">Klaargezet</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <form method="POST" action="/bestellingen/{{ $bestelling->id }}/terugzetten" class="m-0">
                                            @csrf
                                            <button type="submit" class="text-slate-400 hover:text-[#017CBF] text-xs font-bold uppercase tracking-wider transition-colors underline underline-offset-4">Terugzetten</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

    </main>

    <!-- POPUP DETAILS (Voorraad) -->
    <div class="popup-achtergrond flex items-center justify-center" id="popup-achtergrond">
        <div class="bg-white p-8 rounded-3xl w-full max-w-md shadow-2xl relative animate-fade-in mx-4">
            <h2 class="text-2xl font-black text-[#131236] mb-6 border-b border-slate-100 pb-4">Artikel Details</h2>
            <p style="display:none;"><span id="popup-id"></span></p>
            
            <div class="space-y-4 mb-8">
                <div class="flex justify-between border-b border-slate-50 pb-2">
                    <span class="text-slate-500 font-medium text-sm">Artikelnummer</span>
                    <span class="font-bold text-[#131236]" id="popup-artikelnummer"></span>
                </div>
                <div class="flex justify-between border-b border-slate-50 pb-2">
                    <span class="text-slate-500 font-medium text-sm">Omschrijving</span>
                    <span class="font-bold text-[#131236]" id="popup-omschrijving"></span>
                </div>
                <div class="flex justify-between border-b border-slate-50 pb-2">
                    <span class="text-slate-500 font-medium text-sm">Locatie</span>
                    <span class="font-bold text-[#131236] bg-slate-100 px-2 py-0.5 rounded" id="popup-locatie"></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-500 font-medium text-sm">Beschikbaar</span>
                    <span class="font-black text-lg text-[#017CBF]" id="popup-beschikbaar"></span>
                </div>
            </div>

            <div class="flex gap-3">
                <button class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 rounded-xl transition-colors" onclick="sluitPopup()">Sluiten</button>
                <button class="flex-1 bg-[#131236] hover:bg-[#017CBF] text-white font-bold py-3 rounded-xl transition-colors shadow-lg" onclick="wijzigen()">Wijzigen</button>
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        var alleMateriaal = [
            @foreach($materialen as $item)
            { id: {{ $item->id }}, tekst: '{{ addslashes($item->artikelnummer) }} - {{ addslashes($item->omschrijving) }}' },
            @endforeach
        ];

        function toonSectie(naam) {
            document.querySelectorAll('.sectie').forEach(s => s.classList.remove('actief'));
            document.querySelectorAll('#sidebar-menu button').forEach(b => {
                b.classList.remove('bg-white/10', 'text-white', 'border-l-4', 'border-[#017CBF]');
                b.classList.add('text-slate-400');
            });
            
            var targetSectie = document.getElementById('sectie-' + naam);
            var targetBtn = document.getElementById('btn-' + naam);
            
            if(targetSectie) targetSectie.classList.add('actief');
            if(targetBtn) {
                targetBtn.classList.remove('text-slate-400');
                targetBtn.classList.add('bg-white/10', 'text-white', 'border-l-4', 'border-[#017CBF]');
            }
            localStorage.setItem('actieveSectie', naam);
        }

        var urlParams = new URLSearchParams(window.location.search);
        var sectie = urlParams.get('sectie') || localStorage.getItem('actieveSectie') || 'voorraad';
        toonSectie(sectie);

        var magazijnZoekInput = document.getElementById('magazijn-zoek');
        var voorraadTabelRijen = document.querySelectorAll('#sectie-voorraad tbody tr');

        magazijnZoekInput.addEventListener('input', function() {
            var query = this.value.trim().toLowerCase();
            voorraadTabelRijen.forEach(function(rij) {
                var textContent = rij.innerText.toLowerCase();
                rij.style.display = textContent.includes(query) ? '' : 'none';
            });
        });

        var bestelnummerInput = document.getElementById('bestelnummer-input');
        var bestellingResultaat = document.getElementById('bestelling-resultaat');
        var retourForm = document.getElementById('retour-form');

        bestelnummerInput.addEventListener('input', function() {
            var nummer = this.value.trim();
            if (nummer.length === 0) {
                bestellingResultaat.innerHTML = ''; retourForm.style.display = 'none'; return;
            }
            fetch('/api/bestelling/opzoeken?nummer=' + encodeURIComponent(nummer))
                .then(r => r.json())
                .then(data => {
                    if (!data.gevonden) {
                        bestellingResultaat.innerHTML = '<p class="text-rose-500 font-bold text-sm bg-rose-50 p-3 rounded-lg border border-rose-100">Geen klaargezette bestelling gevonden.</p>';
                        retourForm.style.display = 'none';
                        return;
                    }
                    bestellingResultaat.innerHTML = `
                        <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100 text-sm">
                            <p class="mb-1"><strong class="text-slate-700">Technieker:</strong> <span class="text-blue-700 font-bold">${data.technieker}</span></p>
                            <p class="mb-1"><strong class="text-slate-700">Materiaal:</strong> <span class="text-blue-700">${data.omschrijving}</span></p>
                            <p><strong class="text-slate-700">Meegekregen:</strong> <span class="bg-white px-2 py-0.5 rounded font-black text-[#131236] border border-blue-200 ml-1">${data.aantal}</span></p>
                        </div>
                    `;
                    document.getElementById('retour-materiaal-id').value = data.materiaal_id;
                    document.getElementById('retour-technieker-naam').value = data.technieker;
                    document.getElementById('retour-bestelling-id').value = data.bestelling_id;
                    document.getElementById('retour-aantal').max = data.aantal;
                    document.getElementById('retour-aantal').value = data.aantal;
                    retourForm.style.display = 'block';
                });
        });

        function filterUitgifte() {
            var zoekterm = document.getElementById('zoek-uitgifte').value.toLowerCase();
            var suggesties = document.getElementById('zoek-suggesties');
            if (zoekterm.length < 1) { suggesties.style.display = 'none'; return; }
            var resultaten = alleMateriaal.filter(item => item.tekst.toLowerCase().includes(zoekterm));
            suggesties.innerHTML = '';
            if (resultaten.length === 0) { suggesties.style.display = 'none'; return; }
            
            resultaten.forEach(item => {
                var div = document.createElement('div');
                div.className = 'suggestie-item';
                div.innerText = item.tekst;
                div.onclick = function() {
                    voegArtikelToeAanLijst(item.id, item.tekst, 'artikelen-lijst');
                    document.getElementById('zoek-uitgifte').value = '';
                    suggesties.style.display = 'none';
                };
                suggesties.appendChild(div);
            });
            suggesties.style.display = 'block';
        }

        function voegArtikelToeAanLijst(id, tekst, lijstId) {
            var lijst = document.getElementById(lijstId);
            var rij = document.createElement('div');
            rij.className = 'flex items-center gap-3 bg-white p-2 rounded-xl border border-slate-200 shadow-sm';
            rij.innerHTML = `
                <input type="hidden" name="materiaal_id[]" value="${id}">
                <span class="flex-1 text-sm font-bold text-slate-700 pl-2 truncate">${tekst}</span>
                <input type="number" name="aantal[]" value="1" min="1" class="w-20 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-center font-bold outline-none focus:border-[#017CBF]">
                <button type="button" class="w-10 h-10 flex items-center justify-center bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-lg transition-colors" onclick="this.parentElement.remove()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            `;
            lijst.appendChild(rij);
        }

        function toonPopup(id, artikelnummer, omschrijving, locatie, beschikbaar) {
            document.getElementById('popup-id').innerText = id;
            document.getElementById('popup-artikelnummer').innerText = artikelnummer;
            document.getElementById('popup-omschrijving').innerText = omschrijving;
            document.getElementById('popup-locatie').innerText = locatie;
            document.getElementById('popup-beschikbaar').innerText = beschikbaar;
            document.getElementById('popup-achtergrond').style.display = 'flex';
        }

        function sluitPopup() { document.getElementById('popup-achtergrond').style.display = 'none'; }
        function wijzigen() { window.location.href = '/materiaal/' + document.getElementById('popup-id').innerText + '/wijzigen'; }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('#zoek-uitgifte') && !e.target.closest('#zoek-suggesties')) {
                document.getElementById('zoek-suggesties').style.display = 'none';
            }
        });
    </script>
</body>
</html>