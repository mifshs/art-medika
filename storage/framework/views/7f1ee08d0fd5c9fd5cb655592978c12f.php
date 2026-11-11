<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['document']));

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

foreach (array_filter((['document']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $downloadUrl = route('documents.download', $document->id);
?>


<a href="<?php echo e($downloadUrl); ?>"
   download
   title="Скачать документ «<?php echo e($document->title); ?>»"
   class="group flex items-center justify-between gap-4 py-3 sm:py-4 transition-colors hover:text-brand border-b border-[#E4E7EE]/50 last:border-b-0">
    <div class="flex items-center gap-3 sm:gap-4 min-w-0">
        
        <span class="inline-flex h-6 w-6 sm:h-7 sm:w-7 shrink-0 items-center justify-center text-[#7E93AC] transition-colors group-hover:text-brand" aria-hidden="true">
            <svg class="h-5 w-5 sm:h-6 sm:w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
                <line x1="10" y1="9" x2="8" y2="9"/>
            </svg>
        </span>

        
        <span class="text-[14px] font-medium leading-snug text-body transition-colors group-hover:text-brand sm:text-[16px] 2xl:text-[18px] break-words">
            <?php echo e($document->title); ?>

        </span>
    </div>

    
    <span class="inline-flex h-9 w-9 sm:h-10 sm:w-10 shrink-0 items-center justify-center rounded-lg text-[#1A1A1A] transition-all group-hover:bg-[#E2E7F1] group-hover:text-brand" aria-label="Скачать">
        <svg class="h-5 w-5 sm:h-6 sm:w-6 transition-transform duration-200 group-hover:translate-y-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
            <polyline points="7 10 12 15 17 10"/>
            <line x1="12" y1="15" x2="12" y2="3"/>
        </svg>
    </span>
</a>
<?php /**PATH E:\Xampp\htdocs\Art-medika\art-medika\resources\views/components/document-item.blade.php ENDPATH**/ ?>