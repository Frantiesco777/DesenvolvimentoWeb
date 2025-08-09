<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$host = "localhost";
$db   = "animexone";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM animes_geral WHERE genero='comedia' ORDER BY criado_em DESC";
$result = $conn->query($sql);

$animesComedia = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $animesComedia[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Animes Comédia - AnimaXone</title>

  <link rel="stylesheet" href="estilo-site.css" />
  <link rel="stylesheet" href="estilo-menu.css" />
</head>
<body>

  <div class="nome">
    <h1>AnimaXone</h1>
  </div>

  <?php include("./includes/menu.php"); ?>

  <section>
    <h2 class="titulo-sessao">Gênero: Comédia</h2>
    <div class="animes_assistindo">
      <?php if (count($animesComedia) > 0): ?>
        <?php foreach($animesComedia as $anime): ?>
          <div class="anime-item">
            <a href="anime.php?id=<?php echo $anime['id']; ?>">
              <img src="<?php echo htmlspecialchars($anime['imagem']); ?>" alt="<?php echo htmlspecialchars($anime['nome']); ?>" />
              <span class="anime-link"><?php echo htmlspecialchars($anime['nome']); ?></span>
            </a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="color: #ccc; text-align: center;">Nenhum anime de comédia encontrado.</p>
      <?php endif; ?>
    </div>
  </section>

  <script src="script-site.js"></script>
  <script src="script-menu.js"></script>
</body>
</html>

<?php
$conn->close();
?>
