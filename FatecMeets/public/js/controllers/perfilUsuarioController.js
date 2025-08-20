document.addEventListener("DOMContentLoaded", async function () {
    // ==========================
    // 1. Buscar dados do usuário
    // ==========================
    async function buscarUsuario() {
        try {
            const response = await fetch("/perfil/dados"); // criar rota /perfil/dados para retornar JSON do usuário
            if (!response.ok) throw new Error("Erro ao buscar usuário");

            const usuario = await response.json();

            // Preencher campos do perfil
            document.querySelector(".profile-username").textContent = usuario.nome ?? "Usuário";
            document.querySelector(".bio-name").textContent = usuario.nome ?? "";
            document.querySelector(".bio-text:nth-child(2)").textContent = "@ " + (usuario.nickname ?? "");
            document.querySelector(".bio-text:nth-child(3)").textContent = "✉️ " + (usuario.email ?? "");
            document.querySelector(".bio-text:nth-child(4)").textContent = "📞 " + (usuario.numero ?? "");
        } catch (err) {
            console.error(err);
        }
    }

    // ==========================
    // 2. Buscar imagem do usuário
    // ==========================
    async function buscarImagem() {
        try {
            const response = await fetch("/perfil/imagem"); // criar rota /perfil/imagem que retorna { url: ... }
            if (!response.ok) throw new Error("Erro ao buscar imagem");

            const data = await response.json();

            const img = document.createElement("img");
            img.src = data.url;
            img.alt = "Foto de Perfil";
            img.className = "profile-img";
            img.style.maxWidth = "300px";

            const container = document.getElementById("imagem-container");
            container.innerHTML = "";
            container.appendChild(img);
        } catch (err) {
            console.error(err);
        }
    }

    // ==========================
    // 3. Buscar eventos do usuário
    // ==========================
    async function buscarEventos() {
        try {
            const response = await fetch("/perfil/eventos"); // criar rota /perfil/eventos que retorna JSON dos eventos
            if (!response.ok) throw new Error("Erro ao buscar eventos");

            const eventos = await response.json();
            const gallery = document.querySelector(".gallery");
            gallery.innerHTML = "";

            if (eventos.length === 0) {
                gallery.innerHTML = `
                    <div class="no-eventos">
                        <i class="fas fa-calendar-plus"></i>
                        <p>Você ainda não criou nenhum evento</p>
                        <a href="/eventos/create/" class="btn-create-event">Criar primeiro evento</a>
                    </div>
                `;
                return;
            }

            eventos.forEach(evento => {
                const div = document.createElement("div");
                div.className = "photo";
                div.innerHTML = `
                    <img src="${evento.imagem_evento ?? '/assets/default-event.jpg'}" alt="${evento.nome_evento}">
                    <div class="event-info">
                        <strong>${evento.nome_evento}</strong><br>
                        <span>${new Date(evento.data_inicio_evento).toLocaleDateString('pt-BR')}</span>
                    </div>
                `;
                gallery.appendChild(div);
            });
        } catch (err) {
            console.error(err);
        }
    }

    // ==========================
    // Executa todas funções
    // ==========================
    buscarUsuario();
    buscarImagem();
    buscarEventos();
});
