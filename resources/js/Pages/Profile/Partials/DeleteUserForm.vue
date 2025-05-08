<script setup lang="ts">
import DangerButton from "@/Components/DangerButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
  password: "",
});

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true;
  nextTick(() => passwordInput.value?.focus());
};

const deleteUser = () => {
  form.delete(route("profile.destroy"), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value?.focus(),
    onFinish: () => {
      form.reset();
    },
  });
};

const closeModal = () => {
  confirmingUserDeletion.value = false;
  form.clearErrors();
  form.reset();
};
</script>

<template>
  <section
    class="space-y-6 border-white bg-skin-fill p-6 shadow sm:rounded-lg transition-colors duration-200"
  >
    <header>
      <h2 class="text-lg font-medium text-skin-text">{{ $t("delete-account") }}</h2>

      <p class="mt-1 text-sm text-skin-text opacity-70">
        {{ $t("delete-confirm") }}
      </p>
    </header>

    <DangerButton @click="confirmUserDeletion">{{ $t("delete-account") }}</DangerButton>

    <Modal :show="confirmingUserDeletion" @close="closeModal">
      <div
        class="p-6 bg-skin-fill text-skin-text rounded-lg transition-colors duration-200"
      >
        <h2 class="text-lg font-medium text-skin-text">
          {{ $t("delete-account-title") }}
        </h2>

        <p class="mt-1 text-sm text-skin-text opacity-70">
          {{ $t("delete-account-title") }}
        </p>

        <div class="mt-6">
          <InputLabel for="password" value="Password" class="sr-only text-skin-text" />

          <TextInput
            id="password"
            ref="passwordInput"
            v-model="form.password"
            type="password"
            class="mt-1 block w-3/4 bg-skin-bg text-skin-text border border-skin-fill rounded-md focus:ring-2 focus:ring-skin-primary transition-colors"
            :placeholder="$t('password')"
            @keyup.enter="deleteUser"
          />

          <InputError
            :message="form.errors.password"
            class="mt-2 text-skin-text opacity-70"
          />
        </div>

        <div class="mt-6 flex justify-end space-x-3">
          <SecondaryButton @click="closeModal">{{ $t("cancel") }}</SecondaryButton>
          <DangerButton
            class=""
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="deleteUser"
          >
            {{ $t("delete-account") }}
          </DangerButton>
        </div>
      </div>
    </Modal>
  </section>
</template>
