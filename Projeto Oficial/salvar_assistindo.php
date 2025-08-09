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
$episodio = isset($_POST['episodio']) ? intval($_POST['episodio']) : 0;

if ($anime_id <= 0 || $episodio <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Dados inválidos']);
    exit;
}

// Verifica se já existe o registro
$sqlCheck = $conexao->prepare("SELECT id FROM usuarios_animes_assistindo WHERE usuario_id = ? AND anime_id = ?");
$sqlCheck->bind_param("ii", $usuario_id, $anime_id);
$sqlCheck->execute();
$res = $sqlCheck->get_result();

if ($res->num_rows > 0) {
    // Atualiza episódio
    $sqlUpdate = $conexao->prepare("UPDATE usuarios_animes_assistindo SET episodio = ?, atualizado_em = NOW() WHERE usuario_id = ? AND anime_id = ?");
    $sqlUpdate->bind_param("iii", $episodio, $usuario_id, $anime_id);
    $sqlUpdate->execute();
} else {
    // Insere novo registro
    $sqlInsert = $conexao->prepare("INSERT INTO usuarios_animes_assistindo (usuario_id, anime_id, episodio) VALUES (?, ?, ?)");
    $sqlInsert->bind_param("iii", $usuario_id, $anime_id, $episodio);
    $sqlInsert->execute();
}

echo json_encode(['success' => true]);
