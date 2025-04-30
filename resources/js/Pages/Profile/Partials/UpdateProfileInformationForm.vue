<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

defineProps<{
  mustVerifyEmail?: Boolean;
  status?: String;
}>();

const user = usePage().props.auth.user;

const form = useForm({
  name: user.name,
  email: user.email,
});
</script>

<template>
  <section class="bg-skin-fill shadow sm:rounded-lg p-6 transition-colors duration-200">
    <header class="mb-6">
      <h2 class="text-lg font-medium text-skin-text">Profile Information</h2>
      <p class="mt-1 text-sm text-skin-text opacity-70">
        Update your account's profile information and email address.
      </p>
    </header>

    <form @submit.prevent="form.patch(route('profile.update'))" class="space-y-6">

      <div>
        <InputLabel for="name" value="Name" class="text-skin-text" />
        <TextInput
          id="name"
          type="text"
          class="mt-1 block w-full bg-skin-fill text-skin-text placeholder-skin-text/50 border border-skin-fill rounded-md focus:ring-2 focus:ring-skin-primary focus:border-skin-primary transition-colors duration-200"
          v-model="form.name"
          required
          autofocus
          autocomplete="name"
        />
        <InputError class="mt-2 text-skin-text opacity-70" :message="form.errors.name" />
      </div>

      <!-- Email -->
      <div>
        <InputLabel for="email" value="Email" class="text-skin-text" />
        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full bg-skin-fill text-skin-text placeholder-skin-text/50 border border-skin-fill rounded-md focus:ring-2 focus:ring-skin-primary focus:border-skin-primary transition-colors duration-200"
          v-model="form.email"
          required
          autocomplete="username"
        />
        <InputError class="mt-2 text-skin-text opacity-70" :message="form.errors.email" />
      </div>

      <!-- Email verification -->
      <div v-if="mustVerifyEmail && user.email_verified_at === null">
        <p class="mt-2 text-sm text-skin-text opacity-70">
          Your email address is unverified.
          <Link
            :href="route('verification.send')"
            method="post"
            as="button"
            class="ml-1 underline text-skin-primary hover:opacity-70 transition-colors"
          >
            Click here to re-send the verification email.
          </Link>
        </p>

        <div
          v-show="status === 'verification-link-sent'"
          class="mt-2 text-sm font-medium text-skin-primary"
        >
          A new verification link has been sent to your email address.
        </div>
      </div>

      <!-- Submit -->
      <div class="flex items-center gap-4">
        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

        <Transition
          enter-active-class="transition ease-in-out"
          enter-from-class="opacity-0"
          leave-active-class="transition ease-in-out"
          leave-to-class="opacity-0"
        >
          <p v-if="form.recentlySuccessful" class="text-sm text-skin-primary">Saved.</p>
        </Transition>
      </div>
    </form>
  </section>
</template>
