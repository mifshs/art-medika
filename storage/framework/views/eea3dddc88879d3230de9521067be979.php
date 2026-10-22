<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['project']));

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

foreach (array_filter((['project']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $coverUrl = $project->coverUrl();
    $date = $project->published_at ? \Illuminate\Support\Carbon::parse($project->published_at)->format('d.m.Y') : '';
    $excerpt = \Illuminate\Support\Str::limit($project->excerpt ?? $project->description ?? '', 260, end: '…');
?>

<article class="group overflow-hidden rounded-[20px] bg-surface sm:rounded-[24px]">
    <div class="grid gap-0 lg:grid-cols-[minmax(0,1fr)_minmax(0,1fr)] lg:gap-0">
        
        <div class="relative overflow-hidden">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($coverUrl): ?>
                <img src="<?php echo e($coverUrl); ?>" alt="<?php echo e($project->title); ?>" width="800" height="600" loading="lazy"
                     class="h-[220px] w-full object-cover transition-transform duration-500 group-hover:scale-[1.03] sm:h-[280px] lg:h-full lg:min-h-[320px] 2xl:min-h-[380px]">
            <?php else: ?>
                <div class="flex h-[220px] w-full items-center justify-center bg-surfaceh sm:h-[280px] lg:h-full lg:min-h-[320px]">
                    <svg class="h-16 w-16 text-border" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="flex flex-col px-5 py-5 sm:px-6 sm:py-6 lg:px-8 lg:py-6 2xl:px-10 2xl:py-8">
            
            <div class="flex items-start justify-between gap-4">
                <p class="text-[13px] text-muted sm:text-[14px] 2xl:text-[15px]">Проекты</p>
                <a href="#" aria-label="Открыть проект «<?php echo e($project->title); ?>»"
                   class="shrink-0 text-ink transition-colors hover:text-brand">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>

            
            <div class="mt-4 flex-1 sm:mt-5">
                <h2 class="text-[20px] font-semibold leading-tight text-ink sm:text-[22px] lg:text-[24px] 2xl:text-[28px]">
                    <?php echo e($project->title); ?>

                </h2>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($excerpt): ?>
                    <p class="mt-3 text-[13px] leading-relaxed text-body sm:text-[14px] lg:text-[15px] 2xl:mt-4 2xl:text-[16px]">
                        <?php echo e($excerpt); ?>

                    </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="mt-5 sm:mt-6">
                <a href="#"
                   class="inline-block rounded-[10px] bg-brand px-6 py-3 text-[13px] font-semibold text-white transition-colors hover:bg-brandh sm:px-7 sm:py-3.5 sm:text-[14px]">
                    Подробнее
                </a>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($date): ?>
                <p class="mt-4 text-[13px] text-steel sm:mt-5 sm:text-[14px] 2xl:text-[15px]"><?php echo e($date); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</article>
<?php /**PATH F:\xampp\htdocs\art-medic\art-medika\resources\views/components/project-card.blade.php ENDPATH**/ ?>