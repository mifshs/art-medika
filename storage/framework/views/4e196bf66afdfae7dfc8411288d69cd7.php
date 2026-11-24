<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['promotion']));

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

foreach (array_filter((['promotion']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $cover = $promotion->coverUrl();
    $tag   = 'Акции' . ($promotion->service?->name ? ' / ' . $promotion->service->name : '');
    $date  = $promotion->published_at?->format('d.m.Y');
?>

<article class="group relative select-none cursor-pointer flex h-auto w-full flex-col rounded-[24px] bg-surface p-5 sm:h-[557px] sm:min-h-[557px] border-[3px] border-transparent transition-all duration-300 hover:border-brand hover:shadow-lg">
    
    <a href="<?php echo e(route('stock.show', $promotion->slug)); ?>" class="absolute inset-0 z-10 rounded-[inherit] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2" aria-label="Открыть акцию: <?php echo e($promotion->title); ?>"></a>

    <div class="flex h-full min-h-0 flex-col gap-5 sm:flex-row sm:gap-6 pointer-events-none">
        
        <div class="relative h-[280px] w-full shrink-0 overflow-hidden rounded-[16px] bg-hero sm:h-full sm:w-[395px] sm:max-w-[50%] sm:min-h-0">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cover): ?>
                <img src="<?php echo e($cover); ?>" alt="<?php echo e($promotion->title); ?>" width="395" height="517" loading="lazy" decoding="async"
                     class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
            <?php else: ?>
                <div class="absolute inset-0 grid place-items-center">
                    <span class="font-serif text-[21px] italic font-semibold tracking-tight text-brand">Арт-Медика</span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="flex min-w-0 flex-1 flex-col justify-between">
    
    <!-- Верхняя часть: Тег и стрелка -->
    <div class="flex items-start justify-between gap-4">
        <span class="min-w-0 truncate text-[12px] font-medium text-brand sm:text-[14px] 2xl:text-[16px]"><?php echo e($tag); ?></span>
        <span class="shrink-0 rounded-md p-0.5 text-body transition-transform group-hover:translate-x-0.5 group-hover:text-brand">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" aria-hidden="true"
                 class="h-[18px] w-[18px] sm:h-[22px] sm:w-[22px]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16 16 8M16 8H9.5M16 8v6.5"/>
            </svg>
        </span>
    </div>

    <!-- Центральная часть: Заголовок и описание -->
    <div class="mt-3 sm:mt-4">
        <h2 class="text-[18px] font-semibold leading-snug text-ink transition-colors group-hover:text-brand sm:text-[22px] lg:text-[24px] 2xl:text-[26px]"><?php echo e($promotion->title); ?></h2>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($promotion->excerpt): ?>
            <p class="mt-2 overflow-hidden text-[13px] leading-relaxed text-body [display:-webkit-box] [-webkit-box-orient:vertical] [-webkit-line-clamp:4] sm:text-[14px] 2xl:text-[15px]"><?php echo e($promotion->excerpt); ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- Нижняя часть: Дата -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($date): ?>
        <span class="pt-4 text-[13px] text-[#4A749B] sm:text-[14px] 2xl:text-[16px]"><?php echo e($date); ?></span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>
    </div>
</article>
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/components/promotion-card.blade.php ENDPATH**/ ?>