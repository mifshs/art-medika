<style>
    .acc-panel{display:grid;grid-template-rows:0fr;opacity:0;transition:grid-template-rows .35s ease,opacity .35s ease}
    .acc-item.open .acc-panel{grid-template-rows:1fr;opacity:1}
    .acc-inner{overflow:hidden;border-radius:0 0 1rem 1rem;background:#fff;padding:1.25rem 2rem 2rem}
    .acc-arrow{transition:transform .35s ease}
    .acc-item.open .acc-arrow{transform:rotate(180deg)}
</style>

<div class="mx-auto w-full max-w-[1720px] space-y-4 px-4">

    @foreach ($directions as $direction)
        <div x-data="{ open: false }" :class="open && 'open'" class="acc-item">

            <button type="button" @click="open = !open"
                    :class="open ? 'rounded-t-2xl' : 'rounded-2xl'"
                    class="flex h-[116px] w-full items-center justify-between bg-[#F3F4FB] px-8 text-left transition-colors hover:bg-[#EAECF8]">
                <span class="text-[40px] font-medium leading-tight text-[#1a1a1a] max-md:text-2xl">
                    {{ $direction['title'] }}
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     class="acc-arrow h-9 w-9 shrink-0 text-[#1a1a1a]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m0 0l-6 6m6-6l6 6"/>
                </svg>
            </button>

            <div class="acc-panel">
                <div class="acc-inner">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($direction['cards'] as $card)
                            <x-service-card
                                :title="$card['title']"
                                :image="$card['image']"
                                :services="$card['services']"
                            />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>