<div class="mx-auto w-full max-w-[1720px] space-y-3">

    @foreach ($directions as $direction)
        <div x-data="{ open: false }" class="acc-item">

            <button type="button" @click="open = !open"
                    :aria-expanded="open"
                    :class="open ? 'rounded-t-2xl' : 'rounded-2xl'"
                    class="no-scale flex h-16 w-full items-center justify-between bg-surfaceh px-6 text-left transition-colors duration-300 ease-out hover:bg-[#E2E7F1] active:bg-[#D8DFEC] sm:h-24 sm:px-10">
                <span class="text-[20px] font-semibold leading-tight text-brand sm:text-[24px] lg:text-[28px] 2xl:text-[32px]">
                    {{ $direction['title'] }}
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     class="h-6 w-6 shrink-0 text-brand transition-transform duration-[450ms] ease-[cubic-bezier(0.22,1,0.36,1)] sm:h-8 sm:w-8 2xl:h-9 2xl:w-9"
                     :class="open ? 'rotate-180' : 'rotate-0'">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m0 0l6-6m-6 6l-6-6"/>
                </svg>
            </button>

            <div x-show="open" x-collapse.duration.450ms x-cloak
                 class="rounded-b-2xl bg-white">
                <div class="pb-6 pt-2 transition-opacity duration-[450ms] ease-out sm:pb-8"
                     :class="open ? 'opacity-100' : 'opacity-0'">
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 2xl:grid-cols-3 2xl:gap-6 ">
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
