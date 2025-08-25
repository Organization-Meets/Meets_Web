document.addEventListener("DOMContentLoaded", function () {
    const etapaSenha = document.getElementById("etapaSenha");
    const etapaEdicao = document.getElementById("etapaEdicao");
    const formSenha = document.getElementById("formSenha");
    const formEdicao = document.getElementById("form-editar-usuario");
    const inputImagem = document.getElementById("imagem_usuario");
    const nomeInput = document.getElementById("nome");
    const emailInput = document.getElementById("email");
    const mensagemUsuario = document.getElementById("mensagem-usuario");

    // Só libera edição após senha correta
    formSenha?.addEventListener("submit", async function (e) {
        e.preventDefault();
        const senha = document.getElementById("senha_confirmacao").value;
        mensagemUsuario.textContent = "";
        try {
            const resp = await fetch("/usuarios/confirmar-senha", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ senha })
            });
            if (!resp.ok) throw new Error("Senha incorreta!");
            // Se senha correta, mostra etapa de edição
            etapaSenha.classList.add("hidden");
            etapaEdicao.classList.remove("hidden");
            await preencherCampos();
            await buscarImagemPerfil();
        } catch (err) {
            mensagemUsuario.textContent = "Senha incorreta!";
            mensagemUsuario.style.color = "red";
        }
    });

    // Preencher campos com dados atuais do usuário
    async function preencherCampos() {
        try {
            const response = await fetch("/perfil/dados");
            if (!response.ok) return;
            const usuario = await response.json();
            if (nomeInput) nomeInput.value = usuario.nome ?? "";
            if (emailInput) emailInput.value = usuario.email ?? "";
        } catch (err) {
            console.error(err);
        }
    }

    // Buscar e exibir imagem igual ao perfil
    async function buscarImagemPerfil() {
        try {
            const response = await fetch("/perfil/imagem");
            if (!response.ok) throw new Error("Erro ao buscar imagem");
            const data = await response.json();
            const container = document.getElementById("imagem-container");
            container.innerHTML = "";
            const img = document.createElement("img");
            img.src = data.url;
            img.alt = "Foto de Perfil";
            img.className = "profile-img";
            container.appendChild(img);
        } catch (err) {
            const container = document.getElementById("imagem-container");
            container.innerHTML = "";
        }
    }

    // Preview da imagem selecionada
    inputImagem?.addEventListener("change", function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (ev) {
                const container = document.getElementById("imagem-container");
                container.innerHTML = "";
                const img = document.createElement("img");
                img.src = ev.target.result;
                img.alt = "Foto de Perfil";
                img.className = "profile-img";
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });

    // Validação simples antes de enviar
    formEdicao?.addEventListener("submit", function (e) {
        let erros = [];
        if (!nomeInput.value.trim()) erros.push("Nome é obrigatório.");
        if (!emailInput.value.trim()) erros.push("E-mail é obrigatório.");
        if (erros.length > 0) {
            e.preventDefault();
            mensagemUsuario.textContent = erros.join(" ");
            mensagemUsuario.style.color = "red";
        }
    });
});