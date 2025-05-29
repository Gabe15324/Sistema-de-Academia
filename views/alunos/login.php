<?php
session_start();
require '../../config/db.php';
$conn = Database::conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha']; // Supondo que a senha exista na tabela alunos e esteja armazenada

    $stmt = $conn->prepare("SELECT * FROM alunos WHERE cpf = ?");
    $stmt->execute([$cpf]);
    $aluno = $stmt->fetch();

    if ($aluno && password_verify($senha, $aluno['senha'])) { // supondo senha hash
        $_SESSION['aluno_id'] = $aluno['id'];
        header('Location: painel.php');
        exit;
    } else {
        $error = "CPF ou senha inválidos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login do Aluno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Login do Aluno</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label>CPF:</label>
            <input type="text" name="cpf" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        <button class="btn btn-primary">Entrar</button>
    </form>
</div>
</body>
</html>
