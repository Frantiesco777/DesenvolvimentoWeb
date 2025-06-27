<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

require_once("conexao.php");

$erro = '';
$sucesso = '';

// Cadastro
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nome'])) {
    $nome       = trim($_POST['nome'] ?? '');
    $imagem     = trim($_POST['imagem'] ?? '');
    $genero     = trim($_POST['genero'] ?? '');
    $estudio    = trim($_POST['estudio'] ?? '');
    $subgeneros = trim($_POST['subgeneros'] ?? '');
    $fonte      = trim($_POST['fonte'] ?? '');
    $sinopse    = trim($_POST['sinopse'] ?? '');
    $temporada  = trim($_POST['temporada'] ?? '');

    if (!$nome || !$imagem || !$genero) {
        $erro = "Preencha todos os campos obrigatórios.";
    } else {
        try {
            $conexao->begin_transaction();

            $stmtAnime = $conexao->prepare("INSERT INTO animes_geral (nome, imagem, genero) VALUES (?, ?, ?)");
            $stmtAnime->bind_param("sss", $nome, $imagem, $genero);
            $stmtAnime->execute();
            $anime_id = $conexao->insert_id;

            $episodios_total = 0;

            $stmtInfo = $conexao->prepare("INSERT INTO informacoes (anime_id, estudio, sub_generos, fonte, sinopse, temporada, episodios) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmtInfo->bind_param("isssssi", $anime_id, $estudio, $subgeneros, $fonte, $sinopse, $temporada, $episodios_total);
            $stmtInfo->execute();

            $conexao->commit();
            $sucesso = "Anime cadastrado com sucesso!";
        } catch (Exception $e) {
            $conexao->rollback();
            $erro = "Erro ao cadastrar: " . $e->getMessage();
        }
    }
}

// Remoção
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['remover_nome'])) {
    $nomeRemover = trim($_POST['remover_nome']);

    if ($nomeRemover === '') {
        $erro = "Informe o nome do anime para remover.";
    } else {
        try {
            $conexao->begin_transaction();

            $stmtBusca = $conexao->prepare("SELECT id FROM animes_geral WHERE nome = ?");
            $stmtBusca->bind_param("s", $nomeRemover);
            $stmtBusca->execute();
            $resultado = $stmtBusca->get_result();

            if ($resultado->num_rows === 0) {
                throw new Exception("Anime não encontrado.");
            }

            $anime = $resultado->fetch_assoc();
            $animeId = $anime['id'];

            // Deletar informações
            $stmtDelInfo = $conexao->prepare("DELETE FROM informacoes WHERE anime_id = ?");
            $stmtDelInfo->bind_param("i", $animeId);
            $stmtDelInfo->execute();

            // Deletar anime
            $stmtDelAnime = $conexao->prepare("DELETE FROM animes_geral WHERE id = ?");
            $stmtDelAnime->bind_param("i", $animeId);
            $stmtDelAnime->execute();

            $conexao->commit();
            $sucesso = "Anime \"$nomeRemover\" removido com sucesso!";
        } catch (Exception $e) {
            $conexao->rollback();
            $erro = "Erro ao remover: " . $e->getMessage();
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
    input, textarea {
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
  </style>
</head>
<body>
  <div class="box">
    <a href="catalago.php" class="catalago-link">Catálago de Animes</a>
    <h1>Cadastro de Novo Anime</h1>

    <?php if ($erro): ?>
      <div class="erro"><?= htmlspecialchars($erro) ?></div>
    <?php elseif ($sucesso): ?>
      <div class="sucesso"><?= htmlspecialchars($sucesso) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <label>Nome do Anime</label>
      <input type="text" name="nome" required>

      <label>Link da Imagem (URL)</label>
      <input type="text" name="imagem" required>

      <label>Gênero Principal</label>
      <input type="text" name="genero" required>

      <label>Estúdio</label>
      <input type="text" name="estudio">

      <label>Subgêneros (separados por vírgula)</label>
      <input type="text" name="subgeneros">

      <label>Fonte</label>
      <input type="text" name="fonte">

      <label>Sinopse</label>
      <textarea name="sinopse" rows="4"></textarea>

      <label>Temporada (ex: Verão 2025)</label>
      <input type="text" name="temporada">

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
