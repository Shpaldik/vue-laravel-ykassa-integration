<script setup lang="ts">
import { onMounted, ref } from "vue";

const model = defineModel<string>({ required: true });

const input = ref<HTMLInputElement | null>(null);

onMounted(() => {
  if (input.value?.hasAttribute("autofocus")) {
    input.value?.focus();
  }
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
  <input
    v-model="model"
    ref="input"
    class="w-full rounded-md border border-gray-300 bg-white text-black placeholder-gray-400 shadow-sm focus:ring-2 focus:ring-skin-primary focus:border-skin-primary transition-colors duration-200"
  />
</template>
