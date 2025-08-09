<?php
session_start();
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/models/Usuario.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $usuarioModel = new Usuario($conn);
    $usuario = $usuarioModel->login($email, $senha);

    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        header('Location: cadastro.php');
        exit;
    } else {
        $erro = "E-mail ou senha inválidos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Cadastro Anime/Filme</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (!empty($erro)) echo "<p class='erro'>$erro</p>"; ?>
        <form method="POST">
            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Senha:</label>
            <input type="password" name="senha" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
