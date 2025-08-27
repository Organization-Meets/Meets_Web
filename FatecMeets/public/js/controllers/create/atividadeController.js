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
        // Exemplo de fetch para entidade Atividade
        const data = await fetchJSON('/api/atividades');
        console.log('Dados carregados de Atividade:', data);
    } catch (err) {
        console.error('Erro em AtividadeController:', err);
        if (msgEl) {
            msgEl.style.color = 'red';
            msgEl.textContent = `Erro: ${err.message}`;
        }
    }
});
