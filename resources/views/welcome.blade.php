<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Медицинская клиника - Ваше здоровье наша забота</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<x-header></x-header>
<body>
    <section class="relative min-h-[600px] h-[80vh] max-h-[1000px] w-full overflow-hidden bg-slate-400">
        <div class="absolute inset-0 bg-slate-400" aria-hidden="true"></div>

        <div class="relative z-10 flex h-full w-full flex-col justify-between px-6 py-10 sm:px-10 sm:py-14 lg:px-[7%]">
            <div class="max-w-4xl">
                <h1 class="text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-[56px]">
                    Ваше здоровье — наша забота
                </h1>
                <p class="mt-4 max-w-[820px] text-base leading-[1.35] text-white/90 sm:text-lg lg:text-xl">
                    Медико-косметологический центр с современным<br class="hidden sm:block">
                    оборудованием и опытными специалистами
                </p>
            </div>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-stretch">
                <div class="w-full sm:w-[184px]">
                    <div class="min-h-[140px] rounded-[9px] border border-white/10 bg-slate-700/45 p-4 text-white backdrop-blur-md">
                        <span class="block text-[42px] font-normal leading-none">20</span>
                        <span class="mt-[18px] block text-sm leading-[1.35] text-white/90 sm:text-base">
                            лет опыта работы<br>в сфере медицины
                        </span>
                    </div>
                </div>

                <div class="w-full sm:w-[260px]">
                    <div class="min-h-[140px] rounded-[9px] border border-white/10 bg-slate-700/45 p-4 text-white backdrop-blur-md">
                        <span class="block text-[42px] font-normal leading-none">20</span>
                        <span class="mt-[18px] block text-sm leading-[1.35] text-white/90 sm:text-base">
                            видов медицинских<br>направлений деятельности
                        </span>
                    </div>
                </div>

                <div class="w-full sm:w-[203px]">
                    <div class="min-h-[140px] rounded-[9px] border border-white/10 bg-slate-700/45 p-4 text-white backdrop-blur-md">
                        <span class="block text-[42px] font-normal leading-none">40+</span>
                        <span class="mt-[18px] block text-sm leading-[1.35] text-white/90 sm:text-base">
                            квалифицированных<br>специалистов
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <a
            class="absolute bottom-6 right-6 z-10 h-12 w-12 rounded-full bg-[#422f2a] shadow-[0_6px_18px_rgba(0,0,0,0.2)] lg:bottom-14 lg:right-[7%]"
            href="tel:+79990000000"
            aria-label="Позвонить"
        ></a>
    </section>
</body>
</html>
