<template>
  <Modal :show="props.show" @close="close">
    <div class="p-4">
      <h2 class="text-lg font-semibold mb-4">{{ $t("top-up") }}</h2>

      <form @submit.prevent="submit">
        <label class="block mb-2 text-sm">
          {{ $t("Amount") }} (мин: {{ minAmount }})
        </label>
        <input
          type="number"
          v-model.number="form.amount"
          :min="minAmount"
          class="input"
          required
        />

        <label class="block mt-4 mb-2 text-sm">{{ $t("email") }}</label>
        <input type="email" v-model="form.email" class="input" required />

        <div class="mt-6 flex justify-end gap-2">
          <button type="button" class="btn-secondary" @click="close">
            {{ $t("Cancel") }}
          </button>
          <button type="submit" class="btn-primary" :disabled="processing">
            {{ $t("Pay") }}
          </button>
        </div>
      </form>
    </div>
  </Modal>
</template>

<script lang="ts" setup>
import { defineEmits, defineProps } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import { ref } from "vue";
import Modal from "@/Components/Modal.vue";

const emit = defineEmits(["close"]);
const props = defineProps<{ show: boolean; minAmount: number; email: string }>();

const form = useForm({
  amount: props.minAmount,
  email: props.email,
});

const processing = ref(false);

function close() {
  emit("close");
}

function submit() {
  processing.value = true;
  router.post(route("balance.topup"), form, {
    preserveScroll: true,
    onFinish: () => {
      processing.value = false;
    },
  });
}
</script>
