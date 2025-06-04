<?php
session_start();
require_once '../../config/db.php';

if ($_SESSION['usuario_tipo'] !== 'aluno') {
    header("Location: ../../dashboard.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

try {
    $pdo = Database::conectar();

    // Busca os dados do aluno (opcional, pois estão na sessão)
    $stmtAluno = $pdo->prepare("SELECT nome, email FROM alunos WHERE id = ?");
    $stmtAluno->execute([$usuario_id]);
    $aluno = $stmtAluno->fetch(PDO::FETCH_ASSOC);

    // Busca a matrícula ativa mais recente
    $stmtMatricula = $pdo->prepare("
        SELECT 
            m.data_matricula, 
            m.data_inicio, 
            m.data_fim, 
            p.nome AS plano_nome, 
            p.valor, 
            p.duracao_dias
        FROM matriculas m
        JOIN planos p ON m.plano_id = p.id
        WHERE m.aluno_id = ?
          AND m.ativo = 1
          AND CURDATE() BETWEEN m.data_inicio AND m.data_fim
        ORDER BY m.data_matricula DESC
        LIMIT 1
    ");
    $stmtMatricula->execute([$usuario_id]);
    $matricula = $stmtMatricula->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Perfil - Aluno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h3>Meu Perfil</h3>
    <p><strong>Nome:</strong> <?= htmlspecialchars($aluno['nome'] ?? $_SESSION['usuario_nome']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($aluno['email'] ?? $_SESSION['usuario_email'] ?? '---') ?></p>

    <?php if ($matricula): 
        $dataMatricula = new DateTime($matricula['data_matricula']);
        $dataVencimento = (clone $dataMatricula)->modify("+{$matricula['duracao_dias']} days");
    ?>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Plano Ativo</h5>
                <p><strong>Plano:</strong> <?= htmlspecialchars($matricula['plano_nome']) ?></p>
                <p><strong>Valor:</strong> R$ <?= number_format($matricula['valor'], 2, ',', '.') ?></p>
                <p><strong>Data de Matrícula:</strong> <?= $dataMatricula->format('d/m/Y') ?></p>
                <p><strong>Vencimento:</strong> <?= $dataVencimento->format('d/m/Y') ?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning mt-3">Você ainda não possui matrícula ativa.</div>
    <?php endif; ?>

    <a href="../../dashboard.php" class="btn btn-secondary mt-4">Voltar</a>
</div>
</body>
</html>
