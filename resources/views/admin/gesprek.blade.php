<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>Ticket #{{ $oproep->id }} - Helpdesk</title>
=======
    <title>Helpdesk Gesprek</title>
>>>>>>> cee224c57affc99e9965fc343baf1d7aad6bb69e
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>

<body class="bg-slate-50 min-h-screen">

<div class="max-w-5xl mx-auto p-4 md:p-10">
<<<<<<< HEAD
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
        <h1 class="text-2xl md:text-4xl font-black">Ticket #{{ $oproep->id }} - Helpdesk</h1>
        <div class="flex gap-3">
            <a href="{{ request()->is('admin/*') ? '/admin/helpdesk' : '/materiaal/helpdesk' }}" class="bg-slate-200 hover:bg-slate-300 px-4 py-2 rounded-xl font-medium">← Helpdesk</a>
=======

   <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">

        <h1 class="text-2xl md:text-4xl font-black">
            Helpdesk Gesprek
        </h1>

        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">

            <a href="/admin/helpdesk"
               class="bg-slate-200 hover:bg-slate-300 px-4 py-2 rounded-xl font-medium">
                ← Helpdesk
            </a>

            <a href="/admin/dashboard"
               class="bg-[#005b96] hover:bg-blue-800 text-white px-4 py-2 rounded-xl font-medium">
                Dashboard
            </a>

        </div>

    </div>

    <!-- Gesprek detail -->
  <div class="bg-white rounded-3xl shadow p-4 md:p-8">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3 mb-4">

            <h2 class="text-2xl font-bold">
                {{ $oproep->technieker->name ?? 'Onbekend' }}
            </h2>

            @if($oproep->status == 'open')

                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold">
                    Open
                </span>

            @else

                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-bold">
                    Gesloten
                </span>

            @endif

        </div>

        <p class="mb-2">
            <strong>Type:</strong>
            {{ $oproep->type }}
        </p>

        <p class="mb-6">
            <strong>Oorspronkelijk bericht:</strong>
            {{ $oproep->bericht }}
        </p>

        <!-- Berichten overzicht -->
        <div class="border-t pt-6">

            <div class="bg-slate-100 rounded-3xl p-6 h-[500px] overflow-y-auto mb-6">

                @foreach($oproep->berichten as $bericht)

                    @if($bericht->afzender_rol == 'Admin')

                        <div class="flex justify-end mb-4">

                        class="bg-blue-600 text-white px-5 py-3 rounded-3xl rounded-br-md max-w-[85%] md:max-w-sm shadow"

                                <p>{{ $bericht->bericht }}</p>

                                <small class="text-blue-100 text-xs">
                                    {{ $bericht->created_at->format('H:i') }}
                                </small>

                            </div>

                        </div>

                    @else

                        <!-- Technieker bericht -->
                        <div class="flex justify-start mb-4">

                            <div class="bg-white px-5 py-3 rounded-3xl rounded-bl-md max-w-sm shadow">

                                <p>{{ $bericht->bericht }}</p>

                                <small class="text-slate-500 text-xs">
                                    {{ $bericht->created_at->format('H:i') }}
                                </small>

                            </div>

                        </div>

                    @endif

                @endforeach

            </div>

            @if($oproep->status == 'open')

            <form method="POST" action="/admin/helpdesk/{{ $oproep->id }}/bericht">

                @csrf

                <div class="flex flex-col sm:flex-row gap-3">

                    <textarea
                        name="bericht"
                        rows="2"
                        class="flex-1 border rounded-2xl p-4 resize-none"
                        placeholder="Typ een bericht..."
                        required></textarea>

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-2xl font-bold">
                        Versturen
                    </button>

                </div>

            </form>

            <form
                action="/admin/helpdesk/{{ $oproep->id }}/sluiten"
                method="POST"
                class="mt-6 flex justify-center md:justify-end"

                @csrf
                @method('PATCH')

                <button>
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl">
                    Gesprek afsluiten
                </button>

            </form>

            @endif

>>>>>>> cee224c57affc99e9965fc343baf1d7aad6bb69e
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow p-4 md:p-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">{{ $oproep->technieker->name ?? 'Technieker' }}</h2>
            @if($oproep->status == 'open')
                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold">Open</span>
            @else
                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-bold">Gesloten</span>
            @endif
        </div>
        <p class="mb-2"><strong>Afdeling:</strong> {{ $oproep->type }}</p>
        <p class="mb-6"><strong>Oorspronkelijk probleem:</strong> {{ $oproep->bericht }}</p>

        <div class="border-t pt-6">
            <div id="chatContainer" class="bg-slate-100 rounded-3xl p-6 h-[400px] overflow-y-auto mb-6 custom-scrollbar">
                @foreach($oproep->berichten as $bericht)
                    @if($bericht->afzender_rol == 'Admin' || $bericht->afzender_rol == 'Magazijnier')
                        <div class="flex justify-end mb-4">
                            <div class="bg-blue-600 text-white px-5 py-3 rounded-3xl rounded-br-md max-w-[85%] md:max-w-sm shadow">
                                <p class="text-sm">{{ $bericht->bericht }}</p>
                                <div class="flex justify-end items-center gap-1 mt-1">
                                    <small class="text-blue-200 text-[10px]">{{ $bericht->created_at->format('H:i') }}</small>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex justify-start mb-4">
                            <div class="bg-white px-5 py-3 rounded-3xl rounded-bl-md max-w-sm shadow border border-slate-200">
                                <p class="text-[10px] font-black text-cyan-600 mb-1">Technieker</p>
                                <p class="text-sm text-slate-700">{{ $bericht->bericht }}</p>
                                <small class="text-slate-400 text-[10px] mt-1 block">{{ $bericht->created_at->format('H:i') }}</small>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            @if($oproep->status == 'open')
            <form id="chatReplyForm" method="POST" action="{{ url()->current() }}/bericht">
                @csrf
                <div class="flex gap-3">
                    <textarea name="bericht" rows="1" class="flex-1 border border-slate-200 rounded-2xl p-4 resize-none focus:outline-none focus:border-blue-500" placeholder="Typ je antwoord..." required></textarea>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-2xl font-bold transition">Versturen</button>
                </div>
            </form>

            <form action="{{ url()->current() }}/sluiten" method="POST" class="mt-6 flex justify-end" onsubmit="return confirm('Gesprek definitief afsluiten?');">
                @csrf @method('PATCH')
                <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-500 hover:text-white border border-red-100 px-6 py-2 rounded-xl font-bold transition">Gesprek afsluiten</button>
            </form>
            @endif
        </div>
    </div>
</div>

<script>
    // 1. Défiler vers le bas au chargement
    let container = document.getElementById('chatContainer');
    if(container) container.scrollTop = container.scrollHeight;

    // 2. Envoi silencieux (AJAX)
    document.addEventListener('submit', function(e) {
        if(e.target && e.target.id === 'chatReplyForm') {
            e.preventDefault(); 
            let form = e.target;
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).then(() => {
                form.querySelector('textarea').value = ''; 
            });
        }
    });

    // 3. Rafraîchissement invisible toutes les 3 secondes (Live Chat)
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