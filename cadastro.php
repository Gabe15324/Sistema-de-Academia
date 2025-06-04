<?php include 'includes/header.php'; ?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header bg-danger text-white text-center">
          <h4>Cadastro de Novo Usuário</h4>
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
