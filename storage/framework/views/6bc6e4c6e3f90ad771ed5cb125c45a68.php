<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($news->title); ?> — Медико-косметологический центр «Арт-Медика»</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-page font-onest text-body antialiased">

<?php if (isset($component)) { $__componentOriginal2a2e454b2e62574a80c8110e5f128b60 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60 = $attributes; } ?>
<?php $component = App\View\Components\Header::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Header::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2a2e454b2e62574a80c8110e5f128b60)): ?>
<?php $attributes = $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60; ?>
<?php unset($__attributesOriginal2a2e454b2e62574a80c8110e5f128b60); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2a2e454b2e62574a80c8110e5f128b60)): ?>
<?php $component = $__componentOriginal2a2e454b2e62574a80c8110e5f128b60; ?>
<?php unset($__componentOriginal2a2e454b2e62574a80c8110e5f128b60); ?>
<?php endif; ?>

<main class="mx-auto w-full max-w-[1720px] px-4 pb-14 sm:px-6 md:px-10 lg:pb-24 2xl:px-0">
    
    <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-5 text-[15px] text-brand sm:pt-6 sm:text-[16px] 2xl:text-[18px]">
        <a href="<?php echo e(url('/')); ?>" class="transition-colors duration-200 hover:text-brandh">Арт-Медика</a>
        <img src="<?php echo e(asset('images/_.svg')); ?>" alt="" class="h-3 w-auto" aria-hidden="true">
        <a href="<?php echo e(route('news')); ?>" class="transition-colors duration-200 hover:text-brandh">Новости</a>
        <img src="<?php echo e(asset('images/_.svg')); ?>" alt="" class="h-3 w-auto" aria-hidden="true">
        <span class="font-medium text-ink line-clamp-1 max-w-[280px] sm:max-w-md lg:max-w-xl">
            "<?php echo e(\Illuminate\Support\Str::limit($news->title, 40)); ?>"
        </span>
    </nav>

    
    <?php
        $categoryName = $news->category?->name ?? 'Хирургия';
        $coverUrl = $news->coverUrl();
    ?>

    <div class="mt-7 sm:mt-8 lg:mt-12">
        
        <div class="lg:hidden">
            <p class="inline-flex items-baseline gap-2 text-[24px] font-medium text-[#91B5D5] sm:text-[28px]">
                <?php echo e($categoryName); ?>

                <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </p>
            <h1 class="mt-3 text-center text-[20px] font-semibold leading-[1.3] text-brand sm:text-left sm:text-[24px]">
                <?php echo e($news->title); ?>

            </h1>
        </div>

        
        <div class="hidden lg:grid lg:grid-cols-2 lg:gap-12 2xl:gap-16 items-start">
            <div>
                <p class="inline-flex items-baseline gap-2 text-[32px] 2xl:text-[40px] font-medium text-[#91B5D5]">
                    <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </p>
            </div>
            <div>
                <h1 class="text-[28px] sm:text-[32px] lg:text-[34px] 2xl:text-[40px] font-medium leading-[1.25] text-brand">
                    <?php echo e($news->title); ?>

                </h1>
            </div>
        </div>
    </div>

    
    <div class="mt-6 grid grid-cols-1 gap-6 sm:mt-8 sm:gap-8 lg:mt-10 lg:grid-cols-2 lg:gap-12 2xl:gap-16 items-start">
        
        <div class="relative overflow-hidden rounded-[20px] sm:rounded-[24px]">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($coverUrl): ?>
                <img src="<?php echo e($coverUrl); ?>" alt="<?php echo e($news->title); ?>"
                     class="w-full object-cover rounded-[20px] sm:rounded-[24px] max-h-[580px] 2xl:max-h-[640px]">
            <?php else: ?>
                <div class="flex aspect-[4/3] w-full items-center justify-center bg-slate-200 text-slate-400 rounded-[20px] sm:rounded-[24px]">
                    <svg class="h-16 w-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="pointer-events-none absolute -left-10 -top-10 h-20 w-20 rotate-[-45deg] bg-white shadow-sm sm:-left-12 sm:-top-12 sm:h-24 sm:w-24" aria-hidden="true"></div>
        </div>

        
        <div class="flex flex-col justify-between">
            <div class="space-y-4 text-[14px] leading-relaxed text-body sm:text-[15px] lg:text-[16px] 2xl:text-[17px] [&>p]:mt-0 [&>p+p]:mt-4 [&>ol]:my-4 [&>ol]:space-y-2 [&>ol]:pl-5 [&>ol]:list-decimal [&>blockquote]:my-5 [&>blockquote]:border-l-2 [&>blockquote]:border-brand [&>blockquote]:pl-4 [&>blockquote]:italic">
                <?php echo $news->content; ?>

            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($news->published_at): ?>
                <div class="mt-8 pt-2">
                    <span class="text-[14px] sm:text-[16px] 2xl:text-[18px] font-normal text-[#91B5D5]">
                        <?php echo e($news->published_at->format('d.m.Y')); ?>

                    </span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($otherNews->isNotEmpty()): ?>
        <div class="mt-14 sm:mt-16 lg:mt-24">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-5 2xl:gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $otherNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal1a2825a6708c27e00d3538c2a0d29d90 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a2825a6708c27e00d3538c2a0d29d90 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.news-card','data' => ['news' => $card]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('news-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['news' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1a2825a6708c27e00d3538c2a0d29d90)): ?>
<?php $attributes = $__attributesOriginal1a2825a6708c27e00d3538c2a0d29d90; ?>
<?php unset($__attributesOriginal1a2825a6708c27e00d3538c2a0d29d90); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a2825a6708c27e00d3538c2a0d29d90)): ?>
<?php $component = $__componentOriginal1a2825a6708c27e00d3538c2a0d29d90; ?>
<?php unset($__componentOriginal1a2825a6708c27e00d3538c2a0d29d90); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <?php
                $current = $otherNews->currentPage();
                $last = max(15, $otherNews->lastPage());
                $pages = [];
                foreach (range(1, $last) as $i) {
                    if ($i == 1 || $i == 2 || $i == 3 || $i == $last || ($i >= $current - 1 && $i <= $current + 1)) {
                        $pages[] = $i;
                    } elseif (end($pages) !== '…') {
                        $pages[] = '…';
                    }
                }
            ?>
            <nav aria-label="Пагинация других новостей" class="mt-10 flex w-full items-center justify-between lg:mt-14">
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($otherNews->onFirstPage()): ?>
                    <span aria-hidden="true"
                          class="flex h-10 w-10 sm:h-11 sm:w-11 shrink-0 items-center justify-center rounded-[8px] bg-brand text-white opacity-40 sm:rounded-[10px]">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                    </span>
                <?php else: ?>
                    <a href="<?php echo e($otherNews->previousPageUrl()); ?>" rel="prev" aria-label="Предыдущая страница"
                       class="flex h-10 w-10 sm:h-11 sm:w-11 shrink-0 items-center justify-center rounded-[8px] bg-brand text-white transition-all hover:bg-brandh sm:rounded-[10px]">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <ul class="flex items-center gap-1.5 sm:gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($page === '…'): ?>
                            <li>
                                <span class="flex h-10 min-w-[36px] items-center justify-center rounded-[8px] bg-[#F3F6FD] px-2 text-[14px] font-medium text-brand/60 sm:h-11 sm:min-w-[44px] sm:rounded-[10px] sm:text-[15px]" aria-hidden="true">
                                    …
                                </span>
                            </li>
                        <?php elseif($page == $current): ?>
                            <li>
                                <span aria-current="page"
                                      class="flex h-10 min-w-[40px] items-center justify-center rounded-[8px] border border-brand bg-white px-3 text-[14px] font-medium text-brand sm:h-11 sm:min-w-[44px] sm:rounded-[10px] sm:text-[15px]">
                                    <?php echo e($page); ?>

                                </span>
                            </li>
                        <?php else: ?>
                            <?php
                                $targetUrl = $page <= $otherNews->lastPage() ? $otherNews->url($page) : $otherNews->url(1);
                                $isPage3 = ($page == 3);
                            ?>
                            <li class="<?php echo e($isPage3 ? 'hidden sm:block' : ''); ?>">
                                <a href="<?php echo e($targetUrl); ?>"
                                   class="flex h-10 min-w-[40px] items-center justify-center rounded-[8px] bg-[#F3F6FD] px-3 text-[14px] font-medium text-brand transition-colors hover:bg-slate-200 sm:h-11 sm:min-w-[44px] sm:rounded-[10px] sm:text-[15px]">
                                    <?php echo e($page); ?>

                                </a>
                            </li>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($otherNews->hasMorePages()): ?>
                    <a href="<?php echo e($otherNews->nextPageUrl()); ?>" rel="next" aria-label="Следующая страница"
                       class="flex h-10 w-10 sm:h-11 sm:w-11 shrink-0 items-center justify-center rounded-[8px] bg-brand text-white transition-all hover:bg-brandh sm:rounded-[10px]">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                <?php else: ?>
                    <span aria-hidden="true"
                          class="flex h-10 w-10 sm:h-11 sm:w-11 shrink-0 items-center justify-center rounded-[8px] bg-brand text-white opacity-40 sm:rounded-[10px]">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </nav>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</main>

<?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>

</body>
</html>
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/news-detail.blade.php ENDPATH**/ ?>