import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from '../views/DashboardView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Dashboard',
      component: Dashboard
    },
    {
      path: '/novo',
      name: 'Novo',
      component: () => import('../views/NewCustomerView.vue')
    },
    {
      path: '/login',
      name: 'Login',
      component: () => import('../views/LoginView.vue')
    }
  ]
})

export default router
