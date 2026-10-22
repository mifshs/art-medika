<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проекты — Арт-Медика</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-page font-sans text-body antialiased">

@include('components.header')

<main class="mx-auto w-full max-w-[1720px] px-4 pb-16 sm:px-6 md:px-10 2xl:px-0">
    {{-- Хлебные крошки --}}
    <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-6 text-[15px] text-body">
        <a href="{{ url('/') }}" class="transition-colors hover:text-brand">Арт-Медика</a>
        <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto" aria-hidden="true">
        <span class="font-medium text-ink">Проекты</span>
    </nav>

    {{-- Заголовок + вводный текст --}}
    <div class="flex flex-col items-start justify-between gap-6 pt-10 lg:flex-row lg:items-start lg:gap-10 2xl:pt-[52px]">
        <h1 class="flex shrink-0 items-center gap-2 text-[28px] font-medium leading-none text-[#91B5D5] sm:text-[34px] lg:text-[40px]">
            Проекты
            <img src="{{ asset('images/Arrow_right_light.svg') }}" alt="" class="w-[30px] sm:w-[38px] lg:w-[50px]" aria-hidden="true">
        </h1>
        <p class="max-w-[1140px] text-[22px] font-medium leading-tight text-[#1D293D] sm:text-[28px] lg:text-[36px] 2xl:text-[40px]">
            Подбираем для вас самые актуальные
            и интересные проекты из нашей практики, медицины
            и эстетической хирургии, с заботой о вас
        </p>
    </div>

    {{-- Список проектов --}}
    @if ($projects->isNotEmpty())
        <div class="mt-10 space-y-5 2xl:mt-12 2xl:space-y-6">
            @foreach ($projects as $project)
                <x-project-card :project="$project" />
            @endforeach
        </div>
    @else
        <div class="mt-10 rounded-[24px] bg-surface px-8 py-16 text-center">
            <p class="text-[20px] font-medium text-ink">Активных проектов пока нет</p>
            <p class="mt-2 text-[15px] text-muted">Заглядывайте позже — мы регулярно добавляем новые проекты.</p>
        </div>
    @endif
</main>

@include('components.footer')
</body>
</html>
