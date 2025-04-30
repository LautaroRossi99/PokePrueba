<?php
session_start();

require_once ($_SERVER['DOCUMENT_ROOT'].'/PokedexPrueba/database.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/Functions/functions.php');



?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>

    <form method="POST" action="../Functions/function_login.php">
        <input type="text" name="usuario" placeholder="usuario" required><br><br>
        <input type="password" name="contrasena" placeholder="contraseña" required><br><br>
        <button type="submit">Ingresar</button>
    </form>

</body>
</html>