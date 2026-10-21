<?php
    $contacts = \App\Models\Setting::get('contacts', ['address' => '', 'phone' => '', 'email' => '', 'work_hours' => '']);
    $logo     = \App\Models\Setting::get('logo') ?: asset('images/logo.png');
    $phoneTel = preg_replace('/\D+/', '', (string) ($contacts['phone'] ?? ''));
    $nav      = [
        ['href' => '/o-centre',      'label' => 'О клинике'],
        ['href' => route('services'), 'label' => 'Услуги'],
        ['href' => '#spetsialisty',  'label' => 'Специалисты'],
        ['href' => '/stock',         'label' => 'Акции'],
        ['href' => '/documents',     'label' => 'Документы'],
        ['href' => '#contacts',      'label' => 'Контакты'],
    ];
?>

<header x-data="{ menu: false }" class="bg-white">
    <div class="mx-auto flex w-full max-w-[1720px] items-center justify-between gap-6 px-4 py-5 sm:px-6 md:px-10 2xl:px-0">
        <a href="<?php echo e(url('/')); ?>" class="flex shrink-0 items-center gap-2.5">
            <img src="<?php echo e($logo); ?>" alt="Знак клиники Арт-Медика" class="h-9 w-auto sm:h-11">
        </a>

        <nav class="hidden items-center gap-10 text-base font-medium text-body xl:flex">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="transition-colors hover:text-brand" href="<?php echo e($item['href']); ?>"><?php echo e($item['label']); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </nav>

        <div class="flex shrink-0 items-center gap-4">
            <div class="hidden text-right md:block">
                <a href="tel:<?php echo e($phoneTel); ?>" class="block text-[17px] font-bold text-ink transition-colors hover:text-brand"><?php echo e($contacts['phone'] ?? ''); ?></a>
                <div class="text-[13px] leading-snug text-muted"><?php echo e($contacts['address'] ?? ''); ?><br><?php echo e($contacts['work_hours'] ?? ''); ?></div>
            </div>
            <a href="/stock" class="rounded-full bg-brand px-5 py-3 text-[14px] font-semibold text-white transition-colors hover:bg-brandh sm:px-7 sm:py-3.5 sm:text-[15px]">Записаться</a>
        </div>
    </div>

    <div id="mobile-menu" x-show="menu" x-collapse x-cloak class="lg:hidden border-t border-border px-4 py-4">
        <nav class="grid gap-1 text-[15px] font-medium text-body">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="rounded-lg px-3 py-2 hover:bg-surface" href="<?php echo e($item['href']); ?>"><?php echo e($item['label']); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <a href="tel:<?php echo e($phoneTel); ?>" class="mt-2 rounded-full bg-brand px-6 py-3 text-center font-semibold text-white hover:bg-brandh">Записаться</a>
        </nav>
    </div>
</header>
<?php /**PATH D:\xampp\htdocs\art-medika\resources\views/components/header.blade.php ENDPATH**/ ?>