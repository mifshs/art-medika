<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Наши специалисты — Медико-косметологический центр «Арт-Медика»</title>
    <?php if (isset($component)) { $__componentOriginal82e3f864bb766fbb95cb0a10b750823c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal82e3f864bb766fbb95cb0a10b750823c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.favicon','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('favicon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal82e3f864bb766fbb95cb0a10b750823c)): ?>
<?php $attributes = $__attributesOriginal82e3f864bb766fbb95cb0a10b750823c; ?>
<?php unset($__attributesOriginal82e3f864bb766fbb95cb0a10b750823c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal82e3f864bb766fbb95cb0a10b750823c)): ?>
<?php $component = $__componentOriginal82e3f864bb766fbb95cb0a10b750823c; ?>
<?php unset($__componentOriginal82e3f864bb766fbb95cb0a10b750823c); ?>
<?php endif; ?>
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
        <span class="font-medium">Специалисты</span>
    </nav>

    
    <?php
        $introText = \App\Models\Setting::get(
            'specialists_intro',
            'Наши специалисты — это команда профессионалов с многолетним опытом в пластической хирургии и косметологии. Они постоянно повышают своё мастерство, чтобы дарить вам гармонию, уверенность в себе и в своём теле.'
        );
    ?>
    <div class="mt-7 sm:mt-8 lg:mt-14">
        <div class="grid gap-4 lg:grid-cols-[1fr_2.5fr] lg:gap-10 items-start">
            
            <div>
                <p class="inline-flex items-baseline gap-2 text-[24px] font-medium text-[#91B5D5] sm:text-[28px] lg:text-[32px] 2xl:text-[40px]">
                    Наши специалисты
                    <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 17L17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </p>
            </div>

            
            <h1 class="text-center text-[18px] font-medium leading-[1.3] text-brand sm:text-[22px] lg:text-left lg:text-[28px] lg:[text-indent:140px] 2xl:text-[36px] 2xl:[text-indent:200px]">
                <?php echo e($introText); ?>

            </h1>
        </div>
    </div>

    
    <div role="tablist" aria-label="Фильтр специалистов по отделениям" class="no-scrollbar mt-8 flex gap-2.5 overflow-x-auto lg:mt-10">
        <button type="button"
                data-department-filter="all"
                role="tab"
                aria-selected="true"
                class="dept-filter-btn shrink-0 whitespace-nowrap rounded-[10px] bg-brand px-6 py-3 text-[13px] font-medium text-white transition-colors hover:bg-brandh sm:text-[14px] lg:text-[16px]">
            Все
        </button>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button"
                    data-department-filter="<?php echo e($dept->name); ?>"
                    role="tab"
                    aria-selected="false"
                    class="dept-filter-btn shrink-0 whitespace-nowrap rounded-[10px] bg-[#F4F7FD] px-6 py-3 text-[13px] font-medium text-body transition-colors hover:bg-[#E2E7F1] sm:text-[14px] lg:text-[16px]">
                <?php echo e($dept->name); ?>

            </button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($experts->isNotEmpty()): ?>
        <div id="specialists-grid" class="mt-8 grid grid-cols-1 gap-5 lg:mt-10 lg:grid-cols-2 2xl:gap-6">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $experts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginal98e4573eba4450e1b5eea8713435340d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal98e4573eba4450e1b5eea8713435340d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.specialist-card','data' => ['expert' => $expert]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('specialist-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['expert' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($expert)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal98e4573eba4450e1b5eea8713435340d)): ?>
<?php $attributes = $__attributesOriginal98e4573eba4450e1b5eea8713435340d; ?>
<?php unset($__attributesOriginal98e4573eba4450e1b5eea8713435340d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal98e4573eba4450e1b5eea8713435340d)): ?>
<?php $component = $__componentOriginal98e4573eba4450e1b5eea8713435340d; ?>
<?php unset($__componentOriginal98e4573eba4450e1b5eea8713435340d); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div id="specialists-empty" class="mt-10 hidden rounded-[20px] bg-[#F4F7FD] px-8 py-14 text-center">
            <p class="text-[18px] font-medium text-ink">В этом отделении пока нет специалистов</p>
            <p class="mt-2 text-[14px] text-muted">Выберите другое отделение или перейдите во вкладку «Все».</p>
        </div>
    <?php else: ?>
        <div class="mt-12 rounded-[20px] bg-[#F4F7FD] px-8 py-16 text-center">
            <p class="text-[20px] font-medium text-ink">Специалисты пока не добавлены</p>
            <p class="mt-2 text-[15px] text-muted">Заглядывайте позже — мы регулярно обновляем информацию о врачах клиники.</p>
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


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var buttons = document.querySelectorAll('.dept-filter-btn');
        var grid = document.getElementById('specialists-grid');
        var emptyMessage = document.getElementById('specialists-empty');
        if (!grid) return;

        var cards = grid.querySelectorAll('article[data-department]');

        buttons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var filter = this.getAttribute('data-department-filter');

                // Переключение визуального стиля кнопок
                buttons.forEach(function (b) {
                    if (b === btn) {
                        b.className = 'dept-filter-btn shrink-0 whitespace-nowrap rounded-[10px] bg-brand px-6 py-3 text-[13px] font-medium text-white transition-colors hover:bg-brandh sm:text-[14px] lg:text-[16px]';
                        b.setAttribute('aria-selected', 'true');
                    } else {
                        b.className = 'dept-filter-btn shrink-0 whitespace-nowrap rounded-[10px] bg-[#F4F7FD] px-6 py-3 text-[13px] font-medium text-body transition-colors hover:bg-[#E2E7F1] sm:text-[14px] lg:text-[16px]';
                        b.setAttribute('aria-selected', 'false');
                    }
                });

                // Фильтрация карточек
                var visibleCount = 0;
                cards.forEach(function (card) {
                    var dept = card.getAttribute('data-department');
                    if (filter === 'all' || dept === filter) {
                        card.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        card.classList.add('hidden');
                    }
                });

                if (emptyMessage) {
                    emptyMessage.classList.toggle('hidden', visibleCount > 0);
                }
            });
        });
    });
</script>

</body>
</html>
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/specialists.blade.php ENDPATH**/ ?>