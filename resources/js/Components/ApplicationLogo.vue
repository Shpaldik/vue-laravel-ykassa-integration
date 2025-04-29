<template>
  <div class="flex items-center gap-4">
    <Link :href="route('dashboard')" class="flex items-center">
      <img
        src="https://upload.wikimedia.org/wikipedia/commons/2/24/LEGO_logo.svg"
        alt="Logo"
        width="50"
      />
    </Link>
  </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
</script>
