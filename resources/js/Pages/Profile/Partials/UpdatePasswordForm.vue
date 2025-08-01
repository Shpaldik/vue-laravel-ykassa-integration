<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
  current_password: "",
  password: "",
  password_confirmation: "",
});

const updatePassword = () => {
  form.put(route("password.update"), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
    onError: () => {
      if (form.errors.password) {
        form.reset("password", "password_confirmation");
        passwordInput.value?.focus();
      }
      if (form.errors.current_password) {
        form.reset("current_password");
        currentPasswordInput.value?.focus();
      }
    },
  });
};
</script>

<template>
  <section
    class="space-y-6 bg-[var(--color-fill)] p-6 shadow sm:rounded-lg transition-colors duration-200"
  >
    <header>
      <h2 class="text-lg font-medium text-[var(--color-text)]">
        {{ $t("update-password") }}
      </h2>
      <p class="mt-1 text-sm text-[var(--color-text)] opacity-70">
        {{ $t("account-secure") }}
      </p>
    </header>

    <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
      <div>
        <InputLabel for="current_password" class="text-[var(--color-text)]">{{
          $t("current-password")
        }}</InputLabel>

        <TextInput
          id="current_password"
          ref="currentPasswordInput"
          v-model="form.current_password"
          type="password"
          class="mt-1 block w-full bg-[var(--color-bg)] text-[var(--color-text)] border border-[var(--color-fill)] rounded-md focus:ring-2 focus:ring-[var(--color-primary)] transition-colors"
          autocomplete="current-password"
        />

        <InputError
          :message="form.errors.current_password"
          class="mt-2 text-[var(--color-text)] opacity-70"
        />
      </div>

      <div>
        <InputLabel for="password" class="text-[var(--color-text)]">{{
          $t("new-password")
        }}</InputLabel>

        <TextInput
          id="password"
          ref="passwordInput"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full bg-[var(--color-bg)] text-[var(--color-text)] border border-[var(--color-fill)] rounded-md focus:ring-2 focus:ring-[var(--color-primary)] transition-colors"
          autocomplete="new-password"
        />

        <InputError
          :message="form.errors.password"
          class="mt-2 text-[var(--color-text)] opacity-70"
        />
      </div>

      <div>
        <InputLabel for="password_confirmation" class="text-[var(--color-text)]">{{
          $t("confirm-password")
        }}</InputLabel>

        <TextInput
          id="password_confirmation"
          v-model="form.password_confirmation"
          type="password"
          class="mt-1 block w-full bg-[var(--color-bg)] text-[var(--color-text)] border border-[var(--color-fill)] rounded-md focus:ring-2 focus:ring-[var(--color-primary)] transition-colors"
          autocomplete="new-password"
        />

        <InputError
          :message="form.errors.password_confirmation"
          class="mt-2 text-[var(--color-text)] opacity-70"
        />
      </div>

      <div class="flex items-center gap-4">
        <PrimaryButton :disabled="form.processing">{{ $t("save") }}</PrimaryButton>

        <Transition
          enter-active-class="transition ease-in-out"
          enter-from-class="opacity-0"
          leave-active-class="transition ease-in-out"
          leave-to-class="opacity-0"
        >
          <p v-if="form.recentlySuccessful" class="text-sm text-[var(--color-primary)]">
            Saved.
          </p>
        </Transition>
      </div>
    </form>
  </section>
</template>
