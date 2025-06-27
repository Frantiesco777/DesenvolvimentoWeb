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

// Busca dados principais do anime
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

// Busca informações adicionais
$sqlInfo = $conexao->prepare("SELECT * FROM informacoes WHERE anime_id = ?");
$sqlInfo->bind_param("i", $idAnime);
$sqlInfo->execute();
$resultInfo = $sqlInfo->get_result();

if ($resultInfo->num_rows === 1) {
    $info = $resultInfo->fetch_assoc();
    $temporada = $info['temporada'];
    $sub_generos = $info['sub_generos'];
    $estudio = $info['estudio'];
    $fonte = $info['fonte'];
    $episodios_total = $info['episodios'];
    $sinopse = $info['sinopse'];
} else {
    $temporada = 'Indefinida';
    $sub_generos = 'N/A';
    $estudio = 'Desconhecido';
    $fonte = 'N/A';
    $episodios_total = 'Indefinido';
    $sinopse = 'Sinopse não disponível.';
}

// Busca temporadas e episódios reais do banco (tabela correta: temporadas_animes)
$sqlTemporadas = $conexao->prepare("SELECT id, numero, nome FROM temporadas_animes WHERE anime_id = ? ORDER BY numero ASC");
if (!$sqlTemporadas) {
    die("Erro ao preparar consulta de temporadas: " . $conexao->error);
}
$sqlTemporadas->bind_param("i", $idAnime);
$sqlTemporadas->execute();
$resultTemporadas = $sqlTemporadas->get_result();

$temporadas = [];

// Prepara a query de episódios fora do loop
$sqlEps = $conexao->prepare("SELECT id, numero FROM episodios WHERE temporada_id = ?");
if (!$sqlEps) {
    die("Erro na preparação da consulta de episódios: " . $conexao->error);
}

while ($temp = $resultTemporadas->fetch_assoc()) {
    $temporadaId = $temp['id'];
    $temporadaNome = $temp['nome'] ?: 'Temporada ' . $temp['numero'];

    $sqlEps->bind_param("i", $temporadaId);
    $sqlEps->execute();
    $resultEps = $sqlEps->get_result();

    $episodios = [];
    while ($ep = $resultEps->fetch_assoc()) {
        $titulo = 'Episódio ' . $ep['numero'];
        // Link para ep.php com o id do episódio
        $episodios[$titulo] = "ep.php?id=" . $ep['id'];
    }

    $temporadas[$temporadaNome] = $episodios;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo htmlspecialchars($nome); ?> - AnimaXone</title>
    <link rel="stylesheet" href="estilo-site.css" />
    <link rel="stylesheet" href="estilo-menu.css" />
    <link rel="stylesheet" href="anime.css" />
</head>
<body>

    <div class="nome">
        <h1>AnimaXone</h1>
    </div>

    <?php include("includes/menu.php"); ?>

    <section class="sinopse">
        <div class="container sinopse-content">

            <div class="lado-esquerdo">
                <img src="<?php echo htmlspecialchars($imagem); ?>" alt="Capa de <?php echo htmlspecialchars($nome); ?>">
            </div>

            <div class="lado-direito">
                <div class="titulo">
                    <h2><?php echo htmlspecialchars($nome); ?></h2>
                </div>
                <div class="info-anime">
                    <h3>Informações</h3>
                    <ul>
                        <li><strong>Temporada:</strong> <?php echo htmlspecialchars($temporada); ?></li>
                        <li><strong>Gênero:</strong> <?php echo htmlspecialchars($genero); ?></li>
                        <li><strong>Subgêneros:</strong> <?php echo htmlspecialchars($sub_generos); ?></li>
                        <li><strong>Estúdio:</strong> <?php echo htmlspecialchars($estudio); ?></li>
                        <li><strong>Fonte:</strong> <?php echo htmlspecialchars($fonte); ?></li>
                        <li><strong>Episódios:</strong> <?php echo htmlspecialchars($episodios_total); ?></li>
                    </ul>
                </div>
            </div>

            <div class="texto-sinopse">
                <h2>Sinopse:</h2>
                <p><?php echo nl2br(htmlspecialchars($sinopse)); ?></p>
            </div>

        </div>

        <style>
/* Estilo CHAMATIVO para botões de temporadas */
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

/* Estilo CHAMATIVO para os botões de episódios */
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
// Mostrar ou ocultar episódios ao clicar no botão
document.querySelectorAll('.temporada-toggle').forEach(button => {
    button.addEventListener('click', function () {
        const ul = this.nextElementSibling;
        ul.style.display = ul.style.display === 'block' ? 'none' : 'block';
    });
});
</script>


</body>
</html>
