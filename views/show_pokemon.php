<?php
session_start();
global $database;
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/Functions/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/database.php';

$pokemones = obtenerPokemones($database);

$pokemon = "";

if (isset($_GET['pokemon'])) {
    $pokemon = strtolower($_GET['pokemon']);
} else {
    echo "No se recibió ningún Pokémon.";
}

$pokemonVerMas = [];
if (isset($_GET['pokemonVerMas'])) {
    $pokemonVerMas = json_decode($_GET['pokemonVerMas'], true);  // El true convierte el JSON a un array
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body style="background-color: #ffe6e6;">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/includes/navbar.php'; ?>
<div class="container mt-4">
    <form class="container d-flex flex-row justify-content-between align-items-center my-3" method="get" action="show_pokemon.php">
        <input type="text" class="form-control w-75" name="pokemon" placeholder="Buscar Pokémon..." id="buscarPokemon">
        <button class="btn btn-primary btn-md bg-danger border-none" style="border:none;" type="submit" id="btnBuscar">Buscar Pokémon</button>
    </form>
    <div class="row justify-content-center mt-4">
        <?php
        // Si se pasa un pokemon como parámetro, llamar a verificarSiExistePokemonElegido
        if ($pokemon) {
            verificarSiExistePokemonElegido($pokemones, $pokemon);
        }

        // Si se pasa pokemonVerMas como parámetro, mostrar los detalles del Pokémon
        if (!empty($pokemonVerMas)) {
            mostrarDatosPokemonEncontrado($pokemonVerMas);
        }
        ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-danger px-4">
    <div class="container-fluid d-flex justify-content-between align-items-center w-100">
        <!-- 🔵 Logo Pokémon a la izquierda -->
        <div>
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Pokeball" width="40" height="40" class="me-2">
        </div>
        <!-- 🟥 Texto centrado -->
        <div class="mx-auto text-white fw-bold fs-4">
            POKEDEX
        </div>

        <div class="text-white">
            usuario
        </div>
    </div>
</nav>
<div class="container mt-4">
    <form class="container d-flex flex-row justify-content-between align-items-center my-3" method="get" action="show_pokemon.php">
        <input type="text" class="form-control w-75" name="pokemon" placeholder="Buscar Pokémon..." id="buscarPokemon">
        <button class="btn btn-primary btn-md bg-danger border-none" style="border:none;" type="submit" id="btnBuscar">Buscar Pokémon</button>
    </form>
    <div class="row justify-content-center mt-4">
        <?php
        // Llamar a la función para mostrar los pokemones
        verificarSiExistePokemonElegido($pokemones, $pokemon);
        ?>
    </div>

</div>

    </div>

</div>



<a href="index.php">Volver</a>


<!-- Remove the container if you want to extend the Footer to full width. -->
<div class="container-fluid my-5">
    <section class="">
        <!-- Footer -->
        <footer class="text-center text-white" style="background-color: rgba(220, 53, 69, 1)">
            <!-- Grid container -->
            <div class="container p-4 pb-0">
                <!-- Section: CTA -->
                <section class="">
                    <p class="d-flex justify-content-center align-items-center">
                        <span class="me-3">Trabajo Práctico: Pokedex</span>
                    </p>
                </section>
                <!-- Section: CTA -->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2020 Copyright:
                <span class="me-3">Facu Guillen - Lautaro Rossi</span>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </section>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
