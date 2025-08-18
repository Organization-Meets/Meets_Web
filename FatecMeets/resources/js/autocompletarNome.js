document.addEventListener('DOMContentLoaded', function() {
    // Se existir valor do backend, preenche o campo nome
    if (typeof nomeBackend !== 'undefined' && nomeBackend) {
        document.getElementById('nome').value = nomeBackend;
    }

    // Autocompleta nome pelo email digitado
    const emailInput = document.getElementById('email');
    const nomeInput = document.getElementById('nome');
    if (emailInput) {
        emailInput.addEventListener('input', function() {
            const email = this.value;
            if (email.includes('@')) {
                let user = email.split('@')[0];
                let parts = user.split('.');
                parts = parts.map(p => p.replace(/\d+/g, '')).filter(p => p.length > 0);
                let nome = parts.map(p => p.charAt(0).toUpperCase() + p.slice(1)).join(' ');
                nomeInput.value = nome;
            } else {
                nomeInput.value = '';
            }
        });
    }
});
