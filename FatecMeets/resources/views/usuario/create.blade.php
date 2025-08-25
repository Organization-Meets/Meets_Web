<!DOCTYPE html> 
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="/css/estilo-cadastro.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .hidden { display: none; }
        .section { padding: 20px; border: 1px solid #ccc; margin: 10px; }
        #preview-img { max-width:120px; max-height:120px; border-radius:50%; display:none; margin:0 auto; }
    </style>
</head>
<body>
<div class="container">
    <h2>Cadastro</h2>

    <!-- PARTE 1: Usuário -->
    <div id="parte1" class="section">
        <form id="cadastroForm" enctype="multipart/form-data">
            @csrf
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Senha" required>
            <input type="password" name="password_confirmation" placeholder="Confirmar Senha" required>
            <input type="file" name="imagem_usuario[]" accept="image/*" id="imagem_usuario">

            <div id="preview-container" style="text-align:center; margin-bottom:10px;">
                <img id="preview-img" alt="Prévia da imagem" />
            </div>

            <p style="text-align:center;">Selecione o tipo de usuário:</p>
            <select name="tipo_usuario" required>
                <option value="">Selecione</option>
                <option value="aluno">Aluno</option>
                <option value="professor">Acadêmico</option>
            </select>
            <hr>
            <button type="submit">Cadastrar</button>
        </form>
    </div>

    <!-- PARTE 2: Dados adicionais -->
    <div id="parte2" class="section hidden">
        <form id="dadosAdicionaisForm">
            @csrf
            <img src="/imagens/logo.png" alt="Logo" style="width:100px; display:block; margin:0 auto 15px auto;">
            
            <select name="tipo_usuario" required>
                <option value="">Selecione</option>
                <option value="aluno">Aluno</option>
                <option value="professor">Acadêmico</option>
            </select>

            <div id="camposAluno" class="hidden">
                <input type="number" name="ra_aluno" placeholder="RA do aluno">
                <input type="text" id="nome_aluno" name="nome_aluno" placeholder="Primeiro e último nome" readonly>
            </div>

            <div id="camposProfessor" class="hidden">
                <input type="number" name="ra_professor" placeholder="RA do acadêmico">
                <input type="text" id="nome_professor" name="nome_professor" placeholder="Primeiro e último nome" readonly>
            </div>

            <input type="text" name="nickname" placeholder="Nome de usuário" readonly>
            <hr>
            <button type="submit">Avançar</button>
        </form>
    </div>

    <div id="parte3" class="section hidden">
        <form id="tokenForm">
            @csrf
            <h3>Confirmação de E-mail</h3>
            <p>Enviamos um código de verificação para seu e-mail. Digite abaixo:</p>
            <input type="text" name="token" placeholder="Código de verificação" required maxlength="6">
            <hr>
            <button type="submit">Confirmar Conta</button>
        </form>

        <!-- Botão para reenviar -->
        <button type="button" id="reenviarBtn" style="margin-top:10px;">Reenviar Código</button>
    </div>

    <a href="/inicio/"><button type="button">Voltar</button></a>
</div>

<script>
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
</script>
</body>
</html>