/**
 * Режим для слабовидящих (BVI - Blind and Visually Impaired)
 * Мгновенное переключение, сохранение в localStorage, без изменения серверной архитектуры.
 */

const BVI_STORAGE_KEY = 'art_medika_bvi_active';
const BVI_FONT_KEY = 'art_medika_bvi_font'; // 'normal' | 'large' | 'xlarge'
const BVI_THEME_KEY = 'art_medika_bvi_theme'; // 'bw' | 'invert' | 'blue'
const BVI_IMAGES_KEY = 'art_medika_bvi_images'; // 'on' | 'off'

export function initBvi() {
    const root = document.documentElement;

    // Считываем сохраненное состояние
    const isActive = localStorage.getItem(BVI_STORAGE_KEY) === '1';
    const savedFont = localStorage.getItem(BVI_FONT_KEY) || 'normal';
    const savedTheme = localStorage.getItem(BVI_THEME_KEY) || 'bw';
    const savedImages = localStorage.getItem(BVI_IMAGES_KEY) || 'on';

    if (isActive) {
        applyBviMode(true, savedFont, savedTheme, savedImages);
    }

    // Слушатели на все кнопки вызова режима (в футере, шапке и т.д.)
    document.addEventListener('click', (e) => {
        const toggleBtn = e.target.closest('[data-bvi-toggle]');
        if (toggleBtn) {
            e.preventDefault();
            const currentlyActive = root.classList.contains('bvi-active');
            if (currentlyActive) {
                applyBviMode(false);
            } else {
                applyBviMode(true, savedFont, savedTheme, savedImages);
                // Плавный скролл к панели и фокус на первом контроле
                const bar = document.getElementById('bvi-panel');
                if (bar) {
                    bar.scrollIntoView({ behavior: 'smooth' });
                    const firstBtn = bar.querySelector('button');
                    if (firstBtn) firstBtn.focus();
                }
            }
        }
    });
}

/**
 * Применение или отключение режима
 */
export function applyBviMode(enable, font = 'normal', theme = 'bw', images = 'on') {
    const root = document.documentElement;

    if (!enable) {
        root.classList.remove(
            'bvi-active',
            'bvi-font-normal',
            'bvi-font-large',
            'bvi-font-xlarge',
            'bvi-theme-bw',
            'bvi-theme-invert',
            'bvi-theme-blue',
            'bvi-images-off'
        );
        localStorage.removeItem(BVI_STORAGE_KEY);
        removeBviPanel();
        return;
    }

    // Сохраняем в localStorage
    localStorage.setItem(BVI_STORAGE_KEY, '1');
    localStorage.setItem(BVI_FONT_KEY, font);
    localStorage.setItem(BVI_THEME_KEY, theme);
    localStorage.setItem(BVI_IMAGES_KEY, images);

    // Очищаем старые bvi классы
    root.classList.remove(
        'bvi-font-normal',
        'bvi-font-large',
        'bvi-font-xlarge',
        'bvi-theme-bw',
        'bvi-theme-invert',
        'bvi-theme-blue',
        'bvi-images-off'
    );

    root.classList.add('bvi-active');
    root.classList.add(`bvi-font-${font}`);
    root.classList.add(`bvi-theme-${theme}`);
    if (images === 'off') {
        root.classList.add('bvi-images-off');
    }

    renderBviPanel(font, theme, images);
}

/**
 * Создание панели управления версией для слабовидящих
 */
function renderBviPanel(font, theme, images) {
    let panel = document.getElementById('bvi-panel');

    if (!panel) {
        panel = document.createElement('aside');
        panel.id = 'bvi-panel';
        panel.setAttribute('aria-label', 'Панель настроек версии для слабовидящих');
        panel.className = 'bvi-toolbar sticky top-0 z-[99999] w-full border-b-2 font-sans';
        document.body.prepend(panel);
    }

    panel.innerHTML = `
        <div class="mx-auto flex max-w-[1720px] flex-wrap items-center justify-between gap-3 px-4 py-3 sm:px-6 md:px-10">
            <div class="flex items-center gap-2">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-current text-current bvi-icon-box">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="bvi-icon-svg" aria-hidden="true">
                        <path d="M2.5 12S6 5.5 12 5.5 21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12Z" stroke="currentColor" stroke-width="2"/>
                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </span>
                <span class="text-[15px] font-bold tracking-tight">Версия для слабовидящих</span>
            </div>

            <div class="flex flex-wrap items-center gap-4 text-[14px]">
                {{-- Размер шрифта --}}
                <div class="flex items-center gap-1.5" role="group" aria-label="Размер шрифта">
                    <span class="font-semibold mr-1">Шрифт:</span>
                    <button type="button" data-bvi-set-font="normal" class="bvi-btn ${font === 'normal' ? 'bvi-btn-active' : ''}" aria-pressed="${font === 'normal'}">A</button>
                    <button type="button" data-bvi-set-font="large" class="bvi-btn font-bold ${font === 'large' ? 'bvi-btn-active' : ''}" aria-pressed="${font === 'large'}">A+</button>
                    <button type="button" data-bvi-set-font="xlarge" class="bvi-btn text-base font-extrabold ${font === 'xlarge' ? 'bvi-btn-active' : ''}" aria-pressed="${font === 'xlarge'}">A++</button>
                </div>

                {{-- Цветовая схема --}}
                <div class="flex items-center gap-1.5" role="group" aria-label="Цветовая схема">
                    <span class="font-semibold mr-1">Цвет:</span>
                    <button type="button" data-bvi-set-theme="bw" class="bvi-btn ${theme === 'bw' ? 'bvi-btn-active' : ''}" aria-pressed="${theme === 'bw'}">Ч/Б</button>
                    <button type="button" data-bvi-set-theme="invert" class="bvi-btn ${theme === 'invert' ? 'bvi-btn-active' : ''}" aria-pressed="${theme === 'invert'}">Инверсия</button>
                    <button type="button" data-bvi-set-theme="blue" class="bvi-btn ${theme === 'blue' ? 'bvi-btn-active' : ''}" aria-pressed="${theme === 'blue'}">Синий</button>
                </div>

                {{-- Изображения --}}
                <div class="flex items-center gap-1.5" role="group" aria-label="Отображение изображений">
                    <span class="font-semibold mr-1">Изображения:</span>
                    <button type="button" data-bvi-set-images="${images === 'on' ? 'off' : 'on'}" class="bvi-btn" aria-pressed="${images === 'off'}">
                        ${images === 'on' ? 'Вкл' : 'Выкл'}
                    </button>
                </div>

                {{-- Обычная версия (закрыть режим) --}}
                <button type="button" id="bvi-close-btn" class="bvi-btn bvi-btn-exit inline-flex items-center gap-1.5 font-bold">
                    <span>Обычная версия</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
        </div>
    `;

    // Привязываем обработчики событий панели
    panel.querySelectorAll('[data-bvi-set-font]').forEach((btn) => {
        btn.onclick = () => {
            const newFont = btn.getAttribute('data-bvi-set-font');
            applyBviMode(true, newFont, theme, images);
        };
    });

    panel.querySelectorAll('[data-bvi-set-theme]').forEach((btn) => {
        btn.onclick = () => {
            const newTheme = btn.getAttribute('data-bvi-set-theme');
            applyBviMode(true, font, newTheme, images);
        };
    });

    const imgBtn = panel.querySelector('[data-bvi-set-images]');
    if (imgBtn) {
        imgBtn.onclick = () => {
            const newImages = imgBtn.getAttribute('data-bvi-set-images');
            applyBviMode(true, font, theme, newImages);
        };
    }

    const closeBtn = document.getElementById('bvi-close-btn');
    if (closeBtn) {
        closeBtn.onclick = () => {
            applyBviMode(false);
        };
    }
}

function removeBviPanel() {
    const panel = document.getElementById('bvi-panel');
    if (panel) {
        panel.remove();
    }
}

// Запуск при загрузке документа
if (typeof document !== 'undefined') {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBvi);
    } else {
        initBvi();
    }
}
