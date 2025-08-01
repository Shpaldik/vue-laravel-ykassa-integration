<template>
  <div class="relative inline-block w-36">
    <select
      v-model="current"
      @change="switchLocale"
      class="block w-full appearance-none rounded-xl border bg-[var(--color-bg)] text-[var(--color-text)] border-[var(--color-border)] px-4 py-2 pr-8 text-sm shadow-sm transition focus:border-[var(--color-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]"
    >
      <option v-for="l in available" :key="l" :value="l">
        {{ l === "ru" ? "Русский" : "English" }}
      </option>
    </select>

    <!-- Иконка стрелки -->
    <div
      class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-500"
    >
      <svg
        class="h-4 w-4"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M19 9l-7 7-7-7"
        />
      </svg>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import { usePage, router } from "@inertiajs/vue3";

// Делаем auth.user любого типа (any), чтобы TS не ругался,
// но тем самым пропускаем валидацию структуры User.
type PageProps = {
  auth: { user: any };
  locale: string;
  available_locales: string[];
};

const page = usePage<PageProps>();

const available = page.props.available_locales;
const { locale } = useI18n();

// 1) Читаем сохранённую локаль из localStorage (если есть)
// 2) Иначе — из пропсов сервера
const saved = localStorage.getItem("locale");
const current = ref<string>(saved || page.props.locale);

// Синхронизируем изменение селекта с vue-i18n
watch(current, (val) => {
  locale.value = val;
});

// Если Inertia-проп locale поменяется (редкий кейс), обновим current
watch(
  () => page.props.locale,
  (newServerLocale) => {
    if (!localStorage.getItem("locale")) {
      current.value = newServerLocale;
    }
  }
);

function switchLocale() {
  const newLoc = current.value;
  // Сохраняем выбор в localStorage
  localStorage.setItem("locale", newLoc);

  // Обновляем сессию на сервере, а потом «докаем» Inertia-проп
  router.post(
    route("locale.switch"),
    { locale: newLoc },
    {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => router.reload({ only: ["locale"] }),
    }
  );
}
</script>
