<template>
  <div class="flex items-center space-x-2">
    <select
      id="language-switch"
      class="bg-gray-100 dark:bg-gray-700 dark:text-white border border-gray-300 dark:border-gray-600 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out"
    >
      <option value="ru">🇷🇺 RU</option>
      <option value="en">🇬🇧 EN</option>
    </select>
  </div>
</template>

<style scoped>
/* Добавление плавных переходов при изменении стиля */
select {
  transition: background-color 0.3s, color 0.3s, border-color 0.3s;
}

select:focus {
  border-color: #4f46e5; /* Цвет для фокуса */
}
</style>
