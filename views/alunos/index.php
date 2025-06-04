<?php
session_start();
require '../../config/db.php';
$conn = Database::conectar();
$stmt = $conn->query("SELECT * FROM alunos ORDER BY nome");
$alunos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alunos - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Lista de Alunos</h2>
    <a href="create.php" class="btn btn-primary mb-3">Novo Aluno</a>
    <a href="../../dashboard.php" class="btn btn-secondary mb-3 float-right">Voltar</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td><?= htmlspecialchars($aluno['nome']) ?></td>
                    <td><?= $aluno['cpf'] ?></td>
                    <td><?= date('d/m/Y', strtotime($aluno['data_nascimento'])) ?></td>
                    <td><?= $aluno['telefone'] ?></td>
                    <td><?= $aluno['endereco'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $aluno['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="delete.php?id=<?= $aluno['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>