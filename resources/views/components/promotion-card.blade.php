@props(['promotion'])

@php
    $cover = $promotion->coverUrl();
    $tag   = 'Акции' . ($promotion->service?->name ? ' / ' . $promotion->service->name : '');
    $date  = $promotion->published_at?->format('d.m.Y');
@endphp

<article class="flex h-auto w-full flex-col rounded-[24px] bg-surface p-5 sm:h-[557px] sm:min-h-[557px]">
    <div class="flex h-full min-h-0 flex-col gap-5 sm:flex-row sm:gap-6">
        {{-- Обложка из БД (media, collection «cover»): 395×517 внутри карточки, обрез до карточного соотношения --}}
        <div class="relative h-[280px] w-full shrink-0 overflow-hidden rounded-[16px] bg-hero sm:h-full sm:w-[395px] sm:max-w-[50%] sm:min-h-0">
            @if ($cover)
                <img src="{{ $cover }}" alt="{{ $promotion->title }}" loading="lazy"
                     class="absolute inset-0 h-full w-full object-cover">
            @else
                <div class="absolute inset-0 grid place-items-center">
                    <span class="font-serif text-[21px] italic font-semibold tracking-tight text-brand">Арт-Медика</span>
                </div>
            @endif
        </div>

        {{-- Текст: бирка+стрелка, название, описание, дата --}}
        <div class="flex min-w-0 flex-1 flex-col justify-between"> <!-- Добавлен justify-between -->
    
    <!-- Верхняя часть: Тег и стрелка -->
    <div class="flex items-start justify-between gap-4">
        <span class="min-w-0 truncate text-[16px] font-medium text-brand">{{ $tag }}</span>
        <a href="{{ route('stock.show', $promotion->slug) }}" aria-label="Открыть акцию: {{ $promotion->title }}"
           class="shrink-0 rounded-md p-0.5 text-body transition-transform hover:translate-x-0.5 hover:text-brand focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" aria-hidden="true"
                 class="h-[22px] w-[22px]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16 16 8M16 8H9.5M16 8v6.5"/>
            </svg>
        </a>
    </div>

    <!-- Центральная часть: Заголовок и описание -->
    <div class="mt-3 sm:mt-4">
        <h3 class="text-[36px] font-semibold leading-snug text-ink 2xl:text-[26px]">{{ $promotion->title }}</h3>

        @if ($promotion->excerpt)
            <p class="mt-2 overflow-hidden text-[20px] leading-relaxed text-body [display:-webkit-box] [-webkit-box-orient:vertical] [-webkit-line-clamp:4] 2xl:text-[15px]">{{ $promotion->excerpt }}</p>
        @endif
    </div>

    <!-- Нижняя часть: Дата -->
    @if ($date)
        <span class="pt-4 text-[20px] text-[#91B5D5]">{{ $date }}</span>
    @endif

</div>
    </div>
</article>
