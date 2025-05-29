<?php
require '../../config/db.php';
session_start();

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM alunos WHERE id = ?");
$stmt->execute([$id]);
$aluno = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("UPDATE alunos SET nome=?, cpf=?, data_nascimento=?, telefone=?, endereco=? WHERE id=?");
    $stmt->execute([
        $_POST['nome'],
        $_POST['cpf'],
        $_POST['data_nascimento'],
        $_POST['telefone'],
        $_POST['endereco'],
        $id
    ]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Editar Aluno</h2>
    <form method="POST">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" value="<?= $aluno['nome'] ?>" required>
        </div>
        <div class="form-group">
            <label>CPF:</label>
            <input type="text" name="cpf" class="form-control" value="<?= $aluno['cpf'] ?>" required>
        </div>
        <div class="form-group">
            <label>Data de Nascimento:</label>
            <input type="date" name="data_nascimento" class="form-control" value="<?= $aluno['data_nascimento'] ?>" required>
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone" class="form-control" value="<?= $aluno['telefone'] ?>">
        </div>
        <div class="form-group">
            <label>Endereço:</label>
            <textarea name="endereco" class="form-control"><?= $aluno['endereco'] ?></textarea>
        </div>
        <button class="btn btn-primary">Atualizar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
