<?php
require '../../config/db.php';
session_start();
$conn = Database::conectar();
$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");