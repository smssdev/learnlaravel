<template>
    <div :dir="isRtl ? 'rtl' : 'ltr'" :lang="locale">
      <nav>
        <button @click="switchLang('ar')">عربي</button>
        <button @click="switchLang('en')">English</button>
        <br>
        <br>
        <router-link to="/">{{$t('HomePage')}}</router-link> |
        <router-link to="/about">{{ $t('AboutUs') }}</router-link>

      </nav>
      <h1>{{ t('welcome') }}</h1>
      <router-view />
    </div>
  </template>

  <script setup>
  import { useI18n } from 'vue-i18n'
  import { computed } from 'vue'

  const { t, locale } = useI18n()

  const isRtl = computed(() => locale.value === 'ar')

  function switchLang(lang) {
    locale.value = lang
    document.documentElement.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr')
    document.documentElement.setAttribute('lang', lang)
  }
  </script>

  <style scoped>
  nav {
    margin-bottom: 20px;
  }
  button {
    margin: 0 5px;
  }
  </style>
