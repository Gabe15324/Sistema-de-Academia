<?php
require '../../config/db.php';
session_start();

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch();

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];

    $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, email = ?, tipo = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $tipo, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Editar Usuário</h2>
    <form method="POST">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" value="<?= $usuario['nome'] ?>" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="<?= $usuario['email'] ?>" required>
        </div>
        <div class="form-group">
            <label>Tipo:</label>
            <select name="tipo" class="form-control">
                <option value="admin" <?= $usuario['tipo'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
                <option value="funcionario" <?= $usuario['tipo'] == 'funcionario' ? 'selected' : '' ?>>Funcionário</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
