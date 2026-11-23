<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <x-seo-head
        title="Контакты — Медико-косметологический центр «Арт-Медика»"
        description="Адрес, телефоны, режим работы и карта проезда в медико-косметологический центр «Арт-Медика» в Челябинске (пр. Ленина, 12А)."
        keywords="контакты Арт-Медика, адрес Челябинск проспект Ленина 12А, телефон записи, режим работы клиники"
    />
</head>
<body class="bg-page font-onest text-body antialiased">

<x-header></x-header>

<main id="main-content" class="mx-auto w-full max-w-[1720px] px-4 pb-16 sm:px-6 md:px-10 lg:pb-24 2xl:px-0">
    {{-- Хлебные крошки (макет: Onest, цвет #37241B) --}}
    <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-5 text-[15px] text-brand sm:pt-6 sm:text-[16px] 2xl:text-[18px]">
        <a href="{{ url('/') }}" class="transition-colors duration-200 hover:text-brandh focus-visible:outline-offset-2">Арт-Медика</a>
        <img src="{{ asset('images/_.svg') }}" width="7" height="10" alt="" class="h-3 w-auto" aria-hidden="true">
        <span class="font-medium">Контакты</span>
    </nav>

    {{-- Заголовок страницы: «Контакты ↗» слева, вводный текст справа --}}
    <div class="mt-7 sm:mt-8 lg:mt-12">
        <div class="grid gap-4 lg:grid-cols-[1fr_2.5fr] lg:gap-10 items-start">
            <div>
                <p class="inline-flex items-baseline gap-2 text-[24px] font-medium text-[#4A749B] sm:text-[28px] lg:text-[32px] 2xl:text-[40px]">
                    Контакты
                    <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </p>
            </div>

            <h1 class="max-w-[1140px] text-[24px] font-medium leading-[32px] text-brand [text-indent:25%] lg:text-[40px] lg:leading-[52px] lg:[text-indent:290px]">
                {{ $introText }}
            </h1>
        </div>
    </div>

    {{-- Блок интерактивной карты Яндекс --}}
    @php
        $yandexEmbedUrl = 'https://yandex.ru/map-widget/v1/?ll=' . $mapCoordinates['lng'] . '%2C' . $mapCoordinates['lat'] . '&z=' . $mapCoordinates['zoom'] . '&pt=' . $mapCoordinates['lng'] . '%2C' . $mapCoordinates['lat'] . ',pm2blm';
    @endphp
    <section aria-label="Расположение центра на карте" class="mt-8 sm:mt-10 lg:mt-12">
        <div id="yandex-map"
             class="relative h-[320px] w-full overflow-hidden rounded-[20px] border border-[#E8EEF8] bg-[#F5F8FF] sm:h-[400px] sm:rounded-[24px] lg:h-[480px] 2xl:h-[540px]">
            <iframe
                src="{{ $yandexEmbedUrl }}"
                width="100%"
                height="100%"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                title="Карта проезда: Челябинск, проспект Ленина 12А, МКЦ «Арт-Медика»"
                class="h-full w-full border-0">
            </iframe>
        </div>
    </section>

    {{-- Мессенджеры в мобильной версии: строго под картой перед блоками --}}
    <div class="mt-4 flex items-center gap-3 py-1 lg:hidden">
        @if(!empty($socialIcons['max']))
            <a href="{{ $socials['max'] ?? '#' }}" target="_blank" rel="noopener"
               aria-label="Написать нам в MAX"
               class="grid h-12 w-12 place-items-center overflow-hidden rounded-full bg-white shadow-sm transition-transform duration-300 ease-out hover:scale-105 focus-visible:outline-offset-2">
                <img src="{{ $socialIcons['max'] }}" alt="MAX" width="48" height="48" loading="lazy" decoding="async" class="h-12 w-12 object-contain">
            </a>
        @endif
        @if(!empty($socialIcons['vk']))
            <a href="{{ $socials['vk'] ?? '#' }}" target="_blank" rel="noopener"
               aria-label="Мы ВКонтакте"
               class="grid h-12 w-12 place-items-center overflow-hidden rounded-full bg-white shadow-sm transition-transform duration-300 ease-out hover:scale-105 focus-visible:outline-offset-2">
                <img src="{{ $socialIcons['vk'] }}" alt="VK" width="48" height="48" loading="lazy" decoding="async" class="h-12 w-12 object-contain">
            </a>
        @endif
        @if(!empty($socialIcons['telegram']))
            <a href="{{ $socials['telegram'] ?? '#' }}" target="_blank" rel="noopener"
               aria-label="Мы в Telegram"
               class="grid h-12 w-12 place-items-center overflow-hidden rounded-full bg-white shadow-sm transition-transform duration-300 ease-out hover:scale-105 focus-visible:outline-offset-2">
                <img src="{{ $socialIcons['telegram'] }}" alt="Telegram" width="48" height="48" loading="lazy" decoding="async" class="h-12 w-12 object-contain">
            </a>
        @endif
    </div>

    {{-- Блоки контактов под картой: 3 сверху и 2 снизу (растянутые на 50%) --}}
    <section aria-label="Контактные данные" class="mt-4 sm:mt-6 lg:mt-8">
        {{-- Верхний ряд: 3 блока (Адрес, Телефоны, E-mail) --}}
        <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:grid-cols-3 lg:gap-6 2xl:gap-8">
            {{-- Блок 1: Адрес --}}
            <div class="flex flex-col justify-between rounded-[20px] bg-[#F5F8FF] p-6 sm:p-7 2xl:rounded-[24px] 2xl:p-8">
                <div>
                    <h2 class="text-[20px] font-semibold text-ink sm:text-[22px] 2xl:text-[24px]">Адрес</h2>
                    <div class="mt-4 text-[14px] leading-relaxed text-body sm:text-[15px] 2xl:text-[16px]">
                        <p class="whitespace-pre-line">{{ $contacts['address'] ?? '454007, Челябинская область, г. Челябинск, проспект Ленина 12 "А" (рядом Театр ЧТЗ)' }}</p>
                    </div>
                </div>
                <div class="mt-5 pt-2">
                    <a href="https://yandex.ru/maps/?rtext=~{{ $mapCoordinates['lat'] }},{{ $mapCoordinates['lng'] }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-1.5 text-[13px] font-medium text-[#2563EB] transition-colors duration-200 hover:text-[#1D4ED8] focus-visible:outline-offset-2">
                        <span>Проложить маршрут в Яндекс.Картах</span>
                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.22 14.78a.75.75 0 001.06 0l7.22-7.22v5.69a.75.75 0 001.5 0v-7.5a.75.75 0 00-.75-.75h-7.5a.75.75 0 000 1.5h5.69l-7.22 7.22a.75.75 0 000 1.06z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Блок 2: Телефоны --}}
            <div class="flex flex-col justify-between rounded-[20px] bg-[#F5F8FF] p-6 sm:p-7 2xl:rounded-[24px] 2xl:p-8">
                <div>
                    <h2 class="text-[20px] font-semibold text-ink sm:text-[22px] 2xl:text-[24px]">Телефоны</h2>
                    <div class="mt-4 space-y-2 text-[14px] leading-relaxed text-body sm:text-[15px] 2xl:text-[16px]">
                        <p>
                            <a href="tel:+73517751918" class="font-medium text-ink transition-colors duration-200 hover:text-brand focus-visible:outline-offset-2">
                                {{ $contacts['phone'] ?? '+7 (351) 775-19-18' }}
                            </a>
                            <span class="text-muted"> - запись на прием;</span>
                        </p>
                        <p>
                            <a href="tel:+73517751988" class="font-medium text-ink transition-colors duration-200 hover:text-brand focus-visible:outline-offset-2">
                                {{ $contacts['phone_hotline'] ?? '+7 (351) 775-19-88' }}
                            </a>
                            <span class="text-muted"> - телефон горячей линии</span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Блок 3: E-mail --}}
            <div class="flex flex-col justify-between rounded-[20px] bg-[#F5F8FF] p-6 sm:p-7 2xl:rounded-[24px] 2xl:p-8">
                <div>
                    <h2 class="text-[20px] font-semibold text-ink sm:text-[22px] 2xl:text-[24px]">E-mail</h2>
                    <div class="mt-4 space-y-2 text-[14px] leading-relaxed text-body sm:text-[15px] 2xl:text-[16px]">
                        <p>
                            <a href="mailto:{{ $contacts['email_tests'] ?? 'sender@artmdc.ru' }}" class="font-medium text-ink underline decoration-[#B9C6E2] underline-offset-4 transition-colors duration-200 hover:text-brand focus-visible:outline-offset-2">
                                {{ $contacts['email_tests'] ?? 'sender@artmdc.ru' }}
                            </a>
                            <span class="text-muted"> - отправка анализов</span>
                        </p>
                        <p>
                            <a href="mailto:{{ $contacts['email_appeals'] ?? 'marketing.art-medica@mail.ru' }}" class="font-medium text-ink underline decoration-[#B9C6E2] underline-offset-4 transition-colors duration-200 hover:text-brand focus-visible:outline-offset-2">
                                {{ $contacts['email_appeals'] ?? 'marketing.art-medica@mail.ru' }}
                            </a>
                            <span class="text-muted"> - прием обращений граждан</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Нижний ряд: 2 блока, растянутых на всю ширину (Сообщения и Режим работы) --}}
        <div class="mt-4 grid grid-cols-1 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:grid-cols-2 lg:gap-6 2xl:gap-8">
            {{-- Блок 4: Сообщения --}}
            <div class="flex flex-col justify-between rounded-[20px] bg-[#F5F8FF] p-6 sm:p-7 2xl:rounded-[24px] 2xl:p-8">
                <div>
                    <h2 class="text-[20px] font-semibold text-ink sm:text-[22px] 2xl:text-[24px]">Сообщения</h2>
                    <div class="mt-4 text-[14px] leading-relaxed text-body sm:text-[15px] 2xl:text-[16px]">
                        <p>
                            <a href="tel:+79123263460" class="font-medium text-ink transition-colors duration-200 hover:text-brand focus-visible:outline-offset-2">
                                {{ $contacts['messages_phone'] ?? '+7 (912) 326-34-60' }}
                            </a>
                            <span class="text-muted"> - {{ $contacts['messages_label'] ?? 'Telegram, MAX' }}</span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Блок 5: Режим работы --}}
            <div class="flex flex-col justify-between rounded-[20px] bg-[#F5F8FF] p-6 sm:p-7 2xl:rounded-[24px] 2xl:p-8">
                <div>
                    <h2 class="text-[20px] font-semibold text-ink sm:text-[22px] 2xl:text-[24px]">Режим работы</h2>
                    <div class="mt-4 text-[14px] leading-relaxed text-body sm:text-[15px] 2xl:text-[16px]">
                        <p class="font-medium text-ink">
                            {{ $contacts['work_hours'] ?? 'ПН-СБ с 9:00 до 20:00' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Соцсети под блоками (отдельно внизу справа, точно как на макете) --}}
        <div class="hidden lg:flex justify-end mt-6">
            <div class="flex items-center gap-3.5">
                @if(!empty($socialIcons['max']))
                    <a href="{{ $socials['max'] ?? '#' }}" target="_blank" rel="noopener"
                       aria-label="Написать нам в MAX"
                       class="grid h-12 w-12 place-items-center overflow-hidden rounded-full bg-white shadow-sm transition-transform duration-300 ease-out hover:scale-110 focus-visible:outline-offset-2 2xl:h-14 2xl:w-14">
                        <img src="{{ $socialIcons['max'] }}" alt="MAX" width="48" height="48" loading="lazy" decoding="async" class="h-12 w-12 object-contain 2xl:h-14 2xl:w-14">
                    </a>
                @endif
                @if(!empty($socialIcons['vk']))
                    <a href="{{ $socials['vk'] ?? '#' }}" target="_blank" rel="noopener"
                       aria-label="Мы ВКонтакте"
                       class="grid h-12 w-12 place-items-center overflow-hidden rounded-full bg-white shadow-sm transition-transform duration-300 ease-out hover:scale-110 focus-visible:outline-offset-2 2xl:h-14 2xl:w-14">
                        <img src="{{ $socialIcons['vk'] }}" alt="VK" width="48" height="48" loading="lazy" decoding="async" class="h-12 w-12 object-contain 2xl:h-14 2xl:w-14">
                    </a>
                @endif
                @if(!empty($socialIcons['telegram']))
                    <a href="{{ $socials['telegram'] ?? '#' }}" target="_blank" rel="noopener"
                       aria-label="Мы в Telegram"
                       class="grid h-12 w-12 place-items-center overflow-hidden rounded-full bg-white shadow-sm transition-transform duration-300 ease-out hover:scale-110 focus-visible:outline-offset-2 2xl:h-14 2xl:w-14">
                        <img src="{{ $socialIcons['telegram'] }}" alt="Telegram" width="48" height="48" loading="lazy" decoding="async" class="h-12 w-12 object-contain 2xl:h-14 2xl:w-14">
                    </a>
                @endif
            </div>
        </div>
    </section>
</main>

<x-footer></x-footer>

</body>
</html>
