import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                onest: ['Onest', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                page:    '#FFFFFF',
                hero:    '#EDF2F7',
                surface: '#F3F4FB',
                surfaceh:'#EDF1F7',
                border:  '#E4E7EE',
                ink:     '#1A1A1A',
                body:    '#212529',
                muted:   '#4B5563',
                steel:   '#4B6582',
                brand:   '#37241B',
                brandh:  '#4A3128',
            },
            screens: {
                '2xl': '1920px',
            },
        },
    },

    plugins: [forms],
};
