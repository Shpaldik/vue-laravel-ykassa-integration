<script setup lang="ts"></script>

<template>
  <footer class="bg-gray-800 dark:bg-gray-900 text-white py-6">
    <div class="max-w-7xl mx-auto px-6">
      <p class="text-center text-lg">Демо сервис</p>
      <div class="flex justify-center mt-4 space-x-6">
        <Link
          :href="route('page1')"
          class="text-sm text-gray-300 hover:text-white transition duration-300"
        >
          Пункт 1
        </Link>
        <Link
          :href="route('page2')"
          class="text-sm text-gray-300 hover:text-white transition duration-300"
        >
          Пункт 2
        </Link>
        <Link
          :href="route('page3')"
          class="text-sm text-gray-300 hover:text-white transition duration-300"
        >
          Пункт 3
        </Link>
      </div>
    </div>
  </footer>
</template>
