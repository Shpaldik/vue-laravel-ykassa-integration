<template>
  <div class="flex items-center gap-5">
    {{ $t("balance") }}
    <p class="text-lg">{{ page.props.auth.user.balance ?? 0 }} ₽</p>
  </div>
</template>

<script lang="ts" setup>
import { ref, onMounted } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();

type PageProps = {
  auth: {
    user: {
      id: number;
      name: string;
      email: string;
      balance?: number;
    };
  };
  locale: string;
  available_locales: string[];
};
</script>
