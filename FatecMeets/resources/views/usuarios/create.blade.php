<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="/css/estilo-cadastro.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro</h2>

        <form action="/usuarios" method="POST" enctype="multipart/form-data" id="cadastroForm">
            @csrf
            <input type="email" name="email" id="email" placeholder="E-mail" required>
            <input type="password" name="senha" id="senha" placeholder="Senha" required>
            <input type="password" name="confirmar_senha" id="confirmar_senha" placeholder="Confirmar Senha" required>
            <input type="file" name="imagem_usuario" id="imagem_usuario" accept="image/*">
            <div id="preview-container" style="text-align:center; margin-bottom:10px;">
                <img id="preview-img" src="#" alt="Prévia da imagem" style="display:none; max-width:120px; max-height:120px; border-radius:50%; margin:0 auto;" />
            </div>
            <p style="text-align: center; margin-bottom: 20px;">Selecione o tipo de usuário que deseja cadastrar:</p>
            <select name="tipo_usuario" required>
                <option value="">Selecione</option>
                <option value="aluno">Aluno</option>
                <option value="professor">Academicos</option>
            </select>
            <hr>
            <button type="submit">Cadastrar</button>
            <hr>
        </form>

        <a href="/home/"><button type="button">Voltar</button></a>
    </div>
    <script src="/js/confirmarSenha.js"></script>
    <script src="/js/emailValido.js"></script>
    <script src="/js/senhaSegura.js"></script>
    <script>
    document.getElementById('imagem_usuario').addEventListener('change', function(e) {
        const [file] = e.target.files;
        const preview = document.getElementById('preview-img');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    });
    </script>
</body>
</html>