@include('componentes.header')
<link rel="stylesheet" href="/css/estilo-cadastro.css">

<div class="container">
    <h2>Editar Evento</h2>

    <form id="editEventoForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="nome_evento">Nome do Evento:</label>
            <input type="text" id="nome_evento" name="nome_evento" value="{{ $evento->nome_evento }}" required>
        </div>

        <div>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao">{{ $evento->descricao }}</textarea>
        </div>

        <div>
            <label for="data_inicio_evento">Data de Início:</label>
            <input type="datetime-local" id="data_inicio_evento" name="data_inicio_evento"
                   value="{{ \Carbon\Carbon::parse($evento->data_inicio_evento)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div>
            <label for="data_final_evento">Data Final:</label>
            <input type="datetime-local" id="data_final_evento" name="data_final_evento"
                   value="{{ $evento->data_final_evento ? \Carbon\Carbon::parse($evento->data_final_evento)->format('Y-m-d\TH:i') : '' }}">
        </div>

        <div>
            <label for="categoria_evento">Categoria:</label>
            <input type="text" id="categoria_evento" name="categoria_evento" value="{{ $evento->categoria_evento }}">
        </div>

        <div>
            <label for="id_lugares">Lugar:</label>
            <input type="number" id="id_lugares" name="id_lugares" value="{{ $evento->id_lugares }}">
        </div>

        <div>
            <label for="id_logradouro">Logradouro:</label>
            <input type="number" id="id_logradouro" name="id_logradouro" value="{{ $evento->id_logradouro }}">
        </div>

        <div>
            <label for="imagem_evento">Imagem:</label>
            <input type="file" id="imagem_evento" name="imagem_evento" accept="image/*">
            @if($evento->imagem_evento)
                <p>Imagem atual:</p>
                <img src="{{ is_string($evento->imagem_evento) && str_starts_with($evento->imagem_evento, '[') 
                        ? '/../storage/' . json_decode($evento->imagem_evento, true)[0] 
                        : '/../storage/' . ltrim($evento->imagem_evento, '/') }}" width="150">
            @endif
        </div>

        <button type="submit">Salvar Alterações</button>
    </form>

    <p id="msg" style="margin-top:15px; color: green;"></p>
</div>

<script src="/js/controllers/editEventoController.js"></script>