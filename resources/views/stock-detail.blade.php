<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $promotion->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('components.header')

    @php
        $sectionName = $promotion->service?->name ?? $promotion->title;
    @endphp

    <main class="mx-auto w-full max-w-[1720px] px-4 pb-16 sm:px-6 md:px-10 2xl:px-0">
        {{-- Хлебные крошки --}}
        <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-6 text-[15px] text-body">
            <a href="{{ url('/') }}" class="transition-colors hover:text-brand">Арт-Медика</a>
            <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto" aria-hidden="true">
            <span class="font-medium text-ink">{{ $sectionName }}</span>
        </nav>

        {{-- Акция: синий заголовок и фото слева, текст справа --}}
        <div class="flex flex-col gap-8 pt-8 lg:flex-row lg:gap-16 2xl:gap-20 2xl:pt-10">
            <div class="w-full shrink-0 lg:w-[42%]">
                <h1 class="flex items-center gap-2 text-[40px] font-medium leading-none text-[#91B5D5] max-lg:text-3xl">
                    {{ $sectionName }}
                    <img src="{{ asset('images/Arrow_right_light.svg') }}" alt="" class="w-[50px] max-lg:w-[38px]" aria-hidden="true">
                </h1>
                @if ($promotion->coverUrl())
                    <img src="{{ $promotion->coverUrl() }}" alt="{{ $promotion->title }}" loading="lazy"
                         width="395" height="517"
                         class="mt-8 w-full rounded-[24px] bg-hero object-cover object-top">
                @endif
            </div>

            <div class="flex min-w-0 flex-1 flex-col">
                <p class="text-center text-[40px] font-semibold leading-snug text-brand max-lg:text-left max-lg:text-2xl">{{ $promotion->title }}</p>

                <div class="mt-6 [&>p]:mt-0 [&>p+p]:mt-4 [&>p]:text-[28px] [&>p]:leading-relaxed [&>p]:text-body 2xl:text-[28px]">
                    {!! $promotion->content !!}
                </div>

                @if ($promotion->published_at)
                    <span class="mt-8 text-[24px] text-[#91B5D5]">{{ $promotion->published_at->format('d.m.Y') }}</span>
                @endif
            </div>
        </div>

        {{-- Другие акции: каталог внизу страницы --}}
        @if ($promotions->isNotEmpty())
            <div class="mt-14 grid gap-5 sm:grid-cols-2 2xl:mt-16 2xl:gap-5">
                @foreach ($promotions as $card)
                    <x-promotion-card :promotion="$card" />
                @endforeach
            </div>
        @endif

        {{-- Пагинация в стиле макета --}}
        @if ($promotions->hasPages())
            @php
                $current = $promotions->currentPage();
                $last = $promotions->lastPage();
                $pages = [];
                foreach (range(1, $last) as $i) {
                    if ($i == 1 || $i == $last || ($i >= $current - 1 && $i <= $current + 1)) {
                        $pages[] = $i;
                    } elseif (end($pages) !== '…') {
                        $pages[] = '…';
                    }
                }
            @endphp
            <nav aria-label="Пагинация акций" class="mt-10 flex items-center justify-between gap-4 max-sm:flex-wrap max-sm:justify-center">
                @if ($promotions->onFirstPage())
                    <span aria-hidden="true"
                          class="grid h-10 w-10 place-items-center rounded-[10px] bg-surfaceh text-white/40">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                             stroke="currentColor" class="h-5 w-5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12H4.75M4.75 12 11 5.75M4.75 12 11 18.25"/>
                        </svg>
                    </span>
                @else
                    <a href="{{ $promotions->previousPageUrl() }}" rel="prev" aria-label="Предыдущая страница"
                       class="grid h-10 w-10 place-items-center rounded-[10px] bg-brand text-white transition-colors hover:bg-brandh">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                             stroke="currentColor" class="h-5 w-5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12H4.75M4.75 12 11 5.75M4.75 12 11 18.25"/>
                        </svg>
                    </a>
                @endif

                <ul class="flex items-center gap-2">
                    @foreach ($pages as $page)
                        @if ($page === '…')
                            <li><span class="px-1 text-muted" aria-hidden="true">{{ $page }}</span></li>
                        @elseif ($page == $current)
                            <li><span aria-current="page"
                                      class="grid h-10 min-w-[40px] place-items-center rounded-[10px] border border-border bg-white px-3 text-[14px] font-semibold text-ink">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $promotions->url($page) }}"
                                   class="grid h-10 min-w-[40px] place-items-center rounded-[10px] border border-transparent px-3 text-[14px] text-body transition-colors hover:border-border hover:bg-white">{{ $page }}</a></li>
                        @endif
                    @endforeach
                </ul>

                @if ($promotions->onLastPage())
                    <span aria-hidden="true"
                          class="grid h-10 w-10 place-items-center rounded-[10px] bg-surfaceh text-white/40">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                             stroke="currentColor" class="h-5 w-5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h14.75M19.25 12 13 5.75M19.25 12 13 18.25"/>
                        </svg>
                    </span>
                @else
                    <a href="{{ $promotions->nextPageUrl() }}" rel="next" aria-label="Следующая страница"
                       class="grid h-10 w-10 place-items-center rounded-[10px] bg-brand text-white transition-colors hover:bg-brandh">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                             stroke="currentColor" class="h-5 w-5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h14.75M19.25 12 13 5.75M19.25 12 13 18.25"/>
                        </svg>
                    </a>
                @endif
            </nav>
        @endif
    </main>

    @include('components.footer')
</body>
</html>
