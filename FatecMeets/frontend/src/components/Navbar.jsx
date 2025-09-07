import { NavLink } from 'react-router-dom';
import { useState, useRef, useEffect } from 'react';
import './Navbar.css';
import logo from '../assets/logo.png';

export default function Navbar({ logged, onLogout, onOpenLogin, onOpenRegister }) {
  const [openProfile, setOpenProfile] = useState(false);
  const ref = useRef(null);

  useEffect(() => {
    const handler = e => {
      if (ref.current && !ref.current.contains(e.target)) setOpenProfile(false);
    };
    document.addEventListener('mousedown', handler);
    return () => document.removeEventListener('mousedown', handler);
  }, []);

  return (
    <header className="topbar">
      <div className="brand">
        <NavLink to="/">
          <img src={logo} alt="FatecMeets" className="brand-logo" />
        </NavLink>
      </div>
      <div className="profile-menu" ref={ref}>
        <button
          className="avatar-btn"
          onClick={() => setOpenProfile(o => !o)}
          aria-haspopup="true"
          aria-expanded={openProfile}
        >
          <span className="avatar-icon" aria-hidden="true">👤</span>
        </button>
        {openProfile && (
          <div className="dropdown">
            {logged ? (
              <>
                <NavLink to="/perfil" onClick={()=>setOpenProfile(false)}>Ver Perfil</NavLink>
                <button onClick={onLogout}>Sair</button>
              </>
            ) : (
              <>
                <button onClick={() => { onOpenLogin(); setOpenProfile(false); }}>Fazer Login</button>
                <button onClick={() => { onOpenRegister(); setOpenProfile(false); }}>Cadastrar-se</button>
              </>
            )}
          </div>
        )}
      </div>
    </header>
  );
}
