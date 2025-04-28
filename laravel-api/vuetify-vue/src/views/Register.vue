<template>
    <v-container>
      <v-row>
        <v-col cols="12" md="6">
          <v-card>
            <v-card-title class="headline">Register</v-card-title>
            <v-card-text>
              <v-form @submit.prevent="register">
                <v-text-field label="Name" v-model="name" required></v-text-field>
                <v-text-field label="Email" v-model="email" required></v-text-field>
                <v-text-field label="Password" type="password" v-model="password" required></v-text-field>
                <v-btn color="primary" type="submit">Register</v-btn>
              </v-form>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        error: null,
      };
    },
    methods: {
      async register() {
        try {
          // Make sure to replace this URL with your actual backend URL
          const response = await axios.post('http://localhost:8000/api/register', {
            name: this.name,
            email: this.email,
            password: this.password,
          });

          // Assuming backend returns the user and token
          const { user, token } = response.data;

          // Store token in localStorage (or sessionStorage) for later use
          localStorage.setItem('auth_token', token);

          // Redirect or update UI (you can use Vue Router here to redirect)
          this.$router.push({ name: 'profile' });

          console.log('User registered:', user);
        } catch (error) {
          console.error('Registration failed:', error.response?.data || error);
          this.error = error.response?.data?.message || 'Registration failed';
        }
      },
    },
  };
  </script>

  <style scoped>
  /* Optional styling for the registration page */
  </style>
