<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" type="image/png" href="{{ asset('images/image_980846.png') }}">
    <title>Aquafin - @yield('title', 'Dashboard')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');
        
        body { 
            font-family: 'Outfit', sans-serif; 
            -webkit-tap-highlight-color: transparent;
        }

        .bg-animated {
            background: linear-gradient(-45deg, #f8fafc, #eef2f6, #f1f5f9, #f8fafc);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="bg-animated text-slate-800 antialiased h-[100dvh] flex overflow-hidden pb-16 md:pb-0">

    <!-- Zijbalk Desktop -->
    <aside class="hidden md:flex flex-col w-72 bg-[#001e33] h-full z-40 relative shadow-[4px_0_30px_rgba(0,0,0,0.15)]">
        
        <div class="p-8 pb-8 flex items-center gap-4 border-b border-white/5">
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-[#005b96] to-cyan-400 flex items-center justify-center shadow-lg shadow-blue-500/20">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.907c.961 0 1.36 1.233.588 1.81l-3.97 2.883a1 1 0 00-.364 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.971-2.883a1 1 0 00-1.175 0l-3.97 2.883c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118l-3.97-2.883c-.772-.577-.373-1.81.588-1.81h4.906a1 1 0 00.95-.69l1.519-4.674z"></path></svg>
            </div>
            <div>
                <h1 class="text-xl font-black tracking-wider text-white">AQUAFIN</h1>
                <p class="text-[9px] text-cyan-400 font-black uppercase tracking-[0.2em] mt-0.5">Technieker Portaal</p>
            </div>
        </div>

        <div class="px-4 py-6 flex-grow">
            <nav class="space-y-1.5">
                <a href="{{ route('materiaal.bestellen') }}" class="flex items-center gap-3.5 px-4 py-3.5 rounded-xl font-bold text-sm transition-all {{ request()->routeIs('materiaal.bestellen') ? 'bg-[#005b96] text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('materiaal.bestellen') ? 'text-cyan-300' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Webshop
                </a>
                <a href="{{ route('technieker.historiek') }}" class="flex items-center gap-3.5 px-4 py-3.5 rounded-xl font-bold text-sm transition-all {{ request()->routeIs('technieker.historiek') ? 'bg-[#005b96] text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('technieker.historiek') ? 'text-cyan-300' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    Bestelhistoriek
                </a>
                <a href="{{ route('technieker.meldingen') }}" class="flex items-center gap-3.5 px-4 py-3.5 rounded-xl font-bold text-sm transition-all {{ request()->routeIs('technieker.meldingen') ? 'bg-[#005b96] text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('technieker.meldingen') ? 'text-cyan-300' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Mijn Taken
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-white/5">
            <div class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/5">
                <img class="w-10 h-10 rounded-lg object-cover shadow-inner" src="https://ui-avatars.com/api/?name={{ urlencode(session('naam', 'T')) }}&background=005b96&color=fff&bold=true" alt="Avatar">
                <div class="flex-grow min-w-0">
                    <div class="text-xs font-black text-white truncate leading-tight">{{ session('naam', 'Technieker') }}</div>
                    <a href="{{ route('logout') }}" class="text-[9px] font-bold text-rose-400 hover:text-rose-300 uppercase tracking-widest transition-colors flex items-center gap-1 mt-1 group">
                        Uitloggen
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <!-- Header Mobile -->
    <div class="md:hidden fixed top-0 inset-x-0 h-16 bg-[#001e33] border-b border-white/5 z-40 flex items-center justify-between px-4 shadow-md">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#005b96] to-cyan-400 flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.907c.961 0 1.36 1.233.588 1.81l-3.97 2.883a1 1 0 00-.364 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.971-2.883a1 1 0 00-1.175 0l-3.97 2.883c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118l-3.97-2.883c-.772-.577-.373-1.81.588-1.81h4.906a1 1 0 00.95-.69l1.519-4.674z"></path></svg>
            </div>
            <span class="text-lg font-black text-white tracking-wider">AQUAFIN</span>
        </div>
        <a href="{{ route('logout') }}" class="w-9 h-9 flex items-center justify-center bg-rose-500/10 text-rose-400 rounded-xl border border-rose-500/20 active:bg-rose-500/20 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
        </a>
    </div>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto bg-transparent relative z-10 custom-scrollbar pt-16 md:pt-0">
        <div class="px-4 sm:px-6 lg:px-10 py-8 max-w-[1600px] w-full mx-auto pb-28 md:pb-10">
            
            @if(session('success'))
                <script>
                    localStorage.removeItem('aquafin_cart');
                </script>
                <div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-800 px-5 py-4 rounded-2xl flex items-center shadow-sm">
                    <div class="bg-emerald-500 text-white p-1.5 rounded-xl mr-4 shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
            
        </div> 
    </main>

    <!-- ZWEVENDE CHAT KNOP MET NOTIFICATIE -->
    <div class="fixed bottom-20 right-4 md:bottom-6 md:right-6 z-50" id="floatingChatBtn">
        <button onclick="toggleSupportTicket()" class="w-14 h-14 bg-gradient-to-r from-[#005b96] to-cyan-500 rounded-2xl flex items-center justify-center text-white shadow-2xl hover:scale-105 active:scale-95 transition-all relative border border-cyan-400/20 group">
            <svg class="w-6 h-6 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            @if(isset($aantalOngelezen) && $aantalOngelezen > 0)
                <div class="absolute -top-2 -right-2 bg-rose-500 text-white text-[10px] font-black w-6 h-6 rounded-full border-2 border-white flex items-center justify-center shadow-md animate-bounce">
                    {{ $aantalOngelezen }}
                </div>
            @endif
        </button>
    </div>

    <!-- COULISSANT DU CHAT LIVE AVEC ONGLETS -->
    <div id="supportTicketWindow" class="fixed bottom-36 right-4 md:bottom-24 md:right-6 w-[calc(100vw-32px)] sm:w-96 bg-white rounded-3xl shadow-2xl border border-slate-200 z-50 translate-y-10 opacity-0 pointer-events-none transition-all duration-300 flex flex-col overflow-hidden h-[500px]">
        
        <!-- En-tête du Chat -->
        <div class="p-4 bg-[#001e33] text-white flex justify-between items-center shrink-0">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center shadow-inner">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-400 border-2 border-[#001e33] rounded-full"></div>
                </div>
                <div>
                    <span class="font-black text-xs tracking-wider uppercase text-white block leading-none">Support Center</span>
                    <span class="text-[9px] text-cyan-400 font-bold tracking-widest">Online</span>
                </div>
            </div>
            <button onclick="toggleSupportTicket()" class="text-slate-400 hover:text-white p-1 transition-colors bg-white/5 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- LA BARRE DES ONGLETS -->
        <div class="flex overflow-x-auto bg-slate-100 border-b border-slate-200 hide-scrollbar shrink-0" id="chatTabsContainer">
            <button onclick="switchChatTab('new')" id="tab_new" class="chat-tab px-4 py-3 text-[10px] font-black uppercase tracking-wider whitespace-nowrap border-r border-slate-200 transition-colors bg-white text-[#005b96] border-b-2 border-b-[#005b96]">
                + Nieuw
            </button>
            <button onclick="switchChatTab('history')" id="tab_history" class="chat-tab px-4 py-3 text-[10px] font-black uppercase tracking-wider whitespace-nowrap border-r border-slate-200 transition-colors text-slate-400 hover:bg-white">
                Historiek
            </button>
            @if(isset($openChats))
                @foreach($openChats as $chat)
                <button onclick="switchChatTab('{{ $chat->id }}')" id="tab_{{ $chat->id }}" class="chat-tab px-4 py-3 text-[10px] font-black uppercase tracking-wider whitespace-nowrap border-r border-slate-200 transition-colors text-slate-400 hover:bg-white">
                    {{ $chat->type }}
                    @if($chat->berichten->where('afzender_rol', '!=', 'Technieker')->where('gelezen', false)->count() > 0)
                        <span class="ml-1 w-2 h-2 rounded-full bg-rose-500 inline-block animate-pulse"></span>
                    @endif
                </button>
                @endforeach
            @endif
        </div>

        <!-- VUE 1 : NOUVELLE DEMANDE -->
        <div id="chat_view_new" class="chat-view flex-1 flex flex-col p-5 bg-slate-50 overflow-y-auto">
            <form action="{{ route('chat.start') }}" method="POST" class="flex flex-col">
                @csrf
                <div class="bg-blue-50 border border-blue-100 text-[#005b96] p-3 rounded-xl mb-4 text-xs font-medium">
                    Kies met wie je contact wilt opnemen.
                </div>
                <div class="mb-4">
                    <div class="grid grid-cols-2 gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="doelgroep" value="Magazijnier" class="peer sr-only" required>
                            <div class="p-3 rounded-xl border border-slate-200 bg-white text-center peer-checked:bg-cyan-50 peer-checked:border-cyan-400 peer-checked:text-cyan-700 transition-all">
                                <span class="text-[10px] font-black uppercase">Magazijnier</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="doelgroep" value="Admin" class="peer sr-only">
                            <div class="p-3 rounded-xl border border-slate-200 bg-white text-center peer-checked:bg-[#005b96]/10 peer-checked:border-[#005b96] peer-checked:text-[#005b96] transition-all">
                                <span class="text-[10px] font-black uppercase">Admin</span>
                            </div>
                        </label>
                    </div>
                </div>
                <textarea name="bericht" required class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs font-medium text-slate-700 focus:outline-none focus:border-[#005b96] resize-none mb-4" placeholder="Typ je bericht..."></textarea>
                <button type="submit" class="w-full h-11 bg-[#005b96] hover:bg-[#004a7c] text-white rounded-xl font-black text-xs shadow-md active:scale-95 transition-all">
                    Start Gesprek
                </button>
            </form>
        </div>

        <!-- VUE 2 : HISTORIEK -->
        <div id="chat_view_history" class="chat-view flex-1 flex flex-col p-5 bg-slate-50 overflow-y-auto hidden">
            @if(isset($geslotenChats) && $geslotenChats->count() > 0)
                <div class="space-y-3">
                    @foreach($geslotenChats as $oudeChat)
                        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm opacity-80">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs font-black text-slate-700 uppercase">{{ $oudeChat->type }}</span>
                                <span class="text-[9px] font-bold text-slate-400">{{ $oudeChat->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <p class="text-xs text-slate-500 font-medium line-clamp-2">{{ $oudeChat->bericht }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center h-full text-center text-slate-400">
                    <svg class="w-10 h-10 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-xs font-bold uppercase tracking-wider">Geen geschiedenis</p>
                </div>
            @endif
        </div>

        <!-- VUES 3+ : CHATS ACTIFS -->
        @if(isset($openChats))
            @foreach($openChats as $actieveChat)
            <div id="chat_view_{{ $actieveChat->id }}" class="chat-view flex-1 flex flex-col bg-slate-50 overflow-hidden hidden">
                
                <!-- HEADER AVEC LE BOUTON FERMER -->
                <div class="bg-white border-b border-slate-100 px-4 py-2 flex justify-between items-center shrink-0 shadow-sm z-10">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        Ticket #{{ $actieveChat->id }}
                    </span>
                    <form action="{{ route('chat.close', $actieveChat->id) }}" method="POST" onsubmit="return confirm('Wil je dit gesprek definitief afsluiten?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-[10px] bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white border border-rose-100 px-3 py-1.5 rounded-lg font-black uppercase tracking-wider transition-colors flex items-center gap-1.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Sluiten
                        </button>
                    </form>
                </div>

                <!-- ZONE DES MESSAGES -->
                <div class="flex-1 overflow-y-auto p-4 space-y-4 custom-scrollbar flex flex-col active-chat-container" data-chat-id="{{ $actieveChat->id }}" id="chatContainer_{{ $actieveChat->id }}">
                    @foreach($actieveChat->berichten as $msg)
                        @if($msg->afzender_rol === 'Technieker')
                            <div class="flex justify-end">
                                <div class="bg-[#005b96] text-white p-3 rounded-2xl rounded-tr-sm max-w-[85%] shadow-sm">
                                    <p class="text-xs font-medium">{{ $msg->bericht }}</p>
                                    <div class="flex justify-end items-center gap-1 mt-1.5">
                                        <span class="text-[9px] text-blue-200">{{ $msg->created_at->format('H:i') }}</span>
                                        @if($msg->gelezen)
                                            <svg class="w-3 h-3 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7M5 18l4 4L19 12"></path></svg>
                                        @else
                                            <svg class="w-3 h-3 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex justify-start">
                                <div class="bg-white border border-slate-200 text-slate-700 p-3 rounded-2xl rounded-tl-sm max-w-[85%] shadow-sm">
                                    <p class="text-[10px] font-black text-cyan-600 mb-1">{{ $msg->afzender_rol }}</p>
                                    <p class="text-xs font-medium">{{ $msg->bericht }}</p>
                                    <span class="text-[9px] text-slate-400 mt-1 block text-left">{{ $msg->created_at->format('H:i') }}</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- ZONE POUR RÉPONDRE -->
                <div class="p-3 bg-white border-t border-slate-100 shrink-0">
                    <form action="{{ route('chat.reply', $actieveChat->id) }}" method="POST" class="flex items-end gap-2 chat-reply-form">
                        @csrf
                        <textarea name="reply" rows="1" class="flex-1 bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-xs font-medium text-slate-700 focus:outline-none focus:border-[#005b96] focus:ring-1 focus:ring-[#005b96] transition-all resize-none" placeholder="Typ je antwoord..." required></textarea>
                        <button type="submit" class="w-10 h-10 shrink-0 bg-[#005b96] hover:bg-[#004a7c] text-white rounded-xl flex items-center justify-center transition-transform active:scale-95 shadow-md">
                            <svg class="w-4 h-4 translate-x-[-1px] translate-y-[1px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        @endif
    </div>

    <!-- BOTTOM NAV MOBILE -->
    <div class="md:hidden fixed bottom-0 inset-x-0 bg-[#001e33] border-t border-white/5 pb-safe z-40 shadow-[0_-8px_30px_rgba(0,0,0,0.3)]">
        <div class="flex justify-around items-center h-16">
            <a href="{{ route('materiaal.bestellen') }}" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('materiaal.bestellen') ? 'text-cyan-400' : 'text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <span class="text-[9px] font-black tracking-wider uppercase">Webshop</span>
            </a>
            <a href="{{ route('technieker.historiek') }}" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('technieker.historiek') ? 'text-cyan-400' : 'text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                <span class="text-[9px] font-black tracking-wider uppercase">Historiek</span>
            </a>
            <a href="{{ route('technieker.meldingen') }}" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('technieker.meldingen') ? 'text-cyan-400' : 'text-slate-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="text-[9px] font-black tracking-wider uppercase">Taken</span>
            </a>
        </div>
    </div>

    <!-- SCRIPT AJAX + RECHARGEMENT LIVE + SON + LECTURE AUTOMATIQUE -->
    <script>
        function markAsRead(chatId) {
            if(chatId !== 'new' && chatId !== 'history') {
                fetch('/chat/' + chatId + '/gelezen', {
                    method: 'POST',
                    headers: { 
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });
            }
        }

        function openChat() {
            const windowDiv = document.getElementById('supportTicketWindow');
            if (windowDiv) {
                windowDiv.classList.remove('pointer-events-none', 'opacity-0', 'translate-y-10');
                const activeChat = document.querySelector('.chat-view:not(.hidden) .active-chat-container');
                if(activeChat) {
                    setTimeout(() => { activeChat.scrollTop = activeChat.scrollHeight; }, 50); 
                    let id = activeChat.getAttribute('data-chat-id');
                    markAsRead(id);
                }
            }
        }

        function toggleSupportTicket() {
            const windowDiv = document.getElementById('supportTicketWindow');
            if(windowDiv.classList.contains('pointer-events-none')) {
                openChat();
            } else {
                windowDiv.classList.add('pointer-events-none', 'opacity-0', 'translate-y-10');
            }
        }

        function switchChatTab(id) {
            document.querySelectorAll('.chat-view').forEach(view => view.classList.add('hidden'));
            document.getElementById('chat_view_' + id).classList.remove('hidden');
            
            document.querySelectorAll('.chat-tab').forEach(tab => {
                tab.classList.remove('bg-white', 'text-[#005b96]', 'border-b-2', 'border-b-[#005b96]');
                tab.classList.add('text-slate-400');
            });
            let activeTab = document.getElementById('tab_' + id);
            activeTab.classList.remove('text-slate-400');
            activeTab.classList.add('bg-white', 'text-[#005b96]', 'border-b-2', 'border-b-[#005b96]');

            if(id !== 'new' && id !== 'history') {
                const container = document.getElementById('chatContainer_' + id);
                if(container) container.scrollTop = container.scrollHeight;
                markAsRead(id); 
            }
        }

        @if(session()->has('chat_open'))
            setTimeout(() => { openChat(); }, 150);
        @endif

        document.addEventListener('submit', function(e) {
            if(e.target && e.target.classList.contains('chat-reply-form')) {
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

        setInterval(() => {
            fetch(window.location.href)
            .then(response => response.text())
            .then(html => {
                let doc = new DOMParser().parseFromString(html, 'text/html');
                
                document.querySelectorAll('.active-chat-container').forEach(container => {
                    let id = container.getAttribute('data-chat-id');
                    let newContainer = doc.getElementById('chatContainer_' + id);
                    if(newContainer && container.innerHTML !== newContainer.innerHTML) {
                        container.innerHTML = newContainer.innerHTML;
                        container.scrollTop = container.scrollHeight;
                        
                        if(!document.getElementById('supportTicketWindow').classList.contains('pointer-events-none') && 
                           !document.getElementById('chat_view_' + id).classList.contains('hidden')) {
                            markAsRead(id);
                        }
                    }
                });

                let oldBtn = document.getElementById('floatingChatBtn');
                let newBtn = doc.getElementById('floatingChatBtn');
                if(oldBtn && newBtn) {
                    let hadBadge = oldBtn.innerHTML.includes('animate-bounce');
                    let hasBadge = newBtn.innerHTML.includes('animate-bounce');
                    if(hasBadge && !hadBadge) {
                        let audio = new Audio('https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3');
                        audio.play().catch(e => console.log('Son bloqué par le navigateur'));
                    }
                    oldBtn.innerHTML = newBtn.innerHTML;
                }

                let oldTabs = document.getElementById('chatTabsContainer');
                let newTabs = doc.getElementById('chatTabsContainer');
                if(oldTabs && newTabs) oldTabs.innerHTML = newTabs.innerHTML;
            });
        }, 3000);
    </script>

    @yield('scripts')
</body>
</html>