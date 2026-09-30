

import Alpine from 'alpinejs';



import collapse from '@alpinejs/collapse';

document.addEventListener('alpine:init', () => {
    Alpine.plugin(collapse);
});



window.Alpine = Alpine;

Alpine.start();
