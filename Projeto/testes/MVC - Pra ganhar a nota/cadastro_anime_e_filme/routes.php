<?php
// routes.php

$requestUri = $_SERVER['REQUEST_URI'];
$scriptName = dirname($_SERVER['SCRIPT_NAME']); // ex: /Projeto/public ou /public

// Remove caminho base do script
$path = substr($requestUri, strlen($scriptName));
$path = parse_url($path, PHP_URL_PATH); // Remove query string
$path = trim($path, '/');

var_dump($path,$requestUri);
die();

switch ($path) {
    case '':
    case 'index.php':
    case 'login':
        require __DIR__ . '/public/index.php';  // Tela de login
        break;
    case 'cadastro.php':
    case 'cadastro':
        require __DIR__ . '/public/cadastro.php';  // Formulário cadastro anime/filme
        break;
    case 'registrar.php':
    case 'registrar':
        require __DIR__ . '/public/registrar.php'; // Registrar usuário
        break;
    case 'listar.php':
    case 'listar':
        require __DIR__ . '/public/listar.php'; // Listagem anime/filme
        break;
    case 'logout.php':
    case 'logout':
        require __DIR__ . '/public/logout.php'; // Logout
        break;
    default:
        http_response_code(404);
        echo "<h1>404 - Página não encontrada</h1>";
        break;
}
