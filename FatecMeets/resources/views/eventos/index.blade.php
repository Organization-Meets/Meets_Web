@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Lista de Eventos</h2>

    <div id="mensagem" class="alert d-none"></div>

    <div id="eventosContainer" class="row g-3">
        <!-- Os eventos virão aqui via JS -->
    </div>
</div>

<script src="/js/controllers/indexEventosController.js"></script>
@endsection
