<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

require_once("conexao.php");

// Função para adicionar temporada com episódios (sem criar arquivos físicos)
function adicionarTemporada(mysqli $conexao, int $animeId, int $qtdEps): ?string {
    if ($animeId <= 0 || $qtdEps <= 0) {
        return "ID do anime e quantidade de episódios devem ser maiores que zero.";
    }
    try {
        $stmt = $conexao->prepare("SELECT MAX(numero) as max_num FROM temporadas_animes WHERE anime_id = ?");
        $stmt->bind_param("i", $animeId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $proxNum = intval($result['max_num'] ?? 0) + 1;

        $nomeTemp = "Temporada " . $proxNum;
        $stmt = $conexao->prepare("INSERT INTO temporadas_animes (anime_id, numero, nome) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $animeId, $proxNum, $nomeTemp);
        $stmt->execute();

        // Só cria a temporada, não adiciona episódios aqui (episódios com upload mp4)
    } catch (Exception $e) {
        return "Erro ao adicionar temporada: " . $e->getMessage();
    }
    return null;
}

// Função para adicionar episódio com upload MP4 e salvar no banco
function adicionarEpisodioComConteudoMP4(mysqli $conexao, int $temporadaId, array $arquivo): ?string {
    if ($temporadaId <= 0) {
        return "ID da temporada inválido.";
    }
    if (!isset($arquivo) || $arquivo['error'] !== UPLOAD_ERR_OK) {
        return "Erro no upload do arquivo.";
    }

    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    if ($extensao !== 'mp4') {
        return "Só arquivos MP4 são permitidos.";
    }

    $conteudo = file_get_contents($arquivo['tmp_name']);
    if ($conteudo === false) {
        return "Falha ao ler arquivo.";
    }

    $stmt = $conexao->prepare("SELECT anime_id, numero FROM temporadas_animes WHERE id = ?");
    $stmt->bind_param("i", $temporadaId);
    $stmt->execute();
    $tempInfo = $stmt->get_result()->fetch_assoc();

    if (!$tempInfo) {
        return "Temporada não encontrada.";
    }

    $stmt = $conexao->prepare("SELECT MAX(numero) as max_ep FROM episodios WHERE temporada_id = ?");
    $stmt->bind_param("i", $temporadaId);
    $stmt->execute();
    $lastEpResult = $stmt->get_result()->fetch_assoc();
    $novoEpNum = intval($lastEpResult['max_ep'] ?? 0) + 1;

    $stmt = $conexao->prepare("INSERT INTO episodios (temporada_id, numero, conteudo) VALUES (?, ?, ?)");
    $null = NULL;
    $stmt->bind_param("iib", $temporadaId, $novoEpNum, $null);
    $stmt->send_long_data(2, $conteudo);
    $stmt->execute();

    return null;
}

// Contar temporadas de um anime
function contarTemporadas(mysqli $conexao, int $animeId): int {
    $stmt = $conexao->prepare("SELECT COUNT(*) as total FROM temporadas_animes WHERE anime_id = ?");
    $stmt->bind_param("i", $animeId);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    return intval($res['total'] ?? 0);
}

// Contar episódios de um anime
function contarEpisodios(mysqli $conexao, int $animeId): int {
    $stmt = $conexao->prepare("SELECT COUNT(*) as total FROM episodios WHERE temporada_id IN (SELECT id FROM temporadas_animes WHERE anime_id = ?)");
    $stmt->bind_param("i", $animeId);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    return intval($res['total'] ?? 0);
}

// Buscar episódios para uma temporada
function buscarEpisodios(mysqli $conexao, int $temporadaId): array {
    $stmt = $conexao->prepare("SELECT id, numero FROM episodios WHERE temporada_id = ? ORDER BY numero ASC");
    $stmt->bind_param("i", $temporadaId);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res->fetch_all(MYSQLI_ASSOC);
}

$mensagemErro = null;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['anime_id'], $_POST['qtd_eps']) && !isset($_POST['temporada_id'])) {
        $mensagemErro = adicionarTemporada($conexao, intval($_POST['anime_id']), intval($_POST['qtd_eps']));
        if (!$mensagemErro) {
            echo "<script>alert('Temporada adicionada com sucesso!');</script>";
        }
    } elseif (isset($_POST['temporada_id']) && isset($_FILES['arquivo_ep'])) {
        $mensagemErro = adicionarEpisodioComConteudoMP4($conexao, intval($_POST['temporada_id']), $_FILES['arquivo_ep']);
        if (!$mensagemErro) {
            echo "<script>alert('Episódio enviado com sucesso!');</script>";
        }
    }
}

// Buscar lista de animes
$sql = "SELECT a.id, a.nome, a.genero, i.estudio 
        FROM animes_geral a 
        LEFT JOIN informacoes i ON a.id = i.anime_id 
        ORDER BY a.nome ASC";
$resultado = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Catálogo de Animes</title>
<style>
    body {
        background: #121212;
        color: #fff;
        font-family: Arial, sans-serif;
        padding: 30px;
    }
    h1 {
        color: #f9a825;
        margin-bottom: 30px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #1e1e1e;
        box-shadow: 0 0 10px #f9a825;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 30px;
    }
    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #333;
        vertical-align: middle;
    }
    th {
        background-color: #f9a825;
        color: #121212;
    }
    tr:hover {
        background-color: #333;
    }
    .voltar {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background-color: #4caf50;
        color: white;
        text-decoration: none;
        font-weight: bold;
        border-radius: 5px;
        transition: background 0.3s;
    }
    .voltar:hover {
        background-color: #388e3c;
    }
    button {
        background-color: #fbc02d;
        color: #000;
        padding: 6px 12px;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        margin-right: 5px;
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 10;
        left: 0; top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.6);
    }
    .modal-content {
        background: #1e1e1e;
        margin: 10% auto;
        padding: 20px;
        border: 2px solid #f9a825;
        border-radius: 10px;
        width: 400px;
        box-shadow: 0 0 15px #f9a825;
        max-height: 80vh;
        overflow-y: auto;
    }
    .modal-content h3 {
        margin-top: 0;
        color: #fbc02d;
    }
    .modal-content input,
    .modal-content select {
        width: 100%;
        padding: 8px;
        margin-top: 10px;
        background: #222;
        color: #fff;
        border: none;
        border-radius: 5px;
    }
    .modal-content button {
        margin-top: 15px;
        width: 100%;
        background-color: #4caf50;
        color: #fff;
    }
    .fechar {
        float: right;
        font-size: 20px;
        cursor: pointer;
        color: #fff;
    }
    video {
        max-width: 100%;
        border-radius: 6px;
        box-shadow: 0 0 6px #f9a825;
    }
    .episodios-lista {
        margin-top: 10px;
        background: #222;
        padding: 10px;
        border-radius: 8px;
    }
    .episodio-item {
        margin-bottom: 15px;
    }
</style>
</head>
<body>

<a href="cadastro.php" class="voltar">← Voltar para Cadastro</a>
<h1>Catálogo de Animes</h1>

<?php if ($mensagemErro): ?>
    <p style="color:#f44336; font-weight:bold;"><?= htmlspecialchars($mensagemErro) ?></p>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Gênero</th>
            <th>Estúdio</th>
            <th>Temporadas</th>
            <th>Total de Eps</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado->num_rows > 0): ?>
            <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nome']) ?></td>
                <td><?= htmlspecialchars($row['genero']) ?></td>
                <td><?= htmlspecialchars($row['estudio'] ?? '—') ?></td>
                <td><?= contarTemporadas($conexao, $row['id']) ?></td>
                <td><?= contarEpisodios($conexao, $row['id']) ?></td>
                <td>
                    <button onclick="abrirModalTemporada(<?= $row['id'] ?>)">Adicionar Temporada</button>
                    <button onclick="abrirModalEpisodios(<?= $row['id'] ?>)">Adicionar Episódio</button>
                    <button onclick="abrirModalListarEpisodios(<?= $row['id'] ?>)">Ver Episódios</button>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">Nenhum anime cadastrado.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Modal para adicionar temporada -->
<div id="modalTemporada" class="modal">
    <div class="modal-content">
        <span class="fechar" onclick="fecharModal('modalTemporada')">&times;</span>
        <h3>Nova Temporada</h3>
        <form method="POST" id="formTemporada">
            <input type="hidden" name="anime_id" id="anime_id_temp">
            <label>Qtd de Episódios (só para referência):</label>
            <input type="number" name="qtd_eps" min="1" value="1" required>
            <button type="submit">Adicionar</button>
        </form>
    </div>
</div>

<!-- Modal para adicionar episódio com upload -->
<div id="modalEpisodios" class="modal">
    <div class="modal-content">
        <span class="fechar" onclick="fecharModal('modalEpisodios')">&times;</span>
        <h3>Adicionar Episódio (Upload MP4)</h3>
        <form method="POST" enctype="multipart/form-data" id="formEpisodios">
            <label>Selecione a Temporada:</label>
            <select name="temporada_id" id="temporada_select" required>
                <option value="">Selecione uma temporada</option>
            </select>

            <label>Arquivo do Episódio (MP4):</label>
            <input type="file" name="arquivo_ep" accept="video/mp4" required>

            <button type="submit">Enviar Episódio</button>
        </form>
    </div>
</div>

<!-- Modal para listar episódios -->
<div id="modalListarEpisodios" class="modal">
    <div class="modal-content" style="max-height: 70vh; overflow-y: auto;">
        <span class="fechar" onclick="fecharModal('modalListarEpisodios')">&times;</span>
        <h3>Episódios da Temporada</h3>
        <div id="episodios_container">
            <!-- Episódios aparecerão aqui via JS -->
        </div>
    </div>
</div>

<script>
// Abrir modal temporada
function abrirModalTemporada(animeId) {
    document.getElementById('anime_id_temp').value = animeId;
    document.getElementById('modalTemporada').style.display = 'block';
}

// Abrir modal para adicionar episódio
function abrirModalEpisodios(animeId) {
    document.getElementById('modalEpisodios').style.display = 'block';
    carregarTemporadas(animeId);
}

// Abrir modal para listar episódios
function abrirModalListarEpisodios(animeId) {
    carregarTemporadas(animeId, true);
    document.getElementById('modalListarEpisodios').style.display = 'block';
}

// Fechar modal
function fecharModal(id) {
    document.getElementById(id).style.display = 'none';
}

// Fechar modais clicando fora
window.onclick = function(event) {
    ['modalTemporada', 'modalEpisodios', 'modalListarEpisodios'].forEach(id => {
        const modal = document.getElementById(id);
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}

// Carregar temporadas para select e (se listarEps) carregar episódios também
function carregarTemporadas(animeId, listarEps = false) {
    const select = document.getElementById('temporada_select');
    select.innerHTML = '<option value="">Carregando...</option>';
    fetch('buscar_temporadas.php?anime_id=' + animeId)
        .then(resp => resp.json())
        .then(data => {
            if (data.length === 0) {
                select.innerHTML = '<option value="">Nenhuma temporada cadastrada</option>';
                if (listarEps) mostrarEpisodios([]);
                return;
            }
            select.innerHTML = '';
            data.forEach(temp => {
                const option = document.createElement('option');
                option.value = temp.id;
                option.textContent = `Temporada ${temp.numero} - ${temp.nome}`;
                select.appendChild(option);
            });
            if (listarEps) {
                carregarEpisodios(data[0].id);
            } else {
                select.selectedIndex = 0;
            }
        })
        .catch(() => {
            select.innerHTML = '<option value="">Erro ao carregar temporadas</option>';
            if (listarEps) mostrarEpisodios([]);
        });
}

// Carregar episódios para uma temporada e mostrar no modalListarEpisodios
function carregarEpisodios(temporadaId) {
    fetch('buscar_episodios.php?temporada_id=' + temporadaId)
        .then(resp => resp.json())
        .then(data => {
            mostrarEpisodios(data);
        })
        .catch(() => {
            mostrarEpisodios([]);
        });
}

// Mostrar lista de episódios no modal
function mostrarEpisodios(episodios) {
    const container = document.getElementById('episodios_container');
    container.innerHTML = '';

    if (episodios.length === 0) {
        container.innerHTML = '<p>Nenhum episódio encontrado.</p>';
        return;
    }

    episodios.forEach(ep => {
        const div = document.createElement('div');
        div.classList.add('episodio-item');
        div.innerHTML = `
            <strong>Episódio ${ep.numero}</strong><br>
            <video width="320" height="180" controls>
                <source src="episodio_video.php?id=${ep.id}" type="video/mp4">
                Seu navegador não suporta o elemento video.
            </video>
        `;
        container.appendChild(div);
    });
}

// Quando mudar temporada no select do upload, nada especial, só para prevenir
document.getElementById('temporada_select').addEventListener('change', e => {
    // Se quiser alguma ação ao trocar temporada no upload, coloque aqui.
});
</script>

</body>
</html>
