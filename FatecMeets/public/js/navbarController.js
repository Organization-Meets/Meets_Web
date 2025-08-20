document.addEventListener("DOMContentLoaded", async function() {
    const profileBtn = document.querySelector(".profile-btn");
    const profileImg = document.querySelector(".profile-img-mini");

    if (!profileBtn || !profileImg) return;

    // Função para verificar login
    async function verificarLogin() {
        try {
            const res = await fetch("/usuario/logged");
            const data = await res.json();

            if (data.logado) {
                profileBtn.textContent = "Logout";
                profileImg.src = data.foto || "/uploads/imgPadrao.png";

                profileBtn.onclick = async () => {
                    await fetch("/usuarios/logout");
                    window.location.reload();
                };
            } else {
                profileBtn.textContent = "Login";
                profileImg.src = "/uploads/imgPadrao.png";
                profileBtn.onclick = () => {
                    window.location.href = "/usuarios/loginForm/";
                };
            }
        } catch (err) {
            console.error("Erro ao verificar login:", err);
        }
    }

    await verificarLogin();

    // Dark mode toggle
    const themeSwitch = document.getElementById("theme-switch");
    const body = document.body;
    if (themeSwitch && localStorage.getItem("theme") === "dark") {
        body.classList.add("dark-mode");
        themeSwitch.checked = true;
    }
    if (themeSwitch) {
        themeSwitch.addEventListener("change", () => {
            body.classList.toggle("dark-mode", themeSwitch.checked);
            localStorage.setItem("theme", themeSwitch.checked ? "dark" : "light");
        });
    }

    // Menu mobile toggle
    const menuToggle = document.querySelector(".menu-toggle");
    const navbarLinks = document.querySelector(".navbar-links");
    if (menuToggle && navbarLinks) {
        menuToggle.addEventListener("click", () => {
            navbarLinks.classList.toggle("active");
        });
    }
});
