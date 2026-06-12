@extends('layouts.app')

@section('title', 'Materiaal Webshop')

@section('content')

@php
    $suggestedRefs = $weer['aanbevolen_refs'] ?? [];
    $aanbevolenMaterialen = $materialen->filter(function($item) use ($suggestedRefs) {
        return in_array(strtoupper($item->artikelnummer), $suggestedRefs);
    });
@endphp

<div class="max-w-7xl mx-auto relative pb-24 px-4 sm:px-6 lg:px-8 mt-6">
    
    <!-- EN-TÊTE ULTRA PREMIUM -->
    <div class="flex flex-col lg:flex-row justify-between lg:items-end gap-6 mb-8">
        <div>
            <span class="text-xs font-black tracking-[0.2em] text-[#005b96] uppercase mb-1 block">Aquafin Supply</span>
            <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">Materiaal Webshop</h1>
        </div>
        
        <div class="flex items-center gap-3 relative z-50">
            <div class="w-full md:w-80 relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-[#005b96] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" id="searchInput" placeholder="Snel zoeken..." autocomplete="off" class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-[#005b96] transition-all shadow-[0_2px_10px_rgba(0,0,0,0.02)] font-medium text-slate-800 placeholder-slate-400">
                <div id="searchSuggestions" class="absolute z-[60] w-full bg-white border border-slate-100 shadow-2xl rounded-2xl mt-2 hidden max-h-60 overflow-y-auto custom-scrollbar p-2"></div>
            </div>

            <button onclick="toggleCart()" class="relative bg-slate-900 hover:bg-black text-white px-6 py-3 rounded-2xl font-bold shadow-[0_4px_15px_rgba(0,0,0,0.1)] hover:shadow-[0_8px_25px_rgba(0,0,0,0.2)] hover:-translate-y-0.5 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="hidden sm:inline">Winkelwagen</span>
                <span id="cartCount" class="absolute -top-2 -right-2 bg-rose-500 text-white text-xs w-6 h-6 flex items-center justify-center rounded-full font-black shadow-md border-2 border-white scale-0 transition-transform">0</span>
            </button>
        </div>
    </div>

    <!-- 🌟 WEERGEVOELIGE AANBEVELINGEN -->
    @if(isset($weer) && $weer['is_beschikbaar'])
        <div id="weatherSection" class="mb-10">
            <div class="bg-gradient-to-br from-[#002a4a] to-[#004274] rounded-[2rem] p-6 md:p-8 relative overflow-hidden shadow-xl border border-[#005b96]">
                <div class="absolute top-[-50%] right-[-10%] w-96 h-96 bg-cyan-400/20 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="relative z-10">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-6">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <span class="px-3 py-1 rounded-lg bg-cyan-500/20 text-cyan-300 text-[10px] font-black tracking-widest uppercase border border-cyan-400/20">Aanbevolen</span>
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            </div>
                            <h2 class="text-2xl font-black text-white tracking-tight">Weersgebonden Uitrusting</h2>
                        </div>

                        <div class="flex items-center gap-4 bg-white/5 border border-white/10 px-5 py-3 rounded-2xl backdrop-blur-sm">
                            <div class="text-white">
                                @if($weer['code'] <= 3)
                                    <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                @elseif($weer['code'] >= 71)
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                                @else
                                    <svg class="w-8 h-8 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                                @endif
                            </div>
                            <div class="h-8 w-px bg-white/20"></div>
                            <div>
                                <div class="text-[10px] uppercase tracking-widest text-cyan-100/70 font-bold mb-0.5">Brussel - {{ $weer['temp'] }}°C</div>
                                <div class="text-sm font-extrabold {{ $weer['gevaar'] == 'Kritiek' ? 'text-rose-400' : ($weer['gevaar'] == 'Gemiddeld' ? 'text-amber-400' : 'text-emerald-400') }}">
                                    {{ $weer['gevaar'] == 'Kritiek' ? 'Zware Neerslag' : ($weer['gevaar'] == 'Gemiddeld' ? 'Lichte Regen' : 'Optimaal') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($aanbevolenMaterialen->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach($aanbevolenMaterialen as $item)
                                <div class="bg-white/10 border border-white/10 rounded-xl p-4 flex flex-col justify-between hover:bg-white/15 transition-all duration-300">
                                    <div>
                                        <div class="flex justify-between items-start mb-2">
                                            <div class="text-[10px] font-black text-cyan-300 tracking-wider bg-[#002a4a] px-2 py-1 rounded">{{ $item->artikelnummer }}</div>
                                        </div>
                                        <h3 class="text-sm font-bold text-white leading-tight mb-4">{{ $item->omschrijving }}</h3>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input type="number" id="qty-rec-{{ $item->id }}" min="1" max="{{ $item->beschikbaar > 0 ? $item->beschikbaar : 1 }}" value="1" {{ $item->beschikbaar == 0 ? 'disabled' : '' }} class="w-14 h-9 bg-black/40 border border-white/20 text-white rounded-lg focus:outline-none focus:border-cyan-400 text-center font-bold text-sm">
                                        <button onclick="addToCart({{ $item->id }}, '{{ addslashes($item->omschrijving) }}', '{{ $item->artikelnummer }}', {{ $item->beschikbaar }}, 'rec')" {{ $item->beschikbaar == 0 ? 'disabled' : '' }} class="flex-grow h-9 bg-cyan-500 hover:bg-cyan-400 disabled:bg-white/10 disabled:text-white/30 text-[#002a4a] font-bold rounded-lg transition-all shadow-md active:scale-95 text-xs">
                                            Toevoegen
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white/5 border border-white/10 rounded-xl p-6 flex items-center gap-4">
                            <div class="w-12 h-12 bg-emerald-500/20 rounded-full flex items-center justify-center text-emerald-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-white">Standaard uitrusting volstaat</h3>
                                <p class="text-xs text-blue-200/70 mt-1">Geen weersgebonden uitzonderingen vandaag.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- CATALOGUE CLASSIQUE -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h2 class="text-xl font-black text-slate-800 tracking-tight">Volledige Catalogus</h2>
        
        <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0 w-full md:w-auto hide-scrollbar" id="categoryFilters">
            <button class="cat-btn active bg-slate-900 text-white px-5 py-2 rounded-xl font-bold text-xs tracking-wide whitespace-nowrap transition-all shadow-md" data-prefix="ALL">Alles</button>
            <button class="cat-btn bg-white text-slate-600 border border-slate-200 hover:border-[#005b96] hover:text-[#005b96] px-5 py-2 rounded-xl font-bold text-xs tracking-wide whitespace-nowrap transition-all" data-prefix="BEV">Bevestiging</button>
            <button class="cat-btn bg-white text-slate-600 border border-slate-200 hover:border-[#005b96] hover:text-[#005b96] px-5 py-2 rounded-xl font-bold text-xs tracking-wide whitespace-nowrap transition-all" data-prefix="PBM">Veiligheid</button>
            <button class="cat-btn bg-white text-slate-600 border border-slate-200 hover:border-[#005b96] hover:text-[#005b96] px-5 py-2 rounded-xl font-bold text-xs tracking-wide whitespace-nowrap transition-all" data-prefix="GER">Gereedschap</button>
            <button class="cat-btn bg-white text-slate-600 border border-slate-200 hover:border-[#005b96] hover:text-[#005b96] px-5 py-2 rounded-xl font-bold text-xs tracking-wide whitespace-nowrap transition-all" data-prefix="TEC">Onderhoud</button>
            
            <div class="h-8 w-px bg-slate-200 mx-1 hidden md:block"></div>
            
            <button id="btnFavFilter" class="bg-white text-slate-600 border border-slate-200 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 px-4 py-2 rounded-xl font-bold text-xs flex items-center gap-1.5 transition-all whitespace-nowrap">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                Favorieten
            </button>
        </div>
    </div>

    <!-- GRILLE HAUTE DENSITÉ (Compacte B2B) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-4" id="productGrid">
        @foreach($materialen as $item)
            <div class="product-card bg-white p-3 rounded-2xl border border-slate-200 shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] hover:border-blue-300 hover:shadow-[0_8px_20px_-4px_rgba(0,91,150,0.1)] transition-all duration-200 flex flex-row items-center gap-4 group" data-id="{{ $item->id }}" data-ref="{{ $item->artikelnummer }}" data-item-ref="{{ strtoupper($item->artikelnummer) }}">
                
                <!-- Vignette (Vibrante) -->
                <div class="w-20 h-20 shrink-0 rounded-xl relative overflow-hidden flex items-center justify-center">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->omschrijving }}" class="w-full h-full object-cover">
                    @else
                        @php
                            $prefix = strtoupper(substr($item->artikelnummer, 0, 3));
                            $gradient = match($prefix) {
                                'BEV' => 'from-blue-500 to-blue-700', 
                                'PBM' => 'from-orange-400 to-orange-600', 
                                'GER' => 'from-amber-400 to-amber-600', 
                                'TEC' => 'from-cyan-500 to-blue-600', 
                                'AQF' => 'from-sky-400 to-sky-600', 
                                default => 'from-slate-400 to-slate-600'
                            };
                            $iconPath = match($prefix) {
                                'BEV' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>',
                                'PBM' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>',
                                'GER' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>',
                                'TEC' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>',
                                'AQF' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>',
                                default => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>'
                            };
                        @endphp
                        <div class="w-full h-full bg-gradient-to-br {{ $gradient }} flex items-center justify-center">
                            <svg class="w-8 h-8 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $iconPath !!}
                            </svg>
                        </div>
                    @endif
                    
                    <button class="btn-favorite absolute top-1 left-1 p-1.5 rounded-full bg-black/20 text-white/50 hover:text-rose-400 transition-colors" onclick="toggleFavorite({{ $item->id }}, this)">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>
                </div>

                <!-- Informations -->
                <div class="flex-grow flex flex-col justify-center py-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-[10px] font-black tracking-widest text-slate-400">{{ $item->artikelnummer }}</span>
                        @if($item->beschikbaar > 0)
                            <span class="text-[9px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded">{{ $item->beschikbaar }} op voorraad</span>
                        @else
                            <span class="text-[9px] font-bold text-rose-600 bg-rose-50 px-1.5 py-0.5 rounded">Uitgeput</span>
                        @endif
                    </div>
                    <h3 class="text-sm font-extrabold text-slate-800 leading-tight group-hover:text-[#005b96] transition-colors pr-2">{{ $item->omschrijving }}</h3>
                </div>

                <!-- Actions -->
                <div class="shrink-0 flex flex-col sm:flex-row lg:flex-col items-end sm:items-center lg:items-end gap-2 border-l border-slate-100 pl-4 py-1">
                    <input type="number" id="qty-main-{{ $item->id }}" min="1" max="{{ $item->beschikbaar > 0 ? $item->beschikbaar : 1 }}" value="1" {{ $item->beschikbaar == 0 ? 'disabled' : '' }} class="w-14 h-8 bg-slate-50 border border-slate-200 text-slate-800 rounded-lg focus:outline-none focus:border-[#005b96] text-center font-bold text-xs">
                    <button onclick="addToCart({{ $item->id }}, '{{ addslashes($item->omschrijving) }}', '{{ $item->artikelnummer }}', {{ $item->beschikbaar }}, 'main')" {{ $item->beschikbaar == 0 ? 'disabled' : '' }} class="w-14 h-8 bg-slate-900 hover:bg-[#005b96] disabled:bg-slate-200 disabled:text-slate-400 text-white rounded-lg transition-colors flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ETAT VIDE -->
    <div id="noResults" class="hidden py-16 text-center flex-col items-center justify-center bg-white rounded-2xl border border-dashed border-slate-200 mt-6 shadow-sm">
        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4 mx-auto text-slate-400">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-1">Geen materiaal gevonden</h3>
        <p class="text-slate-500 text-sm">Probeer een andere zoekterm of categorie.</p>
    </div>

    <!-- SIDEBAR PANIER -->
    <div id="cartSidebar" class="fixed inset-y-0 right-0 w-full sm:w-[420px] bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-[100] flex flex-col border-l border-slate-200">
        <div class="p-6 bg-slate-900 flex justify-between items-center text-white">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <h2 class="text-xl font-black tracking-tight">Winkelwagen</h2>
            </div>
            <button onclick="toggleCart()" class="text-white/70 hover:text-white transition-colors p-2 hover:bg-white/10 rounded-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <div id="cartItems" class="flex-grow overflow-y-auto p-6 space-y-3 custom-scrollbar bg-slate-50"></div>

        <div class="p-6 bg-white border-t border-slate-200">
            <form action="{{ route('materiaal.bestellen.store') }}" method="POST" id="checkoutForm">
                @csrf
                <input type="hidden" name="cart_data" id="cartDataInput">
                <button type="submit" id="btnCheckout" class="w-full py-4 bg-[#005b96] hover:bg-[#003d66] text-white rounded-[1rem] font-black shadow-lg hover:-translate-y-0.5 transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    Bestelling Plaatsen
                </button>
            </form>
        </div>
    </div>
    
    <div id="cartOverlay" onclick="toggleCart()" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden opacity-0 transition-opacity duration-300"></div>

</div>

<!-- JAVASCRIPT -->
<script>
    let cart = JSON.parse(localStorage.getItem('aquafin_cart')) || [];
    let favorites = JSON.parse(localStorage.getItem('aquafin_favorites')) || [];
    let currentCategory = 'ALL';
    let showOnlyFavorites = false;
    let serverValidIds = null;

    function toggleCart() {
        const sidebar = document.getElementById('cartSidebar');
        const overlay = document.getElementById('cartOverlay');
        const supportWidget = document.getElementById('support-widget'); 
        
        if(sidebar.classList.contains('translate-x-full')) {
            sidebar.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            
            if(supportWidget) {
                supportWidget.style.transform = window.innerWidth > 640 ? 'translateX(-420px)' : 'translateX(-100vw)';
                supportWidget.style.transition = 'transform 0.3s ease-in-out';
            }
            renderCart();
        } else {
            sidebar.classList.add('translate-x-full');
            overlay.classList.add('opacity-0');
            setTimeout(() => overlay.classList.add('hidden'), 300);
            
            if(supportWidget) supportWidget.style.transform = 'translateX(0)';
        }
    }

    function addToCart(id, name, ref, maxStock, prefix) {
        const qtyInput = document.getElementById(`qty-${prefix}-${id}`);
        const qty = parseInt(qtyInput.value);
        if(qty > maxStock || qty < 1) return alert('Ongeldig aantal');

        const existingItem = cart.find(i => i.id === id);
        if(existingItem) {
            if(existingItem.aantal + qty > maxStock) existingItem.aantal = maxStock;
            else existingItem.aantal += qty;
        } else {
            cart.push({ id: id, naam: name, ref: ref, aantal: qty, max: maxStock });
        }
        
        localStorage.setItem('aquafin_cart', JSON.stringify(cart));
        updateCartBadge();
        
        const btn = event.currentTarget;
        const originalText = btn.innerHTML;
        btn.innerHTML = `<svg class="w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>`;
        
        if(prefix === 'rec') {
            btn.classList.replace('bg-cyan-500', 'bg-emerald-400');
            btn.classList.replace('text-[#002a4a]', 'text-slate-900');
        } else {
            btn.classList.replace('bg-slate-900', 'bg-emerald-500');
        }

        setTimeout(() => {
            btn.innerHTML = originalText;
            if(prefix === 'rec') {
                btn.classList.replace('bg-emerald-400', 'bg-cyan-500');
                btn.classList.replace('text-slate-900', 'text-[#002a4a]');
            } else {
                btn.classList.replace('bg-emerald-500', 'bg-slate-900');
            }
        }, 1000);
    }

    function updateCartQty(id, delta) {
        let item = cart.find(i => i.id === id);
        if(item) {
            item.aantal += delta;
            if(item.aantal <= 0) {
                removeFromCart(id);
                return;
            } else if(item.aantal > item.max) {
                item.aantal = item.max;
                alert('Maximum bereikt.');
            }
            localStorage.setItem('aquafin_cart', JSON.stringify(cart));
            renderCart();
            updateCartBadge();
        }
    }

    function removeFromCart(id) {
        cart = cart.filter(i => i.id !== id);
        localStorage.setItem('aquafin_cart', JSON.stringify(cart));
        renderCart();
        updateCartBadge();
    }

    function updateCartBadge() {
        const badge = document.getElementById('cartCount');
        const total = cart.reduce((sum, item) => sum + item.aantal, 0);
        badge.innerText = total;
        if(total > 0) badge.classList.remove('scale-0');
        else badge.classList.add('scale-0');
        
        document.getElementById('cartDataInput').value = JSON.stringify(cart);
        document.getElementById('btnCheckout').disabled = total === 0;
    }

    function renderCart() {
        const container = document.getElementById('cartItems');
        container.innerHTML = '';
        if(cart.length === 0) {
            container.innerHTML = `
                <div class="text-center text-slate-400 py-10 flex flex-col items-center">
                    <div class="w-16 h-16 bg-white border border-slate-200 rounded-full flex items-center justify-center mb-4 shadow-sm">
                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <p class="font-medium text-sm">Je winkelwagen is leeg.</p>
                </div>`;
            return;
        }
        
        cart.forEach(item => {
            container.innerHTML += `
                <div class="bg-white p-3 rounded-xl border border-slate-200 shadow-sm flex items-center group">
                    <div class="flex-grow pr-2">
                        <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest">${item.ref}</div>
                        <div class="font-bold text-slate-800 text-sm leading-tight mt-0.5">${item.naam}</div>
                    </div>
                    
                    <div class="flex items-center gap-1 bg-slate-50 p-1 rounded-lg border border-slate-100">
                        <button type="button" onclick="updateCartQty(${item.id}, -1)" class="w-7 h-7 flex items-center justify-center bg-white rounded shadow-sm text-slate-600 hover:text-rose-500 font-bold">-</button>
                        <span class="font-black text-sm text-slate-800 w-6 text-center">${item.aantal}</span>
                        <button type="button" onclick="updateCartQty(${item.id}, 1)" class="w-7 h-7 flex items-center justify-center bg-white rounded shadow-sm text-slate-600 hover:text-emerald-500 font-bold">+</button>
                    </div>

                    <button onclick="removeFromCart(${item.id})" class="ml-2 text-slate-300 hover:text-rose-500 transition-colors p-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            `;
        });
    }

    const searchInput = document.getElementById('searchInput');
    const suggestionsBox = document.getElementById('searchSuggestions');
    const cards = document.querySelectorAll('#productGrid .product-card');

    searchInput.addEventListener('input', function() {
        let rechercheBrute = this.value.trim();
        suggestionsBox.innerHTML = '';
        
        if(rechercheBrute.length === 0) {
            suggestionsBox.classList.add('hidden');
            serverValidIds = null;
            filtrerGrid(''); 
            
            const weatherSec = document.getElementById('weatherSection');
            if(weatherSec) weatherSec.style.display = '';
            return;
        }

        const weatherSec = document.getElementById('weatherSection');
        if(weatherSec) weatherSec.style.display = 'none';

        fetch(`/api/materiaal/search?q=${encodeURIComponent(rechercheBrute)}`)
            .then(response => response.json())
            .then(data => {
                suggestionsBox.innerHTML = '';
                let aAfficher = false;

                if(data.bedoelde_je) {
                    suggestionsBox.innerHTML += `
                        <div class="p-3 bg-blue-50 border-b border-blue-100 flex items-center text-sm transition-colors cursor-pointer hover:bg-blue-100 rounded-t-xl" onclick="appliquerCorrection('${data.bedoelde_je}')">
                            <svg class="w-4 h-4 mr-2 text-[#005b96]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-slate-600">Bedoelde je: <strong class="text-[#005b96] tracking-wide">${data.bedoelde_je}</strong> ?</span>
                        </div>
                    `;
                    aAfficher = true;
                } 
                
                if (data.artikelen.length > 0) {
                    data.artikelen.slice(0, 4).forEach(item => {
                        let nomSafe = item.omschrijving.replace(/'/g, "\\'");
                        suggestionsBox.innerHTML += `
                            <div class="p-3 hover:bg-slate-50 cursor-pointer flex items-center text-sm text-slate-700 font-medium rounded-lg m-1" onclick="appliquerCorrection('${nomSafe}')">
                                <span class="w-6 h-6 bg-slate-100 rounded-md flex items-center justify-center mr-3"><svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></span> 
                                ${item.omschrijving}
                            </div>
                        `;
                    });
                    aAfficher = true;
                } else if (!data.bedoelde_je) {
                    suggestionsBox.innerHTML = `<div class="p-4 text-slate-400 text-sm text-center font-medium">Geen materiaal gevonden</div>`;
                    aAfficher = true;
                }

                if(aAfficher) suggestionsBox.classList.remove('hidden');

                serverValidIds = data.artikelen.map(i => i.id.toString());
                filtrerGrid(data.bedoelde_je || rechercheBrute);
            });
    });

    window.appliquerCorrection = function(correction) {
        searchInput.value = correction;
        suggestionsBox.classList.add('hidden');
        searchInput.dispatchEvent(new Event('input'));
    };

    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.classList.add('hidden');
        }
    });

    function filtrerGrid(recherche) {
        let visibleCount = 0;

        cards.forEach(card => {
            let id = card.getAttribute('data-id');
            let refPrefix = card.getAttribute('data-ref').toUpperCase().substring(0, 3);
            
            let matchCategory = false;
            if (currentCategory === 'ALL') {
                matchCategory = true;
            } else {
                matchCategory = (refPrefix === currentCategory);
            }

            let matchFavorite = !showOnlyFavorites || favorites.includes(parseInt(id));
            let matchSearch = (serverValidIds === null) || serverValidIds.includes(id);

            if (matchCategory && matchSearch && matchFavorite) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        document.getElementById('noResults').style.display = visibleCount === 0 ? 'flex' : 'none';
        document.getElementById('productGrid').style.display = visibleCount === 0 ? 'none' : 'grid';
    }

    document.querySelectorAll('.cat-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.cat-btn').forEach(b => {
                b.classList.remove('bg-slate-900', 'text-white', 'shadow-md');
                b.classList.add('bg-white', 'text-slate-600');
            });
            this.classList.remove('bg-white', 'text-slate-600');
            this.classList.add('bg-slate-900', 'text-white', 'shadow-md');
            currentCategory = this.getAttribute('data-prefix');
            filtrerGrid(searchInput.value.trim()); 
        });
    });

    document.getElementById('btnFavFilter').addEventListener('click', function() {
        showOnlyFavorites = !showOnlyFavorites;
        if(showOnlyFavorites) {
            this.classList.add('bg-rose-50', 'text-rose-600', 'border-rose-200');
            this.classList.remove('bg-white', 'text-slate-600', 'border-slate-200');
        } else {
            this.classList.remove('bg-rose-50', 'text-rose-600', 'border-rose-200');
            this.classList.add('bg-white', 'text-slate-600', 'border-slate-200');
        }
        filtrerGrid(searchInput.value.trim());
    });

    function initFavorites() {
        document.querySelectorAll('.product-card').forEach(card => {
            const id = parseInt(card.getAttribute('data-id'));
            const btn = card.querySelector('.btn-favorite');
            if(btn && favorites.includes(id)) {
                btn.classList.remove('text-white/50', 'bg-black/20');
                btn.classList.add('text-rose-500', 'bg-white');
                btn.innerHTML = `<svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>`;
            }
        });
    }

    function toggleFavorite(id, btnElement) {
        const index = favorites.indexOf(id);
        if(index > -1) {
            favorites.splice(index, 1);
            document.querySelectorAll(`[data-id="${id}"] .btn-favorite`).forEach(btn => {
                btn.classList.remove('text-rose-500', 'bg-white');
                btn.classList.add('text-white/50', 'bg-black/20');
                btn.innerHTML = `<svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>`;
            });
        } else {
            favorites.push(id);
            document.querySelectorAll(`[data-id="${id}"] .btn-favorite`).forEach(btn => {
                btn.classList.remove('text-white/50', 'bg-black/20');
                btn.classList.add('text-rose-500', 'bg-white');
                btn.innerHTML = `<svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>`;
            });
        }
        localStorage.setItem('aquafin_favorites', JSON.stringify(favorites));
        if(showOnlyFavorites) filtrerGrid(searchInput.value.trim()); 
    }

    if (document.querySelector('meta[name="clear-cart"]')) {
        localStorage.removeItem('aquafin_cart');
        cart = [];
        updateCartBadge();
    }

    document.addEventListener('DOMContentLoaded', () => {
        initFavorites();
        updateCartBadge();
    });
</script>

<style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .custom-scrollbar::-webkit-scrollbar { height: 4px; width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>
@endsection