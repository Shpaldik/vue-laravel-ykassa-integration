<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
  password: "",
});

const submit = () => {
  form.post(route("password.confirm"), {
    onFinish: () => {
      form.reset();
    },
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Confirm Password" />

    <div class="mb-4 text-sm text-skin-muted">
      This is a secure area of the application. Please confirm your password before
      continuing.
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="password" value="Password" class="text-skin-text" />
        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full bg-skin-fill text-skin-text border border-skin-border rounded-md placeholder-skin-text/50 focus:ring-2 focus:ring-skin-primary transition"
          v-model="form.password"
          required
          autocomplete="current-password"
          autofocus
        />
        <InputError class="mt-2 text-skin-text/70" :message="form.errors.password" />
      </div>

      <div class="mt-4 flex justify-end">
        <PrimaryButton
          class="ms-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Confirm
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
