@include('componentes.header')
<link rel="stylesheet" href="/css/estilo-evento.css">

<form id="createEventoForm" enctype="multipart/form-data">
    @csrf
    <!-- Campos do evento -->
    <input type="text" name="nome_evento" placeholder="Título do evento" required>

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
    <h4>Escolha o lugar</h4>
    <div id="lugaresContainer"></div>

    <!-- Logradouros como radio -->
    <h4>Escolha o logradouro</h4>
    <div id="logradourosContainer"></div>

    <button type="submit">Criar Evento</button>
</form>

<p id="responseMessage"></p>

<script>
    const idUsuario = {{ Auth::check() ? Auth::id() : 'null' }};
    console.log("ID Usuario:", idUsuario);
</script>

<script src="/js/controllers/createEventoController.js"></script>