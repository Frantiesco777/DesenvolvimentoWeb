<?php
session_start();
if (!isset($_SESSION['admin'])) {
    http_response_code(403);
    exit;
}

require_once("conexao.php");

if (!isset($_GET['id'])) {
    http_response_code(400);
    exit("ID do episódio necessário");
}

$id = intval($_GET['id']);
$stmt = $conexao->prepare("SELECT conteudo FROM episodios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($conteudo);
if ($stmt->fetch() && $conteudo !== null) {
    header("Content-Type: video/mp4");
    echo $conteudo;
} else {
    http_response_code(404);
    echo "Vídeo não encontrado";
}
