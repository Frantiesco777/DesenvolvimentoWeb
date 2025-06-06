<?php
require_once("conexao.php");


$stmt = $conexao->prepare("SELECT * FROM animes WHERE id = ?");
$stmt->bind_param("s", $_GET['id']);
$stmt->execute();
$resultado = $stmt->get_result()->fetch_assoc();

var_dump($resultado);