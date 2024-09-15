<script setup lang="ts">
import { RouterView, useRoute } from 'vue-router';
import DashboardLayout from './components/layouts/DashboardLayout.vue';

import axios from 'axios'
axios.defaults.baseURL = 'http://localhost:8000/'
axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true

const route = useRoute();
</script>

<template>

  <div v-if="route.name !== 'login'">
    <dashboard-layout>
      <RouterView />
    </dashboard-layout>
  </div>

  <div v-else>
    <RouterView />
  </div>
</template>
