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

function getAnimesByCategory($conn, $categoria) {
    $categoria = $conn->real_escape_string($categoria);
    $sql = "SELECT * FROM animes WHERE categoria='$categoria' ORDER BY criado_em DESC";
    $result = $conn->query($sql);
    $animes = [];
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $animes[] = $row;
        }
    }
    return $animes;
}

$animesAssistindo = getAnimesByCategory($conn, 'assistindo');
$animesEmBreve = getAnimesByCategory($conn, 'em_breve');

$todosAnimes = $conn->query("SELECT * FROM animes");
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

  <!-- Seção: Você está assistindo -->
  <section>
    <h2 class="titulo-sessao">Você está assistindo</h2>
    <div class="animes_assistindo">
      <?php foreach($animesAssistindo as $anime): ?>
        <div class="anime-item">
          <a href="anime.php?id=<?php echo $anime['id']; ?>">
            <img src="<?php echo htmlspecialchars($anime['imagem']); ?>" alt="<?php echo htmlspecialchars($anime['nome']); ?>" />
            <span class="anime-link"><?php echo htmlspecialchars($anime['nome']); ?></span>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Seção: Em breve -->
  <section>
    <h2 class="titulo-sessao">Animes em Breve</h2>
    <div class="animes-em-breve">
      <?php foreach($animesEmBreve as $anime): ?>
        <div class="anime-item">
          <a href="anime.php?id=<?php echo $anime['id']; ?>">
            <img src="<?php echo htmlspecialchars($anime['imagem']); ?>" alt="<?php echo htmlspecialchars($anime['nome']); ?>" />
            <span class="anime-link"><?php echo htmlspecialchars($anime['nome']); ?></span>
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
