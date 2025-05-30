<?php

require_once("bd.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuarios</title>
</head>
<body>

    <h1>Lista de usuarios</h1>

    <a href="create.php">Cadastrar</a>

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Senha</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $sql = $conn->query(query: "SELECT * FROM users");
                $users = $sql->fetchAll(mode: PDO::FETCH_OBJ);

                foreach ($users as $user) {
            ?>
                <tr>
                    <td><?php echo $user->id; ?></td>
                    <td><?php echo $user->name; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->password; ?></td>
                </tr>
            <?php
                }
            ?>

        </tbody>

    </table>
    
</body>
</html>