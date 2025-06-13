<?php
session_start();
require_once '../../config/db.php';

if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'aluno') {
    header("Location: ../../login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$pdo = Database::conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['marcar_lido'])) {
    $treino_id = $_POST['treino_id'];
    $stmt = $pdo->prepare("UPDATE treinos SET concluido = 1 WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$treino_id, $usuario_id]);
    header("Location: meus_treinos.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM treinos WHERE usuario_id = ? ORDER BY data_inicio DESC");
$stmt->execute([$usuario_id]);
$treinos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = count($treinos);
$lidos = count(array_filter($treinos, fn($t) => $t['concluido']));
$percentual = $total > 0 ? round(($lidos / $total) * 100) : 0;
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

    <div class="progress mb-4">
      <div class="progress-bar" role="progressbar" style="width: <?= $percentual ?>%;" aria-valuenow="<?= $percentual ?>" aria-valuemin="0" aria-valuemax="100">
        <?= $percentual ?>% completos
      </div>
    </div>

    <?php if ($total === 0): ?>
        <div class="alert alert-warning">Nenhum treino atribuído ainda.</div>
    <?php else: ?>
        <?php foreach ($treinos as $treino): ?>
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title text-primary"><?= htmlspecialchars($treino['nome']) ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($treino['descricao'])) ?></p>
                    <p class="card-text"><small class="text-muted">De <?= date('d/m/Y', strtotime($treino['data_inicio'])) ?> até <?= date('d/m/Y', strtotime($treino['data_fim'])) ?></small></p>

                    <?php if (!$treino['concluido']): ?>
                        <form method="post" class="d-inline">
                            <input type="hidden" name="treino_id" value="<?= $treino['id'] ?>">
                            <button type="submit" name="marcar_lido" class="btn btn-outline-primary btn-sm">Marcar como lido</button>
                        </form>
                    <?php else: ?>
                        <span class="badge badge-success">✔️ Lido</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="../../dashboard.php" class="btn btn-outline-secondary">Voltar ao Dashboard</a>
    </div>
</body>
</html>