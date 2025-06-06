<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<?php
// site.php

// Configurações do banco de dados
$host = "localhost";
$db   = "animexone";
$user = "root";       // ajuste seu usuário do MySQL
$pass = "";           // ajuste sua senha do MySQL

// Conexão com banco de dados
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Consulta os animes por categoria
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

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  
  <title>AnimaXone</title>

  <!-- CSS principal -->
  <link rel="stylesheet" href="estilo-site.css" />

  <!-- Cropper CSS (para edição da imagem de perfil) -->
  <link href="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.css" rel="stylesheet"/>
</head>
<body>

  <div class="nome">
    <h1>AnimaXone</h1>
  </div>

  <!-- Inclui o menu (com o header e perfil) -->
  <?php include("./includes/menu.php"); ?>

  <div>
    <nav class="assistindo">
      <h2>VOCÊ ESTÁ ASSISTINDO</h2>
    </nav>
    <div class="animes_assistindo">
      <?php foreach($animesAssistindo as $anime): ?>
        <div class="anime-item">
          <img src="<?php echo htmlspecialchars($anime['imagem']); ?>" alt="<?php echo htmlspecialchars($anime['nome']); ?>" data-anime="<?php echo htmlspecialchars($anime['nome']); ?>" />
          <a href="<?php echo htmlspecialchars($anime['link']); ?>" class="anime-link"><?php echo htmlspecialchars($anime['nome']); ?></a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <nav>
    <h2 class="titulo-sessao">Animes em Breve</h2>
  </nav>
  <div class="animes-em-breve">
    <?php foreach($animesEmBreve as $anime): ?>
      <div class="anime-item">
        <img src="<?php echo htmlspecialchars($anime['imagem']); ?>" alt="<?php echo htmlspecialchars($anime['nome']); ?>" data-anime="<?php echo htmlspecialchars($anime['nome']); ?>" />
        <a href="<?php echo htmlspecialchars($anime['link']); ?>" class="anime-link"><?php echo htmlspecialchars($anime['nome']); ?></a>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Scripts JS -->
  <!-- Cropper JS (precisa carregar antes do seu script-site.js que usa ele) -->
  <script src="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.js"></script>
  <script src="script-site.js"></script>
</body>
</html>

<?php
$conn->close();
?>
