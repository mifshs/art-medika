import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                page:    '#FFFFFF',
                hero:    '#EDF2F7',
                surface: '#F3F4FB',
                surfaceh:'#EDF1F7',
                border:  '#E4E7EE',
                ink:     '#1A1A1A',
                body:    '#212529',
                muted:   '#6B7280',
                steel:   '#7E93AC',
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
