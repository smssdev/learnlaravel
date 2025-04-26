<template>
    <v-app>
      <Sidebar />
      <DashboardHeader />
      <v-main>
        <v-container fluid>
          <router-view />
        </v-container>
      </v-main>
    </v-app>
  </template>
  
  <script>
  import Sidebar from '../components/Sidebar.vue'
  import DashboardHeader from '../components/DashboardHeader.vue'
  
  export default {
    components: { Sidebar, DashboardHeader }
  }
  </script>