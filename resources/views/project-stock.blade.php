<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Акции</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-page font-onest text-body antialiased">
    @include('components.header')

    <main class="mx-auto w-full max-w-[1720px] px-4 pb-16 sm:px-6 md:px-10 2xl:px-0">
        {{-- Хлебные крошки --}}
        <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-6 text-[15px] sm:text-[18px] text-brand">
            <a href="{{ url('/') }}" class="transition-colors hover:text-brandh">Арт-Медика</a>
            <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto" aria-hidden="true">
            <span class="font-medium text-brand">Акции</span>
        </nav>

        {{-- Заголовок + вводный текст --}}
        <div class="flex flex-col items-start justify-between gap-6 pt-8 lg:pt-10 lg:flex-row lg:items-start 2xl:pt-[52px]">
            <h1 class="flex shrink-0 items-center gap-2 text-[24px] sm:text-[28px] lg:text-[34px] 2xl:text-[40px] font-medium leading-none text-[#91B5D5]">
                Акции
                <img src="{{ asset('images/Arrow_right_light.svg') }}" alt="" class="w-[32px] sm:w-[38px] 2xl:w-[50px]" aria-hidden="true">
            </h1>
            <p class="max-w-[1140px] text-[22px] sm:text-[26px] lg:text-[34px] 2xl:text-[40px] font-medium leading-[1.3] 2xl:leading-[52px] text-brand [text-indent:72px] sm:[text-indent:102px] lg:[text-indent:240px] 2xl:[text-indent:290px]">
                Мы регулярно предлагаем выгодные акции и специальные предложения на популярные
                услуги, чтобы вы могли получать качественную медицинскую помощь по привлекательной стоимости
            </p>
        </div>

        {{-- Карточки акций: группируем по 4 (2×2 на десктопе, 1 колонка на мобиле) --}}
        @if ($promotions->isNotEmpty())
            @php $chunks = $promotions->chunk(4); @endphp
            <div class="mt-10 swiper" data-swiper='{"slidesPerView": 1, "spaceBetween": 20}'>
                <div class="swiper-wrapper">
                    @foreach ($chunks as $chunk)
                        <div class="swiper-slide">
                            <div class="grid gap-5 sm:grid-cols-2">
                                @foreach ($chunk as $promotion)
                                    <x-promotion-card :promotion="$promotion" />
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="mt-10 rounded-[24px] bg-surface px-8 py-16 text-center">
                <p class="text-[20px] font-medium text-brand">Активных акций пока нет</p>
                <p class="mt-2 text-[15px] text-muted">Заглядывайте позже — мы регулярно добавляем новые предложения.</p>
            </div>
        @endif

        {{-- Пагинация в стиле макета: ← 1 [2] 3 ... 15 → --}}
        @if ($promotions->count() > 4)
            @php
                $totalPages = $promotions->chunk(4)->count();
                // Генерируем массив страниц с многоточием (как в макете)
                $pages = [];
                foreach (range(1, $totalPages) as $i) {
                    if ($i <= 3 || $i == $totalPages) {
                        $pages[] = $i;
                    } elseif (end($pages) !== '…') {
                        $pages[] = '…';
                    }
                }
            @endphp
            <nav aria-label="Пагинация акций" class="mt-10 flex items-center justify-between gap-4 max-sm:flex-wrap max-sm:justify-center">
                <button type="button" aria-label="Предыдущая страница"
                        class="swiper-btn-prev grid h-10 w-10 place-items-center rounded-[10px] bg-brand text-white transition-colors hover:bg-brandh">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                         stroke="currentColor" class="h-5 w-5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12H4.75M4.75 12 11 5.75M4.75 12 11 18.25"/>
                    </svg>
                </button>

                <ul class="flex items-center gap-2">
                    @foreach ($pages as $page)
                        @if ($page === '…')
                            <li><span class="px-1 text-muted" aria-hidden="true">…</span></li>
                        @else
                            <li>
                                <button type="button" data-slide-index="{{ $page - 1 }}"
                                        class="swiper-page-btn grid h-10 min-w-[40px] place-items-center rounded-[10px] border {{ $page === 1 ? 'border-border bg-white' : 'border-transparent' }} px-3 text-[14px] font-semibold text-brand transition-colors hover:border-border hover:bg-white">
                                    {{ $page }}
                                </button>
                            </li>
                        @endif
                    @endforeach
                </ul>

                <button type="button" aria-label="Следующая страница"
                        class="swiper-btn-next grid h-10 w-10 place-items-center rounded-[10px] bg-brand text-white transition-colors hover:bg-brandh">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                         stroke="currentColor" class="h-5 w-5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h14.75M19.25 12 13 5.75M19.25 12 13 18.25"/>
                    </svg>
                </button>
            </nav>
        @endif
    </main>

    @include('components.footer')
</body>
</html>
