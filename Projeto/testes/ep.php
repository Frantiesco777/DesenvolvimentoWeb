<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once("conexao.php");

$idEp = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($idEp <= 0) {
    echo "Episódio inválido.";
    exit;
}

// Buscando dados do episódio (sem pegar o conteúdo binário aqui)
$sql = $conexao->prepare("SELECT e.id, e.numero, t.nome AS temporada_nome, a.nome AS anime_nome, t.anime_id
                         FROM episodios e
                         INNER JOIN temporadas_animes t ON e.temporada_id = t.id
                         INNER JOIN animes_geral a ON t.anime_id = a.id
                         WHERE e.id = ?");
if (!$sql) {
    die("Erro na consulta: " . $conexao->error);
}
$sql->bind_param("i", $idEp);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows !== 1) {
    echo "Episódio não encontrado.";
    exit;
}

$ep = $result->fetch_assoc();

$idEp = $ep['id'];
$numero = $ep['numero'];
$titulo = "Episódio " . $numero;
$temporada = $ep['temporada_nome'];
$anime = $ep['anime_nome'];
$animeId = $ep['anime_id'];

// Pega id do usuário para localStorage (se quiser manter a funcionalidade)
$idUsuario = isset($_SESSION['usuario']['id']) ? $_SESSION['usuario']['id'] : 'anonimo';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($anime) ?> - <?= htmlspecialchars($titulo) ?></title>
    <style>
        body {
            background: #121212;
            color: #eee;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0; padding: 0 20px;
            display: flex; flex-direction: column; align-items: center;
        }
        h1, h2 {
            color: #f9a825;
            text-shadow: 1px 1px 5px #000;
        }
        .player {
            margin: 20px 0;
            max-width: 900px;
            width: 100%;
            box-shadow: 0 0 25px #f9a825;
            border-radius: 10px;
            overflow: hidden;
            background-color: #222;
            padding: 15px;
        }
        video {
            width: 100%;
            height: auto;
            border-radius: 8px;
            background-color: black;
        }
        a {
            color: #f9a825;
            text-decoration: none;
            margin-top: 30px;
        }
        a:hover {
            text-decoration: underline;
        }
        .botoes-ep {
            margin: 20px 0;
            display: flex;
            gap: 15px;
        }
        .botoes-ep button {
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 12px 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .botoes-ep button:hover {
            background-color: #45a049;
        }
        .botoes-ep button.remover {
            background-color: #f44336;
        }
        .botoes-ep button.remover:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($anime) ?></h1>
    <h2><?= htmlspecialchars($temporada) ?> - <?= htmlspecialchars($titulo) ?></h2>

    <div class="player">
        <video controls>
            <source src="episodio_video.php?id=<?= urlencode($idEp) ?>" type="video/mp4" />
            Seu navegador não suporta vídeo HTML5.
        </video>
    </div>

    <div class="botoes-ep">
        <button id="btnAssistir">Assistir Depois!</button>
        <button id="btnCompletar" class="remover">Anime Completado!</button>
    </div>

    <a href="anime.php?id=<?= urlencode($animeId) ?>">&#8592; Voltar para anime</a>

<script>
  const userId = <?= json_encode($idUsuario) ?>;
  const localStorageKey = `animeAssistindo_${userId}`;

  const animeId = <?= json_encode($animeId) ?>;
  const epId = <?= json_encode($idEp) ?>;
  const epNumero = <?= json_encode($numero) ?>;

  function carregarAssistindo() {
    const json = localStorage.getItem(localStorageKey);
    return json ? JSON.parse(json) : [];
  }

  function salvarAssistindo(lista) {
    localStorage.setItem(localStorageKey, JSON.stringify(lista));
  }

  document.getElementById('btnAssistir').addEventListener('click', () => {
    let lista = carregarAssistindo();

    const index = lista.findIndex(a => a.idAnime === animeId);

    const animeObj = {
      idAnime: animeId,
      idEp: epId,
      episodio: epNumero
    };

    if (index !== -1) {
      lista[index] = animeObj;
    } else {
      lista.push(animeObj);
    }

    salvarAssistindo(lista);
    alert(`Marcado para assistir depois: Ep ${epNumero}`);
  });

  document.getElementById('btnCompletar').addEventListener('click', () => {
    let lista = carregarAssistindo();
    lista = lista.filter(a => a.idAnime !== animeId);
    salvarAssistindo(lista);
    alert(`Anime removido da lista de assistindo.`);
  });
</script>
</body>
</html>
