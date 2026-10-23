@props(['project'])

@php
    $coverUrl = $project->coverUrl();
    $date = $project->published_at ? \Illuminate\Support\Carbon::parse($project->published_at)->format('d.m.Y') : '';
    // Текст из макета — дословно (desktop/mobile варианты с обрезкой как в макете); БД не меняется
    $mock = config('projects.mock_texts.' . $project->slug);
    $desktopText = $mock['desktop'] ?? ($project->excerpt ?? $project->description ?? '');
    $mobileText = $mock['mobile'] ?? null;
@endphp

<article id="project-{{ $project->slug }}"
         data-project-slug="{{ $project->slug }}"
         data-project-id="{{ $project->id }}"
         class="group relative scroll-mt-24 sm:scroll-mt-28 lg:scroll-mt-32 rounded-[20px] bg-[#F4F7FF] p-4 sm:rounded-[24px] sm:p-5 lg:p-6 2xl:p-8 transition-all duration-300">

    {{-- Скрытый якорь для скролла по числовому id --}}
    <span id="project-{{ $project->id }}" class="absolute -top-28" aria-hidden="true"></span>

    <div class="grid grid-cols-1 lg:grid-cols-[46%_1fr] lg:gap-8 2xl:grid-cols-[48%_1fr] 2xl:gap-10">
        {{-- Фотография с внутренними скруглёнными краями --}}
        <div class="relative overflow-hidden rounded-[14px] sm:rounded-[18px]">
            @if ($coverUrl)
                <img src="{{ $coverUrl }}" alt="{{ $project->title }}" width="960" height="640" loading="lazy"
                     class="h-[220px] w-full object-cover transition-transform duration-500 sm:h-[260px] lg:h-full lg:min-h-[320px] 2xl:min-h-[380px]">
            @else
                <div class="flex h-[220px] w-full items-center justify-center bg-surface sm:h-[260px] lg:h-full lg:min-h-[320px]">
                    <svg class="h-14 w-14 text-border" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            @endif
        </div>

        {{-- Правая колонка контента (на мобильных — под фото) --}}
        <div class="flex flex-col justify-between pt-3.5 sm:pt-4 lg:pt-1 lg:pb-1 lg:pr-4 2xl:pr-6">
            {{-- Верхняя строка: Метка «Проекты» и стрелка ↗ (макет: Onest 16px, #1D293D) --}}
            <div class="flex items-center justify-between gap-4">
                <span class="text-[15px] text-[#1D293D] 2xl:text-[16px]">Проекты</span>
                <a href="#project-{{ $project->slug }}"
                   aria-label="Открыть проект «{{ $project->title }}»"
                   class="shrink-0 text-[#1D293D] transition-colors hover:text-brand">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 17L17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            {{-- Заголовок (макет: Onest 24px / 36px, medium, #212529) --}}
            <h2 class="mt-3 text-[24px] font-medium leading-[1.22] text-body sm:mt-5 sm:text-[26px] lg:text-[30px] 2xl:text-[36px] 2xl:leading-[1.22]">
                {{ $project->title }}
            </h2>

            {{-- Описание: дословно из макета — обрезано в тех же местах (в т.ч. посимвольно «...»); без лишних переносов --}}
            @if ($desktopText)
                @if ($mobileText)
                    <p class="mt-2.5 text-[16px] leading-6 text-body sm:mt-0 sm:hidden" data-body="mobile">
                        {{ $mobileText }}
                    </p>
                    <p class="mt-0 hidden text-[16px] leading-6 text-body sm:mt-3.5 sm:block lg:text-[17px] 2xl:mt-4 2xl:text-[20px] 2xl:leading-7" data-body="desktop">
                        {{ $desktopText }}
                    </p>
                @else
                    <p class="mt-2.5 text-[16px] leading-6 text-body sm:mt-3.5 lg:text-[17px] 2xl:mt-4 2xl:text-[20px] 2xl:leading-7" data-body="desktop">
                        {{ $desktopText }}
                    </p>
                @endif
            @endif

            {{-- Кнопка «Подробнее»: круглая капсула (макет: Onest 16px, semibold) --}}
            <div class="mt-4 sm:mt-6">
                <a href="#project-{{ $project->slug }}"
                   class="inline-flex h-11 sm:h-[52px] px-10 items-center justify-center rounded-full bg-brand text-[16px] font-semibold text-white transition-all hover:bg-[#2A1A13] shadow-sm">
                    Подробнее
                </a>
            </div>

            {{-- Дата публикации (макет: Onest 16px / 20px, #91B5D5) --}}
            @if ($date)
                <div class="mt-5 lg:mt-auto 2xl:pt-4">
                    <p class="text-[15px] font-normal text-[#91B5D5] sm:text-[16px] 2xl:text-[20px]">
                        {{ $date }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</article>
