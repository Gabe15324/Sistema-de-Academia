<?php
require '../../config/db.php';
session_start();

$id = $_GET['id'];

$matricula = $conn->prepare("SELECT * FROM matriculas WHERE id = ?");
$matricula->execute([$id]);
$matricula = $matricula->fetch();

$alunos = $conn->query("SELECT id, nome FROM alunos ORDER BY nome")->fetchAll();
$planos = $conn->query("SELECT id, nome FROM planos ORDER BY nome")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data_inicio = $_POST['data_inicio'];
    $plano_id = $_POST['plano_id'];

    $duracao = $conn->prepare("SELECT duracao_dias FROM planos WHERE id = ?");
    $duracao->execute([$plano_id]);
    $dias = $duracao->fetchColumn();

    $data_fim = date('Y-m-d', strtotime("+$dias days", strtotime($data_inicio)));

    $stmt = $conn->prepare("UPDATE matriculas SET aluno_id = ?, plano_id = ?, data_inicio = ?, data_fim = ?, ativo = ? WHERE id = ?");
    $stmt->execute([
        $_POST['aluno_id'],
        $plano_id,
        $data_inicio,
        $data_fim,
        $_POST['ativo'],
        $id
    ]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Matrícula</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Editar Matrícula</h2>
    <form method="POST">
        <div class="form-group">
            <label>Aluno:</label>
            <select name="aluno_id" class="form-control" required>
                <?php foreach ($alunos as $aluno): ?>
                    <option value="<?= $aluno['id'] ?>" <?= $aluno['id'] == $matricula['aluno_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($aluno['nome']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label>Plano:</label>
            <select name="plano_id" class="form-control" required>
                <?php foreach ($planos as $plano): ?>
                    <option value="<?= $plano['id'] ?>" <?= $plano['id'] == $matricula['plano_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($plano['nome']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label>Data de Início:</label>
            <input type="date" name="data_inicio" class="form-control" value="<?= $matricula['data_inicio'] ?>" required>
        </div>
        <div class="form-group">
            <label>Status:</label>
            <select name="ativo" class="form-control">
                <option value="1" <?= $matricula['ativo'] ? 'selected' : '' ?>>Ativa</option>
                <option value="0" <?= !$matricula['ativo'] ? 'selected' : '' ?>>Inativa</option>
            </select>
        </div>
        <button class="btn btn-primary">Atualizar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
