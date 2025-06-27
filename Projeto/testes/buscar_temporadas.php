<?php
session_start();
if (!isset($_SESSION['admin'])) {
    http_response_code(403);
    exit;
}

require_once("conexao.php");

if (!isset($_GET['anime_id'])) {
    http_response_code(400);
    echo json_encode([]);
    exit;
}

$animeId = intval($_GET['anime_id']);

$stmt = $conexao->prepare("SELECT id, numero, nome FROM temporadas_animes WHERE anime_id = ? ORDER BY numero ASC");
$stmt->bind_param("i", $animeId);
$stmt->execute();
$result = $stmt->get_result();

$temporadas = [];
while ($row = $result->fetch_assoc()) {
    $temporadas[] = $row;
}

header('Content-Type: application/json');
echo json_encode($temporadas);
