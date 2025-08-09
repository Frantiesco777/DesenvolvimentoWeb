<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AnimaXone</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <h2 class="logo">AnimaXone</h2>
    <nav class="navegacao">
      <a href="sobre.php">Sobre</a>
      <a href="serviços.php">Serviços</a>
      <a href="contato.php">Contato</a>
      <button class="botao_login" onclick="toggleLogin()">Login</button>
    </nav>
  </header>

  <div class="wrapper">
    <span class="icon-close">
      <ion-icon name="close"></ion-icon>
    </span>

    <!-- Login -->
    <div class="form-box login">
      <h2>Login</h2>
      <form action="login.php" method="POST">
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
          <label><input type="checkbox" />Lembre-me!</label>
          <a href="#" class="forgot-password-link">Esqueceu a senha?</a>
        </div>
        <button type="submit" class="btn">Logar</button>
        <div class="login-register">
          <p>
            Não tem uma conta?
            <a href="#" class="register-link">Registrar</a>
          </p>
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
          <label><input type="checkbox" required />Aceito os Termos &amp; Condições</label>
        </div>
        <button type="submit" class="btn">Registrar</button>
        <div class="login-register">
          <p>
            Já tem uma conta?
            <a href="#" class="login-link">Logar</a>
          </p>
        </div>
      </form>
    </div>

    <!-- Redefinir senha -->
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
      </form>
      <div class="login-register">
        <p>
          <a href="#" class="back-to-login">Voltar para Login</a>
        </p>
      </div>
    </div>
  </div>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="script.js"></script>
</body>
</html>
