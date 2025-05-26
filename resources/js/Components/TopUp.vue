<!-- TopUp.vue -->
<template>
  <div class="flex items-center gap-4">
    <button
      @click="openTopUpModal"
      class="inline-block px-4 py-2"
      title="Пополнить баланс"
    >
      {{ $t("top-up") }}
    </button>

    <TopUpModal
      :show="showTopUpModal"
      :minAmount="50"
      :email="page.props.auth.user.email"
      @close="showTopUpModal = false"
    />
  </div>
</template>

<script lang="ts" setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import TopUpModal from "./TopUpModal.vue";

const page = usePage();
const showTopUpModal = ref(false);

const openTopUpModal = () => {
  showTopUpModal.value = true;
};
</script>
