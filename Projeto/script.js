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
  
    const username = registerForm.querySelector('input[type="text"]').value;
    const email = registerForm.querySelector('input[type="email"]').value;
    const password = registerForm.querySelector('input[type="password"]').value;
  
    // Simula o armazenamento
    localStorage.setItem('user', JSON.stringify({
      username,
      email,
      password
    }));
  
    alert("Registrado com sucesso!");
  
    // Redireciona para uma "nova página" (ex: site de filmes)
    window.location.href = "site.html";
  });





  const loginForm = document.querySelector('.form-box.login form');

loginForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const email = loginForm.querySelector('input[type="email"]').value;
  const password = loginForm.querySelector('input[type="password"]').value;

  const storedUser = JSON.parse(localStorage.getItem('user'));

  if (storedUser && storedUser.email === email && storedUser.password === password) {
    alert("Login bem-sucedido!");
    window.location.href = "site.html";
  } else {
    alert("Email ou senha incorretos!");
  }
});
