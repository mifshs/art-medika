<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О клинике — Медико-косметологический центр «Арт-Медика»</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Шрифт макета — Onest --}}
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-page font-onest text-body antialiased">

<x-header></x-header>

<main class="mx-auto w-full max-w-[1720px] px-4 pb-16 sm:px-6 md:px-10 lg:pb-24 2xl:px-0">
    {{-- Хлебные крошки (макет: Onest 18px, цвет #37241B) --}}
    <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-5 text-[15px] text-brand sm:pt-6 sm:text-[16px] 2xl:text-[18px]">
        <a href="{{ url('/') }}" class="transition-colors duration-200 hover:text-brandh">Арт-Медика</a>
        <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto" aria-hidden="true">
        <span class="font-medium">О клинике</span>
    </nav>

    {{-- Заголовок страницы: «О клинике ↗» слева, вводный слоган справа --}}
    <div class="mt-7 sm:mt-8 lg:mt-12">
        <div class="grid gap-4 lg:grid-cols-[1fr_2.5fr] lg:gap-10 items-start">
            <div>
                <p class="inline-flex items-baseline gap-2 text-[24px] font-medium text-[#91B5D5] sm:text-[28px] lg:text-[32px] 2xl:text-[40px]">
                    О клинике
                    <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </p>
            </div>

            <h1 class="text-center text-[18px] font-medium leading-[1.3] text-brand sm:text-[22px] lg:text-left lg:text-[28px] lg:[text-indent:140px] 2xl:text-[36px] 2xl:[text-indent:200px]">
                {{ $introText }}
            </h1>
        </div>
    </div>

    {{-- Основной блок «О клинике»: фото слева, описание клиники и 3 карточки статистики справа --}}
    <div class="mt-8 grid grid-cols-1 gap-6 sm:mt-10 sm:gap-8 lg:grid-cols-[46%_1fr] lg:gap-10 2xl:grid-cols-[48%_1fr] 2xl:gap-12 items-stretch">
        {{-- Фотография клиники (кабинет, оборудование) --}}
        <div class="overflow-hidden rounded-[20px] sm:rounded-[24px]">
            <img src="{{ $aboutImage }}" alt="Медико-косметологический центр «Арт-Медика»" loading="lazy"
                 class="h-[260px] w-full object-cover sm:h-[340px] lg:h-full lg:min-h-[380px]">
        </div>

        {{-- Текст описания клиники и статистика --}}
        <div class="flex flex-col justify-between">
            <div class="space-y-4 text-[14px] leading-relaxed text-body sm:text-[15px] lg:text-[16px] 2xl:text-[17px]">
                <p>
                    Центр «Арт-Медика» — партнер ЮУГМУ, клиническая база «Межрегионального центра непрерывного медицинского и фармацевтического образования» (г. Москва). Наша клиника является участником международных проектов в направлении "Пластическая хирургия и косметология".
                </p>
                <p>
                    Качество результата обеспечивает инновационное высокотехнологичное хирургическое, эндоскопическое и лазерное оборудование.
                </p>
            </div>

            {{-- 3 плашки статистики (на мобильных: 2 в верхней строке, 1 широкая в нижней, по макету) --}}
            <div class="mt-6 grid grid-cols-2 gap-2.5 sm:grid-cols-3 sm:gap-4 lg:mt-8 2xl:gap-5">
                @foreach ($aboutStats as $index => $stat)
                    @php
                        $isThirdOnMobile = ($index === 2);
                    @endphp
                    <div class="flex flex-col justify-between rounded-[16px] bg-[#F4F7FD] p-4 2xl:p-5 {{ $isThirdOnMobile ? 'max-sm:col-span-2' : '' }}">
                        <span class="text-[24px] font-medium leading-none text-brand sm:text-[28px] 2xl:text-[34px]">
                            {{ $stat['value'] ?? '' }}
                        </span>
                        <span class="mt-2 text-[11px] leading-snug text-[#7E93AC] sm:text-[12px] 2xl:text-[13px]">
                            {{ $stat['label'] ?? '' }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Блок отделений: Поликлиническое отделение (слева) и Стационарное отделение (справа) --}}
    <div class="mt-10 rounded-[20px] bg-[#F4F7FD] p-6 sm:mt-12 sm:p-8 lg:mt-16 lg:p-10 2xl:rounded-[24px] 2xl:p-12">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-12 2xl:gap-16 items-start">
            {{-- Левая колонка: Поликлиническое отделение --}}
            <div>
                <h2 class="text-[22px] font-semibold text-brand sm:text-[26px] 2xl:text-[28px]">
                    Поликлиническое отделение
                </h2>
                <p class="mt-2 text-[13px] text-[#4A5568] sm:text-[14px] 2xl:text-[15px]">
                    Вы можете получить помощь по направлениям:
                </p>

                {{-- Направления поликлиники со стрелками ↗ --}}
                @php
                    $polyclinicDirections = [
                        'Оториноларингология',
                        'Косметология',
                        'Дерматология',
                        'Венерология',
                        'Эстетическая гинекология',
                        'Неврология',
                        'Диагностика',
                        'Терапевтические услуги',
                    ];
                @endphp
                <ul class="mt-5 space-y-2.5 sm:space-y-3">
                    @foreach ($polyclinicDirections as $direction)
                        <li class="flex items-center gap-2.5 text-[14px] font-medium text-body sm:text-[15px] 2xl:text-[16px]">
                            <svg class="h-4 w-4 shrink-0 text-[#7E93AC]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M7 17L17 7M17 7H8.5M17 7v8.5"/>
                            </svg>
                            <span>{{ $direction }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Правая колонка: Стационарное отделение --}}
            <div class="flex flex-col justify-between">
                <div>
                    <h2 class="text-[22px] font-semibold text-brand sm:text-[26px] 2xl:text-[28px]">
                        Стационарное отделение
                    </h2>
                    <div class="mt-3 space-y-3 text-[13px] leading-relaxed text-[#4A5568] sm:text-[14px] 2xl:text-[15px]">
                        <p>
                            На территории отделения мы ежедневно оказываем помощь даже самым маленьким пациентам, выполняя полный спектр операций по направлению «Лор-хирургия», одним из самых востребованных остается аденотомия и септопластика (исправление носовой перегородки).
                        </p>
                        <p>
                            В стационарном отделении к вашим услугам палата европейского уровня с 3-х разовым питанием. Медицинская сестра будет сопровождать Вас 24 часа в сутки для создания самых комфортных условий.
                        </p>
                        <p>
                            Также в стационарном отделении мы оказываем полный спектр операций по направлению «Пластическая хирургия», особое место занимает проект «Доступная пластическая хирургия из Милана».
                        </p>
                    </div>
                </div>

                {{-- Кнопка «Подробнее» и официальные правовые ссылки --}}
                <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between pt-2">
                    <a href="{{ route('services') }}"
                       class="inline-flex h-11 sm:h-12 items-center justify-center rounded-full bg-brand px-8 text-[14px] font-semibold text-white transition-colors hover:bg-brandh shadow-sm">
                        Подробнее
                    </a>

                    <div class="flex flex-col text-[11px] leading-snug text-[#7E93AC] sm:text-right">
                        <a href="https://minzdrav.gov.ru" target="_blank" rel="noopener" class="underline hover:text-brand transition-colors">
                            Сайт Министерства здравоохранения Российской Федерации
                        </a>
                        <a href="http://pravo.gov.ru" target="_blank" rel="noopener" class="mt-1 underline hover:text-brand transition-colors">
                            Официальный интернет-портал правовой информации
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Раздел «Результат операций ↗» с использованием Swiper.js --}}
    @if ($cases->isNotEmpty())
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

            {{-- Табы фильтра услуг для слайдера --}}
            <div role="tablist" aria-label="Фильтр результатов по услугам" class="no-scrollbar mt-8 flex gap-2.5 overflow-x-auto lg:mt-10">
                <button type="button" data-tabfilter="all" data-tab-group="about-results" role="tab" aria-selected="true"
                        class="about-tab-btn shrink-0 whitespace-nowrap rounded-[10px] bg-brand px-6 py-3 text-[13px] font-medium text-white transition-colors hover:bg-brandh sm:text-[14px] lg:text-[16px]">
                    Все
                </button>
                @foreach ($caseTabs as $tab)
                    <button type="button" data-tabfilter="{{ $tab }}" data-tab-group="about-results" role="tab" aria-selected="false"
                            class="about-tab-btn shrink-0 whitespace-nowrap rounded-[10px] bg-[#F4F7FD] px-6 py-3 text-[13px] font-medium text-body transition-colors hover:bg-[#E2E7F1] sm:text-[14px] lg:text-[16px]">
                        {{ $tab }}
                    </button>
                @endforeach
            </div>

            {{-- Swiper контейнер для слайдов результатов --}}
            <div id="about-results-track" data-tab-content="about-results" class="swiper mt-6 lg:mt-8" aria-label="Слайдер результатов операций"
                 data-swiper='{"navigation":{"prevEl":"#about-results-prev","nextEl":"#about-results-next"},"spaceBetween":12,"breakpoints":{"1024":{"spaceBetween":16},"1920":{"spaceBetween":24}}}'>
                <div class="swiper-wrapper">
                    @foreach ($cases as $case)
                        @php
                            $service = $case->service?->name ?: 'Все';
                            $caption = $case->title ?: 'Результат операции';
                        @endphp
                        <figure data-tag="{{ $service }}" class="{{ $case->service?->slug === 'mammo-1' ? 'case-natural' : '' }} swiper-slide gap-2 2xl:gap-2.5">
                            <img src="{{ $case->beforeUrl() }}" alt="{{ $caption }}: вид до" width="640" height="800" loading="lazy"
                                 class="h-[254px] w-1/2 min-w-0 rounded-2xl object-cover sm:h-[300px] lg:h-[360px] 2xl:h-[480px]">
                            <img src="{{ $case->afterUrl() }}" alt="{{ $caption }}: вид после" width="640" height="800" loading="lazy"
                                 class="h-[254px] w-1/2 min-w-0 rounded-2xl object-cover sm:h-[300px] lg:h-[360px] 2xl:h-[480px]">
                        </figure>
                    @endforeach
                </div>
            </div>

            {{-- Стрелки навигации слайдера Swiper --}}
            <div class="mt-6 flex items-center justify-between lg:mt-8">
                <button type="button" id="about-results-prev" aria-label="Предыдущие фото"
                        class="grid h-11 w-11 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:bg-brandh disabled:opacity-40 2xl:h-14 2xl:w-14">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button type="button" id="about-results-next" aria-label="Следующие фото"
                        class="grid h-11 w-11 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:bg-brandh disabled:opacity-40 2xl:h-14 2xl:w-14">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </section>
    @endif
</main>

<x-footer></x-footer>

{{-- Фильтрация слайдов Swiper по выбранной услуге --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-tab-group="about-results"][data-tabfilter]').forEach(function (btn) {
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
                var track = document.getElementById('about-results-track');
                if (track) {
                    track.querySelectorAll('[data-tag]').forEach(function (card) {
                        card.classList.toggle('hidden', value !== 'all' && card.dataset.tag !== value);
                    });
                    if (track._swiper) {
                        track._swiper.update();
                        track._swiper.slideTo(0, 0);
                    }
                }
            });
        });
    });
</script>

</body>
</html>
