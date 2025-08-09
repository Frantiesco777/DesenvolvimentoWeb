<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

require_once("conexao.php");

$erro = '';
$sucesso = '';

// Cadastrar anime
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'])) {
    $tipo          = trim($_POST['formato'] ?? 'anime');  // Valor do select tipo
    $nome          = trim($_POST['nome'] ?? '');
    $imagem        = trim($_POST['imagem'] ?? '');
    $genero        = trim($_POST['genero'] ?? '');
    $estudio       = trim($_POST['estudio'] ?? '');
    $subgeneros    = trim($_POST['subgeneros'] ?? '');
    $fonte         = trim($_POST['fonte'] ?? '');
    $sinopse       = trim($_POST['sinopse'] ?? '');
    $temporada     = trim($_POST['temporada'] ?? '');
    $ano_lancamento = trim($_POST['ano_lancamento'] ?? '');
    $diretor       = trim($_POST['diretor'] ?? '');

    if ($tipo === 'filme') {
        $erro = "Para cadastrar filmes, utilize o formulário específico: <a href='cadastro_filme.php' style='color:#f9a825; font-weight:bold;'>Cadastro de Filme</a>";
    } else {
        if (!$nome || !$imagem || !$genero) {
            $erro = 'Por favor, preencha pelo menos Nome, Imagem e Gênero.';
        } else {
            // Verificar se anime já existe
            $stmtCheck = $conexao->prepare("SELECT id FROM animes_geral WHERE nome = ?");
            $stmtCheck->bind_param("s", $nome);
            $stmtCheck->execute();
            $resultadoCheck = $stmtCheck->get_result();

            if ($resultadoCheck->num_rows > 0) {
                $erro = "Já existe um anime cadastrado com o nome '$nome'.";
                $stmtCheck->close();
            } else {
                $stmtCheck->close();

                $stmt1 = $conexao->prepare("INSERT INTO animes_geral (nome, imagem, genero) VALUES (?, ?, ?)");
                $stmt1->bind_param("sss", $nome, $imagem, $genero);

                if ($stmt1->execute()) {
                    $idAnime = $stmt1->insert_id;
                    $stmt1->close();

                    $stmt2 = $conexao->prepare("INSERT INTO informacoes (anime_id, estudio, sub_generos, fonte, sinopse, temporada, ano_lancamento, diretor) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt2->bind_param("isssssss", $idAnime, $estudio, $subgeneros, $fonte, $sinopse, $temporada, $ano_lancamento, $diretor);

                    if ($stmt2->execute()) {
                        $sucesso = "Anime '$nome' cadastrado com sucesso!";
                    } else {
                        $erro = "Erro ao cadastrar informações adicionais: " . $stmt2->error;
                    }
                    $stmt2->close();
                } else {
                    $erro = "Erro ao cadastrar anime: " . $stmt1->error;
                }
            }
        }
    }
}

// Remover anime
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remover_nome'])) {
    $nomeRemover = trim($_POST['remover_nome']);

    if (!$nomeRemover) {
        $erro = "Informe o nome exato do anime para remoção.";
    } else {
        // Primeiro buscar o ID do anime para remover dados relacionados
        $stmtBusca = $conexao->prepare("SELECT id FROM animes_geral WHERE nome = ?");
        $stmtBusca->bind_param("s", $nomeRemover);
        $stmtBusca->execute();
        $resultadoBusca = $stmtBusca->get_result();

        if ($resultadoBusca->num_rows === 0) {
            $erro = "Anime '$nomeRemover' não encontrado.";
        } else {
            $row = $resultadoBusca->fetch_assoc();
            $idAnimeRemover = $row['id'];

            $stmtBusca->close();

            // Remover episódios relacionados
            $stmtDelEps = $conexao->prepare("
                DELETE e FROM episodios e
                JOIN temporadas_animes t ON e.temporada_id = t.id
                WHERE t.anime_id = ?
            ");
            $stmtDelEps->bind_param("i", $idAnimeRemover);
            $stmtDelEps->execute();
            $stmtDelEps->close();

            // Remover temporadas relacionadas
            $stmtDelTemp = $conexao->prepare("DELETE FROM temporadas_animes WHERE anime_id = ?");
            $stmtDelTemp->bind_param("i", $idAnimeRemover);
            $stmtDelTemp->execute();
            $stmtDelTemp->close();

            // Remover informações relacionadas
            $stmtDelInfo = $conexao->prepare("DELETE FROM informacoes WHERE anime_id = ?");
            $stmtDelInfo->bind_param("i", $idAnimeRemover);
            $stmtDelInfo->execute();
            $stmtDelInfo->close();

            // Finalmente remover o anime
            $stmtDelAnime = $conexao->prepare("DELETE FROM animes_geral WHERE id = ?");
            $stmtDelAnime->bind_param("i", $idAnimeRemover);

            if ($stmtDelAnime->execute()) {
                $sucesso = "Anime '$nomeRemover' removido com sucesso.";
            } else {
                $erro = "Erro ao remover anime: " . $stmtDelAnime->error;
            }
            $stmtDelAnime->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Cadastrar ou Remover Anime</title>
  <style>
    body { background: #121212; color: #fff; font-family: Arial; padding: 30px; }
    h1, h2 { color: #f9a825; }
    input, textarea, select {
        width: 100%; padding: 10px; margin: 5px 0 15px;
        border: none; border-radius: 5px;
        background: #222; color: #eee;
    }
    button {
        padding: 10px 20px;
        background-color: #4caf50;
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
    }
    .remove-button {
        background-color: #e53935;
        margin-top: 10px;
    }
    .catalago-link {
        float: right;
        background-color: #fbc02d;
        color: #000;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }
    .box {
        max-width: 700px;
        margin: auto;
        background: #1e1e1e;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px #f9a825;
        position: relative;
    }
    .erro { background: #f44336; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
    .sucesso { background: #4caf50; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
    .btn-cadastrar-filme {
      display: inline-block;
      background-color: #f9a825;
      color: #121212;
      padding: 10px 20px;
      border-radius: 5px;
      font-weight: bold;
      text-decoration: none;
      margin-bottom: 20px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="box">
    <a href="cadastro_filme.php" class="btn-cadastrar-filme">Cadastrar Filme</a>
    <a href="catalago.php" class="catalago-link">Catálago de Animes</a>
    <h1>Cadastro de Novo Anime</h1>

    <?php if ($erro): ?>
      <div class="erro"><?= $erro ?></div>
    <?php elseif ($sucesso): ?>
      <div class="sucesso"><?= $sucesso ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <label>Tipo</label>
      <select name="formato" required>
        <option value="anime" <?= (isset($_POST['formato']) && $_POST['formato'] === 'anime') ? 'selected' : '' ?>>Anime</option>
        <option value="filme" <?= (isset($_POST['formato']) && $_POST['formato'] === 'filme') ? 'selected' : '' ?>>Filme</option>
      </select>

      <label>Nome do Anime</label>
      <input type="text" name="nome" required value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">

      <label>Link da Imagem (URL)</label>
      <input type="text" name="imagem" required value="<?= htmlspecialchars($_POST['imagem'] ?? '') ?>">

      <label>Gênero Principal</label>
      <input type="text" name="genero" required value="<?= htmlspecialchars($_POST['genero'] ?? '') ?>">

      <label>Estúdio</label>
      <input type="text" name="estudio" value="<?= htmlspecialchars($_POST['estudio'] ?? '') ?>">

      <label>Subgêneros (separados por vírgula)</label>
      <input type="text" name="subgeneros" value="<?= htmlspecialchars($_POST['subgeneros'] ?? '') ?>">

      <label>Fonte</label>
      <input type="text" name="fonte" value="<?= htmlspecialchars($_POST['fonte'] ?? '') ?>">

      <label>Sinopse</label>
      <textarea name="sinopse" rows="4"><?= htmlspecialchars($_POST['sinopse'] ?? '') ?></textarea>

      <label>Temporada (ex: Verão 2025)</label>
      <input type="text" name="temporada" value="<?= htmlspecialchars($_POST['temporada'] ?? '') ?>">

      <label>Ano de Lançamento</label>
      <input type="text" name="ano_lancamento" placeholder="Ex: 2025" value="<?= htmlspecialchars($_POST['ano_lancamento'] ?? '') ?>">

      <label>Diretor</label>
      <input type="text" name="diretor" value="<?= htmlspecialchars($_POST['diretor'] ?? '') ?>">

      <button type="submit">Cadastrar Anime</button>
    </form>

    <hr style="margin: 40px 0; border: 1px solid #555;">

    <h2>Remover Anime</h2>
    <form method="POST" action="">
      <label>Nome exato do Anime a ser removido:</label>
      <input type="text" name="remover_nome" required>
      <button type="submit" class="remove-button">Remover Anime</button>
    </form>
  </div>
</body>
</html>
