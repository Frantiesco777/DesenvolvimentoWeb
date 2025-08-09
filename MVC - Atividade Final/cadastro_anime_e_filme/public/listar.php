<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

require_once __DIR__ . '/../app/config/config.php';

// Processa exclusão se houver POST com id
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remover_id'])) {
    $idRemover = intval($_POST['remover_id']);
    $stmtDel = $conn->prepare("DELETE FROM cadastro WHERE id = ?");
    $stmtDel->bind_param("i", $idRemover);
    $stmtDel->execute();
    $stmtDel->close();
    // Redireciona para evitar reenvio do form
    header("Location: listar.php");
    exit;
}

// Busca os registros atualizados
$sql = "SELECT * FROM cadastro ORDER BY tipo, nome";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Animes e Filmes</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

    

<?php include __DIR__ . '/../app/views/header.php'; ?>

<a href="cadastro.php" class="btn-voltar">Voltar para Cadastro</a>

<div class="lista-container">
    <div class="lista-filmes">
        <div class="lista-titulo">Filmes</div>
        <?php
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()) {
            if ($row['tipo'] === 'Filme') {
                ?>
                <div class="filme item">
                    <a href="detalhes.php?id=<?php echo $row['id']; ?>">
                        <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
                        <p><strong>Estúdio:</strong> <?php echo htmlspecialchars($row['estudio']); ?></p>
                        <p><strong>Diretor:</strong> <?php echo htmlspecialchars($row['diretor']); ?></p>
                        <p><strong>Temporada:</strong> <?php echo htmlspecialchars($row['temporada']); ?></p>
                        <p><strong>Gênero:</strong> <?php echo htmlspecialchars($row['genero']); ?></p>
                        <p><strong>Ano:</strong> <?php echo htmlspecialchars($row['ano_lancamento']); ?></p>
                    </a>

                    <form method="POST" class="remover-form" onsubmit="return confirm('Tem certeza que deseja remover este filme?');">
                        <input type="hidden" name="remover_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn-remover">Remover</button>
                    </form>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <div class="lista-animes">
        <div class="lista-titulo">Animes</div>
        <?php
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()) {
            if ($row['tipo'] === 'Anime') {
                ?>
                <div class="anime item">
                    <a href="detalhes.php?id=<?php echo $row['id']; ?>">
                        <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
                        <p><strong>Estúdio:</strong> <?php echo htmlspecialchars($row['estudio']); ?></p>
                        <p><strong>Diretor:</strong> <?php echo htmlspecialchars($row['diretor']); ?></p>
                        <p><strong>Temporada:</strong> <?php echo htmlspecialchars($row['temporada']); ?></p>
                        <p><strong>Gênero:</strong> <?php echo htmlspecialchars($row['genero']); ?></p>
                        <p><strong>Ano:</strong> <?php echo htmlspecialchars($row['ano_lancamento']); ?></p>
                    </a>

                    <form method="POST" class="remover-form" onsubmit="return confirm('Tem certeza que deseja remover este anime?');">
                        <input type="hidden" name="remover_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn-remover">Remover</button>
                    </form>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
</body>
</html>
