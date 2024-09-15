// router/index.ts
import { createRouter, createWebHistory } from 'vue-router';
import LoginPage from '../views/LoginView.vue';
import HomePage from '../views/DashboardView.vue';
import NewCustomer from '../views/NewCustomerView.vue';

import axios from 'axios'

// Simulação da verificação de autenticação

const isAuthenticated = async () => {
  try {
    const response = await axios.get('/api/user');

    if(response.data){
      return response.data;
    }

    return false;

  } catch (error) {
    return false;
  }
};

const routes = [
  {
    path: '/',
    name: 'login',
    component: LoginPage,
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: HomePage,
    meta: { requiresAuth: true }, // Apenas para usuários autenticados
  },
  {
    path: '/novo',
    name: 'Novo Cliente',
    component: NewCustomer,
    meta: { requiresAuth: true }, // Apenas para usuários autenticados
  },


];

const router = createRouter({
  history: createWebHistory(),
  routes
});

// Guard Global
router.beforeEach(async (to, from, next) => {
  // Verifica se o usuário está autenticado
  const response = await isAuthenticated(); // Função que verifica a autenticação

  // Se a rota requer autenticação e o usuário não está autenticado
  if (to.meta.requiresAuth && !response) {
    next({ name: 'login' }); // Redireciona para o login se não estiver autenticado
  }
  // Se o usuário já está autenticado e tenta acessar a rota de login
  else if (to.name === 'login' && response) {
    next({ name: 'dashboard' }); // Redireciona para a dashboard se já estiver autenticado
  }
  // Se nenhuma das condições for atendida, continua a navegação normalmente
  else {
    next();
  }
});


export default router;
