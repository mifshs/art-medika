@props(['project'])

@php
    $coverUrl = $project->coverUrl();
    $date = $project->published_at ? \Illuminate\Support\Carbon::parse($project->published_at)->format('d.m.Y') : '';
    $excerpt = \Illuminate\Support\Str::limit($project->excerpt ?? $project->description ?? '', 260, end: '…');
@endphp

<article id="project-{{ $project->slug }}" class="group scroll-mt-8 overflow-hidden rounded-[20px] bg-surface sm:rounded-[24px]">
    <div class="grid gap-0 lg:grid-cols-[minmax(0,1fr)_minmax(0,1fr)] lg:gap-0">
        {{-- Изображение --}}
        <div class="relative overflow-hidden">
            @if ($coverUrl)
                <img src="{{ $coverUrl }}" alt="{{ $project->title }}" width="800" height="600" loading="lazy"
                     class="h-[220px] w-full object-cover transition-transform duration-500 group-hover:scale-[1.03] sm:h-[280px] lg:h-full lg:min-h-[320px] 2xl:min-h-[380px]">
            @else
                <div class="flex h-[220px] w-full items-center justify-center bg-surfaceh sm:h-[280px] lg:h-full lg:min-h-[320px]">
                    <svg class="h-16 w-16 text-border" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            @endif
        </div>

        {{-- Контент --}}
        <div class="flex flex-col px-5 py-5 sm:px-6 sm:py-6 lg:px-8 lg:py-6 2xl:px-10 2xl:py-8">
            {{-- Верхняя строка: метка + стрелка --}}
            <div class="flex items-start justify-between gap-4">
                <p class="text-[13px] text-muted sm:text-[14px] 2xl:text-[15px]">Проекты</p>
                <a href="#project-{{ $project->slug }}" aria-label="Открыть проект «{{ $project->title }}»"
                   class="shrink-0 text-ink transition-colors hover:text-brand">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8.5M17 7v8.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>

            {{-- Заголовок + описание --}}
            <div class="mt-4 flex-1 sm:mt-5">
                <h2 class="text-[20px] font-semibold leading-tight text-ink sm:text-[22px] lg:text-[24px] 2xl:text-[28px]">
                    {{ $project->title }}
                </h2>
                @if ($excerpt)
                    <p class="mt-3 text-[13px] leading-relaxed text-body sm:text-[14px] lg:text-[15px] 2xl:mt-4 2xl:text-[16px]">
                        {{ $excerpt }}
                    </p>
                @endif
            </div>

            {{-- Кнопка «Подробнее» --}}
            <div class="mt-5 sm:mt-6">
                <a href="#project-{{ $project->slug }}"
                   class="inline-block rounded-[10px] bg-brand px-6 py-3 text-[13px] font-semibold text-white transition-colors hover:bg-brandh sm:px-7 sm:py-3.5 sm:text-[14px]">
                    Подробнее
                </a>
            </div>

            {{-- Дата --}}
            @if ($date)
                <p class="mt-4 text-[13px] text-[#91B5D5] sm:mt-5 sm:text-[14px] 2xl:text-[15px]">{{ $date }}</p>
            @endif
        </div>
    </div>
</article>
