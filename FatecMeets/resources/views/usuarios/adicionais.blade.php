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
            <input id="nome" type="text" name="nome_aluno" placeholder="Primeiro e último nome" readonly>
        @elseif($tipo == 'professor')
            <input type="number" name="ra_academicos" placeholder="ra_academicos" required>
            <input id="nome" type="text" name="nome_academicos" placeholder="Primeiro e último nome" readonly>
        @endif

        <input type="text" name="nickname" placeholder="Nome de usuário" readonly>

        <button type="submit">Continuar</button>
    </form>

    <a href="/home/"><button type="button">Voltar</button></a>
</div>
<script>
    var nomeBackend = "{{ $nome }}";
    var nicknameBackend = "{{ $nickname }}";
</script>
<script src="/js/autocompletarNome.js"></script>
<script src="/js/autocompletarNickname.js"></script>