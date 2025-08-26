document.addEventListener("DOMContentLoaded", () => {
    const eventoContainer = document.getElementById("eventoContainer");
    const msg = document.getElementById("mensagem");

    // função de mensagem
    function showMessage(text, type = "success") {
        msg.textContent = text;
        msg.className = `alert alert-${type}`;
        msg.classList.remove("d-none");
        setTimeout(() => msg.classList.add("d-none"), 4000);
    }

    // pegar id_evento da URL
    const urlParts = window.location.pathname.split("/");
    const id_evento = urlParts[urlParts.length - 1];

    async function carregarEvento() {
        try {
            const resp = await fetch(`/eventos/${id_evento}`, {
                headers: { "X-Requested-With": "XMLHttpRequest" }
            });

            // se retornar JSON (via fetch direto)
            if (resp.headers.get("content-type").includes("application/json")) {
                const evento = await resp.json();
                renderEvento(evento);
            } else {
                // se não, fallback: render padrão blade
                eventoContainer.innerHTML = "<p>Detalhes renderizados pelo Blade.</p>";
            }
        } catch (err) {
            console.error("Erro ao carregar evento:", err);
            showMessage("Erro ao carregar evento", "danger");
        }
    }

    function renderEvento(ev) {
        // se imagem for JSON, pega a primeira
        let imagem = ev.imagem_evento ?? "imagens/default-event.jpg";
        if (typeof imagem === "string" && imagem.startsWith("[")) {
            try {
                const imgs = JSON.parse(imagem);
                imagem = imgs[0] ?? "imagens/default-event.jpg";
            } catch (e) {}
        }

        eventoContainer.innerHTML = `
            <img src="${imagem}" class="card-img-top" alt="Imagem do Evento">
            <div class="card-body">
                <h4 class="card-title">${ev.nome_evento}</h4>
                <p class="card-text">${ev.descricao ?? "Sem descrição"}</p>
                <p><strong>Categoria:</strong> ${ev.categoria_evento ?? "Não informada"}</p>
                <p><strong>Início:</strong> ${ev.data_inicio_evento}</p>
                <p><strong>Fim:</strong> ${ev.data_final_evento ?? "---"}</p>
                <hr>
                <a href="/eventos/${ev.id_evento}/edit" class="btn btn-warning btn-sm">Editar</a>
                <button class="btn btn-danger btn-sm" id="btnExcluir">Excluir</button>
            </div>
        `;

        document.getElementById("btnExcluir").addEventListener("click", excluirEvento);
    }

    async function excluirEvento() {
        if (!confirm("Tem certeza que deseja excluir este evento?")) return;

        try {
            const resp = await fetch(`/eventos/${id_evento}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "X-Requested-With": "XMLHttpRequest"
                }
            });

            const data = await resp.json();
            if (data.success) {
                showMessage("Evento excluído com sucesso!");
                setTimeout(() => window.location.href = "/eventos", 1500);
            } else {
                showMessage("Erro ao excluir evento", "danger");
            }
        } catch (err) {
            console.error(err);
            showMessage("Erro ao excluir evento", "danger");
        }
    }

    carregarEvento();
});