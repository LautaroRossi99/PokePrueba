<?php
session_start();
global $database;
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/Functions/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/database.php';

$pokemones = obtenerPokemones($database);

$pokemon = "";
$mostrarTodos = false;

if (isset($_GET['pokemon'])) {
    $pokemon = strtolower($_GET['pokemon']);

    // Verificar si hay coincidencias
    $coincidencias = array_filter($pokemones, function($poke) use ($pokemon) {
        return strpos(strtolower($poke['nombre']), $pokemon) !== false
            || (is_numeric($pokemon) && (int)$poke['numero_pokedex'] === (int)$pokemon)
            || strpos(quitarTildes(strtolower($poke['tipos'])), quitarTildes(strtolower($pokemon))) !== false;
    });

    $mensajeNoEncontrado = "";
    if (count($coincidencias) === 0) {
        $mensajeNoEncontrado = '
        <div class="col-12 text-center">
            <h3 class="text-danger fw-bold mb-3">❌ No se encontraron Pokémon que coincidan con:</h3>
            <h4 class="text-secondary mb-4">"' . htmlspecialchars($pokemon) . '"</h4>
        </div>';
        $mostrarTodos = true;
    }
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
    <link rel="stylesheet" href="../assets/styles/style.css">
</head>
<body class="d-flex flex-column min-vh-100" style="background-color: #ffe6e6;">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/includes/navbar.php'; ?>
<div class="container mt-4">
    <form class="container d-flex flex-row justify-content-between align-items-center my-3" method="get" action="show_pokemon.php">
        <input type="text" class="form-control w-75" name="pokemon" placeholder="Buscar Pokémon..." id="buscarPokemon">
        <button class="btn btn-primary btn-md bg-danger border-none" style="border:none;" type="submit" id="btnBuscar">Buscar Pokémon</button>
    </form>

    <div class="row justify-content-center mt-4">
        <?php
        echo $mensajeNoEncontrado;

        if ($pokemon && !$mostrarTodos) {
            verificarSiExistePokemonElegido($pokemones, $pokemon);
        }

        if (!empty($pokemonVerMas)) {
            mostrarDatosPokemonEncontrado($pokemonVerMas);
        }

        if ($mostrarTodos || (!$pokemon && empty($pokemonVerMas))) {
            mostrarDatosPokemon($pokemones);
        }
        ?>

    </div>
    <div class="d-flex justify-content-center m-4">
        <a href="../index.php" class="btn btn-secondary btn-sm px-4 fw-bold d-flex align-items-center gap-2 shadow-sm">
            <i class="bi bi-arrow-left-circle"></i> Volver
        </a>
    </div>
</div>






<!-- Remove the container if you want to extend the Footer to full width. -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/includes/footer.php'; ?>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../assets/js/alert.js"></script>

</body>
</html>