@props(['category'])

@php
    $cover = $category->coverUrl();

    // Мобильный порядок карточек (макет 1752:4915) — литеральные классы для Tailwind JIT:
    // kosmetologiya → 1, otorinolaringologiya → 2, lor-hirurgiya → 3, massazh → 4,
    // esteticheskaya-ginekologiya → 5, dermatologiya → 6, top-produkty → 7,
    // plasticheskaya-hirurgiya → 8, nevrologiya-i-refleksoterapiya → 9, terapevticheskiy-priem → 10.
    $orderClasses = [
        'kosmetologiya'                  => 'max-sm:order-1',
        'otorinolaringologiya'           => 'max-sm:order-2',
        'lor-hirurgiya'                  => 'max-sm:order-3',
        'massazh'                        => 'max-sm:order-4',
        'esteticheskaya-ginekologiya'    => 'max-sm:order-5',
        'dermatologiya'                  => 'max-sm:order-6',
        'top-produkty'                   => 'max-sm:order-7',
        'plasticheskaya-hirurgiya'       => 'max-sm:order-8',
        'nevrologiya-i-refleksoterapiya' => 'max-sm:order-9',
        'terapevticheskiy-priem'         => 'max-sm:order-10',
    ];
    $orderClass = $orderClasses[$category->slug] ?? '';
@endphp

{{-- Направление не кликабельно (в макете нет перехода на отдельные страницы) --}}
<div class="group block rounded-[12px] py-2 -my-2 {{ $orderClass }}">
    {{-- Обложка направления из БД (media, collection «cover»); мобайл 8:5 (242px при 388), десктоп 12:7 --}}
    <div class="relative aspect-[8/5] w-full overflow-hidden rounded-[12px] bg-hero sm:aspect-[12/7] sm:rounded-[16px]">
        @if ($cover)
            <img src="{{ $cover }}" alt="Направление клиники: {{ $category->name }}" loading="lazy"
                 class="absolute inset-0 h-full w-full object-cover">
        @else
            <div class="absolute inset-0 grid place-items-center">
                <span class="font-serif text-[21px] italic font-semibold tracking-tight text-brand">Арт-Медика</span>
            </div>
        @endif
    </div>

    {{-- Заголовок (макет: Onest 500; 24/32 мобайл #1C1B1F, 36/44 десктоп #212529) --}}
    <h3 class="mt-[25px] text-[24px] font-medium leading-[32px] text-[#1C1B1F] sm:mt-7 sm:leading-tight sm:text-[28px] sm:text-body xl:text-[32px] 2xl:text-[36px] 2xl:leading-[44px]">
        {{ $category->name }}
    </h3>

    @if ($category->description)
        {{-- Описание мобильного макета: Onest 400 16/24 #A09CAB, отступ 10px --}}
        <p class="mt-2.5 hidden max-w-[680px] text-[16px] leading-[24px] text-[#A09CAB] max-sm:block">
            {{ $category->description }}
        </p>
    @endif

    @if ($category->subtitle)
        {{-- Описание десктопного макета: Onest 400 20/28 #212529, ширина 850 --}}
        <p class="mt-2 max-w-[680px] text-[14px] leading-snug text-body max-sm:hidden sm:mt-2.5 sm:text-[15px] xl:text-[17px] 2xl:max-w-[850px] 2xl:text-[20px] 2xl:leading-[28px]">
            {{ $category->subtitle }}
        </p>
    @endif
</div>
