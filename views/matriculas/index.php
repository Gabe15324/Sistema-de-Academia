<?php
require '../../config/db.php';
session_start();

$sql = "SELECT m.*, a.nome AS aluno, p.nome AS plano 
        FROM matriculas m
        JOIN alunos a ON a.id = m.aluno_id
        JOIN planos p ON p.id = m.plano_id
        ORDER BY m.data_inicio DESC";

$stmt = $conn->query($sql);
$matriculas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Matrículas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Matrículas</h2>
    <a href="create.php" class="btn btn-success mb-3">Nova Matrícula</a>
    <a href="../dashboard.php" class="btn btn-secondary mb-3 float-right">Voltar</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Plano</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($matriculas as $mat): ?>
            <tr>
                <td><?= htmlspecialchars($mat['aluno']) ?></td>
                <td><?= htmlspecialchars($mat['plano']) ?></td>
                <td><?= date('d/m/Y', strtotime($mat['data_inicio'])) ?></td>
                <td><?= date('d/m/Y', strtotime($mat['data_fim'])) ?></td>
                <td>
                    <?php if ($mat['ativo']): ?>
                        <span class="badge badge-success">Ativa</span>
                    <?php else: ?>
                        <span class="badge badge-danger">Inativa</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="edit.php?id=<?= $mat['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="delete.php?id=<?= $mat['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja excluir?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>
</body>
</html>
