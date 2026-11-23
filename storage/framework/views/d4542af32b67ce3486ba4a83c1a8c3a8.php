<!DOCTYPE html>
<html lang="ru">
<head>
    <?php if (isset($component)) { $__componentOriginal4232ba5ed77147a6b6573253fafb715d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4232ba5ed77147a6b6573253fafb715d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-head','data' => ['title' => 'Услуги — Медико-косметологический центр «Арт-Медика»','description' => 'Направления клиники «Арт-Медика»: пластическая хирургия, косметология, дерматология, ЛОР-хирургия, гинекология, неврология, массаж и диагностика.','keywords' => 'услуги Арт-Медика, пластическая хирургия, косметология, дерматология, оториноларингология, эстетическая гинекология, массаж','ogImage' => $categories->first()?->coverUrl()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Услуги — Медико-косметологический центр «Арт-Медика»','description' => 'Направления клиники «Арт-Медика»: пластическая хирургия, косметология, дерматология, ЛОР-хирургия, гинекология, неврология, массаж и диагностика.','keywords' => 'услуги Арт-Медика, пластическая хирургия, косметология, дерматология, оториноларингология, эстетическая гинекология, массаж','ogImage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($categories->first()?->coverUrl())]); ?>
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

    <main id="main-content" class="mx-auto w-full max-w-[1720px] px-4 pb-20 sm:px-6 md:px-10 2xl:px-0">
        
        <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-6 text-[18px] text-brand">
            <a href="<?php echo e(url('/')); ?>" rel="home" class="transition-colors duration-200 hover:text-brandh">Арт-Медика</a>
            <img src="<?php echo e(asset('images/_.svg')); ?>" width="7" height="10" alt="" class="h-3 w-auto" aria-hidden="true">
            <span class="font-medium">Услуги</span>
        </nav>

        
        <div class="flex flex-col items-start justify-between max-sm:gap-1 gap-8 max-sm:pt-8 lg:pt-10 lg:flex-row lg:items-start 2xl:pt-[52px]">
            <h1 class="flex shrink-0 items-center gap-2 text-[24px] font-medium leading-[32px] text-[#4A749B] lg:text-[40px] lg:leading-[52px]">
                Услуги
                <img src="<?php echo e(asset('images/Arrow_right_light.svg')); ?>" width="50" height="50" alt="" class="w-[50px] max-lg:w-[38px]" aria-hidden="true">
            </h1>
            <p class="max-w-[1140px] text-[24px] font-medium leading-[32px] text-brand [text-indent:25%] lg:text-[40px] lg:leading-[52px] lg:[text-indent:290px]">
                <?php echo e($intro); ?>

            </p>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($categories->isNotEmpty()): ?>
            <div class="mt-12 grid gap-x-10 gap-y-6 sm:grid-cols-2 sm:gap-y-12 2xl:mt-12">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal61971905252d51ef9320f6ccbc7aa747 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal61971905252d51ef9320f6ccbc7aa747 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.service-category-card','data' => ['category' => $category]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('service-category-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal61971905252d51ef9320f6ccbc7aa747)): ?>
<?php $attributes = $__attributesOriginal61971905252d51ef9320f6ccbc7aa747; ?>
<?php unset($__attributesOriginal61971905252d51ef9320f6ccbc7aa747); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal61971905252d51ef9320f6ccbc7aa747)): ?>
<?php $component = $__componentOriginal61971905252d51ef9320f6ccbc7aa747; ?>
<?php unset($__componentOriginal61971905252d51ef9320f6ccbc7aa747); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php else: ?>
            <div class="mt-12 rounded-[24px] bg-surface px-8 py-16 text-center">
                <p class="text-[20px] font-medium text-ink">Направления появятся в ближайшее время</p>
                <p class="mt-2 text-[15px] text-muted">Администраторы клиники скоро наполнят этот раздел.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </main>

    <?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/services.blade.php ENDPATH**/ ?>