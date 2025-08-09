<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

require_once("conexao.php");

// Funções para contar temporadas e episódios
function contarTemporadas($conexao, $anime_id) {
    $stmt = $conexao->prepare("SELECT COUNT(*) AS total FROM temporadas_animes WHERE anime_id = ?");
    $stmt->bind_param("i", $anime_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $total = 0;
    if ($res && $row = $res->fetch_assoc()) {
        $total = $row['total'];
    }
    $stmt->close();
    return $total;
}

function contarEpisodios($conexao, $anime_id) {
    $stmt = $conexao->prepare("
        SELECT COUNT(e.id) AS total
        FROM episodios e
        JOIN temporadas_animes t ON e.temporada_id = t.id
        WHERE t.anime_id = ?
    ");
    $stmt->bind_param("i", $anime_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $total = 0;
    if ($res && $row = $res->fetch_assoc()) {
        $total = $row['total'];
    }
    $stmt->close();
    return $total;
}

// Processar ações de formulário (adicionar/remover temporada)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['acao'])) {
        $acao = $_POST['acao'];

        if ($acao === 'adicionar_temporada' && !empty($_POST['anime_id']) && !empty($_POST['qtd_eps'])) {
            $anime_id = intval($_POST['anime_id']);
            $qtd_eps = intval($_POST['qtd_eps']);
            if ($qtd_eps > 0) {
                // Obter o próximo número da temporada
                $stmt = $conexao->prepare("SELECT MAX(numero) AS max_num FROM temporadas_animes WHERE anime_id = ?");
                $stmt->bind_param("i", $anime_id);
                $stmt->execute();
                $res = $stmt->get_result();
                $max_num = 0;
                if ($res && $row = $res->fetch_assoc()) {
                    $max_num = intval($row['max_num']);
                }
                $stmt->close();

                $novo_numero = $max_num + 1;
                $nome_temporada = "Temporada $novo_numero";

                // Inserir temporada
                $stmt = $conexao->prepare("INSERT INTO temporadas_animes (anime_id, numero, nome) VALUES (?, ?, ?)");
                $stmt->bind_param("iis", $anime_id, $novo_numero, $nome_temporada);
                if ($stmt->execute()) {
                    $temporada_id = $stmt->insert_id;
                    $stmt->close();

                    // Inserir episódios com número sequencial
                    $stmt = $conexao->prepare("INSERT INTO episodios (temporada_id, numero, conteudo) VALUES (?, ?, ?)");
                    $conteudo_padrao = "Vídeo padrão"; // Ajuste aqui se quiser outro conteúdo padrão
                    for ($i = 1; $i <= $qtd_eps; $i++) {
                        $stmt->bind_param("iis", $temporada_id, $i, $conteudo_padrao);
                        $stmt->execute();
                    }
                    $stmt->close();
                    $_SESSION['msg_sucesso'] = "Temporada adicionada com $qtd_eps episódios.";
                } else {
                    $_SESSION['msg_erro'] = "Erro ao adicionar temporada: " . $stmt->error;
                }
            } else {
                $_SESSION['msg_erro'] = "Quantidade de episódios inválida.";
            }
        }

        if ($acao === 'remover_temporada' && !empty($_POST['temporada_id'])) {
            $temporada_id = intval($_POST['temporada_id']);

            // Remover episódios da temporada
            $stmt = $conexao->prepare("DELETE FROM episodios WHERE temporada_id = ?");
            $stmt->bind_param("i", $temporada_id);
            $stmt->execute();
            $stmt->close();

            // Remover temporada
            $stmt = $conexao->prepare("DELETE FROM temporadas_animes WHERE id = ?");
            $stmt->bind_param("i", $temporada_id);
            if ($stmt->execute()) {
                $_SESSION['msg_sucesso'] = "Temporada removida com sucesso.";
            } else {
                $_SESSION['msg_erro'] = "Erro ao remover temporada: " . $stmt->error;
            }
            $stmt->close();
        }

        // Redirecionar para evitar resubmissão do formulário
        header("Location: catalago.php");
        exit;
    }
}

// Consulta para buscar animes com estúdio, formato, diretor e ano_lancamento na tabela informacoes
$sqlAnimes = "
    SELECT a.id, a.nome, a.genero, i.estudio, i.formato, i.diretor, i.ano_lancamento
    FROM animes_geral a
    LEFT JOIN informacoes i ON a.id = i.anime_id
    ORDER BY a.nome ASC
";
$animes = $conexao->query($sqlAnimes);

// Consulta para buscar filmes
$sqlFilmes = "
    SELECT id, nome, diretor, ano_lancamento, formato, estudio
    FROM filmes
    ORDER BY nome ASC
";
$filmes = $conexao->query($sqlFilmes);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<title>Catálogo de Animes e Filmes</title>
<style>
    body { background: #121212; color: #fff; font-family: Arial, sans-serif; padding: 20px; }
    table { width: 100%; border-collapse: collapse; background-color: #1e1e1e; box-shadow: 0 0 10px #f9a825; }
    th, td { padding: 12px; border: 1px solid #333; text-align: center; vertical-align: middle; }
    th { background-color: #f9a825; color: #121212; }
    tr:hover { background-color: #2a2a2a; }
    h1 { color: #fbc02d; margin-bottom: 15px; }
    button {
        background: #fbc02d;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        margin: 2px;
        font-weight: bold;
        color: #121212;
        transition: background 0.3s ease;
    }
    button:hover {
        background: #f9a825;
        box-shadow: 0 0 8px #f9a825;
    }
    form {
        display: inline;
    }
    .btn-voltar {
      display: inline-block;
      margin-bottom: 20px;
      padding: 8px 16px;
      background: #f9a825;
      color: #121212;
      font-weight: bold;
      text-decoration: none;
      border-radius: 5px;
    }
</style>
</head>
<body>

<a href="cadastro.php" class="btn-voltar">← Voltar para Cadastro</a>

<h1>Catálogo de Animes e Filmes</h1>

<?php
if (!empty($_SESSION['msg_sucesso'])) {
    echo '<p style="color: #4caf50;">' . htmlspecialchars($_SESSION['msg_sucesso']) . '</p>';
    unset($_SESSION['msg_sucesso']);
}
if (!empty($_SESSION['msg_erro'])) {
    echo '<p style="color: #f44336;">' . htmlspecialchars($_SESSION['msg_erro']) . '</p>';
    unset($_SESSION['msg_erro']);
}
?>

<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Gênero</th>
            <th>Estúdio</th>
            <th>Diretor</th>
            <th>Ano</th>
            <th>Formato</th>
            <th>Total Temporadas</th>
            <th>Total Episódios</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Mostrar animes
        while ($row = $animes->fetch_assoc()) {
            $idAnime = $row['id'];
            $totalTemporadas = contarTemporadas($conexao, $idAnime);
            $totalEpisodios = contarEpisodios($conexao, $idAnime);

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
            echo "<td>" . htmlspecialchars($row['genero'] ?? '—') . "</td>";
            echo "<td>" . htmlspecialchars($row['estudio'] ?? '—') . "</td>";
            echo "<td>" . htmlspecialchars($row['diretor'] ?? '—') . "</td>";
            echo "<td>" . htmlspecialchars($row['ano_lancamento'] ?? '—') . "</td>";
            echo "<td>" . htmlspecialchars($row['formato'] ?? 'Anime') . "</td>";
            echo "<td>$totalTemporadas</td>";
            echo "<td>$totalEpisodios</td>";
            echo "<td>
                <form method='POST' style='display:inline-block; margin:0 3px;'>
                    <input type='hidden' name='acao' value='adicionar_temporada'>
                    <input type='hidden' name='anime_id' value='$idAnime'>
                    <input type='number' name='qtd_eps' min='1' placeholder='Qtd episódios' required style='width:90px; padding:5px; border-radius:4px; border:none;'>
                    <button type='submit' title='Adicionar Temporada'>+</button>
                </form>
            </td>";
            echo "</tr>";
        }

        // Mostrar filmes
        while ($row = $filmes->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
            echo "<td>—</td>"; // gênero não armazenado para filmes
            echo "<td>" . htmlspecialchars($row['estudio'] ?? '—') . "</td>";
            echo "<td>" . htmlspecialchars($row['diretor'] ?? '—') . "</td>";
            echo "<td>" . htmlspecialchars($row['ano_lancamento'] ?? '—') . "</td>";
            echo "<td>" . htmlspecialchars($row['formato'] ?? 'Filme') . "</td>";
            echo "<td>—</td>"; // Temporadas não aplicam para filmes
            echo "<td>—</td>"; // Episódios não aplicam para filmes
            echo "<td>—</td>"; // Sem ações para filmes
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
