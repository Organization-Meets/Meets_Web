document.addEventListener("DOMContentLoaded", function () {
    // Seleciona o input de nickname
    const nicknameInput = document.querySelector('input[name="nickname"]');

    // Se a variável do backend existir, preenche o campo
    if (typeof nicknameBackend !== "undefined" && nicknameInput) {
        nicknameInput.value = nicknameBackend;
    }
});