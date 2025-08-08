<?php
require_once(__DIR__ . '/../config/conexao.php');

class Usuario {
    public static function registrar($dados) {
        global $conn;

        $nome = $dados['nome'] ?? '';
        $email = $dados['email'] ?? '';
        $senha = $dados['senha'] ?? '';

        if (!$nome || !$email || !$senha) {
            return false;
        }

        $sql = "SELECT id FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) return false;
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->close();
            return false;
        }
        $stmt->close();

        $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) return false;
        $stmt->bind_param("sss", $nome, $email, $hashSenha);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }

    public static function login($email, $senha) {
        global $conn;

        $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) return false;
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows === 0) {
            $stmt->close();
            return false;
        }
        $user = $res->fetch_assoc();
        $stmt->close();

        if (password_verify($senha, $user['senha'])) {
            return ['id' => $user['id'], 'nome' => $user['nome']];
        }
        return false;
    }
}
