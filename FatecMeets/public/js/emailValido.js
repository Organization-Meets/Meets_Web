document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.getElementById("email");
    const form = document.getElementById("cadastroForm");

    // Cria um elemento para mostrar mensagens de erro
    let errorMsg = document.createElement("span");
    errorMsg.style.color = "red";
    errorMsg.style.display = "block";
    errorMsg.style.marginBottom = "10px";
    emailInput.parentNode.insertBefore(errorMsg, emailInput.nextSibling);

    // Função para validar domínio do email
    function dominioValido(email) {
        return email.endsWith("@fatec.sp.gov.br");
    }

    // Função para verificar existência do email via requisição AJAX
    async function emailExiste(email) {
        try {
            const response = await fetch(`/api/verificar-email?email=${encodeURIComponent(email)}`);
            if (!response.ok) return false;
            const data = await response.json();
            return data.existe === false; // true se NÃO existe (pode cadastrar)
        } catch (e) {
            return false;
        }
    }

    // Validação ao sair do campo de email
    emailInput.addEventListener("blur", async function () {
        const email = emailInput.value.trim();

        if (!dominioValido(email)) {
            errorMsg.textContent = "O e-mail deve terminar com @fatec.sp.gov.br";
            emailInput.setCustomValidity("E-mail inválido.");
            return;
        }

        errorMsg.textContent = "Verificando e-mail...";
        emailInput.setCustomValidity("");

        const disponivel = await emailExiste(email);

        if (!disponivel) {
            errorMsg.textContent = "Este e-mail já está cadastrado ou não pôde ser verificado.";
            emailInput.setCustomValidity("E-mail já cadastrado.");
        } else {
            errorMsg.textContent = "";
            emailInput.setCustomValidity("");
        }
    });

    // Impede o envio do formulário se o e-mail for inválido
    form.addEventListener("submit", function (e) {
        if (!dominioValido(emailInput.value.trim()) || emailInput.validationMessage) {
            e.preventDefault();
            emailInput.reportValidity();
        }
    });
});