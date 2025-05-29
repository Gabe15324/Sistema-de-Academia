<?php
session_start();
require_once 'config/db.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

try {
    $pdo = Database::conectar(); 

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_tipo'] = $usuario['tipo'];
        header("Location: dashboard.php");
        exit;
    } else {
        $_SESSION['erro_login'] = "Email ou senha inválidos.";
        header("Location: login.php");
        exit;
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
