<?php
session_start();
global $database;
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/Functions/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/database.php';



$pokemones = obtenerPokemones($database);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">

</head>
<body style="background-color: #ffe6e6;">
<nav class="navbar navbar-expand-lg navbar-dark bg-danger px-4">
    <div class="container-fluid d-flex justify-content-between align-items-center w-100">
        <!-- 🔵 Logo Pokémon a la izquierda -->
        <div>
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Pokeball" width="40" height="40" class="me-2">
        </div>
        <!-- 🟥 Texto centrado -->
        <div class="mx-auto text-white fw-bold fs-4">
            <a class="text-white text-decoration-none" href="index.php"> POKEDEX </a>
        </div>

        <div class="text-white">

            <div class="text-white">
                <?php
                // Verificar si el usuario está logueado
                if (isset($_SESSION['usuario'])) {
                    // Si está logueado, mostrar su nombre y el botón de cerrar sesión
                    echo "<span>Bienvenido, " . $_SESSION['usuario'] . "</span> ";
                    echo '<a href="views/login_out.php" class="text-white">Cerrar sesión</a>'; // Enlace a logout.php
                } else {
                    // Si no está logueado, mostrar el enlace de login
                    echo '<a href="views/login.php">usuario</a>';
                }
                ?>
            </div>
        </div>
    </div>
</nav>
<div class="container mt-4">

    <div class="row justify-content-center mt-4">

        <div class="container mt-4">
                <form class="container d-flex flex-row justify-content-between align-items-center my-3" method="get" action="views/show_pokemon.php">
                    <input type="text" class="form-control w-75" name="pokemon" placeholder="Buscar Pokémon..." id="buscarPokemon">
                    <button class="btn btn-primary btn-md bg-danger border-none" style="border:none;" type="submit" id="btnBuscar">Buscar Pokémon</button>
                </form>

            <div class="row justify-content-center mt-4">
                <?php
                // Llamar a la función para mostrar los pokemones
                mostrarDatosPokemon($pokemones);
                ?>

            </div>


        </div>


    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
