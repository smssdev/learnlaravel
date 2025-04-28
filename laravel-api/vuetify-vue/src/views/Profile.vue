<template>
    <v-container fluid class="mt-15">
      <v-row>
        <v-col cols="12" md="6">
          <v-card>
            <v-card-title class="headline">Profile</v-card-title>
            <v-card-text>
              <div v-if="user">
                <p><strong>Name:</strong> {{ user.name }}</p>
                <p><strong>Email:</strong> {{ user.email }}</p>
                <!-- Add more user details as needed -->
              </div>
              <v-btn class="mt-5" color="error" @click="logout">Logout</v-btn>
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
        user: null,
        error: null,
      };
    },
    created() {
      this.fetchUser();
    },
    methods: {
      async fetchUser() {
        const token = localStorage.getItem('auth_token');

        if (!token) {
          this.$router.push({ name: 'login' }); // Redirect to login if no token
          return;
        }

        try {
          // Make the API request to fetch user data
          const response = await axios.get('http://localhost:8000/api/me', {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });

          this.user = response.data.user;
        } catch (error) {
          console.error('Failed to fetch user:', error.response?.data || error);
          this.error = 'Failed to fetch user data';
        }
      },
      logout() {
        localStorage.removeItem('auth_token');
        this.$router.push({ name: 'login' }); // Redirect to login on logout
      },
    },
  };
  </script>

  <style scoped>
  /* Optional styling for the profile page */
  </style>
