<?php
session_start();
require_once '../../config/db.php';


if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'aluno') {
    header("Location: ../../login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'] ?? null;

if (!$usuario_id) {
    die("Erro: Sessão inválida.");
}

try {
    $pdo = Database::conectar();
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        die("Usuário não encontrado.");
    }
} catch (PDOException $e) {
    die("Erro no banco de dados: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Meu Perfil</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="atualizar_perfil.php">
                        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" name="telefone" class="form-control" value="<?= $usuario['telefone'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Data de Nascimento</label>
                            <input type="date" name="data_nascimento" class="form-control" value="<?= $usuario['data_nascimento'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Gênero</label>
                            <select name="genero" class="form-control">
                                <option value="">Selecione</option>
                                <option value="masculino" <?= $usuario['genero'] === 'masculino' ? 'selected' : '' ?>>Masculino</option>
                                <option value="feminino" <?= $usuario['genero'] === 'feminino' ? 'selected' : '' ?>>Feminino</option>
                                <option value="outro" <?= $usuario['genero'] === 'outro' ? 'selected' : '' ?>>Outro</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>CPF</label>
                            <input type="text" name="cpf" class="form-control" value="<?= $usuario['cpf'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Endereço</label>
                            <input type="text" name="endereco" class="form-control" value="<?= $usuario['endereco'] ?>">
                        </div>

                        <div class="form-group d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            <a href="../../dashboard.php" class="btn btn-secondary">Voltar</a>
                        </div>
                    </form>

                    <hr>

                    <form method="POST" action="excluir_perfil.php" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
                        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                        <button type="submit" class="btn btn-danger btn-block">Excluir Conta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
