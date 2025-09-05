const API_BASE = '/api';

const getAccess = () => sessionStorage.getItem('accessToken');
const getRefresh = () => localStorage.getItem('refreshToken');

async function refresh() {
  const r = await fetch(`${API_BASE}/auth/refresh`, {
    method: 'POST',
    headers: {'Content-Type':'application/json'},
    body: JSON.stringify({ refreshToken: getRefresh() })
  });
  if (!r.ok) throw new Error('Falha ao renovar token');
  const data = await r.json();
  sessionStorage.setItem('accessToken', data.accessToken);
}

export async function apiFetch(path, options = {}) {
  const method = (options.method || 'GET').toUpperCase();
  const hasBody = options.body !== undefined && method !== 'GET' && method !== 'HEAD';

  const resolveBody = () => {
    if (!hasBody) return undefined;
    if (typeof options.body === 'string') return options.body;
    return JSON.stringify(options.body);
  };

  const exec = async () => fetch(`${API_BASE}${path}`, {
    ...options,
    method,
    headers: {
      ...(hasBody ? { 'Content-Type':'application/json' } : {}),
      ...(options.headers || {}),
      ...(getAccess() ? { Authorization:`Bearer ${getAccess()}` } : {})
    },
    body: resolveBody()
  });

  let res = await exec();
  if (res.status === 401 && getRefresh()) {
    try {
      await refresh();
      res = await exec();
    } catch {
      sessionStorage.removeItem('accessToken');
      localStorage.removeItem('refreshToken');
      throw new Error('Sessão expirada');
    }
  }

  const ct = res.headers.get('content-type') || '';
  let data;
  try {
    data = ct.includes('application/json') ? await res.json() : await res.text();
  } catch {
    data = {};
  }

  if (!res.ok) {
    const msg = (data && (data.error || data.message)) || `HTTP ${res.status}`;
    throw new Error(msg);
  }
  return data;
}

export const api = {
  list: (e) => apiFetch(`/${e}`),
  get: (e,id) => apiFetch(`/${e}/${id}`),
  create: (e,body) => apiFetch(`/${e}`, {method:'POST', body}),
  update: (e,id,body) => apiFetch(`/${e}/${id}`, {method:'PUT', body}),
  remove: (e,id) => apiFetch(`/${e}/${id}`, {method:'DELETE'})
};
