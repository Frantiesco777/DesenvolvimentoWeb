<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

require_once("conexao.php");

$erro = '';
$sucesso = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tipo = trim($_POST['tipo'] ?? 'filme');

    if ($tipo === 'anime') {
        // Redireciona para cadastro de anime
        header("Location: cadastro.php");
        exit;
    }

    // Processo normal de cadastro de filme
    $nome         = trim($_POST['nome'] ?? '');
    $imagem       = trim($_POST['imagem'] ?? '');
    $formato      = trim($_POST['formato'] ?? '');
    $estudio      = trim($_POST['estudio'] ?? '');
    $diretor      = trim($_POST['diretor'] ?? '');
    $duracao      = intval($_POST['duracao'] ?? 0);
    $ano_lanc     = intval($_POST['ano_lancamento'] ?? 0);
    $subgeneros   = trim($_POST['subgeneros'] ?? '');
    $fonte        = trim($_POST['fonte'] ?? '');
    $sinopse      = trim($_POST['sinopse'] ?? '');

    if (!$nome || !$imagem || !$formato) {
        $erro = "Preencha os campos obrigatórios (Nome, Imagem e Formato).";
    } else {
        // Verificar se o filme já existe pelo nome
        $checkStmt = $conexao->prepare("SELECT id FROM filmes WHERE nome = ?");
        $checkStmt->bind_param("s", $nome);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $erro = "Filme com esse nome já existe no sistema.";
        } else {
            try {
                $stmt = $conexao->prepare("INSERT INTO filmes (nome, imagem, formato, estudio, diretor, duracao, ano_lancamento, sub_generos, fonte, sinopse) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssiisss", $nome, $imagem, $formato, $estudio, $diretor, $duracao, $ano_lanc, $subgeneros, $fonte, $sinopse);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    $sucesso = "Filme cadastrado com sucesso!";
                } else {
                    $erro = "Erro ao cadastrar filme.";
                }

                $stmt->close();
            } catch (Exception $e) {
                $erro = "Erro no banco de dados: " . $e->getMessage();
            }
        }

        $checkStmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Cadastro de Filme - AnimeXone</title>
  <style>
    body { background: #121212; color: #fff; font-family: Arial, sans-serif; padding: 30px; }
    h1 { color: #f9a825; }
    input, textarea, select {
        width: 100%; padding: 10px; margin: 5px 0 15px;
        border: none; border-radius: 5px;
        background: #222; color: #eee;
    }
    button {
        padding: 10px 20px;
        background-color: #f9a825;
        border: none;
        color: #121212;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
    }
    .erro { background: #f44336; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
    .sucesso { background: #4caf50; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
    .voltar-link {
      display: inline-block;
      margin-top: 20px;
      color: #f9a825;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
  <script>
    function verificarTipo(value) {
      if (value === 'anime') {
        window.location.href = 'cadastro.php';
      }
    }
  </script>
</head>
<body>

  <h1>Cadastrar Novo Filme</h1>

  <?php if ($erro): ?>
    <div class="erro"><?= htmlspecialchars($erro) ?></div>
  <?php elseif ($sucesso): ?>
    <div class="sucesso"><?= htmlspecialchars($sucesso) ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <label>Tipo</label>
    <select name="tipo" onchange="verificarTipo(this.value)">
      <option value="filme" <?= (isset($_POST['tipo']) && $_POST['tipo'] === 'filme') ? 'selected' : '' ?>>Filme</option>
      <option value="anime" <?= (isset($_POST['tipo']) && $_POST['tipo'] === 'anime') ? 'selected' : '' ?>>Anime</option>
    </select>

    <label>Nome do Filme</label>
    <input type="text" name="nome" required value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">

    <label>Link da Imagem (URL)</label>
    <input type="text" name="imagem" required value="<?= htmlspecialchars($_POST['imagem'] ?? '') ?>">

    <label>Estúdio</label>
    <input type="text" name="estudio" value="<?= htmlspecialchars($_POST['estudio'] ?? '') ?>">

    <label>Diretor</label>
    <input type="text" name="diretor" value="<?= htmlspecialchars($_POST['diretor'] ?? '') ?>">

    <label>Duração (minutos)</label>
    <input type="number" name="duracao" min="1" step="1" value="<?= htmlspecialchars($_POST['duracao'] ?? '') ?>">

    <label>Ano de Lançamento</label>
    <input type="number" name="ano_lancamento" min="1888" max="2100" value="<?= htmlspecialchars($_POST['ano_lancamento'] ?? '') ?>">

    <label>Subgêneros (separados por vírgula)</label>
    <input type="text" name="subgeneros" value="<?= htmlspecialchars($_POST['subgeneros'] ?? '') ?>">

    <label>Fonte</label>
    <input type="text" name="fonte" value="<?= htmlspecialchars($_POST['fonte'] ?? '') ?>">

    <label>Sinopse</label>
    <textarea name="sinopse" rows="4"><?= htmlspecialchars($_POST['sinopse'] ?? '') ?></textarea>

    <button type="submit">Cadastrar Filme</button>
  </form>

  <a href="catalago.php" class="voltar-link">← Voltar ao Catálogo</a>

</body>
</html>
