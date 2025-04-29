<script setup lang="ts">
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div
    class="flex min-h-screen flex-col items-center bg-gray-100 dark:bg-gray-900 dark:text-white pt-6 sm:justify-center sm:pt-0"
  >
    <div>
      <Link href="/">
        <ApplicationLogo
          class="h-20 w-20 fill-current text-gray-500 dark:text-gray-300"
        />
      </Link>
    </div>

    <div
      class="mt-6 w-full overflow-hidden bg-white dark:bg-gray-800 px-6 py-4 shadow-lg sm:max-w-md sm:rounded-lg dark:border dark:border-gray-700"
    >
      <slot />
    </div>
  </div>
</template>
