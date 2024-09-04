import axios from 'axios';

// Configurar a URL base (se necessário)
axios.defaults.baseURL = 'http://127.0.0.1:8000';

// Configurar os cookies com credenciais
axios.defaults.withCredentials = true;

// Função para obter o CSRF token
function getCsrfToken() {
  return axios.get('/sanctum/csrf-cookie');
}

// Interceptar requisições para garantir que o CSRF token foi obtido
axios.interceptors.request.use(async config => {
  // Se não houver CSRF token, busca o token
  await getCsrfToken();
  return config;
}, error => {
  return Promise.reject(error);
});

export default axios;
