@props([
    'title',
    'image'    => null,
    'services' => [],
])

<div {{ $attributes->merge([
    'class' => 'relative flex h-[240px] w-full flex-col justify-between overflow-hidden rounded-[20px] bg-[#DCE4F0] p-4 sm:h-[373px] sm:p-6 2xl:p-8',
]) }}>

    {{-- Фон = одна ч/б картинка справа с мягким градиентным переходом --}}
    @if ($image)
        <img src="{{ $image }}" alt="" loading="lazy"
             style="-webkit-mask-image: linear-gradient(to right, transparent 0%, black 18%); mask-image: linear-gradient(to right, transparent 0%, black 18%);"
             class="pointer-events-none absolute right-0 top-0 h-full w-auto max-w-none grayscale mix-blend-multiply opacity-90">
    @endif

    {{-- Полупрозрачная тонировка карточки под макет --}}
    <div class="pointer-events-none absolute inset-0 bg-gradient-to-r from-[#DCE4F0]/90 via-[#DCE4F0]/45 to-transparent"></div>

    {{-- Заголовок: лево-верх --}}
    <h3 class="relative z-10 text-[36px] font-medium leading-tight text-[#212529] max-md:text-2xl">
        {{ $title }}
    </h3>

    {{-- Список-ссылки: стрелки выровнены по самой длинной метке --}}
    <ul class="relative z-10 grid w-max max-w-full grid-cols-[max-content_22.5px] gap-x-6 gap-y-2.5 sm:gap-x-7 2xl:gap-x-9 2xl:gap-y-3">
        @foreach ($services as $s)
            <li class="contents">
                <a href="{{ $s['url'] ?? '#' }}"
                   class="group col-span-2 grid grid-cols-[subgrid] items-center text-[20px] leading-snug text-[#212529] transition-colors duration-300 ease-out hover:text-brand max-md:text-base">
                    <span class="min-w-0">{{ $s['label'] }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor"
                         class="h-[18px] w-[22.5px] shrink-0 stroke-[1.5] transition-transform duration-300 ease-out group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 6.75 19.5 12l-6.75 5.25"/>
                    </svg>
                </a>
            </li>
        @endforeach
    </ul>
</div>
