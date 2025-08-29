document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.getElementById("email");
    const form = document.getElementById("cadastroForm");

    if (!emailInput || !form) return;

    let errorMsg = document.createElement("span");
    errorMsg.style.color = "red";
    errorMsg.style.display = "block";
    errorMsg.style.marginBottom = "10px";
    emailInput.parentNode.insertBefore(errorMsg, emailInput.nextSibling);

    function dominioValido(email) {
        return email.endsWith("@fatec.sp.gov.br");
    }

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

    form.addEventListener("submit", function (e) {
        if (!dominioValido(emailInput.value.trim())) {
            e.preventDefault();
            emailInput.reportValidity();
        }
    });
});
