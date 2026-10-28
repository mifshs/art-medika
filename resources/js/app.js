

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

    // Ищем ближайший контейнер с кнопками (nav рядом со swiper)
    var wrapper = el.parentElement;

    var prevBtn = wrapper.querySelector('.swiper-btn-prev');
    var nextBtn = wrapper.querySelector('.swiper-btn-next');
    var pageBtns = wrapper.querySelectorAll('.swiper-page-btn');

    var swiper = new Swiper(el, {
        modules: [Navigation],
        ...config,
        navigation: {
            nextEl: nextBtn,
            prevEl: prevBtn,
        },
    });

    // Привязываем кнопки пагинации (цифры 1, 2, 3...)
    pageBtns.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            var idx = parseInt(btn.getAttribute('data-slide-index'), 10);
            swiper.slideTo(idx);
        });
    });

    // Подсветка активной кнопки при переключении слайда
    function updateActivePageBtn() {
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
    }

    swiper.on('slideChange', updateActivePageBtn);
});

window.Alpine = Alpine;

Alpine.start();
