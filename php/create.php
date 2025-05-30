<?php

require_once("bd.php");

if(isset($_POST) and count (value: $_POST) > 0){

    $hash = password_hash(password: $_POST['password'], algo: PASSWORD_BCRYPT);

    $sql = $conn->prepare(query: "INSERT INTO  users(name, email, password) VALUES(:name, :email, :password)");
    $sql->bindValue(param: ":name", value: $_POST['name']);
    $sql->bindValue(param: ":email", value: $_POST['email']);
    $sql->bindValue(param: ":password", value: $hash);
    $sql->execute();

    header(header: "Location:formulario.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar usuario</title>
</head>
<body>

    <h1>Cadastrar Usuario</h1>

    <form action="" method="POST">

        <label for="name">Nome: </label>
        <input type="text" name="name">
        <br>

        <label for="email">Email: </label>
        <input type="email" name="email">
        <br>

        <label for="password">Senha: </label>
        <input type="password" name="password">
        <br>

        <input type="submit" value="Salvar">

    </form>

</body>
</html>