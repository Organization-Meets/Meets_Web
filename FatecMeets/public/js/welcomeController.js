document.addEventListener("DOMContentLoaded", async () => {
    const feed = document.getElementById("feed");
    const msg = document.getElementById("msg");

    try {
        // Busca eventos do backend (rota index do EventoController)
        const resp = await fetch("{{ route('eventos.index') }}", {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        });

        if (!resp.ok) throw new Error("Erro ao carregar eventos");

        // Se o backend retornar JSON
        let eventos;
        const contentType = resp.headers.get("content-type");
        if (contentType && contentType.includes("application/json")) {
            eventos = await resp.json();
        } else {
            // fallback: se a rota retornar view, pega via API /eventos/usuario
            const apiResp = await fetch("{{ route('eventos.eventosUsuario') }}");
            eventos = await apiResp.json();
        }

        feed.innerHTML = "";

        if (eventos.length === 0) {
            msg.textContent = "Nenhum evento ainda. Seja o primeiro a postar!";
            feed.appendChild(msg);
            return;
        }

        eventos.forEach(evento => {
            // caso imagem_evento seja JSON
            let imagem = "imagens/default-event.jpg";
            if (evento.imagem_evento) {
                if (typeof evento.imagem_evento === "string" && evento.imagem_evento.startsWith("[")) {
                    try {
                        const decoded = JSON.parse(evento.imagem_evento);
                        imagem = "/../storage/" + decoded[0];
                    } catch {}
                } else {
                    imagem = evento.imagem_evento;
                }
            }

            const post = document.createElement("div");
            post.classList.add("post");

            post.innerHTML = `
                <div class="post-image">
                    <a href="/eventos/${evento.id_evento}">
                        <img src="${imagem}" alt="Imagem do evento">
                    </a>
                </div>
                <div class="post-content">
                    <h3>
                        <a href="/eventos/${evento.id_evento}">
                            ${evento.nome_evento}
                        </a>
                    </h3>
                    <p><strong>Categoria:</strong> ${evento.categoria_evento ?? "N/A"}</p>
                    <p><strong>Início:</strong> ${new Date(evento.data_inicio_evento).toLocaleString("pt-BR")}</p>
                    ${evento.data_final_evento ? `<p><strong>Fim:</strong> ${new Date(evento.data_final_evento).toLocaleString("pt-BR")}</p>` : ""}
                    <p>${evento.descricao ?? ""}</p>
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