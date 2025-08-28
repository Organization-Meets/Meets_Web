document.addEventListener("DOMContentLoaded", async function() {
    const profileBtn = document.querySelector(".profile-btn");

    if (!profileBtn) return;
    async function buscarImagem() {
        try {
            const response = await fetch("/perfil/imagem");
            if (!response.ok) throw new Error("Erro ao buscar imagem");

            const data = await response.json();

            const img = document.createElement("img");
            img.src = data.url;
            img.alt = "Foto de Perfil";
            img.className = "profile-img-mini";
            img.style.maxWidth = "300px";

            const container = document.getElementById("img-container");
            container.innerHTML = "";
            container.appendChild(img);

        } catch (err) {
            console.error(err);
        }
    }
    // Função para verificar login
    async function verificarLogin() {
        try {
            const res = await fetch("/usuario/logged");
            const data = await res.json();

            if (data.logado) {
                profileBtn.textContent = "Logout";
                await buscarImagem();

                profileBtn.onclick = async () => {
                    await fetch("/usuarios/logout");
                    window.location.href = "/inicio/";
                };
            } else {
                profileBtn.textContent = "Login";
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
