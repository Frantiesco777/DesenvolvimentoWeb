document.addEventListener('DOMContentLoaded', () => {
  const wrapper = document.querySelector('.wrapper');
  const botaoLogin = document.querySelector('.botao_login');
  const iconClose = document.querySelector('.icon-close');

  const formLogin = wrapper.querySelector('.form-box.login');
  const formRegister = wrapper.querySelector('.form-box.register');
  const formReset = wrapper.querySelector('.form-box.reset-password');

  // Função para abrir popup no formulário login
  function abrirLogin() {
    wrapper.classList.add('active-popup');
    wrapper.classList.remove('active', 'active-reset');
    formLogin.style.display = 'block';
    formRegister.style.display = 'none';
    formReset.style.display = 'none';
  }

  // Clique no botão Login do header abre popup login
  if (botaoLogin) {
    botaoLogin.addEventListener('click', (e) => {
      e.preventDefault();
      abrirLogin();
    });
  }

  // Clique no X fecha popup
  if (iconClose) {
    iconClose.addEventListener('click', () => {
      wrapper.classList.remove('active-popup', 'active', 'active-reset');
    });
  }

  // Alternar para registro
  const registerLink = wrapper.querySelector('.register-link');
  if (registerLink) {
    registerLink.addEventListener('click', (e) => {
      e.preventDefault();
      wrapper.classList.remove('active-popup', 'active-reset');
      wrapper.classList.add('active');
      formLogin.style.display = 'none';
      formRegister.style.display = 'block';
      formReset.style.display = 'none';
    });
  }

  // Alternar para login a partir da tela de registro
  const loginLink = wrapper.querySelector('.login-link');
  if (loginLink) {
    loginLink.addEventListener('click', (e) => {
      e.preventDefault();
      abrirLogin();
    });
  }

  // Alternar para redefinir senha
  const forgotPasswordLink = wrapper.querySelector('.forgot-password-link');
  if (forgotPasswordLink) {
    forgotPasswordLink.addEventListener('click', (e) => {
      e.preventDefault();
      wrapper.classList.remove('active-popup', 'active');
      wrapper.classList.add('active-reset');
      formLogin.style.display = 'none';
      formRegister.style.display = 'none';
      formReset.style.display = 'block';
    });
  }

  // Voltar para login a partir de redefinir senha
  const backToLoginLink = wrapper.querySelector('.back-to-login');
  if (backToLoginLink) {
    backToLoginLink.addEventListener('click', (e) => {
      e.preventDefault();
      abrirLogin();
    });
  }
});
