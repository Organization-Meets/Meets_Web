import { ENTITIES, ENTITY_ORDER } from '../api/endpoints';
import { EntityTable } from './EntityTable';
import { useState } from 'react';

export function Dashboard({ onLogout }) {
  const [sel, setSel] = useState(ENTITY_ORDER[0]);

  return (
    <div className="dash">
      <aside>
        <h2>Entidades</h2>
        <button className="logout" onClick={onLogout}>Sair</button>
        <ul>
          {ENTITY_ORDER.map(k => (
            <li key={k}>
              <button
                className={sel === k ? 'active' : ''}
                onClick={()=>setSel(k)}>
                {ENTITIES[k].label}
              </button>
            </li>
          ))}
        </ul>
      </aside>
      <section className="content">
        <EntityTable meta={ENTITIES[sel]} />
      </section>
    </div>
  );
}
