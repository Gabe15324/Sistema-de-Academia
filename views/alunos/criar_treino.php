<?php
session_start();
require_once '../../config/db.php';

if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
}

$pdo = Database::conectar();
$alunos = $pdo->query("SELECT id, nome FROM usuarios WHERE tipo = 'aluno'")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];

    $stmt = $pdo->prepare("INSERT INTO treinos (usuario_id, nome, descricao, data_inicio, data_fim, criado_por, concluido) VALUES (?, ?, ?, ?, ?, 'admin', 0)");
    $stmt->execute([$usuario_id, $nome, $descricao, $data_inicio, $data_fim]);

    header("Location: treinos.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Treino</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="mt-5">
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">📋 Criar Novo Treino</h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="usuario_id">Aluno</label>
                        <select name="usuario_id" id="usuario_id" class="form-control" required>
                            <option value="">Selecione um aluno</option>
                            <?php foreach ($alunos as $aluno): ?>
                                <option value="<?= $aluno['id'] ?>"><?= $aluno['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome do Treino</label>
                        <input type="text" name="nome" id="nome" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea name="descricao" id="descricao" class="form-control" rows="4" placeholder="Ex: Agachamento 3x10, Flexão 3x12..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="data_inicio">Data Início</label>
                        <input type="date" name="data_inicio" id="data_inicio" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="data_fim">Data Fim</label>
                        <input type="date" name="data_fim" id="data_fim" class="form-control">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="../../dashboard.php" class="btn btn-secondary">← Cancelar</a>
                        <button type="submit" class="btn btn-success">💾 Salvar Treino</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
