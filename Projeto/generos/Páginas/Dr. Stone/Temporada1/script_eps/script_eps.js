let likeCount = 0;

  document.getElementById("likeButton").addEventListener("click", () => {
    likeCount++;
    document.getElementById("likeCount").innerText = likeCount;
  });

  function adicionarComentario() {
    const input = document.getElementById("comentarioInput");
    const comentario = input.value.trim();

    if (comentario !== "") {
      const lista = document.getElementById("listaComentarios");
      const novoComentario = document.createElement("p");
      novoComentario.textContent = comentario;
      lista.appendChild(novoComentario);
      input.value = "";
    }
  }