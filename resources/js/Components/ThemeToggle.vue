<template>
  <button
    @click="toggleTheme"
    class="p-2 rounded transition-colors bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200"
    aria-label="Toggle theme"
  >
    <!-- Если сейчас светлая, показываем луну (перейдём в тёмную) -->
    <span v-if="theme === 'light'">🌙</span>

    <!-- Если сейчас тёмная, показываем синюю (перейдём в синюю) -->
    <span v-else-if="theme === 'dark'">🔵</span>

    <!-- Если сейчас синяя, показываем солнце (перейдём в светлую) -->
    <span v-else>🌞</span>
  </button>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";

const theme = ref<string>(localStorage.getItem("theme") || "light");

function toggleTheme() {
  if (theme.value === "light") {
    theme.value = "dark";
  } else if (theme.value === "dark") {
    theme.value = "blue";
  } else {
    theme.value = "light";
  }

  const html = document.documentElement;
  html.classList.remove("dark", "blue");
  if (theme.value === "dark") {
    html.classList.add("dark");
  } else if (theme.value === "blue") {
    html.classList.add("blue");
  }

  localStorage.setItem("theme", theme.value);
}

onMounted(() => {
  const storedTheme = localStorage.getItem("theme") || "light";
  theme.value = storedTheme;
  const html = document.documentElement;
  html.classList.remove("dark", "blue");
  if (storedTheme === "dark") {
    html.classList.add("dark");
  } else if (storedTheme === "blue") {
    html.classList.add("blue");
  }
});
</script>
