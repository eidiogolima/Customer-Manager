<script setup>
import axios from 'axios'
import { ref } from 'vue'

// Variáveis reativas para armazenar dados e links de paginação
const all = ref([])
const next_page_link = ref('')
const prev_page_link = ref('')
const data_pages = ref()

// Função para buscar dados da página atual (primeira carga ou qualquer outra página)
function fetchData(page_url = '/api/customers') {
  axios.get(page_url).then((response) => {
    all.value = response.data.data.data
    next_page_link.value = response.data.data.next_page_url
    prev_page_link.value = response.data.data.prev_page_url
    data_pages.value = response.data.data
    console.log(response.data.data)
  })
}

// Carregando a primeira página na montagem do componente
fetchData()

// Função para navegar para a próxima página
function next_page() {
  if (next_page_link.value) {
    fetchData(next_page_link.value)
  }
}

// Função para navegar para a página anterior
function prev_page() {
  if (prev_page_link.value) {
    fetchData(prev_page_link.value)
  }
}
</script>

<template>
  <div class="mt-4 px-4">
    <span>TODOS</span>
    <h1 class="mb-4">Clientes</h1>
    <p class="mb-4">Clientes encontrados: {{ data_pages.total }}</p>

    <div class="d-flex flex-wrap align-items-center justify-content-start gap-3 mb-4">
      <!-- Loop para exibir os clientes -->
      <div v-for="(customer, index) in all" :key="index">
        <router-link :to="`/cliente/${customer.id} `">
          <div class="border p-3 rounded-3">
            <p>Nome: {{ customer.name }}</p>
          </div>
        </router-link>
      </div>
    </div>

    <p class="mb-4">Página atual: {{ data_pages.current_page }}</p>

    <!-- Botões de navegação da página -->
    <div class="pagination-buttons d-flex gap-2">
      <button class="btn-primary" @click="prev_page" :disabled="!prev_page_link">Anterior</button>
      <button class="btn-primary" @click="next_page" :disabled="!next_page_link">Próxima</button>
    </div>
  </div>
</template>
