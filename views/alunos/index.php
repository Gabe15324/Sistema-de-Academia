<?php
session_start();

if (!isset($_SESSION['usuario_tipo'])) {
    header("Location: ../../login.php");
    exit;
}


if ($_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../../dashboard.php");
    exit;
}

require '../../config/db.php';
$conn = Database::conectar();
$stmt = $conn->query("SELECT * FROM usuarios ORDER BY nome");
$alunos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alunos - Academia</title>
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
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-users"></i> Lista de Alunos</h4>
            <div>
                <a href="create.php" class="btn btn-light btn-sm mr-2"><i class="fas fa-user-plus"></i> Novo Aluno</a>
                <a href="../../dashboard.php" class="btn btn-outline-light btn-sm"><i class="fas fa-arrow-left"></i> Voltar</a>
            </div>
        </div>
        <div class="card-body">
            <?php if (count($alunos) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Data de Nascimento</th>
                            <th>Telefone</th>
                            <th>Endereço</th>
                            <th style="width: 140px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alunos as $aluno): ?>
                        <tr>
                            <td><?= $aluno['nome'] ?></td>
                            <td><?= $aluno['cpf'] ?></td>
                            <td><?= date('d/m/Y', strtotime($aluno['data_nascimento'])) ?></td>
                            <td><?= $aluno['telefone'] ?></td>
                            <td><?= $aluno['endereco'] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $aluno['id'] ?>">
                                    <img src="icones/editar.gif" alt="Editar" style="width: 30px; height: 30px;">

                                </a>
                                <a href="delete.php?id=<?= $aluno['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este aluno?')">
                                    <img src="icones/lixeira.gif" alt="excluir" style="width: 30px; height: 30px;">
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
                <div class="alert alert-danger">Nenhum aluno cadastrado ainda.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
