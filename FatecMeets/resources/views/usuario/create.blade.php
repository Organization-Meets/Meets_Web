<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="/css/estilo-cadastro.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .hidden {
            display: none;
        }
        .section {
            padding: 20px;
            border: 1px solid #ccc;
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro</h2>

        <!-- PARTE 1 -->
        <div id="parte1" class="section">
            <form id="cadastroForm" enctype="multipart/form-data">
                @csrf
                <input type="email" name="email" id="email" placeholder="E-mail" required>
                <input type="password" name="senha" id="senha" placeholder="Senha" required>
                <input type="password" name="senha_confirmation" id="confirmar_senha" placeholder="Confirmar Senha" required>
                <input type="file" name="imagem_usuario" id="imagem_usuario" accept="image/*">
                
                <div id="preview-container" style="text-align:center; margin-bottom:10px;">
                    <img id="preview-img" src="#" alt="Prévia da imagem"
                         style="display:none; max-width:120px; max-height:120px; border-radius:50%; margin:0 auto;" />
                </div>

                <p style="text-align: center; margin-bottom: 20px;">Selecione o tipo de usuário que deseja cadastrar:</p>
                <select name="tipo_usuario" required>
                    <option value="">Selecione</option>
                    <option value="aluno">Aluno</option>
                    <option value="professor">Academicos</option>
                </select>
                <hr>
                <button type="submit">Cadastrar</button>
                <hr>
            </form>
        </div>

        <!-- PARTE 2 -->
        <div id="parte2" class="section hidden">
            <form id="dadosAdicionaisForm">
                @csrf
                <img src="/imagens/logo.png" alt="Logo"
                     style="width: 100px; margin-bottom: 15px; display: block; margin-left: auto; margin-right: auto;">

                <p style="text-align: center; margin-bottom: 20px;">Tipo de Usuario:</p>
                <select name="tipo_usuario" required>
                    <option value="">Selecione</option>
                    <option value="aluno">Aluno</option>
                    <option value="professor">Academicos</option>
                </select>

                <div id="camposAluno" class="hidden">
                    <input type="number" name="ra_aluno" placeholder="RA do aluno">
                    <input id="nome_aluno" type="text" name="nome_aluno" placeholder="Primeiro e último nome" readonly>
                </div>

                <div id="camposProfessor" class="hidden">
                    <input type="number" name="ra_academicos" placeholder="RA do acadêmico">
                    <input id="nome_academicos" type="text" name="nome_academicos" placeholder="Primeiro e último nome" readonly>
                </div>

                <input type="text" name="nickname" placeholder="Nome de usuário" readonly>
                <hr>
                <button type="submit">Finalizar Cadastro</button>
                <hr>
            </form>
        </div>

        <a href="/home/"><button type="button">Voltar</button></a>
    </div>

    <!-- Scripts auxiliares -->
    <script src="/js/confirmarSenha.js"></script>
    <script src="/js/emailValido.js"></script>
    <script src="/js/senhaSegura.js"></script>

    <script>
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
    </script>

    <script>
    function mostrarParte2() {
        document.getElementById("parte1").classList.add("hidden");
        document.getElementById("parte2").classList.remove("hidden");
    }
    function voltarParte1() {
        document.getElementById("parte2").classList.add("hidden");
        document.getElementById("parte1").classList.remove("hidden");
    }
    </script>

    <script>
    
    </script>
</body>
</html>