<?php
session_start();
require_once '../../config/db.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'aluno') {
    header("Location: ../../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $data_nascimento = $_POST['data_nascimento'] ?: null;
    $genero = $_POST['genero'] ?: null;
    $cpf = trim($_POST['cpf']);
    $endereco = trim($_POST['endereco']);

    try {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("UPDATE usuarios SET 
            nome = ?, email = ?, telefone = ?, data_nascimento = ?, 
            genero = ?, cpf = ?, endereco = ? 
            WHERE id = ?");
        $stmt->execute([$nome, $email, $telefone, $data_nascimento, $genero, $cpf, $endereco, $id]);

        $_SESSION['mensagem_sucesso'] = "Perfil atualizado com sucesso!";
        header("Location: perfil.php");
        exit;
    } catch (PDOException $e) {
        die("Erro ao atualizar perfil: " . $e->getMessage());
    }
}
?>
