<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

require_once("conexao.php");

// Funções adicionarTemporada, removerTemporada, contarTemporadas, contarEpisodios...
// (Suponho que já estão definidas no arquivo ou você pode me pedir para incluir)

// Buscar animes (com dados da tabela informacoes)
$sqlAnimes = "
    SELECT a.id, a.nome, a.genero, i.estudio, i.formato
    FROM animes_geral a
    LEFT JOIN informacoes i ON a.id = i.anime_id
    WHERE i.formato = 'anime'
    ORDER BY a.nome ASC
";
$animes = $conexao->query($sqlAnimes);

// Buscar filmes (somente tabela filmes)
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
    .form-popup, .modal-temporadas {
        display: none;
        position: fixed;
        z-index: 999;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background: #1e1e1e;
        padding: 20px;
        border: 2px solid #f9a825;
        border-radius: 10px;
        max-height: 80vh;
        overflow-y: auto;
        width: 400px;
    }
    input[type=number] {
        padding: 8px;
        width: 100%;
        background: #333;
        color: #fff;
        border: 1px solid #666;
        border-radius: 4px;
        font-size: 1rem;
    }
    h2, h3 {
        color: #fbc02d;
        margin: 0 0 15px 0;
    }
    .close-btn {
        background: #d32f2f;
        float: right;
        font-weight: bold;
        border: none;
        padding: 4px 10px;
        border-radius: 5px;
        cursor: pointer;
        color: #fff;
    }
</style>
</head>
<body>

<h1>Catálogo de Animes e Filmes</h1>

<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Gênero</th>
            <th>Estúdio</th>
            <th>Diretor</th>
            <th>Ano</th>
            <th>Formato</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Mostrar animes com botões
        while ($row = $animes->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
            echo "<td>" . htmlspecialchars($row['genero']) . "</td>";
            echo "<td>" . htmlspecialchars($row['estudio'] ?? '—') . "</td>";
            echo "<td>—</td>";
            echo "<td>—</td>";
            echo "<td>Anime</td>";
            echo "<td>
                <button onclick='abrirFormAdicionar({$row['id']})'>Adicionar Temporada</button>
                <button onclick='abrirModalTemporadas({$row['id']}, \"" . addslashes(htmlspecialchars($row['nome'])) . "\")'>Gerenciar Temporadas</button>
            </td>";
            echo "</tr>";
        }

        // Mostrar filmes sem botões
        while ($row = $filmes->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
            echo "<td>—</td>";
            echo "<td>" . htmlspecialchars($row['estudio'] ?? '—') . "</td>";
            echo "<td>" . htmlspecialchars($row['diretor'] ?? '—') . "</td>";
            echo "<td>" . htmlspecialchars($row['ano_lancamento'] ?? '—') . "</td>";
            echo "<td>Filme</td>";
            echo "<td>—</td>"; // Sem ações para filmes
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<!-- Formulário para adicionar temporada -->
<div class="form-popup" id="formAdicionarTemporada">
    <h3>Adicionar Temporada</h3>
    <form method="POST">
        <input type="hidden" name="acao" value="adicionar_temporada">
        <input type="hidden" name="anime_id" id="anime_id">
        <label>Quantidade de episódios:</label>
        <input type="number" name="qtd_eps" min="1" required>
        <br><br>
        <button type="submit">Adicionar</button>
        <button type="button" onclick="fecharFormAdicionar()">Cancelar</button>
    </form>
</div>

<!-- Modal para gerenciar temporadas -->
<div class="modal-temporadas" id="modalTemporadas">
    <h3>Temporadas de <span id="nomeAnimeModal"></span></h3>
    <button class="close-btn" onclick="fecharModalTemporadas()">X</button>
    <div id="listaTemporadas">Carregando...</div>
</div>

<script>
function abrirFormAdicionar(animeId) {
    document.getElementById('anime_id').value = animeId;
    document.getElementById('formAdicionarTemporada').style.display = 'block';
}
function fecharFormAdicionar() {
    document.getElementById('formAdicionarTemporada').style.display = 'none';
}

function abrirModalTemporadas(animeId, animeNome) {
    document.getElementById('nomeAnimeModal').textContent = animeNome;
    const modal = document.getElementById('modalTemporadas');
    const lista = document.getElementById('listaTemporadas');
    lista.innerHTML = 'Carregando...';
    modal.style.display = 'block';

    fetch('buscar_temporadas.php?anime_id=' + animeId)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                lista.innerHTML = '<p style="color:red;">Erro: ' + data.error + '</p>';
                return;
            }
            if (!data.temporadas || data.temporadas.length === 0) {
                lista.innerHTML = '<p>Não há temporadas para este anime.</p>';
                return;
            }
            let html = '';
            data.temporadas.forEach(t => {
                let nomeTemp = t.nome ? t.nome : ('Temporada ' + t.numero);
                html += `
                <div class="temporada-item" style="margin-bottom:8px; display:flex; justify-content:space-between; align-items:center;">
                    <span>${nomeTemp}</span>
                    <form method="POST" style="margin:0;" onsubmit="return confirm('Confirma remover a temporada?');">
                        <input type="hidden" name="acao" value="remover_temporada">
                        <input type="hidden" name="temporada_id" value="${t.id}">
                        <button type="submit" style="background:#d32f2f; color:#fff; border-radius:4px; padding:4px 8px;">Remover</button>
                    </form>
                </div>`;
            });
            lista.innerHTML = html;
        })
        .catch(() => {
            lista.innerHTML = '<p style="color:red;">Erro ao carregar temporadas.</p>';
        });
}

function fecharModalTemporadas() {
    document.getElementById('modalTemporadas').style.display = 'none';
}
</script>

</body>
</html>
