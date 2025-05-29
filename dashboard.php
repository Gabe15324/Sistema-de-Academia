<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$nome = $_SESSION['usuario_nome'];
$tipo = $_SESSION['usuario_tipo'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h3>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</h3>
    <p>Tipo de acesso: <strong><?php echo $tipo; ?></strong></p>

    <?php if ($tipo === 'admin'): ?>
        <a href="views/usuarios/index.php" class="btn btn-secondary">Gerenciar Usuários</a>
        <a href="views/alunos/index.php" class="btn btn-secondary">Gerenciar Alunos</a>
        <a href="views/planos/index.php" class="btn btn-secondary">Gerenciar Planos</a>
    <?php endif; ?>

    <a href="logout.php" class="btn btn-danger float-right">Sair</a>
</div>
</body>
</html>
