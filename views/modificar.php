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
                    <div class="checkbox-group">
                        <?php
                        $tipos = [
                            12 => "Acero", 3 => "Agua", 18 => "Bicho", 14 => "Dragón", 5 => "Eléctrico", 11 => "Fantasma",
                            2 => "Fuego", 16 => "Hada", 6 => "Hielo", 7 => "Lucha", 1 => "Normal", 15 => "Siniestro",
                            4 => "Planta", 13 => "Psíquico", 10 => "Roca", 9 => "Tierra", 8 => "Veneno", 17 => "Volador"
                        ];

                        $contador = 0;
                        echo '<div class="d-flex flex-wrap gap-4">';
                        foreach ($tipos as $id => $nombre) {
                            if ($contador % 6 === 0 && $contador !== 0) {
                                echo '</div><div class="d-flex flex-wrap gap-4 mt-2">';
                            }
                            $checked = in_array($id, $tiposActuales) ? 'checked' : '';
                            echo '<label class="custom-checkbox">';
                            echo "<input type='checkbox' name='tipos[]' value='$id' $checked>";
                            echo "<span class='checkbox-text'>$nombre</span>";
                            echo '</label>';
                            $contador++;
                        }
                        echo '</div>';
                        ?>
                    </div>
                    <small class="text-muted">Selecciona los tipos</small>
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