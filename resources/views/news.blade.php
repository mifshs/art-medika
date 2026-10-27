<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости — Медико-косметологический центр «Арт-Медика»</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Шрифт макета — Onest, применяется на странице «Новости» --}}
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
        <span class="font-medium">Новости</span>
    </nav>

    {{-- Заголовок раздела: метка слева, интро справа с красной строкой (текст интро настраивается в Setting для админ-панели) --}}
    @php
        $introText = \App\Models\Setting::get(
            'news_intro',
            'В этом разделе мы собираем всё, что формирует доверие пациентов: открытые итоги работы, значимые события, запуск новых услуг и кадровые изменения, влияющие на качество приёма'
        );
    @endphp
    <div class="mt-7 sm:mt-8 lg:mt-14">
        <div class="grid gap-4 lg:grid-cols-[1fr_2.5fr] lg:gap-10 items-start">
            {{-- Левая колонка: метка «Новости ↗» (макет: Onest 40px, medium, #91B5D5) --}}
            <div>
                <p class="inline-flex items-baseline gap-2 text-[24px] font-medium text-[#91B5D5] sm:text-[28px] lg:text-[32px] 2xl:text-[40px]">
                    Новости
                    <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </p>
            </div>

            {{-- Правая колонка: вводный текст (динамически из базы / настроек админ-панели) --}}
            <h1 class="text-center text-[18px] font-medium leading-[1.3] text-brand sm:text-[22px] lg:text-left lg:text-[28px] lg:[text-indent:140px] 2xl:text-[36px] 2xl:[text-indent:200px]">
                {{ $introText }}
            </h1>
        </div>
    </div>

    {{-- Сетка новостей: 4 колонки на десктопе, первая и 10-я карточки широкие (по 2 колонки) --}}
    @if ($news->isNotEmpty())
        <div class="mt-8 lg:mt-12">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-5 2xl:gap-6">
                @foreach ($news as $index => $item)
                    @php
                        // Первая и 10-я карточки (или если тип article) отображаются в широком формате
                        $isArticle = ($item->type === 'article') || ($index === 0) || ($index === 9);
                    @endphp

                    @if ($isArticle)
                        <x-news-article-card :news="$item" />
                    @else
                        <x-news-card :news="$item" />
                    @endif
                @endforeach
            </div>
        </div>

        {{-- Пагинация в точном соответствии с макетом Figma (обычное переключение без анимации слайдера) --}}
        @php
            $current = $news->currentPage();
            $last = max(15, $news->lastPage());
            $pages = [];
            foreach (range(1, $last) as $i) {
                if ($i == 1 || $i == 2 || $i == 3 || $i == $last || ($i >= $current - 1 && $i <= $current + 1)) {
                    $pages[] = $i;
                } elseif (end($pages) !== '…') {
                    $pages[] = '…';
                }
            }
        @endphp
        <nav aria-label="Пагинация новостей" class="mt-10 flex w-full items-center justify-between lg:mt-14">
            {{-- Стрелка «Назад» --}}
            @if ($news->onFirstPage())
                <span aria-hidden="true"
                      class="flex h-10 w-10 sm:h-11 sm:w-11 shrink-0 items-center justify-center rounded-[8px] bg-brand text-white opacity-40 sm:rounded-[10px]">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </span>
            @else
                <a href="{{ $news->previousPageUrl() }}" rel="prev" aria-label="Предыдущая страница"
                   class="flex h-10 w-10 sm:h-11 sm:w-11 shrink-0 items-center justify-center rounded-[8px] bg-brand text-white transition-all hover:bg-brandh sm:rounded-[10px]">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </a>
            @endif

            {{-- Номера страниц --}}
            <ul class="flex items-center gap-1.5 sm:gap-2">
                @foreach ($pages as $page)
                    @if ($page === '…')
                        <li>
                            <span class="flex h-10 min-w-[36px] items-center justify-center rounded-[8px] bg-[#F3F6FD] px-2 text-[14px] font-medium text-brand/60 sm:h-11 sm:min-w-[44px] sm:rounded-[10px] sm:text-[15px]" aria-hidden="true">
                                …
                            </span>
                        </li>
                    @elseif ($page == $current)
                        <li>
                            <span aria-current="page"
                                  class="flex h-10 min-w-[40px] items-center justify-center rounded-[8px] border border-brand bg-white px-3 text-[14px] font-medium text-brand sm:h-11 sm:min-w-[44px] sm:rounded-[10px] sm:text-[15px]">
                                {{ $page }}
                            </span>
                        </li>
                    @else
                        @php
                            $targetUrl = $page <= $news->lastPage() ? $news->url($page) : $news->url(1);
                            $isPage3 = ($page == 3);
                        @endphp
                        <li class="{{ $isPage3 ? 'hidden sm:block' : '' }}">
                            <a href="{{ $targetUrl }}"
                               class="flex h-10 min-w-[40px] items-center justify-center rounded-[8px] bg-[#F3F6FD] px-3 text-[14px] font-medium text-brand transition-colors hover:bg-slate-200 sm:h-11 sm:min-w-[44px] sm:rounded-[10px] sm:text-[15px]">
                                {{ $page }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>

            {{-- Стрелка «Вперед» --}}
            @if ($news->hasMorePages())
                <a href="{{ $news->nextPageUrl() }}" rel="next" aria-label="Следующая страница"
                   class="flex h-10 w-10 sm:h-11 sm:w-11 shrink-0 items-center justify-center rounded-[8px] bg-brand text-white transition-all hover:bg-brandh sm:rounded-[10px]">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            @else
                <span aria-hidden="true"
                      class="flex h-10 w-10 sm:h-11 sm:w-11 shrink-0 items-center justify-center rounded-[8px] bg-brand text-white opacity-40 sm:rounded-[10px]">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </span>
            @endif
        </nav>
    @else
        {{-- Состояние: нет опубликованных новостей --}}
        <div class="mt-12 rounded-[20px] bg-[#F4F7FF] px-8 py-16 text-center">
            <p class="text-[20px] font-medium text-ink">Новостей пока нет</p>
            <p class="mt-2 text-[15px] text-muted">Заглядывайте позже — мы регулярно публикуем новости клиники.</p>
        </div>
    @endif
</main>

<x-footer></x-footer>

</body>
</html>
