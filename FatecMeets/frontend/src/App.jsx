import { useState } from 'react'
import './App.css'

const API = '/api'

function App() {
  const [tab, setTab] = useState('login')
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [token, setToken] = useState('')
  const [remember, setRemember] = useState(false)
  const [msg, setMsg] = useState('')

  const clear = () => { setMsg('') }

  const parseResponse = async (res) => {
    const ct = res.headers.get('content-type') || ''
    if (ct.includes('application/json')) return await res.json()
    const text = await res.text()
    return { error: text || `HTTP ${res.status}` }
  }

  const register = async () => {
    clear()
    try {
      const res = await fetch(`${API}/auth/register-local`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password })
      })
      const data = await parseResponse(res)
      if (!res.ok) throw new Error(data.error || 'Falha no cadastro')
      setMsg(data.message || 'Cadastro OK. Verifique seu e-mail para o token.')
      setTab('login')
    } catch (e) {
      setMsg(e.message || 'Erro inesperado')
    }
  }

  const login = async () => {
    clear()
    try {
      const res = await fetch(`${API}/auth/login-local`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password, token, rememberMe: remember })
      })
      const data = await parseResponse(res)
      if (!res.ok) throw new Error(data.error || 'Falha no login')
      if (remember && data.refreshToken) {
        localStorage.setItem('refreshToken', data.refreshToken)
      }
      setMsg('Login realizado!')
    } catch (e) {
      setMsg(e.message || 'Erro inesperado')
    }
  }

  const loginMicrosoft = () => {
    window.location.href = '/oauth2/authorization/azure'
  }

  return (
    <main className="app">
      <h1>FatecMeets</h1>

      <div style={{ marginBottom: 16 }}>
        <button onClick={() => setTab('login')} disabled={tab==='login'}>Login</button>
        <button onClick={() => setTab('cadastro')} disabled={tab==='cadastro'} style={{ marginLeft: 8 }}>Cadastro</button>
      </div>

      {tab === 'cadastro' ? (
        <div className="card">
          <h2>Cadastro (email/senha)</h2>
          <input
            placeholder="email"
            type="email"
            autoComplete="email"
            value={email}
            onChange={e=>setEmail(e.target.value)}
          />
          <br />
          <input
            placeholder="senha"
            type="password"
            autoComplete="new-password"
            value={password}
            onChange={e=>setPassword(e.target.value)}
          />
          <br />
          <button onClick={register}>Cadastrar</button>
          <p style={{ marginTop: 16 }}>Ou use conta Microsoft:</p>
          <button type="button" onClick={loginMicrosoft}>Entrar com Microsoft</button>
        </div>
      ) : (
        <div className="card">
          <h2>Login (email/senha + token)</h2>
          <input
            placeholder="email"
            type="email"
            autoComplete="email"
            value={email}
            onChange={e=>setEmail(e.target.value)}
          />
          <br />
          <input
            placeholder="senha"
            type="password"
            autoComplete="current-password"
            value={password}
            onChange={e=>setPassword(e.target.value)}
          />
          <br />
          <input
            placeholder="token recebido por e-mail"
            inputMode="text"
            value={token}
            onChange={e=>setToken(e.target.value)}
          />
          <br />
          <label>
            <input type="checkbox" checked={remember} onChange={e=>setRemember(e.target.checked)} />
            Lembrar-me
          </label>
          <br />
          <button onClick={login}>Entrar</button>
          <p style={{ marginTop: 16 }}>Ou use conta Microsoft:</p>
          <button type="button" onClick={loginMicrosoft}>Entrar com Microsoft</button>
        </div>
      )}

      {msg && <p className="read-the-docs">{msg}</p>}
    </main>
  )
}

export default App
