<?php
require '../../config/db.php';
session_start();

$stmt = $conn->query("SELECT * FROM planos ORDER BY nome");
$planos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Planos - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Planos da Academia</h2>
    <a href="create.php" class="btn btn-success mb-3">Novo Plano</a>
    <a href="../dashboard.php" class="btn btn-secondary mb-3 float-right">Voltar</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Valor (R$)</th>
                <th>Duração (dias)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($planos as $plano): ?>
            <tr>
                <td><?= htmlspecialchars($plano['nome']) ?></td>
                <td><?= number_format($plano['valor'], 2, ',', '.') ?></td>
                <td><?= $plano['duracao_dias'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $plano['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="delete.php?id=<?= $plano['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>
</body>
</html>
