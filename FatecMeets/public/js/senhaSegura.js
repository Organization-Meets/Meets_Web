document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");
    const form = document.getElementById("cadastroForm");

    // Cria um elemento para mostrar mensagens de erro
    let errorMsg = document.createElement("span");
    errorMsg.style.color = "red";
    errorMsg.style.display = "block";
    errorMsg.style.marginBottom = "10px";
    passwordInput.parentNode.insertBefore(errorMsg, passwordInput.nextSibling);

    // Função para validar a password
    function passwordValida(password) {
        const temEspecial = /[!@#$%^&*(),.?":{}|<>_\-+=~`[\]\\;/]/.test(password);
        const temMaiuscula = /[A-Z]/.test(password);
        const temNumero = /[0-9]/.test(password);
        const tamanhoMinimo = password.length >= 10;
        return temEspecial && temMaiuscula && temNumero && tamanhoMinimo;
    }

    // Validação ao sair do campo de password
    passwordInput.addEventListener("blur", function () {
        const password = passwordInput.value;

        if (!passwordValida(password)) {
            errorMsg.textContent = "A password deve ter pelo menos 10 caracteres, uma letra maiúscula, um número e um caractere especial.";
            passwordInput.setCustomValidity("password fraca.");
        } else {
            errorMsg.textContent = "";
            passwordInput.setCustomValidity("");
        }
    });

    // Impede o envio do formulário se a password for inválida
    form.addEventListener("submit", function (e) {
        if (!passwordValida(passwordInput.value)) {
            e.preventDefault();
            passwordInput.reportValidity();
        }
    });
});