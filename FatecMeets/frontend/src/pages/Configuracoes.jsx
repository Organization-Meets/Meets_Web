import { useTheme } from '../context/ThemeContext';
import logoLight from '../assets/logo-light.png';
import logoDark from '../assets/logo-dark.png';
import logo from '../assets/logo.png';

export default function Configuracoes() {
  const { theme, highContrast, colorBlind, setTheme, setHighContrast, setColorBlind, reset } = useTheme();
  const previewLogo = theme === 'claro' ? logoLight : theme === 'escuro' ? logoDark : logo;
  const dark = theme === 'escuro';

  return (
    <div style={{
      padding:'1rem 1.25rem',
      background: dark ? '#0f0f0f' : '#fff',
      color: dark ? '#f5f5f5' : '#111',
      borderRadius:12,
      boxShadow: dark ? '0 4px 14px -6px rgba(0,0,0,.6)' : '0 4px 14px -6px rgba(0,0,0,.25)'
    }}>
      <h2 style={{marginTop:0}}>Configurações</h2>
      <section style={{marginTop:'1rem'}}>
        <h3>Tema</h3>
        <div style={{display:'flex', gap:'1rem', flexWrap:'wrap', marginTop:'.5rem'}}>
          {['tradicional','claro','escuro'].map(t => (
            <button key={t} onClick={()=>setTheme(t)} style={{
              padding:'.6rem 1rem', borderRadius:8, border:'1px solid #ccc', cursor:'pointer',
              background: theme===t ? '#f0f2f6' : '#fafbfc', color:'#111'
            }}>{t.charAt(0).toUpperCase()+t.slice(1)}</button>
          ))}
        </div>
      </section>
      <section style={{marginTop:'1.25rem'}}>
        <h3>Contraste</h3>
        <label style={{display:'flex', gap:'.5rem', alignItems:'center', marginTop:'.5rem'}}>
          <input type="checkbox" checked={highContrast} onChange={e=>setHighContrast(e.target.checked)} /> Alto contraste
        </label>
      </section>
      <section style={{marginTop:'1.25rem'}}>
        <h3>Filtro de Daltonismo</h3>
        <select value={colorBlind} onChange={e=>setColorBlind(e.target.value)} style={{marginTop:'.5rem', padding:'.5rem .7rem', borderRadius:8, border:'1px solid #ccc'}}>
          <option value="none">Nenhum</option>
          <option value="deuteranopia">Deuteranopia</option>
            <option value="protanopia">Protanopia</option>
          <option value="tritanopia">Tritanopia</option>
        </select>
      </section>
      <section style={{marginTop:'1.25rem'}}>
        <h3>Pré-visualização</h3>
        <div style={{marginTop:'.5rem', display:'flex', alignItems:'center', gap:'1rem'}}>
          <img src={previewLogo} alt="Logo" style={{height:56}} />
          <div style={{fontSize:'.85rem', opacity:.7}}>Tema atual: {theme}</div>
        </div>
      </section>
      <div style={{marginTop:'1.5rem'}}>
        <button onClick={reset} style={{background:'#ff4d3d', border:0, padding:'.6rem 1rem', borderRadius:8, cursor:'pointer', color:'#fff'}}>Restaurar Padrões</button>
      </div>
    </div>
  );
}
