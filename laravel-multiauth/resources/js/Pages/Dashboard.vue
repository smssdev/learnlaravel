<template>
    <div>
      <h1>لوحة التحكم</h1>

      <div v-if="hasRole('admin')">
        <p>أنت مشرف</p>
      </div>

      <div v-if="can('edit posts')">
        <p>لديك صلاحية تعديل المقالات</p>
      </div>
    </div>
  </template>

  <script setup>
  import { computed } from 'vue'
  import { usePage } from '@inertiajs/inertia-vue3'

  const user = usePage().props.auth.user

  const hasRole = (role) => {
    return user?.roles?.includes(role)
  }

  const can = (permission) => {
    return user?.permissions?.includes(permission)
  }
  </script>
