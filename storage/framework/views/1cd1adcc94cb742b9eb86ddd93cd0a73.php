<?php
    $parentName = $category->parent?->name ?? 'Услуги';
    $seoTitle = $category->name . ' — ' . $parentName . ' — Арт-Медика';
    $seoDesc = $category->description ?: ('Процедуры и операции группы «' . $category->name . '» (' . $parentName . ') в клинике «Арт-Медика» в Челябинске.');
    $serviceNames = $services->take(8)->pluck('name')->implode(', ');
    $seoKeywords = trim($category->name . ', ' . $parentName . ($serviceNames ? ', ' . $serviceNames : '') . ', Арт-Медика', ', ');
    $seoImage = $category->coverUrl();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php if (isset($component)) { $__componentOriginal4232ba5ed77147a6b6573253fafb715d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4232ba5ed77147a6b6573253fafb715d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-head','data' => ['title' => $seoTitle,'description' => $seoDesc,'keywords' => $seoKeywords,'ogImage' => $seoImage]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoTitle),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoDesc),'keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoKeywords),'ogImage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoImage)]); ?>
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
        
        <nav aria-label="Хлебные крошки" class="flex flex-wrap items-center gap-2 pt-6 text-[15px] text-brand sm:text-[18px]">
            <a href="<?php echo e(url('/')); ?>" rel="home" class="transition-colors duration-200 hover:text-brandh">Арт-Медика</a>
            <img src="<?php echo e(asset('images/_.svg')); ?>" width="7" height="10" alt="" class="h-3 w-auto" aria-hidden="true">
            <a href="<?php echo e(route('services')); ?>" class="whitespace-nowrap transition-colors duration-200 hover:text-brandh">Услуги</a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category->parent): ?>
                <img src="<?php echo e(asset('images/_.svg')); ?>" width="7" height="10" alt="" class="h-3 w-auto shrink-0" aria-hidden="true">
                <a href="<?php echo e(route('services.show', $category->parent->slug)); ?>" class="whitespace-nowrap transition-colors duration-200 hover:text-brandh"><?php echo e($category->parent->name); ?></a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <img src="<?php echo e(asset('images/_.svg')); ?>" width="7" height="10" alt="" class="h-3 w-auto shrink-0" aria-hidden="true">
            <span class="font-medium text-brand"><?php echo e($category->name); ?></span>
        </nav>

        
        <div class="pt-8 lg:pt-10 2xl:pt-[52px]">
            <h1 class="flex items-center gap-2 text-[24px] font-medium leading-none text-[#4A749B] sm:text-[32px] lg:text-[40px]">
                <?php echo e($category->name); ?>

                <img src="<?php echo e(asset('images/Arrow_right_light.svg')); ?>" width="50" height="50" alt="" class="w-[32px] sm:w-[40px] lg:w-[50px]" aria-hidden="true">
            </h1>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($services->isNotEmpty()): ?>
            
            <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 lg:mt-12">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('services.show', $service->slug)); ?>"
                       class="group flex h-[180px] w-full items-center justify-center rounded-[24px] bg-surface px-6 text-center transition-all duration-200 hover:bg-[#E9ECF8] hover:shadow-md sm:h-[210px] lg:h-[244px] lg:max-w-[559px]">
                        <span class="text-[24px] font-medium leading-snug text-ink transition-colors group-hover:text-brand sm:text-[30px] lg:text-[40px]">
                            <?php echo e($service->name); ?>

                        </span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php else: ?>
            
            <div class="mt-8 rounded-[24px] bg-surface px-6 py-16 text-center lg:mt-12 lg:py-24">
                <div class="mx-auto max-w-[620px]">
                    <div class="mx-auto mb-6 grid h-16 w-16 place-items-center rounded-full bg-white text-brand shadow-sm sm:h-20 sm:w-20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 sm:h-10 sm:w-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h2 class="text-[24px] font-medium leading-tight text-ink sm:text-[32px] lg:text-[36px]">
                        Раздел в процессе наполнения
                    </h2>
                    <p class="mt-4 text-[16px] leading-relaxed text-muted sm:text-[20px]">
                        Мы пока не добавили список услуг для данного раздела. Вся подробная информация, стоимость и консультации уже доступны у администраторов клиники.
                    </p>
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                        <a href="<?php echo e(route('services.show', $category->parent?->slug ?? 'plasticheskaya-hirurgiya')); ?>"
                           class="inline-flex items-center gap-2 rounded-full bg-brand px-7 py-3.5 text-[15px] font-semibold text-white transition-colors hover:bg-brandh">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                            </svg>
                            Вернуться назад
                        </a>
                        <?php
                            $phone = \App\Models\Setting::get('contacts', [])['phone'] ?? '';
                            $phoneTel = preg_replace('/\D+/', '', $phone);
                        ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($phone): ?>
                            <a href="tel:<?php echo e($phoneTel); ?>"
                               class="inline-flex items-center gap-2 rounded-full border border-border bg-white px-7 py-3.5 text-[15px] font-semibold text-ink transition-colors hover:border-brand hover:text-brand">
                                Позвонить в клинику
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

   
    </main>

    <?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/service-subgroup.blade.php ENDPATH**/ ?>