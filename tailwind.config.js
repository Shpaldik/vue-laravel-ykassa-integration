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
    darkMode: 'class', // уже есть
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
                // Light (default)
                ':root': {
                    '--color-fill': '#ffffff',
                    '--color-text': '#000000',
                    '--color-bg': '#f9fafb',
                    '--color-primary': '#3b82f6',
                },
                // Dark theme
                '.dark': {
                    '--color-fill': '#1f2937',
                    '--color-text': '#f9fafb',
                    '--color-bg': '#111827',
                    '--color-primary': '#6366f1',
                },
                // Blue theme
                '.blue': {
                    '--color-fill': '#e0f2ff',
                    '--color-text': '#1e3a8a',
                    '--color-bg': '#dbeafe',
                    '--color-primary': '#1d4ed8',
                },
            });
        }),
    ],
};
