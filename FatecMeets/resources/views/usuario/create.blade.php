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
        <button type="button" id="reenviarBtn" style="margin-top:10px;">Enviar Código</button>
    </div>

    <a href="/inicio/"><button type="button">Voltar</button></a>
</div>
<script src="/js/controllers/createUsuarioController.js"></script>
<script src="/js/confirmarSenha.js"></script>
</body>
</html>