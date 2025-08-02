<?php
    require __DIR__ . '/../config.php';

/* recebe os dados da tela de pesquisa */
$ptipo = $_GET['tipo'];
$plocal = $_GET['local'];
// $pdata_inicial = $_GET['data_inicial'];
// $pdata_final = $_GET['data_final'];
// $phora = $_GET['hora'];
// $psemestre = $_GET['semestre'];
$ptitulo = $_GET['pesquisa'];

// consulta no banco
$stmt = $pdo->query("SELECT e.*, u.nome, u.foto FROM eventos e
                     JOIN users u ON e.usuario_id = u.user_id 
                     WHERE e.titulo LIKE '%$ptitulo%' AND
                     e.categoria like '%$ptipo%' AND
                     e.local LIKE '%$plocal%'
                     ORDER BY e.data_criacao DESC");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>