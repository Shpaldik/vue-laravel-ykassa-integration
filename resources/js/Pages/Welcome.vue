<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";
defineProps<{
  canLogin?: boolean;
  canRegister?: boolean;
  laravelVersion: string;
  phpVersion: string;
}>();

function handleImageError() {
  document.getElementById("screenshot-container")?.classList.add("!hidden");
  document.getElementById("docs-card")?.classList.add("!row-span-1");
  document.getElementById("docs-card-content")?.classList.add("!flex-row");
  document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
  <Head title="Welcome" />
  <Header />

  <!-- Корневой контейнер с тёмной темой -->
  <div class="dark:bg-gray-900 dark:text-white">
    <div
      class="bg-gray-50 text-black/50 dark:bg-gray-900 dark:text-white/70 relative flex min-h-screen flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white px-6 py-12"
    >
      <div class="w-full max-w-2xl lg:max-w-7xl text-center space-y-6">
        <!-- Заголовок -->
        <h1 class="text-3xl font-bold text-black dark:text-white">
          Welcome to Your Application!
        </h1>

        <!-- Описание -->
        <p class="text-lg text-black/70 dark:text-white/70">
          This is a test page to explore Laravel + Inertia + Vue3 integration. You can
          toggle themes, test authentication, and more.
        </p>

        <!-- Кнопки навигации -->
        <div class="space-x-4">
          <Link
            :href="route('dashboard')"
            class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg transition hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-600"
          >
            Go to Dashboard
          </Link>
          <Link
            :href="route('profile.edit')"
            class="inline-block px-4 py-2 bg-green-500 text-white rounded-lg transition hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-green-700 dark:hover:bg-green-800 dark:focus:ring-green-600"
          >
            Edit Profile
          </Link>
        </div>
      </div>
    </div>
  </div>

  <Footer />
</template>
