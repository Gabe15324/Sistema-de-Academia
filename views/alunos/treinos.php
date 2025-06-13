<?php
session_start();
require_once '../../config/db.php';

if ($_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
}

$pdo = Database::conectar();
$treinos = $pdo->query("SELECT t.*, u.nome AS aluno_nome FROM treinos t JOIN usuarios u ON t.usuario_id = u.id ORDER BY t.data_inicio DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Treinos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-primary mb-0">📋 Lista de Treinos</h4>
        <a href="criar_treino.php" class="btn btn-success">➕ Criar Novo Treino</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>👤 Aluno</th>
                        <th>🏋️‍♀️ Treino</th>
                        <th>📅 Início</th>
                        <th style="width: 160px;">⚙️ Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($treinos) > 0): ?>
                        <?php foreach ($treinos as $treino): ?>
                            <tr>
                                <td><?= htmlspecialchars($treino['aluno_nome']) ?></td>
                                <td><?= htmlspecialchars($treino['nome']) ?></td>
                                <td><?= date('d/m/Y', strtotime($treino['data_inicio'])) ?></td>
                                <td>
                                    <a href="editar_treinos.php?id=<?= $treino['id'] ?>" class="btn btn-sm btn-outline-warning">✏️ Editar</a>
                                    <a href="excluir_treinos.php?id=<?= $treino['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir este treino?')">🗑️ Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Nenhum treino cadastrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
