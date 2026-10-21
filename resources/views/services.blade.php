<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Направления клиники «Арт-Медика»: пластическая хирургия, косметология, дерматология, ЛОР-хирургия и другие медицинские и эстетические услуги.">
    <title>Услуги — Арт-Медика</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('components.header')

    <main class="mx-auto w-full max-w-[1720px] px-4 pb-20 sm:px-6 md:px-10 2xl:px-0">
        {{-- Хлебные крошки --}}
        <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-6 text-[15px] text-brand">
            <a href="{{ url('/') }}" rel="home" class="transition-colors hover:text-brandh">Арт-Медика</a>
            <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto" aria-hidden="true">
            <span class="font-medium">Услуги</span>
        </nav>

        {{-- Заголовок страницы + описание --}}
        <div class="flex flex-col items-start justify-between gap-8 pt-10 lg:flex-row lg:items-start 2xl:pt-[52px]">
            <h1 class="flex shrink-0 items-center gap-2 text-[40px] font-medium leading-none text-[#91B5D5] max-lg:text-3xl">
                Услуги
                <img src="{{ asset('images/Arrow_right_light.svg') }}" alt="" class="w-[50px] max-lg:w-[38px]" aria-hidden="true">
            </h1>
            <p class="max-w-[1140px] text-[40px] font-medium leading-tight text-brand [text-indent:25%] max-lg:text-2xl">
                {{ $intro }}
            </p>
        </div>

        {{-- Направления из БД --}}
        @if ($categories->isNotEmpty())
            <div class="mt-12 grid gap-x-10 gap-y-12 sm:grid-cols-2 sm:gap-y-14 2xl:mt-12">
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
