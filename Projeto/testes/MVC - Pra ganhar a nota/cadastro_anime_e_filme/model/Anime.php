<?php
require_once(__DIR__ . '/../config/conexao.php');

class Anime {
    public static function listarTodos() {
        global $conn;
        $sql = "SELECT * FROM animes ORDER BY nome ASC";
        return $conn->query($sql);
    }

    public static function inserir($dados) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO animes (nome, diretor, estudio, genero, temporada, tipo, ano_lancamento, imagem) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssis", $dados['nome'], $dados['diretor'], $dados['estudio'], $dados['genero'], $dados['temporada'], $dados['tipo'], $dados['ano_lancamento'], $dados['imagem']);
        return $stmt->execute();
    }
}
?>
