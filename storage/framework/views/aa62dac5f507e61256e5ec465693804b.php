<?php
    $sectionName = $promotion->service?->name ?? $promotion->title;
    $promoCover = $promotion->coverUrl();
    $seoTitle = $promotion->title . ' — Акции — Арт-Медика';
    $seoDesc = $promotion->excerpt ?: \Illuminate\Support\Str::limit(strip_tags((string) $promotion->content), 160);
    $seoKeywords = trim(implode(', ', array_filter([$promotion->title, $promotion->service?->name, 'акции Арт-Медика', 'скидки Челябинск'])));
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php if (isset($component)) { $__componentOriginal4232ba5ed77147a6b6573253fafb715d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4232ba5ed77147a6b6573253fafb715d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-head','data' => ['title' => $seoTitle,'description' => $seoDesc,'keywords' => $seoKeywords,'ogImage' => $promoCover,'preloadImage' => $promoCover]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoTitle),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoDesc),'keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoKeywords),'ogImage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($promoCover),'preloadImage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($promoCover)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4232ba5ed77147a6b6573253fafb715d)): ?>
<?php $attributes = $__attributesOriginal4232ba5ed77147a6b6573253fafb715d; ?>
<?php unset($__attributesOriginal4232ba5ed77147a6b6573253fafb715d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4232ba5ed77147a6b6573253fafb715d)): ?>
<?php $component = $__componentOriginal4232ba5ed77147a6b6573253fafb715d; ?>
<?php unset($__componentOriginal4232ba5ed77147a6b6573253fafb715d); ?>
<?php endif; ?>
</head>
<body class="bg-page font-onest text-body antialiased">
    <?php echo $__env->make('components.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main id="main-content" class="mx-auto w-full max-w-[1720px] px-4 pb-16 sm:px-6 md:px-10 2xl:px-0">
        
        <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-6 text-[15px] text-body">
            <a href="<?php echo e(url('/')); ?>" class="transition-colors hover:text-brand">Арт-Медика</a>
            <img src="<?php echo e(asset('images/_.svg')); ?>" alt="" width="7" height="10" class="h-3 w-auto" aria-hidden="true">
            <span class="font-medium text-ink"><?php echo e($sectionName); ?></span>
        </nav>

        
        <div class="flex flex-col gap-8 pt-8 lg:flex-row lg:gap-16 2xl:gap-20 2xl:pt-10">
            <div class="w-full shrink-0 lg:w-[42%]">
                <h1 class="flex items-center gap-2 text-[40px] font-medium leading-none text-[#4A749B] max-lg:text-3xl">
                    <?php echo e($sectionName); ?>

                    <img src="<?php echo e(asset('images/Arrow_right_light.svg')); ?>" alt="" width="50" height="50" class="w-[50px] max-lg:w-[38px]" aria-hidden="true">
                </h1>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($promoCover): ?>
                    <img src="<?php echo e($promoCover); ?>" alt="<?php echo e($promotion->title); ?>" fetchpriority="high" decoding="async"
                         width="395" height="517"
                         class="mt-8 w-full rounded-[24px] bg-hero object-cover object-top">
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="flex min-w-0 flex-1 flex-col">
                <p class="text-center text-[40px] font-semibold leading-snug text-brand max-lg:text-left max-lg:text-2xl"><?php echo e($promotion->title); ?></p>

                <div class="mt-6 [&>p]:mt-0 [&>p+p]:mt-4 [&>p]:text-[28px] [&>p]:leading-relaxed [&>p]:text-body 2xl:text-[28px]">
                    <?php echo $promotion->content; ?>

                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($promotion->published_at): ?>
                    <span class="mt-8 text-[24px] text-[#4A749B]"><?php echo e($promotion->published_at->format('d.m.Y')); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($promotions->isNotEmpty()): ?>
            <?php $chunks = $promotions->chunk(2); ?>
            <div class="mt-14 swiper" data-swiper='{"slidesPerView": 1, "spaceBetween": 20}'>
                <div class="swiper-wrapper">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $chunks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide">
                            <div class="grid gap-5 sm:grid-cols-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if (isset($component)) { $__componentOriginal817e71b52d8f235470365b03bc4460f8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal817e71b52d8f235470365b03bc4460f8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.promotion-card','data' => ['promotion' => $card]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('promotion-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['promotion' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal817e71b52d8f235470365b03bc4460f8)): ?>
<?php $attributes = $__attributesOriginal817e71b52d8f235470365b03bc4460f8; ?>
<?php unset($__attributesOriginal817e71b52d8f235470365b03bc4460f8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal817e71b52d8f235470365b03bc4460f8)): ?>
<?php $component = $__componentOriginal817e71b52d8f235470365b03bc4460f8; ?>
<?php unset($__componentOriginal817e71b52d8f235470365b03bc4460f8); ?>
<?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($promotions->count() > 2): ?>
            <?php
                $chunks = $promotions->chunk(2);
                $totalPages = $chunks->count();
                $pages = [];
                foreach (range(1, $totalPages) as $i) {
                    if ($i <= 3 || $i == $totalPages) {
                        $pages[] = $i;
                    } elseif (end($pages) !== '…') {
                        $pages[] = '…';
                    }
                }
            ?>
            <nav aria-label="Пагинация акций" class="mt-10 flex items-center justify-between gap-4 max-sm:flex-wrap max-sm:justify-center">
                <button type="button" aria-label="Предыдущая страница"
                        class="swiper-btn-prev grid h-10 w-10 place-items-center rounded-[10px] bg-brand text-white transition-colors hover:bg-brandh">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                         stroke="currentColor" class="h-5 w-5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12H4.75M4.75 12 11 5.75M4.75 12 11 18.25"/>
                    </svg>
                </button>

                <ul class="flex items-center gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($page === '…'): ?>
                            <li><span class="px-1 text-muted" aria-hidden="true">…</span></li>
                        <?php else: ?>
                            <li>
                                <button type="button" data-slide-index="<?php echo e($page - 1); ?>"
                                        class="swiper-page-btn grid h-10 min-w-[40px] place-items-center rounded-[10px] border <?php echo e($page === 1 ? 'border-border bg-white' : 'border-transparent'); ?> px-3 text-[14px] font-semibold text-ink transition-colors hover:border-border hover:bg-white">
                                    <?php echo e($page); ?>

                                </button>
                            </li>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>

                <button type="button" aria-label="Следующая страница"
                        class="swiper-btn-next grid h-10 w-10 place-items-center rounded-[10px] bg-brand text-white transition-colors hover:bg-brandh">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                         stroke="currentColor" class="h-5 w-5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h14.75M19.25 12 13 5.75M19.25 12 13 18.25"/>
                    </svg>
                </button>
            </nav>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </main>

    <?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/stock-detail.blade.php ENDPATH**/ ?>