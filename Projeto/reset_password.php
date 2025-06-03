<?php
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $novaSenha = $_POST['nova_senha'] ?? '';
    $repetirSenha = $_POST['repetir_senha'] ?? '';

    if ($email && $novaSenha && $repetirSenha) {
        if ($novaSenha === $repetirSenha) {
            $hash = password_hash($novaSenha, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET senha = ? WHERE email = ?");
            $stmt->execute([$hash, $email]);
            echo "Senha redefinida com sucesso!";
        } else {
            echo "As senhas não coincidem.";
        }
    } else {
        echo "Preencha todos os campos.";
    }
}
?>
