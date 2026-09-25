<style>
    .acc-panel{display:grid;grid-template-rows:0fr;opacity:0;transition:grid-template-rows .35s ease,opacity .35s ease}
    .acc-item.open .acc-panel{grid-template-rows:1fr;opacity:1}
    .acc-panel>.acc-inner{overflow:hidden}
    .acc-arrow{transition:transform .35s ease}
    .acc-item.open .acc-arrow{transform:rotate(180deg)}
</style>

<div class="mx-auto w-full max-w-[1720px] space-y-4 px-4" data-accordion>

    {{-- ===== Блок 1 ===== --}}
    <div class="acc-item overflow-hidden rounded-2xl bg-[#F3F4FB] mb-[20px]">
        <button type="button"
                class="acc-trigger flex h-[116px] w-full items-center justify-between px-8 text-left transition-colors hover:bg-[#EAECF8]">
            <span class="text-[40px] font-medium leading-tight text-[#1a1a1a] max-md:text-2xl">
                Пластическая хирургия
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor"
                 class="acc-arrow h-9 w-9 shrink-0 text-[#1a1a1a]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m0 0l-6 6m6-6l6 6"/>
            </svg>
        </button>
        <div class="acc-panel">
            <div class="acc-inner">
                <div class="px-8 pb-8 text-lg text-gray-600">
                    Здесь описание направления «Пластическая хирургия»: услуги, специалисты, цены…
                </div>
            </div>
        </div>
    </div>

 

</div>

<script>
    document.querySelectorAll('[data-accordion] .acc-trigger').forEach(function (btn) {
        btn.addEventListener('click', function () {
            btn.closest('.acc-item').classList.toggle('open');
        });
    });
</script>