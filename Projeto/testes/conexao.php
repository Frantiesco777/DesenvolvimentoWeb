<?php
$host = "localhost";
$usuario = "root";
$senha = ""; // ou sua senha do MySQL
$banco = "animexone";

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
?>
