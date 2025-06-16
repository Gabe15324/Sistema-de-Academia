<?php
session_start();
require_once '../../config/db.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'aluno') {
    header("Location: ../../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    try {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);

        session_destroy();
        header("Location: ../../login.php");
        exit;
    } catch (PDOException $e) {
        die("Erro ao excluir perfil: " . $e->getMessage());
    }
}
?>
