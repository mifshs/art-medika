@props([
    'title',
    'image'    => null,      // url обложки или null
    'color'    => '#C7CCD9', // фон карточки; для вариативности добавь колонку в БД
    'services' => [],        // [['label' => ..., 'url' => ...], ...]
])

<div {{ $attributes->merge(['class' => 'relative flex min-h-[280px] flex-col justify-between overflow-hidden rounded-2xl p-8']) }}
     style="background-color: {{ $color }};">

    @if ($image)
        <img src="{{ $image }}" alt="" loading="lazy"
             class="pointer-events-none absolute inset-y-0 right-0 h-full w-3/5 object-cover object-center">
        <div class="pointer-events-none absolute inset-0"
             style="background: linear-gradient(to right, {{ $color }} 0%, {{ $color }} 38%, transparent 72%);"></div>
    @endif

    <h3 class="relative z-10 text-[28px] font-semibold leading-tight text-[#1a1a1a]">
        {{ $title }}
    </h3>

    <ul class="relative z-10 mt-6 space-y-3">
        @foreach ($services as $s)
            <li>
                <a href="{{ $s['url'] ?? '#' }}"
                   class="group flex items-center justify-between gap-4 text-[15px] leading-snug text-[#2b2b2b] transition-colors hover:text-black">
                    <span>{{ $s['label'] }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor"
                         class="h-4 w-4 shrink-0 text-[#1a1a1a] transition-transform group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 6.75 19.5 12l-6.75 5.25"/>
                    </svg>
                </a>
            </li>
        @endforeach
    </ul>
</div>