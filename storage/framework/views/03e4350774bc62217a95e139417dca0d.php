<?php
    $seoTitle = $category->name . ' — Услуги клиники «Арт-Медика»';
    $seoDesc = $category->description ?: ($category->subtitle ?: ('Услуги направления «' . $category->name . '» в клинике «Арт-Медика» в Челябинске.'));
    $childNames = isset($groups) ? $groups->pluck('category.name')->filter()->implode(', ') : '';
    $seoKeywords = trim($category->name . ($childNames ? ', ' . $childNames : '') . ', услуги Арт-Медика, Челябинск', ', ');
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
        
        <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-6 text-[15px] text-brand sm:text-[18px]">
            <a href="<?php echo e(url('/')); ?>" rel="home" class="transition-colors duration-200 hover:text-brandh">Арт-Медика</a>
            <img src="<?php echo e(asset('images/_.svg')); ?>" width="7" height="10" alt="" class="h-3 w-auto" aria-hidden="true">
            <a href="<?php echo e(route('services')); ?>" class="whitespace-nowrap transition-colors duration-200 hover:text-brandh">Услуги</a>
            <img src="<?php echo e(asset('images/_.svg')); ?>" width="7" height="10" alt="" class="h-3 w-auto shrink-0" aria-hidden="true">
            <span class="font-medium text-brand"><?php echo e($category->name); ?></span>
        </nav>

        
        <div class="flex flex-col items-start justify-between gap-4 pt-8 lg:flex-row lg:items-start lg:gap-8 lg:pt-10 2xl:pt-[52px]">
            <h1 class="flex shrink-0 items-center gap-2 text-[20px] font-medium leading-[1.2] text-[#4A749B] sm:text-[28px] lg:text-[40px]">
                <?php echo e($category->name); ?>

                <img src="<?php echo e(asset('images/Arrow_right_light.svg')); ?>" width="50" height="50" alt="" class="w-[30px] sm:w-[38px] lg:w-[50px]" aria-hidden="true">
            </h1>
            <?php
                $introText = $category->description ?: 'Подбираем для вас самые актуальные и интересные проекты из нашей практики, медицины и эстетической хирургии, с заботой о вас.';
            ?>
            <p class="max-w-[1140px] text-[20px] font-medium leading-[1.25] text-brand sm:text-[28px] lg:text-[40px] lg:leading-[1.2]">
                <?php echo e($introText); ?>

            </p>
        </div>

        <?php
            // Дочерние подкатегории для карточек (исключаем техгруппу консультаций, если она есть)
            $subcategories = $category->children
                ->filter(fn ($c) => $c->is_active && $c->slug !== 'plasticheskaya-i-esteticheskaya-hirurgiya')
                ->values();
        ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subcategories->isNotEmpty()): ?>
            <div class="mt-8 flex flex-col gap-5 lg:mt-12">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $cover = $item->coverUrl();
                        // Заглушка ссылки или ссылка на конкретную услугу/поднаправление
                        $itemUrl = $item->slug ? url('/uslugi/' . $item->slug) : '#';
                    ?>

                    
                    <article class="group relative select-none cursor-pointer flex w-full flex-col justify-between gap-5 rounded-[24px] bg-surface p-5 border-[3px] border-transparent transition-all duration-300 hover:border-brand hover:shadow-lg sm:p-5 lg:min-h-[440px] lg:flex-row lg:items-stretch lg:gap-8">
                        
                        <a href="<?php echo e($itemUrl); ?>" class="absolute inset-0 z-10 rounded-[inherit] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2" aria-label="Открыть направление «<?php echo e($item->name); ?>»"></a>

                        
                        <div class="flex flex-col justify-between max-lg:gap-4 lg:w-[260px] lg:shrink-0 xl:w-[300px] pointer-events-none">
                            <h2 class="text-[20px] font-medium leading-tight text-ink transition-colors group-hover:text-brand sm:text-[26px] lg:text-[36px]">
                                <?php echo e($item->name); ?>

                            </h2>

                            <div class="hidden lg:block">
                                <span class="inline-flex items-center justify-center rounded-full bg-brand px-8 py-3.5 text-[16px] font-semibold text-white transition-all group-hover:bg-[#2A1A13] shadow-sm">
                                    Подробнее
                                </span>
                            </div>
                        </div>

                        
                        <div class="hidden flex-1 items-center justify-center px-4 lg:flex pointer-events-none">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->description): ?>
                                <p class="max-w-[460px] text-[20px] font-normal leading-relaxed text-ink">
                                    <?php echo e($item->description); ?>

                                </p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <div class="relative h-[200px] w-full shrink-0 overflow-hidden rounded-[10px] bg-hero sm:h-[260px] lg:h-auto lg:w-[480px] xl:w-[540px] 2xl:w-[560px] pointer-events-none">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cover): ?>
                                <img src="<?php echo e($cover); ?>" alt="<?php echo e($item->name); ?>" width="560" height="360" loading="lazy" decoding="async"
                                     class="h-full w-full rounded-[10px] object-cover transition-transform duration-500 group-hover:scale-105">
                            <?php else: ?>
                                <div class="grid h-full w-full place-items-center rounded-[10px] bg-[#E9ECF4]">
                                    <span class="font-serif text-[24px] italic font-semibold tracking-tight text-brand">Арт-Медика</span>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <div class="block lg:hidden pointer-events-none">
                            <span class="inline-flex w-full items-center justify-center rounded-full bg-brand px-6 py-3 text-[15px] font-semibold text-white transition-all group-hover:bg-[#2A1A13] shadow-sm">
                                Подробнее
                            </span>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php else: ?>
            <div class="mt-12 rounded-[24px] bg-surface px-8 py-16 text-center">
                <p class="text-[20px] font-medium text-ink">Список услуг появится в ближайшее время</p>
                <p class="mt-2 text-[15px] text-muted">Уточните детали по телефону <?php echo e(\App\Models\Setting::get('contacts', [])['phone'] ?? ''); ?>.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php
            $otherCategories = \App\Models\ServiceCategory::roots()
                ->where('id', '!=', $category->id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();
        ?>

     
    </main>

    <?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/services-show.blade.php ENDPATH**/ ?>