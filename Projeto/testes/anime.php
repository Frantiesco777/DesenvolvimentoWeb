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

// Consulta o anime no banco
$sql = $conexao->prepare("SELECT * FROM animes WHERE id = ?");
$sql->bind_param("i", $idAnime);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows !== 1) {
    echo "Anime não encontrado.";
    exit;
}

$anime = $result->fetch_assoc();

// Exemplo: Dados extras do anime
// Para deixar o layout flexível, você pode guardar info extra como JSON no banco
// tipo: temporada, estúdio, audio, episodios, status, ano, sinopse
// Aqui vou simular puxando essas infos direto do array (você pode ajustar o DB pra ter essas colunas)
$temporada = $anime['temporada'] ?? 'Verão';
$estudio = $anime['estudio'] ?? 'TMS Entertainment';
$audio = $anime['audio'] ?? 'Dublado';
$episodios = $anime['episodios'] ?? '24';
$status = $anime['status'] ?? 'Completo';
$ano = $anime['ano'] ?? '2019';
$sinopse = $anime['sinopse'] ?? 'Sinopse não disponível.';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo htmlspecialchars($anime['nome']); ?> - AnimaXone</title>
    <link rel="stylesheet" href="estilo-site.css" />
    <link rel="stylesheet" href="estilo-menu.css" />
    <link rel="stylesheet" href="anime.css" /> <!-- Seu CSS estilo Dr Stone -->
</head>
<body>

    <div class="nome">
        <h1>AnimaXone</h1>
    </div>

    <?php include("includes/menu.php"); ?>

    <section class="sinopse">
        <div class="container sinopse-content">
        
            <div class="lado-esquerdo">
                <img src="<?php echo htmlspecialchars($anime['imagem']); ?>" alt="Capa de <?php echo htmlspecialchars($anime['nome']); ?>">
            </div>

            <div class="lado-direito">
                <div class="titulo">
                    <h2><?php echo htmlspecialchars($anime['nome']); ?></h2>
                </div>
                <div class="info-anime">
                    <h3>Informações</h3>
                    <ul>
                        <li><strong>Temporada:</strong> <?php echo htmlspecialchars($temporada); ?></li>
                        <li><strong>Estúdios:</strong> <?php echo htmlspecialchars($estudio); ?></li>
                        <li><strong>Áudio:</strong> <?php echo htmlspecialchars($audio); ?></li>
                        <li><strong>Episódios:</strong> <?php echo htmlspecialchars($episodios); ?></li>
                        <li><strong>Status do Anime:</strong> <?php echo htmlspecialchars($status); ?></li>
                        <li><strong>Ano:</strong> <?php echo htmlspecialchars($ano); ?></li>
                    </ul>
                </div>
            </div>

            <div class="texto-sinopse">
                <h2>Sinopse:</h2>
                <p><?php echo nl2br(htmlspecialchars($sinopse)); ?></p>
            </div>

        </div>

        <section class="temporadas">
            <h2>Temporadas</h2>
            <div class="temporada">
                <input type="checkbox" id="temp1" hidden>
                <label for="temp1" class="temporada-title">Temporada 1</label>
                <ul class="episodios">
                    <?php
                    // Supondo que você tenha os episódios em JSON ou outro campo no banco
                    // Aqui um exemplo estático, mas você pode puxar do banco e iterar:
                    $episodiosLinks = [
                        ["ep" => 1, "link" => "Temporada1/eps/ep_1.html"],
                        ["ep" => 2, "link" => "Temporada1/eps/ep_2.html"],
                        ["ep" => 3, "link" => "Temporada1/eps/ep_3.html"],
                        // ... etc
                    ];
                    foreach ($episodiosLinks as $ep) {
                        echo '<li><a href="'.htmlspecialchars($ep['link']).'">Episódio '.$ep['ep'].'</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </section>

    </section>

</body>
</html>
