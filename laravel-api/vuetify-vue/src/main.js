import { createApp } from 'vue';
import App from './App.vue';
import router from './router';  // Import the router
import vuetify from './plugins/vuetify';  // Import Vuetify
import 'vuetify/styles';  // Import Vuetify styles globally
import axios from './axios'; // Or wherever your axios configuration is located

createApp(App)
  .use(router)  // Use Vue Router
  .use(vuetify)  // Use Vuetify
  .mount('#app');
