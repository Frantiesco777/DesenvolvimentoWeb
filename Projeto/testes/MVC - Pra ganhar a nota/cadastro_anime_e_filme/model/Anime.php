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

        $sql = "INSERT INTO animes (nome, diretor, estudio, genero, temporada, tipo, ano_lancamento)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            return false;
        }

        $nome = $dados['nome'] ?? null;
        $diretor = $dados['diretor'] ?? null;
        $estudio = $dados['estudio'] ?? null;
        $genero = $dados['genero'] ?? null;
        $temporada = $dados['temporada'] ?? null;
        $tipo = $dados['tipo'] ?? 'anime';
        $ano = !empty($dados['ano_lancamento']) ? (int)$dados['ano_lancamento'] : null;

        $types = "ssssssi";

        $stmt->bind_param($types, $nome, $diretor, $estudio, $genero, $temporada, $tipo, $ano);

        $res = $stmt->execute();
        if (!$res) {
            error_log("Execute failed: " . $stmt->error);
        }
        $stmt->close();
        return $res;
    }

    public static function excluirPorNome($nome) {
        global $conn;

        $sql = "DELETE FROM animes WHERE nome = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            return false;
        }

        $stmt->bind_param("s", $nome);
        $res = $stmt->execute();

        if (!$res) {
            error_log("Execute failed: " . $stmt->error);
        }

        $stmt->close();
        return $res;
    }
}
