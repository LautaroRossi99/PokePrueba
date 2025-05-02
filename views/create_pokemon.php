<?php
session_start();
global $database;
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/Functions/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/database.php';

$pokemones = obtenerPokemones($database);

$pokemon = "";
if (isset($_GET['pokemon'])) {
    $pokemon = strtolower($_GET['pokemon']);
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
<nav class="navbar navbar-expand-lg navbar-dark bg-danger px-4">
    <div class="container-fluid d-flex justify-content-between align-items-center w-100">
        <!-- 🔵 Logo Pokémon a la izquierda -->
        <div>
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Pokeball" width="40" height="40" class="me-2">
        </div>
        <!-- 🟥 Texto centrado -->
        <div class="mx-auto text-white fw-bold fs-4">
            <a class="text-white text-decoration-none" href="../index.php"> POKEDEX </a>
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
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg p-4 w-100" style="max-width: 600px;">
            <h2 class="text-center mb-4 text-danger">Crear Pokémon</h2>

            <form action="../index.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id">

                <div class="mb-3">
                    <label for="numero_pokedex" class="form-label">Número Pokédex</label>
                    <input type="number" class="form-control" id="numero_pokedex" name="numero_pokedex" required>
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre"required>
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Nombre de imagen</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                </div>

                <div class="mb-3 select-wrapper">
                    <p for="tipos" class="form-label">Tipos</p>
                    <div class="checkbox-group">
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="12">
                            <span class="checkbox-text">Acero</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="3">
                            <span class="checkbox-text">Agua</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="18">
                            <span class="checkbox-text">Bicho</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="14">
                            <span class="checkbox-text">Dragón</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="5">
                            <span class="checkbox-text">Eléctrico</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="11">
                            <span class="checkbox-text">Fantasma</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="2">
                            <span class="checkbox-text">Fuego</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="16">
                            <span class="checkbox-text">Hada</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="6">
                            <span class="checkbox-text">Hielo</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="7">
                            <span class="checkbox-text">Lucha</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="1">
                            <span class="checkbox-text">Normal</span>
                        </label><label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="15">
                            <span class="checkbox-text">Siniestro</span>
                        </label><label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="4">
                            <span class="checkbox-text">Planta</span>
                        </label><label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="13">
                            <span class="checkbox-text">Psíquico</span>
                        </label><label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="10">
                            <span class="checkbox-text">Roca</span>
                        </label><label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="9">
                            <span class="checkbox-text">Tierra</span>
                        </label><label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="8">
                            <span class="checkbox-text">Veneno</span>
                        </label><label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="17">
                            <span class="checkbox-text">Volador</span>
                        </label>

                    </div>
                    <small class="text-muted">Selecciona máximo dos tipo de Pokémon</small>
                </div>
                <div class="mb-3">
                    <label for="habitat" class="form-label">Hábitat</label>
                    <input type="text" class="form-control" id="habitat" name="habitat"" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="../index.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar Pokémon</button>
                </div>
            </form>
        </div>
    </div>

</div>



<a href="index.php">Volver</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../assets/alert.js"></script>
</body>
</html>
