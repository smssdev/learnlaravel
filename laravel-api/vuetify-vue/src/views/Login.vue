<template>
    <v-container>
      <v-row>
        <v-col cols="12" md="6">
          <v-card>
            <v-card-title class="headline">Login</v-card-title>
            <v-card-text>
              <v-form>
                <v-text-field label="Email" v-model="email" required></v-text-field>
                <v-text-field label="Password" type="password" v-model="password" required></v-text-field>
                <v-btn color="primary" @click="login">Login</v-btn>
              </v-form>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </template>

  <script>
  export default {
    data() {
      return {
        email: '',
        password: ''
      }
    },
    methods: {
      login() {
        // Handle login logic here (API call, validation, etc.)
        console.log(`Logging in with email: ${this.email}, password: ${this.password}`);
      }
    }
  }
  </script>
