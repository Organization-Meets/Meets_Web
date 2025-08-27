document.addEventListener('DOMContentLoaded', async () => {
    const msgEl = document.getElementById('responseMessage');

    async function fetchJSON(url, options = {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    }) {
        const resp = await fetch(url, options);
        if (!resp.ok) throw new Error(`Erro ao buscar ${url}: ${resp.statusText}`);
        return await resp.json();
    }

    try {
        // Exemplo de fetch para entidade Postagem
        const data = await fetchJSON('/api/postagems');
        console.log('Dados carregados de Postagem:', data);
    } catch (err) {
        console.error('Erro em PostagemController:', err);
        if (msgEl) {
            msgEl.style.color = 'red';
            msgEl.textContent = `Erro: ${err.message}`;
        }
    }
});
