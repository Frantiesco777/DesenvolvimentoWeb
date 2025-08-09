<?php if (isset($_SESSION['usuario_nome'])): ?>
<div class="user-bar">
    <span>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</span>
    <a href="logout.php" class="logout-btn">Sair</a>
</div>
<?php endif; ?>
<link rel="stylesheet" href="css/main.css">
