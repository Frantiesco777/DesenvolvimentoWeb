<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Ajuste conforme seu sistema - aqui pegamos o id do usuário da sessão
$idUsuario = isset($_SESSION['usuario']['id']) ? $_SESSION['usuario']['id'] : 'anonimo';

require_once("conexao.php");

// Busca todos os animes para mostrar na área geral (com imagem, nome etc)
$result = $conexao->query("SELECT id, nome, imagem FROM animes_geral ORDER BY criado_em DESC");
$animes = [];
while ($row = $result->fetch_assoc()) {
    $animes[$row['id']] = $row; // índice pelo id para acesso rápido depois
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AnimaXone</title>
  <link rel="stylesheet" href="estilo-site.css" />
  <link rel="stylesheet" href="estilo-menu.css" />
  <style>
    /* Estilo para área assistindo com capas pequenas */
    #area-assistindo {
      background: #222;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 20px;
      box-shadow: 0 0 15px #f9a825;
      color: white;
    }
    #area-assistindo h2 {
      margin-top: 0;
      color: #f9a825;
    }
    .anime-assistindo-item {
      display: inline-block;
      margin: 10px;
      text-align: center;
      width: 100px;
    }
    .anime-assistindo-item img {
      width: 100px;
      height: 140px;
      object-fit: cover;
      border-radius: 5px;
      cursor: pointer;
      box-shadow: 0 0 8px #f9a825;
      transition: transform 0.2s ease;
    }
    .anime-assistindo-item img:hover {
      transform: scale(1.1);
    }
    .btn-continuar, .btn-completado {
      display: block;
      margin: 5px auto 0;
      padding: 5px 10px;
      font-size: 0.9rem;
      border-radius: 4px;
      cursor: pointer;
      border: none;
      width: 90%;
    }
    .btn-continuar {
      background-color: #4caf50;
      color: white;
    }
    .btn-continuar:hover {
      background-color: #45a049;
    }
    .btn-completado {
      background-color: #f44336;
      color: white;
    }
    .btn-completado:hover {
      background-color: #d32f2f;
    }
  </style>
</head>
<body>

  <div class="nome">
    <h1>AnimaXone</h1>
  </div>

  <?php include("./includes/menu.php"); ?>

  <section id="area-assistindo">
    <h2>Animes em andamento</h2>
    <!-- Conteúdo gerado pelo JS -->
  </section>

  <section>
    <h2 class="titulo-sessao">Todos os Animes</h2>
    <div class="animes_assistindo">
      <?php foreach ($animes as $anime): ?>
        <div class="anime-item">
          <a href="anime.php?id=<?php echo $anime['id']; ?>">
            <?php 
              $img = !empty($anime['imagem']) ? htmlspecialchars($anime['imagem']) : 'imagens/padrao.jpg';
              $nome = htmlspecialchars($anime['nome']);
            ?>
            <img src="<?php echo $img; ?>" alt="<?php echo $nome; ?>" />
            <span class="anime-link"><?php echo $nome; ?></span>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

<script>
  const userId = <?= json_encode($idUsuario) ?>;
  const localStorageKey = `animeAssistindo_${userId}`;

  // Mapeia as imagens dos animes para usar no assistindo
  const imagensAnimes = {
    <?php
      foreach ($animes as $a) {
        $id = (int)$a['id'];
        $img = htmlspecialchars($a['imagem'], ENT_QUOTES);
        echo "$id: '$img',\n";
      }
    ?>
  };

  function carregarAssistindo() {
    const json = localStorage.getItem(localStorageKey);
    return json ? JSON.parse(json) : [];
  }

  function salvarAssistindo(lista) {
    localStorage.setItem(localStorageKey, JSON.stringify(lista));
  }

  function removerAssistindo(idAnime) {
    let lista = carregarAssistindo();
    lista = lista.filter(a => a.idAnime !== idAnime);
    salvarAssistindo(lista);
    atualizarAreaAssistindo();
  }

  function atualizarAreaAssistindo() {
    const container = document.getElementById('area-assistindo');
    if (!container) return;

    const lista = carregarAssistindo();
    container.innerHTML = '<h2>Animes em andamento</h2>';

    if (lista.length === 0) {
      container.innerHTML += '<p>Nenhum anime em andamento.</p>';
      return;
    }

    lista.forEach(item => {
      const capa = imagensAnimes[item.idAnime] || 'imagens/padrao.jpg';
      const div = document.createElement('div');
      div.className = 'anime-assistindo-item';
      div.innerHTML = `
        <img src="${capa}" alt="Anime" title="Continuar assistindo Ep ${item.episodio}" />
        <button class="btn-continuar" data-id-ep="${item.idEp}" data-id-anime="${item.idAnime}">Continuar</button>
        <button class="btn-completado" data-id-anime="${item.idAnime}">Anime Completado!</button>
      `;
      container.appendChild(div);
    });

    container.querySelectorAll('.btn-continuar').forEach(btn => {
      btn.onclick = () => {
        const idEp = btn.getAttribute('data-id-ep');
        if (idEp) {
          window.location.href = `ep.php?id=${idEp}`;
        } else {
          alert('Erro: Episódio não encontrado para continuar.');
        }
      };
    });

    container.querySelectorAll('.btn-completado').forEach(btn => {
      btn.onclick = () => {
        const idAnime = btn.getAttribute('data-id-anime');
        removerAssistindo(idAnime);
      };
    });
  }

  document.addEventListener('DOMContentLoaded', atualizarAreaAssistindo);
</script>

</body>
</html>
