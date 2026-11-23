import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import './bvi';

let swiperBundlePromise = null;

function loadSwiperBundle() {
    if (!swiperBundlePromise) {
        swiperBundlePromise = import('./swiper-loader');
    }
    return swiperBundlePromise;
}

async function mountSwiper(el) {
    if (el._swiper) return;

    const { Swiper, Navigation } = await loadSwiperBundle();
    if (el._swiper) return;

    let config;
    try { config = JSON.parse(el.dataset.swiper || '{}'); } catch { config = {}; }

    const baseOptions = {
        modules: [Navigation],
        slidesPerView: 'auto',
    };

    const mergedNavigation = config.navigation || {};
    const wrapper = el.parentElement;
    if (wrapper) {
        const prevBtn = wrapper.querySelector('.swiper-btn-prev');
        const nextBtn = wrapper.querySelector('.swiper-btn-next');
        if (prevBtn && !mergedNavigation.prevEl) mergedNavigation.prevEl = prevBtn;
        if (nextBtn && !mergedNavigation.nextEl) mergedNavigation.nextEl = nextBtn;
    }

    const swiper = new Swiper(el, Object.assign({}, baseOptions, config, {
        navigation: mergedNavigation,
    }));
    el._swiper = swiper;

    if (wrapper) {
        const pageBtns = wrapper.querySelectorAll('.swiper-page-btn');
        if (pageBtns.length > 0) {
            pageBtns.forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const idx = parseInt(btn.getAttribute('data-slide-index'), 10);
                    swiper.slideTo(idx);
                });
            });

            swiper.on('slideChange', function () {
                const activeIndex = swiper.activeIndex;
                pageBtns.forEach(function (btn) {
                    const idx = parseInt(btn.getAttribute('data-slide-index'), 10);
                    if (idx === activeIndex) {
                        btn.classList.add('border-border', 'bg-white');
                        btn.classList.remove('border-transparent');
                    } else {
                        btn.classList.remove('border-border', 'bg-white');
                        btn.classList.add('border-transparent');
                    }
                });
            });
        }
    }
}

function initSwipers() {
    const elements = Array.from(document.querySelectorAll('[data-swiper]'));
    if (!elements.length) return;

    const scheduleIdle = window.requestIdleCallback
        ? (fn) => window.requestIdleCallback(fn, { timeout: 1500 })
        : (fn) => window.setTimeout(fn, 300);

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    observer.unobserve(entry.target);
                    mountSwiper(entry.target);
                }
            });
        }, { rootMargin: '250px' });

        elements.forEach((el) => observer.observe(el));

        scheduleIdle(() => elements.forEach((el) => {
            observer.unobserve(el);
            mountSwiper(el);
        }));
    } else {
        scheduleIdle(() => elements.forEach((el) => mountSwiper(el)));
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSwipers);
} else {
    initSwipers();
}

// На страницах с Livewire 3 собственный runtime Livewire уже поднимает Alpine и плагины
const hasLivewire = Boolean(window.Livewire || document.querySelector('script[src*="livewire"]'));
if (!hasLivewire && !window.Alpine) {
    Alpine.plugin(collapse);
    window.Alpine = Alpine;
    Alpine.start();
}
