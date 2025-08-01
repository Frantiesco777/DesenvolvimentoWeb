<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

require_once("conexao.php");

$erro = '';
$sucesso = '';

// (Seu código de cadastro/remover anime permanece igual...)

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
    /* Novo estilo para o botão cadastrar filme */
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
    <!-- Botão para ir para cadastro de filme -->
    <a href="cadastro_filme.php" class="btn-cadastrar-filme">Cadastrar Filme</a>

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
