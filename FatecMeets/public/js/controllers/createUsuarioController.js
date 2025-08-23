// Pré-visualização da imagem
    document.getElementById('imagem_usuario').addEventListener('change', function(e) {
        const [file] = e.target.files;
        const preview = document.getElementById('preview-img');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    });

    function mostrarParte2() {
        document.getElementById("parte1").classList.add("hidden");
        document.getElementById("parte2").classList.remove("hidden");
    }
    function voltarParte1() {
        document.getElementById("parte2").classList.add("hidden");
        document.getElementById("parte1").classList.remove("hidden");
    }
    // ==============================
    // PARTE 1 -> POST /usuarios
    // ==============================
    document.getElementById("cadastroForm").addEventListener("submit", async function(e) {
        e.preventDefault();

        let form = e.target;
        let formData = new FormData(form);

        try {
            let response = await fetch("/usuarios", {
                method: "POST", 
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });

            if (!response.ok) throw new Error("Erro ao cadastrar usuário!");

            let result = await response.json();
            console.log("Retorno backend:", result);

            // pega dados retornados
            let usuario_id = result.usuario_id;
            let nome = result.nome;
            let nickname = result.nickname;
            let tipo = formData.get("tipo_usuario");

            // guarda usuario_id para uso na segunda parte
            window.usuarioId = usuario_id;

            // Preenche automaticamente campos da parte 2
            document.querySelector("#parte2 select[name='tipo_usuario']").value = tipo;
            document.querySelector("#parte2 input[name='nickname']").value = nickname;

            if (tipo === "aluno") {
                document.getElementById("camposAluno").classList.remove("hidden");
                document.getElementById("camposProfessor").classList.add("hidden");
                document.getElementById("nome_aluno").value = nome;
            } else if (tipo === "professor") {
                document.getElementById("camposProfessor").classList.remove("hidden");
                document.getElementById("camposAluno").classList.add("hidden");
                document.getElementById("nome_academicos").value = nome;
            }

            // troca de tela
            mostrarParte2();

        } catch (err) {
            console.error(err);
            alert("Erro ao cadastrar!");
        }
    });


    // ==============================
    // PARTE 2 -> POST adicionais
    // ==============================
    document.getElementById("dadosAdicionaisForm").addEventListener("submit", async function(e) {
        e.preventDefault();

        let form = e.target;
        let formData = new FormData(form);
        let tipo = formData.get("tipo_usuario");
        let usuarioId = window.usuarioId;

        try {
            // Se for aluno
            if (tipo === "aluno") {
                await fetch(`/aluno/${usuarioId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        ra_aluno: formData.get("ra_aluno"),
                        nome_aluno: formData.get("nome_aluno")
                    })
                });
            }

            // Se for professor
            if (tipo === "professor") {
                await fetch(`/academicos/${usuarioId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        ra_academicos: formData.get("ra_academicos"),
                        nome_academicos: formData.get("nome_academicos")
                    })
                });
            }

            // Gameficação (sempre manda nickname)
            await fetch(`/gameficacao/${usuarioId}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    nickname: formData.get("nickname")
                })
            });

            alert("Cadastro finalizado com sucesso!");
            window.location.href = "/usuarios/loginForm/";

        } catch (err) {
            console.error(err);
            alert("Erro ao finalizar cadastro!");
        }
    });