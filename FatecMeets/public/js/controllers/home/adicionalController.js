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
        // Exemplo de fetch para entidade Adicional
        const data = await fetchJSON('/api/adicionals');
        console.log('Dados carregados de Adicional:', data);
    } catch (err) {
        console.error('Erro em AdicionalController:', err);
        if (msgEl) {
            msgEl.style.color = 'red';
            msgEl.textContent = `Erro: ${err.message}`;
        }
    }
});
