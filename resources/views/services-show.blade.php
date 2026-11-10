<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Услуги направления «{{ $category->name }}» в клинике «Арт-Медика».">
    <title>{{ $category->name }} — Услуги — Арт-Медика</title>
    {{-- Шрифт Onest --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-page font-onest text-body antialiased">
    @include('components.header')

    <main class="mx-auto w-full max-w-[1720px] px-4 pb-20 sm:px-6 md:px-10 2xl:px-0">
        {{-- Хлебные крошки (макет: Onest 18px/15px, #37241B) --}}
        <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-6 text-[15px] text-brand sm:text-[18px]">
            <a href="{{ url('/') }}" rel="home" class="transition-colors duration-200 hover:text-brandh">Арт-Медика</a>
            <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto" aria-hidden="true">
            <a href="{{ route('services') }}" class="whitespace-nowrap transition-colors duration-200 hover:text-brandh">Услуги</a>
            <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto shrink-0" aria-hidden="true">
            <span class="font-medium text-brand">{{ $category->name }}</span>
        </nav>

        {{-- Заголовок страницы + описание: весь текст сверху 40px (на мобилке 20px) --}}
        <div class="flex flex-col items-start justify-between gap-4 pt-8 lg:flex-row lg:items-start lg:gap-8 lg:pt-10 2xl:pt-[52px]">
            <h1 class="flex shrink-0 items-center gap-2 text-[20px] font-medium leading-[1.2] text-[#91B5D5] sm:text-[28px] lg:text-[40px]">
                {{ $category->name }}
                <img src="{{ asset('images/Arrow_right_light.svg') }}" alt="" class="w-[30px] sm:w-[38px] lg:w-[50px]" aria-hidden="true">
            </h1>
            @php
                $introText = $category->description ?: 'Подбираем для вас самые актуальные и интересные проекты из нашей практики, медицины и эстетической хирургии, с заботой о вас.';
            @endphp
            <p class="max-w-[1140px] text-[20px] font-medium leading-[1.25] text-brand sm:text-[28px] lg:text-[40px] lg:leading-[1.2]">
                {{ $introText }}
            </p>
        </div>

        @php
            // Дочерние подкатегории для карточек (исключаем техгруппу консультаций, если она есть)
            $subcategories = $category->children
                ->filter(fn ($c) => $c->is_active && $c->slug !== 'plasticheskaya-i-esteticheskaya-hirurgiya')
                ->values();
        @endphp

        {{-- Карточки услуг направления: вертикальный отступ 20px между карточками --}}
        @if ($subcategories->isNotEmpty())
            <div class="mt-8 flex flex-col gap-5 lg:mt-12">
                @foreach ($subcategories as $item)
                    @php
                        $cover = $item->coverUrl();
                        // Заглушка ссылки или ссылка на конкретную услугу/поднаправление
                        $itemUrl = $item->slug ? url('/uslugi/' . $item->slug) : '#';
                    @endphp

                    {{-- Карточка: размер до 1720x440 на десктопе, внутренний отступ 20px, фон #F3F4FB --}}
                    <article class="flex w-full flex-col justify-between gap-5 rounded-[24px] bg-surface p-5 sm:p-5 lg:min-h-[440px] lg:flex-row lg:items-stretch lg:gap-8">
                        {{-- Левая колонка: Заголовок 36px, кнопка «Подробнее» --}}
                        <div class="flex flex-col justify-between max-lg:gap-4 lg:w-[260px] lg:shrink-0 xl:w-[300px]">
                            <h2 class="text-[20px] font-medium leading-tight text-ink sm:text-[26px] lg:text-[36px]">
                                {{ $item->name }}
                            </h2>

                            <div class="hidden lg:block">
                                <a href="{{ $itemUrl }}"
                                   class="inline-flex items-center justify-center rounded-full bg-brand px-8 py-3.5 text-[16px] font-semibold text-white transition-colors hover:bg-brandh focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand">
                                    Подробнее
                                </a>
                            </div>
                        </div>

                        {{-- Центральная колонка: Текст на карточке 20px (на мобиле скрыт/адаптирован как в макете) --}}
                        <div class="hidden flex-1 items-center justify-center px-4 lg:flex">
                            @if ($item->description)
                                <p class="max-w-[460px] text-[20px] font-normal leading-relaxed text-ink">
                                    {{ $item->description }}
                                </p>
                            @endif
                        </div>

                        {{-- Правая колонка: Картинка со скруглением краев 10px --}}
                        <div class="relative h-[200px] w-full shrink-0 overflow-hidden rounded-[10px] bg-hero sm:h-[260px] lg:h-auto lg:w-[480px] xl:w-[540px] 2xl:w-[560px]">
                            @if ($cover)
                                <img src="{{ $cover }}" alt="{{ $item->name }}" loading="lazy"
                                     class="h-full w-full rounded-[10px] object-cover">
                            @else
                                <div class="grid h-full w-full place-items-center rounded-[10px] bg-[#E9ECF4]">
                                    <span class="font-serif text-[24px] italic font-semibold tracking-tight text-brand">Арт-Медика</span>
                                </div>
                            @endif
                        </div>

                        {{-- Кнопка «Подробнее» для планшетов и мобилок под карточкой/картинкой (если нужна) --}}
                        <div class="block lg:hidden">
                            <a href="{{ $itemUrl }}"
                               class="inline-flex w-full items-center justify-center rounded-full bg-brand px-6 py-3 text-[15px] font-semibold text-white transition-colors hover:bg-brandh">
                                Подробнее
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="mt-12 rounded-[24px] bg-surface px-8 py-16 text-center">
                <p class="text-[20px] font-medium text-ink">Список услуг появится в ближайшее время</p>
                <p class="mt-2 text-[15px] text-muted">Уточните детали по телефону {{ \App\Models\Setting::get('contacts', [])['phone'] ?? '' }}.</p>
            </div>
        @endif

        {{-- Ссылки-заглушки к остальным направлениям клиники --}}
        @php
            $otherCategories = \App\Models\ServiceCategory::roots()
                ->where('id', '!=', $category->id)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();
        @endphp

     
    </main>

    @include('components.footer')
</body>
</html>
