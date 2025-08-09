<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Usuário não autenticado']);
    exit;
}

require_once("conexao.php");

$usuario_id = $_SESSION['usuario_id'];

$sql = $conexao->prepare("
    SELECT uaa.anime_id, uaa.episodio, ag.nome, ag.imagem 
    FROM usuarios_animes_assistindo uaa
    INNER JOIN animes_geral ag ON uaa.anime_id = ag.id
    WHERE uaa.usuario_id = ?
    ORDER BY uaa.atualizado_em DESC
");

$sql->bind_param("i", $usuario_id);
$sql->execute();
$result = $sql->get_result();

$animes = [];

while ($row = $result->fetch_assoc()) {
    $animes[] = $row;
}

header('Content-Type: application/json');
echo json_encode($animes);
