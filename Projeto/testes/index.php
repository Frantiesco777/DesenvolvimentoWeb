<?php
session_start();

$erro = '';
$showLogin = false;
$sucesso = '';
$mostrarPopupLogin = false;
$emailCadastrado = '';

if (isset($_SESSION['erro'])) {
    $erro = $_SESSION['erro'];
    unset($_SESSION['erro']);
}

if (isset($_SESSION['showLogin'])) {
    $showLogin = $_SESSION['showLogin'];
    unset($_SESSION['showLogin']);
}

if (isset($_SESSION['sucesso'])) {
    $sucesso = $_SESSION['sucesso'];
    unset($_SESSION['sucesso']);
    $mostrarPopupLogin = true; // abrir popup login ao mostrar sucesso
}

if (isset($_SESSION['email_cadastrado'])) {
    $emailCadastrado = $_SESSION['email_cadastrado'];
    unset($_SESSION['email_cadastrado']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>AnimeXone - Início</title>
  <link rel="stylesheet" href="estilo-login.css" />
</head>
<body>

  <header>
    <h2 class="logo">AnimeXone</h2>
    <nav class="navegacao">
      <a href="sobre.php">Sobre</a>
      <a href="serviços.php">Serviços</a>
      <a href="contato.php">Contato</a>
      <button class="botao_login">Login</button>
    </nav>
  </header>

  <?php if ($sucesso): ?>
    <div class="msg-sucesso" id="msgSucesso"><?php echo htmlspecialchars($sucesso); ?></div>
  <?php endif; ?>

  <?php if ($erro): ?>
    <div id="msgErro" class="msg-erro"><?php echo htmlspecialchars($erro); ?></div>
  <?php endif; ?>

  <div class="wrapper" id="loginWrapper">
    <span class="icon-close"><ion-icon name="close"></ion-icon></span>

    <!-- Login -->
    <div class="form-box login">
      <h2>Login</h2>
      <form action="login.php" method="POST">
        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="email" name="email" id="loginEmail" required
                 value="<?php echo htmlspecialchars($emailCadastrado); ?>" />
          <label>Email</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" name="senha" required />
          <label>Senha</label>
        </div>
        <div class="remember-forgot">
          <label><input type="checkbox" />Lembre-me!</label>
          <a href="#" class="forgot-password-link">Esqueceu a senha?</a>
        </div>
        <button type="submit" class="btn">Logar</button>
        <div class="login-register">
          <p>Não tem uma conta? <a href="#" class="register-link">Registrar</a></p>
        </div>
      </form>
    </div>

    <!-- Registro -->
    <div class="form-box register">
      <h2>Registro</h2>
      <form action="registro.php" method="POST">
        <div class="input-box">
          <span class="icon"><ion-icon name="person"></ion-icon></span>
          <input type="text" name="nome" required />
          <label>Usuário</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="email" name="email" required />
          <label>Email</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" name="senha" required />
          <label>Senha</label>
        </div>
        <div class="remember-forgot">
          <label><input type="checkbox" required /> Aceito os Termos</label>
        </div>
        <button type="submit" class="btn">Registrar</button>
        <div class="login-register">
          <p>Já tem uma conta? <a href="#" class="login-link">Logar</a></p>
        </div>
      </form>
    </div>

    <!-- Redefinir Senha -->
    <div class="form-box reset-password">
      <h2>Redefinir Senha</h2>
      <form action="redefinir_senha.php" method="POST">
        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="email" name="email" required />
          <label>Email</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" name="nova_senha" required />
          <label>Nova senha</label>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" name="repetir_senha" required />
          <label>Repita a nova senha</label>
        </div>
        <button type="submit" class="btn">Redefinir senha</button>
        <div class="login-register">
          <p><a href="#" class="back-to-login">Voltar para Login</a></p>
        </div>
      </form>
    </div>
  </div>

  <!-- Ícones -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <!-- Script externo -->
  <script src="script.js"></script>

  <script>
    // Controla a abertura dos popups baseado nas flags PHP
    document.addEventListener('DOMContentLoaded', () => {
      const wrapper = document.querySelector('.wrapper');
      if (<?php echo $mostrarPopupLogin ? 'true' : 'false'; ?>) {
        wrapper.classList.add('active-popup');
        wrapper.classList.remove('active', 'active-reset');
      } else if (<?php echo $showLogin ? 'true' : 'false'; ?>) {
        wrapper.classList.add('active-popup');
        wrapper.classList.remove('active', 'active-reset');
      } else {
        wrapper.classList.remove('active-popup', 'active', 'active-reset');
      }

      // Mensagem de erro desaparece após 2 segundos
      const msgErro = document.getElementById('msgErro');
      if (msgErro) {
        setTimeout(() => {
          msgErro.style.opacity = '0';
          setTimeout(() => msgErro.remove(), 500);
        }, 2000);
      }

      // Mensagem de sucesso desaparece após 2 segundos
      const msgSucesso = document.getElementById('msgSucesso');
      if (msgSucesso) {
        setTimeout(() => {
          msgSucesso.style.opacity = '0';
          setTimeout(() => msgSucesso.remove(), 500);
        }, 2000);
      }
    });
  </script>

</body>
</html>
