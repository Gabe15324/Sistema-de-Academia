<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$nome = $_SESSION['usuario_nome'];
$tipo = $_SESSION['usuario_tipo'];


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Academia</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .dashboard-container {
      margin-top: 60px;
    }
    .card-custom {
      transition: transform 0.2s;
    }
    .card-custom:hover {
      transform: scale(1.02);
    }
  </style>
</head>
<body>

<div class="container dashboard-container">
    <div class="card">
        <div class="card-body">
            <div class="text-center mb-5">
                <h2 class="text-danger font-weight-bold">🏋️ Academia Fit - Dashboard</h2>
                <p>Bem-vindo, <strong><?= htmlspecialchars($nome); ?></strong>! | Tipo de acesso: <span class="badge badge-secondary"><?= $tipo; ?></span></p>
            </div>

            <?php if ($tipo === 'admin'): ?>
                <div class="row">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card card-custom border-left-primary shadow h-100 py-2">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x text-primary mb-3"></i>
                        <h5 class="card-title">Usuários</h5>
                        <a href="views/usuarios/index.php" class="btn btn-outline-primary btn-sm">Gerenciar</a>
                    </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card card-custom border-left-success shadow h-100 py-2">
                    <div class="card-body text-center">
                        <i class="fas fa-user-graduate fa-2x text-success mb-3"></i>
                        <h5 class="card-title">Alunos</h5>
                        <a href="views/alunos/index.php" class="btn btn-outline-success btn-sm">Gerenciar</a>
                    </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card card-custom border-left-warning shadow h-100 py-2">
                    <div class="card-body text-center">
                        <i class="fas fa-dumbbell fa-2x text-warning mb-3"></i>
                        <h5 class="card-title">Planos</h5>
                        <a href="views/planos/index.php" class="btn btn-outline-warning btn-sm">Gerenciar</a>
                    </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card card-custom border-left-danger shadow h-100 py-2">
                    <div class="card-body text-center">
                        <i class="fas fa-file-signature fa-2x text-danger mb-3"></i>
                        <h5 class="card-title">Criar Treino</h5>
                        <a href="views/alunos/criar_treino.php" class="btn btn-outline-danger btn-sm">Gerenciar</a>
                    </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card card-custom border-left-danger shadow h-100 py-2">
                    <div class="card-body text-center">
                        <i class="fas fa-file-signature fa-2x text-danger mb-3"></i>
                        <h5 class="card-title">Listar Treinos</h5>
                        <a href="views/alunos/treinos.php" class="btn btn-outline-danger btn-sm">Gerenciar</a>
                    </div>
                    </div>
                </div>
                </div>

            <?php elseif ($tipo === 'aluno'): ?>
                <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-custom shadow-lg border-left-info">
                    <div class="card-body text-center">
                        <i class="fas fa-user-circle fa-2x text-info mb-3"></i>
                        <h4 class="card-title">Área do Aluno</h4>
                        <p class="card-text">Consulte seu plano, treinos e informações da matrícula.</p>
                        <a href="views/alunos/perfil.php" class="btn btn-primary m-1"><i class="fas fa-id-badge"></i> Meu Perfil</a>
                        <a href="views/alunos/meus_treinos.php" class="btn btn-info m-1"><i class="fas fa-dumbbell"></i> Meus Treinos</a>
                    </div>
                    </div>
                </div>
                </div>
            <?php endif; ?>

            <div class="text-center mt-4">
                <a href="logout.php" class="btn btn-outline-danger"><i class="fas fa-sign-out-alt"></i> Sair</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
