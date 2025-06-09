<?php
require_once 'db.php'; // Arquivo está na mesma pasta

try {
    $pdo = Database::conectar();
    echo "✅ Conexão com o banco de dados realizada com sucesso!";
} catch (PDOException $e) {
    echo "❌ Erro na conexão: " . $e->getMessage();
}
