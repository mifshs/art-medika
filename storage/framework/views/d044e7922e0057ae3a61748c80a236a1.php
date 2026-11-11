<?php
    $contacts = \App\Models\Setting::get('contacts', ['address' => '', 'phone' => '', 'email' => '', 'work_hours' => '']);
    $logo     = \App\Models\Setting::get('logo') ?: asset('images/logo.png');
    $phoneTel = preg_replace('/\D+/', '', (string) ($contacts['phone'] ?? ''));
    $nav      = [
        ['href' => '/o-centre',      'label' => 'О клинике'],
        ['href' => '/uslugi', 'label' => 'Услуги'],
        ['href' => '/spetsialisty',  'label' => 'Специалисты'],
        ['href' => '/stock',         'label' => 'Акции'],
        ['href' => '/documents',     'label' => 'Документы'],
        ['href' => '/kontakty',      'label' => 'Контакты'],
    ];
?>

<a href="#main-content" class="skip-to-content">Перейти к основному содержимому</a>

<header x-data="{ menu: false }" @keydown.escape.window="menu = false" class="bg-white font-onest">
    <div class="relative mx-auto flex w-full max-w-[1720px] items-center justify-between gap-6 px-4 py-3 sm:py-5 sm:px-6 md:px-10 2xl:px-0">
        <button type="button" @click="menu = !menu" :aria-expanded="menu" aria-controls="mobile-menu" aria-label="Открыть меню навигации"
                class="grid h-11 w-11 shrink-0 place-items-center rounded-xl border border-border transition-all duration-150 hover:bg-surface active:scale-95 focus-visible:outline-offset-2 lg:hidden">
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" aria-hidden="true"><path d="M1 1h18M1 7h18M1 13h18" stroke="#212529" stroke-width="1.6" stroke-linecap="round"/></svg>
        </button>

        <a href="<?php echo e(url('/')); ?>" class="flex shrink-0 items-center transition-all duration-200 hover:opacity-90 active:scale-[0.98] focus-visible:outline-offset-2 max-sm:absolute max-sm:left-1/2 max-sm:top-1/2 max-sm:-translate-y-1/2 max-sm:-translate-x-1/2">
            <img src="<?php echo e(asset('images/logo.svg')); ?>" alt="Медико-косметологический центр «Арт-Медика»" class="h-10 w-auto sm:h-12 md:h-14 lg:h-[56px] 2xl:h-[62px] object-contain">
        </a>

        <nav class="hidden items-center gap-7 xl:gap-9 2xl:gap-11 text-[15px] xl:text-[16px] 2xl:text-[17px] font-medium text-body xl:flex" aria-label="Основное меню">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="transition-colors duration-200 hover:text-brand active:scale-95 focus-visible:outline-offset-2" href="<?php echo e($item['href']); ?>"><?php echo e($item['label']); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </nav>

        <div class="flex items-center gap-4 lg:gap-6">
            <div class="hidden text-right text-[13px] 2xl:text-[14px] leading-tight text-brand md:block font-medium">
                <div><?php echo e($contacts['address'] ?? 'Челябинск, пр. Ленина 12а'); ?></div>
                <div class="mt-0.5 text-[#554035]"><?php echo e($contacts['work_hours'] ?? 'ПН-СБ с 9:00 до 20:00'); ?></div>
            </div>
            <a href="/stock" class="rounded-full bg-brand px-6 py-2.5 sm:px-7 sm:py-3 text-[14px] 2xl:text-[15px] font-semibold text-white transition-all duration-200 hover:bg-brandh active:scale-95 focus-visible:outline-offset-2">Записаться</a>
        </div>
    </div>

    <div id="mobile-menu" x-show="menu" x-collapse x-cloak class="lg:hidden border-t border-border px-4 py-4">
        <nav class="grid gap-1 text-[15px] font-medium text-body" aria-label="Мобильное меню">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="rounded-lg px-3 py-2 transition-colors hover:bg-surface active:scale-[0.98] focus-visible:outline-offset-2" href="<?php echo e($item['href']); ?>"><?php echo e($item['label']); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <a href="tel:<?php echo e($phoneTel); ?>" class="mt-2 rounded-full bg-brand px-6 py-3 text-center font-semibold text-white transition-all hover:bg-brandh active:scale-95 focus-visible:outline-offset-2">Записаться</a>
        </nav>
    </div>
</header>
<?php /**PATH F:\xampp\htdocs\art-medic\art-medika\resources\views/components/header.blade.php ENDPATH**/ ?>