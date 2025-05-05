<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";

defineProps<{
  canLogin?: boolean;
  canRegister?: boolean;
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

  <!-- Корневой контейнер, полностью на CSS-переменных тем -->
  <div class="bg-skin-bg text-skin-text transition-colors">
    <div
      class="bg-skin-fill text-skin-text opacity-90 relative flex min-h-screen flex-col items-center justify-center selection:bg-[var(--color-primary)] selection:text-white px-6 py-12 transition-colors"
    >
      <div class="w-full max-w-2xl lg:max-w-7xl text-center space-y-6">
        <!-- Заголовок -->
        <h1 class="text-3xl font-bold text-skin-text">{{ $t('welcome') }}</h1>

        <!-- Описание -->
        <p class="text-lg text-skin-text opacity-70">
          {{ $t('hi') }}
        </p>

        <!-- Кнопки навигации -->
        <div class="space-x-4">
          <Link
            :href="route('dashboard')"
            class="inline-block px-4 py-2 bg-skin-primary text-white rounded-lg transition hover:opacity-90 focus:outline-none focus:ring focus:ring-[var(--color-primary)]"
          >
            {{ $t('go-to-dashboard') }}
          </Link>
          <Link
            :href="route('profile.edit')"
            class="inline-block px-4 py-2 bg-skin-primary text-white rounded-lg transition hover:opacity-90 focus:outline-none focus:ring focus:ring-[var(--color-primary)]"
          >
           {{ $t('edit-profile') }}
          </Link>
        </div>
      </div>
    </div>
  </div>

  <Footer />
</template>
