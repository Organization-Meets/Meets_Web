// src/services/api.js
import axios from "axios";

// ✅ Instância do Axios que usa o proxy do Vite (`vite.config.js`)
const api = axios.create({
  baseURL: "/api", // 👉 será redirecionado para o backend (porta 8080) via proxy
  headers: {
    "Content-Type": "application/json", // ✅ evita 403/415 por falta de tipo
  },
  withCredentials: false, // ✅ não envia cookies/sessão, útil se usar JWT
});

// 🔐 Cadastro local
export const register = (data) => api.post("/auth/register", data);

// 🔐 Login local
export const login = (data) => api.post("/auth/login", data);

// 🔐 Login Microsoft (redireciona pro backend que faz o OAuth)
export const microsoftLogin = () => {
  window.location.href = "/api/oauth2/authorization/microsoft";
};

export default api;
