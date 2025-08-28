@extends('componentes.header')
<link rel="stylesheet" href="/css/estilo-editar-perfil.css">
<link rel="stylesheet" href="/css/estilo-perfil.css">

<section class="edit-profile-container">
    <h1>Editar Perfil</h1>
    <div id="mensagem-usuario"></div>

    <!-- Etapa 1: Solicitar senha (visível ao abrir) -->
    <div id="etapaSenha" class="section">
        <form id="formSenha" autocomplete="off">
            <input type="password" id="senha_confirmacao" placeholder="Digite sua senha para editar" required>
            <button type="submit">Confirmar</button>
        </form>
    </div>

    <!-- Etapa 2: Formulário de edição (inicialmente oculto) -->
    <div id="etapaEdicao" class="section hidden">
        <div class="profile-header">
            <div id="imagem-container" class="profile-img-container"></div>
        </div>
        <form id="form-editar-usuario" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label for="nome">Nome completo:</label>
                <input type="text" name="nome" id="nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="imagem_usuario">Foto de perfil:</label><br>
                <input type="file" name="imagem_usuario" id="imagem_usuario" accept="image/*">
            </div>
            <button type="submit" class="btn-salvar">Salvar Alterações</button>
        </form>
    </div>
</section>
<script src="/js/controllers/editUsuarioController.js"></script>