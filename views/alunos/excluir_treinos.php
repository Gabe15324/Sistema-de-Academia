<?php
session_start();
require_once '../../config/db.php';

if ($_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("ID do treino não fornecido.");
}

$treino_id = $_GET['id'];

try {
    $pdo = Database::conectar();

    $stmt = $pdo->prepare("DELETE FROM treinos WHERE id = ?");
    $stmt->execute([$treino_id]);

    header("Location: treinos.php");
    exit;
} catch (PDOException $e) {
    die("Erro ao excluir treino: " . $e->getMessage());
}
