<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Magazijnier - Helpdesk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #dceefb 0%, #c8e6f5 50%, #d4eef7 100%); min-height: 100vh; display: flex; }
        .sidebar { width: 220px; background: white; min-height: 100vh; display: flex; flex-direction: column; border-right: 1px solid #eee; position: fixed; top: 0; left: 0; }
        .sidebar-logo { display: flex; align-items: center; gap: 10px; padding: 20px; border-bottom: 1px solid #eee; }
        .sidebar-logo-icon { background: linear-gradient(to right, #0a5a8a, #00b4d8); padding: 8px; border-radius: 8px; font-size: 18px; color: white; }
        .sidebar-logo-titel { font-weight: bold; color: #0a5a8a; font-size: 16px; }
        .sidebar-logo-subtitel { font-size: 11px; color: #999; }
        .sidebar-nav { flex: 1; padding: 15px 0; }
        .sidebar-nav a, .sidebar-nav button { display: block; width: 100%; padding: 12px 20px; color: #555; text-decoration: none; font-size: 14px; border: none; background: none; text-align: left; cursor: pointer; border-left: 3px solid transparent; }
        .sidebar-nav a:hover, .sidebar-nav button:hover { background: #f5f5f5; }
        .sidebar-nav a.actief { color: #0a5a8a; background: #f0f7ff; border-left: 3px solid #0a5a8a; font-weight: bold; }
        
        .sidebar-gebruiker { padding: 15px 20px; border-top: 1px solid #eee; display: flex; align-items: center; gap: 10px; }
        .sidebar-avatar { background: linear-gradient(to right, #0a5a8a, #00b4d8); color: white; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 13px; flex-shrink: 0; }

        /* Pour le petit scroll propre si besoin */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">M</div>
            <div>
                <div class="sidebar-logo-titel">AQUAFIN</div>
                <div class="sidebar-logo-subtitel">MAGAZIJNIER PORTAAL</div>
            </div>
        </div>

        <div class="sidebar-nav">
            <a href="/materiaal?sectie=voorraad">Voorraad</a>
            <a href="/materiaal?sectie=meldingen">Bestellingen</a>
            <a href="/materiaal?sectie=retours">Retours</a>
            <a href="/materiaal?sectie=archief">Archief</a>
            
            @php
                $unread = \App\Models\ChatBericht::whereHas('noodoproep', function($q) {
                    $q->where('type', 'Magazijnier')->where('status', 'open');
                })->where('afzender_rol', 'Technieker')->where('gelezen', false)->count();
            @endphp
            <a href="/materiaal/helpdesk" class="actief" style="margin-top: 10px; border-top: 1px solid #eee;">
                💬 Helpdesk Chat
                @if($unread > 0)
                    <span style="background: #e74c3c; color: white; border-radius: 50%; padding: 2px 6px; font-size: 10px; margin-left: 5px; font-weight: bold; animation: pulse 2s infinite;">{{ $unread }}</span>
                @endif
            </a>
        </div>

        <div class="sidebar-gebruiker">
            <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'M', 0, 2)) }}</div>
            <div>
                <div style="font-weight: bold; font-size: 13px;">{{ Auth::user()->name ?? 'Magazijnier' }}</div>
                <a href="/logout" style="color: #e74c3c; font-size: 12px; text-decoration: none;">Uitloggen</a>
            </div>
        </div>
    </div>

    <div class="hoofdinhoud" style="margin-left: 220px; background-color: #f8fafc; min-height: 100vh; padding: 40px; width: calc(100% - 220px);">
        <div class="max-w-6xl mx-auto">
            
            <div class="mb-10">
                <h2 class="text-3xl font-black text-[#001e33] tracking-tight">Helpdesk Overzicht</h2>
                <p class="text-sm text-slate-500 font-medium mt-1">Beheer alle inkomende aanvragen van techniekers.</p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-[10px] uppercase tracking-widest text-slate-400 font-black">
                            <th class="p-5">Technieker</th>
                            <th class="p-5">Ticket</th>
                            <th class="p-5">Bericht</th>
                            <th class="p-5">Status</th>
                            <th class="p-5 text-right">Actie</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($oproepen as $oproep)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="p-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 text-[#005b96] flex items-center justify-center font-black text-xs">
                                        {{ strtoupper(substr($oproep->technieker->name ?? 'T', 0, 1)) }}
                                    </div>
                                    <span class="font-bold text-slate-700 text-sm">{{ $oproep->technieker->name ?? 'Onbekend' }}</span>
                                </div>
                            </td>
                            <td class="p-5">
                                <span class="text-xs font-black text-slate-400 bg-slate-100 px-2.5 py-1 rounded-md">#{{ $oproep->id }}</span>
                            </td>
                            <td class="p-5">
                                <p class="text-xs text-slate-500 font-medium line-clamp-1 max-w-xs">{{ Str::limit($oproep->bericht, 50) }}</p>
                            </td>
                            <td class="p-5">
                                @if($oproep->status == 'open')
                                    <span class="bg-emerald-100 text-emerald-600 border border-emerald-200 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider">Open</span>
                                @else
                                    <span class="bg-slate-100 text-slate-500 border border-slate-200 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider">Gesloten</span>
                                @endif
                            </td>
                            <td class="p-5 text-right">
                                <a href="/materiaal/helpdesk/{{ $oproep->id }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 hover:border-[#005b96] hover:text-[#005b96] text-slate-600 px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-sm">
                                    Openen
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-16 text-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span class="text-4xl opacity-50">📭</span>
                                </div>
                                <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest">Geen actieve chats</h3>
                                <p class="text-xs text-slate-400 mt-1">Je mailbox is helemaal leeg.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>