<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once("conexao.php");

// Pega o id do anime pela URL
$idAnime = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($idAnime <= 0) {
    echo "Anime inválido.";
    exit;
}

// Consulta o anime na tabela animes_geral
$sql = $conexao->prepare("SELECT * FROM animes_geral WHERE id = ?");
$sql->bind_param("i", $idAnime);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows !== 1) {
    echo "Anime não encontrado.";
    exit;
}

$anime = $result->fetch_assoc();

// Pegando os campos da tabela
$nome = $anime['nome'];
$imagem = $anime['imagem'];
$temporada = $anime['temporada'];
$genero = $anime['genero'];
$sub_generos = $anime['sub_generos'] ?? 'N/A';
$estudio = $anime['estudio'] ?? 'Desconhecido';
$fonte = $anime['fonte'] ?? 'N/A';
$episodios = $anime['episodios'] ?? 'Indefinido';
$sinopse = $anime['sinopse'] ?? 'Sinopse não disponível.';
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
                        <li><strong>Episódios:</strong> <?php echo htmlspecialchars($episodios); ?></li>
                    </ul>
                </div>
            </div>

            <div class="texto-sinopse">
                <h2>Sinopse:</h2>
                <p><?php echo nl2br(htmlspecialchars($sinopse)); ?></p>
            </div>

        </div>
    </section>

</body>
</html>
