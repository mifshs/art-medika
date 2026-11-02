@props(['document'])

@php
    $downloadUrl = route('documents.download', $document->id);
@endphp

{{-- Элемент списка документов: иконка файла 📄 слева, название по центру, иконка скачивания 📥 справа --}}
<a href="{{ $downloadUrl }}"
   download
   title="Скачать документ «{{ $document->title }}»"
   class="group flex items-center justify-between gap-4 py-3 sm:py-4 transition-colors hover:text-brand border-b border-[#E4E7EE]/50 last:border-b-0">
    <div class="flex items-center gap-3 sm:gap-4 min-w-0">
        {{-- Иконка документа с загнутым уголком (Figma макет) --}}
        <span class="inline-flex h-6 w-6 sm:h-7 sm:w-7 shrink-0 items-center justify-center text-[#7E93AC] transition-colors group-hover:text-brand" aria-hidden="true">
            <svg class="h-5 w-5 sm:h-6 sm:w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
                <line x1="10" y1="9" x2="8" y2="9"/>
            </svg>
        </span>

        {{-- Название документа --}}
        <span class="text-[14px] font-medium leading-snug text-body transition-colors group-hover:text-brand sm:text-[16px] 2xl:text-[18px] break-words">
            {{ $document->title }}
        </span>
    </div>

    {{-- Иконка загрузки (стрелка в лоток) с тач-зоной --}}
    <span class="inline-flex h-9 w-9 sm:h-10 sm:w-10 shrink-0 items-center justify-center rounded-lg text-[#1A1A1A] transition-all group-hover:bg-[#E2E7F1] group-hover:text-brand" aria-label="Скачать">
        <svg class="h-5 w-5 sm:h-6 sm:w-6 transition-transform duration-200 group-hover:translate-y-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
            <polyline points="7 10 12 15 17 10"/>
            <line x1="12" y1="15" x2="12" y2="3"/>
        </svg>
    </span>
</a>
