<?php
require_once 'db.php'; // Arquivo está na mesma pasta

try {
    $db = new Database();
    $pdo = $db->getConnection();
    echo "✅ Conexão com o banco de dados realizada com sucesso!";
} catch (PDOException $e) {
    echo "❌ Erro na conexão: " . $e->getMessage();
}
