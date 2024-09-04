<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'

const email = ref('eidiogoadm@gmail.com')
const password = ref('teste123')

axios.defaults.baseURL = 'http://localhost:8000/'
axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true

const login = async (event) => {
  event.preventDefault()
  try {
    // Requisita o cookie CSRF e aguarda a resposta
    await axios.get('/sanctum/csrf-cookie')

    // Debug: Verifica os cookies armazenados
    console.log(document.cookie)

    const payload = {
      email: email.value,
      password: password.value
    }

    // Faz o login com o token CSRF
    await axios.post('/login', payload).then((response) => {
      console.log(response.data)
    })

    await axios.get('/sanctum/csrf-cookie')


    let response = await axios.get("/api/user");

    console.log(response);

    console.log('Login bem-sucedido')
  } catch (error) {
    console.error('Erro na requisição:', error)
  }
}
</script>

<template>
  <form @submit="login">
    <input type="email" v-model="email" />
    <input type="password" v-model="password" />
    <button type="submit" class="btn-primary">Enviar</button>
  </form>
</template>

<style scoped></style>
