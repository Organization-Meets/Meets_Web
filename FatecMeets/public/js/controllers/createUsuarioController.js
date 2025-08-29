// Pré-visualização da imagem
    document.getElementById('imagem_usuario').addEventListener('change', function(e) {
        const [file] = e.target.files;
        const preview = document.getElementById('preview-img');
        if(file) { preview.src = URL.createObjectURL(file); preview.style.display = 'block'; }
        else { preview.src='#'; preview.style.display='none'; }
    });

    // funções de troca de partes
    function mostrarParte2() {
        document.getElementById("parte1").classList.add("hidden");
        document.getElementById("parte2").classList.remove("hidden");
    }
    function mostrarParte3() {
        document.getElementById("parte2").classList.add("hidden");
        document.getElementById("parte3").classList.remove("hidden");
    }

    // PARTE 1 -> POST /usuarios
    document.getElementById("cadastroForm").addEventListener("submit", async function(e) {
        e.preventDefault();
        const formData = new FormData(e.target);

        try {
            const response = await fetch("/usuarios", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content },
                body: formData
            });

            if(!response.ok) throw new Error("Erro ao cadastrar usuário!");
            const result = await response.json();

            window.usuarioId = result.usuario_id;
            const tipo = formData.get("tipo_usuario");

            document.querySelector("#parte2 select[name='tipo_usuario']").value = tipo;
            document.querySelector("#parte2 input[name='nickname']").value = result.nickname;

            if(tipo==="aluno") {
                document.getElementById("camposAluno").classList.remove("hidden");
                document.getElementById("nome_aluno").value = result.nome;
            } else {
                document.getElementById("camposProfessor").classList.remove("hidden");
                document.getElementById("nome_professor").value = result.nome;
            }

            mostrarParte2();

        } catch(err) { console.error(err); alert("Erro ao cadastrar!"); }
    });

    // PARTE 2 -> POST adicionais
    document.getElementById("dadosAdicionaisForm").addEventListener("submit", async function(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        const tipo = formData.get("tipo_usuario");
        const usuarioId = window.usuarioId;

        try {
            await fetch(`/gameficacoes/store/${usuarioId}`, {
                method: "POST",
                headers: { 
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ nickname: formData.get("nickname") })
            });

            if(tipo==="aluno") {
                await fetch(`/alunos/${usuarioId}`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content },
                    body: JSON.stringify({ ra_aluno: formData.get("ra_aluno"), nome_aluno: formData.get("nome_aluno") })
                });
            } else {
                await fetch(`/academicos/${usuarioId}`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content },
                    body: JSON.stringify({ ra_professor: formData.get("ra_professor"), nome_professor: formData.get("nome_professor") })
                });
            }

            // segue para parte 3 em vez de finalizar
            mostrarParte3();

        } catch(err){ console.error(err); alert("Erro ao salvar dados adicionais!"); }
    });

    // PARTE 3 -> Confirmação do token
    