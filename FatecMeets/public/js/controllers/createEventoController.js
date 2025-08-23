// Suponha que você tenha endpoints:
// /lugares -> retorna JSON com todos os lugares
// /logradouros -> retorna JSON com todos os logradouros
// /atividades -> endpoint POST para criar atividade
// /eventos -> endpoint POST para criar evento

document.addEventListener('DOMContentLoaded', async () => {
    const lugaresContainer = document.getElementById('lugaresContainer');
    const logradourosContainer = document.getElementById('logradourosContainer');

    // 1. Buscar lugares
    const lugaresResp = await fetch('/lugares');
    const lugares = await lugaresResp.json();

    lugares.forEach(lugar => {
        const div = document.createElement('div');
        div.innerHTML = `<input type="radio" name="id_lugares" value="${lugar.id_lugar}" class="lugar-radio"> ${lugar.nome_lugares}`;
        lugaresContainer.appendChild(div);
    });

    // 2. Buscar logradouros
    const logradourosResp = await fetch('/logradouros');
    const logradouros = await logradourosResp.json();

    // Filtrar logradouros quando lugar mudar
    document.querySelectorAll('.lugar-radio').forEach(radio => {
        radio.addEventListener('change', () => {
            logradourosContainer.innerHTML = '';
            const selectedLugar = radio.value;
            logradouros.filter(l => l.id_lugares == selectedLugar).forEach(l => {
                const div = document.createElement('div');
                div.innerHTML = `<input type="radio" name="id_logradouro" value="${l.id_logradouro}"> ${l.nome_logradouro}`;
                logradourosContainer.appendChild(div);
            });
        });
    });

    // 3. Envio do formulário
    document.getElementById('createEventoForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);

        const msgEl = document.getElementById('responseMessage');

        try {
            // Primeiro criar atividade
            const atividadeResp = await fetch('/atividades', {
                method: 'POST',
                body: JSON.stringify({ tipo_atividade: 'evento' }),
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': formData.get('_token') }
            });
            const atividadeData = await atividadeResp.json();
            formData.append('id_atividade', atividadeData.id_atividade);

            // Agora criar evento
            const eventoResp = await fetch('/eventos', {
                method: 'POST',
                body: formData
            });
            const eventoData = await eventoResp.json();

            if(eventoResp.ok && eventoData.success){
                msgEl.style.color = 'green';
                msgEl.textContent = 'Evento criado com sucesso!';
                form.reset();
            } else {
                msgEl.style.color = 'red';
                msgEl.textContent = eventoData.message || 'Erro ao criar evento.';
            }

        } catch(err) {
            msgEl.style.color = 'red';
            msgEl.textContent = 'Erro de rede. Tente novamente.';
            console.error(err);
        }
    });
});
