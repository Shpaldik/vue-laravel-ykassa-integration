<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
  <Head title="Profile" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-skin-text">Profile</h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
          class="overflow-hidden bg-skin-fill shadow-sm sm:rounded-lg transition-colors"
        >
          <div class="p-6 text-skin-text">
            You’re logged in! This will display information about your service,
            statistics, notifications, etc.
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
