import { createI18n } from 'vue-i18n'

import ar from './locales/ar.json'
import en from './locales/en.json'

export const i18n = createI18n({
  legacy: false,
  locale: 'ar', // اللغة الافتراضية
  fallbackLocale: 'en',
  messages: {
    ar,
    en
  }
})
