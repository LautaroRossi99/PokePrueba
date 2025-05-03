<?php
session_start();
global $database;
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/Functions/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/database.php';



$id = $_POST['idPokemon'];
$pokemon = obtenerPokemonPorId($database, $id);


$tiposTodos = obtenerTodosLosTipos($database);
$tiposActuales = obtenerTiposPorPokemon($database, $pokemon['id']);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/forms.css" rel="stylesheet">

</head>
<body class="d-flex flex-column min-vh-100">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/includes/navbar.php'; ?>
<div class="container py-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 800px;">

        <h2 class="text-center mb-4 text-danger fw-bold d-flex justify-content-center align-items-center gap-2">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Pokebola" width="30">
            Modificar Pokemon
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Pokebola" width="30">
        </h2>

        <form action="procesar_modificacion.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $pokemon['id']; ?>">

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="numero_pokedex" class="form-label">Número Pokédex</label>
                    <input type="number" class="form-control" id="numero_pokedex" name="numero_pokedex" value="<?php echo $pokemon['numero_pokedex']; ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $pokemon['nombre']; ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="imagen" class="form-label">Imagen</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">
                </div>

                <div class="col-md-6">
                    <label for="habitat" class="form-label">Hábitat</label>
                    <input type="text" class="form-control" id="habitat" name="habitat" value="<?php echo $pokemon['habitat']; ?>" required>
                </div>

                <div class="col-12">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo $pokemon['descripcion']; ?></textarea>
                </div>

                <div class="col-12">
                    <label for="tipos" class="form-label">Tipos</label>
                    <select multiple class="form-control" name="tipos[]" id="tipos" required>
                        <?php foreach ($tiposTodos as $tipo): ?>
                            <option value="<?php echo $tipo['id']; ?>" <?php echo in_array($tipo['id'], $tiposActuales) ? 'selected' : ''; ?>>
                                <?php echo ucfirst($tipo['elemento']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-muted">Usá Ctrl o Shift para seleccionar más de uno.</small>
                </div>

                <div class="col-12 d-flex justify-content-between mt-4">
                    <a href="../index.php" class="btn btn-secondary px-4">Cancelar</a>
                    <button type="submit" class="btn btn-success px-4">Guardar cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/PokedexPrueba/includes/footer.php'; ?>
</body>
</html>