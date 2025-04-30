<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps<{
  email: string;
  token: string;
}>();

const form = useForm({
  token: props.token,
  email: props.email,
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("password.store"), {
    onFinish: () => {
      form.reset("password", "password_confirmation");
    },
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Reset Password" />

    <form @submit.prevent="submit" class="bg-skin-bg p-6 rounded-lg shadow-md">
      <!-- Email -->
      <div>
        <InputLabel for="email" value="Email" class="text-skin-text" />

        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full bg-skin-fill text-skin-text border border-skin-fill rounded-md placeholder-skin-text/70 focus:ring-2 focus:ring-skin-primary focus:border-skin-primary transition-colors"
          v-model="form.email"
          required
          autofocus
          autocomplete="username"
        />

        <InputError class="mt-2 text-skin-text/70" :message="form.errors.email" />
      </div>

      <!-- Password -->
      <div class="mt-4">
        <InputLabel for="password" value="Password" class="text-skin-text" />

        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full bg-skin-fill text-skin-text border border-skin-fill rounded-md placeholder-skin-text/70 focus:ring-2 focus:ring-skin-primary focus:border-skin-primary transition-colors"
          v-model="form.password"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2 text-skin-text/70" :message="form.errors.password" />
      </div>

      <!-- Confirm Password -->
      <div class="mt-4">
        <InputLabel
          for="password_confirmation"
          value="Confirm Password"
          class="text-skin-text"
        />

        <TextInput
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full bg-skin-fill text-skin-text border border-skin-fill rounded-md placeholder-skin-text/70 focus:ring-2 focus:ring-skin-primary focus:border-skin-primary transition-colors"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />

        <InputError
          class="mt-2 text-skin-text/70"
          :message="form.errors.password_confirmation"
        />
      </div>

      <div class="mt-4 flex items-center justify-end">
        <PrimaryButton
          class="bg-skin-primary text-white hover:opacity-90 transition-opacity"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Reset Password
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
