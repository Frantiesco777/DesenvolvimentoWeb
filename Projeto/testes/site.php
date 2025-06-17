<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Conexão com o banco
$host = "localhost";
$db   = "animexone";
$user = "root";
$pass = "";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8mb4");

// Consulta todos os animes
$result = $conn->query("SELECT * FROM animes_geral ORDER BY criado_em DESC");
$animes = [];
while ($row = $result->fetch_assoc()) {
    $animes[] = $row;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AnimaXone</title>

  <link rel="stylesheet" href="estilo-site.css" />
  <link rel="stylesheet" href="estilo-menu.css" />
  <link href="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.css" rel="stylesheet"/>
</head>
<body>

  <div class="nome">
    <h1>AnimaXone</h1>
  </div>

  <?php include("./includes/menu.php"); ?>

  <!-- Seção: Todos os Animes -->
  <section>
    <h2 class="titulo-sessao">Todos os Animes</h2>
    <div class="animes_assistindo">
      <?php foreach ($animes as $anime): ?>
        <div class="anime-item">
          <a href="anime.php?id=<?php echo $anime['id']; ?>">
            <?php 
              $img = !empty($anime['imagem']) ? htmlspecialchars($anime['imagem']) : 'imagens/padrao.jpg';
              $nome = htmlspecialchars($anime['nome']);
            ?>
            <img src="<?php echo $img; ?>" alt="<?php echo $nome; ?>" />
            <span class="anime-link"><?php echo $nome; ?></span>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <script src="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.js"></script>
  <script src="script-site.js"></script>
  <script src="script-menu.js"></script>
</body>
</html>

<?php
if ($conn instanceof mysqli && $conn->ping()) {
    $conn->close();
}
?>
