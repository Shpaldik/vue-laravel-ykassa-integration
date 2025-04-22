<script setup lang="ts">
import { ref } from 'vue'
import { usePage, Link } from '@inertiajs/vue3'
import { toggleTheme, isDark } from '@/Composables/useTheme'

import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'

const showingNavigationDropdown = ref(false)
const page = usePage()
</script>

<template>
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900 dark:text-white">
    <nav class="border-b border-gray-100 bg-white dark:bg-gray-800">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between items-center">
          <!-- Логотип -->
          <div class="flex items-center gap-4">
            <Link :href="route('dashboard')" class="flex items-center">
              <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/LEGO_logo.svg" alt="Logo" width="50" />
            </Link>
          </div>

          <!-- Правая часть: баланс, пополнение, язык, тема -->
          <div class="hidden sm:flex items-center gap-6">
            <!-- Баланс -->
            <div class="text-sm font-medium">
              Баланс: {{ page.props.auth.user?.balance ?? 0 }} ₽
            </div>

            <!-- Пополнить -->
            <Link
              :href="route('dashboard')"
              class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm"
            >
              Пополнить
            </Link>

            <!-- Переключатель языка -->
            <select class="text-sm bg-transparent border rounded px-2 py-1 dark:bg-gray-700 dark:text-white">
              <option value="ru">🇷🇺 Рус</option>
              <option value="en">🇬🇧 Eng</option>
            </select>

            <!-- Тема -->
            <button
              @click="toggleTheme()"
              class="text-xl p-2 rounded bg-gray-200 dark:bg-gray-700 transition"
            >
              {{ isDark ? '☀️' : '🌙' }}
            </button>

            <!-- Профиль / Выход -->
            <Dropdown align="right" width="48">
              <template #trigger>
                <span class="inline-flex rounded-md">
                  <button
                    type="button"
                    class="inline-flex items-center rounded-md border border-transparent bg-white dark:bg-gray-800 px-3 py-2 text-sm font-medium leading-4 text-gray-600 dark:text-gray-200 hover:text-gray-800"
                  >
                    {{ page.props.auth.user?.name }}
                    <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                      <path
                        fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0l-4.25-4.65a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </button>
                </span>
              </template>

              <template #content>
                <DropdownLink :href="route('profile.edit')">Профиль</DropdownLink>
                <DropdownLink :href="route('logout')" method="post" as="button">Выйти</DropdownLink>
              </template>
            </Dropdown>
          </div>

          <!-- Бургер меню -->
          <div class="-me-2 flex sm:hidden">
            <button
              @click="showingNavigationDropdown = !showingNavigationDropdown"
              class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500"
            >
              <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path
                  :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
                <path
                  :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Мобильное меню -->
      <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
        <div class="space-y-1 pb-3 pt-2">
          <ResponsiveNavLink :href="route('dashboard')">Главная</ResponsiveNavLink>
          <ResponsiveNavLink :href="route('dashboard')">Пополнить</ResponsiveNavLink>
          <ResponsiveNavLink :href="route('profile.edit')">Профиль</ResponsiveNavLink>
        </div>

        <div class="border-t border-gray-200 pb-1 pt-4 px-4">
          <div class="text-base font-medium">{{ page.props.auth.user?.name }}</div>
          <div class="text-sm text-gray-600">{{ page.props.auth.user?.email }}</div>
          <div class="mt-3 space-y-1">
            <ResponsiveNavLink :href="route('logout')" method="post" as="button">Выйти</ResponsiveNavLink>
          </div>
        </div>
      </div>
    </nav>

    <main>
      <slot />
    </main>
  </div>
</template>
