<?php
require_once("conexao.php");

if (!isset($_GET['temporada_id'])) {
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
?>
