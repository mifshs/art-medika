

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
    el._swiper = new Swiper(el, { modules: [Navigation], slidesPerView: 'auto', ...config });
});

window.Alpine = Alpine;

Alpine.start();
