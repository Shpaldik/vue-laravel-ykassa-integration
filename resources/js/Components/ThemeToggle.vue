<template>
  <button
    @click="toggleTheme"
    class="p-2 rounded transition-colors bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200"
    aria-label="Toggle theme"
  >
    <span v-if="isDark">🌞</span>
    <span v-else>🌙</span>
  </button>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";

// Переменная для отслеживания текущей темы
const isDark = ref(false);

// Функция для переключения темы
function toggleTheme() {
  isDark.value = !isDark.value;
  document.documentElement.classList.toggle("dark", isDark.value);
  localStorage.setItem("theme", isDark.value ? "dark" : "light");
}

// При монтировании проверяем текущую тему
onMounted(() => {
  isDark.value = document.documentElement.classList.contains("dark");
});
</script>

<style scoped>
/* Можно добавить стили для кнопки, если нужно */
</style>
