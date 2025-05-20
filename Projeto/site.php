<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style_2.css">
    <title>AnimaXone</title>
</head>
<body>
    
    <div class="nome">
      <h1>AnimaXone</h1>
    </div>


    <?php
      include("./includes/menu.php");
    ?>

    <div>
      <nav class="assistindo">
        <h2>VOCÊ ESTA ASSISTINDO</h2>
      </nav>
      <div class="animes_assistindo">
        <div class="anime-item">
          <img src="./imagens/Dr_stone.jpg" alt="Imagem 1" data-anime="Dr. Stone">
          <a href="./generos/Páginas/Dr. Stone/dr_stone.html" class="anime-link">Dr. Stone</a>
        </div>
        <div class="anime-item">
          <img src="./imagens/Kill_la_Kill.jpg" alt="Imagem 2" data-anime="Kill la Kill">
          <a href="./generos/Páginas/Kill la Kill/kill_la_kill.html" class="anime-link">Kill la Kill</a>
        </div>
        <div class="anime-item">
          <img src="./imagens/dan_da_dan.jpg" alt="Imagem 3" data-anime="Dan Da Dan">
          <a href="./generos/Páginas/Dan Da Dan/dan_da_dan.html" class="anime-link">Dan Da Dan</a>
        </div>
        <div class="anime-item">
          <img src="./imagens/chainsaw_man.jpg" alt="Imagem 4" data-anime="Chainsaw Man">
          <a href="./generos/Páginas/Chainsaw Man/chainsaw_man.html" class="anime-link">Chainsaw Man</a>
        </div>
      </div>
      
    </div>


    <nav>
      <h2 class="titulo-sessao">Animes em Breve</h2>
    </nav>
    <div class="animes-em-breve">
      <div class="anime-item">
        <img src="./imagens/sakuna.jpg" alt="Anime 1" data-anime="Sakuna">
        <a href="./generos/Páginas/Sakuna/sakuna.html" class="anime-link">Sakuna</a>
      </div>
      <div class="anime-item">
        <img src="./imagens/kimi_to_boku.jpg" alt="Anime 2" data-anime="Kimi to Boku">
        <a href="./generos/Páginas/Kimi to Boku/kimi_to_boku.html" class="anime-link">Kimi to Boku</a>
      </div>
      <div class="anime-item">
        <img src="./imagens/nigejouzu.jpg" alt="Anime 3" data-anime="Nigejouzu">
        <a href="./generos/Páginas/Nigejouzu/nigejouzu.html" class="anime-link">Nigejouzu</a>
      </div>
      <div class="anime-item">
        <img src="./imagens/mayonaka_punch.jpg" alt="Anime 4" data-anime="Mayonaka Punch">
        <a href="./generos/Páginas/Mayonaka Punch/mayonaka_punch.html" class="anime-link">Mayonaka Punch</a>
      </div>
    </div>

<script src="script_2.js"></script>

</body>
</html>