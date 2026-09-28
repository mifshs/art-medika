<style>[x-cloak]{display:none!important}</style>

<div class="mx-auto w-full max-w-[388px] space-y-4 px-4 xl:max-w-[1240px] 2xl:max-w-[1720px]">

    @foreach ($directions as $direction)
        <div x-data="{ open: false }" class="acc-item">

            <button type="button" @click="open = !open"
                    :class="open ? 'rounded-t-2xl' : 'rounded-2xl'"
                    class="flex h-[116px] w-full items-center justify-between bg-[#F3F4FB] px-8 text-left transition-colors hover:bg-[#EAECF8]">
                <span class="text-[40px] font-medium leading-tight text-[#1a1a1a] max-md:text-2xl">
                    {{ $direction['title'] }}
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     class="h-9 w-9 shrink-0 text-[#1a1a1a] transition-transform duration-300"
                     :class="open ? 'rotate-180' : 'rotate-0'">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m0 0l6-6m-6 6l-6-6"/>
                </svg>
            </button>

            <div x-show="open" x-collapse x-cloak
                 class="rounded-b-2xl bg-white  pb-8 pt-5">
                <div class="grid grid-cols-1 gap-4 xl:grid-cols-2 2xl:grid-cols-3">
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
    @endforeach

</div>