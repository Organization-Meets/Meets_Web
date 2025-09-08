import './App.css';
import { useState } from 'react';
import { AuthFlow } from './components/AuthFlow';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { Sidebar } from './components/Sidebar';
import Navbar from './components/Navbar';
import { ThemeProvider } from './context/ThemeContext';
import Configuracoes from './pages/Configuracoes';
import UpgradeRoleForm from './components/UpgradeRoleForm';
import Perfil from './pages/Perfil';
import Criar from './pages/Criar';

// Placeholders simples
const Page = ({ titulo }) => (
  <div style={{padding:'1.5rem'}}>
    <h2>{titulo}</h2>
    <p>Em desenvolvimento...</p>
  </div>
);

const Protected = ({ logged, onSuccess, children, openAuth }) => {
  if (logged) return children;
  return (
    <div style={{padding:'1.5rem'}}>
      <AuthFlow onSuccess={onSuccess} initialView="login" />
      <p style={{marginTop:'1rem'}}>Faça login para acessar.</p>
    </div>
  );
};

function App() {
  const [logged, setLogged] = useState(!!sessionStorage.getItem('accessToken'));
  const [showAuth, setShowAuth] = useState(false);
  const [authInitialView, setAuthInitialView] = useState('login');

  const openAuth = (view='login') => {
    setAuthInitialView(view);
    setShowAuth(true);
  };
  const closeAuth = () => setShowAuth(false);

  const logout = () => {
    sessionStorage.removeItem('accessToken');
    localStorage.removeItem('refreshToken');
    setLogged(false);
  };

  const roleGuard = (rolesNeeded, content, openAuth) => {
    const roles = (()=>{ try { return JSON.parse(sessionStorage.getItem('roles')||'[]'); } catch { return []; } })();
    if (!rolesNeeded.some(r=>roles.includes(r))) {
      const [tipo] = ['aluno'];
      return (
        <div style={{padding:'1.5rem'}}>
          <UpgradeRoleForm initialTipo={tipo} onSuccess={()=>{}} />
        </div>
      );
    }
    return content;
  };

  return (
    <ThemeProvider>
      <BrowserRouter>
        <Navbar
          logged={logged}
          onLogout={logout}
          onOpenLogin={() => openAuth('login')}
          onOpenRegister={() => openAuth('cadastro')}
        />
        <Sidebar
          logged={logged}
          onLogout={logout}
          onRequireAuth={() => openAuth('login')}
        />
        <main className="app" style={{padding:'1rem'}}>
          <Routes>
            {/* Públicas */}
            <Route path="/" element={<Page titulo="Home (Postagens Recentes)" />} />
              <Route path="/eventos" element={<Page titulo="Eventos Recentes" />} />

            {/* Protegidas */}
            <Route path="/buscar/usuarios" element={
              <Protected logged={logged} onSuccess={()=>{setLogged(true); closeAuth();}}>
                <Page titulo="Buscar Usuários" />
              </Protected>
            } />
            <Route path="/buscar/postagens" element={
              <Protected logged={logged} onSuccess={()=>{setLogged(true); closeAuth();}}>
                <Page titulo="Buscar Postagens" />
              </Protected>
            } />
            <Route path="/buscar/lugares" element={
              <Protected logged={logged} onSuccess={()=>{setLogged(true); closeAuth();}}>
                <Page titulo="Buscar por Lugares" />
              </Protected>
            } />
            <Route path="/buscar/eventos" element={
              <Protected logged={logged} onSuccess={()=>{setLogged(true); closeAuth();}}>
                <Page titulo="Buscar Eventos" />
              </Protected>
            } />
            <Route path="/buscar/instituicoes" element={
              <Protected logged={logged} onSuccess={()=>{setLogged(true); closeAuth();}}>
                <Page titulo="Buscar Instituições" />
              </Protected>
            } />
            <Route path="/criar/postagem" element={
              <Protected logged={logged} onSuccess={()=>{setLogged(true); closeAuth();}}>
                {roleGuard(['aluno','academico','administrador'], <Criar />, openAuth)}
              </Protected>
            } />
            <Route path="/criar/evento" element={
              <Protected logged={logged} onSuccess={()=>{setLogged(true); closeAuth();}}>
                {roleGuard(['aluno','academico','administrador'], <Criar />, openAuth)}
              </Protected>
            } />
            <Route path="/perfil" element={
              <Protected logged={logged} onSuccess={()=>{setLogged(true); closeAuth();}}>
                {roleGuard(['aluno','academico','administrador'], <Perfil />, openAuth)}
              </Protected>
            } />
            <Route path="/configuracoes" element={
              <Protected logged={logged} onSuccess={()=>{setLogged(true); closeAuth();}}>
                <Configuracoes />
              </Protected>
            } />
            <Route path="*" element={<Page titulo="Não encontrado" />} />
          </Routes>
        </main>
        {showAuth && (
          <div className="auth-overlay">
            <div className="auth-box">
              <button className="close-auth" onClick={closeAuth}>×</button>
              <AuthFlow
                initialView={authInitialView}
                onSuccess={()=>{ setLogged(true); closeAuth(); }}
              />
            </div>
            <div className="auth-backdrop" onClick={closeAuth} />
          </div>
        )}
      </BrowserRouter>
    </ThemeProvider>
  );
}

export default App;

