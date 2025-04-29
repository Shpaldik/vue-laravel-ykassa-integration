<script lang="ts" setup>
import { Head, Link } from "@inertiajs/vue3";
import ThemeToggle from "./ThemeToggle.vue";
import ToggleLang from "./ToggleLang.vue";
import ApplicationLogo from "./ApplicationLogo.vue";

defineProps<{
  canLogin?: boolean;
  canRegister?: boolean;
  laravelVersion: string;
  phpVersion: string;
}>();
</script>

<template>
  <header
    class="w-full py-4 px-6 bg-gray-50 text-black/50 dark:bg-gray-900 dark:text-white/70 dark:border-gray-700"
  >
    <div class="flex justify-between items-center">
      <ApplicationLogo />
      <!-- Правая часть: баланс, кнопки, переключатели -->
      <div class="flex items-center gap-6 lg:gap-10">
        <!-- Переключатель языка -->
        <ToggleLang />

        <!-- Переключатель темы -->
        <ThemeToggle />

        <div class="flex items-center gap-6">
          <!-- Если пользователь авторизован -->
          <template v-if="$page.props.auth.user">
            <!-- Баланс -->
            <div class="text-sm font-medium">
              Баланс: {{ $page.props.auth.user.balance ?? "0₽" }}
            </div>

            <!-- Кнопка "Пополнить" -->
            <button
              class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
              @click="$inertia.visit(route('top-up'))"
            >
              Пополнить
            </button>

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
            <div class="flex gap-4">
              <Link
                :href="route('login')"
                class="text-black dark:text-white hover:text-gray-600 dark:hover:text-gray-400"
              >
                Log in
              </Link>

              <Link
                :href="route('register')"
                class="text-black dark:text-white hover:text-gray-600 dark:hover:text-gray-400"
              >
                Register
              </Link>
            </div>
          </template>
        </div>
      </div>
    </div>
  </header>
</template>
