<?php
require '../../config/db.php';
session_start();

if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
}

$conn = Database::conectar();
$stmt = $conn->query("SELECT * FROM planos ORDER BY nome");
$planos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Planos - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 1rem;
        }
        .btn-custom {
            min-width: 100px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-dumbbell"></i> Planos da Academia</h4>
            <div>
                <a href="create.php" class="btn btn-light btn-sm mr-2"><i class="fas fa-plus-circle"></i> Novo Plano</a>
                <a href="../../dashboard.php" class="btn btn-outline-light btn-sm"><i class="fas fa-arrow-left"></i> Voltar</a>
            </div>
        </div>
        <div class="card-body">
            <?php if (count($planos) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nome</th>
                            <th>Valor (R$)</th>
                            <th>Duração (dias)</th>
                            <th style="width: 140px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($planos as $plano): ?>
                        <tr>
                            <td><?= htmlspecialchars($plano['nome']) ?></td>
                            <td><?= number_format($plano['valor'], 2, ',', '.') ?></td>
                            <td><?= (int)$plano['duracao_dias'] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $plano['id'] ?>">
                                     <img src="icones/editar.gif" alt="editar" style="width: 30px; height: 30px;">
                                </a>
                                <a href="delete.php?id=<?= $plano['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este plano?')">
                                     <img src="icones/lixeira.gif" alt="excluir" style="width: 30px; height: 30px;">
                                </a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
                <div class="alert alert-info">Nenhum plano cadastrado no momento.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
