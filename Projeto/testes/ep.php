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

$sql = $conexao->prepare("SELECT e.numero, e.link, t.nome AS temporada_nome, a.nome AS anime_nome, t.anime_id
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

$numero = $ep['numero'];
$link = $ep['link'];
$titulo = "Episódio " . $numero;
$temporada = $ep['temporada_nome'];
$anime = $ep['anime_nome'];
$animeId = $ep['anime_id'];
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
        }
        iframe, video {
            width: 100%;
            height: 500px;
            border: none;
        }
        .descricao {
            max-width: 900px;
            background: #222;
            border-radius: 10px;
            padding: 15px 20px;
            box-shadow: 0 0 15px #f9a825;
            font-size: 1.1rem;
            line-height: 1.5;
        }
        a {
            color: #f9a825;
            text-decoration: none;
            margin-top: 30px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($anime) ?></h1>
    <h2><?= htmlspecialchars($temporada) ?> - <?= htmlspecialchars($titulo) ?></h2>

    <div class="player">
        <?php
        // Exibe o vídeo — se for link externo ou local
        if (strpos($link, '<iframe') !== false) {
            echo $link; // iframe completo salvo no DB
        } elseif (filter_var($link, FILTER_VALIDATE_URL)) {
            echo "<iframe src='" . htmlspecialchars($link) . "' allowfullscreen></iframe>";
        } else {
            echo "<video controls src='" . htmlspecialchars($link) . "'></video>";
        }
        ?>
    </div>

    <a href="anime.php?id=<?= urlencode($animeId) ?>">&#8592; Voltar para anime</a>
</body>
</html>
