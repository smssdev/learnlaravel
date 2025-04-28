<template>
    <div id="app">
      <nav>
        <router-link to="/login">Login</router-link>
        <router-link to="/register">Register</router-link>
        <router-link to="/profile">Profile</router-link>
      </nav>
      <router-view></router-view> <!-- يعرض الصفحة المناسبة حسب التوجيه -->
    </div>
  </template>

  <script>
  export default {
    name: 'App',
  };
  </script>

  <style>
  /* يمكنك إضافة بعض الأنماط هنا حسب احتياجاتك */
  nav {
    margin-bottom: 20px;
  }

  router-link {
    margin-right: 10px;
  }
  </style>
