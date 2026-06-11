<?php $__env->startSection('title', 'Materiaal Bestellen'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight flex items-center">
            <svg class="w-8 h-8 mr-3 text-[#005b96]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            Materiaal Bestellen
        </h1>
        <p class="text-slate-500 mt-2 font-medium">Bestel nieuwe onderdelen voor je installaties vanuit het centrale magazijn.</p>
    </div>

    <div class="glass-card p-6 md:p-8 mb-10">
        <h2 class="text-xl font-bold text-slate-800 mb-6 border-b border-slate-200 pb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-[#005b96]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nieuwe Bestelling Plaatsen
        </h2>

        <form action="<?php echo e(route('materiaal.store')); ?>" method="POST" class="flex flex-col md:flex-row gap-4 items-end">
            <?php echo csrf_field(); ?>
            
            <div class="flex-grow w-full md:w-auto">
                <label for="onderdeel_id" class="block text-sm font-bold text-slate-700 mb-2">Selecteer Onderdeel</label>
                <div class="relative">
                    <select name="onderdeel_id" id="onderdeel_id" required class="w-full appearance-none bg-white border-2 border-slate-200 text-slate-700 py-3 px-4 pr-10 rounded-xl focus:outline-none focus:border-[#005b96] focus:ring-0 transition-colors font-medium cursor-pointer shadow-sm">
                        <option value="" disabled selected>Kies een onderdeel...</option>
                        <?php $__currentLoopData = $onderdelen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $onderdeel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($onderdeel->id); ?>">
                                <?php echo e($onderdeel->naam); ?> (Voorraad: <?php echo e($onderdeel->voorraad); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-32 flex-shrink-0">
                <label for="aantal" class="block text-sm font-bold text-slate-700 mb-2">Aantal</label>
                <input type="number" name="aantal" id="aantal" min="1" value="1" required class="w-full bg-white border-2 border-slate-200 text-slate-700 py-3 px-4 rounded-xl focus:outline-none focus:border-[#005b96] transition-colors font-medium shadow-sm text-center">
            </div>

            <div class="w-full md:w-auto flex-shrink-0">
                <button type="submit" class="w-full h-[52px] px-6 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-[#005b96] hover:bg-blue-800 transition-all duration-200 focus:outline-none flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Bestellen
                </button>
            </div>
        </form>
    </div>

    <div class="glass-card p-6 md:p-8">
        <h2 class="text-xl font-bold text-slate-800 mb-6 border-b border-slate-200 pb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-[#005b96]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            Mijn Recente Bestellingen
        </h2>

        <?php if($bestellingen->count() > 0): ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-slate-200 text-sm uppercase tracking-wider text-slate-500">
                            <th class="pb-3 font-bold px-2">Datum</th>
                            <th class="pb-3 font-bold px-2">Onderdeel</th>
                            <th class="pb-3 font-bold text-center px-2">Aantal</th>
                            <th class="pb-3 font-bold text-right px-2">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php $__currentLoopData = $bestellingen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bestelling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-2 font-medium text-slate-600">
                                    <?php echo e($bestelling->created_at->format('d/m/Y')); ?>

                                </td>
                                <td class="py-4 px-2 font-bold text-slate-800">
                                    <?php echo e($bestelling->onderdeel->naam ?? 'Onbekend'); ?>

                                </td>
                                <td class="py-4 px-2 font-mono font-bold text-center text-slate-600">
                                    x<?php echo e($bestelling->aantal); ?>

                                </td>
                                <td class="py-4 px-2 text-right">
                                    <?php if($bestelling->status == 'In behandeling'): ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200">
                                            <span class="w-2 h-2 rounded-full bg-amber-500 mr-1.5 animate-pulse"></span>
                                            In behandeling
                                        </span>
                                    <?php elseif($bestelling->status == 'Geleverd'): ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            Geleverd
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                            <?php echo e($bestelling->status); ?>

                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="py-12 text-center flex flex-col items-center justify-center">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-700 mb-1">Geen bestellingen gevonden</h3>
                <p class="text-slate-500 text-sm">Je hebt nog geen materialen besteld in het systeem.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ramon\Aquafin-programming-project\resources\views/technieker/bestellen.blade.php ENDPATH**/ ?>