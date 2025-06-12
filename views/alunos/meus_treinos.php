<?php
session_start();
require_once '../../config/db.php';

if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'aluno') {
    header("Location: ../../login.php");
    exit;
}


$usuario_id = $_SESSION['usuario_id'];
$pdo = Database::conectar();
$stmt = $pdo->prepare("SELECT * FROM treinos WHERE usuario_id = ? ORDER BY data_inicio DESC");
$stmt->execute([$usuario_id]);
$treinos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meus Treinos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h3 class="text-center text-primary mb-4">📋 Meus Treinos</h3>

    <?php if (count($treinos) === 0): ?>
        <div class="alert alert-warning">Nenhum treino atribuído ainda.</div>
    <?php else: ?>
        <div class="list-group">
            <?php foreach ($treinos as $treino): ?>
                <div class="list-group-item">
                    <h5 class="font-weight-bold"><?= htmlspecialchars($treino['nome']) ?></h5>
                    <p><?= nl2br(htmlspecialchars($treino['descricao'])) ?></p>
                    <p><strong>Início:</strong> <?= date('d/m/Y', strtotime($treino['data_inicio'])) ?></p>
                    <p><strong>Fim:</strong> <?= date('d/m/Y', strtotime($treino['data_fim'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="../../dashboard.php" class="btn btn-outline-secondary">Voltar ao Dashboard</a>
    </div>
</body>
</html>
