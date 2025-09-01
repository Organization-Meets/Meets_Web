import axios from "axios";

// 🚀 Agora sempre usa o proxy configurado no vite.config.js
const api = axios.create({
  baseURL: "/api",
});

// Cadastro local
export const register = (data) => api.post("/auth/register", data);

// Login local
export const login = (data) => api.post("/auth/login", data);

// Login Microsoft (redireciona pro Azure AD)
export const microsoftLogin = () => {
  window.location.href = "/api/oauth2/authorization/microsoft";
};
