<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php

        $nome = "Francisco";
        $x = "a";
        $y = 10;
        
        print "<h1> Olá Mundo! </h1>";
        print "Olá, " . $nome;
        print "<br>";
        print "Olá, $nome"; # usar sempre com Aspas Duplas pra identificar vareável
        print "<br>";
        print 'Olá, $nome'; # Aspas simples não identifica vareavel, não é aconcelhavel usar
        print "<br>";
        print "<br>";

        print ++ $x; # da pra fazer essas bizarrices aqui
        print "<br>";

        if ($y > 5){
            print "Maior que 5";
        } else {
            print "Menor que 5";
        }

        print "<br>";
        print "<br>";

        for ($i = 0; $i < 5; $i ++){
            print $i. "<br>";
        }
        
        print "<br>";
        print "<br>";

        function teste():void{
            print "Eu sou uma função";
        }

        teste();

        print "<br>";

        function quad(int $n): int{
            $result = $n * $n;
            return $result;
        }

        print "O quadrado de 2 é " . quad(n: 2);
    ?>

</body>
</html>