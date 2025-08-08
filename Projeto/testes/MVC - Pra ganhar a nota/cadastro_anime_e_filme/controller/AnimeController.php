<?php
// controller/AnimeController.php

// NÃO chame session_start() aqui! Sessão já iniciada em public/*

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../public/index.php");
    exit;
}

require_once(__DIR__ . '/../model/Anime.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao']) && $_POST['acao'] === 'excluir' && !empty($_POST['nome'])) {
        $nomeParaExcluir = trim($_POST['nome']);
        $ok = Anime::excluirPorNome($nomeParaExcluir);
        if ($ok) {
            header("Location: ../public/listar.php?msg=3");
        } else {
            header("Location: ../public/listar.php?msg=4");
        }
        exit;
    } else {
        // Inserção
        $dados = [
            'nome' => trim($_POST['nome'] ?? ''),
            'diretor' => trim($_POST['diretor'] ?? ''),
            'estudio' => trim($_POST['estudio'] ?? ''),
            'genero' => trim($_POST['genero'] ?? ''),
            'temporada' => trim($_POST['temporada'] ?? ''),
            'tipo' => trim($_POST['tipo'] ?? 'anime'),
            'ano_lancamento' => !empty($_POST['ano_lancamento']) ? trim($_POST['ano_lancamento']) : null
        ];

        if ($dados['nome'] === '') {
            header("Location: ../public/cadastro.php?msg=0&erro=nome_vazio");
            exit;
        }

        $ok = Anime::inserir($dados);
        if ($ok) {
            header("Location: ../public/cadastro.php?msg=1");
        } else {
            header("Location: ../public/cadastro.php?msg=0&erro=erro_insercao");
        }
        exit;
    }
}

// Se chegar via GET ou outro método, carregue os dados para listar.php
$result = Anime::listarTodos();

$animes = [];
$filmes = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['tipo'] === 'anime') {
            $animes[] = $row;
        } elseif ($row['tipo'] === 'filme') {
            $filmes[] = $row;
        }
    }
}
// Quem inclui a view/lista usa $animes e $filmes
