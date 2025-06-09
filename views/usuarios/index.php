<?php
session_start();

// Redireciona se não estiver logado
if (!isset($_SESSION['usuario_tipo'])) {
    header("Location: ../../login.php");
    exit;
}

require '../../config/db.php';
$conn = Database::conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Painel - <?= ucfirst($_SESSION['usuario_tipo']) ?></h2>
        <a href="../../logout.php" class="btn btn-danger">
            <i class="fas fa-sign-out-alt"></i> Sair
        </a>
    </div>

    <?php if ($_SESSION['usuario_tipo'] === 'admin'): ?>
        <div class="row">
            <div class="col-md-3 mb-3">
                <a href="create.php" class="btn btn-success btn-block">
                    <i class="fas fa-user-plus"></i> Novo Usuário
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="../../views/alunos/index.php" class="btn btn-info btn-block">
                    <i class="fas fa-users"></i> Gerenciar Alunos
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="../../views/planos/index.php" class="btn btn-warning btn-block">
                    <i class="fas fa-dumbbell"></i> Gerenciar Planos
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="../../views/matriculas/index.php" class="btn btn-secondary btn-block">
                    <i class="fas fa-id-card"></i> Gerenciar Matrículas
                </a>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-dark text-white">
                <i class="fas fa-users-cog"></i> Lista de Usuários
            </div>
            <div class="card-body">
                <?php
                $stmt = $conn->query("SELECT * FROM usuarios ORDER BY nome");
                $usuarios = $stmt->fetchAll();
                ?>
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $user): ?>
                            <tr>
                                <td><?= $user['nome'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td>
                                    <span class="badge badge-<?= $user['tipo'] === 'admin' ? 'danger' : 'primary' ?>">
                                        <?= ucfirst($user['tipo']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="edit.php?id=<?= $user['id'] ?>">
                                        <img src="icones/editar.gif" alt="Editar" style="width: 30px; height: 30px;">
                                    </a>
                                    <a href="delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">
                                        <img src="icones/lixeira.gif" alt="Editar" style="width: 30px; height: 30px;">
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="../../dashboard.php" class="btn btn-outline-primary mt-3">
                    <i class="fas fa-arrow-left"></i> Voltar ao Painel Principal
                </a>
            </div>
        </div>

    <?php elseif ($_SESSION['usuario_tipo'] === 'aluno'): ?>
        <div class="card text-center">
            <div class="card-header bg-primary text-white">
                <h4>Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h4>
            </div>
            <div class="card-body">
                <p class="card-text lead">Bem-vindo à sua área de aluno. Aqui você pode acompanhar seus treinos e plano de matrícula.</p>
                <a href="../../views/alunos/perfil.php" class="btn btn-info btn-lg mb-2">
                    <i class="fas fa-user"></i> Meu Perfil
                </a>
                <a href="../../views/alunos/treinos.php" class="btn btn-success btn-lg mb-2">
                    <i class="fas fa-dumbbell"></i> Meus Treinos
                </a>
                <a href="../../dashboard.php" class="btn btn-outline-secondary mt-3">
                    <i class="fas fa-arrow-left"></i> Voltar ao Painel Principal
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">Tipo de usuário inválido. Acesso negado.</div>
    <?php endif; ?>
</div>
</body>
</html>
