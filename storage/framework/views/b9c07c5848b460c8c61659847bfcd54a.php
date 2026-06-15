<?php $__env->startSection('title', 'Mijn Bestelhistoriek'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-10 flex flex-col md:flex-row justify-between md:items-end gap-6">
    <div>
        <div class="flex items-center gap-3 mb-2">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#005b96] to-cyan-500 flex items-center justify-center shadow-lg shadow-blue-500/20">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
            <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">Bestelhistoriek</h1>
        </div>
        <p class="text-sm md:text-base text-slate-500 font-medium ml-1">Volg de status van je aangevraagde materialen in real-time.</p>
    </div>
    
    <div class="w-full md:w-auto">
        <a href="<?php echo e(route('materiaal.bestellen')); ?>" class="w-full md:w-auto h-12 bg-white text-[#005b96] border border-blue-100 px-6 rounded-xl font-black text-sm shadow-sm flex items-center justify-center gap-2 active:scale-95 transition-all hover:bg-blue-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            Nieuwe bestelling
        </a>
    </div>
</div>

<div class="grid grid-cols-1 gap-4">
    <?php $__empty_1 = true; $__currentLoopData = $bestellingen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $prefix = strtoupper(substr($order->materiaal->artikelnummer ?? '', 0, 3));
            $gradient = match($prefix) {
                'BEV' => 'from-blue-500 to-blue-600', 
                'PBM' => 'from-orange-400 to-orange-500', 
                'GER' => 'from-amber-400 to-amber-500', 
                'TEC' => 'from-cyan-500 to-blue-500', 
                'AQF' => 'from-sky-400 to-sky-500', 
                default => 'from-slate-400 to-slate-500'
            };
            $iconPath = match($prefix) {
                'BEV' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>',
                'PBM' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>',
                'GER' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>',
                default => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>'
            };
        ?>

        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-[0_2px_15px_rgba(0,0,0,0.02)] p-5 md:p-6 flex flex-col md:flex-row gap-5 items-start md:items-center group hover:border-[#005b96]/40 transition-all duration-300">
            
            <div class="w-16 h-16 shrink-0 rounded-2xl bg-gradient-to-br <?php echo e($gradient); ?> flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-500">
                <?php if(isset($order->materiaal->foto) && $order->materiaal->foto): ?>
                    <img src="<?php echo e(asset('storage/' . $order->materiaal->foto)); ?>" class="w-full h-full object-cover rounded-2xl">
                <?php else: ?>
                    <svg class="w-8 h-8 text-white drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><?php echo $iconPath; ?></svg>
                <?php endif; ?>
            </div>

            <div class="flex-grow w-full min-w-0">
                <div class="flex flex-wrap items-center gap-3 mb-2">
                    <span class="text-[10px] font-black tracking-widest text-[#005b96] bg-blue-50 border border-blue-100 px-2 py-0.5 rounded-md uppercase"><?php echo e($order->materiaal->artikelnummer ?? 'N/A'); ?></span>
                    <span class="text-[10px] font-bold text-slate-400 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <?php echo e($order->created_at->format('d M Y - H:i')); ?>

                    </span>
                </div>
                <h3 class="text-lg font-black text-slate-800 leading-tight group-hover:text-[#005b96] transition-colors"><?php echo e($order->materiaal->omschrijving ?? 'Onbekend materiaal'); ?></h3>
            </div>

            <div class="flex flex-row items-center justify-between w-full md:w-auto gap-4 shrink-0 md:pl-6 md:border-l border-slate-100 pt-3 md:pt-0">
                
                <div class="bg-slate-50 border border-slate-200 h-12 px-5 rounded-2xl flex items-center gap-3">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Qty</span>
                    <span class="text-lg font-black text-slate-900"><?php echo e($order->aantal); ?></span>
                </div>

                <?php if($order->status == 'klaargezet'): ?>
                    <div class="flex-grow md:w-48 h-12 flex justify-center items-center gap-2 px-4 rounded-2xl text-[10px] font-black bg-emerald-500/10 text-emerald-600 border border-emerald-500/10 uppercase tracking-wider shadow-sm">
                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                        Klaar voor afhaal
                    </div>
                <?php else: ?>
                    <div class="flex-grow md:w-48 h-12 flex justify-center items-center gap-2 px-4 rounded-2xl text-[10px] font-black bg-amber-500/10 text-amber-600 border border-amber-500/10 uppercase tracking-wider shadow-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                        </span>
                        In verwerking
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="bg-white rounded-[3rem] border border-dashed border-slate-200 p-16 flex flex-col items-center justify-center text-center">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-6 text-slate-300">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
            <h3 class="text-2xl font-black text-slate-800 mb-2">Geen bestellingen gevonden</h3>
            <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Je hebt momenteel geen actieve aanvragen.</p>
        </div>
    <?php endif; ?>
</div>

<script>
    // SNIPER : Nettoyage automatique du panier dès qu'on arrive ici avec un succès
    <?php if(session('success')): ?>
        localStorage.removeItem('aquafin_cart');
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ramon\Aquafin-programming-project\resources\views/technieker/historiek.blade.php ENDPATH**/ ?>