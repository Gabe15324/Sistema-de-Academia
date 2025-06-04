<?php
require '../../config/db.php';
session_start();
$conn = Database::conectar();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO planos (nome, valor, duracao_dias, descricao) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['nome'],
        $_POST['valor'],
        $_POST['duracao_dias'],
        $_POST['descricao']
    ]);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Novo Plano</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Cadastrar Plano</h2>
    <form method="POST">
        <div class="form-group">
            <label>Nome do Plano:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Valor (R$):</label>
            <input type="number" step="0.01" name="valor" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Duração (em dias):</label>
            <input type="number" name="duracao_dias" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Descrição:</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>