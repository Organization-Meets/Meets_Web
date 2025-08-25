document.addEventListener("DOMContentLoaded", async function () {
    let usuarioLogado = null;
    
    async function buscarNomeUsuario(usuario_id) {
        try {
            const responseAluno = await fetch(`/alunos/usuario/${usuario_id}`);
            if (responseAluno.ok) {
                const aluno = await responseAluno.json();
                return aluno?.nome_aluno ?? "Usuário";
            }
            return "Usuário";
        } catch (err) {
            console.error(err);
            return "Usuário";
        }
    }

    async function buscarNickname(usuario_id) {
        try {
            const responseGame = await fetch(`/gameficacao/usuario/${usuario_id}`);
            if (responseGame.ok) {
                const game = await responseGame.json();
                return game?.nickname ? `${game.nickname}` : "@";
            }
            return "@";
        } catch (err) {
            console.error(err);
            return "@";
        }
    }

    async function buscarUsuario() {
        try {
            const response = await fetch("/perfil/dados");
            if (!response.ok) return;

            usuarioLogado = await response.json();

            // Busca nome e nickname corretos
            const nomeUsuario = await buscarNomeUsuario(usuarioLogado.usuario_id);
            const nickname = await buscarNickname(usuarioLogado.usuario_id);

            document.querySelector(".profile-username").textContent = nomeUsuario; // <-- Adicione esta linha
            document.querySelector(".bio-nickname").textContent = nickname;
            document.querySelector(".bio-email").textContent = "✉️ " + (usuarioLogado.email ?? "");
            document.querySelector(".bio-telefone").textContent = "📞 " + (usuarioLogado.numero ?? "");

            document.getElementById("edit-profile-link").href = `/usuarios/${usuarioLogado.usuario_id}/edit/`;

        } catch (err) {
            console.error(err);
        }
    }
    async function buscarImagem() {
        try {
            const response = await fetch("/perfil/imagem");
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

    async function buscarEventos() {
        try {
            if (!usuarioLogado) return; // garante que já buscou o usuário

            const response = await fetch(`/eventos/usuario/${usuarioLogado.usuario_id}`);
            if (!response.ok) throw new Error("Erro ao buscar eventos");

            const eventos = await response.json();
            const gallery = document.querySelector(".gallery");
            gallery.innerHTML = "";

            document.getElementById("stat-eventos").textContent = eventos.length ?? 0;

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
                    <img src="${evento.imagem_evento ?? '/imagens/default-event.jpg'}" alt="${evento.nome_evento}">
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

    // Executa em ordem
    await buscarUsuario();
    await buscarImagem();
    await buscarEventos();
});
