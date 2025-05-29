<?php session_start(); ?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function toggleAdminPassword() {
            const check = document.getElementById('is_admin');
            const pwdField = document.getElementById('admin_password_field');
            pwdField.style.display = check.checked ? 'block' : 'none';
        }
    </script>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">Cadastro</div>
                <?php if (isset($_SESSION['erro_cadastro'])): ?>
                    <p style="color: red;"><?php echo $_SESSION['erro_cadastro']; unset($_SESSION['erro_cadastro']); ?></p>
                <?php endif; ?>
                <?php if (isset($_SESSION['sucesso_cadastro'])): ?>
                    <p style="color: green;"><?php echo $_SESSION['sucesso_cadastro']; unset($_SESSION['sucesso_cadastro']); ?></p>
                <?php endif; ?>
                <div class="card-body">
                    <form action="processa_cadastro.php" method="POST">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Senha:</label>
                            <input type="password" name="senha" class="form-control" required>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" onclick="toggleAdminPassword()">
                            <label class="form-check-label" for="is_admin">Cadastrar como administrador?</label>
                        </div>

                        <div class="form-group" id="admin_password_field" style="display:none;">
                            <label>Senha de administrador:</label>
                            <input type="password" name="senha_admin" class="form-control" placeholder="Informe a senha de administrador">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="login.php">Já tem conta? Faça login</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
