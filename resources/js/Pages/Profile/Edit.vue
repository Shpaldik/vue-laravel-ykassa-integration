<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";

defineProps<{
  mustVerifyEmail?: boolean;
  status?: string;
}>();
</script>

<template>
  <Head title="Profile" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-[var(--color-text)]">
        {{ $t("profile") }}
      </h2>
    </template>

    <div class="py-12 border-white">
      <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8 bg-[var(--color-fill)]">
        <!-- Информация профиля -->
        <div class="bg-[var(--color-fill)] p-6 shadow sm:rounded-lg transition-colors">
          <UpdateProfileInformationForm
            :must-verify-email="mustVerifyEmail"
            :status="status"
            class="max-w-xl"
          />
        </div>

        <!-- Обновление пароля -->
        <div class="bg-[var(--color-fill)] p-6 shadow sm:rounded-lg transition-colors">
          <UpdatePasswordForm class="max-w-xl" />
        </div>

        <!-- Удаление аккаунта -->
        <div class="bg-[var(--color-fill)] p-6 shadow sm:rounded-lg transition-colors">
          <DeleteUserForm class="max-w-xl" />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
