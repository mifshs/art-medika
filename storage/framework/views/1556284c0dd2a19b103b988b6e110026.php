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
    $categoryName = $news->category?->name ?? 'Хирургия';
    $typeLabel = $news->type === 'article' ? 'Статья' : 'Новости';
    $date = $news->published_at ? \Illuminate\Support\Carbon::parse($news->published_at)->format('d.m.Y') : '';
    $readingTime = $news->readingTime() ?: 7;
    $expert = $news->author;
    $detailUrl = route('news.show', $news->slug);
    $excerpt = $news->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($news->content), 150);
?>


<article class="group relative flex h-full flex-col justify-between rounded-[20px] bg-[#F3F6FD] p-4 transition-all duration-300 hover:shadow-md sm:rounded-[24px] sm:p-5 lg:col-span-2 lg:p-6">
    
    <div class="flex items-center justify-between gap-2 text-[13px] text-[#7E93AC] sm:text-[14px] lg:hidden">
        <span><?php echo e($typeLabel); ?> / <?php echo e($categoryName); ?></span>
        <a href="<?php echo e($detailUrl); ?>" aria-label="Открыть «<?php echo e($news->title); ?>»"
           class="inline-flex h-5 w-5 shrink-0 items-center justify-center text-[#1A1A1A] transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M7 17L17 7H8.5M17 7v8.5"/>
            </svg>
        </a>
    </div>

    <div class="mt-3 grid h-full grid-cols-1 gap-4 lg:mt-0 lg:grid-cols-2 lg:gap-6 lg:items-stretch">
        
        <a href="<?php echo e($detailUrl); ?>" class="flex flex-col justify-between rounded-[16px] bg-white p-3.5 shadow-sm border border-slate-100 sm:p-4 transition-transform duration-300 group-hover:border-slate-200">
            <div>
                
                <p class="text-[11px] font-normal text-[#6B7280]">
                    Примерное время чтения: <?php echo e($readingTime); ?> минут
                </p>

                
                <h4 class="mt-1 text-[13px] font-bold leading-snug text-[#1A1A1A] sm:text-[14px]">
                    <?php echo e($news->title); ?>

                </h4>

                
                <div class="mt-2.5 overflow-hidden rounded-[10px]">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($coverUrl): ?>
                        <img src="<?php echo e($coverUrl); ?>" alt="<?php echo e($news->title); ?>" loading="lazy"
                             class="aspect-[16/10] w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <?php else: ?>
                        <div class="flex aspect-[16/10] w-full items-center justify-center bg-slate-200 text-slate-400">
                            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($expert): ?>
                    <p class="mt-2 text-[10px] text-[#6B7280] sm:text-[11px]">
                        врач-эксперт <?php echo e($expert->name); ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($expert->position): ?>
                            <span class="underline"><?php echo e($expert->position); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <p class="mt-2 text-[11px] leading-relaxed text-[#4B5563] sm:text-[12px] line-clamp-3">
                    <?php echo e($excerpt); ?>

                </p>
            </div>
        </a>

        
        <div class="flex flex-col justify-between">
            
            <div class="hidden items-center justify-between gap-2 text-[14px] text-[#7E93AC] lg:flex">
                <span><?php echo e($typeLabel); ?> / <?php echo e($categoryName); ?></span>
                <a href="<?php echo e($detailUrl); ?>" aria-label="Открыть «<?php echo e($news->title); ?>»"
                   class="inline-flex h-5 w-5 shrink-0 items-center justify-center text-[#1A1A1A] transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M7 17L17 7H8.5M17 7v8.5"/>
                    </svg>
                </a>
            </div>

            
            <h3 class="my-auto py-2 text-[16px] font-semibold leading-[1.3] text-[#1A1A1A] transition-colors group-hover:text-brand sm:text-[18px] lg:py-4 lg:text-[24px] lg:font-medium lg:leading-[1.25] 2xl:text-[26px]">
                <a href="<?php echo e($detailUrl); ?>" class="transition-colors hover:text-brand">
                    <?php echo e($news->title); ?>

                </a>
            </h3>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($date): ?>
                <div class="pt-1">
                    <span class="text-[13px] font-normal text-[#91B5D5] sm:text-[14px] 2xl:text-[15px]">
                        <?php echo e($date); ?>

                    </span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</article>
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/components/news-article-card.blade.php ENDPATH**/ ?>