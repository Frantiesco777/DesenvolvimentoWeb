<?php
session_start();

// Destroi todas as variáveis da sessão
$_SESSION = [];

// Destroi a sessão
session_destroy();

// Redireciona para a página de login ou homepage
header("Location: index.php"); // ou "login.php", dependendo do seu sistema
exit;
