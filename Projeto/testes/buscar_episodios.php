<?php
session_start();
if (!isset($_SESSION['admin'])) {
    http_response_code(403);
    exit;
}

require_once("conexao.php");

if (!isset($_GET['temporada_id'])) {
    http_response_code(400);
    echo json_encode([]);
    exit;
}

$temporadaId = intval($_GET['temporada_id']);

$stmt = $conexao->prepare("SELECT id, numero FROM episodios WHERE temporada_id = ? ORDER BY numero ASC");
$stmt->bind_param("i", $temporadaId);
$stmt->execute();
$result = $stmt->get_result();

$episodios = [];
while ($row = $result->fetch_assoc()) {
    $episodios[] = $row;
}

header('Content-Type: application/json');
echo json_encode($episodios);
