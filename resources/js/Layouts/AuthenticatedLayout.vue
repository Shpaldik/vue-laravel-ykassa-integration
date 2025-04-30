<script setup lang="ts">
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

const showingNavigationDropdown = ref(false);
const page = usePage();
</script>

<template>
  <div class="min-h-screen bg-skin-bg text-skin-text transition-colors">
    <nav class="border-b border-skin-fill bg-skin-bg transition-colors">
      <Header />
      <!-- Мобильное меню -->
      <div
        :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
        class="sm:hidden bg-skin-bg transition-colors"
      >
        <div class="space-y-1 pb-3 pt-2">
          <ResponsiveNavLink
            :href="route('dashboard')"
            class="text-skin-text hover:opacity-70 transition-colors"
            >Главная</ResponsiveNavLink
          >
          <ResponsiveNavLink
            :href="route('dashboard')"
            class="text-skin-text hover:opacity-70 transition-colors"
            >Пополнить</ResponsiveNavLink
          >
          <ResponsiveNavLink
            :href="route('profile.edit')"
            class="text-skin-text hover:opacity-70 transition-colors"
            >Профиль</ResponsiveNavLink
          >
        </div>
        <div class="border-t border-skin-fill pb-1 pt-4 px-4 transition-colors">
          <div class="text-base font-medium text-skin-text">
            {{ page.props.auth.user?.name }}
          </div>
          <div class="text-sm opacity-70 text-skin-text">
            {{ page.props.auth.user?.email }}
          </div>
          <div class="mt-3 space-y-1">
            <ResponsiveNavLink
              :href="route('logout')"
              method="post"
              as="button"
              class="text-skin-text hover:opacity-70 transition-colors"
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
