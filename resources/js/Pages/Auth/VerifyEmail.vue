<script setup lang="ts">
import { computed } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps<{
  status?: string;
}>();

const form = useForm({});

const submit = () => {
  form.post(route("verification.send"));
};

const verificationLinkSent = computed(() => props.status === "verification-link-sent");
</script>

<template>
  <div class="bg-skin-bg text-skin-text min-h-screen">
    <GuestLayout>
      <Head title="Email Verification" />

      <div class="mb-4 text-sm text-skin-text">
        {{ $t("before-proceeding") }}
      </div>

      <div class="mb-4 text-sm font-medium text-skin-primary" v-if="verificationLinkSent">
        {{ $t("verification-code-sent") }}
      </div>

      <form @submit.prevent="submit">
        <div class="mt-4 flex items-center justify-between">
          <PrimaryButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            class="text-skin-fill bg-skin-primary border-skin-primary hover:bg-skin-primary/90 transition-colors"
          >
            {{ $t("resend-verification") }}
          </PrimaryButton>

          <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="rounded-md text-sm text-skin-text underline hover:text-skin-primary focus:outline-none focus:ring-2 focus:ring-skin-primary focus:ring-offset-2"
          >
            {{ $t("logout") }}
          </Link>
        </div>
      </form>
    </GuestLayout>
  </div>
</template>
