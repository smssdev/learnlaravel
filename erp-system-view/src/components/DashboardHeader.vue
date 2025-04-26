<template>
    <v-app-bar app>
      <v-toolbar-title>{{ $t('dashboard') }}</v-toolbar-title>
      <v-spacer />
      <v-select
        v-model="locale"
        :items="languages"
        :label="$t('language')"
        density="compact"
        style="max-width: 150px"
        @update:modelValue="changeLanguage"
      />
    </v-app-bar>
  </template>
  
  <script>
  export default {
    data() {
      return {
        locale: this.$i18n.locale,
        languages: [
          { title: 'English', value: 'en' },
          { title: 'العربية', value: 'ar' }
        ]
      }
    },
    methods: {
      loadCSS(locale) {
        const existingLink = document.querySelector('link#dynamic-style')
        if (existingLink) existingLink.remove()
  
        const link = document.createElement('link')
        link.id = 'dynamic-style'
        link.rel = 'stylesheet'
        link.href = locale === 'ar' ? '/ar.css' : '/en.css'
        document.head.appendChild(link)
      },
      changeLanguage(lang) {
        this.$i18n.locale = lang
        this.$vuetify.rtl = lang === 'ar'
        document.documentElement.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr')
        localStorage.setItem('locale', lang)
        this.loadCSS(lang)
      }
    },
    created() {
      // Load saved locale or default to 'en'
      this.locale = localStorage.getItem('locale') || 'en'
      this.$i18n.locale = this.locale
      this.$vuetify.rtl = this.locale === 'ar'
      document.documentElement.setAttribute('dir', this.locale === 'ar' ? 'rtl' : 'ltr')
      this.loadCSS(this.locale)
    }
  }
  </script>