<div class="bg-[#F5F7FF] rounded-[32px] p-6 md:p-8 xl:p-12">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-stretch">
        
        <!-- Изображение слева -->
        <div class="relative order-2 lg:order-1">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project['image']): ?>
                <img src="<?php echo e($project['image']); ?>" 
                     alt="<?php echo e($project['title']); ?>"
                     class="w-full h-[300px] md:h-[400px] lg:h-[500px] object-cover rounded-[24px]">
            <?php else: ?>
                <div class="w-full h-[300px] md:h-[400px] lg:h-[500px] bg-gray-200 rounded-[24px] flex items-center justify-center">
                    <span class="text-gray-400">Нет изображения</span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Контент справа -->
        <div class="flex flex-col h-full order-1 lg:order-2 min-h-[300px] md:min-h-[400px] lg:min-h-[500px]">
            
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <span class="text-[#1D293D] text-lg font-medium">Проекты</span>
                    <a href="/projects/<?php echo e($project['slug']); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                             stroke-width="1.5" stroke="currentColor" 
                             class="w-6 h-6 text-[#1a1a1a] hover:text-gray-600 transition-colors">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                    </a>
                </div>

                <!-- Заголовок проекта -->
                <h2 class="text-[28px] md:text-[32px] lg:text-[40px] font-medium text-[#1a1a1a] leading-tight">
                    <?php echo e($project['title']); ?>

                </h2>

                <!-- Описание -->
                <p class="text-[#555555] text-base md:text-lg leading-relaxed">
                    <?php echo e($project['description']); ?>

                </p>

                <!-- Кнопка с отступом 20px сверху -->
                <div class="pt-5">
                    <a href="/projects/<?php echo e($project['slug']); ?>" 
                       class="inline-block bg-[#2D241F] hover:bg-[#1a1612] text-white px-8 py-4 rounded-full text-lg font-medium transition-colors duration-300">
                        Подробнее
                    </a>
                </div>
            </div>

            <!-- Дата прижата к низу -->
            <div class="mt-auto pt-6">
                <span class="text-[#91B5D5] text-base md:text-lg">
                    <?php echo e($project['date']); ?>

                </span>
            </div>

        </div>

    </div>
</div><?php /**PATH D:\xampp\htdocs\art-medika\resources\views/livewire/stock/project-card.blade.php ENDPATH**/ ?>