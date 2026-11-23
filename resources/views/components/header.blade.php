@php
    $contacts = \App\Models\Setting::get('contacts', ['address' => '', 'phone' => '', 'email' => '', 'work_hours' => '']);
    $logo     = \App\Models\Setting::get('logo') ?: asset('images/logo.svg');
    $phoneTel = preg_replace('/\D+/', '', (string) ($contacts['phone'] ?? ''));
    $nav      = [
        ['href' => '/o-centre',      'label' => 'О клинике'],
        ['href' => '/uslugi',        'label' => 'Услуги'],
        ['href' => '/spetsialisty',  'label' => 'Специалисты'],
        ['href' => '/stock',         'label' => 'Акции'],
        ['href' => '/documents',     'label' => 'Документы'],
        ['href' => '/kontakty',      'label' => 'Контакты'],
    ];

    $burgerServices = [
        ['href' => '/uslugi/plasticheskaya-hirurgiya', 'label' => 'Пластическая хирургия'],
        ['href' => '/uslugi/kosmetologiya',            'label' => 'Косметология'],
        ['href' => '/uslugi/top-produkty',             'label' => 'Топ-продукты'],
        ['href' => '/uslugi/dermatologiya',            'label' => 'Дерматология'],
        ['href' => '/uslugi/otorinolaringologiya',     'label' => 'Оториноларингология'],
        ['href' => '/uslugi/lor-hirurgiya',            'label' => 'Лор-хирургия'],
        ['href' => '/uslugi/nevrologiya-i-refleksoterapiya', 'label' => 'Неврология и рефлексотерапия'],
        ['href' => '/uslugi/esteticheskaya-ginekologiya', 'label' => 'Эстетическая гинекология'],
        ['href' => '/uslugi/terapevticheskiy-priem',   'label' => 'Терапевтический приём'],
        ['href' => '/uslugi/massazh',                  'label' => 'Массаж'],
    ];

    $burgerNav = [
        ['href' => '/o-centre',      'label' => 'О клинике'],
        ['href' => '/spetsialisty',  'label' => 'Специалисты'],
        ['href' => '/uslugi',        'label' => 'Услуги'],
        ['href' => '/proekty',       'label' => 'Проекты'],
        ['href' => '/stock',         'label' => 'Акции'],
        ['href' => '/news',          'label' => 'Новости'],
        ['href' => '/prices',        'label' => 'Цены'],
        ['href' => '/kontakty',      'label' => 'Контакты'],
        ['href' => '/documents',     'label' => 'Документы'],
        ['href' => '/faq',           'label' => 'Вопросы и ответы'],
    ];
@endphp

<a href="#main-content" class="skip-to-content">Перейти к основному содержимому</a>

<header x-data="{ menu: false, servicesOpen: false }" @keydown.escape.window="menu = false" class="bg-white font-onest">
    <div class="relative mx-auto flex w-full max-w-[1720px] items-center justify-between gap-2 sm:gap-4 lg:gap-6 px-4 py-3 sm:py-5 sm:px-6 md:px-10 2xl:px-0">
        <button type="button" @click="menu = !menu" :aria-expanded="menu" aria-controls="mobile-menu" aria-label="Открыть меню навигации"
                class="grid h-11 w-11 shrink-0 place-items-center rounded-xl border border-border transition-all duration-300 ease-out hover:bg-surfaceh hover:border-brand/40 hover:shadow-sm focus-visible:outline-offset-2 xl:hidden">
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" aria-hidden="true"><path d="M1 1h18M1 7h18M1 13h18" stroke="#212529" stroke-width="1.6" stroke-linecap="round"/></svg>
        </button>

        <a href="{{ url('/') }}" class="flex shrink-0 items-center transition-all duration-300 ease-out hover:opacity-80 hover:scale-[1.03] focus-visible:outline-offset-2">
            <img src="{{ asset('images/logo.svg') }}" alt="Медико-косметологический центр «Арт-Медика»" width="270" height="64" class="h-8 w-auto sm:h-12 md:h-14 lg:h-[56px] 2xl:h-[62px] object-contain">
        </a>

        <nav class="hidden items-center gap-7 xl:gap-9 2xl:gap-11 text-[15px] xl:text-[16px] 2xl:text-[17px] font-medium text-body xl:flex" aria-label="Основное меню">
            @foreach ($nav as $item)
                <a class="relative py-1 text-body transition-colors duration-300 ease-out hover:text-steel after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-full after:origin-left after:scale-x-0 after:rounded-full after:bg-steel after:transition-transform after:duration-300 after:ease-out hover:after:scale-x-100 focus-visible:outline-offset-2" href="{{ $item['href'] }}">{{ $item['label'] }}</a>
            @endforeach
        </nav>

        <div class="flex items-center gap-4 lg:gap-6">
            <div class="hidden text-right text-[13px] 2xl:text-[14px] leading-tight text-brand md:block font-medium">
                <div>{{ $contacts['address'] ?? 'Челябинск, пр. Ленина 12а' }}</div>
                <div class="mt-0.5 text-[#554035]">{{ $contacts['work_hours'] ?? 'ПН-СБ с 9:00 до 20:00' }}</div>
            </div>
            <a href="/stock" class="whitespace-nowrap rounded-full bg-brand px-4 py-2 text-[13px] sm:px-7 sm:py-3 sm:text-[14px] 2xl:text-[15px] font-semibold text-white transition-all duration-300 ease-out hover:bg-[#5A3E32] hover:shadow-md hover:-translate-y-[1px] focus-visible:outline-offset-2">Записаться</a>
        </div>
    </div>

    {{-- Мобильное выезжающее боковое меню (Drawer) по референсу --}}
    <div id="mobile-menu" x-show="menu" x-cloak class="fixed inset-0 z-[9999] xl:hidden" aria-modal="true" role="dialog">
        {{-- Затемненный оверлей --}}
        <div x-show="menu"
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="menu = false"
             class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>

        {{-- Выезжающая белая панель меню слева --}}
        <div x-show="menu"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="relative flex h-full w-[82%] max-w-[340px] flex-col justify-between overflow-y-auto bg-white px-5 py-6 shadow-2xl">
            <div>
                {{-- Верхняя плашка: Логотип и кнопка закрытия (крестик) --}}
                <div class="flex items-center justify-between pb-5 border-b border-border">
                    <a href="{{ url('/') }}" @click="menu = false" class="transition-all duration-300 ease-out hover:opacity-80">
                        <img src="{{ asset('images/logo.svg') }}" alt="Арт-Медика" width="270" height="64" class="h-8 w-auto">
                    </a>
                    <button type="button" @click="menu = false" aria-label="Закрыть меню"
                            class="grid h-9 w-9 place-items-center rounded-lg text-ink transition-all duration-300 ease-out hover:bg-surface hover:text-brand hover:rotate-90">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                {{-- Навигация меню --}}
                <nav class="mt-4 space-y-1 text-[16px] font-semibold text-brand">
                    {{-- Пункт «Услуги» с выпадающим аккордеоном --}}
                    <div>
                        <button type="button" @click="servicesOpen = !servicesOpen"
                                :aria-expanded="servicesOpen"
                                class="no-scale flex w-full items-center justify-between rounded-lg px-2.5 -mx-2.5 py-2.5 text-left transition-all duration-300 ease-out hover:bg-surface hover:text-steel hover:translate-x-1 active:bg-[#E2E7F1]">
                            <span>Услуги</span>
                            <svg class="h-4 w-4 text-brand transition-transform duration-[450ms] ease-[cubic-bezier(0.22,1,0.36,1)]"
                                 :class="servicesOpen ? 'rotate-180' : ''"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>
                        <div x-show="servicesOpen" x-collapse.duration.450ms x-cloak>
                            <div class="pl-3 pr-1 pb-2 pt-1 space-y-2 text-[14px] font-normal text-body transition-opacity duration-[450ms] ease-out"
                                 :class="servicesOpen ? 'opacity-100' : 'opacity-0'">
                                @foreach ($burgerServices as $srv)
                                    <a href="{{ $srv['href'] }}" @click="menu = false" class="block rounded-lg px-2.5 -mx-2.5 py-1 transition-all duration-300 ease-out hover:bg-surface hover:text-steel hover:translate-x-1">
                                        {{ $srv['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Остальные пункты меню по референсу --}}
                    @foreach ($burgerNav as $item)
                        <a href="{{ $item['href'] }}" @click="menu = false"
                           class="block rounded-lg px-2.5 -mx-2.5 py-2.5 transition-all duration-300 ease-out hover:bg-surface hover:text-steel hover:translate-x-1">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>
            </div>

            {{-- Нижняя кнопка записи в бургере --}}
            <div class="mt-8 pt-4 border-t border-border">
                <a href="/stock" @click="menu = false"
                   class="block w-full rounded-full bg-brand py-3 text-center text-[15px] font-semibold text-white transition-all duration-300 ease-out hover:bg-[#5A3E32] hover:shadow-md hover:-translate-y-[1px]">
                    Записаться
                </a>
            </div>
        </div>
    </div>
</header>
