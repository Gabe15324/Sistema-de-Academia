<?php
session_start();
require 'config/db.php';
include 'includes/header.php';

if (isset($_SESSION['usuario_id'])) {
  header('Location: dashboard.php');
  exit();
}
?>

<!-- Seção de Login -->
<div class="container pt-5 pb-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow rounded-lg border-0">
        <div class="card-body px-4 py-4">
          <h4 class="text-center text-danger mb-4">
            <i class="fas fa-sign-in-alt mr-2"></i>Login ao Sistema
          </h4>

          <?php if (isset($_GET['erro']) || isset($_SESSION['erro_login'])): ?>
            <div class="alert alert-danger text-center">
              <?= $_SESSION['erro_login'] ?? "Login falhou. Verifique suas credenciais."; ?>
              <?php unset($_SESSION['erro_login']); ?>
            </div>
          <?php endif; ?>

          <form action="processa_login.php" method="POST">
            <div class="form-group">
              <label for="email" class="font-weight-bold">Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Digite seu email" required>
            </div>

            <div class="form-group">
              <label for="senha" class="font-weight-bold">Senha</label>
              <input type="password" name="senha" id="senha" class="form-control" placeholder="Digite sua senha" required>
            </div>

            <button type="submit" class="btn btn-danger btn-block mt-3">Entrar</button>
          </form>

          <div class="text-center mt-3">
            <small>Não tem conta?</small><br>
            <a href="cadastro.php" class="text-danger font-weight-bold">Cadastre-se</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
