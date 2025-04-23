import '../css/app.css'
import './bootstrap'

import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createApp, h, DefineComponent } from 'vue'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'

import { useDark } from '@vueuse/core'
import { VueReCaptcha, useReCaptcha } from 'vue-recaptcha-v3'
const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob<DefineComponent>('./Pages/**/*.vue')
    ),
  setup({ el, App, props, plugin }) {
    useDark({
      selector: 'html',
      attribute: 'class',
      valueDark: 'dark',
      valueLight: '',
      storageKey: 'theme',
    })
    const captcheKey = props.initialPage.props.recaptcha_site_key;

    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(VueReCaptcha, { siteKey: captcheKey,
        loaderOptions: {
          autoHideBadge: false,
          explicitRenderParameters:{
            badge: "bottomright"
          }
        }
       } )
      .use(ZiggyVue)
      .mount(el)
  },
  progress: {
    color: '#4B5563',
  },
})
