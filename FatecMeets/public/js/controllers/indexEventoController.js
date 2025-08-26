document.addEventListener("DOMContentLoaded", () => {
    const eventosContainer = document.getElementById("eventosContainer");
    const msg = document.getElementById("mensagem");

    // Função para exibir mensagens
    function showMessage(text, type = "success") {
        msg.textContent = text;
        msg.className = `alert alert-${type}`;
        msg.classList.remove("d-none");
        setTimeout(() => msg.classList.add("d-none"), 4000);
    }

    // Buscar eventos (rota: GET /eventos)
    async function carregarEventos() {
        try {
            const resp = await fetch("{{ route('eventos.index') }}", {
                headers: { "X-Requested-With": "XMLHttpRequest" }
            });

            // Se não for requisição AJAX, Laravel retorna HTML
            if (resp.headers.get("content-type").includes("application/json")) {
                const eventos = await resp.json();
                renderEventos(eventos);
            } else {
                // fallback: renderizar blade normal
                eventosContainer.innerHTML = "<p>Eventos carregados pela view do servidor.</p>";
            }
        } catch (err) {
            console.error("Erro ao carregar eventos:", err);
            showMessage("Erro ao carregar eventos", "danger");
        }
    }

    // Renderizar eventos no HTML
    function renderEventos(eventos) {
        eventosContainer.innerHTML = "";
        if (!eventos.length) {
            eventosContainer.innerHTML = "<p>Nenhum evento encontrado.</p>";
            return;
        }

        eventos.forEach(ev => {
            const card = document.createElement("div");
            card.className = "col-md-4";

            card.innerHTML = `
                <div class="card h-100 shadow-sm">
                    <img src="${ev.imagem_evento ?? '/imagens/default-event.jpg'}" 
                         class="card-img-top" alt="Imagem do Evento">
                    <div class="card-body">
                        <h5 class="card-title">${ev.nome_evento}</h5>
                        <p class="card-text">${ev.descricao ?? ''}</p>
                        <p><strong>Início:</strong> ${ev.data_inicio_evento}</p>
                        <p><strong>Fim:</strong> ${ev.data_final_evento ?? '---'}</p>
                        <a href="/eventos/${ev.id_evento}" class="btn btn-primary btn-sm">Ver Detalhes</a>
                    </div>
                </div>
            `;
            eventosContainer.appendChild(card);
        });
    }

    carregarEventos();
});