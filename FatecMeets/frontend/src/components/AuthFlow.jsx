import { useState, useEffect } from 'react';
import { apiFetch } from '../api/client';

export function AuthFlow({ onSuccess, initialView = 'login' }) {
  const [view, setView] = useState(initialView);
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [verificationToken, setVerificationToken] = useState('');
  const [loginToken, setLoginToken] = useState('');
  const [remember, setRemember] = useState(false);
  const [msg, setMsg] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [imageFile, setImageFile] = useState(null);

  const clear = () => setMsg('');

  const fetchJson = async (path, body) => {
    clear();
    return apiFetch(path, { method:'POST', body: JSON.stringify(body) });
  };

  const fileToBase64 = (file) => new Promise((res, rej)=>{
    const r = new FileReader();
    r.onload = () => res(r.result.split(',')[1]);
    r.onerror = rej;
    r.readAsDataURL(file);
  });

  const register = async () => {
    try {
      let imagemBase64 = null;
      if (imageFile) imagemBase64 = await fileToBase64(imageFile);
      await fetchJson('/auth/register-local', { email, password, confirmPassword, imagemBase64 });
      setMsg('Cadastro ok. Verifique email.');
      setView('verificar');
    } catch(e){ setMsg(e.message); }
  };

  const verify = async () => {
    try {
      await fetchJson('/auth/verify-email', { email, token: verificationToken });
      setMsg('Email verificado, faça login.');
      setView('login');
    } catch(e){ setMsg(e.message); }
  };

  const requestToken = async () => {
    try {
      await fetchJson('/auth/request-login-token', { email, password });
      setMsg('Token de login enviado.');
      setView('loginToken');
    } catch(e){ setMsg(e.message); }
  };

  const doLogin = async () => {
    try {
      const r = await fetchJson('/auth/login-local', { email, password, token: loginToken, rememberMe: remember });
      sessionStorage.setItem('accessToken', r.accessToken);
      if (remember && r.refreshToken) localStorage.setItem('refreshToken', r.refreshToken);
      const rolesResp = await fetch('/api/auth/me/roles', { headers:{ Authorization: 'Bearer '+ r.accessToken }});
      if (rolesResp.ok) {
        const rolesJson = await rolesResp.json();
        sessionStorage.setItem('roles', JSON.stringify(rolesJson.roles||[]));
      }
      onSuccess();
    } catch(e){ setMsg(e.message); }
  };

  const loginMicrosoft = () => window.location.href = '/oauth2/authorization/azure';

  useEffect(()=> { setView(initialView); }, [initialView]);

  return (
    <div className="auth">
      <h1>FatecMeets</h1>
      <nav className="tabs">
        <button disabled={view==='login' || view==='loginToken'} onClick={()=>setView('login')}>Login</button>
        <button disabled={view==='cadastro'} onClick={()=>setView('cadastro')}>Cadastro</button>
      </nav>

      {view === 'cadastro' && (
        <div className="card">
          <h2>Cadastro</h2>
          <input placeholder="email" value={email} onChange={e=>setEmail(e.target.value)} />
          <input placeholder="senha" type="password" value={password} onChange={e=>setPassword(e.target.value)} />
          <input placeholder="confirmar senha" type="password" value={confirmPassword} onChange={e=>setConfirmPassword(e.target.value)} />
          <input type="file" accept="image/*" onChange={e=>setImageFile(e.target.files?.[0]||null)} />
          <button onClick={register}>Cadastrar</button>
          <button onClick={loginMicrosoft}>Microsoft</button>
        </div>
      )}

      {view === 'verificar' && (
        <div className="card">
          <h2>Verificar E-mail</h2>
            <input placeholder="código" value={verificationToken} onChange={e=>setVerificationToken(e.target.value)} />
            <button onClick={verify}>Verificar</button>
        </div>
      )}

      {view === 'login' && (
        <div className="card">
          <h2>Login passo 1</h2>
          <input placeholder="email" value={email} onChange={e=>setEmail(e.target.value)} />
          <input placeholder="senha" type="password" value={password} onChange={e=>setPassword(e.target.value)} />
          <label>
            <input type="checkbox" checked={remember} onChange={e=>setRemember(e.target.checked)} /> Lembrar-me
          </label>
          <button onClick={requestToken}>Gerar token</button>
          <button onClick={loginMicrosoft}>Microsoft</button>
        </div>
      )}

      {view === 'loginToken' && (
        <div className="card">
          <h2>Login passo 2</h2>
          <input placeholder="token" value={loginToken} onChange={e=>setLoginToken(e.target.value)} />
          <button onClick={doLogin}>Entrar</button>
        </div>
      )}

      {msg && <p className="msg">{msg}</p>}
    </div>
  );
}
