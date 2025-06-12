<?php
session_start();
require_once 'config/db.php';

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

try {
    $pdo = Database::conectar();

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_tipo'] = $usuario['tipo'];

        $_SESSION['mensagem_boas_vindas'] = "Bem-vindo(a), {$usuario['nome']}!";

        header("Location: dashboard.php");
        exit;
    } else {
        $_SESSION['erro_login'] = "Email ou senha inválidos.";
        header("Location: login.php");
        exit;
    }
} catch (PDOException $e) {
    $_SESSION['erro_login'] = "Erro ao conectar ao banco de dados.";
    header("Location: login.php");
    exit;
}
