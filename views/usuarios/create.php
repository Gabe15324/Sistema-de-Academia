<?php
require '../../config/db.php';
include '../../includes/header.php';
session_start();

$conn = Database::conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo = $_POST['tipo'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $genero = $_POST['genero'] ?? null; 

    $stmt = $conn->prepare("
        INSERT INTO usuarios (nome, email, senha, tipo, telefone, data_nascimento, genero) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$nome, $email, $senha, $tipo, $telefone, $data_nascimento, $genero]);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Novo Usuário - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0 font-weight-light">Cadastrar Novo Usuário</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" novalidate>
                            <div class="form-group">
                                <label for="nome" class="font-weight-bold">Nome</label>
                                <input
                                    type="text"
                                    id="nome"
                                    name="nome"
                                    class="form-control form-control-lg"
                                    placeholder="Nome completo"
                                    required
                                >
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control form-control-lg"
                                    placeholder="exemplo@dominio.com"
                                    required
                                >
                            </div>
                            <div class="form-group">
                                <label for="senha" class="font-weight-bold">Senha</label>
                                <input
                                    type="password"
                                    id="senha"
                                    name="senha"
                                    class="form-control form-control-lg"
                                    placeholder="Senha segura"
                                    required
                                >
                            </div>
                            <div class="form-group">
                                <label for="tipo" class="font-weight-bold">Tipo de Usuário</label>
                                <select
                                    id="tipo"
                                    name="tipo"
                                    class="form-control form-control-lg"
                                    required
                                >
                                    <option value="admin">Administrador</option>
                                    <option value="aluno" selected>Aluno</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="matricula" class="font-weight-bold">Matrícula</label>
                                <input
                                    type="text"
                                    id="matricula"
                                    name="matricula"
                                    class="form-control form-control-lg"
                                    placeholder="Número da matrícula"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="telefone" class="font-weight-bold">Telefone</label>
                                <input
                                    type="text"
                                    id="telefone"
                                    name="telefone"
                                    class="form-control form-control-lg"
                                    placeholder="(00) 00000-0000"
                                >
                            </div>

                            <div class="form-group">
                                <label for="data_nascimento" class="font-weight-bold">Data de Nascimento</label>
                                <input
                                    type="date"
                                    id="data_nascimento"
                                    name="data_nascimento"
                                    class="form-control form-control-lg"
                                >
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary btn-lg font-weight-bold px-4">
                                    Salvar
                                </button>
                                <a href="index.php" class="btn btn-outline-secondary btn-lg font-weight-bold px-4">
                                    Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center text-muted small">
                        &copy; <?= date('Y') ?> Academia - Todos os direitos reservados
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
