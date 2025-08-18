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

    // Validação ao sair do campo de email
    emailInput.addEventListener("blur", function () {
        const email = emailInput.value.trim();

        if (!dominioValido(email)) {
            errorMsg.textContent = "O e-mail deve terminar com @fatec.sp.gov.br";
            emailInput.setCustomValidity("E-mail inválido.");
        } else {
            errorMsg.textContent = "";
            emailInput.setCustomValidity("");
        }
    });

    // Impede o envio do formulário se o e-mail for inválido
    form.addEventListener("submit", function (e) {
        if (!dominioValido(emailInput.value.trim())) {
            e.preventDefault();
            emailInput.reportValidity();
        }
    });
});
