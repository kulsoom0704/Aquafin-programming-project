<?php $__env->startSection('title', 'Interventie Historiek'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight flex items-center">
            <svg class="w-8 h-8 mr-3 text-[#005b96]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Algemene Interventie Historiek
        </h1>
        <p class="text-slate-500 mt-2 font-medium">Overzicht van alle logboeken en uitgevoerde acties door het technici-team.</p>
    </div>

    <div class="relative border-l-2 border-blue-200/50 ml-4 md:ml-6">
        
        <?php $__empty_1 = true; $__currentLoopData = $notities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notitie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="mb-10 ml-8 md:ml-10 relative group">
                
                <div class="absolute -left-[43px] md:-left-[51px] top-1 w-5 h-5 rounded-full bg-white border-4 border-[#005b96] shadow-[0_0_10px_rgba(0,91,150,0.4)] group-hover:scale-125 transition-transform duration-300"></div>

                <div class="glass-card p-6 md:p-8 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4 mb-4">
                        <div>
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-[#005b96] border border-blue-100">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <?php echo e($notitie->created_at->format('d M Y - H:i')); ?>

                                </span>
                                
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <?php echo e($notitie->technieker->name ?? 'Onbekende Technieker'); ?>

                                </span>
                            </div>
                            
                            <h3 class="text-xl font-bold text-slate-800 group-hover:text-[#005b96] transition-colors">
                                <?php echo e($notitie->installatie->naam ?? 'Onbekende Installatie'); ?>

                            </h3>
                            <p class="text-slate-500 text-sm font-medium flex items-center mt-1">
                                <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <?php echo e($notitie->installatie->locatie ?? 'Locatie onbekend'); ?>

                            </p>
                        </div>
                    </div>

                    <div class="bg-slate-50/50 p-4 rounded-xl border border-slate-100">
                        <p class="text-slate-600 leading-relaxed">
                            <?php echo e($notitie->opmerking); ?>

                        </p>
                    </div>

                    <?php if($notitie->afbeelding): ?>
                        <div class="mt-5 relative overflow-hidden rounded-xl border border-slate-200">
                            <img src="<?php echo e(asset('storage/' . $notitie->afbeelding)); ?>" alt="Bewijs van interventie" class="w-full h-48 md:h-64 object-cover hover:scale-105 transition-transform duration-700">
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="ml-4 md:ml-8 glass-card p-12 text-center flex flex-col items-center justify-center">
                <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-6 shadow-inner">
                    <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Nog geen historiek</h3>
                <p class="text-slate-500 max-w-sm mx-auto">Er zijn momenteel geen acties geregistreerd.</p>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ramon\Aquafin-programming-project\resources\views/technieker/historiek.blade.php ENDPATH**/ ?>