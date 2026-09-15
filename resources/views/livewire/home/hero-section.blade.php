<section class="relative min-h-[600px] md:min-h-screen w-full overflow-hidden">
    {{-- Фоновое изображение с оверлеем --}}
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/60 to-slate-900/40 z-10"></div>
        <img 
            src="{{ $backgroundImage }}" 
            alt="Врач консультирует пациентку" 
            class="w-full h-full object-cover"
            onerror="this.src='https://images.unsplash.com/photo-1638202993928-7267aad84c31?w=1920&h=1080&fit=crop'"
        >
    </div>

    {{-- Контент секции --}}
    <div class="relative z-20 container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 min-h-[500px]">
            
            {{-- Левая колонка: Заголовок, подзаголовок и статистика --}}
            <div class="lg:col-span-8 flex flex-col justify-between">
                
                {{-- Заголовок и подзаголовок (сверху слева) --}}
                <div class="mt-8 md:mt-16">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight">
                        {{ $title }}
                    </h1>
                    <p class="text-lg md:text-xl text-gray-200 mt-4 max-w-2xl">
                        {{ $subtitle }}
                    </p>
                </div>

                {{-- Статистика (снизу слева) --}}
                <div class="mb-8 md:mb-0">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @foreach($stats as $stat)
                            <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20 hover:bg-white/20 transition duration-300">
                                <div class="text-3xl md:text-4xl font-bold text-white mb-2">
                                    {{ $stat['number'] }}
                                </div>
                                <div class="text-sm md:text-base text-gray-300">
                                    {{ $stat['label'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- Правая колонка: Кнопка связи (снизу справа) --}}
            <div class="lg:col-span-4 flex items-end justify-end pb-8 md:pb-0">
                <a 
                    href="tel:+79990000000" 
                    class="bg-amber-600 hover:bg-amber-700 text-white rounded-full p-4 md:p-6 shadow-lg hover:shadow-xl transition duration-300 transform hover:scale-105 group"
                    aria-label="Позвонить нам"
                >
                    <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.5" 
                        stroke="currentColor" 
                        class="w-8 h-8 md:w-10 md:h-10"
                    >
                        <path 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a17.509 17.509 0 0 1-8.316-8.316c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" 
                        />
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>
