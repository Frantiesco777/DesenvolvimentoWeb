<?php
session_start();
require_once("conexao.php");

$erro = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Email fixo do admin para controle
    $emailAdmin = 'admin@admin.com';

    if ($email !== $emailAdmin) {
        $erro = "Acesso restrito ao administrador.";
    } else {
        $stmt = $conexao->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $admin = $resultado->fetch_assoc();

            // Verifica a senha com password_verify (supondo que senha esteja com hash)
            if (password_verify($senha, $admin['senha'])) {
                // Grava os dados do admin na sessão
                $_SESSION['admin'] = [
                    'id' => $admin['id'],
                    'email' => $admin['email'],
                    'nome' => $admin['nome']
                ];
                // Redireciona para a página de cadastro
                header("Location: cadastro.php");
                exit;
            } else {
                $erro = "Senha incorreta.";
            }
        } else {
            $erro = "Administrador não encontrado.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Login Administrador - AnimeXone</title>
    <style>
      body { background: #121212; color: #eee; font-family: Arial, sans-serif; padding: 40px; }
      .box { max-width: 400px; margin: auto; background: #1e1e1e; padding: 20px; border-radius: 8px; box-shadow: 0 0 15px #f9a825; }
      input, button { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: none; }
      button { background: #f9a825; color: #121212; font-weight: bold; cursor: pointer; }
      .erro { background: #f44336; padding: 10px; border-radius: 5px; margin-bottom: 10px; }
    </style>
</head>
<body>
  <div class="box">
    <h2>Login Administrador</h2>
    <?php if ($erro): ?>
      <div class="erro"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>
    <form method="POST">
      <input type="email" name="email" placeholder="Email do administrador" required />
      <input type="password" name="senha" placeholder="Senha" required />
      <button type="submit">Entrar</button>
    </form>
  </div>
</body>
</html>
