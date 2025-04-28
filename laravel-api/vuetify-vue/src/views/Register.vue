<template>
    <v-container>
      <v-row>
        <v-col cols="12" md="6">
          <v-card>
            <v-card-title class="headline">Register</v-card-title>
            <v-card-text>
              <v-form>
                <v-text-field label="Name" v-model="name" required></v-text-field>
                <v-text-field label="Email" v-model="email" required></v-text-field>
                <v-text-field label="Password" type="password" v-model="password" required></v-text-field>
                <v-btn color="primary" @click="register">Register</v-btn>
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
        name: '',
        email: '',
        password: ''
      }
    },
    methods: {
      register() {
        // Handle registration logic here (API call, validation, etc.)
        console.log(`Registering with name: ${this.name}, email: ${this.email}, password: ${this.password}`);
      }
    }
  }
  </script>
