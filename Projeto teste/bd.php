<?php
$host = 'localhost';
$dbname = 'animexone';
$username = 'root';
$password = ''; // ou a senha que você usa no MySQL

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Ativa o modo de erros do PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
