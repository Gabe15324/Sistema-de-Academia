<?php
require '../../config/db.php';
session_start();
$conn = Database::conectar();

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch();

if (!$usuario) {
    echo "<div class='alert alert-danger text-center mt-5'>Usuário não encontrado.</div>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];

    $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, email = ?, tipo = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $tipo, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Editar Usuário - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-sm w-100" style="max-width: 480px;">
            <div class="card-header bg-info text-white text-center">
                <h3 class="mb-0">Editar Usuário</h3>
            </div>
            <div class="card-body">
                <form method="POST" novalidate>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input 
                            type="text" 
                            id="nome" 
                            name="nome" 
                            class="form-control" 
                            placeholder="Nome completo" 
                            value="<?= htmlspecialchars($usuario['nome']) ?>" 
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control" 
                            placeholder="exemplo@dominio.com" 
                            value="<?= htmlspecialchars($usuario['email']) ?>" 
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Usuário</label>
                        <select id="tipo" name="tipo" class="form-control" required>
                            <option value="admin" <?= $usuario['tipo'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
                            <option value="aluno" <?= $usuario['tipo'] === 'aluno' ? 'selected' : '' ?>>Aluno</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-outline-secondary px-4">Cancelar</a>
                        <button type="submit" class="btn btn-info px-4">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
