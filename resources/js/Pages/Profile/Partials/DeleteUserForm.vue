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
    class="space-y-6 bg-skin-fill p-6 shadow sm:rounded-lg transition-colors duration-200"
  >
    <header>
      <h2 class="text-lg font-medium text-skin-text">Delete Account</h2>

      <p class="mt-1 text-sm text-skin-text opacity-70">
        Once your account is deleted, all of its resources and data will be permanently
        deleted. Before deleting your account, please download any data or information
        that you wish to retain.
      </p>
    </header>

    <DangerButton @click="confirmUserDeletion">Delete Account</DangerButton>

    <Modal :show="confirmingUserDeletion" @close="closeModal">
      <div
        class="p-6 bg-skin-fill text-skin-text rounded-lg transition-colors duration-200"
      >
        <h2 class="text-lg font-medium text-skin-text">
          Are you sure you want to delete your account?
        </h2>

        <p class="mt-1 text-sm text-skin-text opacity-70">
          Once your account is deleted, all of its resources and data will be permanently
          deleted. Please enter your password to confirm you would like to permanently
          delete your account.
        </p>

        <div class="mt-6">
          <InputLabel for="password" value="Password" class="sr-only text-skin-text" />

          <TextInput
            id="password"
            ref="passwordInput"
            v-model="form.password"
            type="password"
            class="mt-1 block w-3/4 bg-skin-bg text-skin-text border border-skin-fill rounded-md focus:ring-2 focus:ring-skin-primary transition-colors"
            placeholder="Password"
            @keyup.enter="deleteUser"
          />

          <InputError
            :message="form.errors.password"
            class="mt-2 text-skin-text opacity-70"
          />
        </div>

        <div class="mt-6 flex justify-end space-x-3">
          <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
          <DangerButton
            class=""
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="deleteUser"
          >
            Delete Account
          </DangerButton>
        </div>
      </div>
    </Modal>
  </section>
</template>
