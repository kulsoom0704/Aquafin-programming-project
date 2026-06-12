@extends('layouts.app')

@section('title', 'Materiaal Webshop')

@section('content')
<div class="max-w-7xl mx-auto relative">
    
    <div class="mb-6 flex flex-col md:flex-row justify-between md:items-end gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight flex items-center">
                <svg class="w-8 h-8 mr-3 text-[#005b96]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Materiaal Webshop
            </h1>
            <p class="text-slate-500 mt-2 font-medium">Bestel materiaal direct uit het centrale magazijn.</p>
        </div>
        
        <div class="flex gap-3 relative">
            <div class="w-full md:w-80 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" id="searchInput" placeholder="Zoek op naam of ref..." autocomplete="off" class="w-full pl-10 pr-4 py-3 bg-white border-2 border-slate-200 rounded-xl focus:outline-none focus:border-[#005b96] focus:ring-2 focus:ring-blue-100 transition-all shadow-sm font-medium text-slate-700">
                
                <div id="searchSuggestions" class="absolute z-[60] w-full bg-white border border-slate-200 shadow-xl rounded-xl mt-2 hidden max-h-60 overflow-y-auto custom-scrollbar">
                </div>
            </div>

            <button onclick="toggleCart()" class="relative bg-gradient-to-r from-[#005b96] to-cyan-600 text-white px-5 py-3 rounded-xl font-bold shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Winkelwagen
                <span id="cartCount" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-6 h-6 flex items-center justify-center rounded-full font-black border-2 border-white scale-0 transition-transform">0</span>
            </button>
        </div>
    </div>

    <div class="flex justify-between items-center mb-8">
        <div class="flex gap-2 overflow-x-auto pb-2 custom-scrollbar" id="categoryFilters">
            <button class="cat-btn active bg-[#005b96] text-white px-5 py-2 rounded-xl font-bold text-sm whitespace-nowrap transition-colors shadow-md" data-prefix="ALL">Alles</button>
            <button class="cat-btn bg-white text-slate-600 hover:bg-slate-100 border border-slate-200 px-5 py-2 rounded-xl font-bold text-sm whitespace-nowrap transition-colors" data-prefix="BEV">Bevestiging</button>
            <button class="cat-btn bg-white text-slate-600 hover:bg-slate-100 border border-slate-200 px-5 py-2 rounded-xl font-bold text-sm whitespace-nowrap transition-colors" data-prefix="PBM">Veiligheid</button>
            <button class="cat-btn bg-white text-slate-600 hover:bg-slate-100 border border-slate-200 px-5 py-2 rounded-xl font-bold text-sm whitespace-nowrap transition-colors" data-prefix="GER">Gereedschap</button>
            <button class="cat-btn bg-white text-slate-600 hover:bg-slate-100 border border-slate-200 px-5 py-2 rounded-xl font-bold text-sm whitespace-nowrap transition-colors" data-prefix="TEC">Onderhoud</button>
        </div>
        
        <button id="btnFavFilter" class="ml-4 bg-rose-50 text-rose-600 border border-rose-200 px-4 py-2 rounded-xl font-bold text-sm flex items-center hover:bg-rose-100 transition-colors whitespace-nowrap">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            Mijn Favorieten
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="productGrid">
        @foreach($materialen as $item)
            <div class="product-card bg-white/90 backdrop-blur-sm rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group" data-id="{{ $item->id }}" data-ref="{{ $item->artikelnummer }}" data-name="{{ $item->omschrijving }}" data-stock="{{ $item->beschikbaar }}">
                
                <div class="h-48 relative overflow-hidden border-b border-slate-100">
                    <button class="btn-favorite absolute top-3 left-3 z-10 p-2 rounded-full bg-white/80 backdrop-blur-sm border border-slate-200 text-slate-300 hover:text-rose-500 transition-colors" onclick="toggleFavorite({{ $item->id }}, this)">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>

                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->omschrijving }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        @php
                            $prefix = strtoupper(substr($item->artikelnummer, 0, 3));
                            $theme = match($prefix) {
                                'BEV' => ['bg' => 'from-slate-100 to-slate-200', 'text' => 'text-slate-500', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>'],
                                'PBM' => ['bg' => 'from-orange-50 to-orange-100', 'text' => 'text-orange-500', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>'],
                                'GER' => ['bg' => 'from-amber-50 to-amber-100', 'text' => 'text-amber-500', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>'],
                                'TEC' => ['bg' => 'from-blue-50 to-blue-100', 'text' => 'text-blue-500', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>'],
                                'AQF' => ['bg' => 'from-cyan-50 to-cyan-100', 'text' => 'text-cyan-500', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>'],
                                default => ['bg' => 'from-gray-50 to-gray-100', 'text' => 'text-gray-400', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>']
                            };
                        @endphp
                        <div class="w-full h-full bg-gradient-to-br {{ $theme['bg'] }} flex flex-col items-center justify-center group-hover:scale-105 transition-transform duration-500">
                            <svg class="w-16 h-16 {{ $theme['text'] }} mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $theme['icon'] !!}
                            </svg>
                            <span class="text-[10px] font-black {{ $theme['text'] }} uppercase tracking-widest opacity-80">{{ $prefix }}</span>
                        </div>
                    @endif
                    
                    <div class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-black shadow-sm {{ $item->beschikbaar > 5 ? 'bg-emerald-100 text-emerald-700' : ($item->beschikbaar > 0 ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                        @if($item->beschikbaar > 0)
                            {{ $item->beschikbaar }} op voorraad
                        @else
                            UITGEPUT
                        @endif
                    </div>
                </div>

                <div class="p-5 flex-grow flex flex-col">
                    <div class="text-xs font-bold text-slate-400 mb-1 item-ref">{{ $item->artikelnummer }}</div>
                    <h3 class="text-lg font-extrabold text-slate-800 leading-tight mb-4 item-name group-hover:text-[#005b96] transition-colors">{{ $item->omschrijving }}</h3>
                    
                    <div class="mt-auto flex items-center gap-3">
                        <input type="number" id="qty-{{ $item->id }}" min="1" max="{{ $item->beschikbaar > 0 ? $item->beschikbaar : 1 }}" value="1" {{ $item->beschikbaar == 0 ? 'disabled' : '' }} class="w-16 bg-slate-50 border border-slate-200 text-slate-700 py-2.5 px-2 rounded-xl focus:outline-none focus:border-[#005b96] text-center font-bold">
                        
                        <button onclick="addToCart({{ $item->id }}, '{{ addslashes($item->omschrijving) }}', '{{ $item->artikelnummer }}', {{ $item->beschikbaar }})" {{ $item->beschikbaar == 0 ? 'disabled' : '' }} class="flex-grow bg-slate-800 hover:bg-black disabled:bg-slate-300 disabled:cursor-not-allowed text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-md active:scale-95 flex items-center justify-center">
                            + Toevoegen
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="noResults" class="hidden py-12 text-center flex-col items-center justify-center">
        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4 mx-auto">
            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-700 mb-1">Geen materiaal gevonden</h3>
        <p class="text-slate-500 text-sm">Probeer een andere zoekterm of categorie.</p>
    </div>

    <div id="cartSidebar" class="fixed inset-y-0 right-0 w-full sm:w-[400px] bg-white shadow-2xl transform translate-x-full transition-transform duration-300 z-[100] flex flex-col border-l border-slate-200">
        <div class="p-6 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
            <h2 class="text-2xl font-black text-slate-800">Winkelwagen</h2>
            <button onclick="toggleCart()" class="text-slate-400 hover:text-rose-500 transition-colors p-2 bg-white rounded-full shadow-sm border border-slate-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <div id="cartItems" class="flex-grow overflow-y-auto p-6 space-y-4 custom-scrollbar">
            </div>

        <div class="p-6 border-t border-slate-200 bg-white shadow-[0_-10px_20px_rgba(0,0,0,0.02)]">
            <form action="{{ route('materiaal.bestellen.store') }}" method="POST" id="checkoutForm">
                @csrf
                <input type="hidden" name="cart_data" id="cartDataInput">
                <button type="submit" id="btnCheckout" class="w-full py-4 bg-gradient-to-r from-[#005b96] to-cyan-600 hover:from-blue-800 hover:to-cyan-700 text-white font-black rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all text-lg flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed">
                    Bestelling Bevestigen
                </button>
            </form>
        </div>
    </div>
    
    <div id="cartOverlay" onclick="toggleCart()" class="fixed inset-0 bg-slate-900/30 backdrop-blur-sm z-40 hidden opacity-0 transition-opacity duration-300"></div>

</div>

<script>
    // --- VARIABLES D'ÉTAT ---
    let cart = JSON.parse(localStorage.getItem('aquafin_cart')) || [];
    let favorites = JSON.parse(localStorage.getItem('aquafin_favorites')) || [];
    let currentCategory = 'ALL';
    let showOnlyFavorites = false;
    let serverValidIds = null; // C'est ici qu'on stockera ce que le serveur valide

    // --- 1. GESTION DU PANIER & DE L'INTERFACE (Ton code d'origine intact) ---
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

    function addToCart(id, name, ref, maxStock) {
        const qtyInput = document.getElementById(`qty-${id}`);
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
        btn.innerHTML = `<svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>`;
        btn.classList.replace('bg-slate-800', 'bg-emerald-500');
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.replace('bg-emerald-500', 'bg-slate-800');
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
                alert('Maximum beschikbare voorraad bereikt.');
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
                <div class="text-center text-slate-400 mt-10 flex flex-col items-center">
                    <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <p class="font-medium">Je winkelwagen is leeg.</p>
                </div>`;
            return;
        }
        
        cart.forEach(item => {
            container.innerHTML += `
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col">
                    <div class="flex justify-between items-start mb-3">
                        <div class="pr-2">
                            <div class="text-[10px] font-black text-slate-400 uppercase tracking-wider">${item.ref}</div>
                            <div class="font-bold text-slate-800 text-sm leading-tight">${item.naam}</div>
                        </div>
                        <button onclick="removeFromCart(${item.id})" class="text-slate-300 hover:text-rose-500 transition-colors p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                    <div class="flex items-center justify-between bg-slate-50 p-1.5 rounded-lg border border-slate-100 w-full">
                        <button type="button" onclick="updateCartQty(${item.id}, -1)" class="w-8 h-8 flex items-center justify-center bg-white rounded-md border border-slate-200 text-slate-600 hover:bg-slate-100 hover:text-rose-500 transition-colors font-bold shadow-sm">-</button>
                        <span class="font-black text-sm text-[#005b96] w-10 text-center">${item.aantal}</span>
                        <button type="button" onclick="updateCartQty(${item.id}, 1)" class="w-8 h-8 flex items-center justify-center bg-white rounded-md border border-slate-200 text-slate-600 hover:bg-slate-100 hover:text-emerald-500 transition-colors font-bold shadow-sm">+</button>
                    </div>
                </div>
            `;
        });
    }

    if (document.querySelector('meta[name="clear-cart"]')) {
        localStorage.removeItem('aquafin_cart');
        cart = [];
        updateCartBadge();
    }

    // --- 2. LA RECHERCHE AVEC LE SERVEUR ---
    const searchInput = document.getElementById('searchInput');
    const suggestionsBox = document.getElementById('searchSuggestions');
    const cards = document.querySelectorAll('.product-card');

    searchInput.addEventListener('input', function() {
        let rechercheBrute = this.value.trim();
        suggestionsBox.innerHTML = '';
        
        if(rechercheBrute.length === 0) {
            suggestionsBox.classList.add('hidden');
            serverValidIds = null;
            filtrerGrid(''); 
            return;
        }

        // On interroge ton backend Laravel (qui a la logique des langues et des fautes)
        fetch(`/api/materiaal/search?q=${encodeURIComponent(rechercheBrute)}`)
            .then(response => response.json())
            .then(data => {
                suggestionsBox.innerHTML = '';
                let aAfficher = false;

                // 1. Si le serveur a corrigé une faute, on affiche ta bulle esthétique "Bedoelde je:"
                if(data.bedoelde_je) {
                    suggestionsBox.innerHTML += `
                        <div class="p-3 bg-blue-50 border-b border-blue-100 flex items-center text-sm transition-colors cursor-pointer hover:bg-blue-100" onclick="appliquerCorrection('${data.bedoelde_je}')">
                            <svg class="w-5 h-5 mr-2 text-[#005b96]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-slate-700">Bedoelde je: <strong class="text-[#005b96] uppercase tracking-wide">${data.bedoelde_je}</strong> ?</span>
                        </div>
                    `;
                    aAfficher = true;
                } 
                
                // 2. On affiche aussi tes 3 options rapides comme avant
                if (data.artikelen.length > 0) {
                    data.artikelen.slice(0, 3).forEach(item => {
                        // On échappe les apostrophes pour le onclick
                        let nomSafe = item.omschrijving.replace(/'/g, "\\'");
                        suggestionsBox.innerHTML += `
                            <div class="p-3 hover:bg-slate-50 cursor-pointer border-b border-slate-100 last:border-0 flex items-center text-sm text-slate-600" onclick="appliquerCorrection('${nomSafe}')">
                                <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg> 
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

                // 3. On enregistre les IDs validés par le serveur et on filtre la grille
                serverValidIds = data.artikelen.map(i => i.id.toString());
                filtrerGrid(data.bedoelde_je || rechercheBrute);
            });
    });

    window.appliquerCorrection = function(correction) {
        searchInput.value = correction;
        suggestionsBox.classList.add('hidden');
        searchInput.dispatchEvent(new Event('input')); // Relance la recherche serveur avec le mot propre
    };

    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.classList.add('hidden');
        }
    });

    // --- 3. FILTRAGE HYBRIDE (Catégories + Recherche Serveur) ---
    function filtrerGrid(recherche) {
        let visibleCount = 0;

        cards.forEach(card => {
            let id = card.getAttribute('data-id');
            let refItem = card.getAttribute('data-ref').toUpperCase();
            
            let matchCategory = (currentCategory === 'ALL') || refItem.startsWith(currentCategory);
            let matchFavorite = !showOnlyFavorites || favorites.includes(parseInt(id));
            
            // On vérifie si l'ID de la carte fait partie de ceux renvoyés par Laravel
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
                b.classList.remove('bg-[#005b96]', 'text-white', 'shadow-md');
                b.classList.add('bg-white', 'text-slate-600');
            });
            this.classList.remove('bg-white', 'text-slate-600');
            this.classList.add('bg-[#005b96]', 'text-white', 'shadow-md');
            currentCategory = this.getAttribute('data-prefix');
            filtrerGrid(searchInput.value.trim()); 
        });
    });

    // --- 4. FAVORIS ---
    document.getElementById('btnFavFilter').addEventListener('click', function() {
        showOnlyFavorites = !showOnlyFavorites;
        this.classList.toggle('bg-rose-500');
        this.classList.toggle('text-white');
        this.classList.toggle('border-rose-600');
        filtrerGrid(searchInput.value.trim());
    });

    function initFavorites() {
        document.querySelectorAll('.product-card').forEach(card => {
            const id = parseInt(card.getAttribute('data-id'));
            const btn = card.querySelector('.btn-favorite');
            if(favorites.includes(id)) {
                btn.classList.remove('text-slate-300');
                btn.classList.add('text-rose-500');
                btn.innerHTML = `<svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>`;
            }
        });
    }

    function toggleFavorite(id, btnElement) {
        const index = favorites.indexOf(id);
        if(index > -1) {
            favorites.splice(index, 1);
            btnElement.classList.remove('text-rose-500');
            btnElement.classList.add('text-slate-300');
            btnElement.innerHTML = `<svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>`;
        } else {
            favorites.push(id);
            btnElement.classList.remove('text-slate-300');
            btnElement.classList.add('text-rose-500');
            btnElement.innerHTML = `<svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>`;
        }
        localStorage.setItem('aquafin_favorites', JSON.stringify(favorites));
        if(showOnlyFavorites) filtrerGrid(searchInput.value.trim()); 
    }

    // --- INITIALISATION ---
    document.addEventListener('DOMContentLoaded', () => {
        initFavorites();
        updateCartBadge();
    });
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { height: 4px; width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>
@endsection