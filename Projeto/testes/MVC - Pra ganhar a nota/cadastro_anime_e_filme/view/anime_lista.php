<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Animes e Filmes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Cadastro de Animes e Filmes</h1>
    <a href="anime_form.php">+ Novo</a>
    <div class="lista">
        <?php if ($animes->num_rows > 0): ?>
            <ul>
                <?php while ($anime = $animes->fetch_assoc()): ?>
                    <li>
                        <strong><?= htmlspecialchars($anime['nome']) ?></strong> - <?= $anime['tipo'] ?> (<?= $anime['ano_lancamento'] ?>)
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum anime/filme cadastrado.</p>
        <?php endif; ?>
    </div>
</body>
</html>
