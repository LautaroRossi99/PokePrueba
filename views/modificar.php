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
</head>
<body style="background-color: #f8f9fa;">
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-4 w-100" style="max-width: 600px;">
        <h2 class="text-center mb-4 text-danger">Modificar Pokémon</h2>

        <form action="procesar_modificacion.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $pokemon['id']; ?>">

            <div class="mb-3">
                <label for="numero_pokedex" class="form-label">Número Pokédex</label>
                <input type="number" class="form-control" id="numero_pokedex" name="numero_pokedex" value="<?php echo $pokemon['numero_pokedex']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $pokemon['nombre']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Nombre de imagen</label>
                <input type="text" class="form-control" id="imagen" name="imagen" value="<?php echo $pokemon['imagen']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo $pokemon['descripcion']; ?></textarea>
            </div>

            <div class="mb-3">
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

            <div class="mb-3">
                <label for="habitat" class="form-label">Hábitat</label>
                <input type="text" class="form-control" id="habitat" name="habitat" value="<?php echo $pokemon['habitat']; ?>" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="indexAdmin.php" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
