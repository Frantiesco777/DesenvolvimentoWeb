<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once("conexao.php");

// Consulta todos os animes
$sql = $conexao->prepare("SELECT * FROM animes_geral");
$sql->execute();
$result = $sql->get_result();

$animes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $animes[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Todos os Animes - AnimaXone</title>
    <link rel="stylesheet" href="estilo-site.css">
    <link rel="stylesheet" href="estilo-menu.css">
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .anime-card {
            width: 220px;
            margin: 15px;
            text-align: center;
            background-color: #1f1f1f;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.4);
        }

        .anime-card a {
            text-decoration: none;
            color: inherit;
        }

        .anime-card img {
            width: 100%;
            height: 320px;
            object-fit: cover;
            border-radius: 8px;
        }

        .anime-card h3 {
            margin-top: 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <div class="nome">
        <h1>AnimaXone</h1>
    </div>

    <?php include("includes/menu.php"); ?>

    <div class="container">
        <?php foreach ($animes as $anime): ?>
            <div class="anime-card">
                <a href="anime.php?id=<?= $anime['id'] ?>">
                    <img src="<?= htmlspecialchars($anime['imagem']) ?>" alt="Capa de <?= htmlspecialchars($anime['nome']) ?>">
                    <h3><?= htmlspecialchars($anime['nome']) ?></h3>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
