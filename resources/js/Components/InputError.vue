<script setup lang="ts">
defineProps<{
  message?: string;
}>();
</script>

<template>
  <div v-show="message">
    <p class="text-sm text-red-600 dark:text-red-400 dark:bg-gray-800 rounded p-2">
      {{ $t('profile-error') }}
    </p>
  </div>
</template>
