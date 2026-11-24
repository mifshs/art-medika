@props(['promotion'])

@php
    $cover = $promotion->coverUrl();
    $tag   = 'Акции' . ($promotion->service?->name ? ' / ' . $promotion->service->name : '');
    $date  = $promotion->published_at?->format('d.m.Y');
@endphp

<article class="group relative select-none cursor-pointer flex h-auto w-full flex-col rounded-[24px] bg-surface p-5 sm:h-[557px] sm:min-h-[557px] border-[3px] border-transparent transition-all duration-300 hover:border-brand hover:shadow-lg">
    {{-- Ссылка на всю карточку --}}
    <a href="{{ route('stock.show', $promotion->slug) }}" class="absolute inset-0 z-10 rounded-[inherit] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2" aria-label="Открыть акцию: {{ $promotion->title }}"></a>

    <div class="flex h-full min-h-0 flex-col gap-5 sm:flex-row sm:gap-6 pointer-events-none">
        {{-- Обложка из БД (media, collection «cover»): 395×517 внутри карточки, обрез до карточного соотношения --}}
        <div class="relative h-[280px] w-full shrink-0 overflow-hidden rounded-[16px] bg-hero sm:h-full sm:w-[395px] sm:max-w-[50%] sm:min-h-0">
            @if ($cover)
                <img src="{{ $cover }}" alt="{{ $promotion->title }}" width="395" height="517" loading="lazy" decoding="async"
                     class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
            @else
                <div class="absolute inset-0 grid place-items-center">
                    <span class="font-serif text-[21px] italic font-semibold tracking-tight text-brand">Арт-Медика</span>
                </div>
            @endif
        </div>

        {{-- Текст: бирка+стрелка, название, описание, дата --}}
        <div class="flex min-w-0 flex-1 flex-col justify-between">
    
    <!-- Верхняя часть: Тег и стрелка -->
    <div class="flex items-start justify-between gap-4">
        <span class="min-w-0 truncate text-[12px] font-medium text-brand sm:text-[14px] 2xl:text-[16px]">{{ $tag }}</span>
        <span class="shrink-0 rounded-md p-0.5 text-body transition-transform group-hover:translate-x-0.5 group-hover:text-brand">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" aria-hidden="true"
                 class="h-[18px] w-[18px] sm:h-[22px] sm:w-[22px]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16 16 8M16 8H9.5M16 8v6.5"/>
            </svg>
        </span>
    </div>

    <!-- Центральная часть: Заголовок и описание -->
    <div class="mt-3 sm:mt-4">
        <h2 class="text-[18px] font-semibold leading-snug text-ink transition-colors group-hover:text-brand sm:text-[22px] lg:text-[24px] 2xl:text-[26px]">{{ $promotion->title }}</h2>

        @if ($promotion->excerpt)
            <p class="mt-2 overflow-hidden text-[13px] leading-relaxed text-body [display:-webkit-box] [-webkit-box-orient:vertical] [-webkit-line-clamp:4] sm:text-[14px] 2xl:text-[15px]">{{ $promotion->excerpt }}</p>
        @endif
    </div>

    <!-- Нижняя часть: Дата -->
    @if ($date)
        <span class="pt-4 text-[13px] text-[#4A749B] sm:text-[14px] 2xl:text-[16px]">{{ $date }}</span>
    @endif

</div>
    </div>
</article>
