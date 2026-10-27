<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['faq', 'open' => false]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['faq', 'open' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>


<div x-data="{ open: <?php echo json_encode($open, 15, 512) ?> }"
     class="faq-item rounded-[16px] bg-[#F3F6FD] transition-colors hover:bg-[#EEF2FB] sm:rounded-[20px]">
    <button type="button"
            @click="open = !open"
            :aria-expanded="open"
            class="flex w-full cursor-pointer items-center justify-between gap-4 px-5 py-4 text-left sm:px-7 sm:py-5">
        
        <span class="text-[15px] font-medium leading-snug text-[#1A1A1A] sm:text-[17px] 2xl:text-[18px]">
            <?php echo e($faq->question); ?>

        </span>

        
        <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center text-[#1A1A1A] transition-transform duration-300"
              :class="{ 'rotate-180': open }">
            <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 5v14M19 12l-7 7-7-7"/>
            </svg>
        </span>
    </button>

    
    <div x-show="open" x-collapse x-cloak>
        <div class="px-5 pb-5 pt-0 text-[14px] leading-relaxed text-[#4A5568] sm:px-7 sm:pb-6 sm:text-[15px] 2xl:text-[16px]">
            <?php echo nl2br(e($faq->answer)); ?>

        </div>
    </div>
</div>
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/components/faq-item.blade.php ENDPATH**/ ?>