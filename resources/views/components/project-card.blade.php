@props(['project'])

@php
    $coverUrl = $project->coverUrl();
    $date = $project->published_at ? \Illuminate\Support\Carbon::parse($project->published_at)->format('d.m.Y') : '';
    $excerpt = $project->excerpt ?? $project->description ?? '';
@endphp

<article id="project-{{ $project->slug }}"
         data-project-slug="{{ $project->slug }}"
         data-project-id="{{ $project->id }}"
         class="group relative scroll-mt-24 sm:scroll-mt-28 lg:scroll-mt-32 rounded-[20px] bg-[#F4F7FF] p-4 sm:rounded-[24px] sm:p-5 lg:p-5 2xl:p-6 transition-all duration-300">

    {{-- Скрытый якорь для скролла по числовому id --}}
    <span id="project-{{ $project->id }}" class="absolute -top-28" aria-hidden="true"></span>

    <div class="grid grid-cols-1 lg:grid-cols-[46%_1fr] lg:gap-8 2xl:grid-cols-[48%_1fr] 2xl:gap-10">
        {{-- Фотография с внутренними скруглёнными краями --}}
        <div class="relative overflow-hidden rounded-[14px] sm:rounded-[18px]">
            @if ($coverUrl)
                <img src="{{ $coverUrl }}" alt="{{ $project->title }}" width="960" height="640" loading="lazy"
                     class="h-[195px] w-full object-cover transition-transform duration-500 group-hover:scale-[1.02] sm:h-[260px] lg:h-full lg:min-h-[320px] 2xl:min-h-[380px]">
            @else
                <div class="flex h-[195px] w-full items-center justify-center bg-surfaceh sm:h-[260px] lg:h-full lg:min-h-[320px]">
                    <svg class="h-14 w-14 text-border" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            @endif
        </div>

        {{-- Правая колонка контента (на мобильных — под фото) --}}
        <div class="flex flex-col justify-between pt-3.5 sm:pt-4 lg:pt-1 lg:pb-1 lg:pr-4 2xl:pr-6">
            {{-- Верхняя строка: Метка «Проекты» и стрелка ↗ --}}
            <div class="flex items-center justify-between gap-4">
                <span class="text-[13px] text-body sm:text-[14px] 2xl:text-[15px]">Проекты</span>
                <a href="#project-{{ $project->slug }}"
                   aria-label="Открыть проект «{{ $project->title }}»"
                   class="shrink-0 text-ink transition-colors hover:text-brand">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 17L17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            {{-- Заголовок --}}
            <h2 class="mt-3 text-[18px] font-semibold leading-snug text-ink sm:mt-5 sm:text-[22px] lg:text-[24px] 2xl:text-[28px] lg:leading-tight">
                {{ $project->title }}
            </h2>

            {{-- Описание: аккуратно обрезается по 6 строкам на мобильных как на фото 2, полный текст на десктопе --}}
            @if ($excerpt)
                <p class="mt-2.5 text-[13px] leading-relaxed text-body line-clamp-6 sm:line-clamp-none sm:mt-3.5 sm:text-[14px] lg:text-[15px] 2xl:mt-4 2xl:text-[16px]">
                    {{ $excerpt }}
                </p>
            @endif

            {{-- Кнопка «Подробнее»: круглая капсула (pill) высотой ~52px на десктопе --}}
            <div class="mt-4 sm:mt-6">
                <a href="#project-{{ $project->slug }}"
                   class="inline-flex h-[42px] sm:h-[52px] px-7 sm:px-8 items-center justify-center rounded-full bg-brand text-[13px] sm:text-[14px] font-semibold text-white transition-all hover:bg-brandh shadow-sm">
                    Подробнее
                </a>
            </div>

            {{-- Дата публикации --}}
            @if ($date)
                <div class="mt-3.5 pt-1 sm:mt-5 lg:mt-auto 2xl:pt-4">
                    <p class="text-[13px] font-normal text-[#91B5D5] sm:text-[14px] 2xl:text-[15px]">
                        {{ $date }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</article>
