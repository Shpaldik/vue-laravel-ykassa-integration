import '../css/app.css'
import './bootstrap'

import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createApp, h, DefineComponent } from 'vue'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import { useDark } from '@vueuse/core'
import { VueReCaptcha } from 'vue-recaptcha-v3'
import { createI18n }   from 'vue-i18n'

// импорт JSON-словари, сгенерированные плагином laravel-vue-i18n
import en from '@/locale/en.json'
import ru from '@/locale/ru.json'

const appName      = import.meta.env.VITE_APP_NAME || 'Laravel'
const browserLocale = (navigator.language || 'en').split('-')[0]
const defaultLocale = localStorage.getItem('locale') || browserLocale

const i18n = createI18n({
  legacy: false,
  locale: defaultLocale,
  fallbackLocale: 'en',
  messages: { en, ru },
})

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob<DefineComponent>('./Pages/**/*.vue')
    ),
  setup({ el, App, props, plugin }) {
    // получаем из Inertia: serverLocale и список языков
    const serverLocale      = props.initialPage.props.locale
    const availableLocales = props.initialPage.props.available_locales

    // принудительно устанавливаем текущую локаль из сервера
    i18n.global.locale.value = serverLocale

    useDark({
      selector: 'html',
      attribute: 'class',
      valueDark: 'dark',
      valueLight: '',
      storageKey: 'theme',
    })

    const captchaKey = props.initialPage.props.recaptcha_site_key

    const vueApp = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(VueReCaptcha, { siteKey: captchaKey, loaderOptions: { autoHideBadge: false, explicitRenderParameters: { badge: 'bottomright' } } })
      .use(ZiggyVue)
      .use(i18n)

    // прокидываем список языков в компоненты через inject
    vueApp.provide('availableLocales', availableLocales)

    vueApp.mount(el)
  },
  progress: { color: '#4B5563' },
})
