document.getElementById('createEventoForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    const token = document.querySelector('input[name="_token"]').value;
    formData.append('_token', token);

    try {
        const response = await fetch('/eventos', {
            method: 'POST',
            body: formData,
        });

        const data = await response.json();
        const messageEl = document.getElementById('responseMessage');

        if(response.ok){
            messageEl.style.color = 'green';
            messageEl.textContent = 'Evento criado com sucesso!';
            form.reset();
        } else {
            messageEl.style.color = 'red';
            messageEl.textContent = data.message || 'Erro ao criar evento.';
        }
    } catch(err) {
        document.getElementById('responseMessage').style.color = 'red';
        document.getElementById('responseMessage').textContent = 'Erro de rede. Tente novamente.';
        console.error(err);
    }
});