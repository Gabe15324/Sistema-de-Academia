<?php
session_start();
require_once '../../config/db.php';

if ($_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
}

$pdo = Database::conectar();
$treinos = $pdo->query("SELECT t.*, u.nome AS aluno_nome FROM treinos t JOIN usuarios u ON t.usuario_id = u.id")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Treinos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h3>Lista de Treinos</h3>
    <table class="table table-bordered mt-4">
        <thead class="thead-dark">
            <tr>
                <th>Aluno</th>
                <th>Nome do Treino</th>
                <th>Data de Início</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($treinos as $treino): ?>
                <tr>
                    <td><?= $treino['aluno_nome'] ?></td>
                    <td><?= $treino['nome'] ?></td>
                    <td><?= date('d/m/Y', strtotime($treino['data_inicio'])) ?></td>
                    <td>
                        <a href="editar_treinos.php?id=<?= $treino['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="excluir_treinos.php?id=<?= $treino['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este treino?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>


