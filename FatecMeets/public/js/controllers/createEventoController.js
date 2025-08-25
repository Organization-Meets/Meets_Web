document.addEventListener('DOMContentLoaded', async () => { 
    const lugaresContainer = document.getElementById('lugaresContainer');
    const logradourosContainer = document.getElementById('logradourosContainer');
    const msgEl = document.getElementById('responseMessage');

    // Função auxiliar para buscar JSON com tratamento de erros
    async function fetchJSON(url) {
        const resp = await fetch(url);
        if (!resp.ok) throw new Error(`Erro ao buscar ${url}: ${resp.statusText}`);
        return await resp.json();
    }

    try {
        // 1. Buscar lugares
        const lugares = await fetchJSON('/api/lugares');
        lugares.forEach(lugar => {
            const div = document.createElement('div');
            div.innerHTML = `
                <input type="radio" 
                       name="id_lugares" 
                       value="${lugar.id_lugar}" 
                       data-endereco="${lugar.id_endereco}" 
                       class="lugar-radio"> ${lugar.nome_lugares}`;
            lugaresContainer.appendChild(div);
        });

        // 2. Atualiza logradouros ao mudar o lugar selecionado
        lugaresContainer.addEventListener('change', async (e) => {
            if (!e.target.classList.contains('lugar-radio')) return;

            logradourosContainer.innerHTML = '';
            const selectedEndereco = e.target.dataset.endereco;

            try {
                const logradouros = await fetchJSON(`/api/logradouros/${selectedEndereco}`);
                logradouros.forEach(l => {
                    const div = document.createElement('div');
                    div.innerHTML = `<input type="radio" name="id_logradouro" value="${l.id_logradouro}"> ${l.nome_logradouro}`;
                    logradourosContainer.appendChild(div);
                });
            } catch (err) {
                console.error('Erro ao buscar logradouros:', err);
                msgEl.style.color = 'red';
                msgEl.textContent = 'Erro ao carregar logradouros.';
            }
        });

    } catch (err) {
        console.error('Erro ao buscar lugares:', err);
        msgEl.style.color = 'red';
        msgEl.textContent = `Erro ao carregar lugares: ${err.message}`;
    }

    // 3. Captura envio do formulário
    document.getElementById('createEventoForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        const csrfToken = formData.get('_token');

        try {
            // 3.1 Buscar gamificação do usuário logado
            const gamificacaoResp = await fetch('/gameficacoes/usuario', {
                headers: { 'X-CSRF-TOKEN': csrfToken }
            });
            const gamificacoes = await gamificacaoResp.json();
            if (!gamificacoes.length) throw new Error('Nenhuma gamificação encontrada');

            // 3.2 Criar atividade do tipo 'evento' (rota: POST /atividades)
            const atividadeResp = await fetch('/atividades/', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ 
                    tipo_atividade: 'evento',
                    id_gamificacao: gamificacoes[0].id_gameficacao
                })
            });
            const atividadeData = await atividadeResp.json();
            if (!atividadeData.atividade_id) throw new Error('Falha ao criar atividade');
            formData.append('id_atividade', atividadeData.atividade_id);

            const eventoResp = await fetch(`/eventos/store/${idUsuario}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken },
                body: formData
            });
            const eventoData = await eventoResp.json();

            if (eventoResp.ok && eventoData.success) {
                msgEl.style.color = 'green';
                msgEl.textContent = 'Evento criado com sucesso!';
                form.reset();
                lugaresContainer.innerHTML = '';
                logradourosContainer.innerHTML = '';
                window.location.href = "/usuarios/perfil/";
            } else {
                msgEl.style.color = 'red';
                msgEl.textContent = eventoData.message || 'Erro ao criar evento.';
            }

        } catch (err) {
            msgEl.style.color = 'red';
            msgEl.textContent = `Erro: ${err.message}`;
            console.error(err);
        }
    });
});