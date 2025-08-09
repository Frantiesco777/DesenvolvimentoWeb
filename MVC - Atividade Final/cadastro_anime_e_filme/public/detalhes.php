<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

require_once __DIR__ . '/../app/config/config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID inválido.";
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM cadastro WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

if (!$item) {
    echo "Registro não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Detalhes de <?php echo htmlspecialchars($item['nome']); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include __DIR__ . '/../app/views/header.php'; ?>

<div class="lista-container" style="max-width: 700px; margin: 40px auto;">
    <h1><?php echo htmlspecialchars($item['nome']); ?></h1>
    <p><strong>Estúdio:</strong> <?php echo htmlspecialchars($item['estudio']); ?></p>
    <p><strong>Diretor:</strong> <?php echo htmlspecialchars($item['diretor']); ?></p>
    <p><strong>Temporada:</strong> <?php echo htmlspecialchars($item['temporada']); ?></p>
    <p><strong>Gênero:</strong> <?php echo htmlspecialchars($item['genero']); ?></p>
    <p><strong>Tipo:</strong> <?php echo htmlspecialchars($item['tipo']); ?></p>
    <p><strong>Ano de Lançamento:</strong> <?php echo htmlspecialchars($item['ano_lancamento']); ?></p>

    <a href="listar.php" class="btn-listar" style="display: inline-block; margin-top: 20px;">Voltar à Lista</a>
</div>

</body>
</html>
