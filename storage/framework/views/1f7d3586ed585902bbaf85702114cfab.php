<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости — Медико-косметологический центр «Арт-Медика»</title>
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
        <span class="font-medium">Новости</span>
    </nav>

    
    <?php
        $introText = \App\Models\Setting::get(
            'news_intro',
            'В этом разделе мы собираем всё, что формирует доверие пациентов: открытые итоги работы, значимые события, запуск новых услуг и кадровые изменения, влияющие на качество приёма'
        );
    ?>
    <div class="mt-7 sm:mt-8 lg:mt-14">
        <div class="grid gap-4 lg:grid-cols-[1fr_2.5fr] lg:gap-10 items-start">
            
            <div>
                <p class="inline-flex items-baseline gap-2 text-[24px] font-medium text-[#91B5D5] sm:text-[28px] lg:text-[32px] 2xl:text-[40px]">
                    Новости
                    <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </p>
            </div>

            
            <h1 class="text-center text-[18px] font-medium leading-[1.3] text-brand sm:text-[22px] lg:text-left lg:text-[28px] lg:[text-indent:140px] 2xl:text-[36px] 2xl:[text-indent:200px]">
                <?php echo e($introText); ?>

            </h1>
        </div>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($news->isNotEmpty()): ?>
        <div class="mt-8 lg:mt-12">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-5 2xl:gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // Первая и 10-я карточки (или если тип article) отображаются в широком формате
                        $isArticle = ($item->type === 'article') || ($index === 0) || ($index === 9);
                    ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isArticle): ?>
                        <?php if (isset($component)) { $__componentOriginala14b26fec129907780a0a8359632a7c6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala14b26fec129907780a0a8359632a7c6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.news-article-card','data' => ['news' => $item]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('news-article-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['news' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala14b26fec129907780a0a8359632a7c6)): ?>
<?php $attributes = $__attributesOriginala14b26fec129907780a0a8359632a7c6; ?>
<?php unset($__attributesOriginala14b26fec129907780a0a8359632a7c6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala14b26fec129907780a0a8359632a7c6)): ?>
<?php $component = $__componentOriginala14b26fec129907780a0a8359632a7c6; ?>
<?php unset($__componentOriginala14b26fec129907780a0a8359632a7c6); ?>
<?php endif; ?>
                    <?php else: ?>
                        <?php if (isset($component)) { $__componentOriginal1a2825a6708c27e00d3538c2a0d29d90 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a2825a6708c27e00d3538c2a0d29d90 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.news-card','data' => ['news' => $item]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('news-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['news' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item)]); ?>
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
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        
        <?php
            $current = $news->currentPage();
            $last = max(15, $news->lastPage());
            $pages = [];
            foreach (range(1, $last) as $i) {
                if ($i == 1 || $i == 2 || $i == 3 || $i == $last || ($i >= $current - 1 && $i <= $current + 1)) {
                    $pages[] = $i;
                } elseif (end($pages) !== '…') {
                    $pages[] = '…';
                }
            }
        ?>
        <nav aria-label="Пагинация новостей" class="mt-10 flex w-full items-center justify-between lg:mt-14">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($news->onFirstPage()): ?>
                <span aria-hidden="true"
                      class="flex h-10 w-10 sm:h-11 sm:w-11 shrink-0 items-center justify-center rounded-[8px] bg-brand text-white opacity-40 sm:rounded-[10px]">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </span>
            <?php else: ?>
                <a href="<?php echo e($news->previousPageUrl()); ?>" rel="prev" aria-label="Предыдущая страница"
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
                            $targetUrl = $page <= $news->lastPage() ? $news->url($page) : $news->url(1);
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

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($news->hasMorePages()): ?>
                <a href="<?php echo e($news->nextPageUrl()); ?>" rel="next" aria-label="Следующая страница"
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
    <?php else: ?>
        
        <div class="mt-12 rounded-[20px] bg-[#F4F7FF] px-8 py-16 text-center">
            <p class="text-[20px] font-medium text-ink">Новостей пока нет</p>
            <p class="mt-2 text-[15px] text-muted">Заглядывайте позже — мы регулярно публикуем новости клиники.</p>
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
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/news.blade.php ENDPATH**/ ?>