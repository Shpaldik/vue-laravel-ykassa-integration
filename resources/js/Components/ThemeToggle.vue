<template>
  <button
    @click="toggleTheme"
    class="p-2 rounded transition-colors bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200"
    aria-label="Toggle theme"
  >
    <span v-if="theme === 'dark'">🌞</span>
    <span v-else-if="theme === 'blue'">🔵</span>
    <span v-else>🌙</span>
  </button>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";

// Define a reactive variable for the theme ('light', 'dark', 'blue')
const theme = ref<string>(localStorage.getItem("theme") || "light");

// Function to toggle between themes
function toggleTheme() {
  if (theme.value === "light") {
    theme.value = "dark";
  } else if (theme.value === "dark") {
    theme.value = "blue";
  } else {
    theme.value = "light";
  }

  // Apply the correct classes to <html> based on the selected theme
  const html = document.documentElement;
  html.classList.remove("dark", "blue");
  if (theme.value === "dark") {
    html.classList.add("dark");
  } else if (theme.value === "blue") {
    html.classList.add("blue");
  } else {
    // No extra class for light, it's the default.
    html.classList.remove("blue");
  }

  // Save the selected theme in localStorage
  localStorage.setItem("theme", theme.value);
}

// On mounted, apply the theme stored in localStorage
onMounted(() => {
  const storedTheme = localStorage.getItem("theme") || "light";
  theme.value = storedTheme;

  const html = document.documentElement;
  if (storedTheme === "dark") {
    html.classList.add("dark");
  } else if (storedTheme === "blue") {
    html.classList.add("blue");
  } else {
    html.classList.remove("dark", "blue");
  }
});
</script>
