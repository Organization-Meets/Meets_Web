document.addEventListener("DOMContentLoaded", function () {
    const nicknameInput = document.querySelector('input[name="nickname"]');

    if (typeof nicknameBackend !== "undefined" && nicknameInput) {
        nicknameInput.value = nicknameBackend;
    }
});
