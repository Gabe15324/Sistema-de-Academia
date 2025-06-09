<?php
session_start();
require_once 'config/db.php';

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$confirmar_senha = $_POST['confirmar_senha'] ?? '';
$telefone = trim($_POST['telefone'] ?? '');
$data_nascimento = $_POST['data_nascimento'] ?? null;
$cpf = trim($_POST['cpf'] ?? '');
$endereco = trim($_POST['endereco'] ?? '');
$isAdmin = isset($_POST['is_admin']);
$senhaAdmin = $_POST['senha_admin'] ?? '';

if ($senha !== $confirmar_senha) {
    $_SESSION['erro_cadastro'] = "As senhas não coincidem.";
    header("Location: cadastro.php");
    exit;
}

try {
    $pdo = Database::conectar();

    // Verifica duplicidade de email
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['erro_cadastro'] = "E-mail já cadastrado.";
        header("Location: cadastro.php");
        exit;
    }

    $tipo = 'aluno';
    if ($isAdmin) {
        $senhaCorretaAdmin = 'admin10032005';
        if ($senhaAdmin !== $senhaCorretaAdmin) {
            $_SESSION['erro_cadastro'] = "Senha de administrador incorreta.";
            header("Location: cadastro.php");
            exit;
        }
        $tipo = 'admin';
    }

    $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

    $genero = $_POST['genero'] ?? null;

    $ativo = 1; 

    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, cpf, data_nascimento, telefone, endereco, tipo, genero, ativo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $hashSenha, $cpf, $data_nascimento, $telefone, $endereco, $tipo, $genero, $ativo]);



    $_SESSION['sucesso_cadastro'] = "Cadastro realizado com sucesso!";
    header("Location: login.php");
    exit;

} catch (PDOException $e) {
    $_SESSION['erro_cadastro'] = "Erro ao salvar os dados: " . $e->getMessage();
    header("Location: cadastro.php");
    exit;
}
