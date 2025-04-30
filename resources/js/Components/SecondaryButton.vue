<script setup lang="ts">
withDefaults(
  defineProps<{
    type?: "button" | "submit" | "reset";
  }>(),
  {
    type: "button",
  }
);
</script>

<template>
  <button
    :type="type"
    class="inline-flex items-center rounded-md border border-skin-fill bg-skin-fill px-4 py-2 text-xs font-semibold uppercase tracking-widest text-skin-text shadow-sm transition duration-150 ease-in-out hover:brightness-95 focus:outline-none focus:ring-2 focus:ring-skin-primary focus:ring-offset-2 disabled:opacity-25"
  >
    <slot />
  </button>
</template>
