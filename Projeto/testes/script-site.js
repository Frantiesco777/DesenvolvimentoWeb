// script-site.js

// Aqui você pode adicionar scripts que deseja para a página site.php

console.log("Script do site carregado.");

// Exemplo: mostrar nome do anime ao clicar
document.querySelectorAll('.anime-item img').forEach(img => {
  img.addEventListener('click', () => {
    alert(`Você clicou no anime: ${img.dataset.anime}`);
  });
});
