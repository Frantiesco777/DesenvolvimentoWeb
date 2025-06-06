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
            $_SESSION['usuario'] = $usuario['nome'];
            header("Location: site.php");
            exit;
        } else {
            $_SESSION['erro'] = "Senha incorreta";
            $_SESSION['showLogin'] = true;  // sinaliza para abrir login normal
            header("Location: index.php");
            exit;
        }
    } else {
        $_SESSION['erro'] = "Usuário não encontrado";
        $_SESSION['showLogin'] = true;
        header("Location: index.php");
        exit;
    }
}
?>
