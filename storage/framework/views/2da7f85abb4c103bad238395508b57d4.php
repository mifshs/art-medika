<style>[x-cloak]{display:none!important}</style>

<div class="mx-auto w-full max-w-[1720px] space-y-3">

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $directions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $direction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div x-data="{ open: false }" class="acc-item">

            <button type="button" @click="open = !open"
                    :class="open ? 'rounded-t-2xl' : 'rounded-2xl'"
                    class="flex h-16 w-full items-center justify-between bg-surfaceh px-6 text-left transition-colors hover:bg-[#E2E7F1] sm:h-24 sm:px-10">
                <span class="text-[20px] font-semibold leading-tight text-brand sm:text-[24px] lg:text-[28px] 2xl:text-[32px]">
                    <?php echo e($direction['title']); ?>

                </span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     class="h-6 w-6 shrink-0 text-brand transition-transform duration-300 sm:h-8 sm:w-8 2xl:h-9 2xl:w-9"
                     :class="open ? 'rotate-180' : 'rotate-0'">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m0 0l6-6m-6 6l-6-6"/>
                </svg>
            </button>

            <div x-show="open" x-collapse x-cloak
                 class="rounded-b-2xl bg-white pb-6 pt-2 sm:pb-8">
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 2xl:grid-cols-3 2xl:gap-6 ">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $direction['cards']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginale804957ecdb153e8c822de5ed47a4ace = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale804957ecdb153e8c822de5ed47a4ace = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.service-card','data' => ['title' => $card['title'],'image' => $card['image'],'services' => $card['services']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('service-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['title']),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['image']),'services' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['services'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale804957ecdb153e8c822de5ed47a4ace)): ?>
<?php $attributes = $__attributesOriginale804957ecdb153e8c822de5ed47a4ace; ?>
<?php unset($__attributesOriginale804957ecdb153e8c822de5ed47a4ace); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale804957ecdb153e8c822de5ed47a4ace)): ?>
<?php $component = $__componentOriginale804957ecdb153e8c822de5ed47a4ace; ?>
<?php unset($__componentOriginale804957ecdb153e8c822de5ed47a4ace); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>
<?php /**PATH F:\xampp\htdocs\art-medic\art-medika\resources\views/livewire/services/accordion.blade.php ENDPATH**/ ?>