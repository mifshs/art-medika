<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Услуги направления «{{ $category->name }}» в клинике «Арт-Медика»: длительность и стоимость приёма.">
    <title>{{ $category->name }} — Услуги — Арт-Медика</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<?php
$formatPrice = fn ($value) => number_format((float) $value, 0, ',', ' ') . ' ₽';
$servicePrice = fn ($service) => (($value = collect([$service->price, $service->price_cat_1, $service->price_cat_2, $service->price_cat_3])
        ->filter()->min()) !== null ? $formatPrice($value) : null);
?>
<body>
    @include('components.header')

    <main class="mx-auto w-full max-w-[1720px] px-4 pb-20 sm:px-6 md:px-10 2xl:px-0">
        {{-- Хлебные крошки --}}
        <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-6 text-[15px] text-brand">
            <a href="{{ url('/') }}" rel="home" class="transition-colors hover:text-brandh">Арт-Медика</a>
            <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto" aria-hidden="true">
            <a href="{{ route('services') }}" class="whitespace-nowrap transition-colors hover:text-brandh">Услуги</a>
            <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto shrink-0" aria-hidden="true">
            <span class="font-medium">{{ $category->name }}</span>
        </nav>

        {{-- Заголовок направления --}}
        <div class="flex flex-col items-start justify-between gap-8 pt-10 lg:flex-row lg:items-start 2xl:pt-[52px]">
            <h1 class="flex shrink-0 items-center gap-2 text-[40px] font-medium leading-none text-[#91B5D5] max-lg:text-3xl">
                {{ $category->name }}
                <img src="{{ asset('images/Arrow_right_light.svg') }}" alt="" class="w-[50px] max-lg:w-[38px]" aria-hidden="true">
            </h1>
            @if ($category->description)
                <p class="max-w-[1140px] text-[40px] font-medium leading-tight text-brand [text-indent:25%] max-lg:text-2xl">
                    {{ $category->description }}
                </p>
            @endif
        </div>

        @if ($total > 0)
            <div class="mt-12 space-y-14 2xl:mt-16">
                @foreach ($groups as $group)
                    @continue(empty($group['services']))
                    @php
                        $child   = $group['category'];
                        $groupId = $child?->id ?? 'own';
                    @endphp
                    <section aria-labelledby="group-{{ $groupId }}">
                        <div class="border-b border-border pb-4">
                            <h2 id="group-{{ $groupId }}" class="text-[28px] font-medium text-ink max-lg:text-2xl">
                                {{ $child?->name ?? 'Основные услуги' }}
                            </h2>
                        </div>

                        <ul class="divide-y divide-border">
                            @foreach ($group['services'] as $service)
                                @php
                                    $price    = $servicePrice($service);
                                    $duration = $service->duration_label ? $service->duration_label . ' мин' : null;
                                    $hasData  = (bool) ($duration || $price);
                                @endphp
                                <li class="grid items-baseline gap-x-6 gap-y-1 py-4 {{ $hasData ? 'max-sm:grid-cols-[minmax(0,1fr)_auto] sm:grid-cols-[minmax(0,1fr)_150px_170px]' : 'grid-cols-1' }}">
                                    <span class="min-w-0 text-[18px] leading-snug text-body max-lg:text-base">{{ $service->name }}</span>
                                    @if ($hasData)
                                        <span class="text-[15px] text-muted max-sm:order-3 max-sm:hidden">{{ $duration ?? '' }}</span>
                                        <span class="text-[15px] font-medium whitespace-nowrap text-body max-sm:col-start-2 sm:col-start-3 sm:text-right">{{ $price ?? '' }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endforeach
            </div>
        @else
            <div class="mt-12 rounded-[24px] bg-surface px-8 py-16 text-center">
                <p class="text-[20px] font-medium text-ink">Список услуг направления появится в ближайшее время</p>
                <p class="mt-2 text-[15px] text-muted">Уточните детали по телефону {{ \App\Models\Setting::get('contacts', [])['phone'] ?? '' }}.</p>
            </div>
        @endif

        {{-- Вызов: вернуться к общему списку направлений --}}
        <div class="mt-16">
            <a href="{{ route('services') }}"
               class="inline-flex items-center gap-3 rounded-full border border-border px-7 py-3.5 text-[15px] font-semibold text-ink transition-colors hover:border-brand hover:bg-surface hover:text-brand focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" aria-hidden="true" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
                Все направления клиники
            </a>
        </div>
    </main>

    @include('components.footer')
</body>
</html>
