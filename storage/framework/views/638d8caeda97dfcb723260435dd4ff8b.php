<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e($service->name); ?> — услуги в клинике «Арт-Медика».">
    <title><?php echo e($service->name); ?> — Арт-Медика</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-page font-onest text-body antialiased">
    <?php echo $__env->make('components.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="mx-auto w-full max-w-[1720px] px-4 pb-20 sm:px-6 md:px-10 2xl:px-0">
        
        <nav aria-label="Хлебные крошки" class="flex flex-wrap items-center gap-2 pt-6 text-[15px] text-brand sm:text-[18px]">
            <a href="<?php echo e(url('/')); ?>" rel="home" class="transition-colors duration-200 hover:text-brandh">Арт-Медика</a>
            <img src="<?php echo e(asset('images/_.svg')); ?>" alt="" class="h-3 w-auto" aria-hidden="true">
            <a href="<?php echo e(route('services')); ?>" class="whitespace-nowrap transition-colors duration-200 hover:text-brandh">Услуги</a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category): ?>
                <img src="<?php echo e(asset('images/_.svg')); ?>" alt="" class="h-3 w-auto shrink-0" aria-hidden="true">
                <a href="<?php echo e(route('services.show', $category->slug)); ?>" class="whitespace-nowrap transition-colors duration-200 hover:text-brandh"><?php echo e($category->name); ?></a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <img src="<?php echo e(asset('images/_.svg')); ?>" alt="" class="h-3 w-auto shrink-0" aria-hidden="true">
            <span class="font-medium text-brand"><?php echo e($service->name); ?></span>
        </nav>

        
        <div class="flex flex-col items-start justify-between gap-4 pt-8 lg:flex-row lg:items-start lg:gap-8 lg:pt-10 2xl:pt-[52px]">
            <h1 class="flex shrink-0 items-center gap-2 text-[20px] font-medium leading-[1.2] text-[#91B5D5] sm:text-[28px] lg:text-[40px]">
                <?php echo e($service->name); ?>

                <img src="<?php echo e(asset('images/Arrow_right_light.svg')); ?>" alt="" class="w-[30px] sm:w-[40px] lg:w-[50px]" aria-hidden="true">
            </h1>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->description): ?>
                <p class="max-w-[1140px] text-[20px] font-medium leading-[1.25] text-brand sm:text-[28px] lg:text-[40px] lg:leading-[1.2]">
                    <?php echo e($service->description); ?>

                </p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasFullContent): ?>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($service->problems) && is_array($service->problems)): ?>
                <section class="mt-14 sm:mt-18 lg:mt-24">
                    <h2 class="text-[40px] font-semibold text-ink sm:text-[32px] lg:text-[36px]">
                        Какие проблемы позволяет решить <?php echo e(mb_strtolower($service->name)); ?>

                    </h2>

                    <div class="mt-6 divide-y divide-border border-b border-border">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $service->problems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $problem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center gap-6 py-4 sm:gap-10 sm:py-5">
                                <span class="w-8 shrink-0 text-[18px] font-medium text-muted sm:text-[40px]">
                                    <?php echo e($idx + 1); ?>

                                </span>
                                <span class="text-[16px]  text-ink sm:text-[36px]">
                                    <?php echo e($problem); ?>

                                </span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </section>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php
                $typesCases = $service->cases->where('kind', 'type')->values();
            ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($typesCases->isNotEmpty()): ?>
                <section class="mt-14 sm:mt-18 lg:mt-24">
                    <h2 class="flex items-center gap-2 text-[20px] font-medium text-[#91B5D5] sm:text-[28px] lg:text-[36px]">
                        Виды блефаропластики
                        <img src="<?php echo e(asset('images/Arrow_right_light.svg')); ?>" alt="" class="w-[26px] sm:w-[36px]" aria-hidden="true">
                    </h2>

                    
                    <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-10">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $typesCases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $patient1Url = $type->media->firstWhere('collection', 'before')?->url;
                                $patient2Url = $type->media->firstWhere('collection', 'after')?->url;
                            ?>
                            <div class="flex flex-col">
                                <h3 class="min-h-[50px] text-[18px]  leading-snug text-ink sm:text-[22px] lg:text-[36px]">
                                    <?php echo e($type->title); ?> <?php echo e($type->description ? '— ' . mb_strtolower($type->description) : ''); ?>

                                </h3>

                                <div class="mt-4 grid grid-cols-2 gap-3 sm:gap-4">
                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($patient1Url): ?>
                                        <div class="relative overflow-hidden rounded-[16px] bg-hero">
                                            <img src="<?php echo e($patient1Url); ?>" alt="<?php echo e($type->title); ?>" loading="lazy" class="h-auto w-full object-cover">
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($patient2Url): ?>
                                        <div class="relative overflow-hidden rounded-[16px] bg-hero">
                                            <img src="<?php echo e($patient2Url); ?>" alt="<?php echo e($type->title); ?>" loading="lazy" class="h-auto w-full object-cover">
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </section>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->preparation): ?>
                <section class="mt-14 sm:mt-18 lg:mt-24">
                    <div class="flex flex-col items-start justify-between gap-4 lg:flex-row lg:gap-12">
                        <h2 class="flex shrink-0 items-center gap-2 text-[20px] font-medium text-[#91B5D5] sm:text-[28px] lg:text-[36px]">
                            Подготовка к операции
                            <img src="<?php echo e(asset('images/Arrow_right_light.svg')); ?>" alt="" class="w-[26px] sm:w-[36px]" aria-hidden="true">
                        </h2>
                        <p class="max-w-[1140px] text-[16px] font-medium leading-relaxed text-ink sm:text-[20px] lg:text-[36px]">
                            <?php echo e($service->preparation); ?>

                        </p>
                    </div>
                </section>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <section class="mt-14 sm:mt-18 lg:mt-24">
                <h2 class="text-[22px] font-semibold text-ink sm:text-[28px] lg:text-[32px]">
                    Почему выбирают специалистов «Арт-Медики»
                </h2>

                <div class="mt-6 grid grid-cols-2 gap-4 sm:gap-5 lg:grid-cols-4 lg:gap-6">
                    <div class="flex flex-col justify-between rounded-[20px] bg-surface p-5 sm:p-6 lg:min-h-[170px]">
                        <span class="text-[28px] font-bold text-ink sm:text-[36px] lg:text-[40px]">01</span>
                        <p class="mt-3 text-[14px] font-medium leading-snug text-ink sm:text-[16px]">Опытные пластические хирурги</p>
                    </div>

                    <div class="flex flex-col justify-between rounded-[20px] bg-surface p-5 sm:p-6 lg:min-h-[170px]">
                        <span class="text-[28px] font-bold text-ink sm:text-[36px] lg:text-[40px]">02</span>
                        <p class="mt-3 text-[14px] font-medium leading-snug text-ink sm:text-[16px]">Современное оборудование</p>
                    </div>

                    <div class="flex flex-col justify-between rounded-[20px] bg-surface p-5 sm:p-6 lg:min-h-[170px]">
                        <span class="text-[28px] font-bold text-ink sm:text-[36px] lg:text-[40px]">03</span>
                        <p class="mt-3 text-[14px] font-medium leading-snug text-ink sm:text-[16px]">Индивидуальный подход</p>
                    </div>

                    <div class="flex flex-col justify-between rounded-[20px] bg-surface p-5 sm:p-6 lg:min-h-[170px]">
                        <span class="text-[28px] font-bold text-ink sm:text-[36px] lg:text-[40px]">04</span>
                        <p class="mt-3 text-[14px] font-medium leading-snug text-ink sm:text-[16px]">Комфортные условия стационара</p>
                    </div>
                </div>
            </section>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->execution): ?>
                <section class="mt-14 sm:mt-18 lg:mt-24">
                    <div class="flex flex-col items-start justify-between gap-4 lg:flex-row lg:gap-12">
                        <h2 class="flex shrink-0 items-center gap-2 text-[20px] font-medium text-[#91B5D5] sm:text-[28px] lg:text-[36px]">
                            Способ выполнения <br> блефаропластики
                            <img src="<?php echo e(asset('images/Arrow_right_light.svg')); ?>" alt="" class="w-[26px] sm:w-[36px]" aria-hidden="true">
                        </h2>
                        <p class="max-w-[1140px] text-[16px] font-medium leading-relaxed text-ink sm:text-[20px] lg:text-[36px]">
                            <?php echo e($service->execution); ?>

                        </p>
                    </div>
                </section>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php
                $resultCases = $service->cases->where('kind', 'result')->values();
            ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($resultCases->isNotEmpty()): ?>
                <section class="mt-14 sm:mt-18 lg:mt-24">
                    <h2 class="text-[22px] font-semibold text-ink sm:text-[28px] lg:text-[32px]">
                        Результаты процедуры
                    </h2>

                    
                    <div class="mt-6 grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-4 lg:gap-5">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $resultCases->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $imageUrl = $case->media->first()?->url;
                            ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imageUrl): ?>
                                <div class="relative overflow-hidden rounded-[16px] bg-hero">
                                    <img src="<?php echo e($imageUrl); ?>" alt="Результат блефаропластики" loading="lazy" class="h-auto w-full object-cover">
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </section>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->experts->isNotEmpty()): ?>
                <section class="mt-14 sm:mt-18 lg:mt-24">
                    <h2 class="flex items-center gap-2 text-[20px] font-medium text-[#91B5D5] sm:text-[28px] lg:text-[36px]">
                        Врачи, проводящие процедуру
                        <img src="<?php echo e(asset('images/Arrow_right_light.svg')); ?>" alt="" class="w-[26px] sm:w-[36px]" aria-hidden="true">
                    </h2>

                    <div class="mt-6 flex flex-wrap gap-6">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $service->experts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $avatarUrl = $expert->avatarUrl();
                                $detailUrl = route('specialists.show', $expert->slug);
                            ?>
                            <article class="flex w-full max-w-[850px] flex-col rounded-[24px] bg-[#F3F4FB] p-5 sm:min-h-[557px] sm:flex-row sm:gap-6">
                                <a href="<?php echo e($detailUrl); ?>" class="relative block h-[320px] w-full shrink-0 overflow-hidden rounded-[16px] bg-hero sm:h-auto sm:w-[395px]">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($avatarUrl): ?>
                                        <img src="<?php echo e($avatarUrl); ?>" alt="<?php echo e($expert->name); ?>" loading="lazy"
                                             class="h-full w-full object-cover object-top transition-transform duration-500 hover:scale-105">
                                    <?php else: ?>
                                        <div class="grid h-full w-full place-items-center text-slate-400">
                                            <svg class="h-16 w-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </a>

                                <div class="mt-4 flex flex-1 flex-col justify-between sm:mt-0 sm:py-2">
                                    <div>
                                        <div class="flex items-center justify-between text-[16px] text-brand">
                                            <span>Руководство</span>
                                            <a href="<?php echo e($detailUrl); ?>" class="text-ink transition-transform duration-300 hover:translate-x-0.5 hover:-translate-y-0.5">
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M7 17L17 7H8.5M17 7v8.5"/>
                                                </svg>
                                            </a>
                                        </div>

                                        <h3 class="mt-4 text-[24px] font-semibold leading-tight text-ink sm:text-[32px] lg:text-[36px]">
                                            <a href="<?php echo e($detailUrl); ?>" class="transition-colors hover:text-brand">
                                                <?php echo e($expert->name); ?>

                                            </a>
                                        </h3>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($expert->position): ?>
                                            <p class="mt-4 text-[14px] leading-relaxed text-[#4A5568] sm:text-[16px]">
                                                <?php echo e($expert->position); ?>

                                            </p>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </section>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php else: ?>
            
            <div class="mt-12 rounded-[24px] bg-surface px-6 py-16 text-center lg:py-24">
                <div class="mx-auto max-w-[620px]">
                    <div class="mx-auto mb-6 grid h-16 w-16 place-items-center rounded-full bg-white text-brand shadow-sm sm:h-20 sm:w-20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 sm:h-10 sm:w-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h2 class="text-[24px] font-medium leading-tight text-ink sm:text-[32px] lg:text-[36px]">
                        Услуга в процессе наполнения
                    </h2>
                    <p class="mt-4 text-[16px] leading-relaxed text-muted sm:text-[20px]">
                        Мы пока не добавили детальное описание для услуги «<?php echo e($service->name); ?>». Все подробности о методике, показаниях и стоимости вы можете узнать на консультации у нашего специалиста.
                    </p>
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                        <a href="<?php echo e(route('services.show', $category?->slug ?? 'plastika-litsa')); ?>"
                           class="inline-flex items-center gap-2 rounded-full bg-brand px-7 py-3.5 text-[15px] font-semibold text-white transition-colors hover:bg-brandh">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                            </svg>
                            Вернуться к разделу «<?php echo e($category?->name ?? 'Пластика лица'); ?>»
                        </a>
                        <?php
                            $phone = \App\Models\Setting::get('contacts', [])['phone'] ?? '';
                            $phoneTel = preg_replace('/\D+/', '', $phone);
                        ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($phone): ?>
                            <a href="tel:<?php echo e($phoneTel); ?>"
                               class="inline-flex items-center gap-2 rounded-full border border-border bg-white px-7 py-3.5 text-[15px] font-semibold text-ink transition-colors hover:border-brand hover:text-brand">
                                Записаться по телефону
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
<?php /**PATH F:\xampp\htdocs\art-medic\art-medika\resources\views/service-detail.blade.php ENDPATH**/ ?>