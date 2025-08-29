document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");
    const form = document.getElementById("cadastroForm");

    if (!passwordInput || !form) return;

    let errorMsg = document.createElement("span");
    errorMsg.style.color = "red";
    errorMsg.style.display = "block";
    errorMsg.style.marginBottom = "10px";
    passwordInput.parentNode.insertBefore(errorMsg, passwordInput.nextSibling);

    function passwordValida(password) {
        const temEspecial = /[!@#$%^&*(),.?":{}|<>_\-+=~`[\]\\;/]/.test(password);
        const temMaiuscula = /[A-Z]/.test(password);
        const temNumero = /[0-9]/.test(password);
        const tamanhoMinimo = password.length >= 10;
        return temEspecial && temMaiuscula && temNumero && tamanhoMinimo;
    }

    passwordInput.addEventListener("blur", function () {
        const password = passwordInput.value;

        if (!passwordValida(password)) {
            errorMsg.textContent = "A senha deve ter pelo menos 10 caracteres, uma letra maiúscula, um número e um caractere especial.";
            passwordInput.setCustomValidity("Senha fraca.");
        } else {
            errorMsg.textContent = "";
            passwordInput.setCustomValidity("");
        }
    });

    form.addEventListener("submit", function (e) {
        if (!passwordValida(passwordInput.value)) {
            e.preventDefault();
            passwordInput.reportValidity();
        }
    });
});
