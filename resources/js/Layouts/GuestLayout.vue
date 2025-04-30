<script setup lang="ts">
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div
    class="flex min-h-screen flex-col items-center bg-skin-bg text-skin-text pt-6 sm:justify-center sm:pt-0 transition-colors"
  >
    <div>
      <Link href="/">
        <ApplicationLogo class="h-20 w-20 fill-current text-skin-text/50" />
      </Link>
    </div>

    <div
      class="mt-6 w-full overflow-hidden bg-skin-fill px-6 py-4 shadow-lg sm:max-w-md sm:rounded-lg border border-skin-fill transition-colors"
    >
      <slot />
    </div>
  </div>
</template>
