import './App.css';
import { useState } from 'react';
import { AuthFlow } from './components/AuthFlow';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { Sidebar } from './components/Sidebar';
import Navbar from './components/Navbar';

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

  return (
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
              <Page titulo="Criar Postagem" />
            </Protected>
          } />
          <Route path="/criar/evento" element={
            <Protected logged={logged} onSuccess={()=>{setLogged(true); closeAuth();}}>
              <Page titulo="Criar Evento" />
            </Protected>
          } />
          <Route path="/perfil" element={
            <Protected logged={logged} onSuccess={()=>{setLogged(true); closeAuth();}}>
              <Page titulo="Perfil" />
            </Protected>
          } />
          <Route path="/configuracoes" element={
            <Protected logged={logged} onSuccess={()=>{setLogged(true); closeAuth();}}>
              <Page titulo="Configurações" />
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
  );
}

export default App;

