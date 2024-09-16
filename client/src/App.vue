<script setup lang="ts">
import { ref } from 'vue';
import { useRouter, useRoute} from 'vue-router';
import DashboardLayout from './components/layouts/DashboardLayout.vue';
import LoadingSnippet from './components/snippets/LoadingSnippet.vue';
import axios from 'axios';

// Estado global para o loading
const isLoading = ref(false);

axios.defaults.baseURL = 'http://localhost:8000';
axios.defaults.withXSRFToken = true;
axios.defaults.withCredentials = true;

// Axios Interceptors para controlar o loading nas requisições
axios.interceptors.request.use((config) => {
  isLoading.value = true; // Ativar loading ao iniciar requisição
  return config;
}, (error) => {
  isLoading.value = false;
  return Promise.reject(error);
});

axios.interceptors.response.use((response) => {
  isLoading.value = false; // Desativar loading ao receber resposta
  return response;
}, (error) => {
  isLoading.value = false;
  return Promise.reject(error);
});

// Router Hooks para ativar o loading durante mudanças de rota
const router = useRouter();
const route = useRoute();
router.beforeEach((to, from, next) => {
  isLoading.value = true;
  next();
});

router.afterEach(() => {
  isLoading.value = false;
});
</script>

<template>
  <!-- Mostrar o componente de loading -->
  <loading-snippet v-if="isLoading" />

  <!-- Conteúdo da aplicação -->
  <div v-if="route.name !== 'login'">
    <dashboard-layout>
      <RouterView />
    </dashboard-layout>
  </div>

  <div v-else>
    <RouterView />
  </div>
</template>
