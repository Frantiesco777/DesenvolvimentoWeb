<?php
session_start();

// Verifica se admin está logado
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

require_once("conexao.php");

$erro = '';
$sucesso = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recebe os dados do POST com trim
    $nome       = trim($_POST['nome'] ?? '');
    $imagem     = trim($_POST['imagem'] ?? '');
    $genero     = trim($_POST['genero'] ?? '');
    $estudio    = trim($_POST['estudio'] ?? '');
    $subgeneros = trim($_POST['subgeneros'] ?? '');
    $fonte      = trim($_POST['fonte'] ?? '');
    $sinopse    = trim($_POST['sinopse'] ?? '');
    $temporada  = trim($_POST['temporada'] ?? '');
    $episodios  = intval($_POST['episodios'] ?? 0);  // número inteiro

    if (!$nome || !$imagem || !$genero) {
        $erro = "Nome, Imagem e Gênero são obrigatórios.";
    } else {
        $conexao->begin_transaction();

        try {
            // Insere na tabela animes_geral
            $stmtAnime = $conexao->prepare("INSERT INTO animes_geral (nome, imagem, genero) VALUES (?, ?, ?)");
            if (!$stmtAnime) throw new Exception("Erro prepare animes_geral: " . $conexao->error);
            $stmtAnime->bind_param("sss", $nome, $imagem, $genero);
            if (!$stmtAnime->execute()) throw new Exception("Erro execute animes_geral: " . $stmtAnime->error);

            $anime_id = $conexao->insert_id;

            // Insere na tabela informacoes
            $stmtInfo = $conexao->prepare("INSERT INTO informacoes (anime_id, estudio, sub_generos, fonte, sinopse, temporada, episodios) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if (!$stmtInfo) throw new Exception("Erro prepare informacoes: " . $conexao->error);
            $stmtInfo->bind_param("isssssi", $anime_id, $estudio, $subgeneros, $fonte, $sinopse, $temporada, $episodios);
            if (!$stmtInfo->execute()) throw new Exception("Erro execute informacoes: " . $stmtInfo->error);

            $conexao->commit();
            $sucesso = "Anime cadastrado com sucesso!";
        } catch (Exception $e) {
            $conexao->rollback();
            $erro = "Erro ao cadastrar: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Cadastrar Novo Anime</title>
  <style>
    body { background: #121212; color: #fff; font-family: Arial; padding: 30px; }
    h1 { color: #f9a825; }
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
    .box {
        max-width: 700px;
        margin: auto;
        background: #1e1e1e;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px #f9a825;
    }
    .erro { background: #f44336; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
    .sucesso { background: #4caf50; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
  </style>
</head>
<body>
  <div class="box">
    <h1>Cadastro de Novo Anime</h1>

    <?php if ($erro): ?>
      <div class="erro"><?php echo htmlspecialchars($erro); ?></div>
    <?php elseif ($sucesso): ?>
      <div class="sucesso"><?php echo htmlspecialchars($sucesso); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <label>Nome do Anime</label>
      <input type="text" name="nome" required value="<?php echo htmlspecialchars($nome ?? '') ?>" />

      <label>Link da Imagem (URL)</label>
      <input type="text" name="imagem" required value="<?php echo htmlspecialchars($imagem ?? '') ?>" />

      <label>Gênero Principal</label>
      <input type="text" name="genero" required value="<?php echo htmlspecialchars($genero ?? '') ?>" />

      <label>Estúdio</label>
      <input type="text" name="estudio" value="<?php echo htmlspecialchars($estudio ?? '') ?>" />

      <label>Subgêneros (separados por vírgula)</label>
      <input type="text" name="subgeneros" value="<?php echo htmlspecialchars($subgeneros ?? '') ?>" />

      <label>Fonte</label>
      <input type="text" name="fonte" value="<?php echo htmlspecialchars($fonte ?? '') ?>" />

      <label>Sinopse</label>
      <textarea name="sinopse" rows="4"><?php echo htmlspecialchars($sinopse ?? '') ?></textarea>

      <label>Temporada</label>
      <input type="text" name="temporada" value="<?php echo htmlspecialchars($temporada ?? '') ?>" />

      <label>Quantidade de Episódios</label>
      <input type="number" name="episodios" min="1" required value="<?php echo htmlspecialchars($episodios ?? '') ?>" />

      <button type="submit">Cadastrar Anime</button>
    </form>
  </div>
</body>
</html>
