<?php
require 'config/db.php';
include 'includes/header.php';

session_start();

if (isset($_SESSION['usuario_id'])) {
  header('Location: dashboard.php');
  exit();
}
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <?php if (isset($_GET['erro'])): ?>
        <div class="alert alert-danger text-center">Login falhou. Verifique suas credenciais.</div>
      <?php endif; ?>

      <div class="card shadow">
        <div class="card-header bg-danger text-white text-center">
          <h4>Login</h4>
        </div>
        <div class="card-body">
          <form action="processa_login.php" method="POST">
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
              <label for="senha">Senha:</label>
              <input type="password" name="senha" class="form-control" id="senha" required>
            </div>
            <button type="submit" class="btn btn-danger btn-block">Entrar</button>
          </form>
          <p class="mt-3 text-center">Ainda não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
