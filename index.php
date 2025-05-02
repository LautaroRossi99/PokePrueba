<?php
session_start();
global $database;
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/Functions/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/database.php';

$pokemonDelete = "";

if (isset($_GET['pokemonDelete'])) {
    $pokemonDelete = intval($_GET['pokemonDelete']);
    deletePokemon($database, $pokemonDelete);
}

$pokemonCreate = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imagen = $_FILES['imagen'] ?? null;

    $pokemonCreate = [
        'numero_pokedex' => $_POST['numero_pokedex'] ?? null,
        'nombre' => $_POST['nombre'] ?? '',
        'imagen' => '', // se completa después si se sube bien
        'descripcion' => $_POST['descripcion'] ?? '',
        'tipos' => $_POST['tipos'] ?? [],
        'habitat' => $_POST['habitat'] ?? '',
    ];

    if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
        $nombreLimpio = preg_replace("/[^a-zA-Z0-9\.-]/", "_", $imagen['name']);
        $ruta = 'Pokemones/' . $nombreLimpio;


        if (!move_uploaded_file($imagen['tmp_name'], $ruta)) {
            echo "<div class='alert alert-danger mt-3'>❌ Error al subir el archivo.</div>";
            exit;
        }

        // Si se subió correctamente, actualizamos el campo imagen
        $pokemonCreate['imagen'] = $ruta;
    }

    createPokemon($database, $pokemonCreate);
}




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
<?php include $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/includes/navbar.php'; ?>
<div class="container mt-4">

    <div class="row justify-content-center mt-4">

        <div class="container mt-4">
                <form class="container d-flex flex-row justify-content-between align-items-center my-3" method="get" action="views/show_pokemon.php">
                    <input type="text" class="form-control w-75" name="pokemon" placeholder="Buscar Pokémon..." id="buscarPokemon">
                    <button class="btn btn-primary btn-md bg-danger border-none" style="border:none;" type="submit" id="btnBuscar">Buscar Pokémon</button>
                </form>

            <a href="views/create_pokemon.php" class="btn btn-primary btn-md bg-danger border-none text-decoration-none" style="border:none;">Crear Pokémon</a>

            <div class="row justify-content-center mt-4">
                <?php
                // Llamar a la función para mostrar los pokemones
                mostrarDatosPokemon($pokemones);
                ?>

            </div>


        </div>


    </div>
</div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
