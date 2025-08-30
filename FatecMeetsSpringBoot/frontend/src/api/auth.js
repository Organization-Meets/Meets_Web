import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost:8080/api", // backend spring boot
});

// Cadastro local
export const register = (data) => api.post("/auth/register", data);

// Login local
export const login = (data) => api.post("/auth/login", data);

// Login Microsoft (backend redireciona pro Azure)
export const microsoftLogin = () => {
  window.location.href = "http://localhost:8080/oauth2/authorization/azure";
};
