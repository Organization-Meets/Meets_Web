import { NavLink, useNavigate } from 'react-router-dom';
import './Sidebar.css';

// Imports dos ícones (imagens)
import iconHome from '../assets/home.png';
import iconEventos from '../assets/eventos.png';
import iconBuscar from '../assets/search.png';
import iconCriar from '../assets/create.png';
import iconPerfil from '../assets/perfil.png';
import iconConfig from '../assets/configuration.png';

export function Sidebar({ logged, onLogout, onRequireAuth }) {
  const nav = useNavigate();

  const gate = (cb) => {
    if (!logged) { onRequireAuth(); return; }
    cb();
  };

  return (
    <aside className="fm-side icons-only">
      <div className="stack">
        <NavLink to="/" title="Home">
          <img src={iconHome} alt="Home" className="fm-icon" />
        </NavLink>
        <NavLink to="/eventos" title="Eventos">
          <img src={iconEventos} alt="Eventos" className="fm-icon" />
        </NavLink>

        <button
          type="button"
          title="Buscar"
          onClick={()=> gate(()=> nav('/buscar/usuarios'))}
        >
          <img src={iconBuscar} alt="Buscar" className="fm-icon" />
        </button>

        <button
          type="button"
          title="Criar"
          onClick={()=> gate(()=> nav('/criar/postagem'))}
        >
          <img src={iconCriar} alt="Criar" className="fm-icon" />
        </button>

        <button
          type="button"
          title={logged ? 'Perfil' : 'Login'}
          onClick={()=> gate(()=> nav('/perfil'))}
        >
          <img src={iconPerfil} alt="Perfil" className="fm-icon" />
        </button>
      </div>

      <div className="bottom">
        <button
          type="button"
          title="Configurações"
          onClick={()=> gate(()=> nav('/configuracoes'))}
        >
          <img src={iconConfig} alt="Configurações" className="fm-icon" />
        </button>
      </div>
    </aside>
  );
}
