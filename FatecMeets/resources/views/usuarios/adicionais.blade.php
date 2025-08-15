<link rel="stylesheet" href="/css/estilo-cadastro.css">
<div class="container">
    <h2>Tipo de Usuário</h2>

    <form action="/usuarios/adicionais/" method="POST">
        @csrf
        <img src="/imagens/logo.png" alt="Logo" style="width: 100px; margin-bottom: 15px; display: block; margin-left: auto; margin-right: auto;">

        <p style="text-align: center; margin-bottom: 20px;">Tipo de Usuario:</p>
        <select name="tipo_usuario" required>
            <option value="{{ $tipo }}">{{ $tipo }}</option>
        </select>

        @if($tipo == 'aluno')
            <input type="number" name="ra_aluno" placeholder="ra_aluno" required>
            <input type="text" name="nome_aluno" placeholder="Nome do Aluno" required>
        @elseif($tipo == 'professor')
            <input type="number" name="ra_professor" placeholder="ra_professor" required>
            <input type="text" name="nome_professor" placeholder="Nome do Professor" required>
        @endif

        <input type="ddd" name="ddd" placeholder="DDD" required>
        <input type="number" name="numero" placeholder="Número" required>

        <button type="submit">Continuar</button>
    </form>

    <a href="/home/"><button type="button">Voltar</button></a>
</div>
@include('componentes.footer')