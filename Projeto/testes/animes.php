<?php

require_once("conexao.php");


$animes = $conexao->query("SELECT * FROM animes");

echo "<ul>";
while ($anime = mysqli_fetch_assoc($animes)){
    echo "<li><a href='anime.php?id=".$anime['id']."'>" . $anime['nome']."</a></li>";
}
