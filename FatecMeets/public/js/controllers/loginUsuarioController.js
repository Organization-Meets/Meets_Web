document.getElementById("loginForm").addEventListener("submit", async function(e){
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    try {
        const response = await fetch("/usuarios/login", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        });

        const result = await response.json();
        console.log("Retorno backend:", result);

        if(response.ok && result.success){
            // Redireciona para perfil
            window.location.href = "/usuarios/perfil";
        } else {
            // Mostra erro de forma similar ao cadastro
            alert("❌ E-mail ou senha incorretos.");
        }

    } catch(err){
        console.error(err);
        alert("Erro ao tentar logar!");
    }
});