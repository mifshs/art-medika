<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['expert']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['expert']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $avatarUrl = $expert->avatarUrl();
    $deptName = $expert->department?->name ?? 'Руководство';
    $detailUrl = route('specialists.show', $expert->slug);
?>


<article data-department="<?php echo e($deptName); ?>"
         class="group relative select-none cursor-pointer flex flex-col overflow-hidden rounded-[20px] bg-[#F4F7FD] border-[3px] border-transparent transition-all duration-300 hover:border-brand hover:shadow-lg sm:flex-row sm:items-stretch sm:min-h-[380px] lg:min-h-[420px] 2xl:min-h-[460px]">
    
    <a href="<?php echo e($detailUrl); ?>" class="absolute inset-0 z-10 rounded-[inherit] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2" aria-label="Открыть профиль «<?php echo e($expert->name); ?>»"></a>

    
    <div class="relative block shrink-0 overflow-hidden sm:w-[46%] lg:w-[45%] 2xl:w-[44%] pointer-events-none">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($avatarUrl): ?>
            <img src="<?php echo e($avatarUrl); ?>" alt="<?php echo e($expert->name); ?>" width="380" height="460" loading="lazy" decoding="async"
                 class="h-[340px] w-full object-cover object-top transition-transform duration-500 group-hover:scale-105 sm:h-full sm:absolute sm:inset-0">
        <?php else: ?>
            <div class="flex h-[340px] w-full items-center justify-center bg-slate-200 text-slate-400 sm:h-full sm:absolute sm:inset-0">
                <svg class="h-16 w-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <div class="flex flex-1 flex-col justify-start p-5 sm:p-6 lg:p-8 pointer-events-none">
        
        <div class="flex items-center justify-between gap-2 text-[13px] text-steel sm:text-[14px]">
            <span><?php echo e($deptName); ?></span>
            <span class="inline-flex h-5 w-5 shrink-0 items-center justify-center text-[#1A1A1A] transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 group-hover:text-brand">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M7 17L17 7H8.5M17 7v8.5"/>
                </svg>
            </span>
        </div>

        
        <h2 class="mt-3 text-[20px] font-medium leading-[1.2] text-body transition-colors group-hover:text-brand sm:text-[22px] lg:text-[24px] 2xl:text-[26px]">
            <?php echo e($expert->name); ?>

        </h2>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($expert->position): ?>
            <p class="mt-3 text-[13px] leading-relaxed text-[#4A5568] sm:text-[13px] lg:text-[14px] line-clamp-5 sm:line-clamp-6 lg:line-clamp-7">
                <?php echo e($expert->position); ?>

            </p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</article>
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/components/specialist-card.blade.php ENDPATH**/ ?>