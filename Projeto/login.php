<?php
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($email && $senha) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha'])) {
            echo "Login bem-sucedido!";
            // Aqui você pode iniciar uma sessão, redirecionar, etc.
        } else {
            echo "Email ou senha inválidos!";
        }
    } else {
        echo "Preencha todos os campos.";
    }
}
?>
