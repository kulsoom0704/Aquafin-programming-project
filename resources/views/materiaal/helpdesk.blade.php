<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquafin - Helpdesk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;900&display=swap');
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-slate-800">

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

        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="/materiaal?sectie=voorraad" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Voorraad
            </a>
            <a href="/materiaal?sectie=meldingen" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                Bestellingen
            </a>
            <a href="/materiaal?sectie=retours" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                Retours
            </a>
            
            <div class="pt-6 mt-6 border-t border-white/10">
                <div class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold bg-white/10 text-white border-l-4 border-[#017CBF]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    Helpdesk Chat
                </div>
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

    <main class="flex-1 overflow-y-auto p-6 md:p-10">
        <div class="max-w-6xl mx-auto">
            <div class="mb-10">
                <h2 class="text-3xl font-black text-[#131236] tracking-tight">Helpdesk Overzicht</h2>
                <p class="text-sm text-slate-500 font-medium mt-1">Beheer alle inkomende aanvragen van techniekers.</p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs text-slate-500 uppercase tracking-widest font-black">
                            <th class="p-6">Technieker</th>
                            <th class="p-6">Ticket</th>
                            <th class="p-6">Bericht</th>
                            <th class="p-6">Status</th>
                            <th class="p-6 text-right">Actie</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($oproepen as $oproep)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="p-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-blue-100 text-[#017CBF] flex items-center justify-center font-black text-xs shadow-sm">
                                        {{ strtoupper(substr($oproep->technieker->name ?? 'T', 0, 1)) }}
                                    </div>
                                    <span class="font-bold text-slate-800 text-sm">{{ $oproep->technieker->name ?? 'Onbekend' }}</span>
                                </div>
                            </td>
                            <td class="p-6 text-xs font-black text-slate-400 bg-slate-50/50">#{{ $oproep->id }}</td>
                            <td class="p-6 text-sm text-slate-600 font-medium max-w-sm truncate">{{ Str::limit($oproep->bericht, 50) }}</td>
                            <td class="p-6">
                                @if($oproep->status == 'open')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-600 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Open
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-slate-100 text-slate-500 border border-slate-200">Gesloten</span>
                                @endif
                            </td>
                            <td class="p-6 text-right">
                                <a href="/materiaal/helpdesk/{{ $oproep->id }}" class="inline-flex items-center gap-2 bg-[#131236] hover:bg-[#017CBF] text-white px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all shadow-md active:scale-95">
                                    Openen
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-20 text-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">📭</div>
                                <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest">Geen actieve chats</h3>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>