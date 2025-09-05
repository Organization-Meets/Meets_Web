import './App.css';
import { useState } from 'react';
import { AuthFlow } from './components/AuthFlow';
import { Dashboard } from './components/Dashboard';

function App() {
  const [logged, setLogged] = useState(!!sessionStorage.getItem('accessToken'));

  const logout = () => {
    sessionStorage.removeItem('accessToken');
    localStorage.removeItem('refreshToken');
    setLogged(false);
  };

  return (
    <main className="app">
      {!logged && <AuthFlow onSuccess={()=>setLogged(true)} />}
      {logged && <Dashboard onLogout={logout} />}
    </main>
  );
}

export default App;

