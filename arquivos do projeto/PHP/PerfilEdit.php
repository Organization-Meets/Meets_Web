<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../components/navbar.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'view/Login.php');
    exit;
}

$usuario = $_SESSION['usuario'];
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoNome = $_POST['nome'] ?? $usuario['nome'];
    $novoCaminhoFoto = $usuario['foto'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $permitidos = ['image/jpeg', 'image/png', 'image/gif'];
        $tipo = mime_content_type($_FILES['foto']['tmp_name']);

        if (!in_array($tipo, $permitidos)) {
            $mensagem = 'Formato de imagem inválido.';
        } else {
            $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

            // Caminhos e nome da imagem
            $diretorio = __DIR__ . '/../uploads/UserImage';
            if (!is_dir($diretorio)) {
                mkdir($diretorio, 0777, true);
            }

            // Gera um nome único com ID do usuário
            $codigoUnico = bin2hex(random_bytes(5)); // algo como "f3a2c9b7e1"
            $nomeFoto = 'user_' . $usuario['id'] . '_' . $codigoUnico . '.' . $ext;

            $caminhoRelativo = 'uploads/UserImage/' . $nomeFoto;
            $caminhoAbsoluto = $diretorio . '/' . $nomeFoto;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoAbsoluto)) {
                $novoCaminhoFoto = $caminhoRelativo;
            } else {
                $mensagem = 'Erro ao salvar a imagem.';
            }
        }
    }

    // Atualizar banco
    $stmt = $pdo->prepare("UPDATE users SET nome = :nome, profile_image = :foto WHERE user_id = :id");
    $stmt->execute([
        ':nome' => $novoNome,
        ':foto' => $novoCaminhoFoto,
        ':id'   => $usuario['id']
    ]);

    // Atualiza sessão
    $_SESSION['usuario']['nome'] = $novoNome;
    $_SESSION['usuario']['foto'] = $novoCaminhoFoto;

    $mensagem = 'Perfil atualizado com sucesso!';
}
?>
<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../components/navbar.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'view/Login.php');
    exit;
}

$usuario = $_SESSION['usuario'];
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoNome = $_POST['nome'] ?? $usuario['nome'];
    $novoCaminhoFoto = $usuario['foto'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $permitidos = ['image/jpeg', 'image/png', 'image/gif'];
        $tipo = mime_content_type($_FILES['foto']['tmp_name']);

        if (!in_array($tipo, $permitidos)) {
            $mensagem = 'Formato de imagem inválido.';
        } else {
            $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

            // Caminhos e nome da imagem
            $diretorio = __DIR__ . '/../uploads/UserImage';
            if (!is_dir($diretorio)) {
                mkdir($diretorio, 0777, true);
            }

            // Gera um nome único com ID do usuário
            $codigoUnico = bin2hex(random_bytes(5)); // algo como "f3a2c9b7e1"
            $nomeFoto = 'user_' . $usuario['id'] . '_' . $codigoUnico . '.' . $ext;

            $caminhoRelativo = 'uploads/UserImage/' . $nomeFoto;
            $caminhoAbsoluto = $diretorio . '/' . $nomeFoto;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoAbsoluto)) {
                $novoCaminhoFoto = $caminhoRelativo;
            } else {
                $mensagem = 'Erro ao salvar a imagem.';
            }
        }
    }

    // Atualizar banco
    $stmt = $pdo->prepare("UPDATE users SET nome = :nome, profile_image = :foto WHERE user_id = :id");
    $stmt->execute([
        ':nome' => $novoNome,
        ':foto' => $novoCaminhoFoto,
        ':id'   => $usuario['id']
    ]);

    // Atualiza sessão
    $_SESSION['usuario']['nome'] = $novoNome;
    $_SESSION['usuario']['foto'] = $novoCaminhoFoto;

    $mensagem = 'Perfil atualizado com sucesso!';
}
?>
<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../components/navbar.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'view/Login.php');
    exit;
}

$usuario = $_SESSION['usuario'];
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoNome = $_POST['nome'] ?? $usuario['nome'];
    $novoCaminhoFoto = $usuario['foto'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $permitidos = ['image/jpeg', 'image/png', 'image/gif'];
        $tipo = mime_content_type($_FILES['foto']['tmp_name']);

        if (!in_array($tipo, $permitidos)) {
            $mensagem = 'Formato de imagem inválido.';
        } else {
            $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

            // Caminhos e nome da imagem
            $diretorio = __DIR__ . '/../uploads/UserImage';
            if (!is_dir($diretorio)) {
                mkdir($diretorio, 0777, true);
            }

            // Gera um nome único com ID do usuário
            $codigoUnico = bin2hex(random_bytes(5)); // algo como "f3a2c9b7e1"
            $nomeFoto = 'user_' . $usuario['id'] . '_' . $codigoUnico . '.' . $ext;

            $caminhoRelativo = 'uploads/UserImage/' . $nomeFoto;
            $caminhoAbsoluto = $diretorio . '/' . $nomeFoto;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoAbsoluto)) {
                $novoCaminhoFoto = $caminhoRelativo;
            } else {
                $mensagem = 'Erro ao salvar a imagem.';
            }
        }
    }

    // Atualizar banco
    $stmt = $pdo->prepare("UPDATE users SET nome = :nome, profile_image = :foto WHERE user_id = :id");
    $stmt->execute([
        ':nome' => $novoNome,
        ':foto' => $novoCaminhoFoto,
        ':id'   => $usuario['id']
    ]);

    // Atualiza sessão
    $_SESSION['usuario']['nome'] = $novoNome;
    $_SESSION['usuario']['foto'] = $novoCaminhoFoto;

    $mensagem = 'Perfil atualizado com sucesso!';
}
?>
