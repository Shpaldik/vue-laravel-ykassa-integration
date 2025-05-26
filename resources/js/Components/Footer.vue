<script lang="ts" setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <footer class="bg-skin-bg dark:bg-skin-fill text-skin-text dark:text-skin-muted py-6">
    <div class="max-w-7xl mx-auto px-6">
      <p class="text-center text-lg text-skin-text dark:text-skin-muted">
        {{ $t("Demo") }}
      </p>
      <div class="flex justify-center mt-4 space-x-6">
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
    </div>
  </footer>
</template>
