@props([
    'title',
    'image'    => null,
    'services' => [],
])

<div {{ $attributes->merge([
    'class' => 'relative flex h-[240px] w-full flex-col justify-between overflow-hidden rounded-[20px] p-8 sm:h-[373px]',
]) }}>

    {{-- Фон = одна картинка на всю карточку --}}
    @if ($image)
        <img src="{{ $image }}" alt="" loading="lazy"
             class="pointer-events-none absolute inset-0 h-full w-full object-cover">
    @endif

    {{-- Два затемнения #B6D3FF: 20% и 10% --}}
    <div class="pointer-events-none absolute inset-0 bg-[rgba(182,211,255,0.2)]"></div>
    <div class="pointer-events-none absolute inset-0 bg-[rgba(182,211,255,0.1)]"></div>

    {{-- Заголовок: лево-верх --}}
    <h3 class="relative z-10 text-[36px] font-medium leading-tight text-[#212529]">
        {{ $title }}
    </h3>

    {{-- Список-ссылки: перенос + стрелки в одну колонку (30px от длинного текста) --}}
    <ul class="relative z-10 flex flex-col gap-3">
        @foreach ($services as $s)
            <li>
                <a href="{{ $s['url'] ?? '#' }}"
                   class="group grid grid-cols-[1fr_22.5px] items-center gap-x-[30px] text-[20px] leading-snug text-[#212529]">
                    <span class="min-w-0">{{ $s['label'] }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24 class="h-[18px] w-[22.5px] shrink-0 transition-transform group-hover:translate-x-1""
                         stroke-width="1.5" stroke="currentColor"
                         class="h-[18px] w-[22.5px] shrink-0 transition-transform group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 6.75 19.5 12l-6.75 5.25"/>
                    </svg>
                </a>
            </li>
        @endforeach
    </ul>
</div>