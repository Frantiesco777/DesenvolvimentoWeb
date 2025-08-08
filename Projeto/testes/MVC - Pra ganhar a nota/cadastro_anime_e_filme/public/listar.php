<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php"); // redireciona para login (novo index.php)
    exit;
}

// Chama o controller para carregar dados em $animes e $filmes
require_once(__DIR__ . '/../controller/AnimeController.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Lista de Animes e Filmes</title>
    <link rel="stylesheet" href="css/style-listar.css" />
</head>
<body>
    <a href="cadastro.php" class="btn-novo">+ Novo Cadastro</a>
    <div class="container">
        <section>
            <h2>Animes (<?= count($animes) ?>)</h2>
            <?php if (count($animes) === 0): ?>
                <p>Nenhum anime cadastrado.</p>
            <?php else: ?>
                <ul class="cards">
                    <?php foreach ($animes as $anime): ?>
                        <li class="card">
                            <strong><?= htmlspecialchars($anime['nome']) ?></strong><br>
                            Tipo: <?= htmlspecialchars($anime['tipo']) ?> — Ano: <?= htmlspecialchars($anime['ano_lancamento']) ?><br>
                            Gênero: <?= htmlspecialchars($anime['genero']) ?><br>
                            Estúdio: <?= htmlspecialchars($anime['estudio']) ?>

                            <form action="../controller/AnimeController.php" method="POST" style="margin-top:10px;">
                                <input type="hidden" name="acao" value="excluir" />
                                <input type="hidden" name="nome" value="<?= htmlspecialchars($anime['nome']) ?>" />
                                <button type="submit" onclick="return confirm('Confirma exclusão de <?= addslashes(htmlspecialchars($anime['nome'])) ?>?')">Excluir</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>

        <section>
            <h2>Filmes (<?= count($filmes) ?>)</h2>
            <?php if (count($filmes) === 0): ?>
                <p>Nenhum filme cadastrado.</p>
            <?php else: ?>
                <ul class="cards">
                    <?php foreach ($filmes as $filme): ?>
                        <li class="card">
                            <strong><?= htmlspecialchars($filme['nome']) ?></strong><br>
                            Tipo: <?= htmlspecialchars($filme['tipo']) ?> — Ano: <?= htmlspecialchars($filme['ano_lancamento']) ?><br>
                            Gênero: <?= htmlspecialchars($filme['genero']) ?><br>
                            Estúdio: <?= htmlspecialchars($filme['estudio']) ?>

                            <form action="../controller/AnimeController.php" method="POST" style="margin-top:10px;">
                                <input type="hidden" name="acao" value="excluir" />
                                <input type="hidden" name="nome" value="<?= htmlspecialchars($filme['nome']) ?>" />
                                <button type="submit" onclick="return confirm('Confirma exclusão de <?= addslashes(htmlspecialchars($filme['nome'])) ?>?')">Excluir</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
