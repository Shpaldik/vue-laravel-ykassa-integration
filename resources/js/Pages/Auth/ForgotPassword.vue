<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps<{
  status?: string;
}>();

const form = useForm({
  email: "",
});

const submit = () => {
  form.post(route("password.email"));
};
</script>

<template>
  <GuestLayout>
    <Head title="Forgot Password" />

    <div class="mb-4 text-sm text-skin-text/70">
      Forgot your password? No problem. Just let us know your email address and we will
      email you a password reset link that will allow you to choose a new one.
    </div>

    <div v-if="status" class="mb-4 text-sm font-medium text-skin-success">
      {{ status }}
    </div>

    <form @submit.prevent="submit" class="bg-skin-bg p-6 rounded-lg shadow-md">
      <div>
        <InputLabel for="email" value="Email" class="text-skin-text" />

        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full bg-skin-fill text-skin-text border border-skin-border rounded-md placeholder-skin-text/70 focus:ring-2 focus:ring-skin-primary focus:border-skin-primary transition-colors"
          v-model="form.email"
          required
          autofocus
          autocomplete="username"
        />

        <InputError class="mt-2 text-skin-text/70" :message="form.errors.email" />
      </div>

      <div class="mt-4 flex items-center justify-end">
        <PrimaryButton
          class="ms-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Email Password Reset Link
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
