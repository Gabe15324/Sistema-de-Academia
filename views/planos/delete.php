<?php
require '../../config/db.php';
session_start();

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM planos WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
