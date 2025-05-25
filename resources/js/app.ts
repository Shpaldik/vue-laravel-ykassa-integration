import '../css/app.css'
import './bootstrap'

import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createApp, h, DefineComponent } from 'vue'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import { useDark } from '@vueuse/core'
import { VueReCaptcha } from 'vue-recaptcha-v3'
import { createI18n } from 'vue-i18n'

import en from '@/locale/en.json'
import ru from '@/locale/ru.json'

type Locale = 'en' | 'ru'

function isLocale(value: any): value is Locale {
  return value === 'en' || value === 'ru'
}

const browserLocaleRaw = (navigator.language || 'en').split('-')[0]
const localStorageLocaleRaw = localStorage.getItem('locale')
const defaultLocaleRaw = localStorageLocaleRaw || browserLocaleRaw
const defaultLocale = isLocale(defaultLocaleRaw) ? defaultLocaleRaw : 'en'

const i18n = createI18n({
  legacy: false,
  locale: defaultLocale,
  fallbackLocale: 'en',
  messages: { en, ru },
})

createInertiaApp({
  title: (title) => `${title} - ${import.meta.env.VITE_APP_NAME || 'Laravel'}`,
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob<DefineComponent>('./Pages/**/*.vue')
    ),
  setup({ el, App, props, plugin }) {
    const serverLocaleRaw = props.initialPage.props.locale
    const serverLocale = isLocale(serverLocaleRaw) ? serverLocaleRaw : 'en'
    const saved = localStorage.getItem('locale')
    const finalLocale = isLocale(saved) ? saved : serverLocale

    i18n.global.locale.value = finalLocale

    useDark({
      selector: 'html',
      attribute: 'class',
      valueDark: 'dark',
      valueLight: '',
      storageKey: 'theme',
    })

    const captchaKey = props.initialPage.props.recaptcha_site_key
    if (typeof captchaKey !== 'string') {
      throw new Error('Recaptcha siteKey is missing or invalid')
    }

    const vueApp = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(VueReCaptcha, {
        siteKey: captchaKey,
        loaderOptions: {
          autoHideBadge: false,
          explicitRenderParameters: { badge: 'bottomright' },
        },
      })
      .use(ZiggyVue)
      .use(i18n)

    vueApp.provide('availableLocales', props.initialPage.props.available_locales)

    vueApp.mount(el)
  },
  progress: { color: '#4B5563' },
})
