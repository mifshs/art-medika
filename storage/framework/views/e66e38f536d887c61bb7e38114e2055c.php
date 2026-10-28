<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Цены на услуги клиники «Арт-Медика»: направления, поднаправления, стоимость и время приёма.">
    <title>Цены на услуги — Арт-Медика</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<?php
    $currency = fn ($value) => $value === null ? '—' : number_format((float) $value, 0, ',', ' ') . ' ₽';
    $duration = fn ($service) => $service->duration_label ?? null;
    $blank    = fn ($value) => $value === null || $value === '' ? '' : $value;
    $dash     = fn ($value) => $value === null || $value === '' ? '—' : $value;
    $headColsSimple = 'items-start gap-x-6 pb-2 text-[12px] leading-tight text-muted lg:grid lg:grid-cols-[150px_80px_minmax(0,1fr)_100px_110px_130px] 2xl:text-[13px]';
    $headColsCat    = 'items-start gap-x-6 pb-2 text-[12px] leading-tight text-muted lg:grid lg:grid-cols-[150px_80px_minmax(0,1fr)_100px_110px_110px_110px_120px] 2xl:text-[13px]';
    $mutedCell  = 'hidden text-[13px] text-muted lg:block 2xl:text-[14px]';
    $bodyCell   = 'hidden text-[14px] text-body lg:block 2xl:text-[15px]';
    $nameCell   = 'hidden text-[15px] leading-snug text-body lg:block 2xl:text-[17px]';
    $priceCell  = 'hidden text-[14px] font-medium text-body lg:block 2xl:text-[15px]';
    $footnote   = '*Категорию присваивает врач-хирург на консультации, в зависимости от состояния пациента.';
?>
<body>
    <?php echo $__env->make('components.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="mx-auto w-full max-w-[1720px] px-4 pb-20 sm:px-6 md:px-10 2xl:px-0">
        <h1 class="flex items-center gap-3 pt-6 text-[40px] font-medium leading-none text-[#91B5D5] max-lg:text-3xl 2xl:pt-10">
            Цены на услуги
            <img src="<?php echo e(asset('images/Arrow_right_light.svg')); ?>" alt="" class="w-[50px] shrink-0 max-lg:w-[38px]" aria-hidden="true">
        </h1>

        <?php $firstCard = true; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <section aria-labelledby="dep<?php echo e($section['id']); ?>" class="pt-12 2xl:pt-16">
                <h2 id="dep<?php echo e($section['id']); ?>" class="text-right text-[20px] font-semibold text-ink 2xl:text-[24px]"><?php echo e($section['name']); ?></h2>
                <div class="mt-5 space-y-4 sm:mt-6 sm:space-y-5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $section['cards']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $openCard = $firstCard; $firstCard = false; ?>
                        <details class="price-card rounded-[16px] bg-surfaceh" <?php if($openCard): ?> open <?php endif; ?>>
                            <summary class="flex list-none cursor-pointer items-center justify-between gap-4 rounded-[16px] px-6 py-5 transition-colors hover:bg-[#E2E7F1] sm:px-8 sm:py-6 2xl:px-10 2xl:py-7 [&::-webkit-details-marker]:hidden">
                                <span class="min-w-0 text-[18px] font-medium text-ink sm:text-[20px] 2xl:text-[24px]"><?php echo e($card['name']); ?></span>
                                <span class="flex shrink-0 items-center gap-4 sm:gap-7">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($card['min'] !== null): ?>
                                        <span class="whitespace-nowrap text-[13px] text-muted sm:text-[14px] 2xl:text-[16px]">от <?php echo e(number_format($card['min'], 0, ',', ' ')); ?> ₽</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true" class="acc-arrow h-5 w-5 text-ink 2xl:h-6 2xl:w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                                    </svg>
                                </span>
                            </summary>

                            <div class="px-6 pb-8 pt-2 sm:px-8 2xl:px-10 2xl:pb-10">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($card['simple']) > 0): ?>
                                    <ul class="price-simple">
                                        <li class="<?php echo e($headColsSimple); ?>" aria-hidden="true">
                                            <span class="hidden lg:block">Код Номенклатуры мед усл</span>
                                            <span class="hidden lg:block">Код МУС</span>
                                            <span class="hidden lg:block">Наименование медицинской услуги</span>
                                            <span class="hidden lg:block">Ед. изм-ия</span>
                                            <span class="hidden lg:block">Врем. мин</span>
                                            <span class="hidden lg:block">Цена. руб.</span>
                                        </li>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $card['simple']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $dur = $duration($service); $meta = trim(($service->mis_code ? 'Код ' . $service->mis_code . ' · ' : '') . ($service->unit ?? '') . ($dur ? ' · ' . $dur : '')); ?>
                                            <li class="gap-x-6 gap-y-1 py-4 lg:grid lg:grid-cols-[150px_80px_minmax(0,1fr)_100px_110px_130px] lg:items-start lg:gap-y-0">
                                                <div class="flex flex-col gap-0.5 lg:hidden">
                                                    <span class="text-[15px] leading-snug text-body 2xl:text-[17px]"><?php echo e($service->name); ?></span>
                                                    <span class="text-[13px] text-muted"><?php echo e($meta); ?></span>
                                                    <span class="text-[15px] font-medium text-body 2xl:text-[16px]"><?php echo e($currency($service->price)); ?></span>
                                                </div>
                                                <span class="<?php echo e($mutedCell); ?>"><?php echo e($blank($service->nomenclature_code)); ?></span>
                                                <span class="<?php echo e($mutedCell); ?>"><?php echo e($blank($service->mis_code)); ?></span>
                                                <span class="<?php echo e($nameCell); ?>"><?php echo e($service->name); ?></span>
                                                <span class="<?php echo e($bodyCell); ?>"><?php echo e($service->unit); ?></span>
                                                <span class="<?php echo e($bodyCell); ?>"><?php echo e($dash($dur)); ?></span>
                                                <span class="<?php echo e($priceCell); ?>"><?php echo e($currency($service->price)); ?></span>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </ul>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($card['cat']) > 0): ?>
                                    <p class="mt-3 text-[13px] italic leading-snug text-muted 2xl:text-[14px]"><?php echo e($footnote); ?></p>
                                    <div class="<?php echo e(count($card['simple']) > 0 ? 'mt-5' : ''); ?>">
                                        <ul class="price-cat">
                                            <li class="<?php echo e($headColsCat); ?>" aria-hidden="true">
                                                <span class="hidden lg:block">Код Номенклатуры мед усл</span>
                                                <span class="hidden lg:block">Код МУС</span>
                                                <span class="hidden lg:block">Наименование медицинской услуги</span>
                                                <span class="hidden lg:block">Ед. изм-ия</span>
                                                <span class="hidden lg:block">Врем. мин</span>
                                                <span class="col-span-3 hidden lg:block">
                                                    <span class="block">Цена. руб./ категория сложности</span>
                                                    <span class="mt-1 grid grid-cols-[110px_110px_120px]"><span>I</span><span>II</span><span>III</span></span>
                                                </span>
                                            </li>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $card['cat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($group['banner'] !== null): ?>
                                                    <?php
                                                        $banner = $group['banner'];
                                                        $bannerUnit = ($group['rows'][0] ?? null)?->unit ?? 'услуга';
                                                        $bannerMeta = trim(($banner->mis_code ? 'Код ' . $banner->mis_code . ' · ' : '') . $bannerUnit);
                                                    ?>
                                                    <li class="gap-x-6 gap-y-1 pt-5 lg:grid lg:grid-cols-[150px_80px_minmax(0,1fr)_100px_110px_110px_110px_120px] lg:items-start lg:gap-y-0">
                                                        <div class="flex flex-col gap-0.5 lg:hidden">
                                                            <span class="text-[15px] font-semibold leading-snug text-body 2xl:text-[17px]"><?php echo e($banner->name); ?></span>
                                                            <span class="text-[13px] text-muted"><?php echo e($bannerMeta); ?></span>
                                                        </div>
                                                        <span class="hidden lg:block"></span>
                                                        <span class="<?php echo e($mutedCell); ?>"><?php echo e($blank($banner->mis_code)); ?></span>
                                                        <span class="<?php echo e($nameCell); ?>"><?php echo e($banner->name); ?></span>
                                                        <span class="<?php echo e($bodyCell); ?>"><?php echo e($bannerUnit); ?></span>
                                                        <span class="hidden lg:block"></span>
                                                        <span class="hidden lg:block"></span>
                                                        <span class="hidden lg:block"></span>
                                                        <span class="hidden lg:block"></span>
                                                    </li>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $group['rows']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $dur = $duration($service);
                                                        $meta = trim(($service->mis_code ? 'Код ' . $service->mis_code . ' · ' : '') . ($service->unit ?? '') . ($dur ? ' · ' . $dur : ''));
                                                    ?>
                                                    <li class="gap-x-6 gap-y-1 py-4 lg:grid lg:grid-cols-[150px_80px_minmax(0,1fr)_100px_110px_110px_110px_120px] lg:items-start lg:gap-y-0">
                                                        <div class="flex flex-col gap-0.5 lg:hidden">
                                                            <span class="text-[15px] leading-snug text-body 2xl:text-[17px]"><?php echo e($service->name); ?></span>
                                                            <span class="text-[13px] text-muted"><?php echo e($meta); ?></span>
                                                            <span class="flex flex-wrap gap-x-4 gap-y-1 text-[14px] font-medium text-body 2xl:text-[15px]">
                                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->price_cat_1 !== null || $service->price_cat_2 !== null || $service->price_cat_3 !== null): ?>
                                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->price_cat_1 !== null): ?><span><span class="text-muted">I</span> <?php echo e($currency($service->price_cat_1)); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->price_cat_2 !== null): ?><span><span class="text-muted">II</span> <?php echo e($currency($service->price_cat_2)); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->price_cat_3 !== null): ?><span><span class="text-muted">III</span> <?php echo e($currency($service->price_cat_3)); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                                <?php else: ?>
                                                                    <span>—</span>
                                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                            </span>
                                                        </div>
                                                        <span class="<?php echo e($mutedCell); ?>"><?php echo e($blank($service->nomenclature_code)); ?></span>
                                                        <span class="<?php echo e($mutedCell); ?>"><?php echo e($blank($service->mis_code)); ?></span>
                                                        <span class="<?php echo e($nameCell); ?>"><?php echo e($service->name); ?></span>
                                                        <span class="<?php echo e($bodyCell); ?>"><?php echo e($service->unit); ?></span>
                                                        <span class="<?php echo e($bodyCell); ?>"><?php echo e($dash($dur)); ?></span>
                                                        <span class="<?php echo e($priceCell); ?>"><?php echo e($currency($service->price_cat_1)); ?></span>
                                                        <span class="<?php echo e($priceCell); ?>"><?php echo e($currency($service->price_cat_2)); ?></span>
                                                        <span class="<?php echo e($priceCell); ?>"><?php echo e($currency($service->price_cat_3)); ?></span>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </details>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </section>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </main>

    <?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\art-medika\resources\views/prices.blade.php ENDPATH**/ ?>