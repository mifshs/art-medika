<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($expert->name); ?> — Медико-косметологический центр «Арт-Медика»</title>
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
        <a href="<?php echo e(route('specialists')); ?>" class="transition-colors duration-200 hover:text-brandh">Специалисты</a>
        <img src="<?php echo e(asset('images/_.svg')); ?>" alt="" class="h-3 w-auto" aria-hidden="true">
        <span class="font-medium text-ink line-clamp-1 max-w-[280px] sm:max-w-md lg:max-w-xl">
            <?php echo e($expert->name); ?>

        </span>
    </nav>

    
    <div class="mt-7 sm:mt-8 lg:mt-12">
        <div class="grid gap-3 lg:grid-cols-[1fr_2fr] lg:gap-10 items-start">
            <div>
                <a href="<?php echo e(route('specialists')); ?>" class="inline-flex items-baseline gap-2 text-[24px] font-medium text-[#91B5D5] transition-colors hover:text-brand sm:text-[28px] lg:text-[32px] 2xl:text-[40px]">
                    Специалисты
                    <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 17L17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <h1 class="text-[24px] font-medium leading-[1.25] text-brand sm:text-[28px] lg:text-[32px] 2xl:text-[40px]">
                <?php echo e($expert->name); ?>

            </h1>
        </div>
    </div>

    
    <?php
        $avatarUrl = $expert->avatarUrl();
        $yearsText = $expert->experience_since ? 'с ' . $expert->experience_since . ' года' : 'с 2002 года';
        $opsCount = $expert->operations_count ?? 34;
        $positivePercent = $expert->positive_percent ? $expert->positive_percent . '%' : '90%';
    ?>

    <div class="mt-7 grid grid-cols-1 gap-6 sm:mt-8 sm:gap-8 lg:mt-10 lg:grid-cols-[340px_1fr] 2xl:grid-cols-[400px_1fr] lg:gap-10 2xl:gap-14 items-start">
        
        <div>
            <div class="overflow-hidden rounded-[20px] sm:rounded-[24px]">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($avatarUrl): ?>
                    <img src="<?php echo e($avatarUrl); ?>" alt="<?php echo e($expert->name); ?>" loading="lazy"
                         class="aspect-[4/5] w-full object-cover object-top">
                <?php else: ?>
                    <div class="flex aspect-[4/5] w-full items-center justify-center bg-slate-200 text-slate-400">
                        <svg class="h-20 w-20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="mt-4 sm:mt-5">
                <a href="/stock" class="flex w-full items-center justify-center rounded-full bg-brand py-3.5 text-center text-[15px] font-semibold text-white shadow-sm transition-colors hover:bg-brandh sm:py-4">
                    Записаться на приём
                </a>
            </div>
        </div>

        
        <div class="flex flex-col justify-between">
            
            <div class="text-[14px] leading-relaxed text-body sm:text-[15px] lg:text-[16px] 2xl:text-[17px]">
                <p><?php echo e($expert->position); ?></p>
            </div>

            
            <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-3 sm:gap-4 lg:mt-8 2xl:gap-5">
                
                <div class="flex flex-col justify-between rounded-[16px] bg-[#F4F7FD] p-4 2xl:p-5">
                    <span class="text-[22px] font-medium leading-none text-brand sm:text-[24px] 2xl:text-[30px]">
                        <?php echo e($yearsText); ?>

                    </span>
                    <span class="mt-2 text-[12px] font-normal text-[#7E93AC] 2xl:text-[13px]">
                        Стаж
                    </span>
                </div>

                
                <div class="flex flex-col justify-between rounded-[16px] bg-[#F4F7FD] p-4 2xl:p-5">
                    <span class="text-[22px] font-medium leading-none text-brand sm:text-[24px] 2xl:text-[30px]">
                        <?php echo e($opsCount); ?>

                    </span>
                    <span class="mt-2 text-[11px] leading-snug text-[#7E93AC] 2xl:text-[12px]">
                        стажа работы в нашей клинике
                    </span>
                </div>

                
                <div class="flex flex-col justify-between rounded-[16px] bg-[#F4F7FD] p-4 2xl:p-5">
                    <span class="text-[22px] font-medium leading-none text-brand sm:text-[24px] 2xl:text-[30px]">
                        <?php echo e($positivePercent); ?>

                    </span>
                    <span class="mt-2 text-[11px] leading-snug text-[#7E93AC] 2xl:text-[12px]">
                        положительных отзывов
                    </span>
                </div>
            </div>
        </div>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($expert->activities) && is_array($expert->activities)): ?>
        <div class="mt-10 rounded-[20px] bg-[#F4F7FD] p-5 sm:p-7 2xl:p-8">
            <h2 class="text-[18px] font-semibold text-brand sm:text-[20px] 2xl:text-[22px]">
                Направление деятельности:
            </h2>
            <div class="mt-4 grid grid-cols-1 gap-x-8 gap-y-3.5 md:grid-cols-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $expert->activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-start gap-2.5 text-[13px] leading-snug text-body sm:text-[14px]">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#7E93AC]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M7 17L17 7M17 7H8.5M17 7v8.5"/>
                        </svg>
                        <span><?php echo e($activity); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($expert->educations->isNotEmpty()): ?>
        <div x-data="{ open: true }" class="mt-6 rounded-[20px] bg-[#F4F7FD] p-5 transition-colors sm:p-7 2xl:p-8">
            <button type="button" @click="open = !open" :aria-expanded="open" class="flex w-full items-center justify-between text-left">
                <span class="text-[16px] font-semibold text-brand sm:text-[19px] 2xl:text-[20px]">
                    Данные об образовании из Федерального реестра медицинских работников
                </span>
                <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center text-brand transition-transform duration-300"
                      :class="{ 'rotate-180': !open }">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 19V5M5 12l7-7 7 7"/>
                    </svg>
                </span>
            </button>

            <div x-show="open" x-collapse x-cloak>
                <div class="mt-5 overflow-x-auto no-scrollbar">
                    <table class="w-full min-w-[700px] border-collapse text-left text-[12px] sm:text-[13px] 2xl:text-[14px]">
                        <thead>
                            <tr class="border-b border-[#E4E7EE] text-[12px] font-medium text-body sm:text-[13px]">
                                <th class="pb-3 pr-4 font-semibold">Уровень образования</th>
                                <th class="pb-3 pr-4 font-semibold">Образовательная организация</th>
                                <th class="pb-3 pr-4 font-semibold">Год выдачи</th>
                                <th class="pb-3 font-semibold">Квалификация, специальность</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E4E7EE]/60 text-body">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $expert->educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="py-3 pr-4 align-top font-medium"><?php echo e($edu->level); ?></td>
                                    <td class="py-3 pr-4 align-top text-[#4A5568]"><?php echo e($edu->organization); ?></td>
                                    <td class="py-3 pr-4 align-top whitespace-nowrap"><?php echo e($edu->issued_year); ?></td>
                                    <td class="py-3 align-top"><?php echo e($edu->qualification); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($expert->accreditations->isNotEmpty()): ?>
        <div x-data="{ open: true }" class="mt-6 rounded-[20px] bg-[#F4F7FD] p-5 transition-colors sm:p-7 2xl:p-8">
            <button type="button" @click="open = !open" :aria-expanded="open" class="flex w-full items-center justify-between text-left">
                <span class="text-[16px] font-semibold text-brand sm:text-[19px] 2xl:text-[20px]">
                    Аккредитация (сертификация) специалиста
                </span>
                <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center text-brand transition-transform duration-300"
                      :class="{ 'rotate-180': !open }">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 19V5M5 12l7-7 7 7"/>
                    </svg>
                </span>
            </button>

            <div x-show="open" x-collapse x-cloak>
                <div class="mt-5 overflow-x-auto no-scrollbar">
                    <table class="w-full min-w-[800px] border-collapse text-left text-[12px] sm:text-[13px] 2xl:text-[14px]">
                        <thead>
                            <tr class="border-b border-[#E4E7EE] text-[12px] font-medium text-body sm:text-[13px]">
                                <th class="pb-3 pr-4 font-semibold">Тип документа</th>
                                <th class="pb-3 pr-4 font-semibold">Специальность</th>
                                <th class="pb-3 pr-4 font-semibold">Должность</th>
                                <th class="pb-3 pr-4 font-semibold whitespace-nowrap">Дата выдачи</th>
                                <th class="pb-3 pr-4 font-semibold whitespace-nowrap">Срок действия</th>
                                <th class="pb-3 font-semibold">Примечание</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E4E7EE]/60 text-body">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $expert->accreditations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="py-3 pr-4 align-top font-medium"><?php echo e($acc->doc_type); ?></td>
                                    <td class="py-3 pr-4 align-top"><?php echo e($acc->specialty); ?></td>
                                    <td class="py-3 pr-4 align-top text-[#4A5568]"><?php echo e($acc->position); ?></td>
                                    <td class="py-3 pr-4 align-top whitespace-nowrap"><?php echo e($acc->issued_at ? $acc->issued_at->format('d.m.Y') : '—'); ?></td>
                                    <td class="py-3 pr-4 align-top whitespace-nowrap"><?php echo e($acc->expires_at ? $acc->expires_at->format('d.m.Y') : '—'); ?></td>
                                    <td class="py-3 align-top text-[#4A5568]"><?php echo e($acc->note ?? '—'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cases->isNotEmpty()): ?>
        <section class="mt-14 sm:mt-16 lg:mt-24">
            <div class="grid gap-4 lg:grid-cols-[1fr_2.5fr] lg:gap-10 items-start">
                <div>
                    <p class="inline-flex items-baseline gap-2 text-[24px] font-medium text-[#91B5D5] sm:text-[28px] lg:text-[32px] 2xl:text-[40px]">
                        Результат операций
                        <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </p>
                </div>

                <h2 class="text-center text-[18px] font-medium leading-[1.3] text-brand sm:text-[22px] lg:text-left lg:text-[28px] lg:[text-indent:140px] 2xl:text-[36px] 2xl:[text-indent:200px]">
                    Мы гордимся результатами, которых достигаем вместе с нашими пациентами благодаря современным методикам и золотым рукам хирургов. Убедитесь сами, как тонко и естественно мы умеем работать с красотой.
                </h2>
            </div>

            
            <div role="tablist" aria-label="Фильтр результатов по услугам" class="no-scrollbar mt-8 flex gap-2.5 overflow-x-auto lg:mt-10">
                <button type="button" data-tabfilter="all" data-tab-group="results" role="tab" aria-selected="true"
                        class="shrink-0 whitespace-nowrap rounded-[10px] bg-brand px-6 py-3 text-[13px] font-medium text-white transition-colors hover:bg-brandh sm:text-[14px] lg:text-[16px]">
                    Все
                </button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $caseTabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button type="button" data-tabfilter="<?php echo e($tab); ?>" data-tab-group="results" role="tab" aria-selected="false"
                            class="shrink-0 whitespace-nowrap rounded-[10px] bg-[#F4F7FD] px-6 py-3 text-[13px] font-medium text-body transition-colors hover:bg-[#E2E7F1] sm:text-[14px] lg:text-[16px]">
                        <?php echo e($tab); ?>

                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div id="results-track" data-tab-content="results" class="swiper mt-6 lg:mt-8" aria-label="Результаты операций"
                 data-swiper='{"navigation":{"prevEl":"#results-prev","nextEl":"#results-next"},"spaceBetween":12,"breakpoints":{"1024":{"spaceBetween":16},"1920":{"spaceBetween":24}}}'>
                <div class="swiper-wrapper">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $service = $case->service?->name ?: 'Все';
                            $caption = $case->title ?: 'Результат';
                        ?>
                        <figure data-tag="<?php echo e($service); ?>" class="<?php echo e($case->service?->slug === 'mammo-1' ? 'case-natural' : ''); ?> swiper-slide gap-2 2xl:gap-2.5">
                            <img src="<?php echo e($case->beforeUrl()); ?>" alt="<?php echo e($caption); ?>: вид до" width="640" height="800" loading="lazy"
                                 class="h-[254px] w-1/2 min-w-0 rounded-2xl object-cover sm:h-[300px] lg:h-[360px] 2xl:h-[480px]">
                            <img src="<?php echo e($case->afterUrl()); ?>" alt="<?php echo e($caption); ?>: вид после" width="640" height="800" loading="lazy"
                                 class="h-[254px] w-1/2 min-w-0 rounded-2xl object-cover sm:h-[300px] lg:h-[360px] 2xl:h-[480px]">
                        </figure>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            
            <div class="mt-6 flex items-center justify-between lg:mt-8">
                <button type="button" id="results-prev" aria-label="Предыдущие фото"
                        class="grid h-11 w-11 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:bg-brandh disabled:opacity-40 2xl:h-14 2xl:w-14">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button type="button" id="results-next" aria-label="Следующие фото"
                        class="grid h-11 w-11 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:bg-brandh disabled:opacity-40 2xl:h-14 2xl:w-14">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </section>
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
        document.querySelectorAll('[data-tabfilter]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var group = btn.dataset.tabGroup;
                var active = ['bg-brand', 'text-white', 'hover:bg-brandh'];
                var idle = ['bg-[#F4F7FD]', 'text-body', 'hover:bg-[#E2E7F1]'];

                document.querySelectorAll('[data-tabfilter][data-tab-group="' + group + '"]').forEach(function (b) {
                    if (b === btn) {
                        active.forEach(function (c) { b.classList.add(c); });
                        idle.forEach(function (c) { b.classList.remove(c); });
                        b.setAttribute('aria-selected', 'true');
                    } else {
                        idle.forEach(function (c) { b.classList.add(c); });
                        active.forEach(function (c) { b.classList.remove(c); });
                        b.setAttribute('aria-selected', 'false');
                    }
                });

                var value = btn.dataset.tabfilter;
                document.querySelectorAll('[data-tab-content="' + group + '"]').forEach(function (track) {
                    track.querySelectorAll('[data-tag]').forEach(function (card) {
                        card.classList.toggle('hidden', value !== 'all' && card.dataset.tag !== value);
                    });
                    if (track._swiper) {
                        track._swiper.update();
                        track._swiper.slideTo(0, 0);
                    }
                });
            });
        });
    });
</script>

</body>
</html>
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/specialist-detail.blade.php ENDPATH**/ ?>