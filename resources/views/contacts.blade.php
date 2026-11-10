<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты — Медико-косметологический центр «Арт-Медика»</title>
    <x-favicon></x-favicon>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Шрифт макета — Onest --}}
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-page font-onest text-body antialiased">

<x-header></x-header>

<main id="main-content" class="mx-auto w-full max-w-[1720px] px-4 pb-16 sm:px-6 md:px-10 lg:pb-24 2xl:px-0">
    {{-- Хлебные крошки (макет: Onest, цвет #37241B) --}}
    <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-5 text-[15px] text-brand sm:pt-6 sm:text-[16px] 2xl:text-[18px]">
        <a href="{{ url('/') }}" class="transition-colors duration-200 hover:text-brandh focus-visible:outline-offset-2">Арт-Медика</a>
        <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto" aria-hidden="true">
        <span class="font-medium">Контакты</span>
    </nav>

    {{-- Заголовок страницы: «Контакты ↗» слева, вводный текст справа --}}
    <div class="mt-7 sm:mt-8 lg:mt-12">
        <div class="grid gap-4 lg:grid-cols-[1fr_2.5fr] lg:gap-10 items-start">
            <div>
                <p class="inline-flex items-baseline gap-2 text-[24px] font-medium text-[#91B5D5] sm:text-[28px] lg:text-[32px] 2xl:text-[40px]">
                    Контакты
                    <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </p>
            </div>

            <h1 class="text-center text-[18px] font-medium leading-[1.3] text-brand sm:text-[22px] lg:text-left lg:text-[28px] lg:[text-indent:140px] 2xl:text-[36px] 2xl:[text-indent:200px]">
                {{ $introText }}
            </h1>
        </div>
    </div>

    {{-- Блок интерактивной карты Яндекс --}}
    <section aria-label="Расположение центра на карте" class="mt-8 sm:mt-10 lg:mt-12">
        <div class="relative h-[320px] w-full overflow-hidden rounded-[20px] border border-[#E8EEF8] bg-[#F5F8FF] sm:h-[400px] sm:rounded-[24px] lg:h-[480px] 2xl:h-[540px]">
            {{-- Контейнер карты Яндекс (Челябинск, пр. Ленина 12а) --}}
            <div id="yandex-map" class="h-full w-full" data-lat="{{ $mapCoordinates['lat'] }}" data-lng="{{ $mapCoordinates['lng'] }}" data-zoom="{{ $mapCoordinates['zoom'] }}">
                {{-- Fallback: Яндекс Карты Виджет с точной меткой на здании Ленина 12А --}}
                <iframe
                    src="https://yandex.ru/map-widget/v1/?ll={{ $mapCoordinates['lng'] }}%2C{{ $mapCoordinates['lat'] }}&z={{ $mapCoordinates['zoom'] }}&pt={{ $mapCoordinates['lng'] }}%2C{{ $mapCoordinates['lat'] }}%2Cpm2blm"
                    width="100%"
                    height="100%"
                    frameborder="0"
                    allowfullscreen="true"
                    loading="lazy"
                    title="Карта проезда: Челябинск, проспект Ленина 12А, МКЦ «Арт-Медика»"
                    class="h-full w-full border-0">
                </iframe>
            </div>
        </div>
    </section>

    {{-- Мессенджеры в мобильной версии: строго под картой перед блоками --}}
    <div class="mt-4 flex items-center gap-3 py-1 lg:hidden">
        @if(!empty($socialIcons['max']))
            <a href="{{ $socials['max'] ?? '#' }}" target="_blank" rel="noopener"
               aria-label="Написать нам в MAX"
               class="grid h-12 w-12 place-items-center overflow-hidden rounded-full bg-white shadow-sm transition-transform duration-200 hover:scale-105 active:scale-95 focus-visible:outline-offset-2">
                <img src="{{ $socialIcons['max'] }}" alt="MAX" class="h-12 w-12 object-contain">
            </a>
        @endif
        @if(!empty($socialIcons['vk']))
            <a href="{{ $socials['vk'] ?? '#' }}" target="_blank" rel="noopener"
               aria-label="Мы ВКонтакте"
               class="grid h-12 w-12 place-items-center overflow-hidden rounded-full bg-white shadow-sm transition-transform duration-200 hover:scale-105 active:scale-95 focus-visible:outline-offset-2">
                <img src="{{ $socialIcons['vk'] }}" alt="VK" class="h-12 w-12 object-contain">
            </a>
        @endif
        @if(!empty($socialIcons['telegram']))
            <a href="{{ $socials['telegram'] ?? '#' }}" target="_blank" rel="noopener"
               aria-label="Мы в Telegram"
               class="grid h-12 w-12 place-items-center overflow-hidden rounded-full bg-white shadow-sm transition-transform duration-200 hover:scale-105 active:scale-95 focus-visible:outline-offset-2">
                <img src="{{ $socialIcons['telegram'] }}" alt="Telegram" class="h-12 w-12 object-contain">
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
                    <h2 class="text-[18px] font-bold text-ink sm:text-[20px] 2xl:text-[22px]">Адрес</h2>
                    <div class="mt-4 text-[14px] leading-relaxed text-body sm:text-[15px] 2xl:text-[16px]">
                        <p class="whitespace-pre-line">{{ $contacts['address'] ?? '454007, Челябинская область, г. Челябинск, проспект Ленина 12 "А" (рядом Театр ЧТЗ)' }}</p>
                    </div>
                </div>
                <div class="mt-5 pt-2">
                    <a href="https://yandex.ru/maps/?rtext=~{{ $mapCoordinates['lat'] }},{{ $mapCoordinates['lng'] }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-1.5 text-[13px] font-semibold text-[#2563EB] transition-colors duration-200 hover:text-[#1D4ED8] focus-visible:outline-offset-2">
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
                    <h2 class="text-[18px] font-bold text-ink sm:text-[20px] 2xl:text-[22px]">Телефоны</h2>
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
                    <h2 class="text-[18px] font-bold text-ink sm:text-[20px] 2xl:text-[22px]">E-mail</h2>
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
                    <h2 class="text-[18px] font-bold text-ink sm:text-[20px] 2xl:text-[22px]">Сообщения</h2>
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
                    <h2 class="text-[18px] font-bold text-ink sm:text-[20px] 2xl:text-[22px]">Режим работы</h2>
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
                       class="grid h-12 w-12 place-items-center overflow-hidden rounded-full bg-white shadow-sm transition-transform duration-200 hover:scale-110 active:scale-95 focus-visible:outline-offset-2 2xl:h-14 2xl:w-14">
                        <img src="{{ $socialIcons['max'] }}" alt="MAX" class="h-12 w-12 object-contain 2xl:h-14 2xl:w-14">
                    </a>
                @endif
                @if(!empty($socialIcons['vk']))
                    <a href="{{ $socials['vk'] ?? '#' }}" target="_blank" rel="noopener"
                       aria-label="Мы ВКонтакте"
                       class="grid h-12 w-12 place-items-center overflow-hidden rounded-full bg-white shadow-sm transition-transform duration-200 hover:scale-110 active:scale-95 focus-visible:outline-offset-2 2xl:h-14 2xl:w-14">
                        <img src="{{ $socialIcons['vk'] }}" alt="VK" class="h-12 w-12 object-contain 2xl:h-14 2xl:w-14">
                    </a>
                @endif
                @if(!empty($socialIcons['telegram']))
                    <a href="{{ $socials['telegram'] ?? '#' }}" target="_blank" rel="noopener"
                       aria-label="Мы в Telegram"
                       class="grid h-12 w-12 place-items-center overflow-hidden rounded-full bg-white shadow-sm transition-transform duration-200 hover:scale-110 active:scale-95 focus-visible:outline-offset-2 2xl:h-14 2xl:w-14">
                        <img src="{{ $socialIcons['telegram'] }}" alt="Telegram" class="h-12 w-12 object-contain 2xl:h-14 2xl:w-14">
                    </a>
                @endif
            </div>
        </div>
    </section>
</main>

<x-footer></x-footer>

{{-- Скрипт Яндекс.Карт с интерактивной меткой на здании Ленина 12А --}}
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script>
    if (typeof ymaps !== 'undefined') {
        ymaps.ready(function () {
            var container = document.getElementById('yandex-map');
            if (!container) return;
            var lat = parseFloat(container.dataset.lat) || 55.161095;
            var lng = parseFloat(container.dataset.lng) || 61.448844;
            var zoom = parseInt(container.dataset.zoom, 10) || 16;

            // Очищаем контейнер от iframe-фолбэка перед инициализацией полноценного API
            container.innerHTML = '';

            var map = new ymaps.Map(container, {
                center: [lat, lng],
                zoom: zoom,
                controls: ['zoomControl', 'fullscreenControl']
            });

            var placemark = new ymaps.Placemark([lat, lng], {
                hintContent: 'Медико-косметологический центр «Арт-Медика»',
                balloonContentHeader: '<div style="font-weight:700;font-size:15px;color:#37241B;">Арт-Медика</div>',
                balloonContentBody: '<div style="font-size:13px;color:#212529;line-height:1.4;">' +
                    '<p><strong>Адрес:</strong> Челябинск, пр. Ленина 12А (здание 12а рядом с Театром ЧТЗ)</p>' +
                    '<p><strong>Режим:</strong> ПН-СБ с 9:00 до 20:00</p>' +
                    '<p><strong>Телефон:</strong> <a href="tel:+73517751918">+7 (351) 775-19-18</a></p>' +
                '</div>',
                balloonContentFooter: '<a href="https://yandex.ru/maps/?rtext=~' + lat + ',' + lng + '" target="_blank" rel="noopener" style="color:#2563EB;font-weight:600;">Проложить маршрут в Яндекс.Картах →</a>'
            }, {
                preset: 'islands#blueDotIcon'
            });

            map.geoObjects.add(placemark);
            map.behaviors.disable('scrollZoom');
        });
    }
</script>

</body>
</html>
