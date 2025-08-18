<link rel="stylesheet" href="/css/estilo-cadastro.css">
<div class="container">
    <h2>Tipo de Usuário</h2>

    <form action="/usuarios/tipo/" method="POST">
        @csrf
        <img src="/imagens/logo.png" alt="Logo" style="width: 100px; margin-bottom: 15px; display: block; margin-left: auto; margin-right: auto;">

        
        <button type="submit">Continuar</button>
    </form>

    <a href="/home/"><button type="button">Voltar</button></a>
</div>
@include('componentes.footer')