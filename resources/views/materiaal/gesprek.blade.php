<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Ticket #{{ $oproep->id }} - Magazijn Chat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="h-[100dvh] flex flex-col bg-slate-50 text-slate-800">

    <header class="bg-white border-b border-slate-200 px-4 md:px-8 py-4 flex items-center justify-between shrink-0 shadow-sm z-10">
        <div class="flex items-center gap-4">
            <a href="/materiaal/helpdesk" class="w-10 h-10 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-500 hover:text-[#005b96] rounded-xl flex items-center justify-center transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h1 class="text-xl md:text-2xl font-black text-[#001e33] leading-none">{{ $oproep->technieker->name ?? 'Technieker' }}</h1>
                <p class="text-[10px] md:text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Ticket #{{ $oproep->id }} • Afdeling Magazijn</p>
            </div>
        </div>
        
        <div class="flex items-center gap-3">
            @if($oproep->status == 'open')
                <span class="hidden md:inline-block bg-emerald-100 text-emerald-600 border border-emerald-200 px-4 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider">Open</span>
                <form action="/materiaal/helpdesk/{{ $oproep->id }}/sluiten" method="POST" onsubmit="return confirm('Wil je dit gesprek definitief afsluiten?');">
                    @csrf @method('PATCH')
                    <button type="submit" class="bg-rose-50 hover:bg-rose-500 text-rose-600 hover:text-white border border-rose-100 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition-all shadow-sm flex items-center gap-2 group">
                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <span class="hidden md:inline">Sluiten</span>
                    </button>
                </form>
            @else
                <span class="bg-slate-100 text-slate-500 border border-slate-200 px-4 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider">Gesloten</span>
            @endif
        </div>
    </header>

    <main class="flex-1 overflow-hidden flex flex-col max-w-5xl mx-auto w-full p-2 md:p-6">
        <div class="bg-white flex-1 rounded-3xl shadow-sm border border-slate-200 flex flex-col overflow-hidden">
            
            <div class="p-4 bg-blue-50/50 border-b border-blue-100 text-center shrink-0">
                <p class="text-[9px] font-black text-[#005b96]/60 uppercase tracking-widest mb-1.5">Oorspronkelijk Probleem • {{ $oproep->created_at->format('d/m/Y') }}</p>
                <p class="text-sm font-medium text-[#005b96] max-w-2xl mx-auto italic">"{{ $oproep->bericht }}"</p>
            </div>

            <div id="chatContainer" class="flex-1 overflow-y-auto p-4 md:p-8 space-y-6 custom-scrollbar bg-slate-50/30">
                @foreach($oproep->berichten as $bericht)
                    @if($bericht->afzender_rol == 'Magazijnier')
                        <div class="flex justify-end">
                            <div class="bg-[#005b96] text-white p-4 rounded-3xl rounded-tr-sm max-w-[85%] md:max-w-[70%] shadow-md">
                                <p class="text-sm font-medium leading-relaxed">{{ $bericht->bericht }}</p>
                                <div class="flex justify-end items-center gap-1 mt-2">
                                    <span class="text-[10px] text-blue-200 font-bold">{{ $bericht->created_at->format('H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex justify-start">
                            <div class="bg-white border border-slate-200 text-slate-700 p-4 rounded-3xl rounded-tl-sm max-w-[85%] md:max-w-[70%] shadow-sm">
                                <p class="text-[10px] font-black text-[#005b96] mb-1.5 uppercase tracking-wider">{{ $oproep->technieker->name ?? 'Technieker' }}</p>
                                <p class="text-sm font-medium leading-relaxed">{{ $bericht->bericht }}</p>
                                <span class="text-[10px] text-slate-400 font-bold mt-2 block">{{ $bericht->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            @if($oproep->status == 'open')
            <div class="p-3 md:p-4 bg-white border-t border-slate-100 shrink-0">
                <form id="chatReplyForm" method="POST" action="/materiaal/helpdesk/{{ $oproep->id }}/bericht" class="flex gap-2 md:gap-3 items-end max-w-4xl mx-auto">
                    @csrf
                    <textarea name="bericht" rows="1" class="flex-1 bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm font-medium text-slate-700 focus:outline-none focus:border-[#005b96] focus:ring-2 focus:ring-[#005b96]/20 transition-all resize-none shadow-inner" placeholder="Typ je antwoord hier..." required></textarea>
                    <button type="submit" class="w-14 h-14 shrink-0 bg-[#005b96] hover:bg-[#004a7c] text-white rounded-2xl flex items-center justify-center transition-transform active:scale-95 shadow-lg shadow-blue-500/20 group">
                        <svg class="w-6 h-6 translate-x-[-1px] translate-y-[1px] group-hover:translate-x-[1px] transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    </button>
                </form>
            </div>
            @else
            <div class="p-6 bg-slate-100 border-t border-slate-200 shrink-0 text-center">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full text-xs font-black text-slate-500 uppercase tracking-widest shadow-sm">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Gesprek definitief gesloten
                </span>
            </div>
            @endif
            
        </div>
    </main>

    <script>
        let container = document.getElementById('chatContainer');
        if(container) container.scrollTop = container.scrollHeight;

        document.addEventListener('submit', function(e) {
            if(e.target && e.target.id === 'chatReplyForm') {
                e.preventDefault(); 
                let form = e.target;
                let textarea = form.querySelector('textarea');
                
                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                }).then(() => {
                    textarea.value = ''; 
                    textarea.focus();
                });
            }
        });

        setInterval(() => {
            fetch(window.location.href)
            .then(response => response.text())
            .then(html => {
                let doc = new DOMParser().parseFromString(html, 'text/html');
                let newContainer = doc.getElementById('chatContainer');
                if(container && newContainer && container.innerHTML !== newContainer.innerHTML) {
                    let isScrolledToBottom = container.scrollHeight - container.clientHeight <= container.scrollTop + 50;
                    container.innerHTML = newContainer.innerHTML;
                    if(isScrolledToBottom) container.scrollTop = container.scrollHeight;
                }
            });
        }, 3000);
    </script>

</body>
</html>