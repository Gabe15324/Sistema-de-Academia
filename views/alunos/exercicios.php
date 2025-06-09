<?php
session_start();
require_once '../../config/db.php';

if (!isset($_GET['treino_id'])) {
    die("Treino não especificado.");
}

$pdo = Database::conectar();
$treino_id = $_GET['treino_id'];

// Inserir novo exercício
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $series = $_POST['series'];
    $repeticoes = $_POST['repeticoes'];

    $stmt = $pdo->prepare("INSERT INTO exercicios (treino_id, nome, series, repeticoes) VALUES (?, ?, ?, ?)");
    $stmt->execute([$treino_id, $nome, $series, $repeticoes]);
}

// Buscar exercícios existentes
$stmt = $pdo->prepare("SELECT * FROM exercicios WHERE treino_id = ?");
$stmt->execute([$treino_id]);
$exercicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exercícios do Treino</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h3>Exercícios do Treino</h3>
    <form method="POST" class="mb-4">
        <div class="form-row">
            <div class="col">
                <input type="text" name="nome" class="form-control" placeholder="Nome do Exercício" required>
            </div>
            <div class="col">
                <input type="number" name="series" class="form-control" placeholder="Séries" required>
            </div>
            <div class="col">
                <input type="number" name="repeticoes" class="form-control" placeholder="Repetições" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Séries</th>
                <th>Repetições</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($exercicios as $ex): ?>
                <tr>
                    <td><?= htmlspecialchars($ex['nome']) ?></td>
                    <td><?= $ex['series'] ?></td>
                    <td><?= $ex['repeticoes'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="listar_treinos.php" class="btn btn-secondary">Voltar</a>
</div>
</body>
</html>


// Arquivo: concluir_treino.php
<?php
session_start();
require_once '../../config/db.php';

if ($_SESSION['usuario_tipo'] !== 'aluno') {
    header("Location: ../../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("Treino não especificado.");
}

$pdo = Database::conectar();
$treino_id = $_GET['id'];
$usuario_id = $_SESSION['usuario_id'];

// Marcar como concluído
$stmt = $pdo->prepare("INSERT INTO treinos_concluidos (treino_id, usuario_id, concluido_em) VALUES (?, ?, NOW())");
$stmt->execute([$treino_id, $usuario_id]);

header("Location: meus_treinos.php");
exit;
