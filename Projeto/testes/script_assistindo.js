// Função para buscar lista de animes assistindo do usuário via AJAX
async function carregarAssistindo() {
  try {
    const response = await fetch('buscar_assistindo.php');
    if (!response.ok) throw new Error('Erro ao buscar animes assistindo');
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(error);
    return [];
  }
}

// Função para salvar progresso via AJAX
async function salvarAssistindo(animeId, episodio) {
  try {
    const response = await fetch('salvar_assistindo.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `anime_id=${animeId}&episodio=${episodio}`
    });
    const data = await response.json();
    if (!data.success) throw new Error('Erro ao salvar progresso');
  } catch (error) {
    console.error(error);
  }
}

// Função para remover anime da lista via AJAX
async function removerAssistindo(animeId) {
  try {
    const response = await fetch('remover_assistindo.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `anime_id=${animeId}`
    });
    const data = await response.json();
    if (!data.success) throw new Error('Erro ao remover anime');
    atualizarAreaAssistindo(); // Atualiza visual após remoção
  } catch (error) {
    console.error(error);
  }
}

// Atualiza visual da área "assistindo" com dados do banco
async function atualizarAreaAssistindo() {
  const container = document.getElementById('area-assistindo');
  if (!container) return;

  const lista = await carregarAssistindo();
  container.innerHTML = '<h2>Animes em andamento</h2>';

  if (lista.length === 0) {
    container.innerHTML += '<p>Nenhum anime em andamento.</p>';
    return;
  }

  lista.forEach(item => {
    const div = document.createElement('div');
    div.className = 'anime-assistindo-item';
    div.innerHTML = `
      <img src="${item.imagem}" alt="${item.nome}" title="Continuar assistindo Ep ${item.episodio}" />
      <button class="btn-continuar" data-anime-id="${item.anime_id}" data-ep="${item.episodio}">Continuar</button>
      <button class="btn-completado" data-anime-id="${item.anime_id}">Anime Completado!</button>
    `;
    container.appendChild(div);
  });

  container.querySelectorAll('.btn-continuar').forEach(btn => {
    btn.onclick = () => {
      const animeId = btn.getAttribute('data-anime-id');
      const ep = btn.getAttribute('data-ep');
      // Redireciona para ep.php passando o animeId e o episódio
      // Precisa saber o ID do episódio específico, aqui vamos usar animeId + ep
      // Se quiser que redirecione para ep.php?id=EPISODIO_ID, será preciso guardar e consultar o ID do episódio real.
      // Por enquanto vamos tentar construir a URL com animeId e ep
      // Mas o ideal é guardar o id do episódio na tabela, e consultar para redirecionar corretamente
      window.location.href = `ep.php?anime=${animeId}&ep=${ep}`;
    };
  });

  container.querySelectorAll('.btn-completado').forEach(btn => {
    btn.onclick = () => {
      const animeId = btn.getAttribute('data-anime-id');
      removerAssistindo(animeId);
    };
  });
}

document.addEventListener('DOMContentLoaded', atualizarAreaAssistindo);
