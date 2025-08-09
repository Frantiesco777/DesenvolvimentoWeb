<?php
require_once("conexao.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $conexao->prepare("SELECT conteudo FROM episodios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

echo $row['conteudo'] ?? '';
