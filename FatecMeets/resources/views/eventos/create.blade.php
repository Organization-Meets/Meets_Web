@extends('componentes.header')
<link rel="stylesheet" href="/css/estilo-evento.css">

<div class="meet-container post-content">
    <h1 class="meet-title">Criar Novo Evento</h1>

    <form id="createEventoForm" enctype="multipart/form-data">
        @csrf

        <!-- Título do evento -->
        <div class="form-group">
            <label for="nome_evento">Título do evento:</label>
            <input type="text" id="nome_evento" name="nome_evento" placeholder="Título do evento" required>
        </div>

        <!-- Local do evento -->
        <div class="form-group">
            <label for="local_evento">Local do evento:</label>
            <input type="text" id="local_evento" name="local_evento" placeholder="Local do evento">
            <span class="hint">Ex: Biblioteca, sala maker, quadra ou na grama</span>
        </div>

        <!-- Categoria -->
        <div class="form-group">
            <label for="categoria_evento">Categoria:</label>
            <select id="categoria_evento" name="categoria_evento">
                <option value="">Selecione uma categoria</option>
                <option value="leitura">Leitura</option>
                <option value="esporte">Esporte</option>
                <option value="estudos">Estudos</option>
                <option value="musica">Música</option>
            </select>
        </div>

        <!-- Data e hora de início -->
        <div class="form-group">
            <label for="data_inicio_evento">Data e Hora do Início:</label>
            <input type="datetime-local" id="data_inicio_evento" name="data_inicio_evento" required>
        </div>

        <!-- Data e hora de término -->
        <div class="form-group">
            <label for="data_final_evento">Data e Hora do Término:</label>
            <input type="datetime-local" id="data_final_evento" name="data_final_evento">
        </div>

        <!-- Descrição -->
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" placeholder="Aqui é um espaço livre para falar mais sobre seu evento!"></textarea>
        </div>

        <!-- Upload de imagens -->
        <div class="form-group">
            <label for="imagem_evento">Selecionar Imagens:</label>
            <input type="file" id="imagem_evento" name="imagem_evento[]" accept="image/*" multiple>
            <span class="hint">Você pode selecionar mais de uma imagem</span>
        </div>

        <!-- IDs relacionados (opcional) -->
        <div class="form-group">
            <label for="id_atividade">Atividade (opcional):</label>
            <input type="number" id="id_atividade" name="id_atividade" placeholder="ID da atividade">
        </div>

        <div class="form-group">
            <label for="id_lugares">Lugar (opcional):</label>
            <input type="number" id="id_lugares" name="id_lugares" placeholder="ID do lugar">
        </div>

        <div class="form-group">
            <label for="id_logradouro">Logradouro (opcional):</label>
            <input type="number" id="id_logradouro" name="id_logradouro" placeholder="ID do logradouro">
        </div>

        <button type="submit" class="submit-btn">Criar Evento</button>
    </form>

    <p id="responseMessage" style="text-align:center; margin-top:1rem;"></p>
</div>

@include('componentes.footer')