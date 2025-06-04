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
        <a href="views/matriculas/index.php" class="btn btn-secondary">Gerenciar Matrículas</a>

    <?php elseif ($tipo === 'aluno'): ?>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Área do Aluno</h5>
                <p>Aqui você pode consultar seu plano, vencimento da matrícula, e outros dados.</p>
                <a href="views/alunos/perfil.php" class="btn btn-primary">Ver meu Perfil</a>
                <a href="views/alunos/treinos.php" class="btn btn-info">Ver Treinos</a>
            </div>
        </div>
    <?php endif; ?>

    <a href="logout.php" class="btn btn-danger float-right mt-4">Sair</a>
</div>
</body>
</html>
