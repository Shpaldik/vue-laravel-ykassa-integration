<script lang="ts" setup>
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import ThemeToggle from "./ThemeToggle.vue";
import ApplicationLogo from "./ApplicationLogo.vue";
import Dropdown from "./Dropdown.vue";
import DropdownLink from "./DropdownLink.vue";
import ResponsiveNavLink from "./ResponsiveNavLink.vue";
import LanguageSwitcher from "./LanguageSwitcher.vue";

const showingNavigationDropdown = ref(false);
const page = usePage();
</script>

<template>
  <header
    class="w-full border-b border-skin-fill bg-skin-bg text-skin-text transition-colors"
  >
    <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center">
        <!-- Логотип -->
        <div class="flex items-center gap-20">
          <ApplicationLogo />

          <Link
            :href="route('dashboard')"
            class="text-sm text-skin-muted dark:text-skin-muted hover:text-skin-primary dark:hover:text-skin-primary transition duration-300"
          >
            {{ $t("Point") }} 1
          </Link>
          <Link
            :href="route('dashboard')"
            class="text-sm text-skin-muted dark:text-skin-muted hover:text-skin-primary dark:hover:text-skin-primary transition duration-300"
          >
            {{ $t("Point") }} 2
          </Link>
          <Link
            :href="route('dashboard')"
            class="text-sm text-skin-muted dark:text-skin-muted hover:text-skin-primary dark:hover:text-skin-primary transition duration-300"
          >
            {{ $t("Point") }} 3
          </Link>
        </div>

        <!-- ПК-навигация -->
        <div class="hidden sm:flex items-center gap-6">
          <LanguageSwitcher />
          <ThemeToggle />

          <template v-if="page.props.auth.user">
            <div class="text-sm font-medium opacity-70">
              {{ $t("balance") }} {{ page.props.auth.user.balance ?? 0 }} ₽
            </div>

            <button
              class="px-4 py-2 bg-skin-primary text-white rounded-md hover:opacity-90 transition text-sm"
              @click="$inertia.visit(route('dashboard'))"
            >
              {{ $t("top-up") }}
            </button>

            <Dropdown align="right" width="48">
              <template #trigger>
                <span class="inline-flex rounded-md">
                  <button
                    type="button"
                    class="inline-flex items-center rounded-md bg-skin-bg px-3 py-2 text-sm font-medium text-skin-text hover:opacity-80"
                  >
                    {{ page.props.auth.user.name }}
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
                <DropdownLink :href="route('profile.edit')">{{
                  $t("profile")
                }}</DropdownLink>
                <DropdownLink :href="route('logout')" method="post" as="button">{{
                  $t("logout")
                }}</DropdownLink>
              </template>
            </Dropdown>
          </template>

          <template v-else>
            <Link :href="route('login')" class="hover:opacity-70">{{ $t("login") }}</Link>
            <Link :href="route('register')" class="hover:opacity-70">{{
              $t("register")
            }}</Link>
          </template>
        </div>

        <!-- Мобильный бургер -->
        <div class="sm:hidden">
          <button
            @click="showingNavigationDropdown = !showingNavigationDropdown"
            class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500"
          >
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path
                :class="{
                  hidden: showingNavigationDropdown,
                  'inline-flex': !showingNavigationDropdown,
                }"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
              <path
                :class="{
                  hidden: !showingNavigationDropdown,
                  'inline-flex': showingNavigationDropdown,
                }"
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
    <div
      :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
      class="sm:hidden px-4 pb-4"
    >
      <ToggleLang class="mb-2" />
      <ThemeToggle class="mb-4" />

      <template v-if="page.props.auth.user">
        <div class="text-base font-medium">{{ page.props.auth.user.name }}</div>
        <div class="text-sm text-gray-600">{{ page.props.auth.user.email }}</div>

        <div class="mt-4 space-y-1">
          <!-- Пункты 1, 2, 3 для мобильной версии с цифрами -->
          <ResponsiveNavLink :href="route('dashboard')">1</ResponsiveNavLink>
          <ResponsiveNavLink :href="route('dashboard')">2</ResponsiveNavLink>
          <ResponsiveNavLink :href="route('dashboard')">3</ResponsiveNavLink>
          <ResponsiveNavLink :href="route('dashboard')">{{
            $t("main")
          }}</ResponsiveNavLink>
          <ResponsiveNavLink :href="route('dashboard')">{{
            $t("top-up")
          }}</ResponsiveNavLink>
          <ResponsiveNavLink :href="route('profile.edit')">{{
            $t("profile")
          }}</ResponsiveNavLink>
          <ResponsiveNavLink :href="route('logout')" method="post" as="button">{{
            $t("logout")
          }}</ResponsiveNavLink>
        </div>
      </template>

      <template v-else>
        <div class="space-y-1">
          <ResponsiveNavLink :href="route('login')">{{ $t("login") }}</ResponsiveNavLink>
          <ResponsiveNavLink :href="route('register')">{{
            $t("register")
          }}</ResponsiveNavLink>
        </div>
      </template>
    </div>
  </header>
</template>
