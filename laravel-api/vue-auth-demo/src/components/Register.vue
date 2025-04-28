<template>
    <div>
      <h2>Register</h2>
      <form @submit.prevent="register">
        <div>
          <label for="name">Name</label>
          <input v-model="name" type="text" id="name" required />
        </div>
        <div>
          <label for="email">Email</label>
          <input v-model="email" type="email" id="email" required />
        </div>
        <div>
          <label for="password">Password</label>
          <input v-model="password" type="password" id="password" required />
        </div>
        <button type="submit">Register</button>
      </form>
    </div>
  </template>

  <script>
  import api from '../services/api';

  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
      };
    },
    methods: {
      async register() {
        try {
          const response = await api.post('/register', {
            name: this.name,
            email: this.email,
            password: this.password,
          });

          localStorage.setItem('auth_token', response.data.token); // حفظ التوكن
          this.$router.push('/dashboard'); // التوجيه إلى الصفحة الرئيسية بعد التسجيل
        } catch (error) {
          console.error('Registration failed', error.response.data);
          alert('Registration failed');
        }
      },
    },
  };
  </script>
