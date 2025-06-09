<?php
session_start();
require_once '../../config/db.php';

// Verifica se o usuário é admin
if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
}

$pdo = Database::conectar();

// Pega todos os alunos
$alunos = $pdo->query("SELECT id, nome FROM usuarios WHERE tipo = 'aluno'")->fetchAll(PDO::FETCH_ASSOC);

// Processa o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];

    $stmt = $pdo->prepare("INSERT INTO treinos (usuario_id, nome, descricao, data_inicio, data_fim) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$usuario_id, $nome, $descricao, $data_inicio, $data_fim]);

    header("Location: listar_treinos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Treino</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h3>Criar Novo Treino</h3>
    <form method="post">
        <div class="form-group">
            <label>Aluno</label>
            <select name="usuario_id" class="form-control" required>
                <?php foreach ($alunos as $aluno): ?>
                    <option value="<?= $aluno['id'] ?>"><?= $aluno['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Nome do Treino</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control" rows="4"></textarea>
        </div>
        <div class="form-group">
            <label>Data Início</label>
            <input type="date" name="data_inicio" class="form-control">
        </div>
        <div class="form-group">
            <label>Data Fim</label>
            <input type="date" name="data_fim" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="../../dashboard.php" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>
