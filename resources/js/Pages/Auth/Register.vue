<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useReCaptcha } from "vue-recaptcha-v3";
import { Head, Link, useForm } from "@inertiajs/vue3";

const { executeRecaptcha, recaptchaLoaded } = useReCaptcha();

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  message: null,
  captcha_token: null,
});

const submit = async () => {
  await recaptchaLoaded();
  form.captcha_token = await executeRecaptcha("register");
  form.post(route("register"), {
    onFinish: () => {
      form.reset("password", "password_confirmation");
    },
  });
};
</script>

<template>
  <div class="bg-skin-bg text-skin-text min-h-screen">
    <GuestLayout>
      <Head title="Register" />

      <form @submit.prevent="submit">
        <!-- Name -->
        <div>
          <InputLabel for="name" :value="$t('name')" />
          <TextInput
            id="name"
            v-model="form.name"
            required
            autofocus
            autocomplete="name"
            class="mt-1 block w-full"
          />
          <InputError :message="form.errors.name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
          <InputLabel for="email" :value="$t('email')" />
          <TextInput
            id="email"
            type="email"
            v-model="form.email"
            required
            autocomplete="username"
            class="mt-1 block w-full"
          />
          <InputError :message="form.errors.email" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
          <InputLabel for="password" :value="$t('password')" />
          <TextInput
            id="password"
            type="password"
            v-model="form.password"
            required
            autocomplete="new-password"
            class="mt-1 block w-full"
          />
          <InputError :message="form.errors.password" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
          <InputLabel for="password_confirmation" :value="$t('confirm-password')" />
          <TextInput
            id="password_confirmation"
            type="password"
            v-model="form.password_confirmation"
            required
            autocomplete="new-password"
            class="mt-1 block w-full"
          />
          <InputError :message="form.errors.password_confirmation" class="mt-2" />
        </div>

        <!-- Hidden reCAPTCHA token -->
        <input type="hidden" v-model="form.captcha_token" />

        <!-- reCAPTCHA error -->
        <div class="mt-4">
          <InputError :message="form.errors.captcha_token" />
        </div>

        <!-- Submit -->
        <div class="mt-4 flex items-center justify-end">
          <Link :href="route('login')" class="underline text-skin-text">
            {{ $t("already-registered") }}
          </Link>
          <PrimaryButton
            class="ms-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            {{ $t("register") }}
          </PrimaryButton>
        </div>
      </form>
    </GuestLayout>
  </div>
</template>
