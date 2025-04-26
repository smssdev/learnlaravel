<template>
    <v-navigation-drawer app permanent>
      <v-list>
        <v-list-item>
          <v-img src="/logo.png" max-width="100" class="mx-auto my-4" />
        </v-list-item>
        <v-list-item link to="/">
          <v-list-item-icon>
            <v-icon>mdi-home</v-icon>
          </v-list-item-icon>
          <v-list-item-title>{{ $t('home') }}</v-list-item-title>
        </v-list-item>
        <v-list-item link>
          <v-list-item-icon>
            <v-icon>mdi-cog</v-icon>
          </v-list-item-icon>
          <v-list-item-title>{{ $t('settings') }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </template>
  
  <script>
  export default {
    name: 'Sidebar'
  }
  </script>