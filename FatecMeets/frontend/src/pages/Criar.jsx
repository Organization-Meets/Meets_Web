import { useEffect, useState } from 'react';

export default function Criar() {
  const token = sessionStorage.getItem('accessToken');
  const authHeaders = () => ({ 'Content-Type':'application/json', Authorization:'Bearer '+token });

  // Postagens/Eventos (mantidos)
  const [pTitulo, setPTitulo] = useState('');
  const [pConteudo, setPConteudo] = useState('');
  const [eTitulo, setETitulo] = useState('');
  const [eDescricao, setEDescricao] = useState('');
  const [eData, setEData] = useState('');
  const [msgPost, setMsgPost] = useState('');
  const [msgEvento, setMsgEvento] = useState('');

  // Admin flags (substitua depois por roles reais)
  const roles = (()=>{ try { return JSON.parse(sessionStorage.getItem('roles')||'[]'); } catch { return []; } })();
  const isAdmin = roles.includes('administrador');

  // Instituição full (já criada em endpoints anteriores)
  const [inst, setInst] = useState(null);
  const [fiNome, setFiNome] = useState('');
  const [fiCodigo, setFiCodigo] = useState('');
  const [fiEnderecoId, setFiEnderecoId] = useState('');
  const [fiCep, setFiCep] = useState('');
  const [fiNumero, setFiNumero] = useState('');
  const [fiTipoTel, setFiTipoTel] = useState('celular');
  const [fiDdd, setFiDdd] = useState('');
  const [fiTel, setFiTel] = useState('');
  const [fiLugarNome, setFiLugarNome] = useState('');
  const [fiLugaresPermitidos, setFiLugaresPermitidos] = useState([]);

  // Endereços / Lugares / Complementos
  const [enderecos, setEnderecos] = useState([]); // {id, cep, numero}
  const [novoCep, setNovoCep] = useState('');
  const [novoNumero, setNovoNumero] = useState('');

  const [lugares, setLugares] = useState([]); // {id, nome, endereco:{id}}
  const [novoLugarEnderecoId, setNovoLugarEnderecoId] = useState('');
  const [novoLugarNome, setNovoLugarNome] = useState('');

  const [compEnderecoId, setCompEnderecoId] = useState('');
  const [novoComplemento, setNovoComplemento] = useState('');
  const [complementos, setComplementos] = useState({}); // enderecoId -> lista

  // Convite de Administrador
  const [inviteEmail, setInviteEmail] = useState('');
  const [inviteToken, setInviteToken] = useState('');

  // Novos estados para criação de Lugar
  const [lgNome, setLgNome] = useState('');
  const [lgEnderecoId, setLgEnderecoId] = useState('');
  const [lgCep, setLgCep] = useState('');
  const [lgNumero, setLgNumero] = useState('');
  const [lgCriado, setLgCriado] = useState(null);

  // Helpers
  const carregarEnderecos = async () => {
    try { const r = await fetch('/api/admin/enderecos',{ headers:{ Authorization:'Bearer '+token }}); if(r.ok) setEnderecos(await r.json()); } catch {}
  };
  const carregarLugares = async () => {
    try { const r = await fetch('/api/admin/lugares',{ headers:{ Authorization:'Bearer '+token }}); if(r.ok) setLugares(await r.json()); } catch {}
  };
  const carregarComplementos = async (endId) => {
    try { const r = await fetch(`/api/admin/enderecos/${endId}/complementos`,{ headers:{ Authorization:'Bearer '+token }}); if(r.ok){ const data=await r.json(); setComplementos(prev=>({...prev,[endId]:data})); } } catch {}
  };

  useEffect(()=>{ if(isAdmin){ carregarEnderecos(); carregarLugares(); } },[isAdmin]);

  // Ações básicas de conteúdo
  const submitPost = async () => {
    setMsgPost('');
    try {
      const r = await fetch('/api/postagens',{ method:'POST', headers: authHeaders(), body: JSON.stringify({ titulo:pTitulo, conteudo:pConteudo }) });
      const j = await r.json().catch(()=>({}));
      if(!r.ok) throw new Error(j.error||'Erro ao criar');
      setMsgPost('Postagem criada.'); setPTitulo(''); setPConteudo('');
    } catch(e){ setMsgPost(e.message); }
  };
  const submitEvento = async () => {
    setMsgEvento('');
    try {
      const r = await fetch('/api/eventos',{ method:'POST', headers: authHeaders(), body: JSON.stringify({ titulo:eTitulo, descricao:eDescricao, data:eData }) });
      const j = await r.json().catch(()=>({}));
      if(!r.ok) throw new Error(j.error||'Erro ao criar');
      setMsgEvento('Evento criado.'); setETitulo(''); setEDescricao(''); setEData('');
    } catch(e){ setMsgEvento(e.message); }
  };

  // Criar endereço simples (cep + numero)
  const criarEndereco = async () => {
    if(!novoCep || !novoNumero) return;
    try {
      const r = await fetch('/api/admin/enderecos',{ method:'POST', headers: authHeaders(), body: JSON.stringify({ cep:novoCep, numero:novoNumero }) });
      const j = await r.json(); if(!r.ok) throw new Error(j.error||'Erro');
      setEnderecos(v=>[...v,j]); setNovoCep(''); setNovoNumero('');
    } catch(e){ alert(e.message); }
  };

  // Criar lugar (nome + endereco)
  const criarLugar = async () => {
    if(!novoLugarNome || !novoLugarEnderecoId) return;
    try {
      const r = await fetch('/api/admin/lugares',{ method:'POST', headers: authHeaders(), body: JSON.stringify({ nome:novoLugarNome, enderecoId:Number(novoLugarEnderecoId) }) });
      const j = await r.json(); if(!r.ok) throw new Error(j.error||'Erro');
      setLugares(v=>[...v,j]); setNovoLugarNome('');
    } catch(e){ alert(e.message); }
  };

  // Complementos (nome + endereco)
  const criarComplemento = async () => {
    if(!novoComplemento || !compEnderecoId) return;
    try {
      const r = await fetch(`/api/admin/enderecos/${compEnderecoId}/complementos`,{ method:'POST', headers: authHeaders(), body: JSON.stringify({ nome:novoComplemento }) });
      const j = await r.json(); if(!r.ok) throw new Error(j.error||'Erro');
      setComplementos(prev=>({ ...prev, [compEnderecoId]: [ ...(prev[compEnderecoId]||[]), j ] }));
      setNovoComplemento('');
    } catch(e){ alert(e.message); }
  };

  // Instituição (full) usando endpoint /api/admin/instituicao/full
  const addLugarPermitido = () => { if(fiLugarNome.trim()){ setFiLugaresPermitidos(l=>[...l, fiLugarNome.trim()]); setFiLugarNome(''); } };
  const removeLugarPermitido = idx => setFiLugaresPermitidos(l=>l.filter((_,i)=>i!==idx));
  const criarInstituicaoFull = async () => {
    if(inst) return;
    try {
      const body = {
        nomeInstituicao: fiNome,
        codigo: fiCodigo,
        enderecoId: fiEnderecoId? Number(fiEnderecoId): null,
        cep: fiEnderecoId? null : fiCep,
        numero: fiEnderecoId? null : fiNumero,
        tipoTelefone: fiTipoTel,
        dddTelefone: fiDdd,
        numeroTelefone: fiTel,
        lugaresPermitidos: fiLugaresPermitidos
      };
      const r = await fetch('/api/admin/instituicao/full',{ method:'POST', headers: authHeaders(), body: JSON.stringify(body) });
      const j = await r.json(); if(!r.ok) throw new Error(j.error||'Erro');
      setInst(j);
    } catch(e){ alert(e.message); }
  };

  // Gerar convite admin
  const gerarConviteAdmin = async () => {
    if(!inviteEmail) return; try {
      const r = await fetch('/api/admin/convite-admin',{ method:'POST', headers: authHeaders(), body: JSON.stringify({ email: inviteEmail }) });
      const j = await r.json(); if(!r.ok) throw new Error(j.error||'Erro');
      setInviteToken(j.token||''); setInviteEmail('');
    } catch(e){ alert(e.message); }
  };

  // Criar lugar completo (novo endereço ou existente)
  const criarLugarFull = async () => {
    try {
      let enderecoId = lgEnderecoId ? Number(lgEnderecoId) : null;
      if (!enderecoId) {
        if (!lgCep || !lgNumero) return alert('Informe CEP e Número');
        const rEnd = await fetch('/api/admin/enderecos', { method:'POST', headers: authHeaders(), body: JSON.stringify({ cep: lgCep, numero: lgNumero }) });
        const jEnd = await rEnd.json(); if (!rEnd.ok) throw new Error(jEnd.error || 'Erro criando endereço');
        enderecoId = jEnd.id;
        setEnderecos(v => [...v, jEnd]);
      }
      if (!lgNome) return alert('Informe o nome do lugar');
      const r = await fetch('/api/admin/lugares', { method:'POST', headers: authHeaders(), body: JSON.stringify({ nome: lgNome, enderecoId }) });
      const j = await r.json(); if (!r.ok) throw new Error(j.error || 'Erro criando lugar');
      setLgCriado(j);
      setLgNome(''); setLgEnderecoId(''); setLgCep(''); setLgNumero('');
      setLugares(v=>[...v, j]);
    } catch (e) { alert(e.message); }
  };

  return (
    <div style={{
      padding:'1rem 1.25rem',
      background: (document.documentElement.getAttribute('data-theme')==='escuro') ? '#0f0f0f' : '#fff',
      color: (document.documentElement.getAttribute('data-theme')==='escuro') ? '#f5f5f5' : '#111',
      borderRadius:12,
      boxShadow: (document.documentElement.getAttribute('data-theme')==='escuro') ? '0 4px 14px -6px rgba(0,0,0,.6)' : '0 4px 14px -6px rgba(0,0,0,.25)',
      display:'grid', gap:'2rem', gridTemplateColumns:'repeat(auto-fit,minmax(340px,1fr))'
    }}>
      <section style={cardStyle}>
        <h2 style={{marginTop:0}}>Criar Postagem</h2>
        <input placeholder="Título" value={pTitulo} onChange={e=>setPTitulo(e.target.value)} style={inp} />
        <textarea placeholder="Conteúdo" value={pConteudo} onChange={e=>setPConteudo(e.target.value)} style={{...inp, minHeight:120}} />
        <button onClick={submitPost} style={btn}>Publicar</button>
        {msgPost && <p style={msgInfo}>{msgPost}</p>}
      </section>
      <section style={cardStyle}>
        <h2 style={{marginTop:0}}>Criar Evento</h2>
        <input placeholder="Título" value={eTitulo} onChange={e=>setETitulo(e.target.value)} style={inp} />
        <textarea placeholder="Descrição" value={eDescricao} onChange={e=>setEDescricao(e.target.value)} style={{...inp, minHeight:100}} />
        <input type="datetime-local" value={eData} onChange={e=>setEData(e.target.value)} style={inp} />
        <button onClick={submitEvento} style={btn}>Criar Evento</button>
        {msgEvento && <p style={msgInfo}>{msgEvento}</p>}
      </section>

      {isAdmin && (
        <div style={{gridColumn:'1/-1', display:'flex', flexDirection:'column', gap:'1.75rem'}}>
          <h2 style={{margin:'0 0 .5rem', fontSize:'1.15rem'}}>Administração</h2>
          <div style={{display:'grid', gap:'2rem', gridTemplateColumns:'repeat(auto-fit,minmax(320px,1fr))'}}>

            <section style={cardStyle}>
              <h3 style={{marginTop:0}}>Instituição</h3>
              {inst ? (
                <div>
                  <p style={{margin:0}}><strong>Código:</strong> {inst.codigo}</p>
                  <p style={{margin:'4px 0 0'}}><strong>Nome:</strong> {inst.nome}</p>
                  <p style={{fontSize:'.65rem', opacity:.6, marginTop:6}}>Apenas uma instituição permitida para este administrador.</p>
                </div>
              ) : (
                <div style={{display:'flex', flexDirection:'column', gap:'.55rem'}}>
                  <input placeholder="Nome da Instituição" value={fiNome} onChange={e=>setFiNome(e.target.value)} style={inp} />
                  <input placeholder="Código" value={fiCodigo} onChange={e=>setFiCodigo(e.target.value)} style={inp} />
                  <select value={fiEnderecoId} onChange={e=>setFiEnderecoId(e.target.value)} style={inp}>
                    <option value="">Novo endereço</option>
                    {enderecos.map(e=> <option key={e.id} value={e.id}>{e.id} - {e.cep} Nº{e.numero}</option>)}
                  </select>
                  {!fiEnderecoId && (
                    <div style={{display:'flex', gap:8}}>
                      <input placeholder="CEP" value={fiCep} onChange={e=>setFiCep(e.target.value)} style={{...inp, flex:1}} />
                      <input placeholder="Número" value={fiNumero} onChange={e=>setFiNumero(e.target.value)} style={{...inp, flex:1}} />
                    </div>
                  )}
                  <div style={{display:'flex', gap:8, flexWrap:'wrap', alignItems:'center'}}>
                    <div style={{display:'flex', gap:10, background:'#ffffff10', padding:'.45rem .6rem', borderRadius:8}}>
                      {['fixo','celular','whatsapp'].map(t => (
                        <label key={t} style={{display:'flex', alignItems:'center', gap:4, fontSize:'.65rem', textTransform:'capitalize'}}>
                          <input type="radio" name="tipoTel" value={t} checked={fiTipoTel===t} onChange={()=>setFiTipoTel(t)} /> {t}
                        </label>
                      ))}
                    </div>
                    <input placeholder="DDD" value={fiDdd} onChange={e=>setFiDdd(e.target.value)} style={{...inp, width:70}} />
                    <input placeholder="Telefone" value={fiTel} onChange={e=>setFiTel(e.target.value)} style={{...inp, flex:1}} />
                  </div>
                  <div style={{background:'#ffffff10', padding:'.55rem .6rem', borderRadius:8}}>
                    <div style={{display:'flex', gap:6, marginBottom:6}}>
                      <input placeholder="Lugar permitido" value={fiLugarNome} onChange={e=>setFiLugarNome(e.target.value)} style={{...inp, flex:1, margin:0}} />
                      <button onClick={addLugarPermitido} style={{...btn, width:'auto', padding:'.55rem .8rem'}} disabled={!fiLugarNome.trim()}>+</button>
                    </div>
                    <div style={{display:'flex', flexWrap:'wrap', gap:6}}>
                      {fiLugaresPermitidos.map((l,i)=> (
                        <span key={i} style={{background:'#ff4d3d', padding:'2px 8px', borderRadius:14, fontSize:'.65rem', display:'flex', alignItems:'center', gap:4}}>
                          {l}
                          <button onClick={()=>removeLugarPermitido(i)} style={{background:'transparent', border:0, color:'#fff', cursor:'pointer', fontSize:10}}>x</button>
                        </span>
                      ))}
                      {fiLugaresPermitidos.length===0 && <span style={{opacity:.55, fontSize:'.6rem'}}>Nenhum</span>}
                    </div>
                  </div>
                  <button onClick={criarInstituicaoFull} style={btn} disabled={!fiNome||!fiCodigo||!fiDdd||!fiTel || (!fiEnderecoId && (!fiCep||!fiNumero))}>Criar Instituição</button>
                </div>
              )}
            </section>

            <section style={cardStyle}>
              <h3 style={{marginTop:0}}>Convite de Administrador</h3>
              <input placeholder="E-mail do convidado" value={inviteEmail} onChange={e=>setInviteEmail(e.target.value)} style={inp} />
              <button onClick={gerarConviteAdmin} style={btn} disabled={!inviteEmail}>Gerar Convite</button>
              {inviteToken && (
                <div style={{fontSize:'.7rem', wordBreak:'break-all'}}>
                  Token: {inviteToken}
                  <br />
                  Link: {window.location.origin}/admin-invite/{inviteToken}
                </div>
              )}
            </section>

            <section style={cardStyle}>
              <h3 style={{marginTop:0}}>Lugar</h3>
              {lgCriado ? (
                <div>
                  <p style={{margin:0}}><strong>Nome:</strong> {lgCriado.nome}</p>
                  <p style={{margin:'4px 0 0'}}><strong>Endereço:</strong> ID {lgCriado.endereco?.id}</p>
                </div>
              ) : (
                <div style={{display:'flex', flexDirection:'column', gap:'.55rem'}}>
                  <input placeholder="Nome do Lugar" value={lgNome} onChange={e=>setLgNome(e.target.value)} style={inp} />
                  <select value={lgEnderecoId} onChange={e=>setLgEnderecoId(e.target.value)} style={inp}>
                    <option value="">Novo endereço</option>
                    {enderecos.map(e=> <option key={e.id} value={e.id}>{e.id} - {e.cep} Nº{e.numero}</option>)}
                  </select>
                  {!lgEnderecoId && (
                    <div style={{display:'flex', gap:8}}>
                      <input placeholder="CEP" value={lgCep} onChange={e=>setLgCep(e.target.value)} style={{...inp, flex:1}} />
                      <input placeholder="Número" value={lgNumero} onChange={e=>setLgNumero(e.target.value)} style={{...inp, flex:1}} />
                    </div>
                  )}
                  <button onClick={criarLugarFull} style={btn} disabled={!lgNome || (!lgEnderecoId && (!lgCep || !lgNumero))}>Criar Lugar</button>
                </div>
              )}
            </section>
          </div>
        </div>
      )}
    </div>
  );
}

const cardStyle = { background:'#0f0f0f', color:'#f5f5f5', padding:'1rem 1.25rem', borderRadius:12, boxShadow:'0 4px 14px -6px rgba(0,0,0,.6)', display:'flex', flexDirection:'column', gap:'.75rem' };
const inp = { padding:'.55rem .7rem', borderRadius:8, border:'1px solid #2d2d2d', background:'#141414', color:'#fff', fontSize:'.85rem' };
const btn = { padding:'.6rem .9rem', background:'#ff4d3d', color:'#fff', border:0, borderRadius:10, cursor:'pointer', fontWeight:600, fontSize:'.75rem' };
const msgInfo = { fontSize:'.7rem', margin:0, opacity:.8 };
const pill = { background:'#ffffff10', padding:'.45rem .55rem', borderRadius:8, fontSize:'.65rem', lineHeight:1.2 };
