<?php
session_start();
require_once 'config/db.php';

// Recebe os dados do formulário
$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$senha = $_POST['senha'];
$isAdminChecked = isset($_POST['is_admin']);
$senhaAdminInformada = $_POST['senha_admin'] ?? '';

try {
    $pdo = Database::conectar();

    // Verifica se o email já está cadastrado
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['erro_cadastro'] = "E-mail já cadastrado.";
        header("Location: cadastro.php");
        exit;
    }

    // Define o tipo de usuário
    $tipo = 'aluno'; // <- padrão: aluno

    // Verifica se o checkbox de admin foi marcado
    if ($isAdminChecked) {
        $senhaAdminCorreta = 'admin10032005';

        if ($senhaAdminInformada === $senhaAdminCorreta) {
            $tipo = 'admin';
        } else {
            $_SESSION['erro_cadastro'] = "Senha de administrador incorreta.";
            header("Location: cadastro.php");
            exit;
        }
    }

    // Criptografa a senha do usuário
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere o novo usuário no banco de dados
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $senhaHash, $tipo]);

    $_SESSION['sucesso_cadastro'] = "Cadastro realizado com sucesso. Faça login.";
    header("Location: login.php");
    exit;

} catch (PDOException $e) {
    $_SESSION['erro_cadastro'] = "Erro no cadastro: " . $e->getMessage();
    header("Location: cadastro.php");
    exit;
}
