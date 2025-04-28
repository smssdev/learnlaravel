<template>
    <v-container>
      <v-row>
        <v-col cols="12" md="6">
          <v-card>
            <v-card-title class="headline">Profile</v-card-title>
            <v-card-text>
              <v-text-field label="Name" v-model="name" disabled></v-text-field>
              <v-text-field label="Email" v-model="email" disabled></v-text-field>
              <v-btn color="primary" @click="editProfile">Edit Profile</v-btn>
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
        name: 'John Doe',
        email: 'john.doe@example.com'
      }
    },
    methods: {
      editProfile() {
        // Handle profile editing here (maybe show a form for editing)
        console.log(`Editing profile: ${this.name}, ${this.email}`);
      }
    }
  }
  </script>
