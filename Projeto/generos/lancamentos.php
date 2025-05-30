<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>AnimaXone - Lançamentos</title>
  <link rel="stylesheet" href="../site.html">
  <link rel="stylesheet" href="./../style_2.css">
  <link rel="stylesheet" href="style_lancamento.css">
</head>
<body>

  <div class="nome">
    <h1>AnimaXone</h1>
  </div>

  <?php
  include("./../includes/menu.php")
  ?>
    
    <div>
      <nav class="animes_lancamentos">
        <h2>Lançamentos</h2>
      </nav>

      <div class="lancamentos" class="anime-card">
        <div class="anime-item">
          <img src="../imagens/devil_may_cry.jpg" alt="Imagem 1" data-anime="Devil May Cry">
          <a href="./Páginas/Devil May Cry/devil_may_cry.html" class="anime-link">Devil May Cry</a>
        </div>
        <div class="anime-item">
          <img src="../imagens/lazarus.jpg" alt="Imagem 2" data-anime="Lazarus">
          <a href="./Páginas/Lazarus/lazarus.html" class="anime-link">Lazarus</a>
        </div>
        <div class="anime-item">
          <img src="../imagens/to_be_hero_x.jpg" alt="Imagem 3" data-anime="To Be Hero X">
          <a href="./Páginas/To Be Hero X/to_be_hero_x.html" class="anime-link">To Be Hero X</a>
        </div>
        <div class="anime-item">
          <img src="../imagens/kijin.jpg" alt="Imagem 4" data-anime="Kijin of the Demon Hunter">
          <a href="./Páginas/Kijin of the Demon Hunter/Kijin_of_the_Demon_Hanter.html" class="anime-link">Kijin of the Demon Hunter</a>
        </div>
      </div>
    </div>

    <div class="lancamentos" class="anime-card">
      <div class="anime-item">
        <img src="../imagens/tougen_anki.jpg" alt="Imagem 1" data-anime="Tougen Anki">
        <a href="./Páginas/Tougen Anki/tougen_anki.html" class="anime-link">Tougen Anki</a>
      </div>
      <div class="anime-item">
        <img src="../imagens/gachiakuta.jpg" alt="Imagem 2" data-anime="Gachiakuta">
        <a href="./Páginas/Gachiakuta/gachiakuta.html" class="anime-link">Gachiakuta</a>
      </div>
      <div class="anime-item">
        <img src="../imagens/shangri_la_frontier.jpg" alt="Imagem 3" data-anime="Shangri la Frontier">
        <a href="./Páginas/Shangri la Frontier/shangri_la_frantier.html" class="anime-link">Shangri la Frontier</a>
      </div>
      <div class="anime-item">
        <img src="../imagens/zenchu.jpg" alt="Imagem 4" data-anime="Zenchu">
        <a href="./Páginas/Zenchu/zenchu.html" class="anime-link">Zenchu</a>
      </div>
    </div>
      
    <script src="script_lancamento.js"></script>
</body>
</html>
