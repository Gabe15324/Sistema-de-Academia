<?php 
session_start(); 
include 'includes/header.php'; 
?>

<body class="bg-dark text-white">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow border-0" style="background-color: #2f2f2f;">
        <div class="card-header bg-danger text-white text-center">
          <h4 class="mb-0">Cadastro de Novo Usuário</h4>
        </div>
        <div class="card-body text-white">

          <?php if (isset($_SESSION['erro_cadastro'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['erro_cadastro']; unset($_SESSION['erro_cadastro']); ?></div>
          <?php endif; ?>

          <?php if (isset($_SESSION['sucesso_cadastro'])): ?>
            <div class="alert alert-success"><?= $_SESSION['sucesso_cadastro']; unset($_SESSION['sucesso_cadastro']); ?></div>
          <?php endif; ?>

          <form action="processa_cadastro.php" method="POST">

            <div class="form-group">
              <label for="nome">Nome completo</label>
              <input type="text" class="form-control bg-dark text-white border-secondary" id="nome" name="nome" required placeholder="Digite seu nome completo">
            </div>

            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" class="form-control bg-dark text-white border-secondary" id="email" name="email" required placeholder="exemplo@dominio.com">
            </div>

            <div class="form-group">
              <label for="cpf">CPF</label>
              <input type="text" class="form-control bg-dark text-white border-secondary" id="cpf" name="cpf" required placeholder="000.000.000-00">
            </div>

            <div class="form-group">
              <label for="data_nascimento">Data de Nascimento</label>
              <input type="date" class="form-control bg-dark text-white border-secondary" id="data_nascimento" name="data_nascimento" required>
            </div>

            <div class="form-group">
              <label for="telefone">Telefone</label>
              <input type="text" class="form-control bg-dark text-white border-secondary" id="telefone" name="telefone" required placeholder="(99) 99999-9999">
            </div>

            <div class="form-group">
              <label for="endereco">Endereço</label>
              <input type="text" class="form-control bg-dark text-white border-secondary" id="endereco" name="endereco" required placeholder="Rua, número, bairro">
            </div>

            <div class="form-group">
              <label for="genero">Gênero</label>
              <select class="form-control bg-dark text-white border-secondary" id="genero" name="genero" >
                <option value="" selected>Selecione</option>
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
                <option value="outro">Outro</option>
              </select>
            </div>

            <div class="form-group">
              <label for="senha">Senha</label>
              <input type="password" class="form-control bg-dark text-white border-secondary" id="senha" name="senha" required minlength="6" placeholder="Mínimo 6 caracteres">
            </div>

            <div class="form-group">
              <label for="confirmar_senha">Confirmar Senha</label>
              <input type="password" class="form-control bg-dark text-white border-secondary" id="confirmar_senha" name="confirmar_senha" required placeholder="Repita sua senha">
            </div>

            <div class="form-check mb-3">
              <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" onclick="toggleAdminPassword()">
              <label class="form-check-label" for="is_admin">Cadastrar como administrador?</label>
            </div>

            <div class="form-group" id="admin_password_field" style="display: none;">
              <label for="senha_admin">Senha de administrador</label>
              <input type="password" class="form-control bg-dark text-white border-secondary" id="senha_admin" name="senha_admin" placeholder="Digite a senha do administrador">
            </div>

            <button type="submit" class="btn btn-danger btn-block font-weight-bold">Cadastrar</button>
          </form>

          <div class="text-center mt-3">
            Já tem conta? <a href="login.php" class="text-danger font-weight-bold">Faça login aqui</a>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
function toggleAdminPassword() {
  const checkbox = document.getElementById('is_admin');
  const field = document.getElementById('admin_password_field');
  field.style.display = checkbox.checked ? 'block' : 'none';
}
</script>

<?php include 'includes/footer.php'; ?>
