<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Медицинская клиника - Ваше здоровье наша забота</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <x-header>
</x-header>
<body>
    
    {{-- Hero секция медицинской клиники --}}
    <section class="relative min-h-screen w-full overflow-hidden" style="min-height: 600px;">
        
        {{-- Фоновое изображение с оверлеем --}}
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" 
             style="background-image: url('/images/clinic/hero-doctor-consultation.jpg');">
            {{-- Градиентный оверлей для читаемости текста --}}
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/60 to-slate-900/40"></div>
        </div>
        
        {{-- Контент секции --}}
        <div class="relative z-10 container mx-auto px-4 py-12 h-full flex flex-col justify-between">
            
            {{-- Заголовок и подзаголовок (сверху слева) --}}
            <div class="pt-12 md:pt-20 max-w-3xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight">
                    Ваше здоровье — наша забота
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mt-4 max-w-2xl">
                    Медико-косметологический центр с современным оборудованием и опытными специалистами
                </p>
            </div>
            
            {{-- Нижняя часть: статистика слева, кнопка справа --}}
            <div class="pb-8 md:pb-12">
                <div class="flex flex-col lg:flex-row items-start lg:items-end justify-between gap-8">
                    
                    {{-- Карточки статистики --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full lg:w-auto">
                        
                        {{-- Карточка 1 --}}
                        <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20 hover:bg-white/20 transition duration-300">
                            <span class="text-4xl md:text-5xl font-bold text-white block mb-2">20</span>
                            <span class="text-gray-200 text-sm md:text-base">лет опыта работы в сфере медицины</span>
                        </div>
                        
                        {{-- Карточка 2 --}}
                        <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20 hover:bg-white/20 transition duration-300">
                            <span class="text-4xl md:text-5xl font-bold text-white block mb-2">20</span>
                            <span class="text-gray-200 text-sm md:text-base">видов медицинских направлений деятельности</span>
                        </div>
                        
                        {{-- Карточка 3 --}}
                        <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20 hover:bg-white/20 transition duration-300">
                            <span class="text-4xl md:text-5xl font-bold text-white block mb-2">40+</span>
                            <span class="text-gray-200 text-sm md:text-base">квалифицированных специалистов</span>
                        </div>
                        
                    </div>
                    
                    {{-- Кнопка связи (справа снизу) --}}
                    <div class="flex-shrink-0">
                        <a href="tel:+79990000000" 
                           class="inline-flex items-center justify-center bg-amber-600 hover:bg-amber-700 text-white rounded-full p-4 transition duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="h-8 w-8" 
                                 fill="none" 
                                 viewBox="0 0 24 24" 
                                 stroke="currentColor" 
                                 stroke-width="2">
                                <path stroke-linecap="round" 
                                      stroke-linejoin="round" 
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </a>
                    </div>
                    
                </div>
            </div>
            
        </div>
        
    </section>

</body>
</html>