document.addEventListener('DOMContentLoaded', function() {
    const nomeInput = document.getElementById('nome');

    if (typeof nomeBackend !== 'undefined' && nomeBackend && nomeInput) {
        nomeInput.value = nomeBackend;
    }

    const emailInput = document.getElementById('email');
    if (emailInput && nomeInput) {
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
