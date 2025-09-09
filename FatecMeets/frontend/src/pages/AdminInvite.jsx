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
  const [imgFile, setImgFile] = useState(null);
  const [msg, setMsg] = useState('');
  const [ok, setOk] = useState(false);
  const [loading, setLoading] = useState(false);
  const [nickname, setNickname] = useState('');
  const [nicknameStatus, setNicknameStatus] = useState(null);
  const [nickTimer, setNickTimer] = useState(null);

  const fileToBase64 = file => new Promise((res,rej)=>{ const r=new FileReader(); r.onload=()=>res(r.result.split(',')[1]); r.onerror=rej; r.readAsDataURL(file); });

  const submit = async () => {
    setMsg('');
    if (password !== confirm) { setMsg('Senhas não conferem'); return; }
    if (!nickname.startsWith('@')) { setMsg('Nickname deve começar com "@"'); return; }
    setLoading(true);
    try {
      let imagemBase64=null; if (imgFile) imagemBase64 = await fileToBase64(imgFile);
      const r = await fetch('/api/admin-invite/consume', {
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body: JSON.stringify({ token, email, password, nome, ra, imagemBase64, nickname })
      });
      const j = await r.json().catch(()=>({}));
      if (!r.ok) throw new Error(j.error||'Erro');
      // persist roles e nickname
      sessionStorage.setItem('roles', JSON.stringify(['administrador']));
      sessionStorage.setItem('refreshProfile','1');
      sessionStorage.setItem('adminNickname', j.nickname || '');
      if (imagemBase64) sessionStorage.setItem('userImage', 'data:image/*;base64,'+imagemBase64);
      setOk(true);
      setMsg('Administrador cadastrado. Redirecionando...');
      setTimeout(()=>nav('/perfil'), 1000);
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
      <input placeholder="Nickname (comece com @)" value={nickname} onChange={e=>{
        const v=e.target.value; setNickname(v); setNicknameStatus(null);
        if (nickTimer) clearTimeout(nickTimer);
        const t=setTimeout(async()=>{ if(!v) return; try{ const r=await fetch(`/api/nickname/check?value=${encodeURIComponent(v)}`); const j=await r.json(); setNicknameStatus(j);}catch{ setNicknameStatus({available:false, format:false, message:'erro'});} },400);
        setNickTimer(t);
      }} style={inp} />
      {nicknameStatus && <div style={{fontSize:'.7rem', color:nicknameStatus.available?'#42c07b':'#ff6767'}}>{nicknameStatus.message}</div>}
      <input type="file" accept="image/*" onChange={e=>setImgFile(e.target.files?.[0]||null)} style={{marginTop:10}} />
      <button disabled={loading||ok} onClick={submit} style={btn}>{loading? 'Enviando...' : 'Cadastrar Administrador'}</button>
      {msg && <p style={{marginTop:'1rem', fontSize:'.8rem', color: ok? '#42c07b':'#ff6767'}}>{msg}</p>}
    </div>
  );
}

const inp = { width:'100%', padding:'.65rem .8rem', borderRadius:8, border:'1px solid #2e2e2e', background:'#141414', color:'#fff', fontSize:'.9rem', marginTop:10 };
const btn = { marginTop:14, padding:'.75rem 1rem', width:'100%', border:0, borderRadius:10, background:'#ff4d3d', color:'#fff', cursor:'pointer', fontWeight:600 };
