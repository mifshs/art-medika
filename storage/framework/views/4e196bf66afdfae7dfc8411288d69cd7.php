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

<article class="flex h-auto w-full flex-col rounded-[24px] bg-surface p-5 sm:h-[557px] sm:min-h-[557px]">
    <div class="flex h-full min-h-0 flex-col gap-5 sm:flex-row sm:gap-6">
        
        <div class="relative h-[280px] w-full shrink-0 overflow-hidden rounded-[16px] bg-hero sm:h-full sm:w-[395px] sm:max-w-[50%] sm:min-h-0">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cover): ?>
                <img src="<?php echo e($cover); ?>" alt="<?php echo e($promotion->title); ?>" loading="lazy"
                     class="absolute inset-0 h-full w-full object-cover">
            <?php else: ?>
                <div class="absolute inset-0 grid place-items-center">
                    <span class="font-serif text-[21px] italic font-semibold tracking-tight text-brand">Арт-Медика</span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="flex min-w-0 flex-1 flex-col justify-between"> <!-- Добавлен justify-between -->
    
    <!-- Верхняя часть: Тег и стрелка -->
    <div class="flex items-start justify-between gap-4">
        <span class="min-w-0 truncate text-[16px] font-medium text-brand"><?php echo e($tag); ?></span>
        <a href="<?php echo e(route('stock.show', $promotion->slug)); ?>" aria-label="Открыть акцию: <?php echo e($promotion->title); ?>"
           class="shrink-0 rounded-md p-0.5 text-body transition-transform hover:translate-x-0.5 hover:text-brand focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" aria-hidden="true"
                 class="h-[22px] w-[22px]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16 16 8M16 8H9.5M16 8v6.5"/>
            </svg>
        </a>
    </div>

    <!-- Центральная часть: Заголовок и описание -->
    <div class="mt-3 sm:mt-4">
        <h3 class="text-[36px] font-semibold leading-snug text-ink 2xl:text-[26px]"><?php echo e($promotion->title); ?></h3>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($promotion->excerpt): ?>
            <p class="mt-2 overflow-hidden text-[20px] leading-relaxed text-body [display:-webkit-box] [-webkit-box-orient:vertical] [-webkit-line-clamp:4] 2xl:text-[15px]"><?php echo e($promotion->excerpt); ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- Нижняя часть: Дата -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($date): ?>
        <span class="pt-4 text-[20px] text-[#91B5D5]"><?php echo e($date); ?></span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>
    </div>
</article>
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/components/promotion-card.blade.php ENDPATH**/ ?>