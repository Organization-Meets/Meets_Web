@extends('componentes.header')
<link rel="stylesheet" href="/css/estilo-editar-perfil.css">

<section class="edit-profile-container">
    <h1>Editar Perfil</h1>

    {{-- Exibe mensagem de sucesso, se houver --}}
    @if(session('success'))
        <p class="mensagem-sucesso">{{ session('success') }}</p>
    @endif

    {{-- Formulário para editar perfil do usuário --}}
    <form action="/usuarios/{{ $usuario->id_usuario }}/" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nome">Nome completo:</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $usuario->nome ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="imagem_usuario">Foto de perfil:</label><br>
            <input type="file" name="imagem_usuario" id="imagem_usuario" accept="image/*">
            <div class="foto-atual">
                <p>Foto atual:</p>
                <img src="{{ asset($usuario->imagem_usuario ?? 'uploads/imgPadrao.png') }}" alt="Foto atual" width="100">
            </div>
        </div>

        <button type="submit" class="btn-salvar">Salvar Alterações</button>
    </form>
</section>