<?php
require '../../config/db.php';
session_start();
$conn = Database::conectar();
$alunos = $conn->query("SELECT id, nome FROM alunos ORDER BY nome")->fetchAll();
$planos = $conn->query("SELECT id, nome, duracao_dias FROM planos ORDER BY nome")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data_inicio = $_POST['data_inicio'];
    $plano_id = $_POST['plano_id'];

    $duracao = $conn->prepare("SELECT duracao_dias FROM planos WHERE id = ?");
    $duracao->execute([$plano_id]);
    $dias = $duracao->fetchColumn();

    $data_fim = date('Y-m-d', strtotime("+$dias days", strtotime($data_inicio)));

    $stmt = $conn->prepare("INSERT INTO matriculas (aluno_id, plano_id, data_inicio, data_fim, ativo) VALUES (?, ?, ?, ?, 1)");
    $stmt->execute([
        $_POST['aluno_id'],
        $plano_id,
        $data_inicio,
        $data_fim
    ]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nova Matrícula</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Nova Matrícula</h2>
    <form method="POST">
        <div class="form-group">
            <label>Aluno:</label>
            <select name="aluno_id" class="form-control" required>
                <option value="">Selecione</option>
                <?php foreach ($alunos as $aluno): ?>
                    <option value="<?= $aluno['id'] ?>"><?= htmlspecialchars($aluno['nome']) ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label>Plano:</label>
            <select name="plano_id" class="form-control" required>
                <option value="">Selecione</option>
                <?php foreach ($planos as $plano): ?>
                    <option value="<?= $plano['id'] ?>"><?= htmlspecialchars($plano['nome']) ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label>Data de Início:</label>
            <input type="date" name="data_inicio" class="form-control" required>
        </div>
        <button class="btn btn-success">Cadastrar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>