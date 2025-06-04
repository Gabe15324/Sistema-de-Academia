<?php
session_start();

// Garante que o usuário está logado
if (!isset($_SESSION['usuario_tipo'])) {
    header("Location: ../../login.php");
    exit;
}

require '../../config/db.php';
$conn = Database::conectar();

// Se for admin, mostra o painel de gerenciamento
if ($_SESSION['usuario_tipo'] === 'admin') {
    $stmt = $conn->query("SELECT * FROM usuarios ORDER BY nome");
    $usuarios = $stmt->fetchAll();
    ?>
    
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Usuários - Academia</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container mt-4">
        <h2>Gerenciar Usuários</h2>
        <a href="create.php" class="btn btn-primary mb-3">Novo Usuário</a>
        <a href="../../dashboard.php" class="btn btn-secondary mb-3 float-right">Voltar</a>

        <table class="table table-bordered">
            <thead>
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
                        <td><?= htmlspecialchars($user['nome']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= $user['tipo'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="delete.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </body>
    </html>

<?php
// Se for aluno, mostra layout simplificado
} elseif ($_SESSION['usuario_tipo'] === 'aluno') {
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Área do Aluno</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container mt-5">
        <h2>Bem-vindo à sua área, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h2>
        <p class="lead">Você está logado como <strong>aluno</strong>.</p>

        <a href="../../dashboard.php" class="btn btn-primary mt-3">Ir para o painel principal</a>
    </div>
    </body>
    </html>
<?php
// Outros tipos não autorizados
} else {
    header("Location: ../../dashboard.php");
    exit;
}
?>
