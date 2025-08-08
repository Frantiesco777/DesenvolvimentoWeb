<?php
session_start();
$msg = $_GET['msg'] ?? '';

if (isset($_SESSION['usuario_id'])) {
    header("Location: cadastro.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Registrar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container" style="max-width:400px; margin:auto;">
    <h1>Registrar</h1>

    <?php if ($msg === 'erro_registro'): ?>
        <p class="erro">Erro ao registrar. Email pode já estar cadastrado.</p>
    <?php endif; ?>

    <form action="../controller/UsuarioController.php" method="POST" autocomplete="off">
        <input type="hidden" name="acao" value="registrar">
        <label>Nome</label>
        <input type="text" name="nome" required>
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Senha</label>
        <input type="password" name="senha" required>
        <button type="submit">Registrar</button>
    </form>

    <p style="margin-top:15px;">Já tem uma conta? <a href="index.php" style="color:#ffcc00;">Logar</a></p>
</div>
</body>
</html>
