document.addEventListener("DOMContentLoaded", function () {
    const senhaInput = document.getElementById("senha");
    const form = document.getElementById("cadastroForm");

    // Cria um elemento para mostrar mensagens de erro
    let errorMsg = document.createElement("span");
    errorMsg.style.color = "red";
    errorMsg.style.display = "block";
    errorMsg.style.marginBottom = "10px";
    senhaInput.parentNode.insertBefore(errorMsg, senhaInput.nextSibling);

    // Função para validar a senha
    function senhaValida(senha) {
        const temEspecial = /[!@#$%^&*(),.?":{}|<>_\-+=~`[\]\\;/]/.test(senha);
        const temMaiuscula = /[A-Z]/.test(senha);
        const temNumero = /[0-9]/.test(senha);
        const tamanhoMinimo = senha.length >= 10;
        return temEspecial && temMaiuscula && temNumero && tamanhoMinimo;
    }

    // Validação ao sair do campo de senha
    senhaInput.addEventListener("blur", function () {
        const senha = senhaInput.value;

        if (!senhaValida(senha)) {
            errorMsg.textContent = "A senha deve ter pelo menos 10 caracteres, uma letra maiúscula, um número e um caractere especial.";
            senhaInput.setCustomValidity("Senha fraca.");
        } else {
            errorMsg.textContent = "";
            senhaInput.setCustomValidity("");
        }
    });

    // Impede o envio do formulário se a senha for inválida
    form.addEventListener("submit", function (e) {
        if (!senhaValida(senhaInput.value)) {
            e.preventDefault();
            senhaInput.reportValidity();
        }
    });
});