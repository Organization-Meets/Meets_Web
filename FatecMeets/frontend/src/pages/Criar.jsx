import { useState } from 'react';

export default function Criar() {
  const token = sessionStorage.getItem('accessToken');
  const [pTitulo, setPTitulo] = useState('');
  const [pConteudo, setPConteudo] = useState('');
  const [eTitulo, setETitulo] = useState('');
  const [eDescricao, setEDescricao] = useState('');
  const [eData, setEData] = useState('');
  const [msgPost, setMsgPost] = useState('');
  const [msgEvento, setMsgEvento] = useState('');

  const submitPost = async () => {
    setMsgPost('');
    try {
      const r = await fetch('/api/postagens', { method:'POST', headers:{ 'Content-Type':'application/json', Authorization:'Bearer '+token }, body: JSON.stringify({ titulo:pTitulo, conteudo:pConteudo }) });
      const j = await r.json().catch(()=>({}));
      if (!r.ok) throw new Error(j.error||'Erro ao criar');
      setMsgPost('Postagem criada.'); setPTitulo(''); setPConteudo('');
    } catch(e){ setMsgPost(e.message); }
  };

  const submitEvento = async () => {
    setMsgEvento('');
    try {
      const r = await fetch('/api/eventos', { method:'POST', headers:{ 'Content-Type':'application/json', Authorization:'Bearer '+token }, body: JSON.stringify({ titulo:eTitulo, descricao:eDescricao, data:eData }) });
      const j = await r.json().catch(()=>({}));
      if (!r.ok) throw new Error(j.error||'Erro ao criar');
      setMsgEvento('Evento criado.'); setETitulo(''); setEDescricao(''); setEData('');
    } catch(e){ setMsgEvento(e.message); }
  };

  return (
    <div style={{padding:'1rem 1.25rem', display:'grid', gap:'2rem', gridTemplateColumns:'repeat(auto-fit,minmax(340px,1fr))'}}>
      <section style={cardStyle}>
        <h2 style={{marginTop:0}}>Criar Postagem</h2>
        <input placeholder="Título" value={pTitulo} onChange={e=>setPTitulo(e.target.value)} style={inp} />
        <textarea placeholder="Conteúdo" value={pConteudo} onChange={e=>setPConteudo(e.target.value)} style={{...inp, minHeight:120, resize:'vertical'}} />
        <button onClick={submitPost} style={btn}>Publicar</button>
        {msgPost && <p style={msgStyle}>{msgPost}</p>}
      </section>
      <section style={cardStyle}>
        <h2 style={{marginTop:0}}>Criar Evento</h2>
        <input placeholder="Título" value={eTitulo} onChange={e=>setETitulo(e.target.value)} style={inp} />
        <textarea placeholder="Descrição" value={eDescricao} onChange={e=>setEDescricao(e.target.value)} style={{...inp, minHeight:100, resize:'vertical'}} />
        <input type="datetime-local" value={eData} onChange={e=>setEData(e.target.value)} style={inp} />
        <button onClick={submitEvento} style={btn}>Criar Evento</button>
        {msgEvento && <p style={msgStyle}>{msgEvento}</p>}
      </section>
    </div>
  );
}

const cardStyle = { background:'#0f0f0f', color:'#f5f5f5', padding:'1rem 1.25rem', borderRadius:12, boxShadow:'0 4px 14px -6px rgba(0,0,0,.6)', display:'flex', flexDirection:'column', gap:'.75rem' };
const inp = { padding:'.6rem .75rem', borderRadius:8, border:'1px solid #2d2d2d', background:'#141414', color:'#fff', fontSize:'.9rem' };
const btn = { padding:'.7rem 1rem', background:'#ff4d3d', color:'#fff', border:0, borderRadius:10, cursor:'pointer', fontWeight:600 };
const msgStyle = { fontSize:'.75rem', margin:0, opacity:.8 };
