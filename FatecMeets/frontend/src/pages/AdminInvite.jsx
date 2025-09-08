import { useEffect, useState } from 'react';
import { useNavigate, useParams } from 'react-router-dom';

export default function AdminInvite() {
  const { token } = useParams();
  const nav = useNavigate();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [confirm, setConfirm] = useState('');
  const [nome, setNome] = useState('');
  const [ra, setRa] = useState('');
  const [msg, setMsg] = useState('');
  const [ok, setOk] = useState(false);
  const [loading, setLoading] = useState(false);

  const submit = async () => {
    setMsg('');
    if (password !== confirm) { setMsg('Senhas não conferem'); return; }
    setLoading(true);
    try {
      const r = await fetch('/api/admin-invite/consume', {
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body: JSON.stringify({ token, email, password, nome, ra })
      });
      const j = await r.json().catch(()=>({}));
      if (!r.ok) throw new Error(j.error||'Erro');
      setOk(true);
      setMsg('Administrador cadastrado. Redirecionando...');
      setTimeout(()=>nav('/'), 1200);
    } catch(e){ setMsg(e.message); } finally { setLoading(false); }
  };

  return (
    <div style={{padding:'1rem 1.25rem', maxWidth:520, margin:'0 auto', background:'#0f0f0f', color:'#f5f5f5', borderRadius:12, boxShadow:'0 4px 14px -6px rgba(0,0,0,.6)'}}>
      <h2 style={{marginTop:0}}>Convite Administrador</h2>
      <p style={{fontSize:'.85rem', opacity:.75}}>Preencha os dados para criar sua conta de administrador.</p>
      <input placeholder="Nome" value={nome} onChange={e=>setNome(e.target.value)} style={inp} />
      <input placeholder="RA (opcional)" value={ra} onChange={e=>setRa(e.target.value)} style={inp} />
      <input placeholder="E-mail" value={email} onChange={e=>setEmail(e.target.value)} style={inp} />
      <input placeholder="Senha" type="password" value={password} onChange={e=>setPassword(e.target.value)} style={inp} />
      <input placeholder="Confirmar Senha" type="password" value={confirm} onChange={e=>setConfirm(e.target.value)} style={inp} />
      <button disabled={loading||ok} onClick={submit} style={btn}>{loading? 'Enviando...' : 'Cadastrar Administrador'}</button>
      {msg && <p style={{marginTop:'1rem', fontSize:'.8rem', color: ok? '#42c07b':'#ff6767'}}>{msg}</p>}
    </div>
  );
}

const inp = { width:'100%', padding:'.65rem .8rem', borderRadius:8, border:'1px solid #2e2e2e', background:'#141414', color:'#fff', fontSize:'.9rem', marginTop:10 };
const btn = { marginTop:14, padding:'.75rem 1rem', width:'100%', border:0, borderRadius:10, background:'#ff4d3d', color:'#fff', cursor:'pointer', fontWeight:600 };
