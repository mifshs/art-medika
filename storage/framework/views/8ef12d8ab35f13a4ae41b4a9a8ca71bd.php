<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['category']));

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

foreach (array_filter((['category']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $cover = $category->coverUrl();

    // Мобильный порядок карточек (макет image-1.png) — литеральные классы для Tailwind JIT:
    // kosmetologiya → 1, otorinolaringologiya → 2, lor-hirurgiya → 3, massazh → 4,
    // esteticheskaya-ginekologiya → 5, dermatologiya → 6, top-produkty → 7,
    // plasticheskaya-hirurgiya → 8, nevrologiya-i-refleksoterapiya → 9, terapevticheskiy-priem → 10.
    $orderClasses = [
        'kosmetologiya'                  => 'max-sm:order-1',
        'otorinolaringologiya'           => 'max-sm:order-2',
        'lor-hirurgiya'                  => 'max-sm:order-3',
        'massazh'                        => 'max-sm:order-4',
        'esteticheskaya-ginekologiya'    => 'max-sm:order-5',
        'dermatologiya'                  => 'max-sm:order-6',
        'top-produkty'                   => 'max-sm:order-7',
        'plasticheskaya-hirurgiya'       => 'max-sm:order-8',
        'nevrologiya-i-refleksoterapiya' => 'max-sm:order-9',
        'terapevticheskiy-priem'         => 'max-sm:order-10',
    ];
    $orderClass = $orderClasses[$category->slug] ?? '';
?>

<a href="<?php echo e(route('services.show', $category->slug)); ?>" aria-label="Направление «<?php echo e($category->name); ?>»"
   class="group block rounded-[12px] py-2 -my-2 transition-opacity focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand <?php echo e($orderClass); ?>">
    
    <div class="relative aspect-[12/7] w-full overflow-hidden rounded-[12px] bg-hero sm:rounded-[16px]">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cover): ?>
            <img src="<?php echo e($cover); ?>" alt="Направление клиники: <?php echo e($category->name); ?>" loading="lazy"
                 class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.04]">
        <?php else: ?>
            <div class="absolute inset-0 grid place-items-center">
                <span class="font-serif text-[21px] italic font-semibold tracking-tight text-brand">Арт-Медика</span>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <h3 class="mt-[25px] text-[24px] font-medium leading-tight text-body transition-colors group-hover:text-brand sm:mt-7 sm:text-[28px] xl:text-[32px] 2xl:text-[36px]">
        <?php echo e($category->name); ?>

    </h3>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category->description): ?>
        
        <p class="mt-6 hidden max-w-[680px] text-[15px] leading-snug text-[#A09CAB] max-sm:block">
            <?php echo e($category->description); ?>

        </p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category->subtitle): ?>
        <p class="mt-2 max-w-[680px] text-[14px] leading-snug text-body max-sm:hidden sm:mt-2.5 sm:text-[15px] xl:text-[17px] 2xl:text-[18px]">
            <?php echo e($category->subtitle); ?>

        </p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</a>
<?php /**PATH F:\xampp\htdocs\art-medic\art-medika\resources\views\components\service-category-card.blade.php ENDPATH**/ ?>