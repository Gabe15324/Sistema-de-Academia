<?php
require '../../config/db.php';

session_start();
$conn = Database::conectar();
$erros = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $cpf = trim($_POST['cpf']);
    $data_nascimento = $_POST['data_nascimento'];
    $telefone = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);


    if (empty($nome)) {
        $erros['nome'] = 'Nome é obrigatório.';
    }

    if (empty($cpf) || !preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf)) {
        $erros['cpf'] = 'CPF inválido. Use o formato 000.000.000-00.';
    }

    if (empty($data_nascimento)) {
        $erros['data_nascimento'] = 'Data de nascimento é obrigatória.';
    }

   
    if (empty($erros)) {
        $stmt = $conn->prepare("INSERT INTO alunos (nome, cpf, data_nascimento, telefone, endereco) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $cpf, $data_nascimento, $telefone, $endereco]);
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Novo Aluno - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm w-100" style="max-width: 600px;">
            <div class="card-header bg-success text-white text-center">
                <h3 class="mb-0">Cadastrar Novo Aluno</h3>
            </div>
            <div class="card-body">
                <?php if (!empty($erros)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($erros as $erro): ?>
                                <li><?= htmlspecialchars($erro) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="nome">Nome <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            id="nome" 
                            name="nome" 
                            class="form-control <?= isset($erros['nome']) ? 'is-invalid' : '' ?>" 
                            value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>"
                        />
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            id="cpf" 
                            name="cpf" 
                            class="form-control <?= isset($erros['cpf']) ? 'is-invalid' : '' ?>" 
                            value="<?= htmlspecialchars($_POST['cpf'] ?? '') ?>"
                        />
                    </div>
                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento <span class="text-danger">*</span></label>
                        <input 
                            type="date" 
                            id="data_nascimento" 
                            name="data_nascimento" 
                            class="form-control <?= isset($erros['data_nascimento']) ? 'is-invalid' : '' ?>" 
                            value="<?= htmlspecialchars($_POST['data_nascimento'] ?? '') ?>"
                        />
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input 
                            type="text" 
                            id="telefone" 
                            name="telefone" 
                            class="form-control" 
                            value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>"
                        />
                    </div>
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <textarea 
                            id="endereco" 
                            name="endereco" 
                            class="form-control" 
                            rows="3"
                        ><?= htmlspecialchars($_POST['endereco'] ?? '') ?></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-outline-secondary px-4">Cancelar</a>
                        <button type="submit" class="btn btn-success px-4">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
