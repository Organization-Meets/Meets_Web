import axios from "axios";

// 🚀 Base URL
// - Em dev: proxy do Vite envia "/api" -> backend localhost:8080
// - Em produção: frontend buildado roda no mesmo host/porta, então "/api" já funciona
const api = axios.create({
  baseURL: "/api",
  headers: {
    "Content-Type": "application/json",
  },
  withCredentials: false,
});

// 🔐 Registro de usuário
export const register = (data) => api.post("/auth/register", data);

// 🔐 Login com email/senha
export const login = (data) => api.post("/auth/login", data);

// 🔐 Login Microsoft (redireciona pro backend OAuth2)
export const microsoftLogin = () => {
  window.location.href = "/api/oauth2/authorization/microsoft";
};

// 🔐 Ativação de conta via token
export const activateAccount = (token) =>
  api.get(`/auth/activate?token=${token}`);

// 🔐 Confirmação de login via token
export const confirmLogin = (token) =>
  api.get(`/auth/confirm-login?token=${token}`);

export default api;
