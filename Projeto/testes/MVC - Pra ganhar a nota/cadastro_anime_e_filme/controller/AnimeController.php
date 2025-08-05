<?php
require_once(__DIR__ . '/../model/Anime.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'nome'           => $_POST['nome'],
        'diretor'        => $_POST['diretor'],
        'estudio'        => $_POST['estudio'],
        'genero'         => $_POST['genero'],
        'temporada'      => $_POST['temporada'],
        'tipo'           => $_POST['tipo'],
        'ano_lancamento' => $_POST['ano_lancamento'],
        'imagem'         => $_POST['imagem']
    ];
    Anime::inserir($dados);
    header("Location: index.php");
    exit;
}

$animes = Anime::listarTodos();
include(__DIR__ . '/../view/anime_lista.php');
?>
