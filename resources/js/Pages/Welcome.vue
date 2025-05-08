<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";

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

  <!-- Корневой контейнер с минимальной высотой экрана -->
  <div
    class="bg-[var(--color-bg)] text-[var(--color-text)] transition-colors min-h-screen flex flex-col"
  >
    <div
      class="flex-1 bg-[var(--color-fill)] text-[var(--color-text)] opacity-90 relative flex flex-col items-center justify-center selection:bg-[var(--color-primary)] selection:text-white px-6 py-12 transition-colors"
    >
      <div class="w-full max-w-2xl lg:max-w-7xl text-center space-y-6">
        <h1 class="text-3xl font-bold text-[var(--color-text)]">{{ $t("welcome") }}</h1>
        <p class="text-lg text-[var(--color-text)] opacity-70">{{ $t("hi") }}</p>

        <div class="space-x-4">
          <Link
            :href="route('dashboard')"
            class="inline-block px-4 py-2 bg-[var(--color-primary)] text-white rounded-lg transition hover:opacity-90 focus:outline-none focus:ring focus:ring-[var(--color-primary)]"
          >
            {{ $t("go-to-dashboard") }}
          </Link>
          <Link
            :href="route('profile.edit')"
            class="inline-block px-4 py-2 bg-[var(--color-primary)] text-white rounded-lg transition hover:opacity-90 focus:outline-none focus:ring focus:ring-[var(--color-primary)]"
          >
            {{ $t("edit-profile") }}
          </Link>
        </div>
      </div>
    </div>
    <!-- Футер внизу -->
    <Footer />
  </div>
</template>
