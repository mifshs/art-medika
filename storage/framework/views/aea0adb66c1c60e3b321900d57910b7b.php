<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($project->detail_title); ?> — Проекты — Медико-косметологический центр «Арт-Медика»</title>
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
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
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
    
    <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-5 text-[15px] sm:pt-6 sm:text-[16px] 2xl:text-[18px] text-brand">
        <a href="<?php echo e(url('/')); ?>" class="hidden sm:inline transition-colors duration-200 hover:text-brandh">Арт-Медика</a>
        <img src="<?php echo e(asset('images/_.svg')); ?>" alt="" class="hidden sm:inline h-3 w-auto" aria-hidden="true">
        <a href="<?php echo e(route('projects')); ?>" class="transition-colors duration-200 hover:text-brandh">Проекты</a>
        <img src="<?php echo e(asset('images/_.svg')); ?>" alt="" class="h-3 w-auto" aria-hidden="true">
        <span class="font-medium truncate max-w-[240px] sm:max-w-none"><?php echo e($project->detail_title); ?></span>
    </nav>

    
    <div class="mt-6 flex flex-col gap-1 sm:mt-8 sm:flex-row sm:items-baseline sm:justify-between sm:gap-6 lg:mt-10">
        <h1 class="text-[26px] font-medium leading-tight text-[#1D293D] sm:text-[32px] lg:text-[40px] tracking-tight">
            <?php echo e($project->detail_title); ?>

        </h1>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->subtitle): ?>
            <p class="text-[16px] font-normal text-[#91B5D5] sm:text-[20px] lg:text-[24px] sm:text-right shrink-0">
                <?php echo e($project->subtitle); ?>

            </p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <?php
        $heroCover = $project->coverUrl() ?: asset('images/placeholder.jpg');
    ?>
    <div class="mt-6 overflow-hidden rounded-[16px] sm:mt-8 sm:rounded-[20px] lg:rounded-[24px]">
        <img src="<?php echo e($heroCover); ?>"
             alt="<?php echo e($project->title); ?>"
             width="1720"
             height="640"
             class="h-[220px] w-full object-cover sm:h-[360px] md:h-[440px] lg:h-[540px] 2xl:h-[600px]">
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->hasFullContent()): ?>
        
        <section class="mt-10 sm:mt-12 lg:mt-16">
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-[280px_1fr_1fr] lg:gap-12 2xl:grid-cols-[340px_1fr_1fr] 2xl:gap-16">
                <div>
                    <h2 class="text-[22px] font-semibold text-[#1D293D] sm:text-[26px] lg:text-[32px]">
                        Описание проекта
                    </h2>
                </div>
                <div>
                    <p class="text-[15px] font-normal leading-[1.6] text-body sm:text-[16px] lg:text-[18px]">
                        <?php echo e($project->description ?: $project->excerpt); ?>

                    </p>
                </div>
                <div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->mission): ?>
                        <p class="text-[15px] font-normal leading-[1.6] text-body sm:text-[16px] lg:text-[18px]">
                            <?php echo e($project->mission); ?>

                        </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </section>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($project->stats) && is_array($project->stats)): ?>
            <section class="mt-8 sm:mt-10 lg:mt-14" aria-label="Статистика проекта">
                <div class="grid grid-cols-2 gap-3 sm:gap-4 md:grid-cols-4 lg:gap-5 2xl:gap-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $project->stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="rounded-[16px] bg-[#F4F7FF] p-4 sm:rounded-[20px] sm:p-5 lg:rounded-[24px] lg:p-7">
                            <div class="text-[26px] font-semibold leading-none text-[#1D293D] sm:text-[32px] lg:text-[40px]">
                                <?php echo e($stat['value'] ?? ''); ?>

                            </div>
                            <div class="mt-2 text-[14px] font-normal text-[#1D293D] sm:mt-3 sm:text-[15px] lg:text-[17px] 2xl:text-[18px]">
                                <?php echo e($stat['label'] ?? ''); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->formats->isNotEmpty()): ?>
            <section class="mt-12 sm:mt-16 lg:mt-24" aria-labelledby="formats-heading">
                <div class="flex items-center justify-between">
                    <h2 id="formats-heading" class="text-[22px] font-semibold text-[#1D293D] sm:text-[26px] lg:text-[32px]">
                        Форматы работы
                    </h2>
                    <button type="button"
                            id="formats-scroll-btn"
                            aria-label="Прокрутить форматы"
                            class="grid h-10 w-10 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:opacity-90 sm:h-11 sm:w-11">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>

                
                <div id="formats-container"
                     class="mt-6 flex gap-4 overflow-x-auto pb-4 scrollbar-none snap-x sm:mt-8 md:grid md:grid-cols-3 md:gap-5 md:overflow-visible md:pb-0 lg:gap-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $project->formats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $format): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $formatCover = $format->coverUrl();
                        ?>
                        <article class="relative h-[420px] w-[82vw] shrink-0 snap-start overflow-hidden rounded-[20px] sm:h-[480px] md:h-[480px] md:w-auto lg:h-[520px] lg:rounded-[24px] 2xl:h-[560px] group">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($formatCover): ?>
                                <img src="<?php echo e($formatCover); ?>"
                                     alt="<?php echo e($format->title); ?>"
                                     loading="lazy"
                                     class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <?php else: ?>
                                <div class="h-full w-full bg-slate-800"></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-transparent"></div>

                            
                            <div class="absolute inset-x-0 bottom-0 p-5 sm:p-6 lg:p-7 text-white">
                                <h3 class="text-[18px] font-semibold leading-tight text-white sm:text-[20px] lg:text-[22px]">
                                    <?php echo e($format->title); ?>

                                </h3>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($format->description): ?>
                                    <p class="mt-2.5 text-[13px] font-normal leading-relaxed text-white/90 sm:text-[14px] lg:text-[15px]">
                                        <?php echo e($format->description); ?>

                                    </p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->stages->isNotEmpty()): ?>
            <section class="mt-12 sm:mt-16 lg:mt-24" aria-labelledby="stages-heading">
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-[280px_1fr] lg:gap-12 2xl:grid-cols-[340px_1fr] 2xl:gap-16">
                    <div>
                        <h2 id="stages-heading" class="text-[22px] font-semibold text-[#1D293D] sm:text-[26px] lg:text-[32px]">
                            Этапы проекта
                        </h2>
                    </div>
                    <ol class="space-y-4 sm:space-y-5 lg:space-y-6">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $project->stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="flex items-baseline gap-6 sm:gap-10 lg:gap-14 text-[16px] text-[#1D293D] sm:text-[18px] lg:text-[20px]">
                                <span class="w-6 shrink-0 font-normal text-[#1D293D] sm:w-8">
                                    <?php echo e($stage->sort_order ?? ($index + 1)); ?>

                                </span>
                                <span class="font-normal text-[#1D293D]">
                                    <?php echo e($stage->title); ?>

                                </span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </ol>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($gallery->isNotEmpty()): ?>
            <section class="mt-12 sm:mt-16 lg:mt-24" aria-labelledby="photos-heading">
                <div class="flex items-center justify-between">
                    <h2 id="photos-heading" class="text-[22px] font-semibold text-[#1D293D] sm:text-[26px] lg:text-[32px]">
                        Фотографии
                    </h2>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($gallery->count() > 1): ?>
                        <div class="flex items-center gap-2">
                            <button type="button" id="photos-prev" aria-label="Предыдущее фото"
                                    class="grid h-10 w-10 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:opacity-90 sm:h-11 sm:w-11">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button type="button" id="photos-next" aria-label="Следующее фото"
                                    class="grid h-10 w-10 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:opacity-90 sm:h-11 sm:w-11">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div class="relative mt-6 sm:mt-8">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($gallery->count() > 1): ?>
                        <div id="project-photos-slider"
                             class="swiper overflow-hidden rounded-[16px] sm:rounded-[20px] lg:rounded-[24px]"
                             data-swiper='{"slidesPerView": 1, "spaceBetween": 16, "navigation": {"prevEl": "#photos-prev", "nextEl": "#photos-next"}}'>
                            <div class="swiper-wrapper">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="swiper-slide overflow-hidden rounded-[16px] sm:rounded-[20px] lg:rounded-[24px]">
                                        <img src="<?php echo e($photo->url); ?>"
                                             alt="<?php echo e($photo->alt ?? 'Фото проекта'); ?>"
                                             loading="lazy"
                                             class="h-[240px] w-full object-cover sm:h-[380px] lg:h-[520px] 2xl:h-[580px]">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php $singlePhoto = $gallery->first(); ?>
                        <div class="overflow-hidden rounded-[16px] sm:rounded-[20px] lg:rounded-[24px]">
                            <img src="<?php echo e($singlePhoto->url); ?>"
                                 alt="<?php echo e($singlePhoto->alt ?? 'Фото проекта'); ?>"
                                 loading="lazy"
                                 class="h-[240px] w-full object-cover sm:h-[380px] lg:h-[520px] 2xl:h-[580px]">
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($partners->isNotEmpty()): ?>
            <section class="mt-12 sm:mt-16 lg:mt-24" aria-labelledby="partners-heading">
                <h2 id="partners-heading" class="text-[22px] font-semibold text-[#1D293D] sm:text-[26px] lg:text-[32px]">
                    Партнеры
                </h2>

                
                <div class="mt-6 hidden md:block">
                    <div class="divide-y divide-[#E5E9F2] border-b border-[#E5E9F2]">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center justify-between py-4 lg:py-5">
                                <span class="text-[18px] font-medium text-[#1D293D] lg:text-[20px]">
                                    <?php echo e($partner->name); ?>

                                </span>
                                <span class="text-[16px] font-normal text-[#1D293D] lg:text-[18px]">
                                    <?php echo e($partner->role); ?>

                                </span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                
                <div class="mt-4 block md:hidden">
                    <div class="divide-y divide-[#E5E9F2] border-b border-[#E5E9F2]">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="py-4">
                                <div class="text-[16px] font-medium text-[#1D293D]">
                                    <?php echo e($partner->name); ?>

                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($partner->role): ?>
                                    <div class="mt-2">
                                        <span class="inline-block rounded-[10px] bg-[#F4F7FF] px-3.5 py-1.5 text-[14px] font-normal text-body">
                                            <?php echo e($partner->role); ?>

                                        </span>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                
                <nav aria-label="Пагинация партнеров" class="mt-8 flex items-center gap-2 sm:mt-10 lg:mt-12">
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($partners->onFirstPage()): ?>
                        <span class="grid h-10 w-10 place-items-center rounded-[8px] bg-brand text-white opacity-40 cursor-not-allowed sm:h-11 sm:w-11" aria-disabled="true">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </span>
                    <?php else: ?>
                        <a href="<?php echo e($partners->previousPageUrl()); ?>"
                           class="grid h-10 w-10 place-items-center rounded-[8px] bg-brand text-white transition-opacity hover:opacity-90 sm:h-11 sm:w-11"
                           aria-label="Предыдущая страница">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php
                        $currentPage = $partners->currentPage();
                        $lastPage = max($partners->lastPage(), 5);
                    ?>

                    
                    <a href="<?php echo e($partners->url(1)); ?>"
                       class="grid h-10 w-10 place-items-center rounded-[8px] text-[15px] font-medium transition-colors sm:h-11 sm:w-11 sm:text-[16px] <?php echo e($currentPage === 1 ? 'bg-white border border-[#CBD5E1] text-[#1D293D] font-semibold shadow-sm' : 'bg-[#F4F7FF] text-[#1D293D] hover:bg-[#E9ECF4]'); ?>">
                        1
                    </a>

                    
                    <a href="<?php echo e($partners->url(2)); ?>"
                       class="grid h-10 w-10 place-items-center rounded-[8px] text-[15px] font-medium transition-colors sm:h-11 sm:w-11 sm:text-[16px] <?php echo e($currentPage === 2 ? 'bg-white border border-[#CBD5E1] text-[#1D293D] font-semibold shadow-sm' : 'bg-[#F4F7FF] text-[#1D293D] hover:bg-[#E9ECF4]'); ?>">
                        2
                    </a>

                    
                    <span class="grid h-10 w-8 place-items-center text-[15px] text-[#1D293D] sm:h-11 sm:text-[16px]">
                        ...
                    </span>

                    
                    <a href="<?php echo e($partners->url($lastPage)); ?>"
                       class="grid h-10 w-10 place-items-center rounded-[8px] text-[15px] font-medium transition-colors sm:h-11 sm:w-11 sm:text-[16px] <?php echo e($currentPage === $lastPage ? 'bg-white border border-[#CBD5E1] text-[#1D293D] font-semibold shadow-sm' : 'bg-[#F4F7FF] text-[#1D293D] hover:bg-[#E9ECF4]'); ?>">
                        <?php echo e($lastPage); ?>

                    </a>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($partners->hasMorePages() || $currentPage < $lastPage): ?>
                        <a href="<?php echo e($partners->nextPageUrl() ?: $partners->url(min($currentPage + 1, $lastPage))); ?>"
                           class="grid h-10 w-10 place-items-center rounded-[8px] bg-brand text-white transition-opacity hover:opacity-90 sm:h-11 sm:w-11"
                           aria-label="Следующая страница">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    <?php else: ?>
                        <span class="grid h-10 w-10 place-items-center rounded-[8px] bg-brand text-white opacity-40 cursor-not-allowed sm:h-11 sm:w-11" aria-disabled="true">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </nav>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php else: ?>
        
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->excerpt): ?>
            <div class="mt-8 max-w-[1140px] text-[16px] font-normal leading-relaxed text-body sm:text-[18px] lg:text-[20px]">
                <?php echo e($project->excerpt); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="mt-10 rounded-[20px] bg-[#F4F7FF] px-6 py-14 text-center sm:rounded-[24px] sm:px-8 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-[620px]">
                <div class="mx-auto mb-6 grid h-16 w-16 place-items-center rounded-full bg-white text-brand shadow-sm sm:h-20 sm:w-20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 sm:h-10 sm:w-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <h2 class="text-[22px] font-semibold leading-tight text-ink sm:text-[28px] lg:text-[34px]">
                    Проект в процессе наполнения
                </h2>
                <p class="mt-4 text-[15px] leading-relaxed text-body sm:text-[17px]">
                    Мы активно готовим подробные материалы, информацию о форматах участия, этапах и партнерах данного проекта.
                </p>
                <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="<?php echo e(url('/stock')); ?>" class="inline-flex h-12 items-center justify-center rounded-full bg-brand px-8 text-[16px] font-semibold text-white transition-colors hover:bg-brandh">
                        Записаться на консультацию
                    </a>
                    <a href="<?php echo e(route('projects')); ?>" class="inline-flex h-12 items-center justify-center rounded-full border border-border bg-white px-8 text-[16px] font-semibold text-ink transition-colors hover:bg-slate-50">
                        Все проекты
                    </a>
                </div>
            </div>
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
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
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
        var scrollBtn = document.getElementById('formats-scroll-btn');
        var container = document.getElementById('formats-container');
        if (scrollBtn && container) {
            scrollBtn.addEventListener('click', function () {
                var scrollAmount = container.clientWidth * 0.8;
                if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                    container.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                }
            });
        }
    });
</script>

</body>
</html>
<?php /**PATH F:\xampp\htdocs\art-medic\art-medika\resources\views/projects-show.blade.php ENDPATH**/ ?>