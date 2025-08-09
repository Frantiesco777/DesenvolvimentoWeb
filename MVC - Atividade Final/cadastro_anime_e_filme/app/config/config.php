<?php
$host = "localhost";
$user = "root";
$pass = ""; // coloque a senha do seu MySQL se tiver
$dbname = "cadastro_anime_e_filme";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
