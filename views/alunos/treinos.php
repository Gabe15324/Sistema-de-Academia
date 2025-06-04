<?php
session_start();
require_once '../../config/db.php';

if ($_SESSION['usuario_tipo'] !== 'aluno') {
    header("Location: ../../dashboard.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

try {
    $pdo = Database::conectar();
    $stmt = $pdo->prepare("SELECT nome_treino, descricao, data_criacao FROM treinos WHERE aluno_id = ? ORDER BY data_criacao DESC");
    $stmt->execute([$usuario_id]);
    $treinos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meus Treinos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h3>Meus Treinos</h3>

    <?php if ($treinos): ?>
        <ul class="list-group">
            <?php foreach ($treinos as $treino): ?>
                <li class="list-group-item">
                    <h5><?= htmlspecialchars($treino['nome_treino']) ?></h5>
                    <p><?= nl2br(htmlspecialchars($treino['descricao'])) ?></p>
                    <small class="text-muted">Criado em: <?= date('d/m/Y', strtotime($treino['data_criacao'])) ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div class="alert alert-info">Nenhum treino cadastrado.</div>
    <?php endif; ?>

    <a href="../../dashboard.php" class="btn btn-secondary mt-4">Voltar</a>
</div>
</body>
</html>
