import { useState } from "react";
import { register } from "../api/auth";

export default function RegisterForm() {
  const [email, setEmail] = useState("");
  const [senha, setsenha] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await register({ email, senha });
      alert("Verifique seu e-mail para confirmar o cadastro!");
    } catch (err) {
      alert("Erro no cadastro!");
    }
  };

  return (
    <form onSubmit={handleSubmit} className="p-4">
      <h2>Cadastro Local</h2>
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
        value={senha}
        onChange={(e) => setsenha(e.target.value)}
        required
      /><br />
      <button type="submit">Cadastrar</button>
    </form>
  );
}
