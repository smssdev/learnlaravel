<template>
    <v-container>
      <v-row>
        <v-col cols="12" md="6">
          <v-card>
            <v-card-title class="headline">Login</v-card-title>
            <v-card-text>
              <v-form @submit.prevent="login">
                <v-text-field label="Email" v-model="email" required></v-text-field>
                <v-text-field label="Password" type="password" v-model="password" required></v-text-field>
                <v-btn color="primary" type="submit">Login</v-btn>
              </v-form>
              <!-- Error message display -->
              <v-alert v-if="error" type="error" dismissible>{{ error }}</v-alert>
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
        email: '',
        password: '',
        error: null,
      };
    },
    methods: {
      async login() {
        try {
          // Replace with your actual backend login URL
          const response = await axios.post('http://localhost:8000/api/login', {
            email: this.email,
            password: this.password,
          });

          // Assuming the backend sends back the user and token
          const { user, token } = response.data;

          // Store the token in localStorage
          localStorage.setItem('auth_token', token);

          // Redirect to the profile page after successful login
          this.$router.push({ name: 'profile' });

          console.log('User logged in:', user);
        } catch (error) {
          console.error('Login failed:', error.response?.data || error);
          this.error = error.response?.data?.message || 'Login failed';
        }
      },
    },
  };
  </script>

  <style scoped>
  /* Optional styling for the login page */
  </style>
