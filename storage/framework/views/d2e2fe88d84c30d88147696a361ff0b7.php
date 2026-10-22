<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проекты — Арт-Медика</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-page font-sans text-body antialiased">

<?php echo $__env->make('components.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<main class="mx-auto w-full max-w-[1720px] px-4 pb-16 sm:px-6 md:px-10 2xl:px-0">
    
    <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-6 text-[15px] text-body">
        <a href="<?php echo e(url('/')); ?>" class="transition-colors hover:text-brand">Арт-Медика</a>
        <img src="<?php echo e(asset('images/_.svg')); ?>" alt="" class="h-3 w-auto" aria-hidden="true">
        <span class="font-medium text-ink">Проекты</span>
    </nav>

    
    <div class="flex flex-col items-start justify-between gap-6 pt-10 lg:flex-row lg:items-start lg:gap-10 2xl:pt-[52px]">
        <h1 class="flex shrink-0 items-center gap-2 text-[28px] font-medium leading-none text-[#91B5D5] sm:text-[34px] lg:text-[40px]">
            Проекты
            <img src="<?php echo e(asset('images/Arrow_right_light.svg')); ?>" alt="" class="w-[30px] sm:w-[38px] lg:w-[50px]" aria-hidden="true">
        </h1>
        <p class="max-w-[1140px] text-[22px] font-medium leading-tight text-[#1D293D] sm:text-[28px] lg:text-[36px] 2xl:text-[40px]">
            Подбираем для вас самые актуальные
            и интересные проекты из нашей практики, медицины
            и эстетической хирургии, с заботой о вас
        </p>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($projects->isNotEmpty()): ?>
        <div class="mt-10 space-y-5 2xl:mt-12 2xl:space-y-6">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginaldbcceabf4a99a34f9999233ae1fef693 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbcceabf4a99a34f9999233ae1fef693 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.project-card','data' => ['project' => $project]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('project-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['project' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($project)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldbcceabf4a99a34f9999233ae1fef693)): ?>
<?php $attributes = $__attributesOriginaldbcceabf4a99a34f9999233ae1fef693; ?>
<?php unset($__attributesOriginaldbcceabf4a99a34f9999233ae1fef693); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldbcceabf4a99a34f9999233ae1fef693)): ?>
<?php $component = $__componentOriginaldbcceabf4a99a34f9999233ae1fef693; ?>
<?php unset($__componentOriginaldbcceabf4a99a34f9999233ae1fef693); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php else: ?>
        <div class="mt-10 rounded-[24px] bg-surface px-8 py-16 text-center">
            <p class="text-[20px] font-medium text-ink">Активных проектов пока нет</p>
            <p class="mt-2 text-[15px] text-muted">Заглядывайте позже — мы регулярно добавляем новые проекты.</p>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</main>

<?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH F:\xampp\htdocs\art-medic\art-medika\resources\views/projects.blade.php ENDPATH**/ ?>