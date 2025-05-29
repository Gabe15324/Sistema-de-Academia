<?php session_start(); ?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">Login</div>
                    <?php if (isset($_SESSION['erro_login'])): ?>
                        <p style="color: red;"><?php echo $_SESSION['erro_login']; unset($_SESSION['erro_login']); ?></p>
                    <?php endif; ?>
                <div class="card-body">
                    <form action="processa_login.php" method="POST">
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Senha:</label>
                            <input type="password" name="senha" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        <div class="text-center mt-3">
                            <a href="cadastro.php">Não tem conta? Cadastre-se</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
