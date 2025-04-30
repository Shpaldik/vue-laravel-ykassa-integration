import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import plugin from 'tailwindcss/plugin';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                skin: {
                    fill: 'var(--color-fill)',
                    text: 'var(--color-text)',
                    bg: 'var(--color-bg)',
                    primary: 'var(--color-primary)',
                },
            },
        },
    },
    plugins: [
        forms,
        plugin(function ({ addBase }) {
            addBase({
                ':root': {
                    '--color-fill': '#ffffff',
                    '--color-text': '#000000',
                    '--color-bg': '#f9fafb',
                    '--color-primary': '#3b82f6',
                },
                '.dark': {
                    '--color-fill': '#1E1E2E',
                    '--color-text': '#E5E7EB',
                    '--color-bg': '#11111B',
                    '--color-primary': '#4F46E5',
                },
                '.blue': {
                    '--color-fill': '#161E2E',
                    '--color-text': '#E5E7EB',
                    '--color-bg': '#0F1727',
                    '--color-primary': '#1d4ed8',
                },
            });
        }),
    ],
};
