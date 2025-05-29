<?php
session_start();
require_once 'config/db.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$isAdminChecked = isset($_POST['is_admin']);
$senhaAdminInformada = $_POST['senha_admin'] ?? '';

try {
    $pdo = Database::conectar();

    // Verifica se email já existe
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['erro_cadastro'] = "Email já cadastrado.";
        header("Location: cadastro.php");
        exit;
    }

    // Define tipo de usuário padrão
    $tipo = 'usuario';

    // Se marcou "cadastrar como admin", verifica a senha correta
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

    // Hash da senha normal
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere usuário no banco
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
