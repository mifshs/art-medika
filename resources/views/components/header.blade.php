@php
    $contacts = \App\Models\Setting::get('contacts', ['address' => '', 'phone' => '', 'email' => '', 'work_hours' => '']);
    $logo     = \App\Models\Setting::get('logo') ?: asset('images/logo.png');
    $phoneTel = preg_replace('/\D+/', '', (string) ($contacts['phone'] ?? ''));
    $nav      = [
        ['href' => '/o-centre',      'label' => 'О клинике'],
        ['href' => route('services'), 'label' => 'Услуги'],
        ['href' => '#spetsialisty',  'label' => 'Специалисты'],
        ['href' => '/stock',         'label' => 'Акции'],
        ['href' => '/documents',     'label' => 'Документы'],
        ['href' => '#contacts',      'label' => 'Контакты'],
    ];
@endphp

<header x-data="{ menu: false }" class="bg-white">
    <div class="mx-auto flex w-full max-w-[1720px] items-center justify-between gap-6 px-4 py-5 sm:px-6 md:px-10 2xl:px-0">
        <a href="{{ url('/') }}" class="flex shrink-0 items-center gap-2.5">
            <img src="{{ $logo }}" alt="Знак клиники Арт-Медика" class="h-9 w-auto sm:h-11">
        </a>

        <nav class="hidden items-center gap-10 text-base font-medium text-body xl:flex">
            @foreach ($nav as $item)
                <a class="transition-colors hover:text-brand" href="{{ $item['href'] }}">{{ $item['label'] }}</a>
            @endforeach
        </nav>

        <div class="flex shrink-0 items-center gap-4">
            <div class="hidden text-right md:block">
                <a href="tel:{{ $phoneTel }}" class="block text-[17px] font-bold text-ink transition-colors hover:text-brand">{{ $contacts['phone'] ?? '' }}</a>
                <div class="text-[13px] leading-snug text-muted">{{ $contacts['address'] ?? '' }}<br>{{ $contacts['work_hours'] ?? '' }}</div>
            </div>
            <a href="/stock" class="rounded-full bg-brand px-5 py-3 text-[14px] font-semibold text-white transition-colors hover:bg-brandh sm:px-7 sm:py-3.5 sm:text-[15px]">Записаться</a>
        </div>
    </div>

    <div id="mobile-menu" x-show="menu" x-collapse x-cloak class="lg:hidden border-t border-border px-4 py-4">
        <nav class="grid gap-1 text-[15px] font-medium text-body">
            @foreach ($nav as $item)
                <a class="rounded-lg px-3 py-2 hover:bg-surface" href="{{ $item['href'] }}">{{ $item['label'] }}</a>
            @endforeach
            <a href="tel:{{ $phoneTel }}" class="mt-2 rounded-full bg-brand px-6 py-3 text-center font-semibold text-white hover:bg-brandh">Записаться</a>
        </nav>
    </div>
</header>
