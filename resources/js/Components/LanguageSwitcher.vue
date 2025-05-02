<template>
  <select v-model="current" @change="switchLocale">
    <option
      v-for="l in available"
      :key="l"
      :value="l"
    >
      {{ l === 'ru' ? 'Русский' : 'English' }}
    </option>
  </select>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue'
import { useI18n }       from 'vue-i18n'
import { usePage, router } from '@inertiajs/vue3'

// Берём из Inertia‑пропсов то, что передали в HandleInertiaRequests::share
const page = usePage<{ locale: string; available_locales: string[] }>()

const available = page.props.available_locales
const { locale } = useI18n()
const current = ref(page.props.locale)

// Синхронизуем изменение селекта с vue-i18n
watch(current, val => {
  locale.value = val
})

function switchLocale() {
  const newLoc = current.value
  // Сохраняем выбор в локалке
  localStorage.setItem('locale', newLoc)

  // Отправляем на сервер, а затем в onSuccess делаем reload нужного пропа
  router.post(
    route('locale.switch'),
    { locale: newLoc },
    {
      preserveState: true,
      onSuccess: () => {
        router.reload({ only: ['locale'] })
      }
    }
  )
}
</script>
