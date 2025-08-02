<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Eventos - Fatec Meets</title>
    <link rel="stylesheet" href="css/estilo-busca.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
</head>
<body>

<!-- Navbar -->
<?php include '../components/navbar.php'; ?>

<div class="container">
    <h1>Buscar Eventos</h1>
    <form action="Exibir_pesquisa.php" method="GET" class="search-form">
        <div class="form-group">
            <label for="tipo">Tipo de Evento:</label>
            <select name="tipo" id="tipo">
                <option value="%" selected>Todos</option>
                <option value="estudos">Estudos</option>
                <option value="leitura">Leitura</option>
                <option value="esporte">Esportes</option>
                <option value="música">Música</option>
            </select>
        </div>

        <div class="form-group">
            <label for="local">Local:</label>
            <input type="text" name="local" id="local" placeholder="Digite algo...">
        </div>

        <div class="form-group">
            <label for="pesquisa">Pesquisar:</label>
            <input type="text" name="pesquisa" id="pesquisa" placeholder="Digite algo...">
        </div>

        <button type="submit" class="btn">Buscar</button>
    </form>
</div>

</body>
</html>