<link rel="stylesheet" href="/css/estilo-evento.css">
<form id="createEventoForm" enctype="multipart/form-data">
    @csrf
    <!-- Campos do evento -->
    <input type="text" name="nome_evento" placeholder="Título do evento" required>
    <input type="text" name="local_evento" placeholder="Local do evento">
    <select name="categoria_evento">
        <option value="">Selecione uma categoria</option>
        <option value="leitura">Leitura</option>
        <option value="esporte">Esporte</option>
        <option value="estudos">Estudos</option>
        <option value="musica">Música</option>
    </select>
    <input type="datetime-local" name="data_inicio_evento" required>
    <input type="datetime-local" name="data_final_evento">
    <textarea name="descricao" placeholder="Descrição"></textarea>
    <input type="file" name="imagem_evento[]" multiple accept="image/*">

    <!-- Lugares como radio -->
    <div id="lugaresContainer">
        <!-- preenchido dinamicamente pelo JS -->
    </div>

    <!-- Logradouros como radio -->
    <div id="logradourosContainer">
        <!-- preenchido dinamicamente pelo JS -->
    </div>

    <button type="submit">Criar Evento</button>
</form>

<p id="responseMessage"></p>
<script src="/js/controllers/createEventoController.js"></script>