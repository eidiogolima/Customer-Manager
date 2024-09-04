<script setup lang="ts">
import { ref } from 'vue'

const email = ref('')
const name = ref('')
const address = ref('')
const phone = ref('')

import axios from 'axios'

axios.defaults.baseURL = 'http://localhost:8000/'
axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true

const get = async () => {
  try {
    // Requisita o cookie CSRF e aguarda a resposta
    
    // Faz a requisição autenticada
    const response = await axios.get('/api/users');
    console.log(response.data);
  } catch (error) {
    console.error('Erro na requisição:', error);
  }
};

get();


async function store(event) {
  event.preventDefault()

  const request = await fetch('http://localhost:3000/customers', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      name: name.value,
      email: email.value,
      address: address.value,
      phone: phone.value
    })
  })

  console.log(request)
}
</script>

<template>
  <section class="mt-5 mx-4">
    <h1 class="color-10 mb-3">Adicionar Cliente</h1>
    <p>Aumente sua base de clientes, Adicione um novo cliente a sua lista 😎</p>
    <form class="border p-3 rounded-3 shadow-sm w-100" @submit="store">
      <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input
          type="text"
          class="form-control"
          id="name"
          aria-describedby="nameHelp"
          v-model="name"
        />
        <div id="nameHelp" class="form-text">Informe o nome do cliente</div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input
          type="email"
          class="form-control"
          id="email"
          aria-describedby="emailHelp"
          v-model="email"
        />
        <div id="emailHelp" class="form-text">Informe o email do cliente</div>
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Telefone</label>
        <input
          type="tel"
          class="form-control"
          id="phone"
          aria-describedby="phoneHelp"
          v-model="phone"
        />
        <div id="phoneHelp" class="form-text">Informe o telefone do cliente</div>
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">Endereço</label>
        <input
          type="text"
          class="form-control"
          id="address"
          aria-describedby="addressHelp"
          v-model="address"
        />
        <div id="addressHelp" class="form-text">Informe o endereço do cliente</div>
      </div>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
  </section>
</template>
