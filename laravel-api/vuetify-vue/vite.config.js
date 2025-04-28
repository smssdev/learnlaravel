import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import Vuetify from 'vite-plugin-vuetify'
import envCompatible from 'vite-plugin-env-compatible';

export default defineConfig({
  plugins: [vue(), Vuetify(), envCompatible()],
  resolve: {
    alias: {
      '@': '/src',
    },
  },
})
