<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Арт-Медика — медико-эстетический центр</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-page font-sans text-body antialiased">
<x-header class="fixed"></x-header>

{{-- ================= HERO ================= --}}
<section class="relative">
    <img src="{{ $heroImage }}" alt="Врач клиники осматривает пациентку" width="1408" height="800"
         class="block h-[420px] w-full object-cover object-[60%_20%] sm:h-[520px] lg:h-auto lg:min-h-[560px]">
    <div class="pointer-events-none absolute inset-0 bg-gradient-to-b from-black/25 via-black/0 to-black/15" aria-hidden="true"></div>

    <div class="absolute inset-0 mx-auto flex w-full max-w-[1720px] flex-col px-4 pb-10 pt-8 sm:px-6 lg:pb-14 lg:pt-12 2xl:px-0">
        <h1 class="max-w-[760px] text-[30px] font-semibold leading-[1.18] tracking-[-0.01em] text-white sm:text-[40px] lg:text-[50px] 2xl:text-[56px]">
            Ваше здоровье — наша забота
        </h1>
        <p class="mt-3 max-w-[560px] text-[15px] leading-snug text-white/90 sm:text-[16px] lg:mt-4 lg:max-w-[620px] lg:text-[18px]">
            Медико-косметологический центр с современным оборудованием и опытными специалистами
        </p>

        <div class="mt-auto grid grid-cols-3 gap-2 sm:grid-cols-[auto_auto_auto] sm:justify-start sm:gap-5">
            @foreach (array_slice((array) $heroStats, 0, 3) as $stat)
                <div class="rounded-[14px] bg-[#454B55]/70 px-3.5 py-4 backdrop-blur-md sm:px-6 sm:py-6 lg:px-7 lg:py-7">
                    <div class="text-[26px] font-semibold leading-none text-white sm:text-[36px] lg:text-[46px] 2xl:text-[62px]">{{ $stat['value'] ?? '' }}</div>
                    <div class="mt-2 max-w-[180px] text-[12px] leading-snug text-white sm:text-[13px] lg:max-w-[230px] lg:text-[15px] 2xl:text-[19px]">{{ $stat['label'] ?? '' }}</div>
                </div>
            @endforeach
        </div>
    </div>

    @if (($contacts['phone'] ?? ''))
        <a href="tel:{{ preg_replace('/\D+/', '', $contacts['phone']) }}" aria-label="Позвонить в клинику"
           class="absolute bottom-4 right-4 grid h-12 w-12 place-items-center rounded-full bg-brand text-white shadow-lg ring-1 ring-white/40 transition-colors hover:bg-brandh sm:bottom-8 sm:right-8 lg:bottom-10 lg:right-10 xl:h-14 xl:w-14 2xl:bottom-0 2xl:right-0">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6.6 3h2.2c.7 0 1.3.5 1.4 1.2l.5 2.8c.1.6-.2 1.2-.7 1.5l-1.4.8a12.4 12.4 0 0 0 5.9 5.9l.8-1.4c.3-.5.9-.8 1.5-.7l2.8.5c.7.1 1.2.7 1.2 1.4v2.2c0 .9-.7 1.7-1.6 1.6C11 19.9 4.2 13.2 5 4.6 5 3.7 5.8 3 6.6 3Z" fill="currentColor"/></svg>
        </a>
    @endif
</section>

{{-- ================= УСЛУГИ (аккордеон из Livewire, данные из БД) ================= --}}
<section id="uslugi" class="mt-14 px-4 sm:px-6 lg:mt-24">
    <div class="mx-auto w-full max-w-[1720px]">
        <div class="grid gap-4 lg:grid-cols-[1fr_2fr] lg:gap-10">
            <p class="inline-flex items-baseline gap-2 text-[18px] font-semibold text-steel lg:text-[22px] 2xl:text-[30px]">
                Услуги
                <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </p>
            <p class="text-[17px] leading-snug text-body sm:text-lg lg:text-[26px] lg:leading-[1.35] 2xl:text-[32px] lg:[text-indent:240px] 2xl:[text-indent:320px]">
                В клинике «Арт-Медика» мы объединяем многолетний опыт врачей и современный арсенал медицинских возможностей, чтобы вы могли получать весь спектр медико-эстетических услуг.
            </p>
        </div>
    </div>
    <div class="mx-auto mt-8 w-full max-w-[1720px] lg:mt-12">
        <livewire:services.accordion />
    </div>
</section>

{{-- ================= О ЦЕНТРЕ ================= --}}
<section id="o-centre" class="mt-14 px-4 sm:px-6 lg:mt-24">
    <div class="mx-auto w-full max-w-[1720px]">
        <div class="grid gap-4 lg:grid-cols-[1fr_2fr] lg:gap-10">
            <p class="inline-flex items-baseline gap-2 text-[18px] font-semibold text-steel lg:text-[22px] 2xl:text-[30px]">
                О центре
                <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </p>
            <h2 class="text-[26px] font-semibold leading-[1.25] tracking-[-0.01em] text-brand sm:text-[32px] lg:text-[36px] 2xl:text-[44px] lg:[text-indent:240px] 2xl:[text-indent:320px]">
                Повышение качества жизни пациентов в реальности, невзирая на сложность задачи
            </h2>
        </div>

        <div class="mt-8 grid gap-6 lg:mt-12 lg:grid-cols-[minmax(0,1.05fr)_minmax(0,1fr)] lg:gap-12">
            <img src="{{ $aboutImage }}" alt="Процедурный кабинет клиники Арт-Медика" width="1200" height="800" loading="lazy"
                 class="h-[260px] w-full rounded-[24px] object-cover sm:h-[320px] lg:h-[480px] 2xl:h-[560px]">
            <div class="flex flex-col justify-center">
                <p class="text-[15px] leading-relaxed text-body sm:text-base lg:text-[17px] 2xl:text-[19px]">
                    «Арт-Медика» — многопрофильный медико-косметологический центр в Челябинске: поликлиническое отделение, стационар пластической хирургии, косметология, ЭСТЕТ-гинекология и оториноларингология в одном месте.
                </p>
                <p class="mt-4 text-[15px] leading-relaxed text-body sm:text-base lg:text-[17px] 2xl:text-[19px]">
                    Мы соединяем диагностику, лечение и эстетическую хирургию с современным оборудованием и программами реабилитации, чтобы пациент получал безопасный результат и внимание на каждом этапе.
                </p>
                <div class="mt-8 grid grid-cols-3 gap-3 sm:gap-4">
                    @foreach (array_slice((array) $aboutStats, 0, 3) as $stat)
                        <div class="rounded-2xl border border-border p-4 sm:p-5">
                            <div class="text-[24px] font-semibold text-ink sm:text-[32px] lg:text-[38px] 2xl:text-[44px]">{{ $stat['value'] ?? '' }}</div>
                            <div class="mt-1.5 text-[12px] leading-snug text-muted sm:text-[13px] lg:text-[14px] 2xl:text-[16px]">{{ $stat['label'] ?? '' }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= РЕЗУЛЬТАТЫ ОПЕРАЦИЙ ================= --}}
<section id="rezultaty" class="mt-14 px-4 sm:px-6 lg:mt-24">
    <div class="mx-auto w-full max-w-[1720px]">
        <div class="grid gap-4 lg:grid-cols-[1fr_2fr] lg:gap-10">
            <p class="inline-flex items-baseline gap-2 text-[18px] font-semibold text-steel lg:text-[22px] 2xl:text-[30px]">
                Результаты операций
                <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </p>
            <h2 class="text-[26px] font-semibold leading-[1.25] tracking-[-0.01em] text-brand sm:text-[32px] lg:text-[36px] 2xl:text-[44px] lg:[text-indent:240px] 2xl:[text-indent:320px]">
                Мы гордимся результатами, которых достигаем вместе с нашими пациентами благодаря современным методикам и золотым рукам хирургов. Убедитесь сами, как тонко и естественно мы умеем работать с красотой.
            </h2>
        </div>

        <div role="tablist" aria-label="Фильтр результатов по услугам" class="no-scrollbar mt-8 flex gap-2.5 overflow-x-auto lg:mt-10">
            <button data-tabfilter="all" data-tab-group="results" role="tab" aria-selected="true" class="shrink-0 whitespace-nowrap rounded-[10px] bg-brand px-6 py-3 text-[13px] font-medium text-white transition-colors hover:bg-brandh sm:text-[14px] lg:text-[16px]">Все</button>
            @foreach ($caseTabs as $tab)
                <button data-tabfilter="{{ $tab }}" data-tab-group="results" role="tab" aria-selected="false" class="shrink-0 whitespace-nowrap rounded-[10px] bg-surfaceh px-6 py-3 text-[13px] font-medium text-body transition-colors hover:bg-[#E2E7F1] sm:text-[14px] lg:text-[16px]">{{ $tab }}</button>
            @endforeach
        </div>

        <div id="results-track" data-tab-content="results" class="swiper mt-4 lg:mt-6" aria-label="Результаты операций"
             data-swiper='{"navigation":{"prevEl":"#results-prev","nextEl":"#results-next"},"spaceBetween":12,"breakpoints":{"1024":{"spaceBetween":16},"1920":{"spaceBetween":24}}}'>
            <div class="swiper-wrapper">
                @foreach ($cases as $case)
                    @php
                        $service = $case->service?->name ?: 'Все';
                        $caption = $case->title ?: 'Результат';
                    @endphp
                    <figure data-tag="{{ $service }}" class="{{ $case->service?->slug === 'mammo-1' ? 'case-natural' : '' }} swiper-slide gap-2 2xl:gap-2.5">
                        <img src="{{ $case->beforeUrl() }}" alt="{{ $caption }}: вид до" width="640" height="800" loading="lazy" class="h-[254px] w-1/2 min-w-0 rounded-2xl object-cover sm:h-[300px] lg:h-[360px] 2xl:h-[480px]">
                        <img src="{{ $case->afterUrl() }}" alt="{{ $caption }}: вид после" width="640" height="800" loading="lazy" class="h-[254px] w-1/2 min-w-0 rounded-2xl object-cover sm:h-[300px] lg:h-[360px] 2xl:h-[480px]">
                    </figure>
                @endforeach
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between lg:mt-8">
            <button type="button" id="results-prev" aria-label="Предыдущие фото" class="grid h-11 w-11 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:bg-brandh 2xl:h-14 2xl:w-14">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M19 12H5m0 0l6-6m-6 6l6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <button type="button" id="results-next" aria-label="Следующие фото" class="grid h-11 w-11 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:bg-brandh 2xl:h-14 2xl:w-14">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </div>
    </div>
</section>

{{-- ================= СПЕЦИАЛИСТЫ ================= --}}
<section id="spetsialisty" class="mt-14 px-4 sm:px-6 lg:mt-24">
    <div class="mx-auto w-full max-w-[1720px]">
        <div class="grid gap-4 lg:grid-cols-[1fr_2fr] lg:gap-10">
            <p class="inline-flex items-baseline gap-2 text-[18px] font-semibold text-steel lg:text-[22px] 2xl:text-[30px]">
                Наши специалисты
                <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </p>
            <h2 class="text-[26px] font-semibold leading-[1.25] tracking-[-0.01em] text-brand sm:text-[32px] lg:text-[36px] 2xl:text-[44px] lg:[text-indent:240px] 2xl:[text-indent:320px]">
                Команда профессионалов, постоянно растущих в своих направлениях
            </h2>
        </div>

        <div role="tablist" aria-label="Фильтр специалистов по отделениям" class="no-scrollbar mt-8 flex gap-2.5 overflow-x-auto lg:mt-10">
            <button data-tabfilter="all" data-tab-group="experts" role="tab" aria-selected="true" class="shrink-0 whitespace-nowrap rounded-[10px] bg-brand px-6 py-3 text-[13px] font-medium text-white transition-colors hover:bg-brandh sm:text-[14px] lg:text-[16px]">Все</button>
            @foreach ($expertTabs as $tab)
                <button data-tabfilter="{{ $tab }}" data-tab-group="experts" role="tab" aria-selected="false" class="shrink-0 whitespace-nowrap rounded-[10px] bg-surfaceh px-6 py-3 text-[13px] font-medium text-body transition-colors hover:bg-[#E2E7F1] sm:text-[14px] lg:text-[16px]">{{ $tab }}</button>
            @endforeach
        </div>

        <div id="experts-track" data-tab-content="experts" class="swiper mt-4 lg:mt-6" aria-label="Наши специалисты"
             data-swiper='{"navigation":{"prevEl":"#experts-prev","nextEl":"#experts-next"},"spaceBetween":12,"breakpoints":{"1024":{"spaceBetween":16}}}'>
            <div class="swiper-wrapper">
                @foreach ($experts as $expert)
                    <article data-tag="{{ $expert->department?->name ?: 'Все' }}" class="swiper-slide group relative aspect-[0.67] overflow-hidden rounded-2xl">
                        <img src="{{ $expert->avatarUrl() }}" alt="{{ $expert->name }}" width="560" height="640" loading="lazy"
                             class="absolute inset-0 h-full w-full object-cover object-top transition-transform duration-500 group-hover:scale-[1.03]">
                        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/80 via-black/25 to-transparent"></div>
                        <div class="relative z-10 flex h-full flex-col justify-end p-5 2xl:p-7">
                            <h3 class="text-[15px] font-semibold leading-snug text-white sm:text-[19px] 2xl:text-[23px]">{{ $expert->name }}</h3>
                            <p class="mt-1.5 text-[12px] leading-snug text-white/85 sm:text-[13px] 2xl:text-[15px]">{{ \Illuminate\Support\Str::limit($expert->position, 180, end: '…') }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between lg:mt-8">
            <button type="button" id="experts-prev" aria-label="Предыдущие специалисты" class="grid h-11 w-11 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:bg-brandh 2xl:h-14 2xl:w-14">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M19 12H5m0 0l6-6m-6 6l6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <button type="button" id="experts-next" aria-label="Следующие специалисты" class="grid h-11 w-11 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:bg-brandh 2xl:h-14 2xl:w-14">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </div>
    </div>
</section>

{{-- ================= ПРОЕКТЫ ================= --}}
<section id="proekty" class="mt-14 px-4 sm:px-6 lg:mt-24">
    <div class="mx-auto w-full max-w-[1720px]">
        <div class="grid gap-4 lg:grid-cols-[1fr_2fr] lg:gap-10">
            <a href="{{ route('projects') }}" class="inline-flex items-baseline gap-2 text-[18px] font-semibold text-steel transition-colors hover:text-brand lg:text-[22px] 2xl:text-[30px]">
                Проекты
                <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
            <h2 class="text-[26px] font-semibold leading-[1.25] tracking-[-0.01em] text-brand sm:text-[32px] lg:text-[36px] 2xl:text-[44px] lg:[text-indent:240px] 2xl:[text-indent:320px]">
                Собираем для вас актуальные проекты в сфере медицины и эстетической хирургии
            </h2>
        </div>

        @if ($projectBig)
            <div id="projects-track" class="swiper mt-8 lg:mt-12" aria-label="Проекты"
                 data-swiper='{"navigation":{"prevEl":"#projects-prev","nextEl":"#projects-next"},"spaceBetween":16,"breakpoints":{"1024":{"spaceBetween":20},"1920":{"spaceBetween":24}}}'>
                <div class="swiper-wrapper">
                    <article class="swiper-slide rounded-[20px] bg-surface p-4 sm:p-5 lg:grid-cols-[46%_1fr] lg:gap-6 lg:p-5 2xl:gap-8 2xl:p-6">
                        <a href="{{ route('projects') }}#project-{{ $projectBig->slug }}" class="block overflow-hidden rounded-[14px]">
                            <img src="{{ $projectBig->coverUrl() }}" alt="{{ $projectBig->title }}" width="1024" height="576"
                                 class="h-[240px] w-full object-cover transition-transform duration-500 hover:scale-[1.02] sm:h-[300px] lg:h-full">
                        </a>
                        <div class="flex min-w-0 flex-col pt-5 lg:py-1 lg:pr-6 2xl:pr-8">
                            <div class="flex items-start justify-between gap-4">
                                <a href="{{ route('projects') }}" class="text-[14px] text-body transition-colors hover:text-brand sm:text-[15px] 2xl:text-[16px]">Проекты</a>
                                <a href="{{ route('projects') }}#project-{{ $projectBig->slug }}" aria-label="Открыть проект «{{ $projectBig->title }}»" class="shrink-0 text-ink transition-colors hover:text-brand">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            </div>
                            <div class="my-auto py-5 lg:py-4">
                                <h3 class="text-[22px] font-semibold leading-tight text-ink sm:text-[26px] 2xl:text-[32px]">
                                    <a href="{{ route('projects') }}#project-{{ $projectBig->slug }}" class="transition-colors hover:text-brand">
                                        {{ $projectBig->title }}
                                    </a>
                                </h3>
                                <p class="mt-4 text-[14px] leading-relaxed text-body sm:text-[16px] 2xl:mt-5 2xl:text-[17px]">
                                    {{ \Illuminate\Support\Str::limit($projectBig->excerpt ?? '', 220, end: '…') }}
                                </p>
                            </div>
                            <p class="text-[14px] text-[#91B5D5] 2xl:text-[15px]">{{ $projectBig->published_at ? \Illuminate\Support\Carbon::parse($projectBig->published_at)->format('d.m.Y') : '' }}</p>
                        </div>
                    </article>

                    @foreach ($projectSmall as $project)
                        <article class="swiper-slide rounded-[20px] bg-surface p-4 sm:p-5">
                            <div class="flex items-start justify-between gap-3">
                                <a href="{{ route('projects') }}" class="text-[14px] text-body transition-colors hover:text-brand sm:text-[15px] 2xl:text-[16px]">Проекты</a>
                                <a href="{{ route('projects') }}#project-{{ $project->slug }}" aria-label="Открыть проект «{{ $project->title }}»" class="shrink-0 text-ink transition-colors hover:text-brand">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            </div>
                            <a href="{{ route('projects') }}#project-{{ $project->slug }}" class="mt-4 block overflow-hidden rounded-[14px]">
                                <img src="{{ $project->coverUrl() }}" alt="{{ $project->title }}" width="800" height="800" loading="lazy"
                                     class="h-[200px] w-full object-cover transition-transform duration-500 hover:scale-[1.03] sm:h-[240px] lg:h-[260px] 2xl:h-[360px]">
                            </a>
                            <h3 class="mt-5 line-clamp-2 text-[17px] font-semibold leading-snug text-ink sm:text-[19px] 2xl:text-[21px]">
                                <a href="{{ route('projects') }}#project-{{ $project->slug }}" class="transition-colors hover:text-brand">
                                    {{ $project->title }}
                                </a>
                            </h3>
                            <p class="mt-auto pt-4 text-[14px] text-[#91B5D5] 2xl:text-[15px]">{{ $project->published_at ? \Illuminate\Support\Carbon::parse($project->published_at)->format('d.m.Y') : '' }}</p>
                        </article>
                    @endforeach

                    @foreach ($projectFormats as $format)
                        <article class="swiper-slide rounded-[20px] bg-surface p-4 sm:p-5">
                            <div class="flex items-start justify-between gap-3">
                                <a href="{{ route('projects') }}" class="text-[14px] text-body transition-colors hover:text-brand sm:text-[15px] 2xl:text-[16px]">Проекты</a>
                                <a href="{{ route('projects') }}#project-{{ $projectBig->slug }}" aria-label="Открыть проект «{{ $format->title }}»" class="shrink-0 text-ink transition-colors hover:text-brand">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            </div>
                            <a href="{{ route('projects') }}#project-{{ $projectBig->slug }}" class="mt-4 block overflow-hidden rounded-[14px]">
                                <img src="{{ $format->coverUrl() }}" alt="{{ $format->title }}" width="800" height="800" loading="lazy"
                                     class="h-[200px] w-full object-cover transition-transform duration-500 hover:scale-[1.03] sm:h-[240px] lg:h-[260px] 2xl:h-[360px]">
                            </a>
                            <h3 class="mt-auto line-clamp-2 pt-5 text-[17px] font-semibold leading-snug text-ink sm:text-[19px] 2xl:text-[21px]">
                                <a href="{{ route('projects') }}#project-{{ $projectBig->slug }}" class="transition-colors hover:text-brand">
                                    {{ $format->title }}
                                </a>
                            </h3>
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between lg:mt-8">
                <button type="button" id="projects-prev" aria-label="Предыдущие проекты" class="grid h-11 w-11 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:bg-brandh 2xl:h-14 2xl:w-14">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M19 12H5m0 0l6-6m-6 6l6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <button type="button" id="projects-next" aria-label="Следующие проекты" class="grid h-11 w-11 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:bg-brandh 2xl:h-14 2xl:w-14">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
        @endif
    </div>
</section>

{{-- ================= НАША РАБОТА ================= --}}
<section id="rabota" class="mt-14 px-4 sm:px-6 lg:mt-24">
    <div class="mx-auto w-full max-w-[1720px]">
        <div class="grid gap-4 lg:grid-cols-[1fr_2fr] lg:gap-10">
            <p class="inline-flex items-baseline gap-2 text-[18px] font-semibold text-steel lg:text-[22px] 2xl:text-[30px]">
                Наша работа
                <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </p>
            <h2 class="text-[26px] font-semibold leading-[1.25] tracking-[-0.01em] text-brand sm:text-[32px] lg:text-[36px] 2xl:text-[44px] lg:[text-indent:240px] 2xl:[text-indent:320px]">
                Наша работа начинается с глубокой диагностики и детального планирования, а современное оборудование и сертифицированные материалы гарантируют безопасность на каждом этапе.
            </h2>
        </div>

        <a href="{{ $videoUrl }}" target="_blank" rel="noopener" aria-label="Смотреть видео о нашей работе (откроется в новом окне)"
           class="group relative mt-8 block h-[260px] overflow-hidden rounded-[20px] sm:h-[360px] lg:mt-12 lg:h-[460px] 2xl:h-[620px]">
            <img src="{{ $workImage }}" alt="Хирург за работой — кадр из видео клиники" width="1440" height="720" loading="lazy"
                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-[1.02]">
            <span class="absolute left-1/2 top-1/2 grid h-16 w-16 -translate-x-1/2 -translate-y-1/2 place-items-center rounded-[22px] bg-white/85 text-brand shadow-xl transition-colors group-hover:bg-brand group-hover:text-white sm:h-20 sm:w-20 2xl:h-24 2xl:w-24 2xl:rounded-[26px]">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5.5v13l11-6.5-11-6.5z"/></svg>
            </span>
        </a>
    </div>
</section>
{{-- ================= КЕЙСЫ КЛИЕНТОВ (отзывы) ================= --}}
<section id="otzyvy" class="mt-14 px-4 sm:px-6 lg:mt-24">
    <div class="mx-auto w-full max-w-[1720px]">
        <div class="grid gap-4 lg:grid-cols-[1fr_2fr] lg:gap-10">
            <p class="inline-flex items-baseline gap-2 text-[18px] font-semibold text-steel lg:text-[22px] 2xl:text-[30px]">
                Кейсы клиентов
                <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </p>
            <h2 class="text-[26px] font-semibold leading-[1.25] tracking-[-0.01em] text-brand sm:text-[32px] lg:text-[36px] 2xl:text-[44px] lg:[text-indent:240px] 2xl:[text-indent:320px]">
                Высокий уровень доверия и качества медицинской помощи подтверждает рейтинг нашей клиники — 4,5 на основе 118 отзывов о врачах на сайте «ПроДокторов».
            </h2>
        </div>

        @if ($reviews->isNotEmpty())
            <div id="reviews-track" class="swiper mt-8 lg:mt-12" aria-label="Отзывы клиентов"
                 data-swiper='{"navigation":{"prevEl":"#reviews-prev","nextEl":"#reviews-next"},"spaceBetween":16,"breakpoints":{"1024":{"spaceBetween":32}}}'>
                <div class="swiper-wrapper">
                    @foreach ($reviews as $review)
                        <article class="swiper-slide rounded-2xl bg-surface p-5 sm:p-7 2xl:p-9">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-[20px] font-semibold leading-tight text-ink sm:text-[22px] 2xl:text-[26px]">{{ $review->author_name }}</h3>
                                <div class="mt-1.5 flex items-center gap-[3px]" aria-label="Оценка: {{ $review->rating }} из 5">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" class="{{ $i <= (int) $review->rating ? 'text-ink' : 'text-[#D7DEEA]' }} sm:h-[17px] sm:w-[17px] 2xl:h-5 2xl:w-5" aria-hidden="true"><path d="M12 2.5l2.9 6 6.6.9-4.8 4.6 1.2 6.5-5.9-3.1-5.9 3.1 1.2-6.5L2.5 9.4l6.6-.9 2.9-6z"/></svg>
                                    @endfor
                                </div>
                            </div>
                            <a href="https://prodoctorov.ru" target="_blank" rel="noopener" aria-label="Читать отзыв на ПроДокторов"
                               class="shrink-0 text-[#B9C3D6] transition-colors hover:text-steel">
                                <svg class="h-7 w-7 sm:h-8 sm:w-8 2xl:h-9 2xl:w-9" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>

                        <div class="mt-4 grid gap-4 sm:mt-5 sm:grid-cols-2 sm:gap-5 2xl:gap-7">
                            <div>
                                <h4 class="text-[15px] font-semibold text-ink sm:text-[16px] 2xl:text-[17px]">История пациента</h4>
                                <p class="mt-1.5 text-[14px] leading-snug text-body 2xl:text-[16px]">{{ \Illuminate\Support\Str::limit($review->history, 180, end: '…') }}</p>
                            </div>
                            <div>
                                <h4 class="text-[15px] font-semibold text-ink sm:text-[16px] 2xl:text-[17px]">Понравилось</h4>
                                <p class="mt-1.5 text-[14px] leading-snug text-body 2xl:text-[16px]">{{ \Illuminate\Support\Str::limit($review->liked, 140, end: '…') }}</p>
                            </div>
                        </div>

                        <p class="mt-auto pt-5 text-[14px] text-steel sm:pt-6 2xl:text-[16px]">{{ $review->published_at?->format('d.m.Y') }}</p>
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between lg:mt-8 mb-[120px]">
                <button type="button" id="reviews-prev" aria-label="Предыдущие отзывы" class="grid h-11 w-11 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:bg-brandh 2xl:h-14 2xl:w-14">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M19 12H5m0 0l6-6m-6 6l6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <button type="button" id="reviews-next" aria-label="Следующие отзывы" class="grid h-11 w-11 place-items-center rounded-[10px] bg-brand text-white transition-opacity hover:bg-brandh 2xl:h-14 2xl:w-14">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m0 0l-6-6m6 6l-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
        @endif
    </div>
</section>

<x-footer></x-footer>

<script>
    document.querySelectorAll('[data-tabfilter]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var group = btn.dataset.tabGroup;
            var active = ['bg-brand', 'text-white', 'hover:bg-brandh'];
            var idle = ['bg-surfaceh', 'hover:bg-[#E2E7F1]'];
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
</script>
</body>
</html>
