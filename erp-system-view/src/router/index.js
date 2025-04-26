import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from '../views/Dashboard.vue'

const routes = [
  {
    path: '/',
    component: () => import('../layouts/DefaultLayout.vue'),
    children: [
      { path: '', component: Dashboard }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router