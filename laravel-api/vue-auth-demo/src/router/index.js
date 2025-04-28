import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/Login.vue';
import Register from '../components/Register.vue';
import Profile from '../components/Profile.vue';

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
  },
  {
    path: '/profile',
    name: 'Profile',
    component: Profile,
  },
  {
    path: '/',
    redirect: '/login', // توجيه الصفحة الرئيسية إلى صفحة تسجيل الدخول
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
