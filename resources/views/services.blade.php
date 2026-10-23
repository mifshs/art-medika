<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Направления клиники «Арт-Медика»: пластическая хирургия, косметология, дерматология, ЛОР-хирургия и другие медицинские и эстетические услуги.">
    <title>Услуги — Арт-Медика</title>
    {{-- Шрифт макета — Onest, применяется на странице «Услуги» --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-page font-onest text-body antialiased">
    @include('components.header')

    <main class="mx-auto w-full max-w-[1720px] px-4 pb-20 sm:px-6 md:px-10 2xl:px-0">
        {{-- Хлебные крошки (макет: Onest 18px, #37241B; «Услуги» — weight 500) --}}
        <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-6 text-[18px] text-brand">
            <a href="{{ url('/') }}" rel="home" class="transition-colors duration-200 hover:text-brandh">Арт-Медика</a>
            <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto" aria-hidden="true">
            <span class="font-medium">Услуги</span>
        </nav>

        {{-- Заголовок страницы + описание (макет: 24/32 мобайл, 40/52 десктоп; отступ первой строки 97/290) --}}
        <div class="flex flex-col items-start justify-between max-sm:gap-1 gap-8 max-sm:pt-8 lg:pt-10 lg:flex-row lg:items-start 2xl:pt-[52px]">
            <h1 class="flex shrink-0 items-center gap-2 text-[24px] font-medium leading-[32px] text-[#91B5D5] lg:text-[40px] lg:leading-[52px]">
                Услуги
                <img src="{{ asset('images/Arrow_right_light.svg') }}" alt="" class="w-[50px] max-lg:w-[38px]" aria-hidden="true">
            </h1>
            <p class="max-w-[1140px] text-[24px] font-medium leading-[32px] text-brand [text-indent:25%] lg:text-[40px] lg:leading-[52px] lg:[text-indent:290px]">
                {{ $intro }}
            </p>
        </div>

        {{-- Направления из БД (макет: шаг карточек 380 мобайл / 647 десктоп) --}}
        @if ($categories->isNotEmpty())
            <div class="mt-12 grid gap-x-10 gap-y-6 sm:grid-cols-2 sm:gap-y-12 2xl:mt-12">
                @foreach ($categories as $category)
                    <x-service-category-card :category="$category" />
                @endforeach
            </div>
        @else
            <div class="mt-12 rounded-[24px] bg-surface px-8 py-16 text-center">
                <p class="text-[20px] font-medium text-ink">Направления появятся в ближайшее время</p>
                <p class="mt-2 text-[15px] text-muted">Администраторы клиники скоро наполнят этот раздел.</p>
            </div>
        @endif
    </main>

    @include('components.footer')
</body>
</html>
