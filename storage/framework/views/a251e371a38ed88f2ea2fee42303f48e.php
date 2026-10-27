<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['news']));

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

foreach (array_filter((['news']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $coverUrl = $news->coverUrl();
    $categoryName = $news->category?->name ?? 'Косметология';
    $typeLabel = $news->type === 'article' ? 'Статья' : 'Новости';
    $date = $news->published_at ? \Illuminate\Support\Carbon::parse($news->published_at)->format('d.m.Y') : '';
    $detailUrl = route('news.show', $news->slug);
?>


<article class="group relative flex h-full flex-col justify-between rounded-[20px] bg-[#F3F6FD] p-4 transition-all duration-300 hover:shadow-md sm:rounded-[24px] sm:p-5 lg:p-6">
    <div class="flex flex-col">
        
        <div class="flex items-center justify-between gap-2 text-[13px] text-[#7E93AC] sm:text-[14px]">
            <span><?php echo e($typeLabel); ?> / <?php echo e($categoryName); ?></span>
            <a href="<?php echo e($detailUrl); ?>" aria-label="Открыть «<?php echo e($news->title); ?>»"
               class="inline-flex h-5 w-5 shrink-0 items-center justify-center text-[#1A1A1A] transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M7 17L17 7H8.5M17 7v8.5"/>
                </svg>
            </a>
        </div>

        
        <a href="<?php echo e($detailUrl); ?>" class="mt-3 block overflow-hidden rounded-[14px] sm:rounded-[18px]">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($coverUrl): ?>
                <img src="<?php echo e($coverUrl); ?>" alt="<?php echo e($news->title); ?>" loading="lazy"
                     class="aspect-[4/3] w-full object-cover transition-transform duration-500 group-hover:scale-105">
            <?php else: ?>
                <div class="flex aspect-[4/3] w-full items-center justify-center bg-slate-200 text-slate-400">
                    <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </a>

        
        <h3 class="mt-4 text-[16px] font-semibold leading-[1.3] text-[#1A1A1A] transition-colors group-hover:text-brand sm:text-[18px] lg:text-[19px]">
            <a href="<?php echo e($detailUrl); ?>" class="transition-colors hover:text-brand">
                <?php echo e($news->title); ?>

            </a>
        </h3>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($date): ?>
        <div class="mt-4 pt-2">
            <span class="text-[13px] font-normal text-[#91B5D5] sm:text-[14px] 2xl:text-[15px]">
                <?php echo e($date); ?>

            </span>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</article>
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/components/news-card.blade.php ENDPATH**/ ?>