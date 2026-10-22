<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Услуги направления «<?php echo e($category->name); ?>» в клинике «Арт-Медика»: длительность и стоимость приёма.">
    <title><?php echo e($category->name); ?> — Услуги — Арт-Медика</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<?php
$formatPrice = fn ($value) => number_format((float) $value, 0, ',', ' ') . ' ₽';
$servicePrice = fn ($service) => (($value = collect([$service->price, $service->price_cat_1, $service->price_cat_2, $service->price_cat_3])
        ->filter()->min()) !== null ? $formatPrice($value) : null);
?>
<body>
    <?php echo $__env->make('components.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="mx-auto w-full max-w-[1720px] px-4 pb-20 sm:px-6 md:px-10 2xl:px-0">
        
        <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-6 text-[15px] text-brand">
            <a href="<?php echo e(url('/')); ?>" rel="home" class="transition-colors hover:text-brandh">Арт-Медика</a>
            <img src="<?php echo e(asset('images/_.svg')); ?>" alt="" class="h-3 w-auto" aria-hidden="true">
            <a href="<?php echo e(route('services')); ?>" class="whitespace-nowrap transition-colors hover:text-brandh">Услуги</a>
            <img src="<?php echo e(asset('images/_.svg')); ?>" alt="" class="h-3 w-auto shrink-0" aria-hidden="true">
            <span class="font-medium"><?php echo e($category->name); ?></span>
        </nav>

        
        <div class="flex flex-col items-start justify-between gap-8 pt-10 lg:flex-row lg:items-start 2xl:pt-[52px]">
            <h1 class="flex shrink-0 items-center gap-2 text-[40px] font-medium leading-none text-[#91B5D5] max-lg:text-3xl">
                <?php echo e($category->name); ?>

                <img src="<?php echo e(asset('images/Arrow_right_light.svg')); ?>" alt="" class="w-[50px] max-lg:w-[38px]" aria-hidden="true">
            </h1>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category->description): ?>
                <p class="max-w-[1140px] text-[40px] font-medium leading-tight text-brand [text-indent:25%] max-lg:text-2xl">
                    <?php echo e($category->description); ?>

                </p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($total > 0): ?>
            <div class="mt-12 space-y-14 2xl:mt-16">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(empty($group['services'])) continue; ?>
                    <?php
                        $child   = $group['category'];
                        $groupId = $child?->id ?? 'own';
                    ?>
                    <section aria-labelledby="group-<?php echo e($groupId); ?>">
                        <div class="border-b border-border pb-4">
                            <h2 id="group-<?php echo e($groupId); ?>" class="text-[28px] font-medium text-ink max-lg:text-2xl">
                                <?php echo e($child?->name ?? 'Основные услуги'); ?>

                            </h2>
                        </div>

                        <ul class="divide-y divide-border">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $group['services']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $price    = $servicePrice($service);
                                    $duration = $service->duration_label ? $service->duration_label . ' мин' : null;
                                    $hasData  = (bool) ($duration || $price);
                                ?>
                                <li class="grid items-baseline gap-x-6 gap-y-1 py-4 <?php echo e($hasData ? 'max-sm:grid-cols-[minmax(0,1fr)_auto] sm:grid-cols-[minmax(0,1fr)_150px_170px]' : 'grid-cols-1'); ?>">
                                    <span class="min-w-0 text-[18px] leading-snug text-body max-lg:text-base"><?php echo e($service->name); ?></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasData): ?>
                                        <span class="text-[15px] text-muted max-sm:order-3 max-sm:hidden"><?php echo e($duration ?? ''); ?></span>
                                        <span class="text-[15px] font-medium whitespace-nowrap text-body max-sm:col-start-2 sm:col-start-3 sm:text-right"><?php echo e($price ?? ''); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ul>
                    </section>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php else: ?>
            <div class="mt-12 rounded-[24px] bg-surface px-8 py-16 text-center">
                <p class="text-[20px] font-medium text-ink">Список услуг направления появится в ближайшее время</p>
                <p class="mt-2 text-[15px] text-muted">Уточните детали по телефону <?php echo e(\App\Models\Setting::get('contacts', [])['phone'] ?? ''); ?>.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div class="mt-16">
            <a href="<?php echo e(route('services')); ?>"
               class="inline-flex items-center gap-3 rounded-full border border-border px-7 py-3.5 text-[15px] font-semibold text-ink transition-colors hover:border-brand hover:bg-surface hover:text-brand focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" aria-hidden="true" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
                Все направления клиники
            </a>
        </div>
    </main>

    <?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH F:\xampp\htdocs\art-medic\art-medika\resources\views\services-show.blade.php ENDPATH**/ ?>