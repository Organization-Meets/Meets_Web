@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalhes do Evento</h2>

    <div id="mensagem" class="alert d-none"></div>

    <div id="eventoContainer" class="card shadow-sm">
        <div class="card-body">
            <p>Carregando evento...</p>
        </div>
    </div>
</div>

<script src="/js/controllers/showEventoController.js"></script>
@endsection
