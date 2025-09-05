import { useEffect, useState } from 'react';
import { api } from '../api/client';

export function EntityTable({ meta }) {
  const { entity, fields, label } = meta;
  const [rows, setRows] = useState([]);
  const [form, setForm] = useState({});
  const [editing, setEditing] = useState(null);
  const [msg, setMsg] = useState('');
  const [loading, setLoading] = useState(false);

  const load = async () => {
    setLoading(true);
    setMsg('');
    try {
      const data = await api.list(entity);
      setRows(Array.isArray(data) ? data : (data.content || []));
    } catch (e) {
      setMsg(e.message);
    } finally {
      setLoading(false);
    }
  };

  useEffect(()=>{ load(); }, [entity]);

  const edit = r => { setEditing(r.id); setForm(r); };
  const reset = () => { setEditing(null); setForm({}); setMsg(''); };

  const submit = async e => {
    e.preventDefault();
    try {
      if (editing) await api.update(entity, editing, form);
      else await api.create(entity, form);
      reset();
      load();
    } catch (err) {
      setMsg(err.message);
    }
  };

  const del = async id => {
    if (!window.confirm('Excluir registro?')) return;
    try {
      await api.remove(entity, id);
      load();
    } catch (e) {
      setMsg(e.message);
    }
  };

  return (
    <div className="entity">
      <h3>{label}</h3>
      {msg && <p style={{color:'red'}}>{msg}</p>}
      <button onClick={reset}>Novo</button>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            {fields.map(f => <th key={f.name}>{f.label}</th>)}
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
        {loading && <tr><td colSpan={fields.length+2}>Carregando...</td></tr>}
        {!loading && rows.length === 0 && <tr><td colSpan={fields.length+2}>Sem registros</td></tr>}
        {rows.map(r => (
          <tr key={r.id}>
            <td>{r.id}</td>
            {fields.map(f => <td key={f.name}>{String(r[f.name] ?? '')}</td>)}
            <td>
              <button onClick={()=>edit(r)}>Editar</button>
              <button style={{marginLeft:4}} onClick={()=>del(r.id)}>Del</button>
            </td>
          </tr>
        ))}
        </tbody>
      </table>
      <form onSubmit={submit} className="entity-form">
        <strong>{editing ? 'Editar' : 'Criar'} {label}</strong>
        {fields.map(f => {
          if (editing && f.createOnly) return null;
          const value = form[f.name] ?? '';
          const commonProps = {
            value,
            onChange: e => setForm({...form, [f.name]: e.target.value}),
            required: !!f.required
          };
          return (
            <label key={f.name}>
              {f.label}
              {f.textarea
                ? <textarea {...commonProps} />
                : <input type={f.type || 'text'} {...commonProps} />
              }
            </label>
          );
        })}
        <div className="actions">
          <button type="submit">Salvar</button>
          <button type="button" onClick={reset}>Cancelar</button>
        </div>
      </form>
    </div>
  );
}
