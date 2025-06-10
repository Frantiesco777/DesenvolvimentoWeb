<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = "localhost";
$db   = "animexone";
$user = "root";
$pass = "";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$usuarioSessao = $_SESSION['usuario'] ?? null;

if (!$usuarioSessao) {
    die("Usuário não autenticado.");
}

if (isset($_POST['editName'], $_POST['editEmail'])) {
    $novoNome = $_POST['editName'];
    $novoEmail = $_POST['editEmail'];

    $imagemPerfil = null;

    // Verifica se foi enviado arquivo de imagem
    if (isset($_FILES['editImage']) && $_FILES['editImage']['error'] === UPLOAD_ERR_OK) {
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
        $arquivoTmp = $_FILES['editImage']['tmp_name'];
        $nomeOriginal = $_FILES['editImage']['name'];
        $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

        if (in_array($extensao, $extensoesPermitidas)) {
            $novoNomeArquivo = uniqid('perfil_', true) . '.' . $extensao;
            $pastaUploads = 'uploads/';

            // Cria pasta uploads se não existir
            if (!is_dir($pastaUploads)) {
                mkdir($pastaUploads, 0755, true);
            }

            $destino = $pastaUploads . $novoNomeArquivo;

            if (move_uploaded_file($arquivoTmp, $destino)) {
                $imagemPerfil = $destino; // caminho para salvar no DB
            } else {
                echo "Erro ao mover arquivo de imagem.";
            }
        } else {
            echo "Tipo de arquivo não permitido. Use jpg, png ou gif.";
        }
    }

    // Atualiza os dados no banco
    if ($imagemPerfil) {
        $sql = $conn->prepare("UPDATE usuarios SET nome = ?, email = ?, imagem_perfil = ? WHERE nome = ?");
        $sql->bind_param("ssss", $novoNome, $novoEmail, $imagemPerfil, $usuarioSessao);
    } else {
        $sql = $conn->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE nome = ?");
        $sql->bind_param("sss", $novoNome, $novoEmail, $usuarioSessao);
    }

    if ($sql->execute()) {
        $_SESSION['usuario'] = $novoNome; // Atualiza nome na sessão
        header("Location: site.php?perfil=atualizado");
        exit;
    } else {
        echo "Erro ao atualizar perfil.";
    }
} else {
    echo "Dados inválidos.";
}

$conn->close();
?>
