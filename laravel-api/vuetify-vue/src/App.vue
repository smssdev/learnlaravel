<template>
    <v-app>
      <!-- Navbar (optional) -->
      <v-app-bar app>
        <v-toolbar-title>Vuetify Vue App</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn text>
          <router-link to="/" class="text-decoration-none">Login</router-link>
        </v-btn>
        <v-btn text>
          <router-link to="/register" class="text-decoration-none">Register</router-link>
        </v-btn>
        <v-btn text>
          <router-link to="/profile" class="text-decoration-none">Profile</router-link>
        </v-btn>
      </v-app-bar>

      <!-- Main Content -->
      <router-view></router-view>
    </v-app>
  </template>

  <script>
  export default {
    name: 'App'
  }
  </script>

  <style>
  /* Global styles (optional) */
  body {
    font-family: 'Roboto', sans-serif;
    background-color: #f5f5f5;
  }
  </style>
