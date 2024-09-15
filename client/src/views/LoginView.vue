<script setup lang="ts">
//Imports
import { useUserStore } from '@/stores/useUserStore.ts'
import axios from 'axios'
import { ref } from 'vue'

const email = ref('eidiogoadm@gmail.com')
const password = ref('teste123')

axios.defaults.baseURL = 'http://localhost:8000/'
axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true

const userStore = useUserStore()
userStore.fetchUser()

const login = async (event: any) => {
  event.preventDefault()

  try {
    await axios.get('/sanctum/csrf-cookie')

    const payload = {
      email: email.value,
      password: password.value
    }
    
    // Faz o login com o token CSRF
    await axios.post('/login', payload).then((response) => {
      console.log(response.data)
    })

    console.log(useUserStore().fetchUser())

    console.log('Login bem-sucedido')
  } catch (error) {
    console.error('Erro na requisição:', error)
  }
}
</script>

<template>
  <h1>{{ userStore.user.name }}</h1>
  <form @submit="login">
    <input type="email" v-model="email" />
    <input type="password" v-model="password" />
    <button type="submit" class="btn-primary">Enviar</button>
  </form>
</template>

<style scoped></style>
