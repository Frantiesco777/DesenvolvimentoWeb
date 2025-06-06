<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se email já existe, etc. (opcional)

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senhaHash);

    if ($stmt->execute()) {
        $_SESSION['sucesso'] = "Cadastro realizado com sucesso!";
        $_SESSION['email_cadastrado'] = $email; // guarda email para preencher login
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['erro'] = "Erro ao cadastrar usuário.";
        header("Location: index.php");
        exit;
    }
}
?>
