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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Plano</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0">Cadastrar Novo Plano</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="nome">Nome do Plano <span class="text-danger">*</span></label>
                            <input type="text" id="nome" name="nome" class="form-control" required placeholder="Ex: Plano Mensal">
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor (R$) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" id="valor" name="valor" class="form-control" required placeholder="Ex: 99.90">
                        </div>
                        <div class="form-group">
                            <label for="duracao_dias">Duração (em dias) <span class="text-danger">*</span></label>
                            <input type="number" id="duracao_dias" name="duracao_dias" class="form-control" required placeholder="Ex: 30">
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea id="descricao" name="descricao" class="form-control" rows="3" placeholder="Ex: Acesso ilimitado a todas as aulas"></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
