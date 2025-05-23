const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.botao_login');
const iconClose = document.querySelector('.icon-close');
const registerForm = document.querySelector('.form-box.register form');

registerLink.addEventListener('click', () => {
  wrapper.classList.add('active');
});

loginLink.addEventListener('click', () => {
  wrapper.classList.remove('active');
});

iconClose.addEventListener('click', () => {
  wrapper.classList.remove('active-popup');
});

btnPopup.addEventListener('click', () => {
  wrapper.classList.add('active-popup');
});

registerForm.addEventListener('submit', (e) => {
  e.preventDefault(); // impede que a página recarregue

  const name = registerForm.querySelector('input[type="text"]').value;
  const email = registerForm.querySelector('input[type="email"]').value;
  const password = registerForm.querySelector('input[type="password"]').value;

  // Armazena os dados no localStorage com o campo "name"
  localStorage.setItem('user', JSON.stringify({
    name,
    email,
    password
  }));

  alert("Registrado com sucesso!");

  // Redireciona para o site principal após registro
  window.location.href = "site.php";
});

const loginForm = document.querySelector('.form-box.login form');

loginForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const email = loginForm.querySelector('input[type="email"]').value;
  const password = loginForm.querySelector('input[type="password"]').value;

  const storedUser = JSON.parse(localStorage.getItem('user'));

  if (storedUser && storedUser.email === email && storedUser.password === password) {
    alert("Login bem-sucedido!");
    window.location.href = "site.php";
  } else {
    alert("Email ou senha incorretos!");
  }
});
