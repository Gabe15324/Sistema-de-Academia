<?php
session_start();
require '../../config/db.php';
$conn = Database::conectar();

if (!isset($_SESSION['aluno_id'])) {
    header('Location: login.php');
    exit;
}

// Pegar dados do aluno
$stmt = $conn->prepare("SELECT * FROM alunos WHERE id = ?");
$stmt->execute([$_SESSION['aluno_id']]);
$aluno = $stmt->fetch();

if (!$aluno) {
    echo "Aluno não encontrado.";
    exit;
}

// Buscar plano do aluno
// Supondo que tenha uma tabela `planos` e tabela `alunos_planos` que vincula aluno ao plano com data de início e fim

$stmt = $conn->prepare("
    SELECT p.nome, p.valor, p.duracao_dias, p.descricao, ap.data_inicio, ap.data_fim
    FROM alunos_planos ap
    JOIN planos p ON ap.plano_id = p.id
    WHERE ap.aluno_id = ?
    ORDER BY ap.data_fim DESC LIMIT 1
");
$stmt->execute([$aluno['id']]);
$plano = $stmt->fetch();

if (!$plano) {
    $mensagem = "Você não possui um plano ativo.";
} else {
    $hoje = new DateTime();
    $dataFim = new DateTime($plano['data_fim']);
    $intervalo = $hoje->diff($dataFim);
    $diasRestantes = ($dataFim < $hoje) ? 0 : $intervalo->days;

    $mensagem = "Plano: {$plano['nome']} <br> Valor: R$ {$plano['valor']} <br> Duração: {$plano['duracao_dias']} dias <br> Descrição: {$plano['descricao']} <br> Dias restantes: $diasRestantes";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Painel do Aluno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Bem-vindo, <?= htmlspecialchars($aluno['nome']) ?></h2>
    <p><?= $mensagem ?></p>
    <a href="logout.php" class="btn btn-danger">Sair</a>
</div>
</body>
</html>