<?php
    $contacts    = \App\Models\Setting::get('contacts', ['address' => '', 'phone' => '', 'email' => '', 'work_hours' => '']);
    $disclaimer  = \App\Models\Setting::get('disclaimer') ?: 'ИМЕЮТСЯ ПРОТИВОПОКАЗАНИЯ. НЕОБХОДИМА КОНСУЛЬТАЦИЯ СПЕЦИАЛИСТА';
    $socials     = \App\Models\Setting::get('socials', []);
    $socialIcons = \App\Models\Setting::get('social_icons', []);
    $logo        = \App\Models\Setting::get('logo') ?: asset('images/logo.png');
    $phoneTel    = preg_replace('/\D+/', '', (string) ($contacts['phone'] ?? ''));

    $companyNav = [
        ['href' => '/o-centre',   'label' => 'О клинике'],
        ['href' => '#spetsialisty', 'label' => 'Специалисты'],
        ['href' => '#uslugi',     'label' => 'Услуги'],
        ['href' => route('projects'), 'label' => 'Проекты'],
        ['href' => '/stock',      'label' => 'Акции'],
        ['href' => '/news',       'label' => 'Новости'],
        ['href' => '/prices',     'label' => 'Цены'],
        ['href' => '#contacts',   'label' => 'Контакты'],
        ['href' => '/documents',  'label' => 'Документы'],
        ['href' => '/faq',        'label' => 'Вопросы и ответы'],
    ];

    $serviceNav = [
        'Пластическая хирургия',
        'Косметология',
        'Топ-продукты',
        'Дерматология',
        'Оториноларингология',
        'Лор-хирургия',
        'Неврология и рефлексотерапия',
        'Эстетическая гинекология',
        'Терапевтический приём',
        'Массаж',
    ];
?>

<footer id="contacts" class="bg-[#EDF1F7] font-onest lg:font-sans">
    
    <div class="px-4 py-8 lg:hidden">
        
        <div class="flex items-center justify-between gap-4">
            <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-2">
                <img src="<?php echo e($logo); ?>" alt="Знак клиники Арт-Медика" class="h-9 w-auto">
                <span class="flex flex-col leading-none">
                    <span class="font-serif text-[18px] italic font-semibold tracking-tight text-brand">Арт-Медика</span>
                    <span class="text-[7.5px] text-brand">медико-косметологический центр</span>
                </span>
            </a>

            <div class="flex items-center gap-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $socialIcons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $network => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($socials[$network] ?? '#'); ?>" target="_blank" rel="noopener"
                       aria-label="Мы в <?php echo e(mb_strtoupper($network)); ?>"
                       class="grid h-8 w-8 place-items-center overflow-hidden rounded-full bg-white shadow-sm transition-colors hover:bg-surfaceh">
                        <img src="<?php echo e($icon); ?>" alt="" class="h-8 w-8 object-contain">
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        
        <ul class="mt-6 space-y-3 text-[13px] text-body">
            <li class="flex items-start gap-2.5">
                <svg class="mt-0.5 h-3.5 w-3.5 shrink-0 text-ink" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a7.3 7.3 0 0 0-7.3 7.3c0 5.4 6.5 12 7.3 12s7.3-6.6 7.3-12A7.3 7.3 0 0 0 12 2Zm0 10a2.7 2.7 0 1 1 0-5.4 2.7 2.7 0 0 1 0 5.4Z"/></svg>
                <span><?php echo e($contacts['address'] ?? ''); ?></span>
            </li>
            <li class="flex items-start gap-2.5">
                <svg class="mt-0.5 h-3.5 w-3.5 shrink-0 text-ink" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 3h2.2c.7 0 1.3.5 1.4 1.2l.5 2.8c.1.6-.2 1.2-.7 1.5l-1.4.8a12.4 12.4 0 0 0 5.9 5.9l.8-1.4c.3-.5.9-.8 1.5-.7l2.8.5c.7.1 1.2.7 1.2 1.4v2.2c0 .9-.7 1.7-1.6 1.6C11 19.9 4.2 13.2 5 4.6 5 3.7 5.8 3 6.6 3Z"/></svg>
                <a href="tel:<?php echo e($phoneTel); ?>" class="transition-colors hover:text-brand"><?php echo e($contacts['phone'] ?? ''); ?></a>
            </li>
            <li class="flex items-start gap-2.5">
                <svg class="mt-0.5 h-3.5 w-3.5 shrink-0 text-ink" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm1.4 2 6.6 5.2L18.6 7H5.4Z"/></svg>
                <a href="mailto:<?php echo e($contacts['email'] ?? ''); ?>" class="transition-colors hover:text-brand"><?php echo e($contacts['email'] ?? ''); ?></a>
            </li>
            <li class="flex items-start gap-2.5">
                <svg class="mt-0.5 h-3.5 w-3.5 shrink-0 text-ink" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm1 5v5l4 2.4-.9 1.5-4.9-3V7h1.9Z"/></svg>
                <span><?php echo e($contacts['work_hours'] ?? ''); ?></span>
            </li>
        </ul>

        
        <div class="mt-5 flex items-center gap-2.5">
            <a href="/stock" class="flex-1 rounded-full bg-brand py-2.5 text-center text-[14px] font-semibold text-white transition-colors hover:bg-brandh">
                Записаться
            </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($phoneTel): ?>
                <a href="tel:<?php echo e($phoneTel); ?>" aria-label="Позвонить в клинику"
                   class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-brand text-white transition-colors hover:bg-brandh">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6.6 3h2.2c.7 0 1.3.5 1.4 1.2l.5 2.8c.1.6-.2 1.2-.7 1.5l-1.4.8a12.4 12.4 0 0 0 5.9 5.9l.8-1.4c.3-.5.9-.8 1.5-.7l2.8.5c.7.1 1.2.7 1.2 1.4v2.2c0 .9-.7 1.7-1.6 1.6C11 19.9 4.2 13.2 5 4.6 5 3.7 5.8 3 6.6 3Z" fill="currentColor"/></svg>
                </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <a href="#root" aria-label="Версия для слабовидящих" class="mt-5 inline-flex items-center gap-2 transition-colors hover:text-brandh">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true" class="text-ink"><path d="M2.5 12S6 5.5 12 5.5 21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12Z" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.7"/></svg>
            <span class="text-[12px] font-medium text-ink">Версия для слабовидящих</span>
        </a>

        
        <p class="mt-3 text-[11px] leading-relaxed text-muted">
            © Медико-косметологический центр Арт-медика <?php echo e(now()->year); ?><br>Категория 18+
        </p>
    </div>

    
    <div class="hidden lg:block mx-auto w-full max-w-[1720px] px-6 md:px-10 py-12 2xl:px-0 2xl:py-16">
        <div class="grid gap-10 lg:grid-cols-[minmax(0,1.85fr)_minmax(0,1fr)_minmax(0,1.8fr)_minmax(0,1fr)] lg:gap-10">

            
            <div>
                <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-2.5">
                    <img src="<?php echo e($logo); ?>" alt="Знак клиники Арт-Медика" class="h-10 w-auto sm:h-12">
                    <span class="flex flex-col leading-none">
                        <span class="font-serif text-[21px] italic font-semibold tracking-tight text-brand sm:text-[25px]">Арт-Медика</span>
                        <span class="mt-1 text-[9px] text-brand sm:text-[10px]">медико-косметологический центр</span>
                    </span>
                </a>

                <div class="mt-6 flex items-center gap-2.5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $socialIcons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $network => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($socials[$network] ?? '#'); ?>" target="_blank" rel="noopener"
                           aria-label="Мы в <?php echo e(mb_strtoupper($network)); ?>"
                           class="grid h-9 w-9 place-items-center overflow-hidden rounded-full bg-white transition-colors hover:bg-surfaceh">
                            <img src="<?php echo e($icon); ?>" alt="" class="h-9 w-9" width="36" height="36">
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <a href="#root" aria-label="Версия для слабовидящих" class="mt-6 inline-flex items-center gap-2.5 transition-colors hover:text-brandh">
                    <span class="grid h-7 w-7 place-items-center rounded-full bg-brand">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" aria-hidden="true" class="text-white"><path d="M2.5 12S6 5.5 12 5.5 21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12Z" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.7"/></svg>
                    </span>
                    <span class="text-[15px] font-semibold text-brand">Версия для слабовидящих</span>
                </a>

                <p class="mt-5 text-[13px] leading-relaxed text-body">© Медико-косметологический центр Арт-медика <?php echo e(now()->year); ?><br>Категория 18+</p>
            </div>

            
            <nav aria-label="Клиника">
                <p class="text-[16px] font-semibold text-ink 2xl:text-[17px]">Клиника</p>
                <ul class="mt-4 space-y-3 text-[14px] text-body sm:text-[15px]">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $companyNav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e($item['href']); ?>" class="transition-colors hover:text-brand"><?php echo e($item['label']); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </nav>

            
            <nav aria-label="Услуги">
                <p class="text-[16px] font-semibold text-ink 2xl:text-[17px]">Услуги</p>
                <ul class="mt-4 space-y-3 text-[14px] text-body sm:text-[15px]">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $serviceNav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="#uslugi" class="transition-colors hover:text-brand"><?php echo e($label); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </nav>

            
            <div>
                <a href="/stock" class="block rounded-full bg-brand py-3.5 text-center text-[15px] font-semibold text-white transition-colors hover:bg-brandh">Записаться</a>
                <ul class="mt-6 space-y-4 text-[14px] text-body sm:text-[15px]">
                    <li class="flex items-start gap-2.5">
                        <svg class="mt-0.5 h-[15px] w-[15px] shrink-0 text-ink" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a7.3 7.3 0 0 0-7.3 7.3c0 5.4 6.5 12 7.3 12s7.3-6.6 7.3-12A7.3 7.3 0 0 0 12 2Zm0 10a2.7 2.7 0 1 1 0-5.4 2.7 2.7 0 0 1 0 5.4Z"/></svg>
                        <span><?php echo e($contacts['address'] ?? ''); ?></span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <svg class="mt-0.5 h-[15px] w-[15px] shrink-0 text-ink" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 3h2.2c.7 0 1.3.5 1.4 1.2l.5 2.8c.1.6-.2 1.2-.7 1.5l-1.4.8a12.4 12.4 0 0 0 5.9 5.9l.8-1.4c.3-.5.9-.8 1.5-.7l2.8.5c.7.1 1.2.7 1.2 1.4v2.2c0 .9-.7 1.7-1.6 1.6C11 19.9 4.2 13.2 5 4.6 5 3.7 5.8 3 6.6 3Z"/></svg>
                        <a href="tel:<?php echo e($phoneTel); ?>" class="transition-colors hover:text-brand"><?php echo e($contacts['phone'] ?? ''); ?></a>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <svg class="mt-0.5 h-[15px] w-[15px] shrink-0 text-ink" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm1.4 2 6.6 5.2L18.6 7H5.4Z"/></svg>
                        <a href="mailto:<?php echo e($contacts['email'] ?? ''); ?>" class="transition-colors hover:text-brand"><?php echo e($contacts['email'] ?? ''); ?></a>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <svg class="mt-0.5 h-[15px] w-[15px] shrink-0 text-ink" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm1 5v5l4 2.4-.9 1.5-4.9-3V7h1.9Z"/></svg>
                        <span><?php echo e($contacts['work_hours'] ?? ''); ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    
    <div class="bg-brand">
        <p class="mx-auto max-w-[1720px] px-4 py-5 sm:py-7 text-center text-[10px] sm:text-[13px] font-medium uppercase tracking-[0.02em] text-white 2xl:text-[15px]">
            <?php echo e($disclaimer); ?>

        </p>
    </div>
</footer>
<?php /**PATH F:\xampp\htdocs\art-medic\art-medika\resources\views/components/footer.blade.php ENDPATH**/ ?>