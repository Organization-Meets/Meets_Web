import { useState } from 'react';
import { useTheme } from '../context/ThemeContext';

export default function UpgradeRoleForm({ initialTipo='aluno', onSuccess }) {
  const { theme } = useTheme();
  const dark = theme === 'escuro';
  const [tipoLocal, setTipoLocal] = useState(initialTipo); // aluno | academico
  const [nome, setNome] = useState('');
  const [ra, setRa] = useState('');
  const [msg, setMsg] = useState('');
  const [loading, setLoading] = useState(false);

  const submit = async () => {
    setMsg(''); setLoading(true);
    try {
      const token = sessionStorage.getItem('accessToken');
      const res = await fetch(`/api/roles/${tipoLocal}`, {
        method:'POST',
        headers:{ 'Content-Type':'application/json', Authorization:'Bearer '+token },
        body: JSON.stringify({ nome, ra })
      });
      const data = await res.json();
      if (!res.ok) throw new Error(data.error || 'Erro');
      // atualizar roles em sessionStorage
      const roles = JSON.parse(sessionStorage.getItem('roles')||'[]');
      if (!roles.includes(tipoLocal)) roles.push(tipoLocal);
      sessionStorage.setItem('roles', JSON.stringify(roles));
      onSuccess && onSuccess(tipoLocal);
      setMsg('Cadastro concluído.');
    } catch(e){ setMsg(e.message); } finally { setLoading(false); }
  };

  const bgCard = dark ? '#0f0f0f' : '#fff';
  const textColor = dark ? '#f5f5f5' : '#111';
  const selectorActiveBg = dark ? '#1e1e1e' : '#f0f2f6';
  const selectorBg = dark ? '#141414' : '#fafbfc';
  const selectorBorder = dark ? '#2d2d2d' : '#ccc';
  const inputBorder = dark ? '#2e2e2e' : '#ccc';

  return (
    <div style={{
      maxWidth:520,
      padding:'1rem 1.25rem',
      background:bgCard,
      color:textColor,
      borderRadius:12,
      boxShadow: dark ? '0 4px 14px -6px rgba(0,0,0,.6)' : '0 4px 14px -6px rgba(0,0,0,.25)'
    }}>
      <h2 style={{marginTop:0, fontSize:'1.25rem'}}>Completar Cadastro</h2>
      <p style={{margin:'0 0 1rem', fontSize:'.85rem', opacity:.75}}>Selecione o tipo e informe seus dados para liberar recursos.</p>
      <div style={{display:'flex', gap:'0.75rem', marginBottom:'1rem'}}>
        {['aluno','academico'].map(t => (
          <button
            key={t}
            type="button"
            onClick={()=>setTipoLocal(t)}
            style={{
              flex:1,
              padding:'.6rem 1rem',
              borderRadius:8,
              cursor:'pointer',
              border:`1px solid ${selectorBorder}`,
              background: tipoLocal===t ? selectorActiveBg : selectorBg,
              color:textColor,
              fontWeight:500
            }}
          >{t === 'aluno' ? 'Aluno' : 'Acadêmico'}</button>
        ))}
      </div>
      <div style={{display:'flex', flexDirection:'column', gap:'.75rem'}}>
        <input
          placeholder="Nome"
          value={nome}
          onChange={e=>setNome(e.target.value)}
          style={{
            padding:'.65rem .8rem',
            borderRadius:8,
            border:`1px solid ${inputBorder}`,
            background: dark ? '#141414':'#fff',
            color:'inherit',
            fontSize:'.9rem'
          }}
        />
        <input
          placeholder="RA"
          value={ra}
          onChange={e=>setRa(e.target.value)}
          style={{
            padding:'.65rem .8rem',
            borderRadius:8,
            border:`1px solid ${inputBorder}`,
            background: dark ? '#141414':'#fff',
            color:'inherit',
            fontSize:'.9rem'
          }}
        />
        <button
          disabled={loading}
          onClick={submit}
          style={{
            padding:'.75rem 1rem',
            borderRadius:10,
            border:0,
            cursor:'pointer',
            background: loading ? '#888' : '#ff4d3d',
            color:'#fff',
            fontWeight:600,
            letterSpacing:.3,
            transition:'background .2s'
          }}
        >{loading ? 'Enviando...' : 'Enviar'}</button>
      </div>
      {msg && <p style={{marginTop:'1rem', fontSize:'.8rem', color: msg.includes('Erro') ? '#ff6767' : '#42c07b'}}>{msg}</p>}
    </div>
  );
}
