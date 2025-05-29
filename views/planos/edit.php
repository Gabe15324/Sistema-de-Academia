<?php
require '../../config/db.php';
session_start();

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM planos WHERE id = ?");
$stmt->execute([$id]);
$plano = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("UPDATE planos SET nome=?, valor=?, duracao_dias=?, descricao=? WHERE id=?");
    $stmt->execute([
        $_POST['nome'],
        $_POST['valor'],
        $_POST['duracao_dias'],
        $_POST['descricao'],
        $id
    ]);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Plano</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Editar Plano</h2>
    <form method="POST">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" value="<?= $plano['nome'] ?>" required>
        </div>
        <div class="form-group">
            <label>Valor (R$):</label>
            <input type="number" step="0.01" name="valor" class="form-control" value="<?= $plano['valor'] ?>" required>
        </div>
        <div class="form-group">
            <label>Duração (dias):</label>
            <input type="number" name="duracao_dias" class="form-control" value="<?= $plano['duracao_dias'] ?>" required>
        </div>
        <div class="form-group">
            <label>Descrição:</label>
            <textarea name="descricao" class="form-control"><?= $plano['descricao'] ?></textarea>
        </div>
        <button class="btn btn-primary">Atualizar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
