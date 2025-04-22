<script lang="ts" setup>
import { Head, Link } from '@inertiajs/vue3';
import ThemeToggle from './ThemeToggle.vue';

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();
</script>

<template>
    <header class="w-full py-4 px-6 bg-white shadow-md dark:bg-black dark:text-white">
        <div class="flex justify-between items-center">
            <!-- Логотип -->
            <div class="flex items-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/LEGO_logo.svg" alt="Logo" width="50">
            </div>

            <!-- Правая часть: баланс, кнопки, переключатели -->
            <div class="flex items-center gap-6">
                <!-- Если пользователь авторизован -->
                <template v-if="$page.props.auth.user">
                    <!-- Баланс -->
                    <div class="text-sm font-medium">
                        Баланс: {{ $page.props.auth.user.balance ?? '0₽' }}
                    </div>

                    <!-- Кнопка "Пополнить" -->
                    <button
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                        @click="$inertia.visit(route('top-up'))"
                    >
                        Пополнить
                    </button>

                    <!-- Переключатель языка  -->
                    <select class="bg-transparent border rounded px-2 py-1">
                        <option value="ru">🇷🇺 RU</option>
                        <option value="en">🇬🇧 EN</option>
                    </select>

                    <ThemeToggle />

                    <!-- Ссылка на профиль -->
                    <Link
                        :href="route('dashboard')"
                        class="text-black dark:text-white hover:text-gray-600 dark:hover:text-gray-400"
                    >
                        Profile
                    </Link>
                </template>

                <!-- Если не авторизован -->
                <template v-else>
                    <Link
                        v-if="canLogin"
                        :href="route('login')"
                        class="text-black dark:text-white hover:text-gray-600 dark:hover:text-gray-400"
                    >
                        Log in
                    </Link>

                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="text-black dark:text-white hover:text-gray-600 dark:hover:text-gray-400"
                    >
                        Register
                    </Link>
                </template>
            </div>
        </div>
    </header>
</template>
