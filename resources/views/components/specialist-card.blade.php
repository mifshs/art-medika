@props(['expert'])

@php
    $avatarUrl = $expert->avatarUrl();
    $deptName = $expert->department?->name ?? 'Специалист';
    $detailUrl = route('specialists.show', $expert->slug);
@endphp

{{-- Карточка специалиста (макет Figma: фон #F4F7FD, скругление, фото слева/сверху, Onest) --}}
<article data-department="{{ $deptName }}"
         class="group relative flex flex-col justify-between rounded-[20px] bg-[#F4F7FD] p-4 transition-all duration-300 hover:shadow-md sm:flex-row sm:gap-5 sm:p-5 lg:gap-6 lg:p-6 2xl:p-7">
    {{-- Фотография специалиста --}}
    <a href="{{ $detailUrl }}"
       class="relative block shrink-0 overflow-hidden rounded-[16px] sm:w-[170px] lg:w-[200px] 2xl:w-[220px]">
        @if ($avatarUrl)
            <img src="{{ $avatarUrl }}" alt="{{ $expert->name }}" loading="lazy"
                 class="aspect-[4/5] w-full object-cover object-top transition-transform duration-500 group-hover:scale-105 sm:h-full">
        @else
            <div class="flex aspect-[4/5] w-full items-center justify-center bg-slate-200 text-slate-400 sm:h-full">
                <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
        @endif
    </a>

    {{-- Текстовая информация о специалисте --}}
    <div class="mt-4 flex flex-1 flex-col justify-between sm:mt-0">
        <div>
            {{-- Верхняя строка: Отделение и стрелка перехода ↗ --}}
            <div class="flex items-center justify-between gap-2 text-[13px] text-[#7E93AC] sm:text-[14px]">
                <span>{{ $deptName }}</span>
                <a href="{{ $detailUrl }}" aria-label="Открыть профиль «{{ $expert->name }}»"
                   class="inline-flex h-5 w-5 shrink-0 items-center justify-center text-[#1A1A1A] transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M7 17L17 7H8.5M17 7v8.5"/>
                    </svg>
                </a>
            </div>

            {{-- ФИО специалиста --}}
            <h3 class="mt-2 text-[18px] font-semibold leading-[1.25] text-body transition-colors group-hover:text-brand sm:text-[20px] lg:text-[22px] 2xl:text-[24px]">
                <a href="{{ $detailUrl }}" class="transition-colors hover:text-brand">
                    {{ $expert->name }}
                </a>
            </h3>

            {{-- Должность и описание деятельности --}}
            @if ($expert->position)
                <p class="mt-2.5 text-[12px] leading-relaxed text-[#4A5568] sm:text-[13px] 2xl:text-[14px] line-clamp-4 lg:line-clamp-6">
                    {{ $expert->position }}
                </p>
            @endif
        </div>

        {{-- Ссылка «Подробнее» для доступности --}}
        <div class="mt-4 pt-1 sm:mt-auto">
            <a href="{{ $detailUrl }}" class="inline-flex items-center gap-1.5 text-[13px] font-medium text-brand transition-colors hover:text-brandh sm:text-[14px]">
                <span>Подробнее о специалисте</span>
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</article>
