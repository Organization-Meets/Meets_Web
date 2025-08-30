import { useState } from "react";
import { login } from "../api/auth";

export default function LoginForm() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [token, setToken] = useState("");
  const [remember, setRemember] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const res = await login({ email, password, token, remember });
      localStorage.setItem("jwt", res.data.jwt);
      alert("Login feito com sucesso!");
    } catch (err) {
      alert("Erro no login!");
    }
  };

  return (
    <form onSubmit={handleSubmit} className="p-4">
      <h2>Login Local</h2>
      <input
        type="email"
        placeholder="Email"
        value={email}
        onChange={(e) => setEmail(e.target.value)}
        required
      /><br />
      <input
        type="password"
        placeholder="Senha"
        value={password}
        onChange={(e) => setPassword(e.target.value)}
        required
      /><br />
      <input
        type="text"
        placeholder="Token recebido por email"
        value={token}
        onChange={(e) => setToken(e.target.value)}
        required
      /><br />
      <label>
        <input
          type="checkbox"
          checked={remember}
          onChange={(e) => setRemember(e.target.checked)}
        /> Lembrar-me
      </label><br />
      <button type="submit">Entrar</button>
    </form>
  );
}
