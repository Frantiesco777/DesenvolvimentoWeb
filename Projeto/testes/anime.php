<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once("conexao.php");

$idAnime = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($idAnime <= 0) {
    echo "Anime inválido.";
    exit;
}

// Buscar dados do anime
$sql = $conexao->prepare("SELECT * FROM animes_geral WHERE id = ?");
$sql->bind_param("i", $idAnime);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows !== 1) {
    echo "Anime não encontrado.";
    exit;
}

$anime = $result->fetch_assoc();
$nome = $anime['nome'];
$imagem = $anime['imagem'];
$genero = $anime['genero'];

// Buscar informações adicionais incluindo diretor e ano_lancamento
$sqlInfo = $conexao->prepare("SELECT * FROM informacoes WHERE anime_id = ?");
$sqlInfo->bind_param("i", $idAnime);
$sqlInfo->execute();
$resultInfo = $sqlInfo->get_result();

if ($resultInfo->num_rows === 1) {
    $info = $resultInfo->fetch_assoc();
    $temporada = $info['temporada'] ?? 'Indefinida';
    $sub_generos = $info['sub_generos'] ?? 'N/A';
    $estudio = $info['estudio'] ?? 'Desconhecido';
    $fonte = $info['fonte'] ?? 'N/A';
    $sinopse = $info['sinopse'] ?? 'Sinopse não disponível.';
    $diretor = $info['diretor'] ?? 'Desconhecido';
    $ano_lancamento = $info['ano_lancamento'] ?? 'Indefinido';
} else {
    $temporada = 'Indefinida';
    $sub_generos = 'N/A';
    $estudio = 'Desconhecido';
    $fonte = 'N/A';
    $sinopse = 'Sinopse não disponível.';
    $diretor = 'Desconhecido';
    $ano_lancamento = 'Indefinido';
}

// Buscar total de episódios reais do anime
$sqlTotalEps = $conexao->prepare("
    SELECT COUNT(e.id) as total_episodios
    FROM episodios e
    JOIN temporadas_animes t ON e.temporada_id = t.id
    WHERE t.anime_id = ?
");
$sqlTotalEps->bind_param("i", $idAnime);
$sqlTotalEps->execute();
$resultTotalEps = $sqlTotalEps->get_result();

if ($resultTotalEps && $resultTotalEps->num_rows > 0) {
    $rowTotalEps = $resultTotalEps->fetch_assoc();
    $episodios = $rowTotalEps['total_episodios'];
} else {
    $episodios = 0;
}

// Buscar temporadas e episódios
$temporadas = [];
$sqlTemporadas = $conexao->prepare("SELECT id, numero, nome FROM temporadas_animes WHERE anime_id = ? ORDER BY numero ASC");
$sqlTemporadas->bind_param("i", $idAnime);
$sqlTemporadas->execute();
$resultTemporadas = $sqlTemporadas->get_result();

while ($temp = $resultTemporadas->fetch_assoc()) {
    $temporadaId = $temp['id'];
    $temporadaNome = $temp['nome'] ?: 'Temporada ' . $temp['numero'];

    $stmtEps = $conexao->prepare("SELECT id, numero FROM episodios WHERE temporada_id = ? ORDER BY numero ASC");
    $stmtEps->bind_param("i", $temporadaId);
    $stmtEps->execute();
    $resultEps = $stmtEps->get_result();

    $listaEpisodios = [];
    while ($ep = $resultEps->fetch_assoc()) {
        $titulo = 'Episódio ' . $ep['numero'];
        $listaEpisodios[$titulo] = "ep.php?id=" . $ep['id'];
    }

    $temporadas[$temporadaNome] = $listaEpisodios;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($nome) ?> - AnimaXone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilo-site.css">
    <link rel="stylesheet" href="estilo-menu.css">
    <link rel="stylesheet" href="anime.css">
    <style>
        .temporada-toggle {
            background: linear-gradient(135deg, #ff4081, #ff1744);
            color: #fff;
            font-weight: bold;
            font-size: 1.2rem;
            border: none;
            padding: 12px 20px;
            margin-bottom: 10px;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            text-align: left;
            box-shadow: 0 0 15px rgba(255, 64, 129, 0.7);
            transition: all 0.3s ease;
        }
        .temporada-toggle:hover {
            background: linear-gradient(135deg, #ff80ab, #f50057);
            box-shadow: 0 0 25px rgba(255, 64, 129, 1);
        }
        .episodios li a {
            display: inline-block;
            padding: 10px 18px;
            background: linear-gradient(135deg, #00e5ff, #00b0ff);
            color: #000;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 5px;
            box-shadow: 0 0 10px rgba(0, 229, 255, 0.6);
        }
        .episodios li a:hover {
            background: linear-gradient(135deg, #18ffff, #00e5ff);
            box-shadow: 0 0 18px rgba(0, 229, 255, 1);
            color: #111;
        }
    </style>
</head>
<body>

<div class="nome">
    <h1>AnimaXone</h1>
</div>

<?php include("includes/menu.php"); ?>

<section class="sinopse">
    <div class="container sinopse-content">
        <div class="lado-esquerdo">
            <img src="<?= htmlspecialchars($imagem) ?>" alt="Capa de <?= htmlspecialchars($nome) ?>">
        </div>
        <div class="lado-direito">
            <div class="titulo">
                <h2><?= htmlspecialchars($nome) ?></h2>
            </div>
            <div class="info-anime">
                <h3>Informações</h3>
                <ul>
                    <li><strong>Temporada:</strong> <?= htmlspecialchars($temporada) ?></li>
                    <li><strong>Gênero:</strong> <?= htmlspecialchars($genero) ?></li>
                    <li><strong>Subgêneros:</strong> <?= htmlspecialchars($sub_generos) ?></li>
                    <li><strong>Estúdio:</strong> <?= htmlspecialchars($estudio) ?></li>
                    <li><strong>Diretor:</strong> <?= htmlspecialchars($diretor) ?></li>
                    <li><strong>Ano de Lançamento:</strong> <?= htmlspecialchars($ano_lancamento) ?></li>
                    <li><strong>Fonte:</strong> <?= htmlspecialchars($fonte) ?></li>
                    <li><strong>Total de Episódios:</strong> <?= htmlspecialchars($episodios) ?></li>
                </ul>
            </div>
        </div>
        <div class="texto-sinopse">
            <h2>Sinopse:</h2>
            <p><?= nl2br(htmlspecialchars($sinopse)) ?></p>
        </div>
    </div>
</section>

<section class="temporadas">
    <div class="container">
        <h2>Temporadas</h2>
        <?php $primeira = true; ?>
        <?php foreach ($temporadas as $nomeTemporada => $eps): ?>
            <div class="temporada">
                <button class="temporada-toggle"><?= htmlspecialchars($nomeTemporada) ?></button>
                <ul class="episodios" style="display: <?= $primeira ? 'block' : 'none' ?>;">
                    <?php foreach ($eps as $nomeEp => $linkEp): ?>
                        <li><a href="<?= htmlspecialchars($linkEp) ?>"><?= htmlspecialchars($nomeEp) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php $primeira = false; ?>
        <?php endforeach; ?>
    </div>
</section>

<script>
document.querySelectorAll('.temporada-toggle').forEach(button => {
    button.addEventListener('click', function () {
        const ul = this.nextElementSibling;
        ul.style.display = ul.style.display === 'block' ? 'none' : 'block';
    });
});
</script>

</body>
</html>
