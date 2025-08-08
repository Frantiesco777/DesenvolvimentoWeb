<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$msg = $_GET['msg'] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Cadastro de Anime/Filme</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Cadastro de Anime ou Filme</h1>

    <?php if ($msg === '1'): ?>
        <p class="sucesso">Cadastrado com sucesso!</p>
    <?php elseif ($msg === '0'): ?>
        <p class="erro">Erro ao cadastrar. Verifique o log do servidor.</p>
    <?php elseif ($msg === '3'): ?>
        <p class="sucesso">Registro removido com sucesso!</p>
    <?php elseif ($msg === '4'): ?>
        <p class="erro">Erro ao remover registro.</p>
    <?php endif; ?>

    <form action="../controller/AnimeController.php" method="POST" autocomplete="off">
        <label>Nome*</label>
        <input type="text" name="nome" required>

        <label>Diretor</label>
        <input type="text" name="diretor">

        <label>Estúdio</label>
        <input type="text" name="estudio">

        <label>Gênero</label>
        <input type="text" name="genero">

        <label>Temporada</label>
        <input type="text" name="temporada">

        <label>Tipo</label>
        <select name="tipo" required>
            <option value="" disabled selected>Selecione o tipo</option>
            <option value="anime">Anime</option>
            <option value="filme">Filme</option>
        </select>

        <label>Ano de Lançamento</label>
        <input type="number" name="ano_lancamento" min="1900" max="2099">

        <button type="submit">Cadastrar</button>
    </form>

    <hr>
    <a href="listar.php">Ver lista completa</a>
</div>
</body>
</html>
