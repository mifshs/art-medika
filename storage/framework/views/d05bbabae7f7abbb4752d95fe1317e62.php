<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Акции</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>
    <?php echo $__env->make('components.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="mx-auto w-full max-w-[1720px] px-4 pb-16 sm:px-6 md:px-10 2xl:px-0">
        
        <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-6 text-[15px] text-body">
            <a href="<?php echo e(url('/')); ?>" class="transition-colors hover:text-brand">Арт-Медика</a>
            <img src="<?php echo e(asset('images/_.svg')); ?>" alt="" class="h-3 w-auto" aria-hidden="true">
            <span class="font-medium text-ink">Акции</span>
        </nav>

        
        <div class="flex flex-col items-start justify-between gap-8 pt-10 lg:flex-row lg:items-start 2xl:pt-[52px]">
            <h1 class="flex shrink-0 items-center gap-2 text-[40px] font-medium leading-none text-[#91B5D5] max-lg:text-3xl">
                Акции
                <img src="<?php echo e(asset('images/Arrow_right_light.svg')); ?>" alt="" class="w-[50px] max-lg:w-[38px]" aria-hidden="true">
            </h1>
            <p class="max-w-[1140px] text-[40px] font-medium leading-tight text-[#1D293D] max-lg:text-2xl">
                Мы регулярно предлагаем выгодные акции и специальные предложения на популярные
                услуги, чтобы вы могли получать качественную медицинскую помощь по привлекательной стоимости
            </p>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($promotions->isNotEmpty()): ?>
            <div class="mt-10 grid gap-5 sm:grid-cols-2 2xl:mt-12 2xl:gap-5">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $promotions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal817e71b52d8f235470365b03bc4460f8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal817e71b52d8f235470365b03bc4460f8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.promotion-card','data' => ['promotion' => $promotion]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('promotion-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['promotion' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($promotion)]); ?>
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
        <?php else: ?>
            <div class="mt-10 rounded-[24px] bg-surface px-8 py-16 text-center">
                <p class="text-[20px] font-medium text-ink">Активных акций пока нет</p>
                <p class="mt-2 text-[15px] text-muted">Заглядывайте позже — мы регулярно добавляем новые предложения.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($promotions->hasPages()): ?>
            <?php
                $current = $promotions->currentPage();
                $last = $promotions->lastPage();
                $pages = [];
                foreach (range(1, $last) as $i) {
                    if ($i == 1 || $i == $last || ($i >= $current - 1 && $i <= $current + 1)) {
                        $pages[] = $i;
                    } elseif (end($pages) !== '…') {
                        $pages[] = '…';
                    }
                }
            ?>
            <nav aria-label="Пагинация акций" class="mt-10 flex items-center justify-between gap-4 max-sm:flex-wrap max-sm:justify-center">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($promotions->onFirstPage()): ?>
                    <span aria-hidden="true"
                          class="grid h-10 w-10 place-items-center rounded-[10px] bg-surfaceh text-white/40">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                             stroke="currentColor" class="h-5 w-5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12H4.75M4.75 12 11 5.75M4.75 12 11 18.25"/>
                        </svg>
                    </span>
                <?php else: ?>
                    <a href="<?php echo e($promotions->previousPageUrl()); ?>" rel="prev" aria-label="Предыдущая страница"
                       class="grid h-10 w-10 place-items-center rounded-[10px] bg-brand text-white transition-colors hover:bg-brandh">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                             stroke="currentColor" class="h-5 w-5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12H4.75M4.75 12 11 5.75M4.75 12 11 18.25"/>
                        </svg>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <ul class="flex items-center gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($page === '…'): ?>
                            <li><span class="px-1 text-muted" aria-hidden="true"><?php echo e($page); ?></span></li>
                        <?php elseif($page == $current): ?>
                            <li><span aria-current="page"
                                      class="grid h-10 min-w-[40px] place-items-center rounded-[10px] border border-border bg-white px-3 text-[14px] font-semibold text-ink"><?php echo e($page); ?></span></li>
                        <?php else: ?>
                            <li><a href="<?php echo e($promotions->url($page)); ?>"
                                   class="grid h-10 min-w-[40px] place-items-center rounded-[10px] border border-transparent px-3 text-[14px] text-body transition-colors hover:border-border hover:bg-white"><?php echo e($page); ?></a></li>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($promotions->onLastPage()): ?>
                    <span aria-hidden="true"
                          class="grid h-10 w-10 place-items-center rounded-[10px] bg-surfaceh text-white/40">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                             stroke="currentColor" class="h-5 w-5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h14.75M19.25 12 13 5.75M19.25 12 13 18.25"/>
                        </svg>
                    </span>
                <?php else: ?>
                    <a href="<?php echo e($promotions->nextPageUrl()); ?>" rel="next" aria-label="Следующая страница"
                       class="grid h-10 w-10 place-items-center rounded-[10px] bg-brand text-white transition-colors hover:bg-brandh">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                             stroke="currentColor" class="h-5 w-5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h14.75M19.25 12 13 5.75M19.25 12 13 18.25"/>
                        </svg>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </nav>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </main>

    <?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH F:\xampp\htdocs\art-medic\art-medika\resources\views\stock.blade.php ENDPATH**/ ?>