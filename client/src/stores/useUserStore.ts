import { defineStore } from 'pinia';
import axios from 'axios';

interface User {
  name: string;
  // Outras propriedades do usuário
}

export const useUserStore = defineStore('user', {
  state: () => ({
    user: {} as User, // Estado inicial do usuário
  }),
  actions: {
    async fetchUser() {
      try {
        // Faz a requisição para buscar os dados do usuário
        const response = await axios.get('/api/user');
        
        // Armazena os dados do usuário no estado
        this.user = await response.data;
      } catch (error) {
        console.error('Erro ao buscar usuário:', error);
      }
    },
    setUser(current_user: User) {
      this.user = current_user;
    }
  }
});
