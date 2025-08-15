@extends('componentes.header')
    <link rel="stylesheet" href="/css/estilo-evento.css">
    <div class="meet-container post-content">
        <h1 class="meet-title">Criar Novo Evento</h1>
        @if(session('success'))
            <p class="mensagem-sucesso">{{ session('success') }}</p>
        @endif

        <form action="/eventos/" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nome_evento">Título do evento:</label>
                <input type="text" id="nome_evento" name="nome_evento" placeholder="Título do evento" required>
            </div>

            <div class="form-group">
                <label for="local_evento">Local do evento:</label>
                <input type="text" id="local_evento" name="local_evento" placeholder="Local do evento">
                <span class="hint">Ex: Biblioteca, sala maker, quadra ou na grama</span>
            </div>

            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Selecione uma categoria</option>
                    <option value="leitura">Leitura</option>
                    <option value="esporte">Esporte</option>
                    <option value="estudos">Estudos</option>
                    <option value="musica">Música</option>
                </select>
            </div>

            <div class="form-group">
                <label for="data_inicio_evento">Data e Hora do Evento:</label>
                <input type="datetime-local" id="data_inicio_evento" name="data_inicio_evento" required>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" placeholder="Aqui é um espaço livre para falar mais sobre seu evento!" required></textarea>
            </div>

            <div class="form-group">
                <label for="imagem_evento">Selecionar Imagem:</label>
                <input type="file" id="imagem_evento" name="imagem_evento" accept="image/*">
            </div>

            <button type="submit" class="submit-btn">Criar Evento</button>
        </form>
    </div>
@include('componentes.footer')