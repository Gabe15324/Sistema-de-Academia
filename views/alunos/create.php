<?php
require '../../config/db.php';
include '../../includes/header.php';

session_start();
$conn = Database::conectar();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO alunos (nome, cpf, data_nascimento, telefone, endereco) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['nome'],
        $_POST['cpf'],
        $_POST['data_nascimento'],
        $_POST['telefone'],
        $_POST['endereco']
    ]);
    header("Location: index.php");
    exit;
}
?>
<html>
<head>
    <title>Novo Aluno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h2>Cadastrar Novo Aluno</h2>
            <form method="POST">
                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" class="form-control" placeholder="Nome" required>
                </div>
                <div class="form-group">
                    <label>CPF:</label>
                    <input type="text" name="cpf" class="form-control" placeholder="CPF" required>
                </div>
                <div class="form-group">
                    <label>Data de Nascimento:</label>
                    <input type="date" name="data_nascimento" class="form-control" placeholder="Data de Nascimento" required>
                </div>
                <div class="form-group">
                    <label>Telefone:</label>
                    <input type="text" name="telefone" class="form-control" placeholder="Telefone">
                </div>
                <div class="form-group">
                    <label>Endereço:</label>
                    <textarea name="endereco" class="form-control" placeholder="Endereço"></textarea>
                </div>
                <button class="btn btn-success">Salvar</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
