<?php
session_start();
require_once 'conexao.php'; // arquivo que conecta ao banco de dados

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $nova_senha = $_POST['nova_senha'];
    $repetir_senha = $_POST['repetir_senha'];

    // Verifica se os campos foram preenchidos corretamente
    if (empty($email) || empty($nova_senha) || empty($repetir_senha)) {
        $_SESSION['erro'] = "Preencha todos os campos.";
        header("Location: index.php");
        exit;
    }

    if ($nova_senha !== $repetir_senha) {
        $_SESSION['erro'] = "As senhas não coincidem.";
        header("Location: index.php");
        exit;
    }

    // Verifica se o e-mail existe
    $stmt = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        $_SESSION['erro'] = "Email não encontrado.";
        header("Location: index.php");
        exit;
    }

    // Atualiza a senha
    $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
    $stmt = $conexao->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
    $stmt->bind_param("ss", $senha_hash, $email);
    
    if ($stmt->execute()) {
        $_SESSION['sucesso'] = "Senha redefinida com sucesso!";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['erro'] = "Erro ao redefinir a senha.";
        header("Location: index.php");
        exit;
    }
}
?>
