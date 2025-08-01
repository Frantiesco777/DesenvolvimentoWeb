<?php
session_start();

// Verifica se o usuário é admin (ajuste conforme sua lógica)
if (!isset($_SESSION['admin'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Acesso negado']);
    exit;
}

require_once("conexao.php");

// Verifica se anime_id foi passado
if (!isset($_GET['anime_id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Parâmetro anime_id obrigatório']);
    exit;
}

$animeId = intval($_GET['anime_id']);

// Consulta temporadas do anime
$stmt = $conexao->prepare("SELECT id, numero, nome FROM temporadas_animes WHERE anime_id = ? ORDER BY numero ASC");
$stmt->bind_param("i", $animeId);
$stmt->execute();
$result = $stmt->get_result();

$temporadas = [];
while ($row = $result->fetch_assoc()) {
    // Se nome vazio, pode ajustar aqui, mas deixa para o front
    $temporadas[] = $row;
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode(['temporadas' => $temporadas]);
exit;
