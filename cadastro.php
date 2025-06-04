<?php include 'includes/header.php'; ?>

<div class="container mt-5">
<<<<<<< HEAD
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header bg-danger text-white text-center">
          <h4>Cadastro de Novo Usuário</h4>
=======
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
                            <input type="text" name="nome" class="form-control" placeholder="Nome" required>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label>Senha:</label>
                            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
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
>>>>>>> 961ea868c5e8e59748e860a2f9cfb00e8bb1b41f
        </div>
        <div class="card-body">

          <?php if (isset($_GET['erro'])): ?>
            <div class="alert alert-danger">
              <?php echo htmlspecialchars($_GET['erro']); ?>
            </div>
          <?php elseif (isset($_GET['sucesso'])): ?>
            <div class="alert alert-success">
              Cadastro realizado com sucesso! <a href="login.php" class="alert-link">Clique aqui para fazer login.</a>
            </div>
          <?php endif; ?>

          <form action="processa_cadastro.php" method="POST">
            <div class="form-group">
              <label for="nome">Nome completo</label>
              <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
              <label for="senha">Senha</label>
              <input type="password" class="form-control" id="senha" name="senha" required minlength="6">
            </div>

            <div class="form-group">
              <label for="confirmar_senha">Confirmar Senha</label>
              <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
            </div>

            <button type="submit" class="btn btn-danger btn-block">Cadastrar</button>
          </form>

          <div class="text-center mt-3">
            Já tem uma conta? <a href="login.php">Faça login aqui</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
