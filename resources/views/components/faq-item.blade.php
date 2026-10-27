@props(['faq', 'open' => false])

{{-- Элемент аккордеона «Вопрос-ответ» (макет Figma: фон #F3F6FD, скруглённые углы, стрелка вниз/вверх) --}}
<div x-data="{ open: @json($open) }"
     class="faq-item rounded-[16px] bg-[#F3F6FD] transition-colors hover:bg-[#EEF2FB] sm:rounded-[20px]">
    <button type="button"
            @click="open = !open"
            :aria-expanded="open"
            class="flex w-full cursor-pointer items-center justify-between gap-4 px-5 py-4 text-left sm:px-7 sm:py-5">
        {{-- Текст вопроса --}}
        <span class="text-[15px] font-medium leading-snug text-[#1A1A1A] sm:text-[17px] 2xl:text-[18px]">
            {{ $faq->question }}
        </span>

        {{-- Стрелка-индикатор (при раскрытии поворачивается вверх ↑) --}}
        <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center text-[#1A1A1A] transition-transform duration-300"
              :class="{ 'rotate-180': open }">
            <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 5v14M19 12l-7 7-7-7"/>
            </svg>
        </span>
    </button>

    {{-- Раскрывающийся блок ответа с анимацией collapse --}}
    <div x-show="open" x-collapse x-cloak>
        <div class="px-5 pb-5 pt-0 text-[14px] leading-relaxed text-[#4A5568] sm:px-7 sm:pb-6 sm:text-[15px] 2xl:text-[16px]">
            {!! nl2br(e($faq->answer)) !!}
        </div>
    </div>
</div>
