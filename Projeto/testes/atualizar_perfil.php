<?php
session_start();
if (!isset($_SESSION['usuario']['id'])) {
    die("Usuário não autenticado.");
}

$host = "localhost";
$db   = "animexone";
$user = "root";
$pass = "";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$usuarioId = $_SESSION['usuario']['id'];

if (isset($_POST['editName'], $_POST['editEmail'])) {
    $novoNome = $_POST['editName'];
    $novoEmail = $_POST['editEmail'];

    $imagemPerfil = null;

    // Verifica se veio imagem no upload
    if (isset($_FILES['editImage']) && $_FILES['editImage']['error'] === UPLOAD_ERR_OK) {
        $arquivoTmp = $_FILES['editImage']['tmp_name'];
        $nomeOriginal = $_FILES['editImage']['name'];
        $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($extensao, $extensoesPermitidas)) {
            die("Tipo de imagem não permitido.");
        }

        // Cria pasta uploads se não existir
        $pastaUploads = 'uploads/';
        if (!is_dir($pastaUploads)) {
            mkdir($pastaUploads, 0755, true);
        }

        // Gera nome único para a imagem
        $novoNomeArquivo = uniqid('perfil_', true) . '.' . $extensao;
        $destino = $pastaUploads . $novoNomeArquivo;

        if (move_uploaded_file($arquivoTmp, $destino)) {
            $imagemPerfil = $destino;
        } else {
            die("Erro ao salvar arquivo de imagem.");
        }
    }

    if ($imagemPerfil !== null) {
        $sql = $conn->prepare("UPDATE usuarios SET nome = ?, email = ?, imagem_perfil = ? WHERE id = ?");
        $sql->bind_param("sssi", $novoNome, $novoEmail, $imagemPerfil, $usuarioId);
    } else {
        $sql = $conn->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
        $sql->bind_param("ssi", $novoNome, $novoEmail, $usuarioId);
    }

    if ($sql->execute()) {
        $_SESSION['usuario']['nome'] = $novoNome;
        $_SESSION['usuario']['email'] = $novoEmail;

        if ($imagemPerfil !== null) {
            $_SESSION['usuario']['imagem_perfil'] = $imagemPerfil;
        }

        header("Location: site.php?perfil=atualizado");
        exit;
    } else {
        echo "Erro ao atualizar perfil: " . $sql->error;
    }
} else {
    echo "Dados inválidos.";
}

$conn->close();
?>
