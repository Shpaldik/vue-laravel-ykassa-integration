<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="bg-white p-8 rounded shadow-md text-center">
      <h1 class="text-2xl font-semibold mb-4">Оплата прошла успешно</h1>
      <p class="mb-6">{{ message }}</p>
      <inertia-link href="{{ route('dashboard') }}" class="btn-primary">
        Вернуться на дашборд
      </inertia-link>
    </div>
  </div>
</template>

<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";
import type { PageProps } from "@/types";

const page = usePage<PageProps<{ message: string }>>();
const message = page.props.message;
</script>
