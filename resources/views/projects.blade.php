<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проекты — Медико-косметологический центр «Арт-Медика»</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Шрифт макета — Onest, применяется только на странице «Проекты» --}}
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
  <body class="bg-page font-onest text-body antialiased">

<x-header></x-header>

<main class="mx-auto w-full max-w-[1720px] px-[18px] pb-14 sm:px-6 md:px-10 lg:pb-24 2xl:px-0">
    {{-- Хлебные крошки (макет: Onest 18px, цвет #37241B) --}}
    <nav aria-label="Хлебные крошки" class="flex items-center gap-2 pt-5 sm:pt-6 text-[15px] sm:text-[16px] 2xl:text-[18px] text-brand">
        <a href="{{ url('/') }}" class="transition-colors duration-200 hover:text-brandh">Арт-Медика</a>
        <img src="{{ asset('images/_.svg') }}" alt="" class="h-3 w-auto" aria-hidden="true">
        <span class="font-medium">Проекты</span>
    </nav>

    {{-- Заголовок раздела: метка слева, интро справа с красной строкой (макет: indent 102px / 290px) --}}
    <div class="mt-7 sm:mt-8 lg:mt-14">
        <div class="grid gap-4 lg:grid-cols-[1fr_2fr] lg:gap-10">
            {{-- Левая колонка: метка «Проекты ↗» (макет: Onest 40px, medium, #91B5D5) --}}
            <div>
                <p class="inline-flex items-baseline gap-2 text-[24px] font-medium text-[#91B5D5] sm:text-[28px] lg:text-[32px] 2xl:text-[40px]">
                    Проекты
                    <svg class="h-[0.8em] w-[0.8em] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </p>
            </div>

            {{-- Правая колонка: интро дословно из макета, шрифт Onest 24px/40px, weight 500, #37241B --}}
            <h1 class="text-[24px] font-medium leading-[1.3] text-brand text-left sm:text-[26px] lg:text-[36px] 2xl:text-[40px] [text-indent:102px] lg:[text-indent:240px] 2xl:[text-indent:290px]">
                Подбираем для вас<br class="sm:hidden">
                самых актуальных<br class="max-sm:hidden">
                и интересные<br class="sm:hidden">
                проекты из нашей практики,<br class="sm:hidden">
                медицины<br class="max-sm:hidden">
                и эстетической<br class="sm:hidden">
                хирургии, с заботой о вас
            </h1>
        </div>
    </div>

    {{-- Список проектов --}}
    @if ($projects->isNotEmpty())
        <div class="mt-10 space-y-5 sm:mt-12 sm:space-y-6 lg:mt-14 2xl:space-y-8">
            @foreach ($projects as $project)
                <x-project-card :project="$project" />
            @endforeach
        </div>
    @else
        <div class="mt-12 rounded-[20px] bg-[#F4F7FF] px-8 py-16 text-center">
            <p class="text-[20px] font-medium text-ink">Активных проектов пока нет</p>
            <p class="mt-2 text-[15px] text-muted">Заглядывайте позже — мы регулярно добавляем новые проекты.</p>
        </div>
    @endif
</main>

<x-footer></x-footer>

{{-- Скрипт плавного скролла к выбранному проекту по хэшу URL --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function scrollToTarget() {
            var hash = window.location.hash;
            if (!hash) return;

            var clean = decodeURIComponent(hash.replace(/^#/, ''));
            var target = document.getElementById(clean)
                      || document.querySelector('[data-project-slug="' + clean + '"]')
                      || document.querySelector('[data-project-id="' + clean + '"]');

            if (target) {
                var card = target.closest('article') || target;
                setTimeout(function () {
                    card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    card.classList.add('ring-2', 'ring-brand', 'shadow-xl');
                    setTimeout(function () {
                        card.classList.remove('ring-2', 'ring-brand', 'shadow-xl');
                    }, 2400);
                }, 150);
            }
        }

        scrollToTarget();
        window.addEventListener('hashchange', scrollToTarget);
    });
</script>

</body>
</html>
