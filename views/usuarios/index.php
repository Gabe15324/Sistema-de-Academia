<?php
session_start();
if ($_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../dashboard.php");
    exit;
}

require '../../config/db.php';
$conn = Database::conectar();

$stmt = $conn->query("SELECT * FROM usuarios ORDER BY nome");
$usuarios = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Gerenciar Usuários</h2>
    <a href="create.php" class="btn btn-primary mb-3">Novo Usuário</a>
    <a href="../../dashboard.php" class="btn btn-secondary mb-3 float-right">Voltar</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['nome']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= $user['tipo'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="delete.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
