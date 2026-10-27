@props(['news'])

@php
    $coverUrl = $news->coverUrl();
    $categoryName = $news->category?->name ?? 'Косметология';
    $typeLabel = $news->type === 'article' ? 'Статья' : 'Новости';
    $date = $news->published_at ? \Illuminate\Support\Carbon::parse($news->published_at)->format('d.m.Y') : '';
    $detailUrl = route('news.show', $news->slug);
@endphp

{{-- Карточка новости (макет Figma: фон #F3F6FD, скруглённые углы, шрифт Onest) --}}
<article class="group relative flex h-full flex-col justify-between rounded-[20px] bg-[#F3F6FD] p-4 transition-all duration-300 hover:shadow-md sm:rounded-[24px] sm:p-5 lg:p-6">
    <div class="flex flex-col">
        {{-- Верхняя строка: Категория контента и стрелка перехода ↗ --}}
        <div class="flex items-center justify-between gap-2 text-[13px] text-[#7E93AC] sm:text-[14px]">
            <span>{{ $typeLabel }} / {{ $categoryName }}</span>
            <a href="{{ $detailUrl }}" aria-label="Открыть «{{ $news->title }}»"
               class="inline-flex h-5 w-5 shrink-0 items-center justify-center text-[#1A1A1A] transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M7 17L17 7H8.5M17 7v8.5"/>
                </svg>
            </a>
        </div>

        {{-- Фотография с внутренними скруглёнными краями --}}
        <a href="{{ $detailUrl }}" class="mt-3 block overflow-hidden rounded-[14px] sm:rounded-[18px]">
            @if ($coverUrl)
                <img src="{{ $coverUrl }}" alt="{{ $news->title }}" loading="lazy"
                     class="aspect-[4/3] w-full object-cover transition-transform duration-500 group-hover:scale-105">
            @else
                <div class="flex aspect-[4/3] w-full items-center justify-center bg-slate-200 text-slate-400">
                    <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif
        </a>

        {{-- Заголовок новости --}}
        <h3 class="mt-4 text-[16px] font-semibold leading-[1.3] text-[#1A1A1A] transition-colors group-hover:text-brand sm:text-[18px] lg:text-[19px]">
            <a href="{{ $detailUrl }}" class="transition-colors hover:text-brand">
                {{ $news->title }}
            </a>
        </h3>
    </div>

    {{-- Дата публикации (макет: Onest, цвет #91B5D5) --}}
    @if ($date)
        <div class="mt-4 pt-2">
            <span class="text-[13px] font-normal text-[#91B5D5] sm:text-[14px] 2xl:text-[15px]">
                {{ $date }}
            </span>
        </div>
    @endif
</article>
