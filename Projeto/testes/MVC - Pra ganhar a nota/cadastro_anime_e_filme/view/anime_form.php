<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Anime ou Filme</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Adicionar Novo</h1>
    <form action="../controller/AnimeController.php" method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="text" name="diretor" placeholder="Diretor">
        <input type="text" name="estudio" placeholder="Estúdio">
        <input type="text" name="genero" placeholder="Gênero">
        <input type="text" name="temporada" placeholder="Temporada">
        <select name="tipo">
            <option value="anime">Anime</option>
            <option value="filme">Filme</option>
        </select>
        <input type="number" name="ano_lancamento" placeholder="Ano de Lançamento">
        <input type="text" name="imagem" placeholder="URL da Imagem">
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
