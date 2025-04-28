<template>
    <div v-if="user">
      <h2>Welcome, {{ user.name }}</h2>
      <p>Email: {{ user.email }}</p>
      <p>Roles: {{ userRoles }}</p>
      <button @click="logout">Logout</button>
    </div>
    <div v-else>
      <p>You need to be logged in to view your profile. Redirecting to login...</p>
    </div>
  </template>

  <script>
  import api from '../services/api';
  import { useRouter } from 'vue-router';

  export default {
    data() {
      return {
        user: null,
        userRoles: [],
      };
    },
    async created() {
      try {
        const response = await api.get('/me');
        this.user = response.data.user;
        this.userRoles = response.data.roles.join(', ');
      } catch (error) {
        console.error('Failed to fetch user data', error);
        this.$router.push('/login'); // إذا فشل في جلب البيانات، قم بتوجيه المستخدم إلى صفحة الدخول
      }
    },
    methods: {
      async logout() {
        try {
          await api.post('/logout');
          localStorage.removeItem('auth_token');
          this.$router.push('/login'); // العودة إلى صفحة الدخول بعد الخروج
        } catch (error) {
          console.error('Logout failed', error);
        }
      },
    },
  };
  </script>
