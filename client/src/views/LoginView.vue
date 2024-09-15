<script setup lang="ts">
//Imports
import axios from 'axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import LoadingSnippet from '../components/snippets/LoadingSnippet.vue'

const email = ref('eidiogoadm@gmail.com')
const password = ref('teste123')
const router = useRouter()
const loading = ref(false);

const login = async (event: any) => {
  event.preventDefault()
  loading.value = true

  try {
    await axios.get('/sanctum/csrf-cookie')

    const payload = {
      email: email.value,
      password: password.value
    }

    // Faz o login com o token CSRF
    await axios.post('/login', payload).then((response) => {
      if (response.data) {
        router.push('/dashboard')
        loading.value = false;
      }
    })

  } catch (error) {
    loading.value = false;
    console.error('Erro na requisição:', error)
  }
}
</script>

<template>
  <div v-if="loading === true">
    <loading-snippet />
  </div>

  <div class="d-flex align-items-center justify-center justify-start-md py-md-0 py-9">
    <img
      class="d-none d-md-block"
      style="height: 100vh; max-width: 40vw; object-fit: cover"
      src="@/assets/images/street.jpg"
      alt="Prédio Avenida Paulista"
    />

    <div class="p-3 rounded-xl" style="width: 600px">
      <div class="mb-3">
        <router-link class="mb-4" to="/"> </router-link>
      </div>

      <form @submit="login" class="form d-grid gap-3 mt-5 mt-md-0 px-3">
        <div class="item w-100">
          <label for="email" class="font-sans mb-1">E-mail</label>
          <input
            type="text"
            id="email"
            name="email"
            class="w-100"
            v-model="email"
            style="max-width: none"
          />
        </div>

        <div class="item w-100">
          <label for="password" class="font-sans mb-1">Senha</label>
          <input
            type="text"
            id="password"
            name="password"
            class="w-100"
            v-model="password"
            style="max-width: none"
          />
        </div>

        <div class="flex gap-2 justify-between">
          <router-link to="/redefinir-senha" class="text-primary font-sans text-base"
            >Esqueceu a senha?</router-link
          >

          <router-link to="/cadastre-se" class="text-primary font-sans text-base"
            >Cadastre-se</router-link
          >
        </div>

        <button
          class="btn-primary fw-medium font-serif text-center flex justify-center py-"
          style="max-width: none"
        >
          ENTRAR
        </button>
      </form>
    </div>
  </div>
</template>

<style scoped></style>
