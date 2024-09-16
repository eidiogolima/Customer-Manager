<script setup lang="ts">
import { ref } from 'vue'

const email = ref('eidiogoadm@gmail.com')
const name = ref('Diogo Lima')
const age = ref(21)
const enterprise = ref('Comprar Site')
const err = ref(false)
const sucess = ref(false)
const customer_id = ref(false)
/* const address = ref('')
const phone = ref('') */

import axios from 'axios'

async function store(event) {
  event.preventDefault()

  try {
    axios
      .post('/api/customer', {
        name: name.value,
        age: age.value,
        enterprise: enterprise.value
      })
      .then((reseponse) => {
        if (reseponse.status === 201) {
          sucess.value = true
          customer_id.value = reseponse.data.id
          console.log(reseponse.status)
        }
      })
  } catch (error) {
    err.value = true
    console.log(err)
  }
}
</script>

<template>
  <section class="mt-5 mx-4">
    <div v-if="!sucess">
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

        <div v-if="err">
          <p>Ocorreu um erro tente novamente mais tarde!</p>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </form>
    </div>

    <div v-else>
      <h1>Cliente Adicionar com sucesso!</h1>
      <router-link :to="`/cliente/${customer_id}`">VER</router-link>
    </div>
  </section>
</template>
