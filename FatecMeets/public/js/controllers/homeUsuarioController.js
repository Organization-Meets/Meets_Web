document.addEventListener("DOMContentLoaded", function() {
    async function carregarEventos() {
        try {
            const response = await fetch("/evento/all/");
            if (!response.ok) throw new Error("Erro ao buscar eventos!");
            const eventos = await response.json();

            const feed = document.querySelector(".feed");
            feed.innerHTML = "";

            if (!eventos.length) {
                feed.innerHTML = "<p style='text-align:center;'>Nenhum evento ainda. Seja o primeiro a postar!</p>";
                return;
            }

            eventos.forEach(evento => {
                const postDiv = document.createElement("div");
                postDiv.classList.add("post");

                let imagemHTML = evento.imagem ? `
                    <a href="/view/Evento.php?id=${evento.id}">
                        <div class="post-image">
                            <img src="${evento.imagem}" alt="Imagem do evento">
                        </div>
                    </a>
                ` : "";

                let fotoPerfil = evento.foto && evento.fotoExists
                    ? evento.foto
                    : "/uploads/imgPadrao.png";

                postDiv.innerHTML = `
                    ${imagemHTML}
                    <div class="post-content">
                        <h3><a href="/view/Evento.php?id=${evento.id}">${evento.titulo}</a></h3>
                        <p><strong>Local:</strong> ${evento.local}</p>
                        <p><strong>Categoria:</strong> ${evento.categoria}</p>
                        <p><strong>Quando:</strong> ${evento.data_evento_formatada}</p>
                        <p>${evento.descricao}</p>
                        <div class="post-footer">
                            Publicado em ${evento.data_criacao_formatada} por: <u>${evento.nome}</u>
                            <img src="${fotoPerfil}" class="profile-img-mini" alt="Foto perfil">
                        </div>
                    </div>
                `;

                feed.appendChild(postDiv);
            });
        } catch (err) {
            console.error(err);
            alert("Erro ao carregar eventos!");
        }
    }

    carregarEventos();
});
