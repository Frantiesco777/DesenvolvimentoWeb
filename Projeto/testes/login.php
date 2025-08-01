<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'email' => $usuario['email'],
                // Se não tiver imagem no DB, usa padrão
                'imagem_perfil' => !empty($usuario['imagem_perfil']) ? $usuario['imagem_perfil'] : 'imagens/usuario_padrao.jpg'
            ];

            if ($usuario['email'] === 'admin@admin.com') {
                header("Location: cadastro.php");
            } else {
                header("Location: site.php");
            }
            exit;
        } else {
            $_SESSION['erro'] = "Senha incorreta";
            header("Location: index.php");
            exit;
        }
    } else {
        $_SESSION['erro'] = "Usuário não encontrado";
        header("Location: index.php");
        exit;
    }
} else {
    $_SESSION['erro'] = "Requisição inválida";
    header("Location: index.php");
    exit;
}
?>
