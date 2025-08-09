<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h1>
    <p><a href="logout.php">Sair</a></p>
</body>
</html>
