<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Документы — Медико-косметологический центр «Арт-Медика»</title>
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

<main class="mx-auto w-full max-w-[1720px] px-4 pb-16 sm:px-6 md:px-10 lg:pb-24 2xl:px-0">
    
    <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-5 text-[15px] text-brand sm:pt-6 sm:text-[16px] 2xl:text-[18px]">
        <a href="<?php echo e(url('/')); ?>" class="transition-colors duration-200 hover:text-brandh">Арт-Медика</a>
        <img src="<?php echo e(asset('images/_.svg')); ?>" alt="" class="h-3 w-auto" aria-hidden="true">
        <span class="font-medium">Документы</span>
    </nav>

    
    <div class="mt-7 sm:mt-8 lg:mt-12">
        <h1 class="inline-flex items-baseline gap-2 text-[24px] font-medium text-[#91B5D5] sm:text-[28px] lg:text-[32px] 2xl:text-[40px]">
            Документы
            <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M7 17L17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </h1>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($documentsGrouped->isNotEmpty()): ?>
        <div class="mt-8 space-y-4 sm:mt-10 sm:space-y-5 lg:mt-12 lg:space-y-6">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $documentsGrouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryName => $docs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    // По макету категория «Нормативно-правовые документы» раскрыта по умолчанию, остальные свернуты
                    $isOpen = (mb_stripos($categoryName, 'Нормативно-правовые') !== false) || ($loop->count === 1);
                ?>

                <div x-data="{ open: <?php echo json_encode($isOpen, 15, 512) ?> }"
                     class="rounded-[16px] bg-[#F4F7FD] transition-all duration-300 sm:rounded-[20px] 2xl:rounded-[24px]">
                    
                    <button type="button"
                            @click="open = !open"
                            :aria-expanded="open"
                            class="flex w-full cursor-pointer items-center justify-between gap-4 px-5 py-4 text-left transition-colors hover:text-brand sm:px-8 sm:py-6 2xl:px-10 2xl:py-7">
                        <span class="text-[17px] font-semibold leading-tight text-body sm:text-[20px] lg:text-[22px] 2xl:text-[26px]">
                            <?php echo e($categoryName); ?>

                        </span>

                        
                        <span class="inline-flex h-7 w-7 shrink-0 items-center justify-center text-[#1A1A1A] transition-transform duration-300"
                              :class="{ 'rotate-180': open }">
                            <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 5v14M19 12l-7 7-7-7"/>
                            </svg>
                        </span>
                    </button>

                    
                    <div x-show="open" x-collapse x-cloak>
                        <div class="px-5 pb-5 pt-1 sm:px-8 sm:pb-7 2xl:px-10 2xl:pb-8">
                            <div class="divide-y divide-[#E4E7EE]/60">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if (isset($component)) { $__componentOriginala4e06535fce6854c1b8b975cf6477dd4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala4e06535fce6854c1b8b975cf6477dd4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.document-item','data' => ['document' => $doc]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('document-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['document' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($doc)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala4e06535fce6854c1b8b975cf6477dd4)): ?>
<?php $attributes = $__attributesOriginala4e06535fce6854c1b8b975cf6477dd4; ?>
<?php unset($__attributesOriginala4e06535fce6854c1b8b975cf6477dd4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala4e06535fce6854c1b8b975cf6477dd4)): ?>
<?php $component = $__componentOriginala4e06535fce6854c1b8b975cf6477dd4; ?>
<?php unset($__componentOriginala4e06535fce6854c1b8b975cf6477dd4); ?>
<?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php else: ?>
        
        <div class="mt-12 rounded-[20px] bg-[#F4F7FD] px-8 py-16 text-center">
            <p class="text-[20px] font-medium text-ink">Документы пока не опубликованы</p>
            <p class="mt-2 text-[15px] text-muted">Заглядывайте позже — мы регулярно обновляем документацию клиники.</p>
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
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/documents.blade.php ENDPATH**/ ?>