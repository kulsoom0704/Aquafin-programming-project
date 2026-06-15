<?php $__env->startSection('title', 'Materiaal Webshop'); ?>

<?php $__env->startSection('content'); ?>

<?php
    $suggestedRefs = $weer['aanbevolen_refs'] ?? [];
    $aanbevolenMaterialen = $materialen->filter(function($item) use ($suggestedRefs) {
        return in_array(strtoupper($item->artikelnummer), $suggestedRefs);
    });
?>

<!-- EN-TÊTE PREMIUM -->
<div class="mb-8 flex flex-col lg:flex-row justify-between lg:items-end gap-4">
    <div>
        <span class="text-[10px] md:text-xs font-black tracking-[0.2em] text-[#005b96] uppercase mb-1 block">Aquafin Logistiek</span>
        <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">Centraal Magazijn</h1>
    </div>
    
    <!-- Barre de recherche & Panier -->
    <div class="flex flex-col sm:flex-row gap-3 relative z-30 w-full lg:w-auto">
        <div class="w-full sm:w-80 relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" id="searchInput" placeholder="Snel zoeken op naam of ref..." autocomplete="off" class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-2xl focus:outline-none focus:border-[#005b96] focus:ring-4 focus:ring-blue-500/5 transition-all text-sm font-medium">
            <div id="searchSuggestions" class="absolute z-[60] w-full bg-white border border-slate-100 shadow-2xl rounded-2xl mt-2 hidden max-h-60 overflow-y-auto custom-scrollbar p-1"></div>
        </div>

        <button onclick="toggleCart()" class="w-full sm:w-auto bg-[#005b96] hover:bg-[#004a7c] text-white px-6 py-3 rounded-2xl font-bold shadow-md shadow-blue-500/10 active:scale-95 transition-all flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <span>Mijn selectie</span>
            <span id="cartCount" class="bg-cyan-400 text-[#001e33] text-[10px] px-2 py-0.5 rounded-full font-black ml-1 scale-0 transition-transform">0</span>
        </button>
    </div>
</div>

<!-- 🌟 SECTION METEO (Agrandie aussi) -->
<?php if(isset($weer) && $weer['is_beschikbaar']): ?>
    <div id="weatherSection" class="mb-8">
        <div class="bg-gradient-to-br from-[#001e33] to-[#00365c] rounded-3xl p-5 md:p-6 relative overflow-hidden shadow-lg border border-white/5">
            <div class="absolute top-0 right-0 w-64 h-64 bg-cyan-400/5 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-5">
                    <div>
                        <span class="px-2.5 py-0.5 rounded-md bg-cyan-500/10 text-cyan-300 text-[9px] font-black tracking-widest uppercase border border-cyan-400/10 mb-1 inline-block">Weersadvies</span>
                        <h2 class="text-xl font-black text-white tracking-tight">Geadviseerde uitrusting voor vandaag</h2>
                    </div>

                    <div class="flex items-center gap-3 bg-white/5 px-4 py-2 rounded-xl border border-white/5 w-full md:w-auto">
                        <span class="text-xl font-black text-white leading-none"><?php echo e($weer['temp']); ?>°C</span>
                        <div class="h-4 w-px bg-white/10"></div>
                        <span class="text-xs font-bold <?php echo e($weer['gevaar'] == 'Kritiek' ? 'text-rose-400' : ($weer['gevaar'] == 'Gemiddeld' ? 'text-amber-400' : 'text-emerald-400')); ?>">
                            <?php echo e($weer['gevaar'] == 'Kritiek' ? 'Zware Neerslag' : ($weer['gevaar'] == 'Gemiddeld' ? 'Lichte Regen' : 'Veilig klimaat')); ?>

                        </span>
                    </div>
                </div>

                <?php if($aanbevolenMaterialen->count() > 0): ?>
                    <div class="flex overflow-x-auto gap-4 pb-2 hide-scrollbar snap-x">
                        <?php $__currentLoopData = $aanbevolenMaterialen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="shrink-0 w-[280px] snap-center bg-white/5 border border-white/5 rounded-2xl p-5 flex flex-col justify-between hover:bg-white/10 transition-all">
                                <div>
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="text-[10px] font-black text-cyan-300 tracking-wider bg-slate-900/50 px-2.5 py-1 rounded-lg"><?php echo e($item->artikelnummer); ?></span>
                                        <div class="w-2 h-2 rounded-full <?php echo e($item->beschikbaar > 0 ? 'bg-emerald-400' : 'bg-rose-400'); ?>"></div>
                                    </div>
                                    <!-- Plus de truncate ici, on laisse 2 lignes -->
                                    <h3 class="text-base font-bold text-white leading-tight mb-5 line-clamp-2 min-h-[2.5rem]"><?php echo e($item->omschrijving); ?></h3>
                                </div>
                                <div class="flex items-center gap-3 mt-auto">
                                    <input type="number" id="qty-rec-<?php echo e($item->id); ?>" min="1" max="<?php echo e($item->beschikbaar > 0 ? $item->beschikbaar : 1); ?>" value="1" <?php echo e($item->beschikbaar == 0 ? 'disabled' : ''); ?> class="w-14 h-11 bg-slate-900/60 border border-white/10 text-white rounded-xl text-center font-bold text-sm focus:outline-none">
                                    <button onclick="addToCart(<?php echo e($item->id); ?>, '<?php echo e(addslashes($item->omschrijving)); ?>', '<?php echo e($item->artikelnummer); ?>', <?php echo e($item->beschikbaar); ?>, 'rec')" <?php echo e($item->beschikbaar == 0 ? 'disabled' : ''); ?> class="flex-grow h-11 bg-cyan-400 text-[#001e33] font-black rounded-xl text-sm active:scale-95 transition-transform flex items-center justify-center shadow-lg shadow-cyan-500/20">
                                        Toevoegen
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- FILTRES DE CATEGORIES -->
<div class="flex gap-2 overflow-x-auto pb-4 w-full hide-scrollbar border-b border-slate-200 mb-6">
    <button class="cat-btn active bg-slate-900 text-white px-5 py-2.5 rounded-xl font-bold text-xs tracking-wide whitespace-nowrap shadow-sm shrink-0" data-prefix="ALL">Alles</button>
    <button class="cat-btn bg-white text-slate-600 border border-slate-200 px-5 py-2.5 rounded-xl font-bold text-xs tracking-wide whitespace-nowrap shrink-0" data-prefix="BEV">Bevestiging</button>
    <button class="cat-btn bg-white text-slate-600 border border-slate-200 px-5 py-2.5 rounded-xl font-bold text-xs tracking-wide whitespace-nowrap shrink-0" data-prefix="PBM">Veiligheid</button>
    <button class="cat-btn bg-white text-slate-600 border border-slate-200 px-5 py-2.5 rounded-xl font-bold text-xs tracking-wide whitespace-nowrap shrink-0" data-prefix="GER">Gereedschap</button>
    <button id="btnFavFilter" class="bg-white text-rose-500 border border-rose-100 px-5 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 shrink-0 ml-auto">
        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        Favorieten
    </button>
</div>

<!-- GRILLE PRINCIPALE (CARTES VERTICALES GRAND FORMAT) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 md:gap-6" id="productGrid">
    <?php $__currentLoopData = $materialen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- La nouvelle carte grande taille -->
        <div class="product-card bg-white p-5 rounded-[1.5rem] border border-slate-200 shadow-sm flex flex-col justify-between group hover:border-[#005b96]/40 hover:shadow-xl transition-all duration-300" data-id="<?php echo e($item->id); ?>" data-ref="<?php echo e($item->artikelnummer); ?>" data-item-ref="<?php echo e(strtoupper($item->artikelnummer)); ?>">
            
            <!-- Haut: Image/Icone & Badges -->
            <div class="flex justify-between items-start mb-4">
                <div class="w-16 h-16 shrink-0 rounded-2xl relative overflow-hidden flex items-center justify-center bg-slate-50 border border-slate-100 group-hover:bg-[#005b96]/5 transition-colors">
                    <?php
                        $prefix = strtoupper(substr($item->artikelnummer, 0, 3));
                        $iconPath = match($prefix) {
                            'BEV' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>',
                            'PBM' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>',
                            'GER' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>',
                            default => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>'
                        };
                    ?>
                    <svg class="w-8 h-8 text-slate-400 group-hover:text-[#005b96] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><?php echo $iconPath; ?></svg>
                </div>
                
                <div class="flex flex-col items-end gap-1.5">
                    <span class="text-[10px] font-black tracking-widest text-slate-500 uppercase bg-slate-100 px-2.5 py-1 rounded-lg"><?php echo e($item->artikelnummer); ?></span>
                    <span class="text-[9px] font-black px-2 py-1 rounded-md <?php echo e($item->beschikbaar > 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600'); ?>">
                        <?php echo e($item->beschikbaar > 0 ? 'IN STOCK' : 'UITGEPUT'); ?>

                    </span>
                </div>
            </div>

            <!-- Milieu: Titre Complet (Plus de truncate, mais line-clamp) -->
            <div class="flex-grow mb-5">
                <h3 class="text-base font-black text-slate-800 leading-snug group-hover:text-[#005b96] transition-colors line-clamp-3"><?php echo e($item->omschrijving); ?></h3>
            </div>

            <!-- Bas: Actions & Boutons -->
            <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                <button class="btn-favorite p-2 rounded-full bg-slate-50 text-slate-400 hover:bg-rose-50 hover:text-rose-500 transition-colors" onclick="toggleFavorite(<?php echo e($item->id); ?>, this)">
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </button>
                
                <div class="flex items-center gap-2">
                    <input type="number" id="qty-main-<?php echo e($item->id); ?>" min="1" max="<?php echo e($item->beschikbaar > 0 ? $item->beschikbaar : 1); ?>" value="1" <?php echo e($item->beschikbaar == 0 ? 'disabled' : ''); ?> class="w-14 h-11 bg-slate-50 border border-slate-200 text-slate-900 rounded-xl text-center font-black text-sm focus:outline-none focus:border-[#005b96] focus:ring-2 focus:ring-blue-500/20 transition-all">
                    
                    <button onclick="addToCart(<?php echo e($item->id); ?>, '<?php echo e(addslashes($item->omschrijving)); ?>', '<?php echo e($item->artikelnummer); ?>', <?php echo e($item->beschikbaar); ?>, 'main')" <?php echo e($item->beschikbaar == 0 ? 'disabled' : ''); ?> class="w-11 h-11 bg-[#005b96] text-white disabled:bg-slate-100 disabled:text-slate-400 hover:bg-[#004a7c] rounded-xl flex items-center justify-center active:scale-95 transition-all shadow-md shadow-blue-900/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div id="noResults" class="hidden py-16 text-center flex-col items-center justify-center bg-white rounded-2xl border border-dashed border-slate-200 mt-6 shadow-sm">
    <div class="w-14 h-14 bg-slate-50 rounded-full flex items-center justify-center mb-3 text-slate-400">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
    </div>
    <h3 class="text-base font-bold text-slate-800 mb-1">Geen resultaten</h3>
</div>

<!-- SIDEBAR SHOPPING CART -->
<div id="cartSidebar" class="fixed inset-y-0 right-0 w-full sm:w-[400px] bg-slate-50 shadow-[ -10px_0_40px_rgba(0,0,0,0.1) ] transform translate-x-full transition-transform duration-300 z-[100] flex flex-col border-l border-slate-200">
    <div class="p-5 bg-white flex justify-between items-center border-b border-slate-100 pt-safe">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-[#005b96]/10 flex items-center justify-center text-[#005b96]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h2 class="text-lg font-black text-slate-800">Winkelwagen</h2>
        </div>
        <button onclick="toggleCart()" class="w-9 h-9 flex items-center justify-center bg-slate-100 text-slate-500 rounded-xl hover:bg-slate-200 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
    
    <div id="cartItems" class="flex-grow overflow-y-auto p-4 space-y-3 custom-scrollbar pb-32"></div>

    <div class="absolute bottom-0 inset-x-0 p-4 bg-white border-t border-slate-100 pb-safe">
        <form action="<?php echo e(route('materiaal.bestellen.store')); ?>" method="POST" id="checkoutForm">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="cart_data" id="cartDataInput">
            <button type="submit" id="btnCheckout" class="w-full h-13 bg-[#005b96] hover:bg-[#004a7c] text-white rounded-xl font-black shadow-lg disabled:opacity-50 flex items-center justify-center gap-2 active:scale-95 transition-transform">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                Bestelling Bevestigen
            </button>
        </form>
    </div>
</div>
<div id="cartOverlay" onclick="toggleCart()" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden opacity-0 transition-opacity duration-300"></div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    let cart = JSON.parse(localStorage.getItem('aquafin_cart')) || [];
    let favorites = JSON.parse(localStorage.getItem('aquafin_favorites')) || [];
    let currentCategory = 'ALL';
    let showOnlyFavorites = false;
    let serverValidIds = null;

    function toggleCart() {
        const sidebar = document.getElementById('cartSidebar');
        const overlay = document.getElementById('cartOverlay');
        if(sidebar.classList.contains('translate-x-full')) {
            sidebar.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            renderCart();
        } else {
            sidebar.classList.add('translate-x-full');
            overlay.classList.add('opacity-0');
            setTimeout(() => overlay.classList.add('hidden'), 300);
        }
    }

    function addToCart(id, name, ref, maxStock, prefix) {
        const qtyInput = document.getElementById(`qty-${prefix}-${id}`);
        const qty = parseInt(qtyInput.value) || 1;
        
        if(qty > maxStock || qty < 1) return alert('Ongeldig aantal of stock onvoldoende');
        
        const existingItem = cart.find(i => i.id === id);
        if(existingItem) {
            if(existingItem.aantal + qty > maxStock) existingItem.aantal = maxStock;
            else existingItem.aantal += qty;
        } else {
            cart.push({ id: id, naam: name, ref: ref, aantal: qty, max: maxStock });
        }
        
        localStorage.setItem('aquafin_cart', JSON.stringify(cart));
        updateCartBadge();
        
        const cartBtn = document.getElementById('cartCount').parentElement;
        cartBtn.classList.add('scale-105');
        setTimeout(() => cartBtn.classList.remove('scale-105'), 200);
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
                <div class="text-center text-slate-400 py-10">
                    <p class="font-medium text-sm">Je winkelwagen is leeg.</p>
                </div>`;
            return;
        }
        
        cart.forEach(item => {
            container.innerHTML += `
                <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm flex flex-col group">
                    <div class="flex justify-between items-start mb-2">
                        <div class="pr-2">
                            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest">${item.ref}</div>
                            <div class="font-bold text-slate-800 text-sm leading-tight">${item.naam}</div>
                        </div>
                        <button onclick="removeFromCart(${item.id})" class="text-slate-300 hover:text-rose-500 p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    <div class="flex items-center justify-between bg-slate-50 p-1 rounded-lg">
                        <button type="button" onclick="updateCartQty(${item.id}, -1)" class="w-8 h-8 flex items-center justify-center bg-white rounded shadow-sm text-slate-600 font-bold">-</button>
                        <span class="font-black text-sm text-[#005b96] w-10 text-center">${item.aantal}</span>
                        <button type="button" onclick="updateCartQty(${item.id}, 1)" class="w-8 h-8 flex items-center justify-center bg-white rounded shadow-sm text-slate-600 font-bold">+</button>
                    </div>
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

                if (data.artikelen.length > 0) {
                    data.artikelen.slice(0, 4).forEach(item => {
                        suggestionsBox.innerHTML += `
                            <div class="p-3 hover:bg-slate-50 cursor-pointer flex items-center text-sm text-slate-700 font-medium rounded-lg m-1" onclick="appliquerCorrection('${item.omschrijving.replace(/'/g, "\\'")}')">
                                ${item.omschrijving}
                            </div>
                        `;
                    });
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

    function filtrerGrid(recherche) {
        let visibleCount = 0;
        cards.forEach(card => {
            let id = card.getAttribute('data-id');
            let refPrefix = card.getAttribute('data-ref').toUpperCase().substring(0, 3);
            let matchCategory = (currentCategory === 'ALL') || (refPrefix === currentCategory);
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
        this.classList.toggle('bg-rose-50');
        this.classList.toggle('text-rose-600');
        this.classList.toggle('border-rose-100');
        filtrerGrid(searchInput.value.trim());
    });

    function initFavorites() {
        document.querySelectorAll('.product-card').forEach(card => {
            const id = parseInt(card.getAttribute('data-id'));
            const btn = card.querySelector('.btn-favorite');
            if(btn && favorites.includes(id)) {
                btn.classList.add('text-rose-500', 'bg-rose-50');
                btn.classList.remove('text-slate-400', 'bg-slate-50');
            }
        });
    }

    function toggleFavorite(id, btnElement) {
        const index = favorites.indexOf(id);
        if(index > -1) {
            favorites.splice(index, 1);
            btnElement.classList.remove('text-rose-500', 'bg-rose-50');
            btnElement.classList.add('text-slate-400', 'bg-slate-50');
        } else {
            favorites.push(id);
            btnElement.classList.remove('text-slate-400', 'bg-slate-50');
            btnElement.classList.add('text-rose-500', 'bg-rose-50');
        }
        localStorage.setItem('aquafin_favorites', JSON.stringify(favorites));
        if(showOnlyFavorites) filtrerGrid(searchInput.value.trim()); 
    }

    document.addEventListener('DOMContentLoaded', () => {
        initFavorites();
        updateCartBadge();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ramon\Aquafin-programming-project\resources\views/technieker/bestellen.blade.php ENDPATH**/ ?>