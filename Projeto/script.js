const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.botao_login');
const iconClose = document.querySelector('.icon-close');

const registerForm = document.querySelector('.form-box.register form');
const loginForm = document.querySelector('.form-box.login form');
const resetPasswordLink = document.querySelector('.remember-forgot a'); // "Esqueceu a senha?" link
const resetPasswordForm = document.querySelector('.form-box.reset-password form');
const backToLoginLink = document.querySelector('.reset-password .back-to-login');

btnPopup.addEventListener('click', () => {
  wrapper.classList.add('active-popup');
  // Sempre começar mostrando o login ao abrir
  wrapper.classList.remove('active', 'active-reset');
});

iconClose.addEventListener('click', () => {
  wrapper.classList.remove('active-popup', 'active', 'active-reset');
});

registerLink.addEventListener('click', () => {
  wrapper.classList.add('active');
  wrapper.classList.remove('active-reset');
});

loginLink.addEventListener('click', () => {
  wrapper.classList.remove('active', 'active-reset');
});

// Abre tela de redefinir senha
resetPasswordLink.addEventListener('click', (e) => {
  e.preventDefault();
  wrapper.classList.add('active-reset');
  wrapper.classList.remove('active');
});

// Voltar para login a partir do reset de senha
backToLoginLink.addEventListener('click', (e) => {
  e.preventDefault();
  wrapper.classList.remove('active-reset');
  wrapper.classList.remove('active');
});

// Registro
registerForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const name = registerForm.querySelector('input[type="text"]').value;
  const email = registerForm.querySelector('input[type="email"]').value;
  const password = registerForm.querySelector('input[type="password"]').value;

  localStorage.setItem('user', JSON.stringify({ name, email, password }));

  alert("Registrado com sucesso!");
  window.location.href = "site.php";
});

// Login
loginForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const email = loginForm.querySelector('input[type="email"]').value;
  const password = loginForm.querySelector('input[type="password"]').value;

  const storedUser = JSON.parse(localStorage.getItem('user'));

  if (storedUser && storedUser.email === email && storedUser.password === password) {
    // Login correto, redireciona direto, sem alert
    window.location.href = "site.php";
  } else {
    alert("Email ou senha incorretos!");
  }
});

// Redefinir senha (exemplo simples)
resetPasswordForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const newPassword = resetPasswordForm.querySelector('input[name="new-password"]').value;
  const repeatPassword = resetPasswordForm.querySelector('input[name="repeat-password"]').value;

  if (newPassword !== repeatPassword) {
    alert("As senhas não coincidem!");
    return;
  }

  const storedUser = JSON.parse(localStorage.getItem('user'));

  if (!storedUser) {
    alert("Nenhum usuário registrado encontrado!");
    return;
  }

  // Atualiza a senha do usuário armazenado
  storedUser.password = newPassword;
  localStorage.setItem('user', JSON.stringify(storedUser));

  alert("Senha redefinida com sucesso!");
  wrapper.classList.remove('active-reset');
  wrapper.classList.add('active'); // volta para tela de login
});
