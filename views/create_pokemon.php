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
    <title>Crear Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles/forms.css">
    <link rel="stylesheet" href="../assets/styles/style.css">

</head>
<body class="d-flex flex-column min-vh-100">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/includes/navbar.php'; ?>
<div class="container py-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 800px;">
        <h2 class="text-center mb-4 text-danger fw-bold d-flex justify-content-center align-items-center gap-2">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Pokebola" width="30">
            Crear Pokémon
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Pokebola" width="30">
        </h2>

        <form action="../index.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id">

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="numero_pokedex" class="form-label">Número Pokédex</label>
                    <input type="number" class="form-control" id="numero_pokedex" name="numero_pokedex" required>
                </div>

                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="col-md-6">
                    <label for="imagen" class="form-label">Imagen</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">
                </div>

                <div class="col-md-6">
                    <label for="habitat" class="form-label">Hábitat</label>
                    <input type="text" class="form-control" id="habitat" name="habitat" required>
                </div>

                <div class="col-12">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                </div>

                <div class="col-12">
                    <label for="tipos" class="form-label">Tipos</label>
                    <div class="checkbox-group">

                        <div class="d-flex gap-4">
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
                        </div>

                        <div class="d-flex gap-4">
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
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="15">
                            <span class="checkbox-text">Siniestro</span>
                        </label>
                        </div>
                        <div class="d-flex gap-4">
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="4">
                            <span class="checkbox-text">Planta</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="13">
                            <span class="checkbox-text">Psíquico</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="10">
                            <span class="checkbox-text">Roca</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="9">
                            <span class="checkbox-text">Tierra</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="8">
                            <span class="checkbox-text">Veneno</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="tipos[]" value="17">
                            <span class="checkbox-text">Volador</span>
                        </label>
                        </div>

                    </div>
                    <small class="text-muted">Selecciona los tipos</small>
                </div>

                <div class="col-12 d-flex justify-content-between mt-4">
                    <a href="../index.php" class="btn btn-secondary px-4">Cancelar</a>
                    <button type="submit" class="btn btn-success px-4">Guardar Pokémon</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/includes/footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../assets/js/alert.js"></script>
<script src="../assets/js/checkbox.js"></script>

</body>
</html>


