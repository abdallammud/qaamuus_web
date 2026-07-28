import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                serif: ['"Source Serif 4"', 'Georgia', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                // Primary — Lexica blue
                brand: {
                    50: '#edf4fb',
                    100: '#d9e8f7',
                    200: '#b6d2ef',
                    300: '#8ab6e6',
                    400: '#6098db',
                    500: '#4a90e2',
                    600: '#3173c2',
                    700: '#285c9c',
                    800: '#244d7e',
                    900: '#213f64',
                    950: '#16294280',
                },
                // Accent — amber
                accent: {
                    50: '#fff7e6',
                    100: '#ffeec1',
                    200: '#ffdd86',
                    300: '#ffc94a',
                    400: '#ffb320',
                    500: '#ffaa0d',
                    600: '#e08f00',
                    700: '#b87200',
                },
                // Canvas — cream
                cream: {
                    DEFAULT: '#fbf1e6',
                    soft: '#fdf6ec',
                    deep: '#f6e7d0',
                    card: '#fcecc9',
                },
                // Text / dark surfaces — ink
                ink: {
                    DEFAULT: '#23262e',
                    700: '#3a3f4b',
                    600: '#4b5563',
                },
            },
        },
    },

    plugins: [forms],
};
