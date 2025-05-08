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
                    fill: 'var(--color-fill)',    // Основной фон
                    text: 'var(--color-text)',    // Цвет текста
                    bg: 'var(--color-bg)',       // Фон компонентов (например, карточек)
                    primary: 'var(--color-primary)', // Основной акцентный цвет
                    secondary: 'var(--color-secondary)', // Вторичный цвет (например, для кнопок)
                    border: 'var(--color-border)', // Цвет границ
                    hover: 'var(--color-hover)', // Цвет при наведении
                    muted: 'var(--color-muted)', // Более мягкий цвет текста для пассивных элементов
                },
            },
        },
    },
    plugins: [
        forms,
        plugin(function ({ addBase }) {
            addBase({
                // Цвета для светлой темы
                ':root': {
                    '--color-fill': '#ffffff', // Белый фон
                    '--color-text': '#000000', // Черный текст
                    '--color-bg': '#f9fafb', // Светлый фон
                    '--color-primary': '#3b82f6', // Синий акцентный цвет
                    '--color-secondary': '#2563eb', // Вторичный синий
                    '--color-border': '#e0e7ff', // Светлая граница
                    '--color-hover': '#2563eb', // Синий при наведении
                    '--color-muted': '#6b7280', // Более светлый текст для неактивных элементов
                },
                // Цвета для темной темы
                '.dark': {
                    '--color-fill': '#1E1E2E', // Темный фон
                    '--color-text': '#E5E7EB', // Светлый текст
                    '--color-bg': '#11111B', // Темный фон
                    '--color-primary': '#4F46E5', // Фиолетовый для акцентов
                    '--color-secondary': '#9333ea', // Вторичный фиолетовый
                    '--color-border': '#374151', // Темная граница
                    '--color-hover': '#9333ea', // Фиолетовый при наведении
                    '--color-muted': '#9ca3af', // Тусклый текст
                },
                // Цвета для синей темы
                '.blue': {
                    '--color-fill': '#161E2E', // Очень темный фон
                    '--color-text': '#E5E7EB', // Светлый текст
                    '--color-bg': '#0F1727', // Темно-синий фон
                    '--color-primary': '#1d4ed8', // Синий акцент
                    '--color-secondary': '#2563eb', // Вторичный синий
                    '--color-border': '#1d4ed8', // Синие границы
                    '--color-hover': '#2563eb', // Синий при наведении
                    '--color-muted': '#9ca3af', // Тусклый текст
                },
            });
        }),
    ],
};