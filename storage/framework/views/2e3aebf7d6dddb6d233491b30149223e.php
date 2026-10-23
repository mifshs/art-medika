<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title',
    'image'    => null,
    'services' => [],
]));

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

foreach (array_filter(([
    'title',
    'image'    => null,
    'services' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge([
    'class' => 'relative flex h-[240px] w-full flex-col justify-between overflow-hidden rounded-[20px] p-4 sm:h-[373px] sm:p-6 2xl:p-8',
])); ?>>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($image): ?>
        <img src="<?php echo e($image); ?>" alt="" loading="lazy"
             class="pointer-events-none absolute inset-0 h-full w-full object-cover">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <div class="pointer-events-none absolute inset-0 bg-[rgba(182,211,255,0.2)]"></div>
    <div class="pointer-events-none absolute inset-0 bg-[rgba(182,211,255,0.1)]"></div>

    
    <h3 class="relative z-10 text-[36px] font-medium leading-tight text-[#212529] max-md:text-2xl">
        <?php echo e($title); ?>

    </h3>

    
    <ul class="relative z-10 grid w-max max-w-full grid-cols-[max-content_22.5px] gap-x-6 gap-y-2.5 sm:gap-x-7 2xl:gap-x-9 2xl:gap-y-3">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="contents">
                <a href="<?php echo e($s['url'] ?? '#'); ?>"
                   class="group col-span-2 grid grid-cols-[subgrid] items-center text-[20px] leading-snug text-[#212529] max-md:text-base">
                    <span class="min-w-0"><?php echo e($s['label']); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor"
                         class="h-[18px] w-[22.5px] shrink-0 stroke-[1.5] transition-transform group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 6.75 19.5 12l-6.75 5.25"/>
                    </svg>
                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </ul>
</div>
<?php /**PATH F:\xampp\htdocs\art-medic\art-medika\resources\views/components/service-card.blade.php ENDPATH**/ ?>