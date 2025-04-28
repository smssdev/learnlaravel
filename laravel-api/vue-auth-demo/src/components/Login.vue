<template>
    <div>
      <h2>Login</h2>
      <form @submit.prevent="login">
        <div>
          <label for="email">Email</label>
          <input v-model="email" type="email" id="email" required />
        </div>
        <div>
          <label for="password">Password</label>
          <input v-model="password" type="password" id="password" required />
        </div>
        <button type="submit">Login</button>
      </form>
    </div>
  </template>

  <script>
  import api from '../services/api';

  export default {
    data() {
      return {
        email: '',
        password: '',
      };
    },
    methods: {
      async login() {
        try {
          const response = await api.post('/login', {
            email: this.email,
            password: this.password,
          });

          localStorage.setItem('auth_token', response.data.token); // حفظ التوكن
          this.$router.push('/dashboard'); // التوجيه إلى الصفحة الرئيسية بعد تسجيل الدخول
        } catch (error) {
          console.error('Login failed', error.response.data);
          alert('Login failed');
        }
      },
    },
  };
  </script>
