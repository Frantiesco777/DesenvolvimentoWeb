<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

require_once __DIR__ . '/../app/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remover_id'])) {
    $idRemover = intval($_POST['remover_id']);
    $stmt = $conn->prepare("DELETE FROM cadastro WHERE id = ?");
    $stmt->bind_param("i", $idRemover);
    $stmt->execute();
    $stmt->close();
}

header("Location: listar.php");
exit;
