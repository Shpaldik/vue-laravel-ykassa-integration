<template>
  <div class="mt-8">
    <h2 class="text-lg font-semibold mb-4">История пополнений</h2>

    <ul class="space-y-2">
      <li v-for="tx in transactions.data" :key="tx.id" class="text-sm">
        {{ new Date(tx.created_at).toLocaleString() }} — {{ tx.amount }} ₽ —
        {{ tx.status }}
      </li>
    </ul>

    <pagination :links="transactions.links" />
  </div>
</template>

<script setup lang="ts">
defineProps<{ transactions: any }>();
</script>
