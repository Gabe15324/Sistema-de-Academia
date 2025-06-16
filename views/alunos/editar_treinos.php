<?php
session_start();
require_once '../../config/db.php';

if ($_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
}

$pdo = Database::conectar();

if (!isset($_GET['id'])) {
    die("ID do treino não fornecido.");
}

$treino_id = $_GET['id'];


$stmt = $pdo->prepare("SELECT * FROM treinos WHERE id = ?");
$stmt->execute([$treino_id]);
$treino = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$treino) {
    die("Treino não encontrado.");
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $data_inicio = $_POST['data_inicio'];

    $update = $pdo->prepare("UPDATE treinos SET nome = ?, descricao = ?, data_inicio = ? WHERE id = ?");
    $update->execute([$nome, $descricao, $data_inicio, $treino_id]);

    header("Location: treinos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Treino</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h3>Editar Treino</h3>
    <form method="POST">
        <div class="form-group">
            <label for="nome">Nome do Treino</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($treino['nome']) ?>" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3"><?= htmlspecialchars($treino['descricao']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="data_inicio">Data de Início</label>
            <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?= $treino['data_inicio'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="treinos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
