<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <x-seo-head
        title="Документы и лицензии — Медико-косметологический центр «Арт-Медика»"
        description="Официальные документы, медицинские лицензии, нормативно-правовая информация и реквизиты клиники «Арт-Медика»."
        keywords="документы Арт-Медика, медицинская лицензия, реквизиты клиники, правила платных медицинских услуг"
    />
</head>
<body class="bg-page font-onest text-body antialiased">

<x-header></x-header>

<main id="main-content" class="mx-auto w-full max-w-[1720px] px-4 pb-16 sm:px-6 md:px-10 lg:pb-24 2xl:px-0">
    {{-- Хлебные крошки (макет: Onest 18px, цвет #37241B) --}}
    <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-5 text-[15px] text-brand sm:pt-6 sm:text-[16px] 2xl:text-[18px]">
        <a href="{{ url('/') }}" class="transition-colors duration-200 hover:text-brandh">Арт-Медика</a>
        <img src="{{ asset('images/_.svg') }}" width="7" height="10" alt="" class="h-3 w-auto" aria-hidden="true">
        <span class="font-medium">Документы</span>
    </nav>

    {{-- Заголовок страницы: «Документы ↗» (макет: Onest 40px, medium, цвет #91B5D5) --}}
    <div class="mt-7 sm:mt-8 lg:mt-12">
        <h1 class="inline-flex items-baseline gap-2 text-[24px] font-medium text-[#4A749B] sm:text-[28px] lg:text-[32px] 2xl:text-[40px]">
            Документы
            <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M7 17L17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </h1>
    </div>

    {{-- Список аккордеонов по категориям документов (данные из базы данных) --}}
    @if ($documentsGrouped->isNotEmpty())
        <div class="mt-8 space-y-4 sm:mt-10 sm:space-y-5 lg:mt-12 lg:space-y-6">
            @foreach ($documentsGrouped as $categoryName => $docs)
                @php
                    // По макету категория «Нормативно-правовые документы» раскрыта по умолчанию, остальные свернуты
                    $isOpen = (mb_stripos($categoryName, 'Нормативно-правовые') !== false) || ($loop->count === 1);
                @endphp

                <div x-data="{ open: @json($isOpen) }"
                     class="rounded-[16px] bg-[#F4F7FD] transition-all duration-300 sm:rounded-[20px] 2xl:rounded-[24px]">
                    {{-- Шапка аккордеона категории --}}
                    <button type="button"
                            @click="open = !open"
                            :aria-expanded="open"
                            class="no-scale flex w-full cursor-pointer items-center justify-between gap-4 rounded-[16px] px-5 py-4 text-left transition-colors duration-300 ease-out hover:bg-[#EAEFF9] hover:text-brand active:bg-[#E1E8F6] sm:rounded-[20px] sm:px-8 sm:py-6 2xl:rounded-[24px] 2xl:px-10 2xl:py-7">
                        <span class="text-[17px] font-semibold leading-tight text-body sm:text-[20px] lg:text-[22px] 2xl:text-[26px]">
                            {{ $categoryName }}
                        </span>

                        {{-- Стрелка аккордеона: при открытии поворачивается вверх ↑ (по макету) --}}
                        <span class="inline-flex h-7 w-7 shrink-0 items-center justify-center text-[#1A1A1A] transition-transform duration-[450ms] ease-[cubic-bezier(0.22,1,0.36,1)]"
                              :class="{ 'rotate-180': open }">
                            <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 5v14M19 12l-7 7-7-7"/>
                            </svg>
                        </span>
                    </button>

                    {{-- Содержимое категории: список файлов для скачивания --}}
                    <div x-show="open" x-collapse.duration.450ms x-cloak>
                        <div class="px-5 pb-5 pt-1 transition-opacity duration-[450ms] ease-out sm:px-8 sm:pb-7 2xl:px-10 2xl:pb-8"
                             :class="open ? 'opacity-100' : 'opacity-0'">
                            <div class="divide-y divide-[#E4E7EE]/60">
                                @foreach ($docs as $doc)
                                    <x-document-item :document="$doc" />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Состояние: нет добавленных документов --}}
        <div class="mt-12 rounded-[20px] bg-[#F4F7FD] px-8 py-16 text-center">
            <p class="text-[20px] font-medium text-ink">Документы пока не опубликованы</p>
            <p class="mt-2 text-[15px] text-muted">Заглядывайте позже — мы регулярно обновляем документацию клиники.</p>
        </div>
    @endif
</main>

<x-footer></x-footer>

</body>
</html>
