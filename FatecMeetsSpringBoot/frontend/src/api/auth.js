import axios from "axios";

const api = axios.create({
  baseURL: "https://urban-garbanzo-jjg995v9jp4q2q9vw-8080.app.github.dev/api", // backend spring boot
});

// Cadastro local
export const register = (data) => api.post("/auth/register", data);

// Login local
export const login = (data) => api.post("/auth/login", data);

// Login Microsoft (backend redireciona pro Azure)
export const microsoftLogin = () => {
  window.location.href = "https://urban-garbanzo-jjg995v9jp4q2q9vw-8080.app.github.dev/oauth2/authorization/azure";
};
