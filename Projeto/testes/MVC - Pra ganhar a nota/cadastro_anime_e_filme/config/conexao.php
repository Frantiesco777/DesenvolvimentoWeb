<?php
$servername = "localhost";
$username = "root";  // ajuste conforme seu setup
$password = "";      // ajuste conforme seu setup
$dbname = "cadastro_anime_e_filme";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
