@extends('componentes.header')
<div class="container">
    <h2>Tipo de Usuário</h2>

    <form action="/usuario/tipo/" method="POST">
        @csrf
        <img src="/imagens/logo.png" alt="Logo" style="width: 100px; margin-bottom: 15px; display: block; margin-left: auto; margin-right: auto;">

        <p style="text-align: center; margin-bottom: 20px;">Selecione o tipo de usuário que deseja cadastrar:</p>
        <select name="tipo_usuario" required>
            <option value="">Selecione</option>
            <option value="aluno">Aluno</option>
            <option value="professor">Professor</option>
            <option value="admin">Administrador</option>
        </select>
        <button type="submit">Continuar</button>
    </form>

    <a href="/home/"><button type="button">Voltar</button></a>
</div>
@include('componentes.footer')