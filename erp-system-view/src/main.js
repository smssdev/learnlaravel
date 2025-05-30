import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetifiy.js'
import i18n from './plugins/i18n.js'

const app = createApp(App)
app.use(router)
app.use(vuetify)
app.use(i18n)
app.mount('#app')