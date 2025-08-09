<?php
session_start();
require_once __DIR__ . '/../app/config/config.php';

$mensagem = "";

// Cadastro no banco
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome          = trim($_POST['nome']);
    $estudio       = trim($_POST['estudio']);
    $diretor       = trim($_POST['diretor']);
    $temporada     = trim($_POST['temporada']);
    $genero        = trim($_POST['genero']);
    $tipo          = trim($_POST['tipo']);
    $ano_lancamento = trim($_POST['ano_lancamento']);

    if (!empty($nome) && !empty($tipo)) {
        $stmt = $conn->prepare("INSERT INTO cadastro (nome, estudio, diretor, temporada, genero, tipo, ano_lancamento) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $nome, $estudio, $diretor, $temporada, $genero, $tipo, $ano_lancamento);
        if ($stmt->execute()) {
            $mensagem = "Cadastro realizado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar.";
        }
        $stmt->close();
    } else {
        $mensagem = "Preencha todos os campos obrigatórios.";
    }
}

$nomeUsuario = $_SESSION['usuario_nome'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel de Cadastro</title>
    <link rel="stylesheet" href="css/main.css"> <!-- CSS geral atualizado -->
</head>
<body>
<header>
    <div class="user-bar">
        Olá, <?php echo htmlspecialchars($nomeUsuario); ?> |
        <a href="logout.php" class="logout-btn">Sair</a>
    </div>
</header>

<main>
    <h1>Cadastro de Animes e Filmes</h1>

    <a href="listar.php" class="btn-listar">Ver Animes e Filmes</a>

    <?php if (!empty($mensagem)) echo "<p class='mensagem'>$mensagem</p>"; ?>

    <form method="POST" class="form-cadastro">
        <label>Nome*</label>
        <input type="text" name="nome" required>

        <label>Estúdio</label>
        <input type="text" name="estudio">

        <label>Diretor</label>
        <input type="text" name="diretor">

        <label>Temporada</label>
        <input type="text" name="temporada">

        <label>Gênero</label>
        <input type="text" name="genero">

        <label>Tipo*</label>
        <select name="tipo" required>
            <option value="">Selecione</option>
            <option value="Anime">Anime</option>
            <option value="Filme">Filme</option>
        </select>

        <label>Ano de Lançamento</label>
        <input type="number" name="ano_lancamento" min="1900" max="2100">

        <button type="submit">Cadastrar</button>
    </form>
</main>
</body>
</html>
