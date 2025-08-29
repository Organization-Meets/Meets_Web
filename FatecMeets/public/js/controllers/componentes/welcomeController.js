document.addEventListener("DOMContentLoaded", async () => {
    const feed = document.getElementById("feed");
    const msg = document.getElementById("msg");

    try {
        const resp = await fetch(window.appRoutes.eventosIndex, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        });

        if (!resp.ok) throw new Error("Erro ao carregar eventos");
        const eventos = await resp.json();

        feed.innerHTML = "";
        if (eventos.length === 0) {
            msg.textContent = "Nenhum evento ainda. Seja o primeiro a postar!";
            feed.appendChild(msg);
            return;
        }

        eventos.forEach(evento => {
            let imagem = "imagens/default-event.jpg";
            if (evento.imagem_evento) imagem = evento.imagem_evento;

            const post = document.createElement("div");
            post.classList.add("post");
            post.innerHTML = `
                <div class="post-image">
                    <a href="/eventos/${evento.id_evento}">
                        <img src="${imagem}" alt="Imagem do evento">
                    </a>
                </div>
                <div class="post-content">
                    <h3><a href="/eventos/${evento.id_evento}">${evento.nome_evento}</a></h3>
                    <p><strong>Categoria:</strong> ${evento.categoria_evento ?? "N/A"}</p>
                </div>
            `;
            feed.appendChild(post);
        });

    } catch (err) {
        console.error(err);
        msg.textContent = "Erro ao carregar eventos.";
        feed.appendChild(msg);
    }
});
