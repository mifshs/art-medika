<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вопросы и ответы — Медико-косметологический центр «Арт-Медика»</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Шрифт макета — Onest --}}
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-page font-onest text-body antialiased">

<x-header></x-header>

<main class="mx-auto w-full max-w-[1720px] px-4 pb-14 sm:px-6 md:px-10 lg:pb-24 2xl:px-0">
    {{-- Хлебные крошки (макет: Onest 18px, цвет #37241B) --}}
    <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-5 text-[15px] text-brand sm:pt-6 sm:text-[16px] 2xl:text-[18px]">
        <a href="{{ url('/') }}" class="transition-colors duration-200 hover:text-brandh">Арт-Медика</a>
        <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto" aria-hidden="true">
        <span class="font-medium">Вопросы и ответы</span>
    </nav>

    {{-- Заголовок раздела: метка слева, интро справа (динамически из базы / настроек админ-панели) --}}
    @php
        $introText = \App\Models\Setting::get(
            'faq_intro',
            'Прозрачность медицинской помощи начинается с понятных ответов на сложные вопросы. Мы собрали самые частые обращения пациентов и детальные разъяснения наших врачей'
        );
    @endphp
    <div class="mt-7 sm:mt-8 lg:mt-14">
        <div class="grid gap-4 lg:grid-cols-[1fr_2.5fr] lg:gap-10 items-start">
            {{-- Левая колонка: метка «Вопросы и ответы ↗» (макет: Onest 40px, medium, #91B5D5) --}}
            <div>
                <p class="inline-flex items-baseline gap-2 text-[24px] font-medium text-[#91B5D5] sm:text-[28px] lg:text-[32px] 2xl:text-[40px]">
                    Вопросы и ответы
                    <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </p>
            </div>

            {{-- Правая колонка: вводный текст дословно из макета --}}
            <h1 class="text-center text-[18px] font-medium leading-[1.3] text-brand sm:text-[22px] lg:text-left lg:text-[28px] lg:[text-indent:140px] 2xl:text-[36px] 2xl:[text-indent:200px]">
                {{ $introText }}
            </h1>
        </div>
    </div>

    {{-- Список вопросов и ответов (аккордеон, данные из базы данных) --}}
    @if ($faqs->isNotEmpty())
        <div class="mt-8 space-y-3 sm:mt-10 sm:space-y-4 lg:mt-14">
            @foreach ($faqs as $faq)
                <x-faq-item :faq="$faq" :open="$loop->first" />
            @endforeach
        </div>
    @else
        {{-- Состояние: нет добавленных вопросов --}}
        <div class="mt-12 rounded-[20px] bg-[#F4F7FF] px-8 py-16 text-center">
            <p class="text-[20px] font-medium text-ink">Вопросы пока не добавлены</p>
            <p class="mt-2 text-[15px] text-muted">Заглядывайте позже — мы регулярно обновляем информацию.</p>
        </div>
    @endif
</main>

<x-footer></x-footer>

</body>
</html>
