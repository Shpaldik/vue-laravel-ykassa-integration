<script setup lang="ts">
import { ref } from "vue";
import { usePage, Link } from "@inertiajs/vue3";
import { toggleTheme, isDark } from "@/Composables/useTheme";

import Header from "@/Components/Header.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

const showingNavigationDropdown = ref(false);
const page = usePage();
</script>

<template>
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900 dark:text-white">
    <nav class="border-b border-gray-100 bg-white dark:bg-gray-800">
      <Header />
      <!-- Мобильное меню -->
      <div
        :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
        class="sm:hidden"
      >
        <div class="space-y-1 pb-3 pt-2">
          <ResponsiveNavLink :href="route('dashboard')">Главная</ResponsiveNavLink>
          <ResponsiveNavLink :href="route('dashboard')">Пополнить</ResponsiveNavLink>
          <ResponsiveNavLink :href="route('profile.edit')">Профиль</ResponsiveNavLink>
        </div>

        <div class="border-t border-gray-200 pb-1 pt-4 px-4">
          <div class="text-base font-medium">{{ page.props.auth.user?.name }}</div>
          <div class="text-sm text-gray-600">{{ page.props.auth.user?.email }}</div>
          <div class="mt-3 space-y-1">
            <ResponsiveNavLink :href="route('logout')" method="post" as="button"
              >Выйти</ResponsiveNavLink
            >
          </div>
        </div>
      </div>
    </nav>

    <main>
      <slot />
    </main>
  </div>
</template>
