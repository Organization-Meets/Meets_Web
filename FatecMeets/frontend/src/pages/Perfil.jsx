import { useEffect, useState } from 'react';

export default function Perfil() {
  const [loading, setLoading] = useState(true);
  const [erro, setErro] = useState('');
  const [data, setData] = useState(null);

  const load = async () => {
    setErro(''); setLoading(true);
    try {
      const token = sessionStorage.getItem('accessToken');
      const r = await fetch('/api/profile/me', { headers:{ Authorization: 'Bearer '+token }});
      if (!r.ok) throw new Error('Falha ao carregar perfil');
      const j = await r.json();
      // normalizar imagem
      if (j.imagem) {
        try { const parsed = typeof j.imagem === 'string'? JSON.parse(j.imagem): j.imagem; if (parsed.base64) j.imagemUrl = 'data:image/*;base64,'+parsed.base64; } catch {}
      }
      setData(j);
    } catch(e){ setErro(e.message); } finally { setLoading(false); }
  };

  useEffect(()=>{ load(); }, []);

  if (loading) return <div style={{padding:'1.25rem'}}>Carregando...</div>;
  if (erro) return <div style={{padding:'1.25rem'}}>Erro: {erro}</div>;
  if (!data) return null;

  return (
    <div style={{padding:'1rem 1.25rem'}}>
      <div style={{display:'flex', gap:'1.25rem', alignItems:'center', flexWrap:'wrap'}}>
        <div style={{width:120, height:120, borderRadius:'50%', overflow:'hidden', background:'#222'}}>
          {data.imagemUrl ? <img src={data.imagemUrl} alt="perfil" style={{width:'100%',height:'100%',objectFit:'cover'}} /> : <div style={{display:'flex',alignItems:'center',justifyContent:'center',height:'100%',color:'#888'}}>Sem foto</div>}
        </div>
        <div style={{flex:1,minWidth:240}}>
          <h2 style={{margin:'0 0 .25rem'}}>{data.nome || 'Usuário'}</h2>
          <p style={{margin:'0 0 .15rem',opacity:.85}}>Nickname: <strong>{data.nickname || '—'}</strong></p>
          <p style={{margin:'0 0 .15rem',opacity:.85}}>Email: <strong>{data.email}</strong></p>
          <p style={{margin:'0 0 .15rem',opacity:.85}}>Score total: <strong>{data.scoreTotal ?? 0}</strong></p>
          <p style={{margin:'0',opacity:.85}}>Roles: {(data.roles||[]).join(', ')||'—'}</p>
          <div style={{marginTop:'1rem', display:'flex', gap:'.6rem', flexWrap:'wrap'}}>
            <button style={btnStyle}>Editar Perfil</button>
            <button style={btnStyle}>Abrir Chat</button>
          </div>
        </div>
      </div>

      <div style={{marginTop:'2rem', display:'grid', gap:'2rem', gridTemplateColumns:'repeat(auto-fit,minmax(280px,1fr))'}}>
        <section>
          <h3 style={secTitle}>Postagens</h3>
          <ul style={listStyle}>
            {(data.postagens||[]).length===0 && <li style={emptyStyle}>Nenhuma postagem</li>}
            {(data.postagens||[]).map(p => (
              <li key={p.id} style={itemStyle}>
                <strong>{p.titulo||'Sem título'}</strong>
                <span style={dateStyle}>{p.createdAt?.split('T')[0]||''}</span>
              </li>
            ))}
          </ul>
        </section>
        <section>
          <h3 style={secTitle}>Eventos</h3>
            <ul style={listStyle}>
              {(data.eventos||[]).length===0 && <li style={emptyStyle}>Nenhum evento</li>}
              {(data.eventos||[]).map(ev => (
                <li key={ev.id} style={itemStyle}>
                  <strong>{ev.titulo||'Sem título'}</strong>
                  <span style={dateStyle}>{ev.createdAt?.split('T')[0]||''}</span>
                </li>
              ))}
            </ul>
        </section>
      </div>
    </div>
  );
}

const btnStyle = { padding:'.55rem .9rem', background:'#ff4d3d', color:'#fff', border:0, borderRadius:8, cursor:'pointer', fontWeight:600 };
const secTitle = { margin:'0 0 .75rem' };
const listStyle = { listStyle:'none', margin:0, padding:0, display:'flex', flexDirection:'column', gap:'.5rem' };
const emptyStyle = { padding:'.75rem .9rem', background:'#ffffff10', borderRadius:8, fontSize:'.85rem', opacity:.8 };
const itemStyle = { padding:'.75rem .9rem', background:'#ffffff10', borderRadius:8, display:'flex', flexDirection:'column', gap:'.25rem' };
const dateStyle = { fontSize:'.7rem', opacity:.6 };
