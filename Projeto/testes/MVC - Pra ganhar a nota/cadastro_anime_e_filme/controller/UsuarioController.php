<?php
session_start();
require_once(__DIR__ . '/../model/Usuario.php');

$acao = $_POST['acao'] ?? '';

if ($acao === 'registrar') {
    $dados = [
        'nome' => trim($_POST['nome'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'senha' => $_POST['senha'] ?? ''
    ];
    $ok = Usuario::registrar($dados);
    if ($ok) {
        header("Location: ../public/index.php?msg=registro_sucesso");
    } else {
        header("Location: ../public/registrar.php?msg=erro_registro");
    }
    exit;
} elseif ($acao === 'login') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $user = Usuario::login($email, $senha);
    if ($user) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nome'] = $user['nome'];
        header("Location: ../public/cadastro.php");
    } else {
        header("Location: ../public/index.php?msg=erro_login");
    }
    exit;
} else {
    header("Location: ../public/index.php");
    exit;
}
