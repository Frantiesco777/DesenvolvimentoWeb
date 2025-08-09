window.addEventListener("DOMContentLoaded", () => {
  const params = new URLSearchParams(window.location.search);
  const termo = params.get("anime");

  if (termo) {
    const animes = document.querySelectorAll("[data-anime]");
    animes.forEach(anime => {
      const nome = anime.getAttribute("data-anime").toLowerCase();
      if (nome.includes(termo)) {
        anime.scrollIntoView({ behavior: "smooth", block: "center" });
        anime.classList.add("destaque-anime");

        setTimeout(() => {
          anime.classList.remove("destaque-anime");
        }, 2000);
      }
    });
  }
});
