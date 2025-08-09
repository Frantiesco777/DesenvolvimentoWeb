<?php
require_once("conexao.php");

header('Content-Type: application/json');

$idAnime = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($idAnime <= 0) {
    http_response_code(400);
    echo json_encode(["error" => "ID inválido"]);
    exit;
}

$stmt = $conexao->prepare("SELECT id, nome, imagem FROM animes_geral WHERE id = ?");
$stmt->bind_param("i", $idAnime);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(["error" => "Anime não encontrado"]);
    exit;
}

$anime = $result->fetch_assoc();
echo json_encode($anime);
