<?php
// menu.php
?>

<header>
  <div class="logo">
    <a href="site.php" style="color:#ff6600; text-decoration:none;">AnimaXone</a>
  </div>

  <nav class="navegacao">
    <a href="site.php">Home</a>
    <a href="lancamentos.php">Lançamentos</a>
    <a href="generos.php">Gêneros</a>
  </nav>

  <form action="site.php" method="GET" class="form-pesquisa" style="display:inline-block;">
    <input 
      type="text" 
      name="search" 
      placeholder="Pesquisar animes..." 
      style="padding:6px 8px; border-radius:6px; border:none; font-size:14px;"
      value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
    />
    <button type="submit" style="padding:6px 12px; border:none; background:#ff6600; color:#000; font-weight:bold; border-radius:6px; cursor:pointer;">Buscar</button>
  </form>
</header>
