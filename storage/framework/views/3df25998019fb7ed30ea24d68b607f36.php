<?php $__env->startSection('title', 'Mijn Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col md:flex-row justify-between md:items-end gap-4 mb-8">
    <div>
        <span class="text-[10px] md:text-xs font-black tracking-[0.2em] text-[#005b96] uppercase mb-1 block">
            <?php echo e(\Carbon\Carbon::now()->translatedFormat('l d F Y')); ?>

        </span>
        <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
            Mijn Dashboard
        </h1>
    </div>
    
    <div class="flex gap-4 w-full md:w-auto mt-2 md:mt-0">
        <div class="bg-white border border-slate-200 rounded-2xl px-5 py-3 shadow-[0_2px_10px_rgba(0,0,0,0.02)] flex items-center gap-4 flex-grow md:flex-grow-0">
            <div class="w-10 h-10 rounded-xl bg-rose-500/10 flex items-center justify-center text-rose-600 border border-rose-500/10 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div>
                <div class="text-2xl font-black text-slate-800 leading-none"><?php echo e($meldingen->count()); ?></div>
                <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Openstaande Taken</div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-2">
    <h2 class="text-xl font-black text-[#001e33] tracking-tight">Actuele Interventies</h2>
</div>

<div class="grid grid-cols-1 gap-4">
    <?php $__empty_1 = true; $__currentLoopData = $meldingen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-3xl border border-slate-200 shadow-[0_2px_15px_rgba(0,0,0,0.02)] p-5 md:p-6 flex flex-col md:flex-row gap-5 items-start md:items-center group hover:border-[#005b96]/40 hover:shadow-lg transition-all duration-300">
            
            <div class="hidden md:flex w-14 h-14 shrink-0 rounded-2xl bg-slate-50 border border-slate-100 items-center justify-center group-hover:bg-[#005b96]/5 transition-colors">
                <svg class="w-6 h-6 text-[#005b96]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
            </div>

            <div class="flex-grow w-full md:w-auto min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="text-[9px] font-black tracking-widest uppercase text-slate-400 bg-slate-50 border border-slate-200 px-2 py-0.5 rounded-md"><?php echo e($taak->locatie ?? 'Locatie Onbekend'); ?></span>
                    
                    <?php if($taak->dagen_te_laat == 999): ?>
                        <span class="px-2.5 py-0.5 rounded-md text-rose-600 bg-rose-50 text-[9px] font-black tracking-wide border border-rose-100">EERSTE ONDERHOUD</span>
                    <?php elseif($taak->dagen_te_laat > 0): ?>
                        <span class="px-2.5 py-0.5 rounded-md text-rose-600 bg-rose-50 text-[9px] font-black tracking-wide border border-rose-100 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                            <?php echo e($taak->dagen_te_laat); ?> DAGEN OVERTIJD
                        </span>
                    <?php else: ?>
                        <span class="px-2.5 py-0.5 rounded-md text-amber-600 bg-amber-50 text-[9px] font-black tracking-wide border border-amber-100">VANDAAG VERPLICHT</span>
                    <?php endif; ?>
                </div>
                
                <h3 class="text-lg font-black text-slate-800 leading-snug group-hover:text-[#005b96] transition-colors"><?php echo e($taak->naam); ?></h3>
                <p class="text-xs font-medium text-slate-400 mt-1 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Laatste controle: <?php echo e($taak->laatste_onderhoud_datum ? \Carbon\Carbon::parse($taak->laatste_onderhoud_datum)->format('d/m/Y') : 'Geen historiek'); ?>

                </p>
            </div>

            <div class="flex flex-row items-center gap-2.5 w-full md:w-auto shrink-0 md:pl-6 md:border-l border-slate-100 mt-3 md:mt-0">
                <form action="<?php echo e(route('installatie.valideren', $taak->id)); ?>" method="POST" class="w-1/2 md:w-auto">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full md:w-auto px-4 h-12 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-xl font-bold text-xs md:text-sm active:scale-95 transition-all flex items-center justify-center hover:bg-emerald-100/50">
                        Snel Valideren
                    </button>
                </form>
                
                <a href="<?php echo e(route('installatie.show', $taak->id)); ?>" class="w-1/2 md:w-auto px-5 h-12 bg-slate-900 text-white rounded-xl font-bold text-xs md:text-sm text-center active:scale-95 transition-all flex items-center justify-center hover:bg-slate-800 shadow-md">
                    Logboek openen
                </a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="bg-white rounded-[2rem] border border-dashed border-slate-200 p-12 flex flex-col items-center justify-center text-center shadow-sm">
            <div class="w-16 h-16 bg-emerald-500/10 text-emerald-500 border border-emerald-500/10 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h3 class="text-xl font-black text-slate-800 mb-1">Alles is up-to-date!</h3>
            <p class="text-xs md:text-sm text-slate-400 font-bold uppercase tracking-wider">Geen openstaande inspecties.</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ramon\Aquafin-programming-project\resources\views/technieker/meldingen.blade.php ENDPATH**/ ?>