<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Configurações do banco
$host = "localhost";
$db   = "animexone";
$user = "root";
$pass = "";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Dados padrão para visitante
$usuario = [
    "nome" => "Visitante",
    "email" => "",
    "imagem_perfil" => "imagens/usuario_padrao.jpg"
];

// Verifica se usuário está logado
if (isset($_SESSION['usuario']['id'])) {
    $usuarioId = $_SESSION['usuario']['id'];

    $sql = $conn->prepare("SELECT nome, email, imagem_perfil FROM usuarios WHERE id = ?");
    $sql->bind_param("i", $usuarioId);
    $sql->execute();
    $resultado = $sql->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $usuarioDB = $resultado->fetch_assoc();

        // Ajusta o caminho da imagem para URL acessível
        $imagemPerfil = $usuarioDB['imagem_perfil'];

        // Se imagem não iniciar com http ou /, ajusta caminho base conforme seu projeto
        if (!preg_match('/^(http|\/)/i', $imagemPerfil)) {
            // Ajuste o caminho base aqui para a pasta raiz do seu projeto no servidor
            $imagemPerfil = '/Fran/DesenvolvimentoWeb/Projeto/testes/' . $imagemPerfil;
        }

        $usuario = [
            "nome" => $usuarioDB['nome'],
            "email" => $usuarioDB['email'],
            "imagem_perfil" => $imagemPerfil
        ];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Menu AnimeXone</title>

<link href="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="estilo-site.css" />
</head>
<body>

<header>
  <div class="menu-container">
    <nav class="navegacao">
      <div class="links-menu">

        <div class="user-profile dropdown" id="userProfile">
          <div class="user-info" tabindex="0">
            <img src="<?php echo htmlspecialchars($usuario['imagem_perfil']); ?>" alt="Foto do usuário" id="userImage" class="user-image" />
            <span id="userName"><?php echo htmlspecialchars($usuario['nome']); ?></span>
          </div>
          <div class="submenu user-submenu">
            <p id="userEmail"><?php echo htmlspecialchars($usuario['email']); ?></p>
            <?php if (isset($_SESSION['usuario']['id'])): ?>
            <form method="POST" action="logout.php" style="margin:0;">
              <button type="submit" id="logoutBtn" class="btn-logout">Logout</button>
            </form>
            <button id="editProfileBtn" class="btn-edit-profile">Editar perfil</button>
            <?php else: ?>
            <a href="index.php">Login</a>
            <?php endif; ?>
          </div>
        </div>

        <a href="site.php">Home</a>
        <a href="./generos/lancamentos.php">Lançamentos</a>
        <a href="./filmes.php">Filmes</a>
        <a href="./mangas.php">Mangás</a>
        <a href="./generos/assinatura.php">Assinatura</a>

        <div class="dropdown">
          <a href="">Gênero</a>
          <div class="submenu">
            <a href="./shounen.php">Shounen</a>
            <a href="./comedia.php">Comédia</a>
            <a href="./romance.php">Romance</a>
            <a href="./seinen.php">Seinen</a>
            <a href="./generos/mecha.php">Mecha</a>
            <a href="./generos/terror.php">Terror</a>
            <a href="./generos/isekai.php">Isekai</a>
          </div>
        </div>
      </div>

      <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Buscar anime...">
        <button onclick="buscarAnime()">🔍</button>
      </div>
    </nav>
  </div>

  <!-- Modal de edição de perfil -->
  <div id="editProfileModal" class="modal" style="display: none;">
    <div class="modal-content">
      <span class="close" id="closeModalBtn">&times;</span>
      <h2>Editar Perfil</h2>
      <form id="editProfileForm" method="POST" action="atualizar_perfil.php" enctype="multipart/form-data">
        <label for="editName">Nome:</label>
        <input type="text" id="editName" name="editName" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>

        <label for="editEmail">Email:</label>
        <input type="email" id="editEmail" name="editEmail" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>

        <label for="editImage">Imagem de Perfil:</label>
        <input type="file" id="editImage" name="editImage" accept="image/*">

        <!-- Container onde será mostrado e cortado a imagem -->
        <div style="margin-top: 15px; max-width: 100%;">
          <img id="imageCropper" style="max-width: 100%; display: none; border-radius: 12px;"/>
        </div>

        <!-- Campo escondido para salvar a imagem cortada em base64 -->
        <input type="hidden" name="croppedImage" id="croppedImage">

        <button type="submit" class="btn-save-profile" style="margin-top: 20px;">Salvar</button>
      </form>
    </div>
  </div>
</header>

<script src="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.js"></script>
<script src="script-menu.js"></script>

</body>
</html>
