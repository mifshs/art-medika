import Alpine from 'alpinejs';

import collapse from '@alpinejs/collapse';

import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import 'swiper/css';

document.addEventListener('alpine:init', () => {
    Alpine.plugin(collapse);
});

// Слайдеры: <div class="swiper" data-swiper='{"spaceBetween":12,...}'> — опции Swiper в JSON.
document.querySelectorAll('[data-swiper]').forEach(function (el) {
    var config;
    try { config = JSON.parse(el.dataset.swiper || '{}'); } catch (error) { config = {}; }

    // Базовые опции, сохраняющие поведение на главной (slidesPerView: 'auto' по умолчанию, если не задано)
    var baseOptions = {
        modules: [Navigation],
        slidesPerView: 'auto',
    };

    // Если в JSON явно передана навигация (например, селекторы кнопок на главной: prevEl, nextEl)
    var mergedNavigation = config.navigation || {};

    // Если навигация не была задана через JSON, проверяем наличие кнопок рядом (.swiper-btn-prev / .swiper-btn-next)
    var wrapper = el.parentElement;
    if (wrapper) {
        var prevBtn = wrapper.querySelector('.swiper-btn-prev');
        var nextBtn = wrapper.querySelector('.swiper-btn-next');
        if (prevBtn && !mergedNavigation.prevEl) {
            mergedNavigation.prevEl = prevBtn;
        }
        if (nextBtn && !mergedNavigation.nextEl) {
            mergedNavigation.nextEl = nextBtn;
        }
    }

    var swiperOptions = Object.assign({}, baseOptions, config, {
        navigation: mergedNavigation,
    });

    var swiper = new Swiper(el, swiperOptions);
    el._swiper = swiper;

    // Пагинация цифрами для страниц со .swiper-page-btn
    if (wrapper) {
        var pageBtns = wrapper.querySelectorAll('.swiper-page-btn');
        if (pageBtns.length > 0) {
            pageBtns.forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    var idx = parseInt(btn.getAttribute('data-slide-index'), 10);
                    swiper.slideTo(idx);
                });
            });

            swiper.on('slideChange', function () {
                var activeIndex = swiper.activeIndex;
                pageBtns.forEach(function (btn) {
                    var idx = parseInt(btn.getAttribute('data-slide-index'), 10);
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
});

window.Alpine = Alpine;

Alpine.start();
