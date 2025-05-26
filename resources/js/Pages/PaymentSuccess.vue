<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="bg-white p-8 rounded shadow-md text-center">
      <h1 class="text-2xl font-semibold mb-4">Оплата прошла успешно</h1>
      <p class="mb-6">{{ message }}</p>
      <Link :href="route('dashboard')" class="btn-primary"> Вернуться на дашборд </Link>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Link, router, usePage } from "@inertiajs/vue3";
import { onMounted } from "vue";
import type { PageProps } from "@/types";

// Получаем сообщение из props
const page = usePage<PageProps<{ message: string }>>();
const message = page.props.message;
</script>
