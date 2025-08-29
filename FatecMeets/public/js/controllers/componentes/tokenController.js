document.getElementById("tokenForm").addEventListener("submit", async function(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        const usuarioId = window.usuarioId;

        try {
            const response = await fetch(`/usuarios/${usuarioId}/confirmar-token`, {
                method: "POST",
                headers: { 
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ token: formData.get("token") })
            });

            if(!response.ok) throw new Error("Token inválido!");
            alert("Conta confirmada com sucesso!");
            window.location.href="/usuarios/loginForm/";

        } catch(err){ 
            console.error(err); 
            alert("Erro ao confirmar token!");
        }
    });
    // Reenvio do token
    document.getElementById("reenviarBtn").addEventListener("click", async function() {
        const usuarioId = window.usuarioId;

        try {
            const response = await fetch(`/usuarios/${usuarioId}/reenviar-token`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) throw new Error("Erro ao reenviar código!");
            alert("Novo código enviado para seu e-mail!");

        } catch(err) {
            console.error(err);
            alert("Não foi possível reenviar o código.");
        }
    });