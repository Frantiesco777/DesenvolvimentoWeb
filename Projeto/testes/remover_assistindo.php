<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Usuário não autenticado']);
    exit;
}

require_once("conexao.php");

$usuario_id = $_SESSION['usuario_id'];
$anime_id = isset($_POST['anime_id']) ? intval($_POST['anime_id']) : 0;

if ($anime_id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Dados inválidos']);
    exit;
}

$sqlDelete = $conexao->prepare("DELETE FROM usuarios_animes_assistindo WHERE usuario_id = ? AND anime_id = ?");
$sqlDelete->bind_param("ii", $usuario_id, $anime_id);
$sqlDelete->execute();

echo json_encode(['success' => true]);
