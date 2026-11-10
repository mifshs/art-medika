<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Услуги направления «{{ $category->name }}» в клинике «Арт-Медика».">
    <title>{{ $category->name }} — Арт-Медика</title>
    {{-- Шрифт Onest --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-page font-onest text-body antialiased">
    @include('components.header')

    <main class="mx-auto w-full max-w-[1720px] px-4 pb-20 sm:px-6 md:px-10 2xl:px-0">
        {{-- Хлебные крошки (Арт-Медика > Услуги > Пластическая хирургия > Название подгруппы) --}}
        <nav aria-label="Хлебные крошки" class="flex flex-wrap items-center gap-2 pt-6 text-[15px] text-brand sm:text-[18px]">
            <a href="{{ url('/') }}" rel="home" class="transition-colors duration-200 hover:text-brandh">Арт-Медика</a>
            <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto" aria-hidden="true">
            <a href="{{ route('services') }}" class="whitespace-nowrap transition-colors duration-200 hover:text-brandh">Услуги</a>
            @if ($category->parent)
                <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto shrink-0" aria-hidden="true">
                <a href="{{ route('services.show', $category->parent->slug) }}" class="whitespace-nowrap transition-colors duration-200 hover:text-brandh">{{ $category->parent->name }}</a>
            @endif
            <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto shrink-0" aria-hidden="true">
            <span class="font-medium text-brand">{{ $category->name }}</span>
        </nav>

        {{-- Заголовок страницы со стрелкой --}}
        <div class="pt-8 lg:pt-10 2xl:pt-[52px]">
            <h1 class="flex items-center gap-2 text-[24px] font-medium leading-none text-[#91B5D5] sm:text-[32px] lg:text-[40px]">
                {{ $category->name }}
                <img src="{{ asset('images/Arrow_right_light.svg') }}" alt="" class="w-[32px] sm:w-[40px] lg:w-[50px]" aria-hidden="true">
            </h1>
        </div>

        {{-- Если есть услуги (например, Пластика лица: 6 карточек) --}}
        @if ($services->isNotEmpty())
            {{-- Сетка карточек: 3 колонки на десктопе, 1 колонка на мобилке (420px), отступы 20px --}}
            <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 lg:mt-12">
                @foreach ($services as $service)
                    <a href="{{ route('services.show', $service->slug) }}"
                       class="group flex h-[180px] w-full items-center justify-center rounded-[24px] bg-surface px-6 text-center transition-all duration-200 hover:bg-[#E9ECF8] hover:shadow-md sm:h-[210px] lg:h-[244px] lg:max-w-[559px]">
                        <span class="text-[24px] font-medium leading-snug text-ink transition-colors group-hover:text-brand sm:text-[30px] lg:text-[40px]">
                            {{ $service->name }}
                        </span>
                    </a>
                @endforeach
            </div>
        @else
            {{-- Страница-заглушка для карточек, в которые ещё не добавили услуги --}}
            <div class="mt-8 rounded-[24px] bg-surface px-6 py-16 text-center lg:mt-12 lg:py-24">
                <div class="mx-auto max-w-[620px]">
                    <div class="mx-auto mb-6 grid h-16 w-16 place-items-center rounded-full bg-white text-brand shadow-sm sm:h-20 sm:w-20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 sm:h-10 sm:w-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h2 class="text-[24px] font-medium leading-tight text-ink sm:text-[32px] lg:text-[36px]">
                        Раздел в процессе наполнения
                    </h2>
                    <p class="mt-4 text-[16px] leading-relaxed text-muted sm:text-[20px]">
                        Мы пока не добавили список услуг для данного раздела. Вся подробная информация, стоимость и консультации уже доступны у администраторов клиники.
                    </p>
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                        <a href="{{ route('services.show', $category->parent?->slug ?? 'plasticheskaya-hirurgiya') }}"
                           class="inline-flex items-center gap-2 rounded-full bg-brand px-7 py-3.5 text-[15px] font-semibold text-white transition-colors hover:bg-brandh">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                            </svg>
                            Вернуться назад
                        </a>
                        @php
                            $phone = \App\Models\Setting::get('contacts', [])['phone'] ?? '';
                            $phoneTel = preg_replace('/\D+/', '', $phone);
                        @endphp
                        @if ($phone)
                            <a href="tel:{{ $phoneTel }}"
                               class="inline-flex items-center gap-2 rounded-full border border-border bg-white px-7 py-3.5 text-[15px] font-semibold text-ink transition-colors hover:border-brand hover:text-brand">
                                Позвонить в клинику
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif

   
    </main>

    @include('components.footer')
</body>
</html>
