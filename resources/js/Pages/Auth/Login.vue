<script setup lang="ts">
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps<{
  canResetPassword?: boolean;
  status?: string;
}>();

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => {
      form.reset("password");
    },
  });
};
</script>

<template>
  <div class="bg-skin-bg text-skin-text min-h-screen">
    <GuestLayout>
      <Head title="Log in" />

      <!-- Статусное сообщение -->
      <div v-if="status" class="mb-4 text-sm font-medium text-skin-primary">
        {{ status }}
      </div>

      <form @submit.prevent="submit">
        <!-- Email -->
        <div>
          <InputLabel for="email" value="Email" class="text-skin-text" />

          <TextInput
            id="email"
            type="email"
            class="mt-1 block w-full bg-skin-fill text-skin-text border border-skin-fill rounded-md placeholder-skin-text/50 focus:ring-2 focus:ring-skin-primary transition"
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
            class="mt-1 block w-full bg-skin-fill text-skin-text border border-skin-fill rounded-md placeholder-skin-text/50 focus:ring-2 focus:ring-skin-primary transition"
            v-model="form.password"
            required
            autocomplete="current-password"
          />

          <InputError class="mt-2 text-skin-text/70" :message="form.errors.password" />
        </div>

        <!-- Remember Me -->
        <div class="mt-4 block">
          <label class="flex items-center">
            <Checkbox name="remember" v-model:checked="form.remember" />
            <span class="ms-2 text-sm text-skin-text/70">Remember me</span>
          </label>
        </div>

        <!-- Actions -->
        <div class="mt-4 flex items-center justify-end">
          <Link
            v-if="canResetPassword"
            :href="route('password.request')"
            class="text-sm text-skin-text underline hover:text-skin-primary transition"
          >
            Forgot your password?
          </Link>

          <PrimaryButton
            class="ms-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Log in
          </PrimaryButton>
        </div>
      </form>
    </GuestLayout>
  </div>
</template>
