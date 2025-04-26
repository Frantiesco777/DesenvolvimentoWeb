function buscarAnime() {
    const termo = document.getElementById('searchInput').value.toLowerCase();
    const animes = document.querySelectorAll('[data-anime]');
  
    if (termo.includes("one piece") || termo.includes("chainsaw ") || termo.includes("kimetsu") || termo.includes("edens zero")
    || termo.includes("naruto") || termo.includes("black clover") || termo.includes("dragon ball z") || termo.includes("one punch")) {
        window.location.href = `./generos/shounen.html?anime=${termo}`;

      } else if (termo.includes("devil may cry") || termo.includes("lazarus") || termo.includes("to be hero x") || termo.includes("kijun")
      || termo.includes("tougen anki") || termo.includes("gachiakuta") || termo.includes("shangri la") || termo.includes("zenchu")) {
        window.location.href = `./generos/lancamentos.html?anime=${termo}`;

      } else if (termo.includes("iruma") || termo.includes("kaguya") || termo.includes("nagatoro") || termo.includes("osomatsu")
      || termo.includes("usurei yatsura") || termo.includes("gintama") || termo.includes("konosuba") || termo.includes("prison")) {
        window.location.href = `./generos/comedia.html?anime=${termo}`;
      }
    }

    const logoutBtn = document.getElementById('logoutBtn');

// Adiciona o evento de clique no botão de logout
logoutBtn.addEventListener('click', () => {
  // Remove os dados de usuário do localStorage
  localStorage.removeItem('user');
  
  // Redireciona o usuário para a página de login (index.html)
  window.location.href = 'projeto.html'; // Aqui, "index.html" pode ser o nome da página de login
});

const storedUser = JSON.parse(localStorage.getItem('user'));

if (!storedUser) {
  // Se não houver dados de usuário no localStorage, redireciona para a página de login
  window.location.href = 'projeto.html'; // A página de login, onde o usuário deve se autenticar
}