document.getElementById("editEventoForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const msg = document.getElementById("msg");

    try {
        const resp = await fetch("{{ route('eventos.update', $evento->id_evento) }}", {
            method: "POST", // Laravel exige POST + _method=PUT
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: formData
        });

        if (!resp.ok) throw new Error("Erro ao atualizar evento");

        const data = await resp.json();

        if (data.success) {
            msg.textContent = data.message;
            msg.style.color = "green";

            // Redireciona para a página do evento após 2s
            setTimeout(() => {
                window.location.href = "/eventos/" + data.id_evento;
            }, 2000);
        } else {
            msg.textContent = "Erro: " + (data.message ?? "Falha desconhecida");
            msg.style.color = "red";
        }
    } catch (err) {
        console.error(err);
        msg.textContent = "Erro ao atualizar evento.";
        msg.style.color = "red";
    }
});