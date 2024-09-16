<script setup lang="ts">
import axios from 'axios'
import { ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()

const customer = ref()

axios.get(`/api/customer/${route.params.id}`).then((response) => {
  customer.value = response.data.data
  console.log(response.data)
})

function goBack() {
  router.back()
}

function formatDate(dateString: string) {
  const options: Intl.DateTimeFormatOptions = {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit'
  }
  return new Date(dateString).toLocaleDateString('pt-BR', options)
}
</script>

<template>
  <div class="mt-4 mx-4  ">
    <div class="row gap-3 mb-4">

      <div class="item border w-100 rounded-2 p-4 col">
        <h1 class="font-p-s">{{ customer.name }}</h1>
        
        <ul class="d-flex flex-column gap-1 font-p-s">
          <li>Empresa: {{ customer.enterprise }}</li>
          <li>Idade: {{ customer.age }}</li>
          <li v-if="customer.cpf">CPF: {{ customer.cpf }}</li>
          <li v-if="customer.cnpj">CNPJ: {{ customer.cnpj }}</li>
          <li>Cadastro: {{ formatDate(customer.created_at) }}</li>
        </ul>
      </div>
      
      <div class="item border w-100 rounded-2 p-4 col">
        <h1 class="font-p-s">Cobrança</h1>
      </div>
    </div>

    <button @click="goBack" class="btn-primary">Voltar</button>
  </div>
</template>

<style scoped></style>
