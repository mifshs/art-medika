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
                sans: ['Onest', ...defaultTheme.fontFamily.sans],
                onest: ['Onest', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                page:     '#FFFFFF',
                hero:     '#EDF2F7',
                surface:  '#F3F4FB',
                surfacel: '#F4F7FF',
                surfaceh: '#EDF1F7',
                border:   '#E4E7EE',
                ink:      '#1D293D',
                graphite: '#1D293D',
                body:     '#212529',
                muted:    '#707479',
                steel:    '#91B5D5',
                brand:    '#37241B',
                brandh:   '#4A3128',
            },
            fontSize: {
                'display': ['62px', { lineHeight: '1.14', letterSpacing: '-0.015em' }],
                'h1':      ['40px', { lineHeight: '48px', letterSpacing: '0' }],
                'h2':      ['32px', { lineHeight: '40px', letterSpacing: '0' }],
                'h3':      ['24px', { lineHeight: '32px', letterSpacing: '0' }],
                'body-lg': ['20px', { lineHeight: '28px', letterSpacing: '0' }],
                'body':    ['16px', { lineHeight: '24px', letterSpacing: '0' }],
                'caption': ['14px', { lineHeight: '20px', letterSpacing: '0' }],
            },
            screens: {
                '2xl': '1920px',
            },
        },
    },

    plugins: [forms],
};
